<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
	private $tabela ='log';	
		
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('quiz_logado')) redirect('Login');
		
		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}
	
	public function index(){
		$data = array();
		$data['LIST_DADOS']	= array();
		$data['LIST_USUARIO'] = array();
		$data['LIST_CLIENTE'] = array();
		$data['SEM_DADOS'] 	= null;
		$data['URL_FRMFILTRO']	= site_url('painel/Log');

		//Manipulando Filtro
		$str_filtro = '(1 = 1)';

		if($this->input->post('filtro')){
			$data['dtini'] 	= $this->input->post('dtini');
			$data['dtfim'] 	= $this->input->post('dtfim');
		}
		else{
			$data['dtini'] 	= date('Y-m-d', strtotime('-7 days'));
			$data['dtfim'] 	= date('Y-m-d');
		}

		$str_filtro .= " AND criado_em >= '".$data['dtini']." 00:00:00' AND criado_em <= '".$data['dtfim']." 23:59:59'";
		
		//Buscando dados no Banco
		$res = $this->PadraoM->fmSearchQuery('SELECT id, logtexto, DATE_FORMAT(criado_em, \'%d/%m/%Y %H:%i:%s\') criado_em FROM log WHERE '.$str_filtro.' ORDER BY criado_em DESC');
		//echo "<pre>";
		//print_r($res);
		//exit;
		
		if($res){
			foreach($res as $r){
				$data['LIST_DADOS'][] = array(
					'id' 		=> $r->id,
					'logtexto' 	=> $r->logtexto,
					'criado_em' => $r->criado_em
				);
			}
			//echo "<pre>";
			//print_r($data['LIST_DADOS']);
		}
		else 
			$data['SEM_DADOS'] = '<tr><td colspan="4" class="text-center">Não há dados a serem listados.</td></tr>';
		
		$this->parser->parse('painel/log-list', $data);
	}
	
}
