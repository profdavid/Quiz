<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TesteDB_Model extends CI_Model {
	private $banco;

	public function __construct(){
		$this->banco = $this->load->database('athenas', true);
	}

	public function selecionar($tabela){
		$this->banco->select('*');
		$this->banco->from($tabela);

		$qry = $this->banco->get();
		return $qry->result();
	}
}