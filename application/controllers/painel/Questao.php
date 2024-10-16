<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questao extends CI_Controller {
	private $tabela = 'questao';
	private $tabela_equipe = 'equipe';
	private $tabela_questaoresposta = 'questaoresposta';
	private $tabela_equipe_questaoresposta = 'equipe_questaoresposta';
		
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
		$data['URL_ANULAR'] 	= site_url('painel/Questao/anular');
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
					'idquestaotipo' => $r->idquestaotipo,
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
		$data['URL_UPLOADTINYMCE'] = site_url('painel/Questao/imageUploadTinyMCE');
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
		$data['quediscursiva'] = null;
		$data['idquestaotipo'] = 1;
		$data['queordem'] = $proxima_ordem;
		$data['quetempo'] = 30;
		$data['queponto'] = 10;
		$data['queimg'] = 'assets/img/questao_image.png';

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

		//Salvando imagem no diretorio do evento
		if($_FILES['queimg']['error'] == 0 && $_FILES['queimg']['size'] > 0){
			$diretorio = retirarAcentos($this->session->userdata('quiz_evenome'));

			$fileupload = new FileUploader('queimg', ['uploadDir' => 'assets/uploads/'.$diretorio.'/']);
			$upload_res = $fileupload->upload();
			
			if($upload_res['isSuccess'])
				$itens['queimg'] = $upload_res['files'][0]['file'];
		} else {
			if (!$id)
				$itens['queimg'] = 'assets/img/questao_image.png';
		}
		
		//Tratamento dos itens
		$itens['atualizado_em'] = date("Y-m-d H:i:s");
		$itens['quesituacao'] = $this->input->post('quesituacao');
		$itens['idquestaotipo'] = $this->input->post('idquestaotipo');
		$itens['idevento'] = $this->session->userdata('quiz_ideventoativo');

		//Tratamento da data liberacao e data limite
		if ($itens['quesituacao'] == 0) {
			$itens['quedtliberacao'] = null;
			$itens['quedtlimite'] = null;
		} 
		else {
			if ($id) {
				$res_questao = $this->PadraoM->fmSearch($this->tabela, null, ['id' => $id], TRUE);
		
				if ($res_questao && $res_questao->quesituacao == 0) {
					$itens['quedtliberacao'] = date("Y-m-d H:i:s");
					$itens['quedtlimite'] = date("Y-m-d H:i:s", strtotime($itens['quedtliberacao']) + $itens['quetempo']);
				}
			} else {
				$itens['quedtliberacao'] = date("Y-m-d H:i:s");
				$itens['quedtlimite'] = date("Y-m-d H:i:s", strtotime($itens['quedtliberacao']) + $itens['quetempo']);
			}
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

			//Tratamento para questao objetiva
			if($itens['idquestaotipo'] == 1) {
				$questaoresposta = $this->input->post('respostas');
				$qrcorreta = $this->input->post('resposta_correta');
				$this->excluirRespostasNaoIncluidas($res_id, $questaoresposta);
				$this->salvarRespostas($res_id, $questaoresposta, $qrcorreta);
			}

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
		$data['URL_UPLOADTINYMCE'] =  site_url('painel/Questao/imageUploadTinyMCE');
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
		$res_respostas = $this->PadraoM->fmSearch($this->tabela_questaoresposta, 'qrordem', array('idquestao' => $id));
		
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
			foreach ($res_questoes as $index => $q) {
				$data['LIST_QUESTOES'][$index] = array(
					'id'           	=> $q->id,
					'queordem'     	=> $q->queordem,
					'quetempo'     	=> $q->quetempo,
					'queponto'     	=> $q->queponto,
					'idquestaotipo'	=> $q->idquestaotipo,
					'qtdescricao'	=> ($q->idquestaotipo == 1) ? 'Objetiva' : 'Discursiva',
					'quetexto'     	=> $q->quetexto,
					'queimg'       	=> $q->queimg,
					'text_situacao' => ($q->quesituacao == 0) ? 'Não liberada' : 'Liberada',
					'situacao'	=> ($q->quesituacao == 0) ? 'dark' : 'success',
				);

				if ($q->idquestaotipo == 2){ //discursiva
					$data['LIST_QUESTOES'][$index]['OBJETIVA'] = 'd-none';
					$data['LIST_QUESTOES'][$index]['DISCURSIVA'] = 'd-block';
					$data['LIST_QUESTOES'][$index]['quediscursiva'] = $q->quediscursiva;
				}
				else { //objetiva
					$res_respostas = $this->PadraoM->fmSearch($this->tabela_questaoresposta, 'qrordem', ['idquestao' => $q->id]);

					$respostas = [];

					if ($res_respostas) {
						foreach ($res_respostas as $r) {
							$respostas[] = array(
								'id'           => $r->id,
								'qrordem'      => $r->qrordem,
								'qrtexto'      => $r->qrtexto,
								'qrcorreta'    => $r->qrcorreta,
								'qrimg'        => $r->qrimg,
								'BADGE_CORRETA'	=> ($r->qrcorreta == 1) ? 'badge-success' : 'badge-secondary',
								'BG_CORRETA'  => ($r->qrcorreta == 1) ? 'card-resposta-correta' : ''
							);
						}

						$data['LIST_QUESTOES'][$index]['OBJETIVA'] = 'd-block';
						$data['LIST_QUESTOES'][$index]['DISCURSIVA'] = 'd-none';
						$data['LIST_QUESTOES'][$index]['respostas'] = $respostas;
					}
				}
			}
		}

		$this->parser->parse('painel/questao/questao-relatorio', $data);
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

			$this->ordenar();
			
			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Registro excluído.'));
		}
		else
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao excluir o registro.'));

		redirect('painel/Questao');
	}


	public function ordenar(){
		if (isset($_GET['ordem'])) {
			$ordem = explode(',', $_GET['ordem']);
		} else {
			$questoes = $this->PadraoM->fmSearch($this->tabela, 'queordem', array('idevento' => $this->session->userdata('quiz_ideventoativo')));
			$ordem = $questoes ? array_column($questoes, 'id') : null;
		}

		$trans = $this->PadraoM->fmUpdateIncrementCount($this->tabela, $ordem, 'queordem');

		if (!$trans) {
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao reordenar questões.'));
			redirect('painel/Questao');
		}

		$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Dados atualizados.'));
		redirect('painel/Questao');
	}

	
	public function anular(){
		$idanular = $this->input->post('idanular');
		$idevento = $this->session->userdata('quiz_ideventoativo');

		$questao = $this->PadraoM->fmSearch($this->tabela, FALSE, ['id' => $idanular], TRUE);

		if($questao) {
			$equipes = $this->PadraoM->fmSearch($this->tabela_equipe, 'equnome', ['idevento' => $idevento]);

			// Busca a resposta correta da questao
			$cond['idquestao'] = $questao->id;
			$cond['qrcorreta'] = '1';
			$correta = $this->PadraoM->fmSearch($this->tabela_questaoresposta, FALSE, $cond, TRUE);

			// Busca as equipes que ja responderam a questao
			$equipesJaResponderam = $this->PadraoM->fmSearch($this->tabela_equipe_questaoresposta, FALSE, ['idquestao' => $questao->id]);

			$respondeuMap = []; // Cria um array associativo
			if ($equipesJaResponderam) {
				foreach ($equipesJaResponderam as $r) {
					$respondeuMap[$r->idequipe] = $r;
				}
			}

			$itens = [
				'idquestaoresposta' => ($correta) ? $correta->id : null,
				'eqrponto' => $questao->queponto,
				'eqrtempo' => 0,
			];
			
			foreach ($equipes as $equipe) {
				if (isset($respondeuMap[$equipe->id])) { // update
					$respondeu = $respondeuMap[$equipe->id];

					$cond = [
						'idequipe' => $respondeu->idequipe,
						'idquestao' => $respondeu->idquestao,
					];
			
					$this->PadraoM->fmUpdate($this->tabela_equipe_questaoresposta, $cond, $itens);
				}
				else { // novo
					$itens['idequipe'] = $equipe->id;
					$itens['idquestao'] = $questao->id;

					$this->PadraoM->fmNew($this->tabela_equipe_questaoresposta, $itens);
				}
			}

			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Questão anulada.'));
			redirect('painel/Questao');
		}
	}


	public function salvarRespostas($idquestao, $questaoresposta, $qrcorreta){
		if($questaoresposta) {
			$diretorio = retirarAcentos($this->session->userdata('quiz_evenome'));

			//Tratamento dos itens
			foreach($questaoresposta as $index => $r) {
				$itens['qrordem'] = $r['qrordem'];
				$itens['qrtexto'] = $r['qrtexto'];
				$itens['qrcorreta'] = ($qrcorreta == $r['qrordem'] ? 1 : 0);
				$itens['idquestao'] = $idquestao;
				$itens['qrimg'] = null;

				if($_FILES['respostas']['error'][$index] == 0) {
					$_FILES['r'] = array(
						'name' => $_FILES['respostas']['name'][$index],
						'type' => $_FILES['respostas']['type'][$index],
						'tmp_name' => $_FILES['respostas']['tmp_name'][$index],
						'error' => $_FILES['respostas']['error'][$index],
						'size' => $_FILES['respostas']['size'][$index]
					);

					$fileupload = new FileUploader('r', ['uploadDir' => 'assets/uploads/'.$diretorio.'/']);
					$upload_res = $fileupload->upload();

					if($upload_res['isSuccess']){
						$itens['qrimg'] = $upload_res['files'][0]['file'];
					}
				} else {
					unset($itens['qrimg']);	
				}
				
				if(isset($r['id']) && !empty($r['id'])){ //Edição
					$itens['atualizado_em'] = date("Y-m-d H:i:s");
					$cond = array('id' => $r['id']);

					$res_id = $this->PadraoM->fmUpdate($this->tabela_questaoresposta, $cond, $itens);
				} else //Novo
					$res_id = $this->PadraoM->fmNew($this->tabela_questaoresposta, $itens);
				

				if(!$res_id)
					$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao salvar questaoresposta.'));
			}
		}
	}


	public function excluirRespostasNaoIncluidas($idquestao, $questaoresposta){
		$cond = array('idquestao' => $idquestao);
		$ids = array();

		if($questaoresposta) {
			foreach ($questaoresposta as $r) {
				if (isset($r['id']) && !empty($r['id']))
					$ids[] = $r['id'];
			}
			
			if(!empty($ids)){
				$res = $this->PadraoM->fmDeleteNotInWithCond($this->tabela_questaoresposta, $cond, $ids);
			}
		} else {
			$this->PadraoM->fmDelete($this->tabela_questaoresposta, $cond);
		}
	}


	public function imageUploadTinyMCE() {
		if (!empty($_FILES['file']['name'])) {
			$diretorio = retirarAcentos($this->session->userdata('quiz_evenome'));
	
			$fileupload = new FileUploader('file', ['uploadDir' => 'assets/uploads/'.$diretorio.'/']);
			$upload_res = $fileupload->upload();
	
			if ($upload_res['isSuccess']) {
				$path = $upload_res['files'][0]['file'];
				$basepath = base_url($path);
				echo json_encode(['location' => $basepath]);
			} else {
				echo json_encode(['error' => 'Ocorreu um erro no upload']);
			}
		} else {
			echo json_encode(['error' => 'Nenhum arquivo foi recebido']);
		}
		exit;
	}
}