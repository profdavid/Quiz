<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Padrao_Model extends CI_Model {
		
	public function fmNew($tabela, $arr){
		$res = $this->db->insert($tabela, $arr);

		// echo $this->db->last_query();
		// exit;
		
		if($res)
			return $this->db->insert_id();
		else
			return FALSE;
	}
	
	public function fmUpdate($tabela, $cond, $arr){
		$this->db->where($cond);	
		$res = $this->db->update($tabela, $arr);

		// echo $this->db->last_query();
		// exit;

		$arr = array_values($cond);
		
		if($res)
			return $arr[0];
		else
			return FALSE;
	}

	public function fmUpdateIncrement($tabela, $cond, $campo){
		$this->db->set($campo, $campo.'+1', FALSE);
		$this->db->where($cond);
		$res = $this->db->update($tabela);

		// echo $this->db->last_query();
		// exit;

		$arr = array_values($cond);
		
		if($res)
			return $arr[0];
		else
			return FALSE;
	}

	public function fmUpdateIncrementCount($tabela, $ids, $campo) {
        if (empty($ids) || !is_array($ids))
            return false;

		$count = 1;

        $this->db->trans_start();
        foreach ($ids as $id) {
            $this->db->set($campo, $count, FALSE);
            $this->db->where('id', $id);
            $this->db->update($tabela);
			$count++;
        }
        $this->db->trans_complete();
		
		return $this->db->trans_status();
    }
	
	public function fmDelete($tabela, $cond){
		$this->db->where($cond, FALSE);
		return $this->db->delete($tabela);
	}
	
	public function fmDeleteIn($tabela, $ids){
		$this->db->where_in('id', $ids, FALSE);
		return $this->db->delete($tabela);
	}

	public function fmDeleteNotIn($tabela, $ids){
		$this->db->where_not_in('id', $ids, FALSE);
		return $this->db->delete($tabela);
	}

	public function fmDeleteNotInWithCond($tabela, $cond, $ids){
		$this->db->where($cond);
		$this->db->where_not_in('id', $ids, FALSE);
		return $this->db->delete($tabela);
	}

	public function fmDeleteNotInCampo($tabela, $campo, $ids){
		$this->db->where_not_in($campo, $ids, FALSE);
		return $this->db->delete($tabela);
	}
	
	public function fmSearch($tabela, $order = null, $cond = array(), $primeiralinha = FALSE){
		$this->db->select('*');
		$this->db->from($tabela);
		$this->db->where($cond);
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
	
	public function fmSearchQuery($sql, $primeiralinha = FALSE){
		$qry = $this->db->query($sql);
		
		if($qry->num_rows() > 0){
			if($primeiralinha) 
				return $qry->first_row();
			else
				return $qry->result();
		}
		else return FALSE;
	}

	public function fmSearchIn($tabela, $order = null, $ids){
		$this->db->select('*');
		$this->db->from($tabela);
		$this->db->where_in('id', $ids);
		$this->db->order_by($order);
		
		$qry = $this->db->get();
		
		if($qry->num_rows() > 0){
			return $qry->result();
		}
		else return FALSE;
	}

	public function fmExecQuery($sql){
		return $this->db->query($sql);
	}

}