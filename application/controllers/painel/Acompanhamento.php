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
		redirect('painel/Acompanhamento/questao/1');
	}

	public function questao($queordem, $showResults = false){
		$data = array();
		$data['id'] = null;
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['URL_QUESTAO'] = site_url('painel/Acompanhamento/questao');
		$data['URL_ATUALIZACOES'] = site_url('painel/Acompanhamento/buscaAtualizacoes/?ids=');
		$data['URL_ANTERIOR'] = site_url('painel/Acompanhamento/questao/'.($queordem - 1));
		$data['URL_PROXIMO'] = site_url('painel/Acompanhamento/questao/'.($queordem + 1));
		$data['RESPOSTAS'] = [];
		$data['RESULTS'] = [];
		$data['COUNT_QUESTOES'] = 0;
		$data['COUNT_RESPOSTAS'] = 0;
		$data['SHOW_RESULTS'] = $showResults;
		$ideventoativo = $this->session->userdata('quiz_ideventoativo');

		// Busca todas as questoes
		$quetotal = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem', ['idevento' => $ideventoativo], FALSE);
		if($quetotal) {
			foreach ($quetotal as $q) {
				$data['QUESTOES'][] = array(
					'queid'      => $q->id,
					'queordem'   => $q->queordem,
					'LIBERADA'	 => ($q->quesituacao == '1') ? 'badge-success' : 'badge-secondary',
					'ATUAL'		 => ($q->queordem == $queordem) ? 'badge-selected' : 'badge-custom'
				);
			}
			$data['COUNT_QUESTOES'] = count($quetotal);
		}

		// Busca a ordem desejada
		$cond['idevento'] = $ideventoativo;
		$cond['queordem'] = $queordem;

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);
		if($questao) {
			foreach($questao as $chave => $valor) {
				$data[$chave] = $valor;
			}

			$data['SITUACAO'] = ($questao->quesituacao == 0) ? 'Não liberada' : 'Liberada';
			$data['URL_LIBERAR'] = site_url('painel/Acompanhamento/liberarQuestao/'.$questao->id);
			$data['LIBERADA'] = ($questao->quesituacao == 0) ? 'secondary' : 'success';

			// Tratamento do countdown
			$tempoAtual = date("Y-m-d H:i:s");

			if (!$questao->quedtliberacao) {
				$data['tempoRestante'] = -1;
			} else if ($tempoAtual >= $questao->quedtlimite) {
				$data['tempoRestante'] = 0;
			} else {
				$atualTime = strtotime($tempoAtual);
				$limiteTime = strtotime($questao->quedtlimite);
				$data['tempoRestante'] = $limiteTime - $atualTime;
			}

			// Busca as alternativas
			$respostas = $this->PadraoM->fmSearch($this->tabela_resposta, 'qrordem', array('idquestao' => $questao->id));
			if ($respostas) {
				foreach ($respostas as $r) {
					$ids[] = $r->id;

					if($r->qrcorreta){
						$data['CORRETA_qrordem'] = $r->qrordem;
						$data['CORRETA_qrtexto'] = $r->qrtexto;
						$data['CORRETA_qrimg'] = $r->qrimg;
					}

					$data['RESPOSTAS'][] = array(
						'id'        => $r->id,
						'qrordem'   => $r->qrordem,
						'qrtexto'   => $r->qrtexto,
						'qrcorreta' => $r->qrcorreta,
						'qrimg'     => $r->qrimg
					);
				}
				$data['COUNT_RESPOSTAS'] = count($respostas);
				$data['URL_ATUALIZACOES'] .= implode(',', $ids);
			}

			//Busca os resultados
			if($showResults) {
				$query_results = "
					SELECT e.equnome, q.queordem, qr.qrordem, eqr.eqrponto, eqr.eqttempo
					FROM equipe_questaoresposta eqr
					JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
					JOIN questao q ON qr.idquestao = q.id
					JOIN equipe e ON eqr.idequipe = e.id
					WHERE q.idevento = $ideventoativo
					AND q.id = $questao->id
					ORDER BY eqr.eqttempo ASC;
				";

				$results = $this->PadraoM->fmSearchQuery($query_results);
				if($results) {
					foreach ($results as $index => $result) {
						
						if($result->qrordem == $data['CORRETA_qrordem']){
							$COR_EQRSITUACAO = 'bg-success-50';

							if($result->eqttempo > $questao->quetempo){
								$COR_EQRSITUACAO = 'bg-warning-50';
							}
						} else {
							$COR_EQRSITUACAO = 'bg-danger-50';
						}

						$data['RESULTS'][] = array(
							'ordem'		=> $index + 1,
							'equnome'   => $result->equnome,
							'queordem'   => $result->queordem,
							'qrordem'   => $result->qrordem,
							'eqrponto'   => $result->eqrponto,
							'eqttempo'     => $result->eqttempo,
							'COR_EQRSITUACAO' => $COR_EQRSITUACAO
						);
					}
				}
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
			SELECT
				e.equnome, eqr.idequipe, SUM(eqr.eqrponto) AS total_eqrponto, SUM(eqr.eqttempo) AS total_eqttempo, e.equlogo
			FROM equipe_questaoresposta eqr
			JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON qr.idquestao = q.id
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE q.idevento = $idevento
			GROUP BY e.equnome, eqr.idequipe, e.equlogo
			ORDER BY total_eqrponto DESC, total_eqttempo ASC;
		";

		$res_ranking = $this->PadraoM->fmSearchQuery($query_ranking);

		if($res_ranking){
			foreach ($res_ranking as $indice => $r) {
				$data['EQUIPES'][] = array(
					'id'        => $r->idequipe,
					'pontos'	=> $r->total_eqrponto,
					'tempo'	=> $r->total_eqttempo,
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
							'tempo'     => 0,
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
		$data['TOTAL_INFOEQUIPE'] = [];

		$query = "
			SELECT e.equnome, q.queordem, qr.qrordem, eqr.eqrponto, eqr.eqttempo
			FROM equipe_questaoresposta eqr
			JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON qr.idquestao = q.id
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE q.idevento = $idevento
			ORDER BY q.queordem ASC;
		";

		$res = $this->PadraoM->fmSearchQuery($query);

		$questoes = [];
		if($res){
			foreach ($res as $r) {
				$questoes[$r->queordem][] = array(
					'equnome'   => $r->equnome,
					'qrordem'   => $r->qrordem,
					'eqrponto'  => $r->eqrponto,
					'eqttempo'  => $r->eqttempo
				);
			}
			
			foreach ($questoes as $queordem => $equipes) {
				$data['PONTUACAO_EQUIPES'][] = array(
					'queordem' => $queordem,
					'equipes'  => $equipes
				);
			}
		}

		$this->parser->parse('painel/pontuacao', $data);
	}
}
