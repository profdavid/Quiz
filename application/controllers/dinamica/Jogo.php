<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jogo extends CI_Controller {
	private $tabela_equipe ='equipe';
	private $tabela_evento ='evento';
	private $tabela_questao ='questao';
	private $tabela_questaoresposta ='questaoresposta';
	private $tabela_equipe_questaoresposta = 'equipe_questaoresposta';
		
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_JOGO;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
		$this->load->helpers('/gerenciador_helper');

		// Verifica se session expirou
		if(!$this->session->userdata('equipe_logado')) redirect('acesso/Gerenciador');

		// Verifica se a equipe foi deslogada pelo administrador
		$res_equipe = $this->PadraoM->fmSearch($this->tabela_equipe, null, array('id'=> $this->session->userdata('equipe_idequipe')), TRUE);

		if(!$res_equipe->equlogada){
			$this->session->unset_userdata('equipe_logado');
			$this->session->unset_userdata('equipe_ideventoativo');
			$this->session->unset_userdata('equipe_evenome');
			$this->session->unset_userdata('equipe_idequipe');
			$this->session->unset_userdata('equipe_equlogo');
			$this->session->unset_userdata('equipe_equnome');
			redirect('acesso/Gerenciador');
		}
	}
	
	public function index(){
		$this->questao(1);
	}


	public function questao($queordem){
		$data = array();
		$data['id'] = null;
		$data['RES_ERRO'] = $this->session->flashdata('reserro');
		$data['RES_OK']	= $this->session->flashdata('resok');
		$data['CHECK_LIBERACAO'] = site_url('dinamica/Jogo/questao');
		$data['SAVE_RESPOSTA'] = site_url('dinamica/Jogo/salvarEquipeResposta');
		$data['RESPOSTAS'] = [];

		// Busca todas as questoes
		$quetotal = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem', ['idevento' => $this->session->userdata('equipe_ideventoativo')], FALSE);

		$data['COUNT_QUESTOES'] = $quetotal ? count($quetotal) : 0;

		// Busca a ordem desejada
		$cond['idevento'] = $this->session->userdata('equipe_ideventoativo');
		$cond['queordem'] = $queordem;

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);

		if($questao) {
			foreach($questao as $chave => $valor) {
				$data[$chave] = $valor;
			}

			// Busca as opcoes de resposta da questao
			$respostas = $this->PadraoM->fmSearch($this->tabela_questaoresposta, 'qrordem', array('idquestao' => $questao->id));

			$data['COUNT_RESPOSTAS'] = $respostas ? count($respostas) : 0;

			if ($respostas) {
				foreach ($respostas as $r) {
					$data['RESPOSTAS'][] = array(
						'qrid'     	=> $r->id,
						'qrordem'   => $r->qrordem,
						'qrtexto'   => $r->qrtexto,
						'qrimg'     => $r->qrimg
					);
				}
			}
		}

		$this->parser->parse('jogo/questoes', $data);
	}


	public function salvarEquipeResposta(){
		$questao_id = $this->input->post('id');
		$equiperesposta_id = $this->input->post('equipe_resposta');

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, ['id' => $questao_id], TRUE);

		if($questao){
			$itens['idequipe'] = $this->session->userdata('equipe_idequipe');
			$itens['idquestaoresposta'] = $equiperesposta_id;
			$itens['criado_em'] = date("Y-m-d H:i:s");

			//Tratamento do tempo
			$quedtliberacao = new DateTime($questao->quedtliberacao);
			$criado = new DateTime($itens['criado_em']);

			$diferenca = $criado->getTimestamp() - $quedtliberacao->getTimestamp();
			$itens['eqttempo'] = $diferenca;

			//Tratamento da pontuacao
			$cond = [];
			$cond['qrcorreta'] = 1;
			$cond['idquestao'] = $questao->id;

			$resposta_correta = $this->PadraoM->fmSearch($this->tabela_questaoresposta, NULL, $cond, TRUE);

			$itens['eqrponto'] = 0;

			if (($resposta_correta->id == $equiperesposta_id) && ($diferenca <= $questao->quetempo)) {
				$itens['eqrponto'] = $questao->queponto;
			}

			//Registra resposta no banco
			$res_id = $this->PadraoM->fmNew($this->tabela_equipe_questaoresposta, $itens);

			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Resposta registrada.'));
			redirect('dinamica/Jogo/questao/'.$questao->queordem);
		}
	}


	public function equipeInfo(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$idequipe = $this->session->userdata('equipe_idequipe');
		$idevento = $this->session->userdata('equipe_ideventoativo');
		$data['LIST_EQUIPE_QUESTAORESPOSTA'] = array();

		$query_info = "
			SELECT DISTINCT eqr.eqrponto, qr.qrordem, q.queponto, q.queordem
			FROM equipe_questaoresposta eqr
			JOIN equipe e ON eqr.idequipe = e.id
			JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON qr.idquestao = q.id
			WHERE eqr.idequipe = $idequipe
			AND q.idevento = $idevento
			ORDER BY q.queordem ASC
		";
		
		$res_info = $this->PadraoM->fmSearchQuery($query_info);

		if($res_info){
			$total_eqrponto = 0;
			
			foreach($res_info as $r){
				$total_eqrponto += $r->eqrponto;

				$data['LIST_EQUIPE_QUESTAORESPOSTA'][] = array(
					'queordem' 	=> $r->queordem,
					'queponto'	=> $r->queponto,
					'qrordem' 	=> $r->qrordem,
					'eqrponto' 	=> $r->eqrponto,
					'TEXT_ACERTOU' 	=> ($r->eqrponto == 0) ? 'text-danger' : 'text-success',
					'BG_ACERTOU' 	=> ($r->eqrponto == 0) ? '#F4433610' : '#4CAF5010'
				);
			}
			$data['TOTAL_EQRPONTO'] = $total_eqrponto;
		}

		$query_ranking = "
			SELECT eqr.idequipe, SUM(eqr.eqrponto) AS total_eqrponto
			FROM equipe_questaoresposta eqr
			JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON qr.idquestao = q.id
			WHERE q.idevento = $idevento
			GROUP BY eqr.idequipe
			ORDER BY total_eqrponto DESC;
		";

		$res_ranking = $this->PadraoM->fmSearchQuery($query_ranking);

		if($res_ranking){
			foreach ($res_ranking as $indice => $r) {
				if ($r->idequipe === $idequipe) {
					$data['RANKING'] = $indice + 1;
					break;
				}
			}
		}

		$this->parser->parse('jogo/equipe-info', $data);
	}
}