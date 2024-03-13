<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipe extends CI_Controller {
	private $tabela ='equipe';
		
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('America/Sao_Paulo');

		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}

	public function index(){
		$data = array();
		$data['URL_NOVO'] 		= site_url('painel/Equipe/novo');
		$data['URL_EXCLUIR']	= site_url('painel/Equipe/excluir');
		$data['URL_DESLOGAR']	= site_url('painel/Equipe/deslogar');
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['LIST_DADOS']	= array();
		$data['SEM_DADOS'] 	= null;

		//Buscando dados no Banco (somente do evento ativo)
		$res = $this->PadraoM->fmSearch($this->tabela, 'equnome', array('idevento' => $this->session->userdata('quiz_ideventoativo')));

		//Buscando dados no Banco
		// $res = $this->PadraoM->fmSearch($this->tabela, 'equnome', []);
		
		if($res){
			foreach($res as $r){
				$evento = $this->PadraoM->fmSearch('evento', null , array('id' => $r->idevento), true); 

				$data['LIST_DADOS'][] = array(
					'id' 			=> $r->id,
					'equnome' 		=> $r->equnome,
					'equlogo' 		=> $r->equlogo,
					'equlogada' 		=> $r->equlogada,
					'evenome'		=> $evento->evenome,
					'criado_em' 	=> $r->criado_em,
					'atualizado_em' => $r->atualizado_em,
					'BTN_DESLOGAR' => ($r->equlogada == 0) ? 'disabled' : 'enabled',
					'COR_INATIVO'	=> ($r->equlogada == 0) ? 'style="background-color:#fff2f3;"' : null,
					'URL_EDITAR'	=> site_url('painel/Equipe/edita/'.$r->id)
				);
			}
		}

		$this->parser->parse('painel/equipe-list', $data);
	}

	public function novo(){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Novo';
		$data['URL_FRM'] 		= site_url('painel/Equipe/salvar');
		$data['URL_CANCELAR']	= site_url('painel/Equipe');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');
		$data['LIST_EVENTOS']	= array();

		$eventos = $this->PadraoM->fmSearch('evento', 'evenome', []);

		if($eventos){
			foreach($eventos as $r){
				$data['LIST_EVENTOS'][] = array(	
					'idevento' 	=> $r->id,
					'evenome' 	=> $r->evenome,
				);
			}
		}

		$data['id'] 		= null;
		$data['equnome'] 	= null;
		$data['equlogo'] 	= null;
		$data['idevento_selecionado'] = null;

		$this->parser->parse('painel/equipe-form', $data);
	}


	public function salvar(){
		//Inicializando variáveis com dados enviados
		foreach($this->input->post() as $chave => $valor){
			$valor = ($valor) ? $valor : null;
			$$chave = $valor;
			
			if(substr($chave, 0, 3) == 'equ') {
				$itens[$chave] = $valor;
			}

		}

		//Tratamento dos itens
		$itens['atualizado_em'] = date("Y-m-d H:i:s");
		$itens['idevento'] = $idevento;
		
		//Verifica se o nome já existe
		$filtro_verifica = ($id) ? " AND id <> $id" : null;
		$res = $this->PadraoM->fmSearchQuery("SELECT * FROM equipe WHERE equnome = '".$equnome."' $filtro_verifica");
		if($res){
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'O nome já existe!'));
			
			if($this->input->post('id'))
				redirect('painel/Equipe/edita/'.$this->input->post('id'));
			else
				redirect('painel/Equipe/novo');

			exit;
		}
		
		//Salvando os dados
		if($id){ //Edição
			$cond = array('id' => $id);

			$res_id = $this->PadraoM->fmUpdate($this->tabela, $cond, $itens);
		}
		else //Novo

			$res_id = $this->PadraoM->fmNew($this->tabela, $itens);
		
		//Se dados salvos no BD com sucesso
		if($res_id){
			if($id) //Edição
				$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Dados atualizados.'));
			else //Novo
				$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Dados inseridos.'));
			
			//--- Grava Log ---
			$log = ($id) ? "Edita ".$this->tabela." | Id: ".$res_id : "Novo ". $this->tabela." | Id: ".$res_id;
			$log .= " | Valores: ";
			foreach($itens as $key => $val)
				$log .= $key."=".$val.", ";
			$itens_log = array('logtexto' => $log,'idusuario' => $this->session->userdata('quiz_idusuario'));
			$res_log = $this->LogM->fmNew($itens_log);
			//--- Fim Log ---

			//Redireciona
			redirect('painel/Equipe');
		}
		//Se dados NÃO salvos com sucesso
		else{
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao realizar a operação.'));
			
			if($id) //Edição
				redirect('painel/Equipe/edita/'.$id);
			else //Novo
				redirect('painel/Equipe/novo');
		}
	}


	public function edita($id){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Editar';
		$data['URL_FRM'] 		= site_url('painel/Equipe/salvar');
		$data['URL_CANCELAR']	= site_url('painel/Equipe');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');
		$data['LIST_EVENTOS']	= array();

		$eventos = $this->PadraoM->fmSearch('evento', 'evenome', []);

		if($eventos){
			foreach($eventos as $r){
				$data['LIST_EVENTOS'][] = array(	
					'idevento' 	=> $r->id,
					'evenome' 	=> $r->evenome,
				);
			}
		}
		
		//Buscando dados no Banco
		$res = $this->PadraoM->fmSearch($this->tabela, null, array('id' => $id), TRUE);
		
		if($res){
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
			$data['idevento_selecionado'] = $data['idevento'];
		}
		else 
			show_error('Erro ao pesquisar registro para edição.', 500, 'Ops, erro encontrado.');


		$this->parser->parse('painel/equipe-form', $data);
	}


	public function excluir(){
		$id = $this->input->post('idexcluir');	
		$cond = array('id' => $id);	
			
		$res = $this->PadraoM->fmDelete($this->tabela, $cond);
		
		if($res){
			//--- Grava Log ---
			$log = "Exclui ". $this->tabela ." | Id: $id";
			$itens_log = array('logtexto' => $log,'idusuario' => $this->session->userdata('quiz_idusuario'));
			$res_log = $this->LogM->fmNew($itens_log);
			//--- Fim Log ---
			
			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Registro excluído.'));
		}
		else
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao excluir o registro.'));

		redirect('painel/Equipe');
	}


	public function deslogar(){
		$id = $this->input->post('iddeslogar');	
		$cond = array('id' => $id);
		$itens['equlogada'] = 0;
			
		$res = $this->PadraoM->fmUpdate($this->tabela, $cond, $itens);
		
		if($res){
			//--- Grava Log ---
			$log = "Exclui ". $this->tabela ." | Id: $id";
			$itens_log = array('logtexto' => $log,'idusuario' => $this->session->userdata('quiz_idusuario'));
			$res_log = $this->LogM->fmNew($itens_log);
			//--- Fim Log ---
			
			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Equipe deslogada.'));
		}
		else
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao deslogar a equipe.'));

		redirect('painel/Equipe');
	}
	
}
