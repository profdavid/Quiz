<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacao extends CI_Controller {
	private $tabela_evento = 'evento';

	public function __construct(){
		parent::__construct();

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_RELATORIO;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}

	
	public function index(){}


	public function enviar(){
		$data = array();
		$idevento = $this->session->userdata('quiz_ideventoativo');
		$userEmail = $this->session->userdata('quiz_usuemail');
		
		$query = "
			SELECT 
				eve.evenome,
				COUNT(DISTINCT que.id) AS total_questoes,
				COUNT(DISTINCT equ.id) AS total_equipes,
				GROUP_CONCAT(DISTINCT equ.equnome SEPARATOR ', ') AS equipes
			FROM evento eve
			LEFT JOIN questao que ON que.idevento = eve.id
			LEFT JOIN equipe equ ON equ.idevento = eve.id
			WHERE eve.id = $idevento
			GROUP BY eve.id
		";
		
		$info = $this->PadraoM->fmSearchQuery($query);

		if($info){
			$data = $info[0];
			$this->load->library('email');

			$config = array(
				'mailtype'  => 'html',
				'protocol'  => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_user' => 'ifesquiz@gmail.com',
				'smtp_pass' => '',
				'smtp_port' => 587,
				'smtp_timeout'	=> 10,
				'smtp_crypto' => 'tls',
				'charset'   => 'utf-8',
				'wordwrap'  => TRUE,
				'newline'   => "\r\n"
			);

			$this->email->initialize($config);

			if($userEmail){
				$this->email->from("ifesquiz@gmail.com", "Quiz IFES");
				$this->email->to($userEmail);

				$this->email->subject($info[0]->evenome.' - Detalhes do evento');
				$this->email->message($this->load->view('painel/notificacao-email', $data, TRUE));

				if ($this->email->send()) {
					$this->session->set_flashdata('resok', fazNotificacao('success', 'Sucesso! E-mail enviado.'));
				}
				else {
					$this->session->set_flashdata('reserro', fazAlerta('danger', 'Erro!', 'Erro ao enviar e-mail.'));
				}

				redirect('painel/Home');
			}
		}
	}


	public function automatico(){}


}