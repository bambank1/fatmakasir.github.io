<?php 
	class Model_data extends CI_model{
		function __construct() { 
			// Set table name 
			$this->table = 'tb_users'; 
			$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		} 
		
		
		function getHarga($params = array()){
			$type_harga = $params['type_harga'];
			$id_bahan = $params['id_bahan'];
			$id_bahan = explode(',', $id_bahan);
			$id_bahan = $id_bahan[0];
			$id_member = $params['id_member'];
			
			if($type_harga==1){
				$sql1 = $this->db->query("SELECT 
				`satuan`.`id` AS idsatuan,
				`satuan`.`satuan`,
				`satu_harga`.`harga_jual`,
				`bahan`.`title`
				FROM
				`bahan`
				INNER JOIN `satu_harga` ON (`bahan`.`id` = `satu_harga`.`id_bahan`)
				INNER JOIN `satuan` ON (`satu_harga`.`id_satuan` = `satuan`.`id`)
				WHERE
				`bahan`.`id` = $id_bahan");
				$harga_jual = $sql1->row()->harga_jual;
				$satuan = $sql1->row()->idsatuan;
				}elseif($type_harga==2){
				$sql2 = $this->db->query("SELECT 
				`satuan`.`id` AS idsatuan,
				`satuan`.`satuan`,
				`harga_satuan`.`id_satuan`,
				`bahan`.`title`,
				`harga_satuan`.`harga_jual`,
				`harga_satuan`.`id_bahan`
				FROM
				`satuan`
				INNER JOIN `harga_satuan` ON (`satuan`.`id` = `harga_satuan`.`id_satuan`)
				INNER JOIN `bahan` ON (`harga_satuan`.`id_bahan` = `bahan`.`id`)
				WHERE
				`harga_satuan`.`id_bahan` = $id_bahan");
				$harga_jual = $sql2->row()->harga_jual;
				$satuan = $sql2->row()->idsatuan;
				}elseif($type_harga==3){
				
				$sql3 = $this->db->query("SELECT 
				`harga_member`.`id_bahan`,
				`harga_member`.`id_satuan`,
				`harga_member`.`id_member`,
				`harga_member`.`harga_jual`
				FROM
				`satuan`
				INNER JOIN `harga_member` ON (`satuan`.`id` = `harga_member`.`id_satuan`)
				INNER JOIN `bahan` ON (`harga_member`.`id_bahan` = `bahan`.`id`)
				INNER JOIN `konsumen` ON (`harga_member`.`id_member` = `konsumen`.`jenis_member`)
				WHERE
				`harga_member`.`id_member` = $id_member AND 
				`harga_member`.`id_bahan` = $id_bahan
				GROUP BY
				`harga_member`.`id_bahan`,
				`harga_member`.`id_satuan`,
				`harga_member`.`id_member`,
				`harga_member`.`harga_jual`");
				
				$harga_jual = $sql3->row()->harga_jual;
				$satuan = $sql3->row()->id_satuan;
				}elseif($type_harga==4){
				$sql = $this->db->query("select id_satuan,harga_jual from range_harga where id_bahan=$id_bahan AND $jumlah between jumlah_minimal and jumlah_maksimal");
				$harga_jual = $sql->row()->harga_jual;
				$satuan = $sql->row()->id_satuan;
				}else{
				$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id_bahan=$id_bahan");
				$harga_jual = $sql->row()->harga_modal;
				$satuan = $sql->row()->id_satuan;
			}
			$data = ['status'=>true,'id_bahan'=>$id_bahan,'title'=>getBahan($id_bahan),'harga'=>$harga_jual,'satuan'=>$satuan];			
			return $data;
		}
		
		function getBahanAjax($searchTerm=""){
			
			// Fetch users
			$this->db->select('*');
			$this->db->where("title like '%".$searchTerm."%' ");
			$fetched_records = $this->db->get('bahan');
			$users = $fetched_records->result_array();
			
			// Initialize Array with fetched data
			$data = array();
			foreach($users as $user){
				$data[] = array("id"=>$user['id'], "text"=>$user['title']);
			}
			return $data;
		}
		
		public function load_cc($ord = "title"){
			$sql = query("SELECT * FROM bahan WHERE status_stok ='Y' ORDER BY $ord");
			return $sql->result();
		}
		
		function detailBayar($params = array()){
			$this->db->select(' 
			`bayar_invoice_detail`.`id_invoice`,
			`konsumen`.`nama`,
			`invoice`.`tgl_trx`,
			`bayar_invoice_detail`.`tgl_bayar`,
			`bayar_invoice_detail`.`jam_bayar`,
			`bayar_invoice_detail`.`jml_bayar`,
			`jenis_bayar`.`nama_bayar`,
			`bayar_invoice_detail`.`id`,
			`bayar_invoice_detail`.`rekap`,
			`bayar_invoice_detail`.`id_bayar`,
			`bayar_invoice_detail`.`lampiran`,
			`bayar_invoice_detail`.`id_sub_bayar`');
			$this->db->from('invoice');
			$this->db->join(
			'bayar_invoice_detail',
			'`invoice`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`',
			'RIGHT outer'
			);
			$this->db->join(
			'jenis_bayar',
			'`bayar_invoice_detail`.`id_bayar` = `jenis_bayar`.`id`',
			'INNER'
			);
			$this->db->join(
			'`konsumen`',
			'`invoice`.`id_konsumen` = `konsumen`.`id`',
			'INNER'
			);
			if (array_key_exists("where", $params)) {
				foreach ($params['where'] as $key => $val) {
					$this->db->where($key, $val);
				}
			}
			if (!empty($params['search']['dari']) and !empty($params['search']['sampai'])) {
				$this->db->where(
				'`bayar_invoice_detail`.`tgl_bayar` BETWEEN "' .
				date('Y-m-d', strtotime($params['search']['dari'])) .
				'" and "' .
				date('Y-m-d', strtotime($params['search']['sampai'])) .
				'"'
				);
			}
			
			$this->db->order_by('`bayar_invoice_detail`.`id`');
			$query = $this->db->get();
			$result = $query->num_rows() > 0 ? $query->result_array() : false;
			return $result;
			
		}
		
		function getDesain($params = array()){
			// print_r($params);
			// $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
			
			$this->db->select(' 
			`invoice`.`id_invoice`,
			`invoice`.`id_transaksi`,
			`invoice`.`id_desain`,
			`invoice`.`total_bayar`,
			`invoice`.`oto`,
			`invoice`.`status`,
			`invoice`.`pajak`,
			`invoice`.`tgl_trx`,
			`invoice`.`tgl_ambil`,
			`konsumen`.`nama`,
			 
			`tb_users`.`nama_lengkap` AS `kasir`');
			$this->db->from('konsumen');
			$this->db->join('invoice', '`konsumen`.`id` = `invoice`.`id_konsumen`');
			$this->db->join('tb_users', '`invoice`.`id_marketing` = `tb_users`.`id_user`');
			// $this->db->join('`tb_users` `tb_users1`', '`invoice`.`id_desain` = `tb_users1`.`id_user`');
			// $this->db->join('invoice_detail', '`invoice`.`id_invoice` = `invoice_detail`.`id_invoice`');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{
				if(!empty($params['search']['user'])){ 
					$this->db->where('invoice.id_desain', $params['search']['user']); 
				} 
				
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$this->db->where('invoice.tgl_trx BETWEEN "'. date('Y-m-d', strtotime($params['search']['dari'])). '" and "'. date('Y-m-d', strtotime($params['search']['sampai'])).'"');
				}
				if(!empty($params['search']['dari']) AND empty($params['search']['sampai'])){
					$this->db->where('invoice.tgl_trx', $params['search']['dari']);
					
				}
			} 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`invoice`.`id_invoice`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$this->db->order_by('invoice.id_invoice', 'DESC'); 
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					
					}else{
					
					$this->db->order_by('invoice.id_invoice', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function uang_setoran($params = array()){
			$this->db->select(' 
			`tb_users`.`nama_lengkap` AS nama,
			`laporan_penerimaan`.`id`,
			`laporan_penerimaan`.`id_penerima`,
			`laporan_penerimaan`.`total`,
			`laporan_penerimaan`.`tanggal`,
			`laporan_penerimaan`.`status`');
		
			$this->db->from('tb_users');
			$this->db->join('laporan_penerimaan', '`tb_users`.`id_user` = `laporan_penerimaan`.`id_user`');
			 
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{
				 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$this->db->where('laporan_penerimaan.tanggal BETWEEN "'. date('Y-m-d', strtotime($params['search']['dari'])). '" and "'. date('Y-m-d', strtotime($params['search']['sampai'])).'"');
				}
				 
			} 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`laporan_penerimaan`.`id`', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$this->db->order_by('laporan_penerimaan.id', 'DESC'); 
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					
					}else{
					
					$this->db->order_by('laporan_penerimaan.id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getPengguna($params = array()){ 
			$dbprefix = $this->db->dbprefix('tb_users');
			
			$this->db->select('*'); 
			$this->db->from($dbprefix); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_lengkap', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`tb_users`.`id_user`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('tb_users.id_user', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('tb_users.id_user', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
			}
		
		function getLabaRugi($params = array()){
			// print_r($params);
			$this->db->select_sum('jml_bayar');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tgl_bayar between '$minvalue' AND '$maxvalue'");
				}
			} 
			
			$query = $this->db->get('bayar_invoice_detail'); 
			$result = ($query->num_rows() > 0)?$query->result():FALSE; 
			return $result; 
		}
		
		function getLabaRugiBiaya($params = array()){
			$this->db->select_sum('jml_bayar');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tgl_bayar between '$minvalue' AND '$maxvalue'");
				}
			} 
			
			$query = $this->db->get('bayar_pengeluaran'); 
			$result = ($query->num_rows() > 0)?$query->result():FALSE; 
			return $result; 
		}
		
		function getLaporanPenjualan($params = array()){
			// print_r($params);
			$this->db->select(' `produk`.`title`,
			`produk`.`id`,
			SUM(`invoice_detail`.`harga` * `invoice_detail`.`jumlah`) AS `total`,
			SUM((`invoice_detail`.`jumlah` * `invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))  AS diskon,
			SUM(`invoice_detail`.`jumlah`) AS `jml`');
			$this->db->from('produk');
			$this->db->join('invoice_detail', '`produk`.`id` = `invoice_detail`.`id_produk`');
			$this->db->join('invoice', '`invoice_detail`.`id_invoice` = `invoice`.`id_invoice`');
			$this->db->group_by(array("`produk`.`title`","`produk`.`id`"));
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tgl_trx between '$minvalue' AND '$maxvalue'");
				}
				
			} 
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('`invoice`.`tgl_trx`', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getLog($params = array()){
			// print_r($params);
			$this->db->select('`tb_users`.`nama_lengkap`,
			`kas_masuk`.`pemasukan`,
			`kas_masuk`.`pengeluaran`,
			`kas_masuk`.`catatan`,
			`kas_masuk`.`create_date`,
			id_generate');
			$this->db->from('tb_users');
			$this->db->join('kas_masuk', '`tb_users`.`id_user` = `kas_masuk`.`id_user`');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){
					$start_date =  $params['search']['dari'];
					$end_date =  $params['search']['sampai'];
					if($params['search']['dari'] == $params['search']['sampai']){
						$this->db->where("create_date >= DATE('$start_date')");
						
						}else{
						
						// $this->db->where("DATE(create_date) BETWEEN '$start_date' AND '$end_date'");
						$this->db->where("DATE(create_date) >=", $start_date);
						$this->db->where("DATE(create_date) <=", $end_date);
					}
				}
			} 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('kas_masuk.create_date', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('`kas_masuk`.`create_date`', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getLaporanPerkategori($params = array()){
			$this->db->select('`jenis_cetakan`.`jenis_cetakan`,
			SUM(`invoice_detail`.`jumlah`) AS `jumlah`,
			SUM((`invoice_detail`.`jumlah` * `invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))  AS diskon,
			SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) AS `total`');
			$this->db->from('jenis_cetakan');
			$this->db->join('invoice_detail', '`jenis_cetakan`.`id_jenis` = `invoice_detail`.`jenis_cetakan`');
			$this->db->join('invoice', '`invoice_detail`.`id_invoice` = `invoice`.`id_invoice`');
			$this->db->group_by("`jenis_cetakan`.`jenis_cetakan`");
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tgl_trx between '$minvalue' AND '$maxvalue'");
				}
				
			} 
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('`invoice`.`tgl_trx`', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function arusKas($params = array()){
			$this->db->select('`kas_kecil`.`id`,
			`kas_kecil`.`no_reff`,
			`kas_kecil`.`jumlah`,
			`kas_kecil`.`create_date`,
			`tb_users`.`nama_lengkap`');
			$this->db->from('tb_users');
			$this->db->join('kas_kecil', '`tb_users`.`id_user` = `kas_kecil`.`id_user`');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$this->db->where('create_date BETWEEN "'. date('Y-m-d', strtotime($params['search']['dari'])). '" and "'. date('Y-m-d', strtotime($params['search']['sampai'])).'"');
				}
				if(!empty($params['search']['dari']) AND empty($params['search']['sampai'])){
					$this->db->where('create_date', $params['search']['dari']);
					
				}
				
				
			} 
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('create_date', $params['search']['sortBy']); 
			}
			
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					$this->db->order_by('create_date', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getMutasi($params = array()){
			// print_r($params);
			$this->db->select('*');
			$this->db->from('kas_masuk');
			
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$start_date = $params['search']['dari'];
					$end_date = $params['search']['sampai'];
					
					$this->db->where("DATE(create_date) >=", $start_date);
					$this->db->where("DATE(create_date) <=", $end_date);
				}
				// if(!empty($params['search']['dari']) AND empty($params['search']['sampai'])){
				// // $this->db->where('create_date BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now()');
				// $this->db->where('DATE(create_date)', $params['search']['dari']);
				// }
				
				
			} 
			
			// Sort data by ascending or desceding order 
			// if(!empty($params['search']['sortBy'])){ 
			// $this->db->order_by('create_date', $params['search']['sortBy']); 
			// }
			
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('create_date', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function get_supplier($params = array()){
			$this->db->select('*');
			$this->db->from('supplier');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('nama_perusahaan', $params['search']['keywords']); 
					$this->db->or_like('telp', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id_supplier', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					$this->db->order_by('id_supplier', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		public function produk(){
			$this->db->select('`jenis_cetakan`.`jenis_cetakan`,
			`produk`.`id` AS idp,
			`produk`.`title` AS nproduk,
			`produk`.`pub`');
			$this->db->from('produk');
			$this->db->join('jenis_cetakan', '`produk`.`id_jenis` = `jenis_cetakan`.`id_jenis`');
			$this->db->where('produk.kunci=0');
			$this->db->order_by('`produk`.`id`','DESC');
			return $this->db->get()->result_array();
		}
		function getProduk($params = array()){
			// print_r($params);
			$this->db->select('`jenis_cetakan`.`jenis_cetakan`,
			`produk`.`id`,
			`produk`.`barcode`,
			`produk`.`title`,
			`produk`.`pub`');
			$this->db->from('produk');
			$this->db->join('jenis_cetakan', '`produk`.`id_jenis` = `jenis_cetakan`.`id_jenis`');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('produk.title', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('produk.id', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					$this->db->order_by('produk.id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getRange($params = array()){
			// print_r($params);
			$this->db->select(' `bahan`.`title`,
			`range_harga`.`id`,
			`range_harga`.`jumlah_minimal`,
			`range_harga`.`jumlah_maksimal`,
			`range_harga`.`pub`,
			`range_harga`.`harga_jual`');
			$this->db->from('bahan');
			$this->db->join('range_harga', '`bahan`.`id` = `range_harga`.`id_bahan`');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('bahan.title', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('range_harga.id', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					$this->db->order_by('range_harga.id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getJenis($params = array()){
			$this->db->select('*');
			$this->db->from('akun');
			$this->db->join('jenis_cetakan', '`akun`.`no_reff` = `jenis_cetakan`.`id_akun`');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('jenis_cetakan', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id_jenis', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					$this->db->order_by('id_jenis', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getJenisPengeluaran($params = array()){
			$this->db->select('*');
			$this->db->from('akun');
			$this->db->join('jenis_pengeluaran', '`akun`.`no_reff` = `jenis_pengeluaran`.`id_akun`');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('title', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id_jenis', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					$this->db->order_by('id_jenis', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getBahan($params = array()){
			$this->db->select('`bahan`.`title`,
			`bahan`.`id_jenis`,
			`bahan`.`harga`,
			`bahan`.`harga_modal`,
			`bahan`.`status_stok`,
			`bahan`.`type_harga`,
			`satuan`.`satuan`,
			`bahan`.`pub`,
			`bahan`.`id`');
			$this->db->from('satuan');
			$this->db->join('bahan', '`satuan`.`id` = `bahan`.`id_satuan`','right');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('title', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getStokBahan($params = array()){
			$this->db->select('*');
			$this->db->from('bahan');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('title', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('`id`', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getStokMasuk($params = array()){
			$this->db->select('*');
			$this->db->from('stok_masuk');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('create_date', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('`create_date`', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getStokKeluar($params = array()){
			$this->db->select('*');
			$this->db->from('stok_keluar');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('create_date', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('`create_date`', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getSatuan($params = array()){
			$this->db->select('*');
			$this->db->from('satuan');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('satuan', $params['search']['keywords']); 
				} 
			}
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
					}else{
					$this->db->order_by('id', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function get_harian($params = array()){
			// print_r($params);
			// $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
			$this->db->select(' 
			`invoice`.`id_invoice`,
			`invoice`.`id_transaksi`,
			`invoice`.`oto`,
			`invoice`.`total_bayar`,
			`invoice`.`status`,
			`konsumen`.`nama`,
			`tb_users`.`id_user`,
			`tb_users`.`nama_lengkap` AS kasir,
			`invoice`.`pajak`,
			`invoice`.`tgl_ambil`,
			`invoice`.`tgl_trx`');
			$this->db->from('tb_users');
			$this->db->join('invoice', '`tb_users`.`id_user` = `invoice`.`id_user`');
			$this->db->join('konsumen', 'invoice.id_konsumen = konsumen.id');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['user'])){ 
					$this->db->where('invoice.id_user', $params['search']['user']); 
				} 
				
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$this->db->where('invoice.tgl_trx BETWEEN "'. date('Y-m-d', strtotime($params['search']['dari'])). '" and "'. date('Y-m-d', strtotime($params['search']['sampai'])).'"');
				}
				if(!empty($params['search']['dari']) AND empty($params['search']['sampai'])){
					$this->db->where('invoice.tgl_trx', $params['search']['dari']);
					
				}
				
				
			} 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`invoice`.`id_invoice`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$this->db->order_by('invoice.id_invoice', 'DESC'); 
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					
					}else{
					
					$this->db->order_by('invoice.id_invoice', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function get_operator($params = array()){
			// print_r($params);
			// $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
			$this->db->select(' 
			`invoice`.`id_invoice`,
			`invoice`.`id_transaksi`,
			`invoice`.`total_bayar`,
			`invoice`.`tgl_trx`,
			`invoice`.`jam_order`,
			`invoice`.`tgl_ambil`,
			`konsumen`.`nama`,
			`konsumen`.`no_hp`,
			`tb_users`.`nama_lengkap` AS `kasir`');
			$this->db->from('invoice');
			$this->db->join('konsumen', 'invoice.id_konsumen = konsumen.id');
			$this->db->join('tb_users', '`invoice`.`id_user` = `tb_users`.`id_user`');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$this->db->where('invoice.tgl_trx BETWEEN "'. date('Y-m-d', strtotime($params['search']['dari'])). '" and "'. date('Y-m-d', strtotime($params['search']['sampai'])).'"');
				}
				if(!empty($params['search']['dari']) AND empty($params['search']['sampai'])){
					$this->db->where('invoice.tgl_trx', $params['search']['dari']);
					
				}
				
				
			} 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`invoice`.`id_invoice`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$this->db->order_by('invoice.id_invoice', 'DESC'); 
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					
					}else{
					
					$this->db->order_by('invoice.id_invoice', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function get_harians($where){
			$qry = "SELECT invoice.id_invoice,
			invoice.tgl_trx,
			invoice.total_bayar,
			invoice.oto,
			invoice.pajak,
			invoice_detail.id_rincianinvoice,
			invoice_detail.diskon AS disc,
			
			sum(invoice_detail.jumlah * invoice_detail.harga) AS Tot,
			SUM((`invoice_detail`.`jumlah`)*(`invoice_detail`.`harga` * `invoice_detail`.`diskon`/100)) AS sisa,
			round(SUM(`invoice_detail`.`harga` * `invoice_detail`.`diskon`/100)) AS diskon,
			konsumen.nama,
			tb_users.nama_lengkap AS kasir
			FROM
			invoice
			INNER JOIN invoice_detail ON (invoice.id_invoice = invoice_detail.id_invoice)
			LEFT OUTER JOIN konsumen ON (invoice.id_konsumen = konsumen.id)
			LEFT OUTER JOIN tb_users ON (invoice.id_user = tb_users.id_user)
			" .$where. " 
			GROUP BY 
			invoice.id_invoice,
			konsumen.nama,
			tb_users.nama_lengkap ORDER BY invoice.id_invoice DESC";
			$query = $this->db->query($qry);
			// if($query->num_rows() > 0){
			return $query->result_array();
			// }
		}
		function get_desain($where){
			$qry = "SELECT 
			`invoice_detail`.`id_invoice`,
			`jenis_cetakan`.`jenis_cetakan`,
			`invoice`.`id_transaksi`,
			`invoice`.`tgl_trx`,
			`invoice`.`id_desain`,
			`invoice_detail`.`keterangan`
			FROM
			`invoice_detail`
			INNER JOIN `invoice` ON (`invoice_detail`.`id_invoice` = `invoice`.`id_invoice`)
			INNER JOIN `jenis_cetakan` ON (`invoice_detail`.`jenis_cetakan` = `jenis_cetakan`.`id_jenis`)
			WHERE $where AND `invoice_detail`.`jenis_cetakan` = 9";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0){
				return $query->row();
			}
		}
		function get_detail($where){
			$qry = "SELECT 
			`produk`.`title` AS `produk`,
			`invoice_detail`.`id_rincianinvoice`,
			`invoice_detail`.`id_invoice`,
			`invoice_detail`.`keterangan`,
			`invoice_detail`.`detail`,
			`invoice_detail`.`jumlah`,
			`invoice_detail`.`satuan`,
			`invoice_detail`.`ukuran`,
			`invoice`.`id_transaksi`,
			`invoice`.`tgl_ambil`,
			`bahan`.`title` AS `bahan`,
			`tb_users`.`nama_lengkap` AS `fo`
			FROM
			`produk`
			INNER JOIN `invoice_detail` ON (`produk`.`id` = `invoice_detail`.`id_produk`)
			INNER JOIN `invoice` ON (`invoice_detail`.`id_invoice` = `invoice`.`id_invoice`)
			INNER JOIN `bahan` ON (`invoice_detail`.`id_bahan` = `bahan`.`id`)
			INNER JOIN `tb_users` ON (`invoice`.`id_user` = `tb_users`.`id_user`)
			WHERE
			$where AND `invoice_detail`.`jenis_cetakan`!='9'";
			$query = $this->db->query($qry);
			return $query->result();
			
		}
		function piutang($where){
			// echo $where;
			$qry = "SELECT 
			`invoice_detail`.`id_invoice`,
			`invoice_detail`.`harga`,
			`invoice_detail`.`jumlah`,
			`invoice_detail`.`diskon`,
			`invoice`.`total_bayar`, 
			`invoice`.`id_transaksi`, 
			`invoice`.`pajak`, 
			`invoice`.`tgl_trx`, 
			`konsumen`.`nama` AS namak,
			`konsumen`.`no_hp`,
			`konsumen`.`perusahaan`, 
			IFNULL(`tb_users`.`nama_lengkap`,`invoice`.`id_user`)  as fo, 
			
			SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) AS `totalbeli`,
			IFNULL(A.totalbayar,0) AS `totalbayar`,
			SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) -  IFNULL(A.totalbayar,0) AS sisa
			
			FROM
			`invoice_detail`
			LEFT OUTER JOIN (SELECT `bayar_invoice_detail`.`id_invoice`, SUM(`bayar_invoice_detail`.`jml_bayar`) AS `totalbayar`
			FROM `bayar_invoice_detail` GROUP BY  `bayar_invoice_detail`.`id_invoice`) A   
			ON (`invoice_detail`.`id_invoice` = A.`id_invoice`)
			
			LEFT OUTER JOIN  
			`invoice` ON 
			(`invoice`.`id_invoice` = `invoice_detail`.`id_invoice`)
			
			LEFT OUTER JOIN  
			`konsumen` ON 
			(`konsumen`.`id` = `invoice`.`id_konsumen`)
			
			LEFT OUTER JOIN  
			`tb_users` ON 
			(`tb_users`.`id_user` = `invoice`.`id_user`)
			
			$where GROUP BY
			`invoice_detail`.`id_invoice`, `invoice`.`id_invoice`
			HAVING sisa > 0 ORDER by  `konsumen`.`nama` ASC";
			$query = $this->db->query($qry);
			return $query->result_array();
		}
		
		function carabayar($where){
			$qry = "SELECT 
			`jenis_bayar`.`nama_bayar`,
			`jenis_bayar`.`id`
			FROM
			`jenis_bayar`
			RIGHT OUTER JOIN `bayar_invoice_detail` ON (`jenis_bayar`.`id` = `bayar_invoice_detail`.`id_bayar`)
			$where
			GROUP BY `jenis_bayar`.`id`,
			`jenis_bayar`.`nama_bayar`";
			$query = $this->db->query($qry);
			return $query->result_array();
		}
		
		function simpan_setor($params = array()){
			// print_r($params);
			$this->db->select('id_bayar,id_user,setor,tgl_bayar,jml_bayar');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tgl_bayar between '$minvalue' AND '$maxvalue'");
				}
			} 
			
			$query = $this->db->get('bayar_invoice_detail'); 
			$result = ($query->num_rows() > 0)?$query->result():FALSE; 
			return $result; 
		}
		
		function setor_to_owner($params = array()){
			// print_r($params);
			$this->db->select('id_bayar,id_user,setor,tgl_bayar,jml_bayar');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tanggal_verifikasi between '$minvalue' AND '$maxvalue'");
				}
			} 
			
			$query = $this->db->get('laporan_penerimaan'); 
			$result = ($query->num_rows() > 0)?$query->result():FALSE; 
			return $result; 
		}
		
		function update_setor($params = array()){
			// print_r($params);
			$data = array(
			'id_user' => $params['id_user'],
			'setor' => 'Y'
			);
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tgl_bayar between '$minvalue' AND '$maxvalue'");
				}
			} 
			$this->db->update('bayar_invoice_detail',$data); 
		}
		
		function rekap_debit($where){
			$qry = "SELECT 
			SUM(`bayar_invoice_detail`.`jml_bayar`) AS `total`,
			`bayar_invoice_detail`.`tgl_bayar`
			FROM
			`invoice`
			INNER JOIN `bayar_invoice_detail` ON (`invoice`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`)
			" .$where. "
			GROUP BY
			`bayar_invoice_detail`.`tgl_bayar`";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0){
				return $query->row();
			}
		}
		function rekap_kredit($where){
			$qry = "SELECT 
			SUM(`pengeluaran_detail`.`jumlah` * `pengeluaran_detail`.`harga`) AS `total`,
			`pengeluaran`.`tgl_pengeluaran`
			FROM
			`pengeluaran`
			RIGHT OUTER JOIN `pengeluaran_detail` ON (`pengeluaran`.`id_pengeluaran` = `pengeluaran_detail`.`id_pengeluaran`)
			" .$where. "
			GROUP BY
			`pengeluaran`.`tgl_pengeluaran`";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0){
				return $query->row();
			}
		}
		//pembelian`
		function getPembelian($params = array()){
			// print_r($params);
			$this->db->select('*');
			$this->db->from('pembelian');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){
					$minvalue = date('Y-m-d', strtotime($params['search']['dari']));
					$maxvalue = date('Y-m-d', strtotime($params['search']['sampai']));
					if($minvalue == $maxvalue){
						$this->db->where("tgl_pembelian = '$minvalue'");
						}else{
						$this->db->where("tgl_pembelian between '$minvalue' AND '$maxvalue'");
					}
				}
			}
			
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id_pembelian', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					
					$this->db->order_by('id_pembelian', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		//pengeluaran_detail`
		function getPengeluaran($params = array()){
			// print_r($params);
			$this->db->select('*');
			$this->db->from('pengeluaran');
			
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){
				
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){
					$minvalue = date('Y-m-d', strtotime($params['search']['dari']));
					$maxvalue = date('Y-m-d', strtotime($params['search']['sampai']));
					if($minvalue == $maxvalue){
						$this->db->where("tgl_pengeluaran = '$minvalue'");
						}else{
						$this->db->where("tgl_pengeluaran between '$minvalue' AND '$maxvalue'");
					}
				}
			}
			
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('id_pengeluaran', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					
					$this->db->order_by('id_pengeluaran', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		//piutang usaha
		function getPiutangUsaha($params = array()){
			// print_r($params);
			$this->db->select('`jenis_kas`.`title`,
			`pengeluaran`.`id_pengeluaran`,
			`pengeluaran`.`total_bayar`,
			`pengeluaran_detail`.`jumlah`,
			`pengeluaran_detail`.`harga`,
			`pengeluaran_detail`.`keterangan`,
			`pengeluaran`.`id_bayar`,
			`pengeluaran`.`id_kas`,
			`pengeluaran`.`tgl_pengeluaran`,
			`tb_users`.`id_user`,
			`tb_users`.`nama_lengkap`,
			`supplier`.`nama_perusahaan`');
			$this->db->from('pengeluaran');
			$this->db->join('pengeluaran_detail', '`pengeluaran`.`id_pengeluaran` = `pengeluaran_detail`.`id_pengeluaran`');
			$this->db->join('jenis_pengeluaran', '`pengeluaran_detail`.`id_biaya` = `jenis_pengeluaran`.`id_jenis`');
			$this->db->join('jenis_kas', '`jenis_pengeluaran`.`id_akun` = `jenis_kas`.`id_akun`');
			$this->db->join('tb_users', '`pengeluaran`.`id_user` = `tb_users`.`id_user`');
			$this->db->join('supplier', '`pengeluaran_detail`.`id_supplier` = `supplier`.`id_supplier`');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params)){ 
				
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$minvalue = $params['search']['dari'];
					$maxvalue = $params['search']['sampai'];
					$this->db->where("tgl_pengeluaran between '$minvalue' AND '$maxvalue'");
				}
				if(!empty($params['search']['dari']) AND empty($params['search']['sampai'])){
					$this->db->where('tgl_pengeluaran', $params['search']['dari']);
					
				}
				
				if(!empty($params['search']['user'])){ 
					$this->db->like('pengeluaran.id_user', $params['search']['user']); 
				} 
			} 
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('pengeluaran.id_pengeluaran', $params['search']['sortBy']); 
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$this->db->where('pos', 'Y'); 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('id_pengeluaran', $params['id']); 
					} 
					$this->db->where('pos', 'Y'); 
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					$this->db->where('pos', 'Y'); 
					$this->db->order_by('id_pengeluaran', 'DESC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function getPengeluaranPerproduk($params = array()){
			// print_r($params);
			$this->db->select('`pengeluaran_detail`.`no`,
			`pengeluaran_detail`.`id_biaya`,
			`pengeluaran`.`id_user`,
			`pengeluaran`.`id_bayar`,
			`pengeluaran`.`id_kas`,
			`pengeluaran`.`id_pengeluaran`,
			`pengeluaran`.`tgl_pengeluaran`,
			`pengeluaran`.`lunas`,
			`pengeluaran`.`tgl_jatuhtempo`,
			`pengeluaran`.`total_bayar`');
			$this->db->from('tb_users');
			$this->db->join('pengeluaran', '`tb_users`.`id_user` = `pengeluaran`.`id_user`');
			$this->db->join('pengeluaran_detail', '`pengeluaran`.`id_pengeluaran` = `pengeluaran_detail`.`id_pengeluaran`');
			if(array_key_exists("where", $params)){
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			}  
			
			if(array_key_exists("search", $params))
			{ 
				if(!empty($params['search']['dari']) AND !empty($params['search']['sampai'])){ 
					$this->db->where('tgl_pengeluaran BETWEEN "'. date('Y-m-d', strtotime($params['search']['dari'])). '" and "'. date('Y-m-d', strtotime($params['search']['sampai'])).'"');
				}
				if(!empty($params['search']['dari']) AND empty($params['search']['sampai'])){
					$this->db->where('tgl_pengeluaran', $params['search']['dari']);
					
				}
				
				if(!empty($params['search']['user'])){ 
					$this->db->where('tb_users.id_user', $params['search']['user']); 
				} 
				
				if(!empty($params['search']['jenis'])){ 
					$this->db->where('pengeluaran_detail.id_biaya', $params['search']['jenis']); 
				} 
				
			} 
			
			// Sort data by ascending or desceding order 
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('pengeluaran.id_pengeluaran', $params['search']['sortBy']); 
			}
			
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					// if(!empty($params['id'])){ 
					// $this->db->where('id_pengeluaran', $params['id']); 
					// } 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					}else{
					
					$this->db->order_by('pengeluaran.id_pengeluaran', 'ASC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						
						$this->db->limit($params['limit']); 
					}
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		
		function get_Satu($where){
			
			$this->db->select('`pengeluaran`.`id_pengeluaran`,
			`pengeluaran`.`id_user`,
			`pengeluaran`.`tgl_pengeluaran`');
			$this->db->from('pengeluaran');
			$this->db->where($where);
			$this->db->order_by('`pengeluaran`.`tgl_pengeluaran`','DESC');
			return $this->db->get()->result_array();
		}
		
		function grafik_perbulan($bulan,$tahun){
			$this->db->select('YEAR(tgl_bayar) as tahun, MONTH(tgl_bayar) as bulan, DAY(tgl_bayar) as hari ');
			$this->db->select_sum('jml_bayar');
			$this->db->from('bayar_invoice_detail');
			$this->db->where('MONTH(tgl_bayar)',$bulan);
			$this->db->where('YEAR(tgl_bayar)',$tahun);
			$this->db->group_by('tgl_bayar');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
				} else {
				return false;
			}
		}
		
		function grafik_perbulan_desain($bulan,$tahun,$where){
			$this->db->select('count(id_desain) as counter, YEAR(tgl_trx) as tahun, MONTH(tgl_trx) as bulan, DAY(tgl_trx) as hari ');
			$this->db->from('invoice');
			$this->db->where($where);
			$this->db->where('MONTH(tgl_trx)',$bulan);
			$this->db->where('YEAR(tgl_trx)',$tahun);
			$this->db->group_by('tgl_trx');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
				} else {
				return false;
			}
		}
		
		function grafik_omset($bulan,$tahun){
			$this->db->select('SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) AS `Total`, YEAR(invoice.tgl_trx) as tahun, MONTH(invoice.tgl_trx) as bulan, DAY(invoice.tgl_trx) as hari ');
			$this->db->from('invoice_detail');
			$this->db->join('invoice', 'invoice_detail.id_invoice = invoice.id_invoice');
			$this->db->where('MONTH(invoice.tgl_trx)',$bulan);
			$this->db->where('YEAR(invoice.tgl_trx)',$tahun);
			$this->db->where('invoice.status!=','baru');
			$this->db->where('invoice.status!=','batal');
			$this->db->group_by('invoice.tgl_trx');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
				} else {
				return false;
			}
		}
		
		function grafik_omset_produk($bulan,$tahun){
			$this->db->select('SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) AS `Total`, produk.title, YEAR(invoice.tgl_trx) as tahun, MONTH(invoice.tgl_trx) as bulan, DAY(invoice.tgl_trx) as hari ');
			$this->db->from('produk');
			$this->db->join('invoice_detail', 'produk.id = invoice_detail.id_produk');
			$this->db->join('invoice', 'invoice_detail.id_invoice = invoice.id_invoice');
			$this->db->where('MONTH(invoice.tgl_trx)',$bulan);
			$this->db->where('YEAR(invoice.tgl_trx)',$tahun);
			$this->db->where('invoice.status!=','baru');
			$this->db->group_by('produk.title');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
				} else {
				return false;
			}
		}
		function grafik_pertahun($tahun){
			$this->db->select('YEAR(tgl_bayar) as tahun, MONTH(tgl_bayar) as bulan');
			$this->db->select_sum('jml_bayar');
			$this->db->from('bayar_invoice_detail');
			$this->db->where('YEAR(tgl_bayar)',$tahun);
			$this->db->group_by(['MONTH(tgl_bayar)', 'YEAR(tgl_bayar)']);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();
				} else {
				return false;
			}
		}
		function getRows($params = array()){ 
			// print_r($params);
			$this->db->select('`invoice`.`tgl_trx`,
			`invoice`.`id_transaksi`,
			`invoice`.`id_konsumen`,
			`invoice`.`id_invoice`,
			`invoice`.`total_bayar`,
			`invoice`.`status`,
			`invoice`.`oto`,
			`invoice`.`lunas`,
			`invoice`.`cetak`,
			`konsumen`.`id`,
			`konsumen`.`nama`,
			`konsumen`.`no_hp`,
			`tb_users`.`nama_lengkap`'); 
			$this->db->from($this->table); 
			$this->db->join('invoice', '`tb_users`.`id_user` = `invoice`.`id_marketing`');
			$this->db->join('konsumen', '`invoice`.`id_konsumen` = `konsumen`.`id`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`invoice`.`id_invoice`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`nama`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`no_hp`', $params['search']['keywords']); 
					$this->db->or_like('`tb_users`.`nama_lengkap`', $params['search']['keywords']); 
					$this->db->or_like('`invoice`.`id_transaksi`', $params['search']['keywords']); 
					$this->db->or_like('`invoice`.`total_bayar`', $params['search']['keywords']); 
					
				} 
				if(!empty($params['search']['trx'])){
					if($params['search']['trx']==1){
						$this->db->where('`invoice`.`status`', 'simpan'); 
						$this->db->like('`invoice`.`lunas`', $params['search']['trx']); 
						}elseif($params['search']['trx']==2){
						$this->db->like('`invoice`.`lunas`', 0); 
						}else{
						$this->db->like('`invoice`.`status`', $params['search']['trx']); 
					}
				} 
				if(!empty($params['search']['tgl'])){ 
					$this->db->where('tgl_trx', $params['search']['tgl']);
				} 
			}
			if(!empty($params['search']['sortBy'])){
				if($params['search']['sortBy']=='min_order'){
					$this->db->order_by('`invoice`.`total_bayar`', 'ASC'); 
					}elseif($params['search']['sortBy']=='max_order'){
					$this->db->order_by('`invoice`.`total_bayar`', 'DESC'); 
					}else{
					$this->db->order_by('`invoice`.`id_invoice`', $params['search']['sortBy']); 
				}
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('invoice.id_invoice', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('invoice.id_invoice', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		
		function getRowsLaporan($params = array()){ 
			// print_r($params);
			$this->db->select('*'); 
			$this->db->from('laporan_stok'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`title`', $params['search']['keywords']); 
				} 
				
				if(!empty($params['search']['tanggal'])){ 
					$this->db->where('tanggal', $params['search']['tanggal']);
				} 
			}
			if(!empty($params['search']['sortBy'])){
				$this->db->order_by('id', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('id', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result():FALSE; 
				} 
			} 
			// Return fetched data 
			return $result; 
		}
		
		function getKonsumen($params = array()){
			// print_r($params);
			if(!empty($params['search']['sortBy']) AND $params['search']['sortBy']=='max_order' OR !empty($params['search']['sortBy']) AND $params['search']['sortBy']=='min_order' OR !empty($params['search']['sortBy']) AND $params['search']['sortBy']=='last_order'){
				$this->db->select('`konsumen`.`nama`,
				`konsumen`.`tgl_daftar`,
				`konsumen`.`no_hp`,
				`konsumen`.`id`,
				`konsumen`.`jenis`,
				`konsumen`.`jenis_member`,
				`invoice`.`tgl_trx`,
				`invoice`.`total_bayar`'); 
				$this->db->from('konsumen'); 
				$this->db->join('invoice', '`konsumen`.`id` = `invoice`.`id_konsumen`');
				$this->db->where('konsumen.kunci', 0); 
				}else{
				$this->db->select('*'); 
				$this->db->from('konsumen'); 
				$this->db->where('konsumen.kunci', 0); 
			}
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`konsumen`.`nama`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`no_hp`', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){
				if($params['search']['sortBy']=='last_register'){
					$this->db->order_by('`konsumen`.`tgl_daftar`', 'DESC'); 
					}elseif($params['search']['sortBy']=='min_order'){
					$this->db->order_by('`invoice`.`total_bayar`', 'ASC'); 
					}elseif($params['search']['sortBy']=='last_order'){
					$this->db->order_by('`invoice`.`tgl_trx`','DESC'); 
					}elseif($params['search']['sortBy']=='max_order'){
					$this->db->order_by('`invoice`.`total_bayar`', 'DESC'); 
					}else{
					$this->db->order_by('`konsumen`.`nama`', $params['search']['sortBy']); 
				}
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				// $this->db->group_by(array("`konsumen`.`nama`", "`konsumen`.`no_hp`", "`konsumen`.`tgl_daftar`")); 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('konsumen.id', $params['id']); 
						// print_r($params);
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{
					// $this->db->group_by(array("`konsumen`.`nama`", "`konsumen`.`no_hp`", "`konsumen`.`tgl_daftar`")); 
					// $this->db->order_by('konsumen.last_update', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					
				} 
			} 
			return $result; 
		}
		
		function getHistory($params = array()){
			$this->db->select('*'); 
			$this->db->from('user_agent'); 
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`user_agent`.`ip`', $params['search']['keywords']); 
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`user_agent`.`id`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('user_agent.id', $params['id']); 
						// print_r($params);
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('user_agent.create_date', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
					
				} 
			} 
			return $result; 
		}
		function getDetail($params = array()){
			// print_r($params);
			$this->db->select('`konsumen`.`nama`,
			`konsumen`.`no_hp`,
			`invoice`.`id_invoice`,
			`invoice`.`id_transaksi`,
			`invoice`.`total_bayar`,
			`invoice`.`pajak`,
			`invoice`.`tgl_trx`,
			`invoice`.`oto`,
			`tb_users`.`nama_lengkap`'); 
			$this->db->from('konsumen'); 
			$this->db->join('invoice', '`konsumen`.`id` = `invoice`.`id_konsumen`');
			$this->db->join('tb_users', '`invoice`.`id_marketing` = `tb_users`.`id_user`');
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`invoice`.`id_invoice`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`nama`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`no_hp`', $params['search']['keywords']); 
					$this->db->or_like('`tb_users`.`nama_lengkap`', $params['search']['keywords']); 
				} 
				
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`invoice`.`id_invoice`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$this->db->where('konsumen.id', $params['id']); 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('konsumen.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->result_array(); 
					}else{ 
					$this->db->order_by('invoice.id_invoice', 'ASC'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		} 
		function getCari($params = array()){
			$this->db->select('`invoice`.`tgl_trx`,
			`invoice`.`id_invoice`,
			`invoice`.`total_bayar`,
			`invoice`.`status`,
			`invoice`.`oto`,
			`invoice`.`lunas`,
			`invoice`.`cetak`,
			`konsumen`.`id`,
			`konsumen`.`nama`,
			`konsumen`.`no_hp`,
			`tb_users`.`nama_lengkap`'); 
			$this->db->from($this->table); 
			$this->db->join('invoice', '`tb_users`.`id_user` = `invoice`.`id_marketing`');
			$this->db->join('konsumen', '`invoice`.`id_konsumen` = `konsumen`.`id`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`invoice`.`id_invoice`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`nama`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`no_hp`', $params['search']['keywords']); 
					$this->db->or_like('`tb_users`.`nama_lengkap`', $params['search']['keywords']); 
					
				} 
				
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('konsumen.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('invoice.id_invoice', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->row_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function getCariInv($params = array()){
			$this->db->select('`invoice`.`tgl_trx`,
			`invoice`.`id_invoice`,
			`invoice`.`id_transaksi`,
			`invoice`.`total_bayar`,
			`invoice`.`status`,
			`invoice`.`oto`,
			`invoice`.`lunas`,
			`invoice`.`cetak`,
			`konsumen`.`id`,
			`konsumen`.`nama`,
			`konsumen`.`no_hp`,
			`tb_users`.`nama_lengkap`'); 
			$this->db->from($this->table); 
			$this->db->join('invoice', '`tb_users`.`id_user` = `invoice`.`id_marketing`');
			$this->db->join('konsumen', '`invoice`.`id_konsumen` = `konsumen`.`id`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){
				if(!empty($params['search']['keywords'])){ 
					$this->db->or_like('`konsumen`.`nama`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`no_hp`', $params['search']['keywords']); 
					
				} 
				
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('konsumen.id', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->result_array(); 
					}else{ 
					$this->db->order_by('invoice.id_invoice', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		}
		function detailMerchant(){
			$this->db->select('`rekening_bank`.`inisial`,
			SUM(`kas_masuk`.`pemasukan`) AS `total`,
			SUM(`kas_masuk`.`pengeluaran`) AS `total_pengeluaran`,
			`kas_masuk`.`id_sub_bayar`,
			`kas_masuk`.`id_jenis`,
			`kas_masuk`.`no_reff`,
			`kas_masuk`.`pemasukan`,
			`kas_masuk`.`pengeluaran`
			'); 
			$this->db->from('rekening_bank'); 
			$this->db->join('kas_masuk', '`rekening_bank`.`id` = `kas_masuk`.`id_sub_bayar`');
			$this->db->group_by(array("`rekening_bank`.`inisial`","`kas_masuk`.`id_sub_bayar`"));
			// if(array_key_exists("where", $params)){ 
			// foreach($params['where'] as $key => $val){ 
			// $this->db->where($key, $val); 
			// } 
			// } 
			$query = $this->db->get(); 
			$result = ($query->num_rows() > 0)?$query->result():FALSE; 
			return $result;
		}
		function getRowsHarian($params = array()){
			$this->db->select('`invoice`.`tgl_trx`,
			`invoice`.`id_invoice`,
			`invoice`.`total_bayar`,
			`invoice`.`status`,
			`invoice`.`oto`,
			`invoice`.`lunas`,
			`invoice`.`cetak`,
			`konsumen`.`id`,
			`konsumen`.`nama`,
			`konsumen`.`no_hp`,
			`tb_users`.`nama_lengkap`'); 
			$this->db->from($this->table); 
			$this->db->join('invoice', '`tb_users`.`id_user` = `invoice`.`id_marketing`');
			$this->db->join('konsumen', '`invoice`.`id_konsumen` = `konsumen`.`id`');
			
			if(array_key_exists("where", $params)){ 
				foreach($params['where'] as $key => $val){ 
					$this->db->where($key, $val); 
				} 
			} 
			if(array_key_exists("search", $params)){ 
				if(!empty($params['search']['keywords'])){ 
					$this->db->like('`invoice`.`id_invoice`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`nama`', $params['search']['keywords']); 
					$this->db->or_like('`konsumen`.`no_hp`', $params['search']['keywords']); 
					$this->db->or_like('`tb_users`.`nama_lengkap`', $params['search']['keywords']); 
					
				} 
				if(!empty($params['search']['trx'])){
					if($params['search']['trx']==1){ 
						$this->db->like('`invoice`.`lunas`', $params['search']['trx']); 
						}else{
						$this->db->like('`invoice`.`status`', $params['search']['trx']); 
					}
				} 
				if(!empty($params['search']['dari'])){ 
					$this->db->where('tgl_trx', $params['search']['dari']);
				} 
			}
			if(!empty($params['search']['sortBy'])){ 
				$this->db->order_by('`invoice`.`id_invoice`', $params['search']['sortBy']); 
			}
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
				$result = $this->db->count_all_results(); 
				}else{ 
				if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
					if(!empty($params['id'])){ 
						$this->db->where('invoice.id_invoice', $params['id']); 
					} 
					$query = $this->db->get(); 
					$result = $query->row_array(); 
					}else{ 
					$this->db->order_by('invoice.id_invoice', 'desc'); 
					if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit'],$params['start']); 
						}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
						$this->db->limit($params['limit']); 
					} 
					
					$query = $this->db->get(); 
					$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
				} 
			} 
			
			// Return fetched data 
			return $result; 
		} 
		public function getMonthPembelian($bulan,$tahun){
            return $this->db->select('*')
            ->from('pembelian')
            ->where('MONTH(tgl_pembelian)',$bulan)
            ->where('YEAR(tgl_pembelian)',$tahun)
			->order_by('id_pembelian','ASC')
            ->get()
            ->result();
		}
	}								