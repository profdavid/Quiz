<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $tabela ='campus';
		
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('America/Sao_Paulo');
		
		$this->layout = LAYOUT_LOGIN;
		$this->load->model('/Padrao_Model', 'PadraoM');
		$this->load->model('/LogSistema_Model', 'LogM');
	}
	
	public function index(){
		$data = array();
		$data['RES_MSG'] = $this->session->flashdata('resmsg');
		$data['URL_ACAO'] = site_url('Login/login');
		$this->parser->parse('login', $data);
	}
	
	public function login(){
		//Setando variáveis
		$login = $this->input->post('login');
		$senha = $this->input->post('senha');

		//Buscando dados no Banco
		$res = $this->PadraoM->fmSearchQuery("SELECT * FROM campus WHERE camlogin = '".$login."'", TRUE);

		if($res){
			if (password_verify($senha, $res->camsenha)) {
				$this->session->set_userdata('cpi_logado', TRUE);
				$this->session->set_userdata('cpi_idcampus', $res->id);
				$this->session->set_userdata('cpi_camnome', $res->camnome);

				//--- Grava Log ---
				$log = "Login | Id: ".$this->session->userdata('cpi_idcampus')." | Nome: ".$this->session->userdata('cpi_camnome');
				$itens_log = array('logtexto' => $log,'idcampus' => $this->session->userdata('cpi_idcampus'));
				$res_log = $this->LogM->fmNew($itens_log);
				//--- Fim Log ---

				redirect('Home');
			}
			else{
				$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Problemas no acesso!', 'Senha incorreta.'));
				redirect('Login');
			}
		}
		else{
			$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Problemas no acesso!', 'Login inexistente.'));
			redirect('Login');
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('cpi_logado');
		$this->session->unset_userdata('cpi_idcampus');
		$this->session->unset_userdata('cpi_camnome');
		
		redirect('Login');
	}

	public function testaEmailRecSenha(){
		$dados = array();

		$data['usunome'] = "Fulano da Silva";
		$data['link'] = "#";

		$this->parser->parse('recsenha-email', $data);
	}

	public function enviarRecSenha(){
		$data = array();

		$email = $this->input->post('recemail');

		if($email){
			//Buscando dados no Banco
			$res = $this->PadraoM->fmSearch($this->tabela, null, ['usuemail' => $email], TRUE);

			if($res){
				//Gerando e atualizando rash da troca de senha
				$this->load->helper('string');
				$randstr = random_string('alnum', 16);
				
				//Gravando hash no campo senha
				$senha = password_hash($randstr, PASSWORD_DEFAULT);

				//Atualizando registro
				$res_id = $this->PadraoM->fmUpdate($this->tabela, ['id' => $res->id], ['ususenha' => $senha]);

				//Enviar e-mail com link para troca de senha
				$this->load->library('email');
		
				$data['usunome'] = $res->usunome;
				$data['link'] = site_url('Login/trocarSenha/'.$res->id.'/'.$randstr);

				$config = array(
				     'mailtype'	=> 'html',
				     'protocol'	=> 'smtp',
				     //'wordwrap'	=> TRUE,
				     'validate'	=> TRUE,
				     'smtp_user'=> 'david@infiniteet.com.br',
				     'smtp_pass'=> 'davidd151181',
				     'smtp_host' => 'mail.infiniteet.com.br',
				     'smtp_port' => '587' //465 ou 587
				);

				$this->email->initialize($config);
				
				$this->email->from("david@infiniteet.com.br", "Concremat");
				$this->email->to($email);
				
				$this->email->subject('Redefinir Senha - Concremat');

		        $this->email->message($this->load->view('recsenha-email', $data, TRUE));

				if($this->email->send()){
					$this->session->set_flashdata('resmsg', fazAlerta('success', 'Sucesso!', 'Foi enviado um e-mail com um link para a recuperação da senha.'));
				}
				else{
					// $this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'Erro ao enviar e-mail.'));
					
					//Alerta teste com link para troca de senha
					$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'Erro ao enviar e-mail.'));
				}
			}
			else{
				$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'O e-mail digitado <b>'.$email.'</b> não está cadastrado.'));
			}
		}
		else{
			$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'Digite o e-mail de sua conta para recuperar a sua senha.'));
		}

		redirect('Login');
	}

	public function trocarSenha($idusuario, $hash){
		$data = array();
		$data['URL_FRM_CAD'] = site_url('Login/atualizarSenha');
		$data['idusuario'] = $idusuario;
		$data['hash'] = $hash;

		//Verificando aluno e hash
		$res = $this->PadraoM->fmSearch($this->tabela, null, array('id' => $idusuario), TRUE);

		if(!$res || !password_verify($hash, $res->ususenha)){
			$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'Não é possível alterar sua senha.'));

			redirect('Login');
			exit;
		}

		$data['usuemail'] = $res->usuemail;

		$this->parser->parse('recsenha-novasenha', $data);
	}

	public function atualizarRecSenha(){
		$frm = $this->input->post();

		//Verificando aluno e hash
		$res = $this->PadraoM->fmSearch($this->tabela, null, array('id' => $frm['idusuario']), TRUE);

		if($res && password_verify($frm['hash'], $res->ususenha)){
			//Trata senha
			if($frm['senha']) $itens['ususenha'] = password_hash($frm['senha'], PASSWORD_DEFAULT);

			//Atualizando registro
			$cond = array('id' => $frm['idusuario']);
			$res_id = $this->PadraoM->fmUpdate($this->tabela, $cond, $itens);

			//Se dados salvos no BD com sucesso
			if($res_id){
				$this->session->set_flashdata('resmsg', fazAlerta('success', 'Sucesso!', 'Senha alterada com sucesso!'));
				
				//--- Grava Log ---
				$log = "Recuperação/Alteração de senha ".$this->tabela." | Id: ".$res_id;
				$log .= " | Valores: ";
				foreach($itens as $key => $val)
					$log .= $key."=".$val.", ";
				$itens_log = array('logtexto' => $log,'idusuario' => $frm['idusuario']);
				$res_log = $this->LogM->fmNew($itens_log);
				//--- Fim Log ---
			}
			//Se dados NÃO salvos com sucesso
			else{
				$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'Erro ao realizar o cadastro.<br>Digite seus dados novamente.'));
			}
		}
		else{
			$this->session->set_flashdata('resmsg', fazAlerta('danger', 'Erro!', 'Não é possível alterar sua senha.'));
		}

		//Redireciona
		redirect('Login');
	}
}