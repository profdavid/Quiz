<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acompanhamento extends CI_Controller {
	private $tabela_evento ='evento';
	private $tabela_equipe ='equipe';
	private $tabela_questao ='questao';
	private $tabela_resposta ='questaoresposta';
		
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('quiz_logado')) redirect('painel/Login');

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}

	public function index(){
		$this->questao(1);
	}

	public function questao($queordem){
		$data = array();
		$data['id'] = null;
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['URL_ANTERIOR'] = site_url('painel/Acompanhamento/questao/'.($queordem - 1));
		$data['URL_PROXIMO'] = site_url('painel/Acompanhamento/questao/'.($queordem + 1));
		$data['RESPOSTAS'] = [];

		// Busca todas as questoes
		$quetotal = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem', ['idevento' => $this->session->userdata('quiz_ideventoativo')], FALSE);

		$data['COUNT_QUESTOES'] = $quetotal ? count($quetotal) : 0;

		// Busca a ordem desejada
		$cond['idevento'] = $this->session->userdata('quiz_ideventoativo');
		$cond['queordem'] = $queordem;

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);

		if($questao) {
			foreach($questao as $chave => $valor) {
				$data[$chave] = $valor;
			}

			$data['URL_LIBERAR'] = site_url('painel/Acompanhamento/liberarQuestao/'.$questao->id);

			// Busca as opcoes de resposta da questao
			$respostas = $this->PadraoM->fmSearch($this->tabela_resposta, 'qrordem', array('idquestao' => $questao->id));

			$data['COUNT_RESPOSTAS'] = $respostas ? count($respostas) : 0;

			if ($respostas) {
				foreach ($respostas as $r) {
					$data['RESPOSTAS'][] = array(
						'id'        => $r->id,
						'qrordem'   => $r->qrordem,
						'qrtexto'   => $r->qrtexto,
						'qrimg'     => $r->qrimg
					);
				}
			}
		}

		$this->parser->parse('painel/questoes', $data);
	}


	public function liberarQuestao($id){
		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, ['id' => $id], TRUE);

		$itens['quesituacao'] = 1;
		$itens['quedtliberacao'] = date("Y-m-d H:i:s");
		$itens['quedtlimite'] = date("Y-m-d H:i:s", strtotime($itens['quedtliberacao']) + $questao->quetempo);

		$res = $this->PadraoM->fmUpdate($this->tabela_questao, ['id' => $id], $itens);

		redirect('painel/Acompanhamento/questao/'.$questao->queordem);
	}

	public function ranking(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		
		// ******************************************
		// Buscar equipes somando pontos e tempo
		// ******************************************

		$res = $this->PadraoM->fmSearch($this->tabela_equipe, 'equnome', array('idevento' => $this->session->userdata('quiz_ideventoativo')));
		
		if($res){
			foreach($res as $index => $r){
				$data['EQUIPES'][$index] = array(
					'id'        => $r->id,
					'posicao' 	=> ($index + 1),
					'equnome'   => $r->equnome,
					'equlogo'   => $r->equlogo
				);
			}
		}

		$this->parser->parse('painel/ranking', $data);
	}
}
