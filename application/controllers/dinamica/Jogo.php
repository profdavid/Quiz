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
		$queordem = $this->checkEquipeProgresso();
		$this->questao($queordem);
	}


	public function questao($queordem){
		$data = array();
		$data['id'] = null;
		$data['RES_ERRO'] = $this->session->flashdata('reserro');
		$data['RES_OK']	= $this->session->flashdata('resok');
		$data['CHECK_LIBERACAO'] = site_url('dinamica/Jogo');
		$data['URL_ANTERIOR'] = site_url('dinamica/Jogo/questao/'.($queordem - 1));
		$data['URL_PROXIMO'] = site_url('dinamica/Jogo/questao/'.($queordem + 1));
		$data['SAVE_RESPOSTA'] = site_url('dinamica/Jogo/salvarEquipeResposta');
		$data['URL_EQUIPEINFO'] = site_url('dinamica/Jogo/equipeInfo');
		$data['URL_AUTOCHECK'] = site_url('dinamica/Jogo/autoCheckLiberacao/'.$queordem);
		$data['RESPOSTAS'] = [];
		$data['COUNT_QUESTOES'] = 0;
		$data['COUNT_RESPOSTAS'] = 0;

		$idevento = $this->session->userdata('equipe_ideventoativo');
		$idequipe = $this->session->userdata('equipe_idequipe');

		// Busca info do evento
		$evento = $this->PadraoM->fmSearch($this->tabela_evento, NULL, ['id' => $idevento], TRUE);
		$data['AUTOCHECK'] = ($evento) ? $evento->eveautocheck : -1;

		// Busca todas as questoes
		$quetotal = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem', ['idevento' => $idevento], FALSE);
		if($quetotal) {
			foreach ($quetotal as $q) {
				$data['QUESTOES'][] = array(
					'queid'      => $q->id,
					'queordem'   => $q->queordem,
					'LIBERADA'	 => ($q->quesituacao == '1' && $q->queordem != $queordem) ? 'background-color: #28A74520;' : '',
					'ACTIVE'	 => ($q->queordem == $queordem) ? 'active' : '',
					'URL_ACCESS' => site_url('dinamica/Jogo/questao/'.$q->queordem)
				);
			}
			$data['COUNT_QUESTOES'] = count($quetotal);
		}

		// Busca a ordem desejada
		$cond = [
			'idevento' => $idevento,
			'queordem' => $queordem
		];

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);

		if($questao) {
			foreach($questao as $chave => $valor) {
				$data[$chave] = $valor;
			}

			$data['LIBERADA'] = ($questao->quesituacao == 0) ? 'dark' : 'success';
			$data['SITUACAO'] = ($questao->quesituacao == 0) ? 'Não liberada' : 'Liberada';
			$data['D-SITUACAO'] = ($questao->quesituacao == 0) ? 'd-none' : 'd-block';

			// Tratamento se equipe ja respondeu
			$cond = [
				'idequipe' => $idequipe,
				'idquestao' => $questao->id,
			];

			$equipe_questaoresposta = $this->PadraoM->fmSearch($this->tabela_equipe_questaoresposta, NULL, $cond, TRUE);

			$data['RESPONDEU'] = ($equipe_questaoresposta) ? 1 : -1;
			$data['BTN_RESPONDEU'] = ($equipe_questaoresposta) ? 'd-none' : '';
			$data['eqrdiscursiva'] = ($equipe_questaoresposta) ? $equipe_questaoresposta->eqrdiscursiva : '';

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

			// Busca as opcoes de resposta da questao
			$respostas = $this->PadraoM->fmSearch($this->tabela_questaoresposta, 'qrordem', array('idquestao' => $questao->id));
			if ($respostas) {
				foreach ($respostas as $r) {
					$data['RESPOSTAS'][] = array(
						'qrid'     	=> $r->id,
						'qrordem'   => $r->qrordem,
						'qrtexto'   => $r->qrtexto,
						'qrimg'     => $r->qrimg,
						'SEM_IMAGEM' => (!$r->qrimg) ? 'd-none' : '',
						'SELECTED' => ($equipe_questaoresposta && ($r->id == $equipe_questaoresposta->idquestaoresposta)) ? 'selected' : ''
					);
				}
				$data['COUNT_RESPOSTAS'] = count($respostas);
			}
		}

		$this->parser->parse('jogo/equipe-progresso', $data);
	}



	public function salvarEquipeResposta(){
		$equipe_id = $this->session->userdata('equipe_idequipe');
		$questao_id = $this->input->post('id');

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, ['id' => $questao_id], TRUE);

		if($questao){
			$itens['idequipe'] = $equipe_id;
			$itens['idquestao'] = $questao_id;
			$itens['criado_em'] = date("Y-m-d H:i:s");

			//Tratamento do tempo
			$quedtliberacao = new DateTime($questao->quedtliberacao);
			$criado = new DateTime($itens['criado_em']);
			$diferenca = $criado->getTimestamp() - $quedtliberacao->getTimestamp();
			$itens['eqrtempo'] = $diferenca;

			//Tratamento do tipo e pontuacao
			$itens['eqrponto'] = 0;

			if ($questao->idquestaotipo == 1){ //Objetiva
				$equiperesposta_id = $this->input->post('equipe_resposta');
				$itens['idquestaoresposta'] = $equiperesposta_id;

				$cond = [
					'qrcorreta' => 1,
					'idquestao' => $questao->id
				];
	
				$resposta_correta = $this->PadraoM->fmSearch($this->tabela_questaoresposta, NULL, $cond, TRUE);
	
				if (($resposta_correta->id == $equiperesposta_id) && ($diferenca <= $questao->quetempo))
					$itens['eqrponto'] = $questao->queponto;
			} 
			else { //Discursiva
				$eqrdiscursiva = $this->input->post('eqrdiscursiva');
				$itens['eqrdiscursiva'] = $eqrdiscursiva;
			}

			//Registra resposta no banco
			$res_id = $this->PadraoM->fmNew($this->tabela_equipe_questaoresposta, $itens);

			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Resposta registrada.'));

			redirect('dinamica/Jogo');
		}
	}


	public function equipeInfo(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['LIST_EQUIPE_QUESTAORESPOSTA'] = array();
		$data['TOTAL_EQRPONTO'] = 0;
		$data['TOTAL_EQRTEMPO'] = 0;
		
		$idequipe = $this->session->userdata('equipe_idequipe');

		$query = "
			SELECT 
				eqr.*, 
				q.*,
				qr.qrcorreta,
				qr.qrordem,
				qr.qrordem AS resposta_ordem, 
				qr.qrcorreta AS resposta_correta,
				CASE 
					WHEN q.quediscursiva IS NULL THEN (
						SELECT qr2.qrordem 
						FROM questaoresposta qr2 
						WHERE qr2.idquestao = q.id 
						AND qr2.qrcorreta = 1 
						LIMIT 1
					)
					ELSE q.quediscursiva
				END AS resposta_correta
			FROM equipe_questaoresposta eqr
			LEFT JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON IFNULL(qr.idquestao, eqr.idquestao) = q.id
			WHERE eqr.idequipe = $idequipe
			ORDER BY q.queordem
		";
		
		$res = $this->PadraoM->fmSearchQuery($query);

		// var_dump($res);
		// exit;

		if($res){
			$total_eqrponto = 0;
			$total_eqrtempo = 0;
			
			foreach($res as $r){
				$total_eqrponto += $r->eqrponto;
				$total_eqrtempo += $r->eqrtempo;

				if($r->qrcorreta == 1 || $r->eqrponto > 0){
					$BG_QUESTAO = 'bg-success';

					if($r->eqrtempo > $r->quetempo)
						$BG_QUESTAO = 'bg-warning';
				} 
				else
					$BG_QUESTAO = 'bg-danger';
				
				$data['LIST_EQUIPE_QUESTAORESPOSTA'][] = array(
					'queordem' 	=> $r->queordem,
					'quetexto' => $r->quetexto,
					'queponto'	=> $r->queponto,
					'quetempo'	=> $r->quetempo,
					'qrordem' 	=> $r->qrordem,
					'eqrponto' 	=> $r->eqrponto,
					'eqrtempo'	=> $r->eqrtempo,
					'eqrdiscursiva'	=> $r->eqrdiscursiva,
					'DISCURSIVA' => ($r->idquestaotipo == 1) ? 'd-none' : 'd-block',
					'OBJETIVA' => ($r->idquestaotipo == 1) ? 'd-block' : 'd-none',
					'CORRETA' => $r->resposta_correta,
					'BG_QUESTAO' => $BG_QUESTAO
				);
			}

			$data['TOTAL_EQRPONTO'] = $total_eqrponto;
			$data['TOTAL_EQRTEMPO'] = $total_eqrtempo;
		}

		$this->parser->parse('jogo/equipe-info', $data);
	}



	public function autoCheckLiberacao($queordem){
		$idevento = $this->session->userdata('equipe_ideventoativo');

		$cond = [
			'idevento' => $idevento,
			'queordem' => $queordem
		];

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);

		$check = ($questao) ? $questao->quesituacao : "-1";
		echo json_encode($check);

		exit;
	}



	public function checkEquipeProgresso(){
		$idevento = $this->session->userdata('equipe_ideventoativo');
		$idequipe = $this->session->userdata('equipe_idequipe');

		$ultimaDoEvento = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem DESC', ['idevento' => $idevento], TRUE);

		$query = "
			SELECT q.queordem
			FROM equipe_questaoresposta eqr
			JOIN questao q ON eqr.idquestao = q.id
			WHERE eqr.idequipe = $idequipe
			ORDER BY q.queordem DESC
			LIMIT 1
		";

		$ultimaRespondida = $this->PadraoM->fmSearchQuery($query);

		if($ultimaRespondida){
			if($ultimaDoEvento->queordem == $ultimaRespondida[0]->queordem){
				return -1; // finalizado
			}
			else {
				$ordemProgresso = $ultimaRespondida[0]->queordem + 1;
				return $ordemProgresso; // em progresso
			}
		}

		return 1; // inicio 
	}
}