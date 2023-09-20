<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('quiz_logado')) redirect('Login');

		date_default_timezone_set('America/Sao_Paulo');

		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}
	
	public function index(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['LIST_DADOS']	= array();
		$data['SEM_DADOS'] 	= null;
		
		$this->parser->parse('home', $data);
	}
}
