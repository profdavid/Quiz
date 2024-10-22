<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acompanhamento extends CI_Controller {
	private $tabela_evento ='evento';
	private $tabela_equipe ='equipe';
	private $tabela_questao ='questao';
	private $tabela_questaoresposta ='questaoresposta';
	private $tabela_equipe_questaoresposta ='equipe_questaoresposta';
		
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('quiz_logado')) redirect('painel/Login');

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_PAINEL;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}

	public function index(){
		redirect('painel/Acompanhamento/questao/1');
	}

	public function questao($queordem, $showResults = false){
		$data = array();
		$data['id'] = null;
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['URL_ATUAL'] = site_url('painel/Acompanhamento/questao/'.$queordem);
		$data['URL_ANTERIOR'] = site_url('painel/Acompanhamento/questao/'.($queordem - 1));
		$data['URL_PROXIMO'] = site_url('painel/Acompanhamento/questao/'.($queordem + 1));
		$data['RESPOSTAS'] = [];
		$data['RESULTS'] = [];
		$data['COUNT_QUESTOES'] = 0;
		$data['COUNT_RESPOSTAS'] = 0;
		$data['SHOW_RESULTS'] = $showResults;
		
		$ideventoativo = $this->session->userdata('quiz_ideventoativo');

		// Busca todas as questoes
		$quetotal = $this->PadraoM->fmSearch($this->tabela_questao, 'queordem', ['idevento' => $ideventoativo], FALSE);
		if($quetotal) {
			foreach ($quetotal as $q) {
				$data['QUESTOES'][] = array(
					'queid'      => $q->id,
					'queordem'   => $q->queordem,
					'LIBERADA'	 => ($q->quesituacao == '1' && $q->queordem != $queordem) ? 'background-color: #28A74520' : '',
					'ACTIVE'	 => ($q->queordem == $queordem) ? 'active' : '',
					'URL_ACCESS' => site_url('painel/Acompanhamento/questao/'.$q->queordem)
				);
			}
			$data['COUNT_QUESTOES'] = count($quetotal);
		}

		// Busca a ordem desejada
		$cond['idevento'] = $ideventoativo;
		$cond['queordem'] = $queordem;

		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, $cond, TRUE);

		if($questao) {
			foreach($questao as $chave => $valor) {
				$data[$chave] = $valor;
			}

			$data['URL_ATUALIZACOES'] = site_url('painel/Acompanhamento/buscaAtualizacoes/'.$questao->id);
			$data['URL_LIBERAR'] = site_url('painel/Acompanhamento/liberarQuestao/'.$questao->id);
			$data['SITUACAO'] = ($questao->quesituacao == 0) ? 'Não liberada' : 'Liberada';
			$data['LIBERADA'] = ($questao->quesituacao == 0) ? 'dark' : 'success';

			// Tratamento do countdown
			$tempoAtual = date("Y-m-d H:i:s");

			if (!$questao->quedtliberacao) {
				$data['tempoRestante'] = -1;
			} else if ($tempoAtual >= $questao->quedtlimite) {
				$data['tempoRestante'] = 0;
			} else {
				$atualTime = strtotime($tempoAtual);
				$limiteTime = strtotime($questao->quedtlimite);
				$data['tempoRestante'] = $limiteTime - $atualTime;
			}

			// Busca as alternativas
			$respostas = $this->PadraoM->fmSearch($this->tabela_questaoresposta, 'qrordem', ['idquestao' => $questao->id]);

			if ($respostas) {
				foreach ($respostas as $r) {
					if($r->qrcorreta){
						$data['CORRETA_qrordem'] = $r->qrordem;
						$data['CORRETA_qrtexto'] = $r->qrtexto;
						$data['CORRETA_qrimg'] = $r->qrimg;
					}

					$data['RESPOSTAS'][] = array(
						'id'        => $r->id,
						'qrordem'   => $r->qrordem,
						'qrtexto'   => $r->qrtexto,
						'qrcorreta' => $r->qrcorreta,
						'qrimg'     => $r->qrimg,
						'SEM_IMAGEM' => (!$r->qrimg) ? 'd-none' : ''
					);
				}
				$data['COUNT_RESPOSTAS'] = count($respostas);
			}

			//Busca os resultados
			if ($showResults) {
				$data['RESULTS'] = ($questao->idquestaotipo == 1) 
					? $this->fetchResultsObjetiva($questao, $data['CORRETA_qrordem'])
					: $this->fetchResultsDiscursiva($questao);
			}
		}

		$this->parser->parse('painel/acompanhamento', $data);
	}


	public function fetchResultsObjetiva($questao, $qrordemCorreta){
		$resultsObjetiva = [];

		$query = "
			SELECT e.equnome, q.queordem, qr.qrordem, eqr.eqrponto, eqr.eqrtempo
			FROM equipe_questaoresposta eqr
			JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON qr.idquestao = q.id
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE q.id = $questao->id
			ORDER BY eqr.eqrtempo DESC;
		";

		$results = $this->PadraoM->fmSearchQuery($query);

		if($results) {
			foreach ($results as $index => $result) {
				if($result->qrordem == $qrordemCorreta){
					$COR_EQRSITUACAO = 'bg-success-50';

					if($result->eqrtempo > $questao->quetempo){
						$COR_EQRSITUACAO = 'bg-warning-50';
					}
				} else {
					$COR_EQRSITUACAO = 'bg-danger-50';
				}

				$resultsObjetiva[] = array(
					'ordem'		=> $index + 1,
					'equnome'   => $result->equnome,
					'queordem'   => $result->queordem,
					'qrordem'   => $result->qrordem,
					'eqrponto'   => $result->eqrponto,
					'eqrtempo'     => $result->eqrtempo,
					'COR_EQRSITUACAO' => $COR_EQRSITUACAO
				);
			}
		}

		return $resultsObjetiva;
	}


	public function fetchResultsDiscursiva($questao){
		$resultsDiscursiva = [];

		$query = "
			SELECT e.equnome, q.queordem, q.queponto, eqr.*
			FROM equipe_questaoresposta eqr
			JOIN questao q ON eqr.idquestao = q.id
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE q.id = $questao->id
			ORDER BY eqr.eqrtempo DESC;
		";

		$results = $this->PadraoM->fmSearchQuery($query);

		if($results) {
			foreach ($results as $index => $result) {
				$resultsDiscursiva[] = array(
					'ordem'		 => $index + 1,
					'equnome'    => $result->equnome,
					'queordem'   => $result->queordem,
					'eqrdiscursiva' => $result->eqrdiscursiva,
					'eqrponto'   => $result->eqrponto,
					'eqrtempo'   => $result->eqrtempo,
					'COR_EQRSITUACAO' 	=> ($result->eqrponto > 0) ? 'bg-success-50' : 'bg-danger-50',
					'URL_CORRECAO_CERTA' => site_url(
						'painel/Acompanhamento/corrigirDiscursiva/'.$result->idequipe.'/'.$result->idquestao.'/'.$result->queordem.'/'.$result->queponto
					),
					'URL_CORRECAO_ERRADA' => site_url(
						'painel/Acompanhamento/corrigirDiscursiva/'.$result->idequipe.'/'.$result->idquestao.'/'.$result->queordem.'/0'
					),
				);
			}
		}

		return $resultsDiscursiva;
	}


	function corrigirDiscursiva($idequipe, $idquestao, $queordem, $queponto) {
		$eqrponto = intval($queponto);
		$itens['eqrponto'] = $eqrponto;

		$cond = [
			'idequipe' => $idequipe,
			'idquestao' => $idquestao,
		];

		$res = $this->PadraoM->fmUpdate($this->tabela_equipe_questaoresposta, $cond, $itens);

		if($res) {
			$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! Questão corrigida.'));
		}
		else {
			$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Problemas ao corrigir.'));
		}

		redirect('painel/Acompanhamento/questao/'.$queordem.'/true');
	}


	public function liberarQuestao($id){
		$questao = $this->PadraoM->fmSearch($this->tabela_questao, NULL, ['id' => $id], TRUE);
		
		$itens['quesituacao'] = 1;
		$itens['quedtliberacao'] = date("Y-m-d H:i:s");
		$itens['quedtlimite'] = date("Y-m-d H:i:s", strtotime($itens['quedtliberacao']) + $questao->quetempo);

		$res = $this->PadraoM->fmUpdate($this->tabela_questao, ['id' => $id], $itens);

		redirect('painel/Acompanhamento/questao/'.$questao->queordem);
	}


	public function buscaAtualizacoes($idquestao) {
		$ideventoativo = $this->session->userdata('quiz_ideventoativo');

		$query = "
			SELECT DISTINCT e.equnome, eqr.criado_em
			FROM equipe_questaoresposta eqr
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE eqr.idquestao = $idquestao
			ORDER BY eqr.criado_em DESC
		";

		$envios = $this->PadraoM->fmSearchQuery($query);

		$equipes = $this->PadraoM->fmSearch($this->tabela_equipe, NULL, ['idevento' => $ideventoativo], FALSE);

		$todosEnviaram = (count($envios) >= count($equipes)) ? true : false;

		$resultado = [
			'envios' => $envios,
			'todosEnviaram' => $todosEnviaram
		];

		echo json_encode($resultado);

		exit;
	}


	public function ranking(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$idevento = $this->session->userdata('quiz_ideventoativo');

		$query = "
			SELECT
				e.equnome,
				e.id AS idequipe,
				IFNULL(SUM(eqr.eqrponto), 0) AS total_eqrponto,
				IFNULL(SUM(eqr.eqrtempo), 0) AS total_eqrtempo,
				e.equlogo
			FROM equipe e
			LEFT JOIN equipe_questaoresposta eqr ON e.id = eqr.idequipe
			LEFT JOIN questao q ON eqr.idquestao = q.id AND q.idevento = $idevento
			WHERE e.idevento = $idevento
			GROUP BY e.equnome, e.id, e.equlogo
			ORDER BY total_eqrponto DESC, total_eqrtempo ASC;
		";

		$ranking = $this->PadraoM->fmSearchQuery($query);

		if($ranking){
			foreach ($ranking as $indice => $r) {
				$data['EQUIPES'][] = array(
					'ranking'	=> ($indice + 1),
					'id'        => $r->idequipe,
					'pontos'	=> $r->total_eqrponto,
					'tempo'		=> $r->total_eqrtempo,
					'equnome'   => $r->equnome,
					'equlogo'   => $r->equlogo
				);
			}
		}

		$this->parser->parse('painel/ranking', $data);
	}


	public function pontuacao(){
		$data = array();
		$data['RES_ERRO']	= $this->session->flashdata('reserro');
		$data['RES_OK']		= $this->session->flashdata('resok');
		$data['PONTUACAO_EQUIPES'] = [];
		$data['TOTAL_INFOEQUIPE'] = [];
		$idevento = $this->session->userdata('quiz_ideventoativo');

		$query = "
			SELECT e.equnome, q.queordem, q.idquestaotipo, qr.qrordem, eqr.*
			FROM equipe_questaoresposta eqr
			LEFT JOIN questaoresposta qr ON eqr.idquestaoresposta = qr.id
			JOIN questao q ON IFNULL(qr.idquestao, eqr.idquestao) = q.id
			JOIN equipe e ON eqr.idequipe = e.id
			WHERE q.idevento = $idevento
			ORDER BY q.queordem ASC;
		";

		$res = $this->PadraoM->fmSearchQuery($query);

		$questoes = [];
		if($res){
			foreach ($res as $r) {
				$questoes[$r->queordem][] = array(
					'equnome'   => $r->equnome,
					'qrordem'   => $r->qrordem,
					'eqrponto'  => $r->eqrponto,
					'eqrtempo'  => $r->eqrtempo,
					'eqrdiscursiva' => $r->eqrdiscursiva,
					'DISCURSIVA'	=> ($r->idquestaotipo == 1) ? 'd-none' : 'd-block',
					'OBJETIVA'	=> ($r->idquestaotipo == 1) ? 'd-block' : 'd-none'
				);
			}
			
			foreach ($questoes as $queordem => $equipes) {
				$data['PONTUACAO_EQUIPES'][] = array(
					'queordem' => $queordem,
					'equipes'  => $equipes
				);
			}
		}

		$this->parser->parse('painel/pontuacao', $data);
	}
}
