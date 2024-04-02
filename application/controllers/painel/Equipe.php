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
		$this->load->helpers('/fileuploader_helper');
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
		
		if($res){
			foreach($res as $r){
				$data['LIST_DADOS'][] = array(
					'id' 			=> $r->id,
					'equnome' 		=> $r->equnome,
					'equlogo' 		=> $r->equlogo,
					'equlogada' 	=> $r->equlogada,
					'criado_em' 	=> $r->criado_em,
					'atualizado_em' => $r->atualizado_em,
					'BTN_DESLOGAR' => ($r->equlogada == 0) ? 'hidden' : null,
					'COR_INATIVO'	=> ($r->equlogada == 0) ? 'style="background-color:#fff2f3;"' : null,
					'URL_EDITAR'	=> site_url('painel/Equipe/edita/'.$r->id)
				);
			}
		}

		$this->parser->parse('painel/equipe/equipe-list', $data);
	}

	public function novo(){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Novo';
		$data['URL_FRM'] 		= site_url('painel/Equipe/salvar');
		$data['URL_CANCELAR']	= site_url('painel/Equipe');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');

		$idevento_ativo = $this->session->userdata('quiz_ideventoativo');

		$data['id'] 		= null;
		$data['equnome'] 	= null;
		$data['equlogo'] 	= 'assets/img/equipe_default.png';
		$data['idevento'] = $idevento_ativo;

		$this->parser->parse('painel/equipe/equipe-form', $data);
	}


	public function salvar(){
		$idevento_ativo = $this->session->userdata('quiz_ideventoativo');

		//Inicializando variáveis com dados enviados
		foreach($this->input->post() as $chave => $valor){
			$valor = ($valor) ? $valor : null;
			$$chave = $valor;
			
			if(substr($chave, 0, 3) == 'equ') {
				$itens[$chave] = $valor;
			}
		}

		//Verifica equipe logo
		if($_FILES['equlogo']['error'] == 0 && $_FILES['equlogo']['size'] > 0){
			$fileupload = new FileUploader('equlogo', $_FILES['equlogo']);
			
			if ($fileupload) {
				$upload_res = $fileupload->upload();
				$itens['equlogo'] = $upload_res['files'][0]['file'];

				if (!$upload_res) {
					$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Erro ao salvar arquivo'));
				}
			} else {
				$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Erro ao inicar upload'));
			}
		} else {
			$itens['equlogo'] = 'assets/img/equipe_default.png';
		}
		
		//Tratamento dos itens
		$itens['atualizado_em'] = date("Y-m-d H:i:s");
		$itens['idevento'] = $idevento_ativo;
		
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
		
		//Buscando dados no Banco
		$res = $this->PadraoM->fmSearch($this->tabela, null, array('id' => $id), TRUE);
		
		if($res){
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
		}
		else 
			show_error('Erro ao pesquisar registro para edição.', 500, 'Ops, erro encontrado.');


		$this->parser->parse('painel/equipe/equipe-form', $data);
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
