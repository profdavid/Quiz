<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questao extends CI_Controller {
	private $tabela ='questao';
	private $tabela_resposta ='questaoresposta';
		
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
		$data['URL_RELATORIO'] 	= site_url('painel/Questao/relatorio');
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
		$data['LIST_RESPOSTAS']	= array();
		$data['RESPOSTAS_COUNT'] = 0;

		// Incremento da ordem
		$cond = array('idevento' => $this->session->userdata('quiz_ideventoativo'));
		$res = $this->PadraoM->fmSearch($this->tabela, 'queordem DESC', $cond, TRUE);
		$proxima_ordem = $res ? $res->queordem + 1 : 1;

		$data['id'] = null;
		$data['quedtliberacao'] = null;
		$data['quedtlimite'] = null;
		$data['quetexto'] = null;
		$data['quesituacao'] = null;
		$data['queordem'] = $proxima_ordem;
		$data['quetempo'] = 30;
		$data['queponto'] = 10;
		$data['queimg'] = 'assets/img/questao_image.jpg';

		$this->parser->parse('painel/questao/questao-form', $data);
	}


	public function salvar(){
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
			if (!$id) $itens['queimg'] = 'assets/img/questao_image.jpg';
		}
		
		//Tratamento dos itens
		$itens['atualizado_em'] = date("Y-m-d H:i:s");
		$itens['quesituacao'] = $this->input->post('quesituacao');
		$itens['idevento'] = $this->session->userdata('quiz_ideventoativo');

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

			//Insert das respostas
			$respostas = $this->input->post('respostas');
			$resposta_correta = $this->input->post('resposta_correta');
			$this->salvarRespostas($res_id, $respostas, $resposta_correta);

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
		$data['LIST_RESPOSTAS']	= array();
		$data['RESPOSTAS_COUNT'] = 0;
		
		//Buscando dados no Banco
		$res = $this->PadraoM->fmSearch($this->tabela, null, array('id' => $id), TRUE);
		
		if($res){
			foreach($res as $chave => $valor) {
				$data[$chave] = $valor;
			}
		}
		else 
			show_error('Erro ao pesquisar registro para edição.', 500, 'Ops, erro encontrado.');

		//Buscando respostas da questao
		$res_respostas = $this->PadraoM->fmSearch($this->tabela_resposta, 'qrordem', array('idquestao' => $id));
		
		if($res_respostas){
			$data['RESPOSTAS_COUNT'] = count($res_respostas);
			foreach($res_respostas as $index => $r){
				$data['LIST_RESPOSTAS'][] = array(
					'id' 			=> $r->id,
					'index'			=> $index,
					'qrordem'		=> $r->qrordem,
					'qrtexto' 		=> $r->qrtexto,
					'qrcorreta' 	=> $r->qrcorreta,
					'qrimg' 		=> $r->qrimg,
					'RES_CORRETA'	=> ($r->qrcorreta == 1) ? 'checked' : null
				);
			}
		}

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

			//Refaz a ordenação das questões
			$questoes = $this->PadraoM->fmSearch($this->tabela, 'queordem', array('idevento' => $this->session->userdata('quiz_ideventoativo')));

			if($questoes) {
				$ids = array_column($questoes, 'id');
				$trans = $this->PadraoM->fmUpdateIncrementCount($this->tabela, $ids, 'queordem');
			}
		}
		else
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao excluir o registro.'));

		redirect('painel/Questao');
	}


	public function ordem(){
		$data = array();
		$data['LABEL_ACAO'] 	= 'Ordenação';
		$data['URL_FRM'] 		= site_url('painel/Questao/ordenar');
		$data['URL_CANCELAR']	= site_url('painel/Questao');
		$data['RES_ERRO']		= $this->session->flashdata('reserro');
		$data['RES_OK']			= $this->session->flashdata('resok');
		$data['LIST_DADOS']	= array();
		$data['SEM_DADOS'] 	= null;

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
		if (!isset($_GET['ordem'])) {
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Falhou ao encontrar ordem.'));
			redirect('painel/Questao/ordem');
		}

		$ordem = explode(',', $_GET['ordem']);
		$trans = $this->PadraoM->fmUpdateIncrementCount($this->tabela, $ordem, 'queordem');

		if(!$trans) {
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao reordenar questões.'));
			redirect('painel/Questao/ordem');
		}

		$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Dados atualizados.'));
		redirect('painel/Questao');
	}


	public function salvarRespostas($idquestao, $respostas, $resposta_correta){
		$this->excluirRespostas($idquestao, $respostas);

		if($respostas) {
			foreach($respostas as $re) {
				$itens['qrordem'] = $re['qrordem'];
				$itens['qrtexto'] = $re['qrtexto'];
				$itens['qrcorreta'] = ($resposta_correta == $re['qrordem'] ? 1 : 0);
				$itens['idquestao'] = $idquestao;

				//Salvando os dados
				if(isset($re['id']) && !empty($re['id'])){ //Edição
					$itens['atualizado_em'] = date("Y-m-d H:i:s");
					$cond = array('id' => $re['id']);
					$res_id = $this->PadraoM->fmUpdate($this->tabela_resposta, $cond, $itens);
				}
				else //Novo
					$res_id = $this->PadraoM->fmNew($this->tabela_resposta, $itens);
				
				//Se dados salvos no BD com sucesso
				if($res_id){
					//--- Grava Log ---
					$log = ($re['id']) ? "Edita ".$this->tabela_resposta." | Id: ".$res_id : "Novo ". $this->tabela_resposta." | Id: ".$res_id;
					$log .= " | Valores: ";
					foreach($itens as $key => $val)
						$log .= $key."=".$val.", ";
					$itens_log = array('logtexto' => $log,'idusuario' => $this->session->userdata('quiz_idusuario'));
					$res_log = $this->LogM->fmNew($itens_log);
					//--- Fim Log ---
				} else {
					$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao realizar a operação.'));
					
					if($re['id']) //Edição
						redirect('painel/Questao/edita/'.$idquestao);
					else //Novo
						redirect('painel/Questao/novo');
				}
			}
		}
	}


	public function excluirRespostas($idquestao, $respostas){
		$cond = array('idquestao' => $idquestao);
		$ids = array();

		if($respostas) {
			foreach ($respostas as $r) {
				if (isset($r['id']) && !empty($r['id']))
					$ids[] = $r['id'];
			}
			
			if(!empty($ids)){
				$res = $this->PadraoM->fmDeleteNotInWithCond($this->tabela_resposta, $cond, $ids);
				if(!$res)
					$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Erro ao excluir questões.'));
			}
		} else {
			$this->PadraoM->fmDelete($this->tabela_resposta, $cond);
		}
	}


	public function relatorio(){
		$this->layout = LAYOUT_RELATORIO;
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['LIST_QUESTOES']	= array();
		$data['SEM_DADOS'] 	= null;
		$data['evenome'] = $this->session->userdata('quiz_evenome');
		$data['datereq'] = date("d/m/Y")." às ".date("H:i");

		//Buscando dados no Banco
		$res_questoes = $this->PadraoM->fmSearch($this->tabela, 'queordem', array('idevento' => $this->session->userdata('quiz_ideventoativo')));
		
		if($res_questoes){
			foreach ($res_questoes as $q) {
				$res_respostas = $this->PadraoM->fmSearch($this->tabela_resposta, 'qrordem', array('idquestao' => $q->id));

				$respostas = [];
				if ($res_respostas) {
					foreach ($res_respostas as $r) {
						$respostas[] = array(
							'id'           => $r->id,
							'qrordem'      => $r->qrordem,
							'qrtexto'      => $r->qrtexto,
							'qrcorreta'    => $r->qrcorreta,
							'qrimg'        => $r->qrimg,
							'RES_CORRETA'  => ($r->qrcorreta == 1) ? 'badge-success' : 'badge-secondary',
						);
					}
				}

				$data['LIST_QUESTOES'][] = array(
					'id'           => $q->id,
					'queordem'     => $q->queordem,
					'quetempo'     => $q->quetempo,
					'queponto'     => $q->queponto,
					'quetexto'     => $q->quetexto,
					'queimg'       => $q->queimg,
					'quesituacao'  => ($q->quesituacao == 0) ? 'Não liberada' : 'Liberada',
					'situacao'	=> ($q->quesituacao == 0) ? 'badge-danger' : 'badge-success',
					'respostas'    => $respostas
				);
			}
		}

		// var_dump($data['LIST_QUESTOES']);
		// exit;

		$this->parser->parse('painel/questao/questao-relatorio', $data);
	}

}
