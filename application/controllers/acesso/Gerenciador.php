<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerenciador extends CI_Controller {
	private $tabela_equipe ='equipe';
	private $tabela_evento ='evento';
		
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_ACESSO;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}
	
	public function index(){
		$data = array();
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');

		$cond = 'evesituacao = 1 OR evesituacao = 2';
		$order = 'evesituacao ASC';

		$res = $this->PadraoM->fmSearch($this->tabela_evento, $order, $cond);

		if($res){
			foreach($res as $r){
				if($r->evesituacao == 1){
					$situacao = "Iniciado";
					$COR_SITUACAO = 'badge badge-pill badge-success py-1';
				} else {
					$situacao = "Finalizado";
					$COR_SITUACAO = 'badge badge-pill badge-danger py-1';
				}
				
				$data['EVENTOS'][] = array(
					'id' 			=> $r->id,
					'evenome' 		=> $r->evenome,
					'evesituacao' 	=> $situacao,
					'criado_em' 	=> date('d/m/Y', strtotime($r->criado_em)),
					'COR_SITUACAO'	=> $COR_SITUACAO,
					'BTN_DISABLED'	=> ($r->evesituacao == 1) ? '' : 'd-none',
					'URL_ACESSAR' 	=> site_url('acesso/Gerenciador/selecionaEvento/'.$r->id)
				);
			}
		}
		
		$this->parser->parse('acesso/evento-select', $data);
	}


	public function selecionaEvento($id){
		$data = array();
		$data['RES_MSG']	= $this->session->flashdata('resmsg');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['URL_ACESSAR'] = site_url('acesso/Gerenciador/acessar');

		// Buscando evento
		$res_evento = $this->PadraoM->fmSearch($this->tabela_evento, null, array('id' => $id), TRUE);
		
		if ($res_evento){
			foreach ($res_evento as $chave => $valor){
				$data[$chave] = $valor;
			}

			// Buscando equipes do evento
			$res_equipes = $this->PadraoM->fmSearch($this->tabela_equipe, 'equnome', array('idevento' => $res_evento->id));

			if ($res_equipes){
				foreach($res_equipes as $e){
					$data['EQUIPES'][] = array(
						'idequipe' 	=> $e->id,
						'equnome' 	=> $e->equnome,
						'logada' 	=> ($e->equlogada == 1) ? 'disabled' : ''
					);
				}
			}
		} else {
			show_error('Erro ao pesquisar registro.', 500, 'Ops, erro encontrado.');
		}

		$this->parser->parse('acesso/equipe-select', $data);
	}


	public function acessar(){
		$idevento = $this->input->post('id');
		$evenome = $this->input->post('evenome');
		$idequipe = $this->input->post('equipe');

		if($idequipe){
			$res_equipe = $this->PadraoM->fmSearch($this->tabela_equipe, null, array('id'=> $idequipe), TRUE);

			// Verifica se equipe ja esta logada
			if(!$res_equipe->equlogada){
				$equipe_update = $this->PadraoM->fmUpdate($this->tabela_equipe, array('id'=> $idequipe), array('equlogada' => 1));
	
				$this->session->set_userdata('equipe_logado', TRUE);
				$this->session->set_userdata('equipe_ideventoativo', $idevento);
				$this->session->set_userdata('equipe_evenome', $evenome);
				$this->session->set_userdata('equipe_idequipe', $res_equipe->id);
				$this->session->set_userdata('equipe_equlogo', $res_equipe->equlogo);
				$this->session->set_userdata('equipe_equnome', $res_equipe->equnome);
	
				$this->session->set_flashdata('resok', fazNotificacao('success', "Sucesso! A equipe ".$res_equipe->equnome." entrou no evento."));
				redirect('dinamica/Jogo');
			} else {
				$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Problemas no acesso!', 'A equipe selecionada já está logada'));
				redirect('acesso/Gerenciador/selecionaEvento/'.$idevento);
			}
		} else {
			$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Problemas no acesso!', 'Selecione uma equipe disponível'));
			redirect('acesso/Gerenciador/selecionaEvento/'.$idevento);
		}
	}

	public function logout(){
		$idequipe = $this->session->userdata('equipe_idequipe');

		$this->session->unset_userdata('equipe_logado');
		$this->session->unset_userdata('equipe_ideventoativo');
		$this->session->unset_userdata('equipe_evenome');
		$this->session->unset_userdata('equipe_idequipe');
		$this->session->unset_userdata('equipe_equlogo');
		$this->session->unset_userdata('equipe_equnome');
		
		$equipe_update = $this->PadraoM->fmUpdate($this->tabela_equipe, array('id'=> $idequipe), array('equlogada' => 0));

		redirect('acesso/Gerenciador');
	}
}