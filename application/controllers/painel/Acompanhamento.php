<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acompanhamento extends CI_Controller {
	private $tabela_evento ='evento';
	private $tabela_equipe ='equipe';
	private $tabela_questao ='questao';
	private $tabela_resposta ='questaoresposta';
		
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('quiz_logado')) redirect('painel/Login');

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}

	public function index(){
		$this->questao(1);
	}

	public function questao($queordem){
		$data = array();
		$data['id'] = null;
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['URL_QUESTAO'] = site_url('painel/Acompanhamento/questao');
		$data['URL_ATUALIZACOES'] = site_url('painel/Acompanhamento/buscaAtualizacoes/?ids=');
		$data['URL_ANTERIOR'] = site_url('painel/Acompanhamento/questao/'.($queordem - 1));
		$data['URL_PROXIMO'] = site_url('painel/Acompanhamento/questao/'.($queordem + 1));
		$data['RESPOSTAS'] = [];
		$data['COUNT_QUESTOES'] = 0;

		// Busca todas as questoes
		$quetotal = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem', ['idevento' => $this->session->userdata('quiz_ideventoativo')], FALSE);

		if($quetotal) {
			$data['COUNT_QUESTOES'] = count($quetotal);
		
			foreach ($quetotal as $q) {
				$data['QUESTOES'][] = array(
					'queid'      => $q->id,
					'queordem'   => $q->queordem,
					'LIBERADA'	 => ($q->quesituacao == '1') ? 'badge-success' : 'badge-secondary',
					'ATUAL'		 => ($q->queordem == $queordem) ? 'badge-selected' : 'badge-custom'
				);
			}
		}

		// Busca a ordem desejada
		$cond['idevento'] = $this->session->userdata('quiz_ideventoativo');
		$cond['queordem'] = $queordem;

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);

		if($questao) {
			foreach($questao as $chave => $valor) {
				$data[$chave] = $valor;
			}

			$data['URL_LIBERAR'] = site_url('painel/Acompanhamento/liberarQuestao/'.$questao->id);

			// Busca as opcoes de resposta da questao
			$respostas = $this->PadraoM->fmSearch($this->tabela_resposta, 'qrordem', array('idquestao' => $questao->id));
			$data['COUNT_RESPOSTAS'] = $respostas ? count($respostas) : 0;

			if ($respostas) {
				foreach ($respostas as $r) {
					$ids[] = $r->id;
					$data['RESPOSTAS'][] = array(
						'id'        => $r->id,
						'qrordem'   => $r->qrordem,
						'qrtexto'   => $r->qrtexto,
						'qrimg'     => $r->qrimg
					);
				}
				$data['URL_ATUALIZACOES'] .= implode(',', $ids);
			}
		}

		$this->parser->parse('painel/questoes', $data);
	}


	public function liberarQuestao($id){
		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, ['id' => $id], TRUE);
		
		$itens['quesituacao'] = 1;
		$itens['quedtliberacao'] = date("Y-m-d H:i:s");
		$itens['quedtlimite'] = date("Y-m-d H:i:s", strtotime($itens['quedtliberacao']) + $questao->quetempo);

		$res = $this->PadraoM->fmUpdate($this->tabela_questao, ['id' => $id], $itens);

		redirect('painel/Acompanhamento/questao/'.$questao->queordem);
	}


	public function buscaAtualizacoes() {
		$ids = $this->input->get('ids');
		$ids_array = array_map('intval', explode(',', $ids));
		$id_list = implode(",", $ids_array);

		$query = "
			SELECT DISTINCT e.equnome, eqr.criado_em
			FROM equipe_questaoresposta eqr
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE eqr.idquestaoresposta IN ($id_list)
			ORDER BY eqr.criado_em ASC
		";

		$att = $this->PadraoM->fmSearchQuery($query);
		echo json_encode($att);

		exit; // (?)
	}


	public function ranking(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$idevento = $this->session->userdata('quiz_ideventoativo');

		$query_ranking = "
			SELECT e.equnome, eqr.idequipe, SUM(eqr.eqrponto) AS total_eqrponto, e.equlogo
			FROM equipe_questaoresposta eqr
			JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON qr.idquestao = q.id
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE q.idevento = $idevento
			GROUP BY e.equnome, eqr.idequipe, e.equlogo
			ORDER BY total_eqrponto DESC;
		";

		$res_ranking = $this->PadraoM->fmSearchQuery($query_ranking);

		if($res_ranking){
			foreach ($res_ranking as $indice => $r) {
				$data['EQUIPES'][] = array(
					'id'        => $r->idequipe,
					'pontos'	=> $r->total_eqrponto,
					'ranking'	=> ($indice + 1),
					'equnome'   => $r->equnome,
					'equlogo'   => $r->equlogo
				);
			}

			$equipes_ids = array_column($data['EQUIPES'], 'id');
			$posicao = count($data['EQUIPES']) + 1;

			$res_others = $this->PadraoM->fmSearch($this->tabela_equipe, 'equnome', ['idevento' => $idevento], NULL);

			if($res_others){
				foreach ($res_others as $o) {
					if (!in_array($o->id, $equipes_ids)) {
						$data['EQUIPES'][] = array(
							'id'        => $o->id,
							'pontos'    => 0,
							'ranking'	=> $posicao,
							'equnome'   => $o->equnome,
							'equlogo'   => $o->equlogo
						);
						$posicao++;
					}
				}
			}
		}

		$this->parser->parse('painel/ranking', $data);
	}


	public function pontuacao(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$idevento = $this->session->userdata('quiz_ideventoativo');
		$data['PONTUACAO_EQUIPES'] = [];
		$data['TOTAL_EQRPONTOS'] = [];

		$query = "
			SELECT e.equnome, q.queordem, qr.qrordem, eqr.eqrponto
			FROM equipe_questaoresposta eqr
			JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON qr.idquestao = q.id
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE q.idevento = $idevento
			ORDER BY e.equnome ASC, q.queordem ASC;
		";

		$res = $this->PadraoM->fmSearchQuery($query);

		$questoes = [];
		$total_eqrpontos = [];

		if($res){
			foreach ($res as $r) {
				$questoes[$r->queordem][] = array(
					'equnome'   => $r->equnome,
					'qrordem'   => $r->qrordem,
					'eqrponto'  => $r->eqrponto
				);

				if (!isset($total_eqrpontos[$r->equnome])) {
					$total_eqrpontos[$r->equnome] = 0;
				}

				$total_eqrpontos[$r->equnome] += $r->eqrponto;
			}

			$questoes_data = [];

			foreach ($questoes as $queordem => $equipes) {
				$questoes_data[] = array(
					'queordem' => $queordem,
					'equipes'  => $equipes
				);
			}
		
			$data['PONTUACAO_EQUIPES'] = $questoes_data;
			$data['TOTAL_EQRPONTOS'] = $total_eqrpontos;
		}

		$this->parser->parse('painel/pontuacao', $data);
	}
}
