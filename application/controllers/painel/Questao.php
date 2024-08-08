<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questao extends CI_Controller {
	private $tabela ='questao';
		
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('quiz_logado')) redirect('painel/Login');

		date_default_timezone_set('America/Sao_Paulo');

		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
		$this->load->helpers('/fileuploader_helper');
		$this->load->helpers('/gerenciador_helper');
	}

	public function index(){
		$data = array();
		$data['URL_ORDEM'] 		= site_url('painel/Questao/ordem');
		$data['URL_NOVO'] 		= site_url('painel/Questao/novo');
		$data['URL_EXCLUIR']	= site_url('painel/Questao/excluir');
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['LIST_DADOS']	= array();
		$data['SEM_DADOS'] 	= null;

		//Buscando dados no Banco (somente do evento ativo)
		$res = $this->PadraoM->fmSearch($this->tabela, 'queordem', array('idevento' => $this->session->userdata('quiz_ideventoativo')));
		
		if($res){
			foreach($res as $r){
				$data['LIST_DADOS'][] = array(
					'id' 			=> $r->id,
					'queordem' 		=> $r->queordem,
					'quetempo' 		=> $r->quetempo,
					'queponto' 		=> $r->queponto,
					'quetexto' 		=> $r->quetexto,
					'queimg' 		=> $r->queimg,
					'quedtliberacao' 	=> ($r->quedtliberacao) ? $r->quedtliberacao : '-',
					'quedtlimite' 		=> ($r->quedtlimite) ? $r->quedtlimite : '-',
					'quesituacao' 		=> ($r->quesituacao == 0) ? 'Não liberada' : 'Liberada',
					'idevento' 			=> $r->idevento,
					'criado_em' 		=> $r->criado_em,
					'atualizado_em' 	=> $r->atualizado_em,
					'COR_LIBERADA'	=> ($r->quesituacao == 1) ? 'style="background-color:#d4edda;"' : null,
					'URL_EDITAR'	=> site_url('painel/Questao/edita/'.$r->id)
				);
			}
		}
		$this->parser->parse('painel/questao/questao-list', $data);
	}

	public function novo(){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Novo';
		$data['URL_FRM'] 		= site_url('painel/Questao/salvar');
		$data['URL_CANCELAR']	= site_url('painel/Questao');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');

		// Incremento da ordem
		$idevento_ativo = $this->session->userdata('quiz_ideventoativo');
		$cond = array('idevento' => $idevento_ativo);
		$order = 'queordem DESC';

		$res = $this->PadraoM->fmSearch($this->tabela, $order, $cond, TRUE);
		$proxima_ordem = $res ? $res->queordem + 1 : 1;

		$data['id'] = null;
		$data['quedtliberacao'] = null;
		$data['quedtlimite'] = null;
		$data['quetexto'] = null;
		$data['quesituacao'] = null;
		$data['queordem'] = $proxima_ordem;
		$data['quetempo'] = 30;
		$data['queponto'] = 10;
		$data['queimg'] = 'assets/img/questao_image.png';

		$this->parser->parse('painel/questao/questao-form', $data);
	}


	public function salvar(){
		$idevento_ativo = $this->session->userdata('quiz_ideventoativo');

		//Inicializando variáveis com dados enviados
		foreach($this->input->post() as $chave => $valor){	
			$valor = ($valor) ? $valor : null;
			$$chave = $valor;
			
			if(substr($chave, 0, 3) == 'que') {
				$itens[$chave] = $valor;
			}
		}

		$quizDir = replaceSpacesAndLowerCase($this->session->userdata('quiz_evenome'));

		if($_FILES['queimg']['error'] == 0 && $_FILES['queimg']['size'] > 0){
			$fileupload = new FileUploader('queimg', [
				$_FILES['queimg'], 
				'uploadDir' => 'assets/uploads/'.$quizDir.'/'
			]);
			
			if ($fileupload) {
				$upload_res = $fileupload->upload();
				$itens['queimg'] = $upload_res['files'][0]['file'];
			} else 
				$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Erro ao salvar imagem!'));
		} else {
			//Atribui a imagem padrao caso nao feito upload
			if (!$id) $itens['queimg'] = 'assets/img/questao_image.png';
		}
		
		//Tratamento dos itens
		$itens['atualizado_em'] = date("Y-m-d H:i:s");
		$itens['quesituacao'] = $this->input->post('quesituacao');
		$itens['idevento'] = $idevento_ativo;

		//Tratamento da data liberacao e data limite
		if ($itens['quesituacao'] == 1) {
			$itens['quedtliberacao'] = date("Y-m-d H:i:s");
			$itens['quedtlimite'] = date("Y-m-d H:i:s", strtotime($itens['quedtliberacao']) + $itens['quetempo']);
		} else {
			$itens['quedtliberacao'] = null;
			$itens['quedtlimite'] = null;
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
			redirect('painel/Questao');
		}
		//Se dados NÃO salvos com sucesso
		else{
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao realizar a operação.'));
			
			if($id) //Edição
				redirect('painel/Questao/edita/'.$id);
			else //Novo
				redirect('painel/Questao/novo');
		}
	}


	public function edita($id){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Editar';
		$data['URL_FRM'] 		= site_url('painel/Questao/salvar');
		$data['URL_CANCELAR']	= site_url('painel/Questao');
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


		$this->parser->parse('painel/questao/questao-form', $data);
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

		redirect('painel/Questao');
	}

	public function ordem(){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Ordenacao';
		$data['URL_FRM'] 		= site_url('painel/Questao/ordenar');
		$data['URL_CANCELAR']	= site_url('painel/Questao');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');

		$res = $this->PadraoM->fmSearch($this->tabela, 'queordem', array('idevento' => $this->session->userdata('quiz_ideventoativo')));
		
		if($res){
			foreach($res as $r){
				$data['LIST_DADOS'][] = array(
					'id' 			=> $r->id,
					'queordem' 		=> $r->queordem,
					'quetempo' 		=> $r->quetempo,
					'queponto' 		=> $r->queponto,
					'quetexto' 		=> $r->quetexto
				);
			}
		}
		$this->parser->parse('painel/questao/questao-ordem', $data);
	}
	
	
	public function ordenar(){
		if (isset($_GET['order'])) {
			$newOrder = explode(',', $_GET['order']);
			$orderMapping = array_flip($newOrder);
		}

		$res = $this->PadraoM->fmSearch($this->tabela, 'queordem', array('idevento' => $this->session->userdata('quiz_ideventoativo')));

		if($res){
			foreach($res as $r){
				if (isset($orderMapping[$r->id])) {
					// $r->ordem = $orderMapping[$r->id];
					$itens['queordem'] = $orderMapping[$r->id] + 1;
					$cond = array('id' => $r->id);
					$res_update = $this->PadraoM->fmUpdate($this->tabela, $cond, $itens);
				}
			}
			// $res = $this->PadraoM->fmUpdateIncrement(); INCREMENT CAMPO ORDEM
		} else {
			$this->session->set_flashdata('reserro', fazNotificacao('error', 'Erro ao atualizar dados.'));
			redirect('painel/Questao');
		}

		$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Dados atualizados.'));
		redirect('painel/Questao');
	}
}
