<?php 
	defined("BASEPATH") or exit();
	class Model_stok extends CI_model{
		
		public function list_cc(){
			$sql = query("SELECT * FROM bahan WHERE status_stok='Y'");
			$arr = array();
			foreach($sql->result_array() as $row){
				$arr[$row['id']] = $row['title'];
			}
			return $arr;
		}
		public function get_current_mutasi($list){
			$save = array();
			
			foreach($list as $r){
				array_push($save, $r->id);
			}
			// print_r($save);
			$imp = "";
			if(count($save) > 0){
				$imp = "WHERE id_bahan IN (".implode(",",$save).")";
			}
			
			$arr = array();
			$sql2 = $this->db->query("SELECT id_bahan, harga_beli,create_date, SUM(jumlah) AS jml FROM stok_masuk $imp GROUP BY id_bahan");
			foreach($sql2->result_array() as $row){
				$arr[$row['id_bahan']] = $row['jml'];
			}
			
			
			return $arr;
		}
		
		public function get_stok_keluar($list){
			$save = array();
			
			foreach($list as $r){
				array_push($save, $r->id);
			}
			// print_r($save);
			$imp = "";
			if(count($save) > 0){
				$imp = "WHERE id_bahan IN (".implode(",",$save).")";
			}
			
			$arr = array();
			
			$tj = query("SELECT id_bahan, SUM(jumlah) AS jml_terjual FROM stok_keluar $imp GROUP BY id_bahan");
			foreach($tj->result_array() as $r3){
				
				$arr[$r3['id_bahan']] = $r3['jml_terjual'];
				
			}
			
			return $arr;
		}
		
		public function get_last_id($nm){
			$arr = array(
			"title" => $nm,
			"tanggal" => date("Y-m-d H:i:s"),
			"stat" => 1
			);
			$this->db->insert("laporan_stok",$arr);
			$id = $this->db->insert_id();
			
			
			return $id;
		}
		
		public function report_master($idproj){
			$arr = array();
			$sql = query("SELECT * FROM bahan ORDER BY id");
			foreach($sql->result_array() as $row){
				$arr[$row['id']] = array();
			}
			 
			$sql2 = query("SELECT * FROM history_stok WHERE tb = 'stok_masuk' AND id_laporan = ".quote($idproj)." AND stat <> 9 ORDER BY create_date");
			$n = 0;
			foreach($sql2->result_array() as $row2){
				$tgl = strtotime($row2['create_date']) + $n;
				$arr[$row2['id_bahan']][$tgl]["masuk"] = $row2['jumlah'];
				$arr[$row2['id_bahan']][$tgl]["ket"] = $row2['ket'];
				$n++;
			}
			
			$sql3 = query("SELECT * FROM history_stok WHERE tb = 'stok_keluar' AND id_laporan = ".quote($idproj)." AND stat <> 9 ORDER BY create_date");
			foreach($sql3->result_array() as $row3){
				$tgl = strtotime($row3['create_date']) + $n;
				$arr[$row3['id_bahan']][$tgl]["keluar"] = $row3['jumlah'];
				$arr[$row3['id_bahan']][$tgl]["ket"] = $row3['ket'];
				$n++;
			}
			
			return $arr;
		}
	}				