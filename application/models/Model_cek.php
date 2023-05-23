<?php 
	class Model_cek extends CI_model{
		
		function sum_detail_konsumen($where){
			$this->db->select('`konsumen`.`max_utang`,
			`konsumen`.`status` AS statusutang,
			`invoice`.`oto`,
			`invoice`.`id_invoice`,
			`invoice`.`tgl_trx`,
			`invoice`.`total_bayar`,
			`invoice`.`status`,
			`konsumen`.`nama`,
			round(SUM((`invoice_detail`.`jumlah`*`invoice_detail`.`harga`) - (`invoice_detail`.`jumlah`*`invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))) AS total');
			$this->db->from('invoice');
			$this->db->join('invoice_detail','`invoice`.`id_invoice` = `invoice_detail`.`id_invoice`');
			$this->db->join('konsumen','`invoice`.`id_konsumen` = `konsumen`.`id`');
			$this->db->where($where);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result;
		}
		
		function sum_detail($where){
			$this->db->select('round(SUM((`invoice_detail`.`jumlah`*`invoice_detail`.`harga`) - (`invoice_detail`.`jumlah`*`invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))) AS total');
			$this->db->from('invoice_detail');
			$this->db->where($where);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result;
		}
		function sum_bayar_konsumen($where){
			$this->db->select('SUM(`bayar_invoice_detail`.`jml_bayar`) AS `total`');
			$this->db->from('konsumen');
			$this->db->join('invoice','`konsumen`.`id` = `invoice`.`id_konsumen`');
			$this->db->join('bayar_invoice_detail','`invoice`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`');
			$this->db->where($where);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result;
		}
		
		function sum_bayar($where){
			$this->db->select('SUM(`jml_bayar`) AS `total`');
			$this->db->from('bayar_invoice_detail');
			$this->db->where($where);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result;
		}
		
		function sum_pengeluaran($where){
			$this->db->select('SUM(`jml_bayar`) AS `total`');
			$this->db->from('bayar_pengeluaran');
			$this->db->where($where);
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result;
		}
		
		function cek_akses($idedit,$id_user){
			$this->db->select('type_akses');
			$this->db->where("FIND_IN_SET('$idedit', CONCAT(type_akses, ',')) AND id_user=".$id_user);
			$query = $this->db->get('tb_users'); 
			return $query;
		}
		function cek_crud($idakses=''){
			$this->db->where("FIND_IN_SET('$idakses', CONCAT(type_akses, ',')) AND id_user=".$this->session->idu);
			$query = $this->db->get('tb_users'); 
			return $query;
		}
	}
