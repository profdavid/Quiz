<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jogo extends CI_Controller {
	private $tabela_equipe ='equipe';
	private $tabela_evento ='evento';
	private $tabela_questao ='questao';
		
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_JOGO;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');

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
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');

		$this->parser->parse('jogo/questoes', $data);
	}

	public function equipeInfo(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');

		// *********************************************************************************
		//	BUSCAR A PONTUACAO GERAL, RANKING E PONTOS EM CADA QUESTAO RESPONDIDA DA EQUIPE  
		// *********************************************************************************
		
		$res_questoes = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem', array('idevento' => $this->session->userdata('equipe_ideventoativo')));

		if($res_questoes){
			foreach($res_questoes as $r){
				$data['LIST_QUESTOES'][] = array(
					'id' 			=> $r->id,
					'queordem' 		=> $r->queordem,
					'quetempo' 		=> $r->quetempo,
					'queponto' 		=> $r->queponto
				);
			}
		}

		$this->parser->parse('jogo/equipe-info', $data);
	}
}