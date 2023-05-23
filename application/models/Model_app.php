<?php 
	class Model_app extends CI_model{
		function import_produk($data)
		{
			if($this->db->insert_batch('produk', $data,1000)){
				return true;
				}else{
				return false;
			}
		}
		
		function import_kategori($data)
		{
			if($this->db->insert_batch('jenis_cetakan', $data,1000)){
				return true;
				}else{
				return false;
			}
		}
		
		function import_bahan($data)
		{
			if($this->db->insert_batch('bahan', $data,1000)){
				return true;
				}else{
				return false;
			}
		}
		function import_satuan($data)
		{
			if($this->db->insert_batch('satuan', $data,1000)){
				return true;
				}else{
				return false;
			}
		}
		public function pilih($pilih,$table){
			$this->db->select($pilih);
			return $this->db->get($table);
		}
		
		public function pilih_where($select,$table,$data){
			$this->db->select($select);
			$this->db->where($data);
			return $this->db->get($table);
		}
		
        public function hapus($table, $where){
            if($this->db->delete($table, $where))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
			}
            return $arr;
		}
        public function input($table,$data){
            if($this->db->insert($table, $data))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                $arr['id'] = $this->db->insert_id();
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
                $arr['id'] =  "";
			}
			
            return $arr;
		}
		
		public function input_tr($table,$data){
			$this->db->trans_begin();
            $this->db->insert($table, $data);
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$arr['status'] =  "error";
                $arr['msg'] =  "Gagal input data";
                $arr['id'] =  "";
			}
			else
			{
				$this->db->trans_commit();
				$arr['status'] =  "ok";
                $arr['msg'] =  "Input berhasil";
                $arr['id'] = $this->db->insert_id();
			}
			
            return $arr;
		}
		public function update($table, $data, $where){
            if($this->db->update($table, $data, $where))
            {
                $arr['status'] =  "ok";
                $arr['msg'] =  "Update berhasil";
                $arr['id'] = "";
                }else{
                $arr['status'] =  "error";
                $arr['msg'] =  "Gagal Update data";
                $arr['id'] =  "";
			}
			
            return $arr;
		}
		
		public function update_tr($table, $data, $where){
			$this->db->trans_begin();
            $this->db->update($table, $data, $where);
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$arr['status'] =  "error";
                $arr['msg'] =  "Gagal update data";
			}
			else
			{
				$this->db->trans_commit();
				$arr['status'] =  "ok";
                $arr['msg'] =  "update berhasil";
			}
            return $arr;
		}
		
		public function view($table){
			$query = $this->db->get($table);
			if($query->num_rows() > 0){
				return $query->result_array(); 
			}
		}
		public function views($table){
			return $this->db->get($table);
		}
		
		public function insert($table,$data){
			return $this->db->insert($table, $data);
		}
		public function edits($table, $data){
			$query = $this->db->get_where($table, $data);
			if($query->num_rows() > 0){
				return $query->row_array(); 
			}
		}
		public function edit($table, $data){
			return $this->db->get_where($table, $data);
		}
		
		public function delete($table, $where){
			return $this->db->delete($table, $where);
		}
		public function hapuss($table, $id){
			$this->db->where(str_replace('tbl_', '', $table).'_id', $id);
			return $this->db->delete($table);
		}
		
		public function view_wherein($data){
			$this->db->where_in($data);
			return $this->db->get('bahan');
		}
		public function view_where($table,$data){
			$this->db->where($data);
			return $this->db->get($table);
		}
		
		public function view_where_like($table,$where,$data,$before){
			$this->db->like($where,$data,$before);
			return $this->db->get($table);
		}
		public function view_where_or_like($table,$where,$like,$or_like){
			$this->db->where($where);
			$this->db->like($like);
			$this->db->or_like($or_like);
			return $this->db->get($table);
		}
		public function view_where_not_like($table,$where,$not_like,$or_not_like){
			$this->db->where($where);
			$this->db->not_like($not_like);
			$this->db->not_like($or_not_like);
			return $this->db->get($table);
		}
		public function view_select_where($select,$table,$data){
			$this->db->select($select);
			$this->db->where($data);
			return $this->db->get($table);
		}
		public function view_where_in($table,$baris,$data){
			
			$this->db->where_in($baris,$data);
			return $this->db->get($table);
		}
		public function view_like($table,$data){
			$this->db->like($data);
			return $this->db->get($table);
		}
		public function view_or_like($table,$data,$data1,$data2){
			$this->db->like($data);
			$this->db->or_like($data1);
			$this->db->or_like($data2);
			return $this->db->get($table);
		}
		
		public function view_like_group($table,$data,$group){
			$this->db->like($data);
			$this->db->group_by($group);
			return $this->db->get($table);
		}
		
		public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
			$this->db->select('*');
			$this->db->order_by($order,$ordering);
			$this->db->limit($dari, $baris);
			return $this->db->get($table);
		}
		public function view_where_ordering_limit($table,$data,$order,$ordering,$baris){
			$this->db->where($data);
			$this->db->order_by($order,$ordering);
			$this->db->limit($baris);
			// return $this->db->get($table)->result_array();
			return $this->db->get($table);
		}
		public function view_ordering($table,$order,$ordering){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->order_by($order,$ordering);
			return $this->db->get()->result_array();
		}
		
		public function view_where_ordering($table,$data,$order,$ordering){
			$this->db->where($data);
			$this->db->order_by($order,$ordering);
			return $this->db->get($table);
		}
		
		public function view_join_one($table1,$table2,$field,$order,$ordering){
			$this->db->select('*');
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
			$this->db->order_by($order,$ordering);
			return $this->db->get()->result_array();
		}
		public function view_join_where_ordering($select,$table1,$table2,$field1,$field2,$where,$order,$ordering){
			$this->db->select($select);
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
			$this->db->where($where);
			$this->db->order_by($order,$ordering);
			return $this->db->get();
		}
		public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
			$this->db->select('*');
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
			$this->db->where($where);
			$this->db->order_by($order,$ordering);
			return $this->db->get()->result_array();
		}
		public function join_where($select,$table1,$table2,$field1,$field2,$where){
			$this->db->select($select);
			$this->db->from($table1);
			$this->db->join($table2, $table1.'.'.$field1.'='.$table2.'.'.$field2);
			$this->db->where($where);
			return $this->db->get();
		}
		public function pilih_1($table,$where){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($where);
			return $this->db->get()->result_array();
		}
		public function pilih_max($max,$table,$where){
			$this->db->select_max($max);
			$this->db->from($table);
			$this->db->where($where);
			return $this->db->get()->row()->$max;
		}
		public function diskon($table,$where){
			$this->db->select('SUM(`bayar_invoice_detail`.`jml_bayar`) AS `totbayar`,`bayar_invoice_detail`.`jdiskon`');
			// $this->db->from($table);
			$this->db->where($where);
			$this->db->group_by('`bayar_invoice_detail`.`jdiskon`');
			return $this->db->get($table);
			// return $this->db->get()->result_array();
		}
		public function total_bayar($where){
			$this->db->select('SUM(`bayar_invoice_detail`.`jml_bayar`) AS `total`');
			$this->db->where($where);
			return $this->db->get('bayar_invoice_detail');	
		}
		
		public function total_saldo($where){
			$this->db->select_sum('pemasukan');
			$this->db->where($where);
			return $this->db->get('kas_masuk');	
		}
		public function cara_bayar($where){
			$this->db->select('`jenis_bayar`.`nama_bayar`');
			$this->db->from('jenis_bayar');
			$this->db->join('bayar_invoice_detail', '`jenis_bayar`.`id` = `bayar_invoice_detail`.`id_bayar`');
			$this->db->join('invoice', '`bayar_invoice_detail`.`id_invoice` = `invoice`.`id_invoice`');
			$this->db->where($where);
			return $this->db->get()->row();
		}
		/*SELECT 
			`bayar_invoice_detail`.`tgl_bayar`,
			`bayar_invoice_detail`.`jml_bayar`,
			`invoice`.`oto`
			FROM
			`invoice`
			INNER JOIN `bayar_invoice_detail` ON (`invoice`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`)
			WHERE
		`bayar_invoice_detail`.`id_invoice` = 5*/
		public function list_bayar($where){
			$this->db->select('`bayar_invoice_detail`.`tgl_bayar`,
			`bayar_invoice_detail`.`jml_bayar`,
			`invoice`.`oto`');
			$this->db->from('invoice');
			$this->db->join('bayar_invoice_detail', '`invoice`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`');
			$this->db->where($where);
			return $this->db->get()->row();
		}
		public function cek_total_invoice($where){
			$this->db->select('total_bayar');
			$this->db->where($where);
			return $this->db->get('invoice');
		}
		public function cek_total_detail($select,$where){
			$this->db->select('SUM(jumlah * harga) AS `total`');
			$this->db->where($where);
			return $this->db->get('invoice_detail');
		}
		public function cek_total($table,$select,$where){
			$this->db->select($select);
			$this->db->from($table);
			$this->db->where($where);
			return $this->db->get()->row();
		}
		public function sum_stok($table,$where){
			$this->db->select('SUM(jumlah) AS `total`');
			$this->db->where($where);
			return $this->db->get($table);
		}
		// public function cek_count($table,$select,$where){
		// $this->db->select($select);
		// $this->db->from($table);
		// $this->db->where($where);
		// // return $this->db->get($table)->row();
		// return $this->db->get()->row();
		// }
		
		public function produk_cart($where){
			$this->db->select('`jenis_cetakan`.`id_jenis`,
			`jenis_cetakan`.`jenis_cetakan` AS jenis,
			`bahan`.`id` AS idbahan,
			`bahan`.`title` AS nbahan,
			`bahan`.`harga` AS harga_dasar,
			`bahan`.`status` AS status_hitung,
			`produk`.`title`,
			`produk`.`id_jenis`,
			`produk`.`id_bahan`,
			`produk`.`id`,
			`invoice`.`total_bayar`,
			`invoice`.`tgl_trx`,
			`invoice`.`tgl_ambil`,
			`invoice`.`id_user`,
			`invoice`.`id_marketing`,
			`invoice`.`status`,
			`invoice`.`oto`,
			`invoice_detail`.`id_rincianinvoice`,
			`invoice_detail`.`id_produk`,
			`invoice_detail`.`type_harga`,
			`invoice_detail`.`status_hitung`,
			`invoice_detail`.`jumlah`,
			`invoice_detail`.`keterangan`,
			`invoice_detail`.`harga`,
			`invoice_detail`.`diskon`,
			`invoice_detail`.`satuan`,
			`invoice_detail`.`id_satuan`,
			`invoice_detail`.`ukuran`,
			`invoice_detail`.`tot_ukuran`,
			`invoice_detail`.`uk_real`,
			`invoice_detail`.`detail`,
			`invoice_detail`.`catatan`');
			$this->db->from('invoice');
			$this->db->join('invoice_detail', '`invoice`.`id_invoice` = `invoice_detail`.`id_invoice`');
			$this->db->join('produk', '`invoice_detail`.`id_produk` = `produk`.`id`');
			$this->db->join('jenis_cetakan', '`invoice_detail`.`jenis_cetakan` = `jenis_cetakan`.`id_jenis`');
			$this->db->join('bahan', '`invoice_detail`.`id_bahan` = `bahan`.`id`');
			$this->db->where($where);
			$this->db->order_by('`invoice_detail`.`id_rincianinvoice`','ASC');
			return $this->db->get()->result_array();
		}
		public function pengeluaran_detail($where){
			$this->db->select('`jenis_pengeluaran`.`title`,
			`pengeluaran_detail`.`no`,
			`pengeluaran_detail`.`id_pengeluaran`,
			`pengeluaran_detail`.`id_biaya`,
			`pengeluaran_detail`.`id_supplier`,
			`pengeluaran_detail`.`no_invo`,
			`pengeluaran_detail`.`keterangan`,
			`pengeluaran_detail`.`jumlah`,
			`pengeluaran_detail`.`harga`,
			`pengeluaran_detail`.`satuan`,
			`pengeluaran_detail`.`id_pemesan`,
			`pengeluaran_detail`.`no_order`,
			`jenis_pengeluaran`.`id_jenis`,
			`supplier`.`id_supplier`,
			`supplier`.`nama_perusahaan`
			');
			$this->db->from('jenis_pengeluaran');
			$this->db->join('pengeluaran_detail', '`jenis_pengeluaran`.`id_jenis` = `pengeluaran_detail`.`id_biaya`');
			$this->db->join('supplier', '`supplier`.`id_supplier` = `pengeluaran_detail`.`id_supplier`');
			$this->db->where($where);
			return $this->db->get();
			// return $this->db->get()->result_array();
		}
		public function pembelian_detail($where){
			$this->db->select('`jenis_pengeluaran`.`title`,
			`pembelian_detail`.`no`,
			`pembelian_detail`.`id_pembelian`,
			`pembelian_detail`.`id_bahan`,
			`pembelian_detail`.`id_biaya`,
			`pembelian_detail`.`id_supplier`,
			`pembelian_detail`.`no_invo`,
			`pembelian_detail`.`keterangan`,
			`pembelian_detail`.`jumlah`,
			`pembelian_detail`.`harga`,
			`pembelian_detail`.`satuan`,
			`pembelian_detail`.`id_pemesan`,
			`pembelian_detail`.`no_order`,
			`bahan`.`title` AS nama_bahan,
			`jenis_pengeluaran`.`id_jenis`,
			`supplier`.`id_supplier`,
			`supplier`.`nama_perusahaan`
			');
			$this->db->from('jenis_pengeluaran');
			$this->db->join('pembelian_detail', '`jenis_pengeluaran`.`id_jenis` = `pembelian_detail`.`id_biaya`');
			$this->db->join('bahan', '`bahan`.`id` = `pembelian_detail`.`id_bahan`');
			$this->db->join('supplier', '`supplier`.`id_supplier` = `pembelian_detail`.`id_supplier`');
			$this->db->where($where);
			return $this->db->get();
			// return $this->db->get()->result_array();
		}
		public function cek_login($username,$password,$table){
			return $this->db->query("SELECT * FROM $table where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."' AND aktif='Y'");
		}
		
		public function cek_user($username){
			return $this->db->query("SELECT * FROM tb_users where email='".$this->db->escape_str($username)."' AND aktif='Y'");
		}
		
		public function sum_data($strsum,$table,$where){
			$this->db->select_sum($strsum);
			$this->db->where($where);
			$query = $this->db->get($table);  
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result->$strsum;
		}
		public function sum_data_group($strsum,$table,$where,$group){
			$this->db->select_sum($strsum);
			$this->db->where($where);
			$this->db->group_by($group);
			$query = $this->db->get($table);  
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result->$strsum;
		}
		
		public function sum_data_math($strsum,$table,$where,$group){
			$this->db->select($strsum);
			$this->db->where($where);
			$this->db->group_by($group);
			$query = $this->db->get($table);  
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result->total;
		}
		public function counter($table,$params=array()){
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
					} 
			}
			
			if(array_key_exists("search", $params))
			{
				if(!empty($params['search']['level'])){ 
					$this->db->where("level !='{$params['search']['level']}'"); 
				} 
				 
			} 
			
			$result = $this->db->count_all_results($table);
			return $result; 
			
		}
		
		public function find_akses($id){
            $this->db->select('*');
            $this->db->from('type_akses');
            $this->db->where_in('id', $id);
            return $this->db->get();
		}	
		public function jurnal_input($data){
            if($this->db->insert('jurnal_transaksi', $data))
            {
                $arr['status'] =true;
                $arr['msg'] =  "Input berhasil";
                $arr['id'] = $this->db->insert_id();
                }else{
                $arr['status'] = false;
                $arr['msg'] =  "Gagal input data";
                $arr['id'] =  "";
			}
			
            return $arr;
		}
	}																						