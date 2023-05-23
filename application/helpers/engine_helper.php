<?php
	if ( ! function_exists('cek_printer'))
	{
		function cek_printer(){
			$ci = & get_instance();
			$cek_printer = $ci->model_app->view_where('printer', array('pub' =>1));
			if($cek_printer->num_rows()>0){
				$row = $cek_printer->row_array();
				if($row['slug']=='th' AND $row['pub']==1){
					echo "<script>
					let thermal = 1,
					max_item = ".$row['max_item'].";
					</script>";
				}elseif($row['slug']=='th58' AND $row['pub']==1){
					echo "<script>
					let thermal = 2,
					max_item = ".$row['max_item'].";
					</script>";
				}elseif($row['slug']=='direct58' AND $row['pub']==1){
					echo "<script>
					let thermal = 3,
					max_item = ".$row['max_item'].";
					</script>";
				}elseif($row['slug']=='direct85' AND $row['pub']==1){
					echo "<script>
					let thermal = 4,
					max_item = ".$row['max_item'].";
					</script>";
					}else{
					echo "<script>
					let thermal = 0,
					max_item = ".$row['max_item'].";
					</script>";
				}
			}
		}
	}
	
	if ( ! function_exists('kunci_harga'))
	{
		function kunci_harga($id){
			$ci = & get_instance();
			$row = $ci->model_app->pilih_where('lock_harga','produk',['id'=>$id]);
			if($row->num_rows() > 0){
				return $row->row()->lock_harga;
				}else{
				return 'N';
			}
		}
	}
	if ( ! function_exists('jumlah_satuan'))
	{
		function jumlah_satuan($tag){
			$ci = & get_instance();
			$row = $ci->model_app->view_where('satuan',['satuan'=>$tag]);
			if($row->num_rows() > 0){
				return $row->row()->jumlah;
				}else{
				return 0;
			}
		}
	}
	if ( ! function_exists('convert_to_satuan'))
	{
		function convert_to_satuan($tag,$jumlah){
			$ci = & get_instance();
			$row = $ci->model_app->view_where('satuan',['satuan'=>$tag])->row();
			$total = $jumlah * $row->jumlah;
			return $total;
		}
	}
	if ( ! function_exists('quote'))
	{
		function quote($text){
			global $CI;
			return $CI->db->escape($text);
		}
	}
	if ( ! function_exists('query'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function query($val){
			global $CI;
			return $CI->db->query($val);
		}
	}
	if ( ! function_exists('periode_stok'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function periode_stok($id=''){
			$ci = & get_instance();
			if($id==''){
				return '';
				}else{
				$result = $ci->model_app->view_where('laporan_stok',['id'=>$id])->row();
				return $result->title;
			}
		}
	}
	
	if ( ! function_exists('modul_cetak'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function modul_cetak($modul=''){
			$ci = & get_instance();
			if($modul==''){
				return array('ukuran'=>'A4','posisi'=>'potrait');
				}else{
				$result = $ci->model_app->view_where('pengaturan_kertas',['modul'=>$modul])->row();
				return array('ukuran'=>$result->ukuran,'posisi'=>$result->posisi);
			}
		}
	}
	
	if ( ! function_exists('cek_hitung'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function cek_hitung($id){
			$ci = & get_instance();
			$query = $ci->model_app->view_where('bahan',['id'=>$id]);
			$result = ($query->num_rows() > 0)?$query->row()->status:0; 
			return $result;
		}
	}
		
	if ( ! function_exists('cek_type_harga'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function cek_type_harga($id){
			$ci = & get_instance();
			$query = $ci->model_app->view_where('bahan',['id'=>$id]);
			$result = ($query->num_rows() > 0)?$query->row()->type_harga:0; 
			return $result;
		}
	}
	
	if ( ! function_exists('harga_beli'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function harga_beli($id){
			$ci = & get_instance();
			$query = $ci->model_app->view_where('bahan',['id'=>$id]);
			$result = ($query->num_rows() > 0)?$query->row()->harga_modal:0; 
			return $result;
		}
	}
	
	if ( ! function_exists('input_stok_keluar'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function input_stok_keluar($id){
			$ci = & get_instance();
			// $result = $ci->model_app->view_where('invoice_detail',['id_invoice'=>$id])->result();
			$result = $ci->model_app->join_where('`invoice_detail`.`id_bahan`,`invoice_detail`.`tot_ukuran`,`invoice_detail`.`jumlah`,`invoice_detail`.`update_date`','bahan','invoice_detail','id','id_bahan',['`bahan`.`status_stok`'=>'Y','id_invoice'=>$id])->result();
			if(!empty($result)){
				foreach($result AS $val){
					if($val->jumlah == 0){
						$jumlah = $val->jumlah;
						}else{
						$jumlah = $val->tot_ukuran;
					}
					$data[] = [
					'id_bahan'=>$val->id_bahan,
					'id_invoice'=>$id,
					'jumlah'=>$jumlah,
					'create_date'=>$val->update_date
					];
					
				}
				$ci->db->insert_batch("stok_keluar",$data);
			}
		}
	}
	
	if ( ! function_exists('input_stok_keluar_produk'))
	{
		/**
			* Code pengaturan
			*
			@param $val array
			@return string
		*/
		function input_stok_keluar_produk($id,$id_invoice){
			$ci = & get_instance();
			// $result = $ci->model_app->view_where('invoice_detail',['id_invoice'=>$id])->result();
			$val = $ci->model_app->join_where('`invoice_detail`.`id_bahan`,`invoice_detail`.`tot_ukuran`,`invoice_detail`.`jumlah`,`invoice_detail`.`update_date`','bahan','invoice_detail','id','id_bahan',['`bahan`.`status_stok`'=>'Y','id_rincianinvoice'=>$id])->row();
			if(!empty($val)){
				if($val->jumlah == 0){
					$jumlah = $val->jumlah;
					}else{
					$jumlah = $val->tot_ukuran;
				}
				$data = [
				'id_bahan'=>$val->id_bahan,
				'id_invoice'=>$id_invoice,
				'jumlah'=>$jumlah,
				'create_date'=>$val->update_date
				];
				$ci->db->insert("stok_keluar",$data);
			}
		}
	}
	if ( ! function_exists('sum_penjualan'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		
		function sum_penjualan($bulan,$tahun,$id)
		{
			$ci = & get_instance();
			$ci->db->select('SUM(`bayar_invoice_detail`.`jml_bayar`) AS `total`');
			$ci->db->select('SUM(`invoice_detail`.`hpp`) AS `total_hpp`');
			$ci->db->select('SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) AS `total_detail`');
			$ci->db->from('jenis_cetakan');
			$ci->db->join('invoice_detail', '`jenis_cetakan`.`id_jenis` = `invoice_detail`.`jenis_cetakan`');
			$ci->db->join('bahan', '`invoice_detail`.`id_bahan` = `bahan`.`id`');
			$ci->db->join('bayar_invoice_detail', '`invoice_detail`.`id_invoice` = `bayar_invoice_detail`.`id_invoice`');
			$ci->db->where("MONTH(invoice_detail.update_date)='$bulan'");
			$ci->db->where("YEAR(invoice_detail.update_date)='$tahun'");
			// $ci->db->where('invoice_detail.update_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$ci->db->where('`invoice_detail`.`jenis_cetakan`',$id);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():0; 
			$total = ['total_jual'=>$result->total,'total_detail'=>$result->total_detail,'total_hpp'=>$result->total_hpp];
			return $total; 
		}
	}
	if ( ! function_exists('sum_hpps'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function sum_hpps($bulan,$tahun)
		{
			$ci = & get_instance();
			$ci->db->select('SUM(`invoice_detail`.`hpp`) AS `total`');
			$ci->db->from('bahan');
			$ci->db->join('invoice_detail','`bahan`.`id` = `invoice_detail`.`id_bahan`');
			$ci->db->where("MONTH(invoice_detail.update_date)",$bulan);
			$ci->db->where("YEAR(invoice_detail.update_date)",$tahun);
			$ci->db->where('`bahan`.`status_stok`','Y');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result->total; 
		}
	}
	
	if ( ! function_exists('sum_hpp'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function sum_hpp($bulan,$tahun,$id)
		{
			$ci = & get_instance();
			$ci->db->select('invoice_detail.hpp, SUM(`bahan`.`harga_modal`) AS `total`');
			$ci->db->from('jenis_cetakan');
			$ci->db->join('invoice_detail', '`jenis_cetakan`.`id_jenis` = `invoice_detail`.`jenis_cetakan`');
			$ci->db->join('bahan', '`invoice_detail`.`id_bahan` = `bahan`.`id`');
			$ci->db->where("MONTH(invoice_detail.update_date)='$bulan'");
			$ci->db->where("YEAR(invoice_detail.update_date)='$tahun'");
			// $ci->db->where('invoice_detail.update_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$ci->db->where('`jenis_cetakan`.`id_jenis`',$id);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result; 
		}
	}
	if ( ! function_exists('sum_bayar_pembelian'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function sum_bayar_pembelian($id)
		{
			$ci = & get_instance();
			$ci->db->select('SUM(`bayar_pembelian`.`jml_bayar`) AS `total`');
			$ci->db->from('bayar_pembelian');
			$ci->db->where('`bayar_pembelian`.`id_pembelian`',$id);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->total:FALSE; 
			return $result; 
		}
	}
	if ( ! function_exists('sum_pembelian'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function sum_pembelian($bulan,$tahun,$id)
		{
			$ci = & get_instance();
			$ci->db->select('id_pembelian`, SUM(jumlah * harga) AS total');
			$ci->db->from('pembelian_detail');
			$ci->db->where("MONTH(create_date)='$bulan'");
			$ci->db->where("YEAR(create_date)='$tahun'");
			$ci->db->where('id_biaya',$id);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row():FALSE; 
			return $result; 
		}
	}
	
	if ( ! function_exists('sum_pengeluaran'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		
		function sum_pengeluaran($bulan,$tahun,$id)
		{
			$ci = & get_instance();
			$ci->db->select('SUM(jumlah * harga) AS total');
			$ci->db->from('pengeluaran_detail');
			// $ci->db->where("DATE(create_date) >=", $start_date);
			// $ci->db->where("DATE(create_date) <=", $end_date);
			$ci->db->where("MONTH(create_date)='$bulan'");
			$ci->db->where("YEAR(create_date)='$tahun'");
			$ci->db->where('id_biaya',$id);
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->total:FALSE; 
			return $result; 
		}
	}
	
	if ( ! function_exists('stok_masuk'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_masuk($id)
		{
			$ci = & get_instance();
			$ci->db->select_sum('jumlah');
			$ci->db->from('stok_masuk');
			$ci->db->where('id_bahan',$id);
			$ci->db->group_by('id_bahan');
			$query = $ci->db->get(); 
			$result = ($query->num_rows() > 0)?$query->row()->jumlah:0; 
			return $result; 
		}
	}
	if ( ! function_exists('stok_keluar'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function stok_keluar($val)
		{
			$ci = & get_instance();
			$qry = $ci->db->query("SELECT SUM(jumlah) AS jml FROM stok_keluar where id_bahan=$val GROUP BY id_bahan");
			if($qry->num_rows() >0 ){
				$data = $qry->row()->jml;
				}else{
				$data = 0;
			}
			return $data;
		}
	}
	
	
	if ( ! function_exists('cek_stok_keluar'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function cek_stok_keluar($val)
		{
			$ci = & get_instance();
			$qry = $ci->db->query("SELECT SUM(jumlah) AS jml FROM stok_keluar where id_invoice=$val GROUP BY id_invoice");
			if($qry->num_rows() >0 ){
				$data = $qry->row()->jml;
				}else{
				$data = 0;
			}
			return $data;
		}
	}
	
	if ( ! function_exists('pengaturan'))
	{
		/**
			* Code pengaturan
			*
			@param $val string
			@return string
		*/
		function pengaturan($val)
		{
			$ci = & get_instance();
			$title = $ci->db->query("SELECT * FROM shared_folder where nama='$val'")->row_array();
			return $title['isi'];
		}
	}
	
	if ( ! function_exists('select_box'))
	{
		/**
			* Code select_box
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@param params array
			@return string
		*/
		function select_box($data, $parent = 0, $parent_id = 0, $Nilai='',$params = array())
		{
			$ci = & get_instance();
			
			if (isset($data[$parent]))
			{
				$id = $params['id'];
				$title = $params['title'];
				$html = "";
				
				if ($ci->session->level=='admin'){
					$html .= '<option value="0">Semua</option>';
				}
				foreach ($data[$parent] as $v)
				{
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v->$id, $_arrNilai) === false)? '' : 'selected';
					$html .= '<option value="'.$v->$id.'" '.$_ck.'>&nbsp;'.$v->$title.'</option>';
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('select_kbox'))
	{
		/**
			* Code select_kbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function select_kbox($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			$ci = & get_instance();
			if (isset($data[$parent]))
			{
				
				$html = "";
				foreach ($data[$parent] as $v)
				{
					$child = select_kbox($data, $v->id, $parent_id, $Nilai);
					$_arrNilai = explode(',', $Nilai);
					if ($ci->session->level=='admin'){
						$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
						$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}else{
						if (in_array($v->id, $_arrNilai)){
							$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
							$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}
					}
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('select_badge'))
	{
		/**
			* Code select_badge
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function select_badge($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			$ci = & get_instance();
			if (isset($data[$parent]))
			{
				
				$html = "";
				foreach ($data[$parent] as $v)
				{
					$child = select_badge($data, $v->id, $parent_id, $Nilai);
					$_arrNilai = explode(',', $Nilai);
					if ($ci->session->level=='admin' AND $parent_id==0){
						$_ck = (array_search($v->id, $_arrNilai) === false)? '' : 'selected';
						$html .= '<option value="'.$v->id.'" '.$_ck.'>&nbsp;'.$v->title.'</option>';
						}else{
						if (in_array($v->id, $_arrNilai)){
							$html .= '<button type="button" class="btn btn-secondary btn-sm flat mb-1" readonly>'.$v->title.'</button>&nbsp;';
							$html .= '<input type="hidden" name="akses[]" value="'.$v->id.'">';
							
						}
					}
				}
				return $html;
			}
		}
	}
	if ( ! function_exists('checkbox_menu'))
	{
		/**
			* Code checkbox_menu
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox_menu($data, $parent = 0, $parent_id = 0, $Nilai = '')
		{
			static $i = 1;
			$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
			$tab = $i * 0;
			if (isset($data[$parent])) {
				$i++;
				$html = "";
				$a = 0;
				foreach ($data[$parent] as $v) {
					$child = checkbox_menu($data, $v['id_level'], $parent_id, $Nilai);
					
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v['id_level'], $_arrNilai) === false) ? '' : TRUE;
					$array = array(
					'name'          => 'idlevel[]',
					'id'            => 'idlevel'.$v['id_level'],
					'value'         => $v['id_level'],
					'checked'       => $_ck,
					'class'         => 'custom-control-input checkbox get_value'
					);
					$attributes = array(
					'class' => 'custom-control-label',
					'style' => ''
					);
					$html .= '<div class="custom-control custom-checkbox">';
					$html .= $ieTab. form_checkbox($array);
					$html .= form_label($v['nama'], 'idlevel'.$v['id_level'], $attributes);;
					$html .= "</div>";
					if ($child) {
						$i--;
						$html .= $child;
					}
					$a++;
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('checkcard'))
	{
		/**
			* Code checkcard
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkcard($data, $parent = 0, $parent_id = 0, $Nilai='')
		{
			static $i = 1;
			$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ="";
				foreach ($data[$parent] as $v)
				{
					$child = checkcard($data, $v['idmenu'], $parent_id, $Nilai);
					
					$_arrNilai = explode(',', $Nilai);
					$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : TRUE;
					$array = array(
					'name'          => 'data[]',
					'id'            => 'data',
					'value'         => $v['idmenu'],
					'checked'       => $_ck,
					'style'         => ''
					);
					
					$html .= '<div class="checkbox">';
					$html .= $ieTab. form_checkbox($array).$v['nama_menu'];
					
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	if ( ! function_exists('checkbox'))
	{
		/**
			* Code checkbox
			*
			@param $data array
			@param $parent int
			@param $parent_id int
			@param $Nilai int / string comma
			@return string
		*/
		function checkbox($data, $parent = 0, $parent_id = 0, $Nilai='',$_parent=0) {
			static $i = 1;
			$ieTab = str_repeat("&nbsp;&nbsp;&nbsp;", $i * 2);
			$tab = $i * 0 ;
			if (isset($data[$parent]))
			{
				$i++;
				$html ='';
				foreach ($data[$parent] as $v) {
					$child = checkbox($data, $v['idmenu'], $parent_id, $Nilai,$_parent);
					//Edit Di Item
					
					$_arrNilai = explode(',', $Nilai);
					if($_parent==1)
					{
						$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? 'disabled' : TRUE;
					}
					else
					{
						$_ck = (array_search($v['idmenu'], $_arrNilai) === false)? '' : TRUE;
					}
					$array = array(
					'name'          => 'data[]',
					'id'            => 'checkb'.$v['idmenu'],
					'value'         => $v['idmenu'],
					'checked'       => $_ck,
					'class'         => 'custom-control-input checkbox'
					);
					$attributes = array(
					'class' => 'custom-control-label',
					'style' => ''
					);
					$html .= '<div class="custom-control custom-checkbox">';
					$html .= $ieTab. form_checkbox($array);
					$html .= form_label($v['nama_menu'], 'checkb'.$v['idmenu'], $attributes);
					$html .= "</div>";
					if ($child) { $i--; $html .= $child; }
				}
				return $html;
			}
		}
	}
	
	if ( ! function_exists('cek_desain'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return int
		*/
		function cek_desain($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('id_desain','invoice',['id_invoice'=>$id]);
			$data = 0;
			if ($query->num_rows()>0)
			{
				$row = $query->row()->id_desain;
			}
			return $row;
		}
	}
	
	if ( ! function_exists('jenis_konsumen'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function jenis_konsumen($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('jenis','konsumen',['id'=>$id]);
			$data = 1;
			if ($query->num_rows()>0)
			{
				$row = $query->row()->jenis;
			}
			return $row;
		}
	}
	
	if ( ! function_exists('jenis_member'))
	{
		/**
			* Code cek_desain
			*
			@param $id int
			@return id
		*/
		function jenis_member($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('jenis_member','konsumen',['id'=>$id]);
			$data = 1;
			if ($query->num_rows()>0)
			{
				$row = $query->row()->jenis_member;
			}
			return $row;
		}
	}
	
	if ( ! function_exists('get_satuan'))
	{
		/**
			* Code get_satuan
			*
			@param $id int
			@return string
		*/
		function get_satuan($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('satuan','satuan',['id'=>$id]);
			$data = 'Pcs';
			if ($query->num_rows()>0)
			{
				$data = $query->row()->satuan;
			}
			return $data;
		}
	}
	
	if ( ! function_exists('getJenisBayar'))
	{
		/**
			* Code getJenisBayar
			*
			@param $id int
			@return string
		*/
		function getJenisBayar($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('nama_bayar','jenis_bayar',['id'=>$id]);
			$data = "-";
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->nama_bayar;
				
			}
			return $data;
		}
	}
	
	if ( ! function_exists('getIdAkunJenis'))
	{
		/**
			* Code getJenisBayar
			*
			@param $id int
			@return string
		*/
		function getIdAkunJenis($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('id_akun','jenis_cetakan',['id_jenis'=>$id]);
			$data = 1;
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->id_akun;
				
			}
			return $data;
		}
	}
	
	if ( ! function_exists('getIdAkunPengeluaran'))
	{
		/**
			* Code getJenisBayar
			*
			@param $id int
			@return string
		*/
		function getIdAkunPengeluaran($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('id_akun','jenis_pengeluaran',['id_jenis'=>$id]);
			$data = 1;
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->id_akun;
				
			}
			return $data;
		}
	}
	
	if ( ! function_exists('getIdAkun'))
	{
		/**
			* Code getJenisBayar
			*
			@param $id int
			@return string
		*/
		function getIdAkun($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('id_akun','jenis_bayar',['id'=>$id]);
			$data = "-";
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->id_akun;
				
			}
			return $data;
		}
	}
	
	if ( ! function_exists('getNameKas'))
	{
		/**
			* Code getNameKas
			*
			@param $id int
			@return string
		*/
		function getNameKas($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('title','jenis_kas',['id_akun'=>$id]);
			$data = "-";
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->title;;
			}
			return $data;
		}
	}
	
	if( ! function_exists('getstatusBahan'))
	{
		/**
			* Code getNameKas
			*
			@param $id int
			@return string
		*/
		function getstatusBahan($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('status_stok','bahan',['id'=>$id]);
			$data = "-";
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->status_stok;;
			}
			return $data;
		}
	}
	
	if( ! function_exists('getDetailBahan'))
	{
		/**
			* Code getNameKas
			*
			@param $id int
			@return string
		*/
		function getDetailBahan($id)
		{
			$ci = & get_instance();
			 
			$query = $ci->model_app->pilih_where('title,status,type_harga','bahan',['id'=>$id]);
			$data = "-";
			if ($query->num_rows()>=1)
			{
				$data = $query->row();
			}
			return $data;
		}
	}
	
	if( ! function_exists('getBahan'))
	{
		/**
			* Code getNameKas
			*
			@param $id int
			@return string
		*/
		function getBahan($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('title','bahan',['id'=>$id]);
			$data = "-";
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->title;;
			}
			return $data;
		}
	}
	
	if( ! function_exists('pilihBahan'))
	{
		/**
			* Code getNameKas
			*
			@param $id int
			@return string
		*/
		function pilihBahan($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('title','bahan',['id'=>$id]);
			$data = '';
			if ($query->num_rows()>=1)
			{
				$data .= '<option value="'.$query->row()->id.'" selected="selected">'.$query->row()->title.'</option> ';
			}
			return $data;
		}
	}
	
	if ( ! function_exists('getAkun'))
	{
		/**
			* Code getNameKas
			*
			@param $id int
			@return string
		*/
		function getAkun($id)
		{
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('nama_reff','akun',['no_reff'=>$id]);
			$data = "-";
			if ($query->num_rows()>=1)
			{
				$data = $query->row()->nama_reff;;
			}
			return $data;
		}
	}
	
	
	if ( ! function_exists('jproduk'))
	{
		/**
			* Code jproduk
			*
			@param $table string
			@param $id int
			@param $title string
			@return string
		*/
		function jproduk($table,$id,$title){
			$ci = & get_instance();
			$query = $ci->db->query("SELECT * FROM `$table` where id_jenis='$id'");
			if ($query->num_rows()>=1){
				$tmp = $query->row_array();
				return $tmp[$title];
				}else{
				return 'error';
			}
		}
	}
	
	if ( ! function_exists('nama_produk'))
	{
		/**
			* Code nama_produk
			*
			@param $id int
			@return string
		*/
		function nama_produk($id){
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('title','produk',['id'=>$id]);
			if ($query->num_rows()>=1){
				return $query->row()->title;
				}else{
				return 'error';
			}
		}
	}
	
	if ( ! function_exists('juser'))
	{
		/**
			* Code juser
			*
			@param $id int
			@return string
		*/
		function juser($id){
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('nama_lengkap','tb_users',['id_user'=>$id]);
			if ($query->num_rows()>=1){
				return $query->row()->nama_lengkap;
				}else{
				return 'error';
			}
		}
	}
	if ( ! function_exists('ttd_user'))
	{
		/**
			* Code ttd_user
			*
			@param $str string
			@return string
		*/
		function ttd_user($str){
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('nama_lengkap','tb_users',['level'=>$str]);
			if ($query->num_rows()>=1){
				return $query->row()->nama_lengkap;
				}else{
				return 'error';
			}
		}
	}
	
	if ( ! function_exists('jabatan'))
	{
		/**
			* Code ttd_user
			*
			@param $str string
			@return string
		*/
		function jabatan($str){
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('app_secret','tb_users',['level'=>$str]);
			if ($query->num_rows()>=1){
				return $query->row()->app_secret;
				}else{
				return 'error';
			}
		}
	}
	
	if ( ! function_exists('detail_user'))
	{
		/**
			* Code juser
			*
			@param $id int
			@return string
		*/
		function detail_user($id){
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('nama_lengkap,no_hp,level','tb_users',['id_user'=>$id]);
			if ($query->num_rows()>=1){
				return $query->row();
				}else{
				return 'error';
			}
		}
	}
	
	// if ( ! function_exists('jkas'))
	// {
	// /**
	// * Code jkas
	// *
	// @param $id int
	// @return int
	// */
	// function jumlahkas($id){
	// $ci = & get_instance();
	// $query = $ci->model_app->pilih_where('jumlah_uang','jenis_kas',['id_akun'=>$id]);
	// if ($query->num_rows()>=1){
	// return $query->row()->jumlah_uang;
	// }else{
	// return 0;
	// }
	// }
	// }
	
	if ( ! function_exists('saldo'))
	{
		/**
			* Code saldo
			*
			@param $id string
			@return int
		*/
		function saldo($id){
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('pemasukan','kas_masuk',['no_reff'=>$id]);
			if ($query->num_rows()>=1){
				return $query->row()->pemasukan;
				}else{
				return 0;
			}
		}
	}
	if ( ! function_exists('sum_jurnal'))
	{
		/**
			* Code sum_jurnal
			*
			@params int
			@return int
		*/
		function sum_detail($id_invoice){
			$ci = & get_instance();
			$sum = $ci->db->query("SELECT SUM(`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) AS `total`,`invoice_detail`.`id_invoice` FROM `invoice_detail` WHERE id_invoice = '$id_invoice' GROUP BY `invoice_detail`.`id_invoice`");
			
			return $sum->row()->total;
		}
	}
	if ( ! function_exists('sum_jurnal'))
	{
		/**
			* Code sumPengeluaran
			*
			@return array
		*/
		function sum_jurnal($jenis,$where,$bulan,$tahun){
			$ci = & get_instance();
			$ci->db->select('SUM(saldo) AS `total`');
			$ci->db->where('jenis_saldo',$jenis);
			$ci->db->where('no_reff',$where);
			$ci->db->where('month(jurnal_transaksi.tgl_transaksi)',$bulan);
			$ci->db->where('year(jurnal_transaksi.tgl_transaksi)',$tahun);
			$query = $ci->db->get('jurnal_transaksi');
			$result = ($query->num_rows() > 0)?$query->row():0; 
			return $result;
		}
	}
	
	if ( ! function_exists('tags_bahan'))
	{
		/**
			* Code tags_bahan
			*
			@param int
			@return array
		*/
		function tags_bahan($id){
			$ci = & get_instance();
			$query = $ci->model_app->pilih_where('id_bahan','produk',['id'=>$id])->result();
			$TampungData = array();
			foreach ($query as $data_tags){
				$tags = explode(',',strtolower(trim($data_tags->id_bahan)));
				if(empty($data_tags->id_bahan)){echo'';}else{
					foreach($tags as $val) {
						$TampungData[] = $val;
					}}}
					$jumlah_tag = array_count_values($TampungData);
					ksort($jumlah_tag);
					$output = array();
					foreach($jumlah_tag as $key=>$val) {
						$querys = $ci->model_app->view_where('bahan',['id'=>$key,'kunci'=>0]);
						foreach ($querys->result() as $row){
							$output[] = '<option selected value="'.$row->id.'">'.$row->title.'</options>';
						}
					}
					
					$tags= implode(' ',$output);
					return $tags;
		}
	}
	
	if ( ! function_exists('template'))
	{
		/**
			* Code template
			*
			@param int
			@return string
		*/
		function template(){
			$ci = & get_instance();
			$query = $ci->model_app->view_where('themes',['id'=>$key,'pub'=>0]);
			if ($query->num_rows()>=1){
				if ($this->session->level==''){
					redirect(base_url().'adm');
					exit;
				}
				return $query->row()->folder;
				}else{
				if ($this->session->level==''){
					redirect(base_url().'adm');
					exit;
				}
			}
		}
	}
	
	if ( ! function_exists('pilih'))
	{
		/**
			* Code pilih
			*
			@param string
			@param array
			@param int
			@return string
		*/
		function pilih($tbl,$where,$id){
			$ci = & get_instance();
			return $ci->db->query("SELECT * FROM `$tbl` where $where='$id'")->row_array();
		}
	}
	
	if ( ! function_exists('info'))
	{
		/**
			* Code info
			*
			@param int
			@return string
		*/
		function info(){
			$ci = & get_instance();
			$data = array();
			if ($ci->db->table_exists('info'))
			{
				$info = $ci->model_app->views('info')->row_array();
				if(!empty($info)){
					$status = ['status'=>TRUE];
					$data = array_merge($info,$status);
					}else{
					$data = ['status'=>FALSE,'ket'=>base64_encode('Migrate')];
				}
				return $data;
			}
			else
			{
				$data = ['status'=>FALSE,'ket'=>base64_encode('Migrate')];
				return $data;
			}
			
		}
	}
	
	if ( ! function_exists('logo'))
	{
		/**
			* Code logo
			*
			@return string
		*/
		function logo(){
			$ci = & get_instance();
			return $ci->model_app->pilih('logo','info')->row()->logo;
		}
	}
	
	if ( ! function_exists('favicon'))
	{
		/**
			* Code favicon
			*
			@return string
		*/
		function favicon(){
			$ci = & get_instance();
			return $ci->model_app->pilih('favicon','info')->row()->favicon;
		}
	}
	
	if ( ! function_exists('bank'))
	{
		/**
			* Code bank
			*
			@param int
			@return string
		*/
		function bank($id){
			$data = "-";
			if($id > 0){
				$ci = & get_instance();
				$query = $ci->db->query("SELECT inisial FROM rekening_bank WHERE id=".$id);
				if ($query->num_rows()>=1)
				{
					$data = $query->row()->inisial;
				}
			}
			return $data;
		}
	}
	
	function bayar($id){
		$ci = & get_instance();
		$ci->db->select('SUM(`bayar_invoice_detail`.`jml_bayar`) AS `Totalbayar`');
		$ci->db->from('bayar_invoice_detail');
		$ci->db->where('`bayar_invoice_detail`.id_invoice',$id);
		$ci->db->group_by("`bayar_invoice_detail`.`id_invoice`");
		return $ci->db->get()->row_array();
	}
	function count_status($id){
		$ci = & get_instance();
		$ci->db->where('id_invoice',$id);
		return $ci->db->count_all_results('invoice_detail');
	}
	
	function sum_status($id){
		$ci = & get_instance();
		$ci->db->select('SUM(invoice_detail.status) AS `total`');
		$ci->db->from('invoice_detail');
		$ci->db->where('id_invoice',$id);
		return $ci->db->get()->row()->total;
	}
	
	function trx_now(){
		$ci = & get_instance();
		$ci->db->where(['tgl_trx'=>'CURDATE()','oto'=>1]);
		return $ci->db->count_all_results('invoice');
	}
	function c_acc(){
		$ci = & get_instance();
		$ci->db->where('oto',1);
		return $ci->db->count_all_results('invoice');
	}
	function c_pending(){
		$ci = & get_instance();
		$ci->db->where('oto',0);
		return $ci->db->count_all_results('invoice');
	}
	
	
	function autoNumbers($awalan,$digit)
	{
		//%06s
		$ci = & get_instance();
		$ci->db->select_max('id_member','max_id');
		$query = $ci->db->get('konsumen');
		if($query->num_rows()>0){
			$data=$query->row();
			$maxid = $data->max_id;
			$count_awalan = strlen($awalan);
			$potong_awalan = str_replace($awalan,"",$maxid);
			$count_potong_awalan = strlen($potong_awalan);
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			$kode_baru = $awalan.sprintf($digit, $noUrut);
			}else{
			$kode_baru = $awalan.sprintf($digit, 1);
		}
		return $kode_baru;
	}
	function autoNumber($awalan,$digit,$id_table,$table)
	{
		//%06s
		$ci = & get_instance();
		$ci->db->select_max($id_table,'max_id');
		$query = $ci->db->get($table);
		if($query->num_rows()>0){
			$data=$query->row();
			$maxid = $data->max_id;
			$count_awalan = strlen($awalan);
			$potong_awalan = str_replace($awalan,"",$maxid);
			$count_potong_awalan = strlen($potong_awalan);
			$noUrut = (int) substr($maxid, $count_awalan, $count_potong_awalan);
			$noUrut++;
			$kode_baru = $awalan.sprintf($digit, $noUrut);
			}else{
			$kode_baru = $awalan.sprintf($digit, 1);
		}
		return $kode_baru;
	}
	
	function sumPiutang($id){
		$ci = & get_instance();
		$query = $ci->model_app->pilih_where('SUM(`bayar_invoice_detail`.`jml_bayar`) AS `piutang`','bayar_invoice_detail',['id_invoice'=>$id]);
		$data = [];
		if($query->num_rows() > 0){
			$data =  $query->result_array();
		}
		return $data;
	}
	
	function totalDiskon($id){
		$ci = & get_instance();
		$qry = "SELECT sum(invoice_detail.jumlah * invoice_detail.harga) AS Total,
		SUM((`invoice_detail`.`jumlah` * `invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))  AS sisa
		FROM
		`invoice_detail`
		WHERE
		`invoice_detail`.`id_invoice` = $id";
		$query = $ci->db->query($qry);
		$data = 0;
		if($query->num_rows() > 0){
			$row =  $query->row();
			$data .= $row->sisa;
		}
		return $data;
	}
	
	function sumOrderDiskon($id){
		$ci = & get_instance();
		$qry = "SELECT diskon, sum(invoice_detail.jumlah * invoice_detail.harga) AS Total,
		SUM((`invoice_detail`.`jumlah` * `invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))  AS sisa
		FROM
		`invoice_detail`
		WHERE
		`invoice_detail`.`id_invoice` = $id";
		$query = $ci->db->query($qry);
		$data = 0;
		if($query->num_rows() > 0){
			$data =  $query->row();
		}
		return $data;
	}
	
	function sumOrder($id){
		$ci = & get_instance();
		$qry = "SELECT sum(invoice_detail.jumlah * invoice_detail.harga) AS Total,
		SUM((`invoice_detail`.`jumlah` * `invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))  AS sisa
		FROM
		`invoice_detail`
		WHERE
		`invoice_detail`.`id_invoice` = $id";
		$query = $ci->db->query($qry);
		$data = 0;
		if($query->num_rows() > 0){
			$row =  $query->row();
			$data .= $row->Total;
		}
		return $data;
	}
	
	function detail_order($id){
		$ci = & get_instance();
		$qry = "SELECT * FROM `invoice_detail`
		WHERE `invoice_detail`.`id_invoice` = $id";
		$query = $ci->db->query($qry);
		$data = [];
		if($query->num_rows() > 0){
			$data =  $query->result();
		}
		return $data;
	}
	
	function detail_pekerjaan($id,$operator=''){
		$ci = & get_instance();
		$and ='';
		if(!empty($operator)){
			$and = "AND invoice_detail.id_operator=".$operator;
		}
		$qry = "SELECT * FROM `invoice_detail`
		WHERE `invoice_detail`.`id_invoice` = $id AND `invoice_detail`.`jenis_cetakan`!=9 $and";
		$query = $ci->db->query($qry);
		$data = [];
		if($query->num_rows() > 0){
			$data =  $query->result();
		}
		return $data;
	}
	
	function detail_order_desain($id,$id_desain){
		$ci = & get_instance();
		$qry = "SELECT *
		FROM
		`invoice`
		INNER JOIN `invoice_detail` ON (`invoice`.`id_invoice` = `invoice_detail`.`id_invoice`)
		WHERE `invoice_detail`.`jenis_cetakan` = 9 AND `invoice_detail`.`id_invoice` = $id AND `invoice`.`id_desain` = $id_desain";
		$query = $ci->db->query($qry);
		$data = [];
		if($query->num_rows() > 0){
			$data =  $query->result();
		}
		return $data;
	}
	
	
	function jenis_cetakan($id){
		$ci = & get_instance();
		$qry = "SELECT
		`jenis_cetakan`.`jenis_cetakan`
		FROM
		`jenis_cetakan`
		WHERE
		`jenis_cetakan`.`id_jenis` = '$id'";
		$query = $ci->db->query($qry);
		$data = '';
		if($query->num_rows() > 0){
			$row =  $query->row();
			$data .= $row->jenis_cetakan;
		}
		return $data;
	}																																																					