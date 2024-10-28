<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $tabela_equipe = 'equipe';
	private $tabela_questao = 'questao';

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('quiz_logado')) redirect('painel/Login');

		date_default_timezone_set('America/Sao_Paulo');

		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}
	
	public function index(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['EQUIPES'] = array();
		$data['SEM_DADOS'] 	= null;

		$idevento = $this->session->userdata('quiz_ideventoativo');

		if($idevento) {
			$equipes = $this->PadraoM->fmSearch($this->tabela_equipe, 'equlogada', array('idevento' => $idevento));
			
			if($equipes){
				foreach($equipes as $e){
					$data['EQUIPES'][] = array(
						'id' 			=> $e->id,
						'equnome' 		=> $e->equnome,
						'equlogo' 		=> $e->equlogo,
						'text-color'  	=> ($e->equlogada) ? 'text-success' : 'text-secondary',
						'img-color'  	=> ($e->equlogada) ? '' : 'filter: saturate(0)',
						'editar' 		=> site_url('painel/Equipe/edita/'.$e->id)
					);
				}
			}
		}
		
		$this->parser->parse('painel/home', $data);
	}


	public function selecionaEvento($idevento){
		$res_id = $this->PadraoM->fmUpdate('usuario', ['id' => $this->session->userdata('quiz_idusuario')], ['ideventoativo' => $idevento]);

		//Se dados salvos no BD com sucesso
		if($res_id){
			$this->session->set_userdata('quiz_ideventoativo', $idevento);

			$this->session->set_userdata('quiz_evenome', $this->PadraoM->fmSearch('evento', '', ['id' => $idevento], TRUE)->evenome);

			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Novo Evento ativo!'));
			
			//--- Grava Log ---
			$log = "Mudando evento ativo, idevento: ".$idevento;
			$itens_log = array('logtexto' => $log,'idusuario' => $this->session->userdata('quiz_idusuario'));
			$res_log = $this->LogM->fmNew($itens_log);
			//--- Fim Log ---

			//Redireciona
			redirect('painel/Home');
		}
		else{
			$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'Problemas ao mudar evento.'));
		}

		redirect("painel/Home");
	}
}
