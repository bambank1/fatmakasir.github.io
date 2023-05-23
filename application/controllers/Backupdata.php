<?php if(! defined('BASEPATH')) exit ('no direct access allowed');
    
    class Backupdata extends CI_controller{
        
        public function __construct()
		{
			parent::__construct();
			cek_session_login();
            $this->load->helper('directory');
            $this->load->helper("file");
            $this->load->helper('date');
            $this->load->helper('download');
            $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
            $this->title = info()['title']; 
		}
		
        public function database()
		{
			cek_menu_akses();
			$data['title'] = 'Backup db | '.$this->title;
			$this->template->load('main/themes','backup',$data);
		}
        public function list_data()
		{
            
            $fetch_data = directory_map('./backup_db/', FALSE, TRUE); 
            $path = FCPATH.'backup_db/';
            $data = array();  
            $no=1;
            foreach($fetch_data as $row)  
            {  
                $filesize = filesize($path.$row);
                $dname = explode(".", $row);
                $ext = end($dname);
                $exp = explode('_',$row);
				if ($ext == 'sql') {
					$resto = '';
					$archive = '<button type="button" class="btn btn-primary btn-sm restoredb" data-toggle="tooltip" title="Restore DB" data-file="' . $row . '"><i class="fa fa-retweet"></i></button>';
					} else {
					$resto = "";
					$archive = '<button type="button" class="btn btn-danger btn-sm unzipdb" data-toggle="tooltip" title="Unzip DB" data-file="' . $row . '"><i class="fa fa-archive "></i></button>';
				}
				if ($exp[1] == date('Y-m-d')) {
					$btn = '<button type="button" class="btn btn-success btn-sm downloaddb" data-toggle="tooltip" title="Download DB" data-file="' . $row . '"><i class="fa fa-download"></i></a></button> ' . $archive;
					} else {
					$btn = '<button type="button" class="btn btn-info btn-sm downloaddb" data-toggle="tooltip" title="Download DB" data-file="' . $row . '"><i class="fa fa-download"></i></a></button> ' . $archive;
				}
				$file = '<a class="downloaddb" data-file="' . $row . '" href="javascript:void(0)">' . $row . '</a>';
                $jam = $exp[2];
                $expj = explode('.',$jam);
                $jam = jam_replace($expj[0]);
                
                $tgl = $exp[1].' '.$jam;
                $tgl = dtimes($tgl,true,false);
                $sub_array = array();
                $sub_array[] = $file;   
                $sub_array[] = $tgl;  
                $sub_array[] = format_size($filesize) ;
                $sub_array[] = $btn;   
                $sub_array[] = '<button type="button" class="btn btn-danger btn-sm hapus" data-toggle="tooltip" title="Hapus DB" data-file="'.$row.'"><i class="fa fa-trash"></i></button>';  
                $data[] = $sub_array;  
			}  
            $output = array(   
            "data" => $data  
            );  
            echo json_encode($output);  
			
		}
        public  function download_db(){
            cek_nput_post('GET');
			database_demo_admin('Unduh');
			$this->load->helper('download');
			$file = $this->input->post('file');
			$remoteURL = './backup_db/' . $file;
			force_download($remoteURL, null);
		}
        public  function hapusdb(){
            cek_nput_post('GET');
            database_demo('Hapus');
            $file = $this->input->post('file');
            $path = "./backup_db/".$file;
            if (is_readable($path) && unlink($path)) {
                $data = array('status'=>200,'file'=>$file);
                } else {
                $data = array('status'=>400,'file'=>$file);
			}
            echo json_encode($data);  
		}
		
        public  function backupdb(){
            database_demo('Backup');
			
            $this->load->dbutil();
            
            // nyiapin aturan untuk file backup
            $aturan = array(    
            'format'      => 'zip',            
            'filename'    => 'backup-on_'. date("Y-m-d_H-i-s") .'.sql'
            );
            
            // $backup =& $this->dbutil->backup($aturan);
            $backup = $this->dbutil->backup($aturan);
            $folder = 'backup_db';
            if (!is_dir('./'.$folder)) {
				mkdir('./'.$folder, 0777, TRUE);
			}
            $nama_database = 'backup-on_'. date("Y-m-d_H-i-s") .'.zip';
            $simpan = 'backup_db/'.$nama_database;
            
            $this->load->helper('file');
            write_file($simpan, $backup);
            
            if (is_readable($simpan)) {
                $data = array('status'=>200,'msg'=>'Data berhasil dibackup');
                } else {
                $data = array('status'=>400,'error'=>'Data gagal dibackup');
			}
            echo json_encode($data);  
            // $this->load->helper('download');
            // force_download($nama_database, $backup);
		}
        function unzipdb(){
            cek_nput_post('GET');
            $file = $this->input->post('file');
            ## Extract the zip file ---- start
            $zip = new ZipArchive;
            $res = $zip->open("backup_db/".$file);
            if ($res === TRUE) {
                
                // Unzip path
                $extractpath = "backup_db/";
                
                // Extract file
                $zip->extractTo($extractpath);
                $zip->close();
                $data = array('status'=>200,'msg'=>'File berhasil di Extract.');
                
                } else {
                $data = array('status'=>400,'msg'=>'File gagal di extract.');
                
			}
            echo json_encode($data);  
            ## ---- end
		}
        function restoredb()
        {
            cek_nput_post('GET');            
            database_demo('Restore');
			ini_set('memory_limit','256M');
			ini_set('max_execution_time',0);
            $file = $this->input->post('file');
            $isi_file = file_get_contents('./backup_db/'.$file);
            $string_query = rtrim( $isi_file, "\n;");
            $array_query = explode(";", $string_query);
            // print_r($array_query);
            foreach($array_query as $query)
            {
                $res = $this->db->query($query);
			}
            if ($res==true) {
                $data = array('status'=>200,'msg'=>'Database berhasil di Restore.');
                }else{
                $data = array('status'=>400,'msg'=>'Database gagal di Restore.');
			}
            echo json_encode($data);  
		}
		
        function reset_ulang()
        {
            cek_nput_post('GET');
            database_demo_admin('Reset');
			 
            $this->db->trans_off();    
            $this->db->trans_begin();
			
			//kosongkan jenis_cetakan
            $this->db->truncate('jenis_cetakan');
			$reset_kategori = $this->dummy->reset_kategori();
			$this->db->insert_batch('jenis_cetakan', $reset_kategori);
			
			//kosongkan bahan
            $this->db->truncate('bahan');
			$bahan = $this->dummy->reset_bahan();
			$this->db->insert_batch('bahan', $bahan);
			
			//kosongkan satuan
            $this->db->truncate('satuan');
			$satuan = $this->dummy->reset_satuan();
			$this->db->insert_batch('satuan', $satuan);
			
			//kosongkan produk
            $this->db->truncate('produk');
			$produk = $this->dummy->reset_produk();
			$this->db->insert_batch('produk', $produk);
			
			//kosongkan supplier
            $this->db->truncate('supplier');
			$supplier = $this->dummy->reset_supplier();
			$this->db->insert_batch('supplier', $supplier);
			
			//kosongkan jenis_pengeluaran
            $this->db->truncate('jenis_pengeluaran');
			$jenis_pengeluaran = $this->dummy->reset_pengeluaran();
			$this->db->insert_batch('jenis_pengeluaran', $jenis_pengeluaran);
			
			//kosongkan konsumen
            $this->db->truncate('konsumen');
			$konsumen = $this->dummy->reset_konsumen();
            $this->db->insert_batch('konsumen', $konsumen);
			
			
			//kosongkan rekening_bank
            $this->db->truncate('rekening_bank');
			$rekening_bank = $this->dummy->reset_rekening();
            $this->db->insert_batch('rekening_bank', $rekening_bank);
			
            $this->db->truncate('harga');               //kosongkan harga
            $this->db->truncate('ukuran');              //kosongkan ukuran
            $this->db->truncate('invoice');             //kosongkan invoice
            $this->db->truncate('invoice_detail');      //kosongkan invoice_detail
            $this->db->truncate('bayar_invoice_detail');//kosongkan bayar_invoice_detail
            $this->db->truncate('pengeluaran');         //kosongkan pengeluaran
            $this->db->truncate('pengeluaran_detail');  //kosongkan pengeluaran_detail
            $this->db->truncate('kas_masuk');           //kosongkan kas_masuk
            $this->db->truncate('surat_jalan');         //kosongkan surat_jalan
            $this->db->truncate('user_agent');          //kosongkan user_agent
			
            $this->session->unset_userdata('cart');
            $this->session->unset_userdata('cartp');
            $this->session->unset_userdata('cartbeli');
            $this->db->update('tb_users',['last_invoice'=>0,'last_idp'=>0],['aktif'=>'Y']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
                $data = array('status'=>200,'msg'=>'Database gagal di reset');
			}
			else
			{
				$this->db->trans_commit();
                $data = array('status'=>200,'msg'=>'Database berhasil di reset');
			}
			
            echo json_encode($data);
		}
	}                                                    		