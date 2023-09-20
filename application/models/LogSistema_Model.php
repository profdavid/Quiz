<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogSistema_Model extends CI_Model {
	private $tabela = 'log', $campoid = 'logid';
	
	public function fmNew($arr){
		//$this->db->set('criado_em', 'NOW()', FALSE);
		$res = $this->db->insert($this->tabela, $arr);
		
		if($res)
			return $this->db->insert_id();
		else
			return FALSE;
	}
	
	public function fmSearch($order = null, $condicao = array(), $primeiralinha = FALSE){
		$this->db->select('*');
		$this->db->from($this->tabela);
		$this->db->where($condicao);
		$this->db->order_by($order);
		
		$qry = $this->db->get();
		
		if($qry->num_rows() > 0){
			if($primeiralinha) 
				return $qry->first_row();
			else
				return $qry->result();
		}
		else return FALSE;
	}
}