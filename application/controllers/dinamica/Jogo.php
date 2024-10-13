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
		$ordem = $this->checkUltimaRespondida();
		$this->questao($ordem);
	}


	public function questao($queordem){
		$data = array();
		$data['id'] = null;
		$data['RES_ERRO'] = $this->session->flashdata('reserro');
		$data['RES_OK']	= $this->session->flashdata('resok');
		$data['CHECK_LIBERACAO'] = site_url('dinamica/Jogo');
		$data['SAVE_RESPOSTA'] = site_url('dinamica/Jogo/salvarEquipeResposta');
		$data['URL_EQUIPEINFO'] = site_url('dinamica/Jogo/equipeInfo');
		$data['RESPOSTAS'] = [];
		$data['COUNT_RESPOSTAS'] = 0;

		// Busca a ordem desejada
		$cond['idevento'] = $this->session->userdata('equipe_ideventoativo');
		$cond['queordem'] = $queordem;

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);
		if($questao) {
			foreach($questao as $chave => $valor) {
				$data[$chave] = $valor;
			}

			$data['LIBERADA'] = ($questao->quesituacao == 0) ? 'secondary' : 'success';
			$data['SITUACAO'] = ($questao->quesituacao == 0) ? 'Não liberada' : 'Liberada';

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
						'SEM_IMAGEM' => (!$r->qrimg) ? 'd-none' : ''
					);
				}
				$data['COUNT_RESPOSTAS'] = count($respostas);
			}
		}

		$this->parser->parse('jogo/questoes', $data);
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
	
				if (($resposta_correta->id == $equiperesposta_id) && ($diferenca <= $questao->quetempo)) {
					$itens['eqrponto'] = $questao->queponto;
				}
			} else { //Discursiva
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
			SELECT eqr.*, q.queponto, q.idquestaotipo, q.queordem, q.quetempo, qr.qrordem, qr.qrcorreta
			FROM equipe_questaoresposta eqr
			LEFT JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON IFNULL(qr.idquestao, eqr.idquestao) = q.id
			WHERE eqr.idequipe = $idequipe
			ORDER BY q.queordem
		";
		
		$res = $this->PadraoM->fmSearchQuery($query);

		if($res){
			$total_eqrponto = 0;
			$total_eqrtempo = 0;
			
			foreach($res as $r){
				$total_eqrponto += $r->eqrponto;
				$total_eqrtempo += $r->eqrtempo;

				if($r->qrcorreta == 1 || $r->eqrponto > 0){
					$BG_ACERTOU = 'card-resposta-correta';

					if($r->eqrtempo > $r->quetempo)
						$BG_ACERTOU = 'card-resposta-invalida';
				} else
					$BG_ACERTOU = 'card-resposta-errada';

				$data['LIST_EQUIPE_QUESTAORESPOSTA'][] = array(
					'queordem' 	=> $r->queordem,
					'queponto'	=> $r->queponto,
					'quetempo'	=> $r->quetempo,
					'qrordem' 	=> $r->qrordem,
					'eqrponto' 	=> $r->eqrponto,
					'eqrtempo'	=> $r->eqrtempo,
					'eqrdiscursiva'	=> $r->eqrdiscursiva,
					'DISCURSIVA' => ($r->idquestaotipo == 1) ? 'd-none' : 'd-block',
					'OBJETIVA' => ($r->idquestaotipo == 1) ? 'd-block' : 'd-none',
					'BG_ACERTOU' => $BG_ACERTOU
				);
			}

			$data['TOTAL_EQRPONTO'] = $total_eqrponto;
			$data['TOTAL_EQRTEMPO'] = $total_eqrtempo;
		}

		$this->parser->parse('jogo/equipe-info', $data);
	}


	public function checkUltimaRespondida(){
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
				$ordem = $ultimaRespondida[0]->queordem + 1;
				return $ordem; // ordem
			}
		}

		return 1; // inicio
	}
}