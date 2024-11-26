<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	private $tabela ='usuario';	
		
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
		$data['URL_NOVO'] 	= site_url('painel/Usuario/novo');
		$data['URL_EXCLUIR']= site_url('painel/Usuario/excluir');
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['LIST_DADOS']	= array();
		$data['SEM_DADOS'] 	= null;
		
		//Buscando dados no Banco
		$res = $this->PadraoM->fmSearch($this->tabela, 'usunome', []);
		//echo "<pre>";
		//print_r($res);
		//exit;
		
		if($res){
			foreach($res as $r){
				$data['LIST_DADOS'][] = array(
					'id' 			=> $r->id,
					'usunome' 		=> $r->usunome,
					'usuemail' 		=> $r->usuemail,
					'COR_INATIVO'	=> ($r->ativo == 0) ? 'style="background-color:#fff2f3;"' : null,
					'URL_EDITAR'	=> site_url('painel/Usuario/edita/'.$r->id)
				);
			}
			//echo "<pre>";
			//print_r($data['LIST_DADOS']);
		}
		
		$this->parser->parse('painel/usuario/usuario-list', $data);
	}
	
	public function novo(){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Novo';
		$data['URL_FRM'] 		= site_url('painel/Usuario/salvar');
		$data['URL_CANCELAR']	= site_url('painel/Usuario');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');
		
		$data['id'] 		= null;
		$data['usunome'] 	= null;
		$data['usuemail'] 	= null;
		$data['ativo'] 		= 'checked="checked"';

		$this->parser->parse('painel/usuario/usuario-form', $data);
	}
	
	public function edita($id){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Editar';
		$data['URL_FRM'] 		= site_url('painel/Usuario/salvar');
		$data['URL_CANCELAR']	= site_url('painel/Usuario');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');
		
		//Buscando dados no Banco
		$res = $this->PadraoM->fmSearch($this->tabela, null, array('id' => $id), TRUE);
		
		if($res){
			foreach($res as $chave => $valor)
				$data[$chave] = $valor;

			$data['ativo'] = ($data['ativo'] == 1) ? 'checked="checked"' : null;
		}
		else 
			show_error('Erro ao pesquisar registro para edição.', 500, 'Ops, erro encontrado.');


		$this->parser->parse('painel/usuario/usuario-form', $data);
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
			
			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Registro excluí­do.'));
		}
		else
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao excluir o registro. Pode ser que haja Subusuarios vinculados.'));

		redirect('painel/Usuario');
	}
	
	public function salvar(){
		//Verifica Confirmação da Senha
		if($this->input->post('senha') != $this->input->post('senhaconf')){
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Campos Senha e Confirma Senha devem ser iguais.'));
			
			if($this->input->post('id'))
				redirect('painel/Usuario/edita/'.$this->input->post('id'));
			else
				redirect('painel/Usuario/novo');

			exit;
		}

		$itens = array();

		//Inicializando variáveis com dados enviados
		foreach($this->input->post() as $chave => $valor){
			$valor = ($valor) ? $valor : null;
			$$chave = $valor;
			//print $chave."[".$valor."]<br>";

			if(substr($chave, 0, 3) == 'usu')
				$itens[$chave] = $valor;
		}

		//Tratamento dos itens
		$itens['ativo'] 		= ($ativo) ? $ativo : 0;
		$itens['atualizado_em'] = date("Y-m-d H:i:s");

		//Trata senha
		if($senha) $itens['ususenha'] = password_hash($senha, PASSWORD_DEFAULT);
		
		
		//Verifica se e-mail já existe
		$filtro_verifica = ($id) ? " AND id <> $id" : null;
		$res = $this->PadraoM->fmSearchQuery("SELECT * FROM usuario WHERE usuemail = '".$usuemail."' $filtro_verifica");
		if($res){
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'O e-mail já existe!'));
			
			if($this->input->post('id'))
				redirect('painel/Usuario/edita/'.$this->input->post('id'));
			else
				redirect('painel/Usuario/novo');

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
			$acao = $id ? "Edita" : "Novo";
			gravarLog($acao, $res_id, $itens, $this->tabela, $this->session->userdata('quiz_idusuario'));
			//--- Fim Log ---

			//Redireciona
			redirect('painel/Usuario');
		}
		//Se dados NÃO salvos com sucesso
		else{
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao realizar a operação.'));
			
			if($id) //Edição
				redirect('painel/Usuario/edita/'.$id);
			else //Novo
				redirect('painel/Usuario/novo');
		}
	}

}
