<?php
	defined("BASEPATH") or exit("No direct script access allowed");
	
	class Penjualan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			//cek sesi login
			cek_session_login(1);
			//default global perpage
			$this->perPage = 10;
			//global title
			$this->title = info()["title"];
			//session id user
			$this->iduser = $this->session->idu;
		}
		
		public function cart()
		{
			//cek jika di method GET message error
			cek_nput_post("GET");
			cek_crud_akses(8, "json");
			
			//post id invoice
			$id = $this->input->post("id");
			//post type invoice
			$edit = $this->input->post("edit");
			
			$_select = "SUM(jumlah * harga) AS `jml`";
			if ($id > 0) {
				//0
				$data["echo"] = 0;
				$data["type"] = $edit;
				$data["diskon"] = $this->model_app->diskon("bayar_invoice_detail", [
                "bayar_invoice_detail.id_invoice" => $id,
				]);
				$data["id"] = $id;
				$data["detail"] = $this->model_app->produk_cart([
                "invoice_detail.id_invoice" => $id,
				]);
				$data["proses"] = $this->model_app
                ->edit("invoice", ["id_invoice" => $id])
                ->row_array();
				//sum detail
				$cdetail = $this->model_app->cek_total("invoice_detail", $_select, [
                "id_invoice" => $id,
				]);
				$data["cdetail"] = $cdetail->jml;
				//end
				$iddel = ["id_produk" => 0, "id_invoice" => $id];
				$res = $this->model_app->delete("invoice_detail", $iddel);
				} else {
				$cari_last_invoice = $this->model_app->view_where("tb_users", [
                "last_invoice >" => 0,
                "id_user" => $this->iduser,
				]);
				if ($cari_last_invoice->num_rows() > 0) {
					//1
					$data["echo"] = 1;
					$rows = $cari_last_invoice->row();
					$data["type"] = "baru";
					$data["diskon"] = $this->model_app->diskon(
                    "bayar_invoice_detail",
                    ["bayar_invoice_detail.id_invoice" => $rows->last_invoice]
					);
					$data["id"] = $rows->last_invoice;
					$data["detail"] = $this->model_app->produk_cart([
                    "invoice_detail.id_invoice" => $rows->last_invoice,
					]);
					$data["proses"] = $this->model_app
                    ->edit("invoice", ["id_invoice" => $rows->last_invoice])
                    ->row_array();
					//sum detail
					$cdetail = $this->model_app->cek_total(
                    "invoice_detail",
                    $_select,
                    ["id_invoice" => $rows->last_invoice]
					);
					$data["cdetail"] = $cdetail->jml;
					//end
					$iddel = [
                    "id_produk" => 0,
                    "id_invoice" => $rows->last_invoice,
					];
					
					$res = $this->model_app->delete("invoice_detail", $iddel);
					} else {
					//2
					$data["echo"] = 2;
					$search = $this->model_app->view_where("invoice", [
                    "id_invoice" => $this->session->cart,
					]);
					if ($search->num_rows() > 0) {
						//3
						$data["echo"] = 3;
						$rows = $search->row();
						$data["type"] = "baru";
						$data["diskon"] = $this->model_app->diskon(
                        "bayar_invoice_detail",
                        ["bayar_invoice_detail.id_invoice" => $rows->id_invoice]
						);
						$data["id"] = $rows->id_invoice;
						$data["detail"] = $this->model_app->produk_cart([
                        "invoice_detail.id_invoice" => $rows->id_invoice,
						]);
						$data["proses"] = $this->model_app
                        ->edit("invoice", ["id_invoice" => $rows->id_invoice])
                        ->row_array();
						//sum detail
						$cdetail = $this->model_app->cek_total(
                        "invoice_detail",
                        $_select,
                        ["id_invoice" => $rows->id_invoice]
						);
						$data["cdetail"] = $cdetail->jml;
						//end
						$iddel = [
                        "id_produk" => 0,
                        "id_invoice" => $rows->id_invoice,
						];
						$res = $this->model_app->delete("invoice_detail", $iddel);
						} else {
						$search = $this->model_app->view_where_ordering_limit(
                        "invoice",
                        ["id_konsumen" => 1,'POS'=>'N','status'=>'baru'],
                        "id_invoice",
                        "DESC",
                        1
						);
						if ($search->num_rows() > 0) {
							//4 edit
							$rows = $search->row();
							$data["echo"] = 4;
							$data["type"] = "baru";
							$data["diskon"] = $this->model_app->diskon(
                            "bayar_invoice_detail",
                            [
							"bayar_invoice_detail.id_invoice" =>
							$rows->id_invoice,
                            ]
							);
							$data["id"] = $rows->id_invoice;
							$data["detail"] = $this->model_app->produk_cart([
                            "invoice_detail.id_invoice" => $rows->id_invoice,
							]);
							$data["proses"] = $this->model_app
                            ->edit("invoice", [
							"id_invoice" => $rows->id_invoice,
                            ])
                            ->row_array();
							//sum detail
							$cdetail = $this->model_app->cek_total(
                            "invoice_detail",
                            $_select,
                            ["id_invoice" => $rows->id_invoice]
							);
							$data["cdetail"] = $cdetail->jml;
							//end
							$iddel = [
                            "id_produk" => 0,
                            "id_invoice" => $rows->id_invoice,
							];
							$res = $this->model_app->delete(
                            "invoice_detail",
                            $iddel
							);
							} else {
							//5 input
							
							$data["echo"] = 5;
							$data["type"] = "baru";
							$autoNumber = autoNumber(
                            NOMOR_TRX,
                            DIGIT_TRX,
                            "id_transaksi",
                            "invoice"
							);
							
							$data_arr = [
                            "id_transaksi" => $autoNumber,
                            "id_konsumen" => "1",
                            "id_user" => $this->iduser,
                            "id_marketing" => $this->iduser,
                            "tgl_trx" => date("Y-m-d"),
                            "jam_order" => date("H:i:s"),
                            "tgl_ambil" => date("Y-m-d H:i:s"),
                            "status" => "baru",
                            "sesi_cart" => session_id(),
							];
							
							$data["autonumber"] = $autoNumber;
							$input = $this->model_app->input("invoice", $data_arr);
							if ($input["status"] == "error") {
								echo $input["msg"];
								exit();
							}
							$last_id = $this->db->insert_id();
							$datain = [
                            "id_invoice" => $last_id,
                            "id_produk" => 1,
                            "id_bahan" => 1,
                            "jenis_cetakan" => 1,
                            "jumlah" => 1,
							];
							// $this->db->insert("invoice_detail", $datain);
							$data["diskon"] = $this->model_app->diskon(
                            "bayar_invoice_detail",
                            ["bayar_invoice_detail.id_invoice" => $last_id]
							);
							$data["detail"] = $this->model_app->produk_cart([
                            "invoice_detail.id_invoice" => $last_id,
							]);
							$data["id"] = $last_id;
							$data["proses"] = $this->model_app
                            ->edit("invoice", ["id_invoice" => $last_id])
                            ->row_array();
							//sum detail
							$cdetail = $this->model_app->cek_total(
                            "invoice_detail",
                            $_select,
                            ["id_invoice" => $last_id]
							);
							$data["cdetail"] = $cdetail->jml;
							//end
							$this->session->set_userdata(["cart" => $last_id]);
						}
					}
				}
			}
			$data["idsesi"] = $this->iduser;
			$this->load->view("penjualan/keranjang", $data);
		}
		
		public function del_bayar()
		{
			cek_nput_post("GET");
			cek_crud_akses(10);
			$id_rincian = $this->db->escape_str($this->input->post("id"));
			$no_invoice = $this->db->escape_str($this->input->post("noin"));
			$kunci = $this->db->escape_str($this->input->post("kunci"));
			$jml = $this->db->escape_str($this->input->post("jml"));
			$idbayar = $this->db->escape_str($this->input->post("idbayar"));
			
			if (
            $this->session->level == "admin" or
            $this->session->level == "owner"
			) {
				$where = ["id" => $id_rincian, "id_invoice" => $no_invoice];
				} else {
				$where = [
                "id" => $id_rincian,
                "id_invoice" => $no_invoice,
                "kunci" => $kunci,
				];
			}
			$res = $this->model_app->delete("bayar_invoice_detail", $where);
			if ($res == true) {
				if ($idbayar == 1) {
					$no_reff = 411;
					} elseif ($idbayar == 2) {
					$no_reff = 110;
				}
				// $autoNumber = autoNumber(
                // NOMOR_REFF,
                // DIGIT_REFF,
                // "id_generate",
                // "kas_masuk"
				// );
				// $this->model_app->insert("kas_masuk", [
                // "no_reff" => $no_reff,
                // "id_bayar" => $idbayar,
                // "id_user" => $this->iduser,
                // "id_generate" => $autoNumber,
                // "catatan" => "Hapus pembayaran INVOICE No.#" . $no_invoice,
                // "pengeluaran" => $jml,
				// ]);
				$_where = ["catatan" => "Pembelian No.#" . $no_invoice];
                $this->model_app->delete("kas_masuk", $_where);
                $this->model_app->delete("jurnal_transaksi", ['reff'=>'O-'.$no_invoice]);
				$data = ["ok" => "ok", "uang" => $jml];
				} else {
				$data = ["ok" => "no", "uang" => 0];
			}
			echo json_encode($data);
		}
		
		public function list_bayar()
		{
			$noin = $this->db->escape_str($this->input->post("id"));
			$noin = decrypt_url($noin);
			$data["total_bayar"] = $this->model_app
            ->pilih("total_bayar", "invoice", ["id_invoice" => $noin])
            ->row();
			$data["bayar"] = $this->model_app->view_where("bayar_invoice_detail", [
            "id_invoice" => $noin,
			]);
			$this->load->view("penjualan/bayar", $data);
		}
		
		public function list_invoice()
		{
			$data["invoice"] = $this->model_app
            ->view_where_ordering_limit(
			"invoice",
			["id_konsumen!=" => 1],
			"id_invoice",
			"DESC",
			10
            )
            ->result_array();
			$this->load->view("penjualan/list_invoice", $data);
		}
		
		public function list_invoice_desain()
		{
			$data["invoice"] = $this->model_app
            ->view_where_ordering_limit(
			"invoice",
			["id_konsumen!=" => 1, "id_desain" => $this->iduser],
			"id_invoice",
			"DESC",
			10
            )
            ->result_array();
			$this->load->view("penjualan/list_invoice", $data);
		}
		
		public function save_bayar()
		{
			cek_nput_post("GET");
			
			$lampiran = "";
			$rekening = $this->db->escape_str($this->input->post("rekening"));
			if ($rekening > 0) {
				$config["upload_path"] = "./uploads/lampiran/";
				$config["allowed_types"] = "jpeg|jpg|png|webp";
				$config["max_size"] = "1000"; // kb
				$this->load->library("upload", $config);
				$this->upload->initialize($config);
				if (!empty($_FILES["lampiran"]["name"])) {
					if (!$this->upload->do_upload("lampiran")) {
						echo $this->upload->display_errors();
						} else {
						$data = $this->upload->data();
						$lampiran = $data["file_name"];
					}
				}
			}
			
			$type = $this->db->escape_str($this->input->post("type"));
			$noin = $this->db->escape_str($this->input->post("noin"));
			$id_bayar = $this->db->escape_str($this->input->post("id_byr"));
			$jml_bayar = $this->db->escape_str($this->input->post("uang"));
			$nourut = $this->db->escape_str($this->input->post("nourut"));
			$pajak = $this->db->escape_str($this->input->post("pajak"));
			
			$sisa =
            "ROUND(SUM((`invoice_detail`.`jumlah`) * (`invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))) AS potongan";
			
			$jdiskon = $this->model_app->cek_total("invoice_detail",$sisa,["id_invoice" => $noin]);
			$potongan = $jdiskon->potongan;
			$alert = [];
			if ($type == "simpan_bayar") {
				$cek_disc = $this->model_app->cek_total("invoice", "pajak", [
                "id_invoice" => $noin,
				]);
				if ($cek_disc->pajak != $pajak) {
					$alert = ["ok" => "no", "id" => 0, "uang" => 0, "total" => 0];
					echo json_encode($alert);
					exit();
				}
				if($pajak > 0){
					$potongan =0;
				}
				$iddel = [
				"id_produk" => 0,
				"id_invoice" => $noin,
				];
				$this->model_app->delete("invoice_detail", $iddel);
				$data = [
                "id_invoice" => $noin,
                "tgl_bayar" => date("Y-m-d"),
                "jam_bayar" => date("H:i:s"),
                "jml_bayar" => $jml_bayar,
                "id_bayar" => $id_bayar,
                "id_sub_bayar" => $rekening,
                "urutan" => $nourut,
                "lampiran" => $lampiran,
                "id_user" => $this->iduser,
				];
				
				if ($noin != null and $jml_bayar > 0) {
					//cek jml bayar
					$_select = "SUM(jml_bayar) AS `total`";
					$_where = ["id_invoice" => $noin];
					$_search = $this->model_app->cek_total("bayar_invoice_detail`",$_select,$_where);
					// if($_search->total == 0){
					// input_stok_keluar($noin);
					// }
					
					$input = $this->model_app->input("bayar_invoice_detail", $data);
					if ($input["status"] == "ok") {
						if ($id_bayar == 1) {
							$no_reff = 411;
							} elseif ($id_bayar == 2) {
							$no_reff = 110;
						}
						
						$autoNumber = autoNumber(
                        NOMOR_REFF,
                        DIGIT_REFF,
                        "id_generate",
                        "kas_masuk"
						);
						$this->model_app->insert("kas_masuk", [
                        "no_reff" => $no_reff,
                        "id_bayar" => $id_bayar,
                        "id_sub_bayar" => $rekening,
                        "id_user" => $this->iduser,
                        "id_generate" => $autoNumber,
                        "pemasukan" => $jml_bayar,
                        "catatan" => "Pendapatan INVOICE NO.#" . $noin,
						]);
						
						$this->model_app->update(
                        "invoice",
                        ["pos" => "Y", "id_user" => $this->iduser,'potongan_harga'=>$potongan],
                        ["id_invoice" => $noin]
						);
						
						//cek jml bayar
						$select = "SUM(jml_bayar) AS `total`";
						$where = ["id_invoice" => $noin];
						$search = $this->model_app->cek_total(
                        "bayar_invoice_detail`",
                        $select,
                        $where
						);
						// print_r($search);
						//total di invoice
						$invoice = "total_bayar AS total";
						$searchin = $this->model_app->cek_total("invoice",$invoice,$where);
						$sum_detail = sum_detail($noin);
						
						$sisa = $sum_detail - $search->total;
						//jika jumlah bayar lunas
						if ($searchin->total == $search->total) {
							$ket_debet = "Kas penjualan No. " . $noin;
							$ket_kredit = "Pendapatan No. " . $noin;
							$reff = "O-$noin";
							$jurnal_debet = [
							"id_user" => $this->iduser,
							"no_reff" => getIdAkun($id_bayar),
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "debit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_debet,
							];
							
							$jurnal_kredit = [
							"id_user" => $this->iduser,
							"no_reff" => 411,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "kredit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_kredit,
							];
							$this->model_app->jurnal_input($jurnal_debet);
							$this->model_app->jurnal_input($jurnal_kredit);
						}
						//jika jumlah bayar belum lunas
						
						if ($search->total <=0) {
							$ket_debet = "Piutang usaha No. " . $noin;
							$ket_kredit = "Pendapatan No. " . $noin;
							$reff = "O-$noin";
							$jurnal_debet = [
							"id_user" => $this->iduser,
							"no_reff" => 112,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "debit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_debet,
							];
							
							$jurnal_kredit = [
							"id_user" => $this->iduser,
							"no_reff" => getIdAkun($id_bayar),
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "kredit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_kredit,
							];
							$this->model_app->jurnal_input($jurnal_debet);
							$this->model_app->jurnal_input($jurnal_kredit);
						}
						
						//jika bayar dp
						if ($sisa > 0) {
							$total_dibayar = $jml_bayar;
							// $total_sisa = $searchin->total - $search->total;
							//insert kas
							$ket_debet = "Kas penjualan No. " . $noin;
							$ket_kredit = "Pendapatan No. " . $noin;
							$reff = "O-$noin";
							$jurnal_debet = [
							"id_user" => $this->iduser,
							"no_reff" => 111,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "debit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_debet,
							];
							
							$jurnal_kredit = [
							"id_user" => $this->iduser,
							"no_reff" => 411,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "kredit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_kredit,
							];
							$this->model_app->jurnal_input($jurnal_debet);
							$this->model_app->jurnal_input($jurnal_kredit);
							//insert piutang
							if ($potongan > 0 AND $pajak ==0) {
								
								$ket_debet = "Potongan penjualan No. " . $noin;
								$ket_kredit = "Pendapatan No. " . $noin;
								$reff = "O-$noin";
								$jurnal_debet = [
								"id_user" => $this->iduser,
								"no_reff" => 402,
								"reff" => $reff,
								"tgl_input" => today(),
								"tgl_transaksi" => today(),
								"jenis_saldo" => "debit",
								"saldo" => $sisa,
								"keterangan" => $ket_debet,
								];
								
								$jurnal_kredit = [
								"id_user" => $this->iduser,
								"no_reff" => 411,
								"reff" => $reff,
								"tgl_input" => today(),
								"tgl_transaksi" => today(),
								"jenis_saldo" => "kredit",
								"saldo" => $sisa,
								"keterangan" => $ket_kredit,
								];
								$this->model_app->jurnal_input($jurnal_debet);
								$this->model_app->jurnal_input($jurnal_kredit);
								}elseif($pajak > 0){
								$ket_debet = "Utang pajak No. " . $noin;
								$ket_kredit = "Pendapatan No. " . $noin;
								$reff = "O-$noin";
								$jurnal_debet = [
								"id_user" => $this->iduser,
								"no_reff" => 213,
								"reff" => $reff,
								"tgl_input" => today(),
								"tgl_transaksi" => today(),
								"jenis_saldo" => "debit",
								"saldo" => $sisa,
								"keterangan" => $ket_debet,
								];
								
								$jurnal_kredit = [
								"id_user" => $this->iduser,
								"no_reff" => 411,
								"reff" => $reff,
								"tgl_input" => today(),
								"tgl_transaksi" => today(),
								"jenis_saldo" => "kredit",
								"saldo" => $sisa,
								"keterangan" => $ket_kredit,
								];
								$this->model_app->jurnal_input($jurnal_debet);
								$this->model_app->jurnal_input($jurnal_kredit);
								}else{
								$ket_debet = "Piutang usaha No. " . $noin;
								$ket_kredit = "Pendapatan No. " . $noin;
								$reff = "O-$noin";
								$jurnal_debet = [
								"id_user" => $this->iduser,
								"no_reff" => 112,
								"reff" => $reff,
								"tgl_input" => today(),
								"tgl_transaksi" => today(),
								"jenis_saldo" => "debit",
								"saldo" => $sisa,
								"keterangan" => $ket_debet,
								];
								
								$jurnal_kredit = [
								"id_user" => $this->iduser,
								"no_reff" => 411,
								"reff" => $reff,
								"tgl_input" => today(),
								"tgl_transaksi" => today(),
								"jenis_saldo" => "kredit",
								"saldo" => $sisa,
								"keterangan" => $ket_kredit,
								];
								$this->model_app->jurnal_input($jurnal_debet);
								$this->model_app->jurnal_input($jurnal_kredit);
							}
						}
						
						
						if ($sisa == 0) {
							$this->model_app->update(
                            "invoice",
                            ["lunas" => 1],
                            ["id_invoice" => $noin]
							);
							$alert = [
                            "status" => 200,
                            "id" => $noin,
                            "uang" => $jml_bayar,
                            "total" => $search->total,
							];
							} else {
							$alert = [
							"status" => 200,
							"id" => $noin,
							"uang" => $jml_bayar,
							"total" => $searchin->total,
							];
						}
						} else {
						$alert = [
                        "status" => 304,
                        "id" => 0,
                        "uang" => 0,
                        "total" => 0,
						];
					}
					} else {
					$alert = [
                    "status" => 301,
                    "msg" => "Order sudah lunas",
                    "id" => $noin,
                    "uang" => $jml_bayar,
                    "total" => 0,
					];
				}
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($alert));
		}
		
		
		public function add_detail()
		{
			cek_nput_post("GET");
			$id = $this->db->escape_str($this->input->post("id"));
			$res = $this->db->insert("invoice_detail", ["id_invoice" => $id]);
			$last_id = $this->db->insert_id();
			if ($res == true) {
				$data = ["status" => 200, "idr" => $last_id];
				} else {
				$data = ["status" => 400, "idr" => 0];
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function hapus_detail()
		{
			cek_nput_post("GET");
			$id = [
            "id_rincianinvoice" => $this->db->escape_str(
			$this->input->post("idr")
            ),
			];
			$res = $this->model_app->delete("invoice_detail", $id);
			if ($res == true) {
				$data = ["status" => 200,'msg'=>'Berhasil'];
				} else {
				$data = ["status" => 400,'msg'=>'Gagal'];
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		function totaltrx()
		{
			$conditions = [];
			$data = $this->model_app->counter("invoice", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		function hari_ini()
		{
			$conditions["where"] = [
            "tgl_trx" => date("Y-m-d"),
            "status" => "simpan",
			];
			$data = $this->model_app->counter("invoice", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		function baru()
		{
			$conditions["where"] = [
            "status" => "baru",
			];
			$data = $this->model_app->counter("invoice", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function desain()
		{
			$conditions["where"] = [
            "id_desain" => $this->iduser,
			];
			$data = $this->model_app->counter("invoice", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function desainnow()
		{
			$conditions["where"] = [
            "tgl_trx" => date("Y-m-d"),
            "id_desain" => $this->iduser,
			];
			$data = $this->model_app->counter("invoice", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		public function pending()
		{
			$conditions["where"] = [
            "status" => "pending",
			];
			$data = $this->model_app->counter("invoice", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function batal()
		{
			
			$conditions["where"] = [
            "status" => "batal",
			];
			$data = $this->model_app->counter("invoice", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		public function konsumen()
		{
			$conditions["where"] = [
            "kunci" => "0",
			];
			$data = $this->model_app->counter("konsumen", $conditions);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function cari()
		{
			cek_nput_post("GET");
			$search = $this->input->post("search");
			$data = $this->model_data->getdata($search);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function simpan_data()
		{
			cek_nput_post("GET");
			$noin = $this->input->post("id");
			if((int)$noin){
				$noin = $noin;
				}else{
				$noin = decrypt_url($noin);
			}
			$idkon = $this->input->post("idk");
			$total = $this->input->post("total");
			$this->session->unset_userdata("cart");
			
			if ($noin != null and $total > 0) {
				$iddel = [
				"id_produk" => 0,
				"id_invoice" => $noin,
				];
				$this->model_app->delete("invoice_detail", $iddel);
				//cek jml bayar
				$select = "SUM(jml_bayar) AS total";
				$where = ["id_invoice" => $noin];
				$cek_print = $this->model_app->view_where("invoice", $where)->row();
				
				$konsumen = $this->model_app
                ->view_where("konsumen", ["id" => $idkon])
                ->row();
				if ($konsumen->max_utang > 0 and $cek_print->cetak <= 1) {
					$max_utang = $konsumen->max_utang - 1;
					$this->model_app->update(
                    "konsumen",
                    ["max_utang" => $max_utang],
                    ["id" => $idkon]
					);
				}
				
				$search = $this->model_app->cek_total("bayar_invoice_detail",$select,$where);
				//total di invoice
				$invoice = "total_bayar AS total";
				$searchin = $this->model_app->cek_total("invoice",$invoice,$where);
				
				if ($searchin->total == $search->total) {
					$this->model_app->update(
                    "invoice",
                    [
					"lunas" => 1,
					"status" => "simpan",
					"pos" => "Y",
					"oto" => 6,
                    ],
                    ["id_invoice" => $noin]
					);
					$data = [
                    "status" => 200,
                    "id" => $noin,
                    "total" => $search->total,
					];
					$this->model_app->update(
                    "tb_users",
                    ["last_invoice" => 0],
                    ["id_user" => $this->iduser]
					);
					} else {
					$this->model_app->update(
                    "invoice",
                    ["status" => "simpan", "pos" => "Y", "oto" => 6],
                    ["id_invoice" => $noin]
					);
					$this->model_app->update(
                    "tb_users",
                    ["last_invoice" => 0],
                    ["id_user" => $this->iduser]
					);
					$data = [
                    "status" => 200,
                    "id" => $noin,
                    "total" => $searchin->total,
					];
				}
				} else {
				$data = ["status" => 400, "id" => $noin, "total" => 0];
			}
			echo json_encode($data);
		}
		
		public function auto_save_invoice()
		{
			cek_nput_post("GET");
			$id = $this->db->escape_str($this->input->post("id"));
			$tgli = $this->db->escape_str($this->input->post("tglin"));
			$tgla = $this->db->escape_str($this->input->post("tgla"));
			$jam = $this->db->escape_str($this->input->post("jam"));
			$marketing = $this->db->escape_str($this->input->post("marketing"));
			$data = [
            "tgl_trx" => $tgli,
            "tgl_ambil" => $tgla . " " . $jam,
            "id_marketing" => $marketing,
			];
			$where = ["id_invoice" => $id];
			
			$res = $this->model_app->update("invoice", $data, $where);
			if ($res["status"] == "ok") {
				$data = ["ok" => "ok"];
				} else {
				$data = ["ok" => "err"];
			}
			echo json_encode($data);
		}
		
		public function auto_save_invoice_detail()
		{
			cek_nput_post("GET");
			$idorder = $this->db->escape_str($this->input->post("id_invoice"));
			$jml = $this->db->escape_str($this->input->post("jml"));
			$uangmuka = $this->db->escape_str($this->input->post("uangmuka"));
			$id = $this->db->escape_str($this->input->post("id_rincianinvoice"));
			$harga = $this->db->escape_str($this->input->post("harga"));
			$jumlah = $this->db->escape_str($this->input->post("jumlah"));
			$id_produk = $this->db->escape_str($this->input->post("id_produk"));
			$ket = $this->db->escape_str($this->input->post("ket"));
			$ukuran = $this->db->escape_str($this->input->post("ukuran"));
			$ukuran = comma_to_dot($ukuran);
			$satuan = $this->db->escape_str($this->input->post("satuan"));
			$id_bahan = $this->db->escape_str($this->input->post("id_bahan"));
			$jenis = $this->db->escape_str($this->input->post("jenis"));
			$totukuran = $this->db->escape_str($this->input->post("totukuran"));
			$diskon = $this->db->escape_str($this->input->post("diskon"));
			$type_harga = $this->db->escape_str($this->input->post("type_harga"));
			$status_hitung = $this->db->escape_str($this->input->post("status_hitung"));
			$hsatuan = $this->db->escape_str($this->input->post("hargasatuan"));
			
			if (empty($id_bahan)) {
				$id_bahan = 1;
			}
			if (empty($satuan)) {
				$satuan = "-";
			}
			if (empty($satuan)) {
				$satuan = "-";
			}
			$totukuran = 1;
			if (empty($totukuran) OR $totukuran == 'NaN'){
				$totukuran = 1;
				}else{
				if($status_hitung > 0){
					$totukuran = $totukuran * $jumlah ;
				}
			}	
			
			$harga_beli = harga_beli($id_bahan);
			
			if(!empty($totukuran) AND $harga_beli > 0){
				$hpp = $totukuran * $jumlah * $harga_beli;
				}elseif(empty($totukuran) AND $harga_beli > 0){
				$hpp = $jumlah * $harga_beli;
				}else{
				$hpp = 0;
			}
			$this->model_app->update("invoice",['total_bayar'=>$jml], ['id_invoice'=>$idorder]);
			//where
			$where = ["id_rincianinvoice" => $id];
			//execute
			$cek_harga = $this->model_app->view_where("bahan", ["id" => $id_bahan]);
			$row = $cek_harga->row();
			
			$harga_jual = $row->harga_jual;
			if ($harga < $harga_jual and $harga > 0 and $totukuran >= 1) {
				$data = [
                "status" => 401,
                "harga" => rp($harga_jual),
                "msg" => "Harga dibawah harga modal (RUGI DONG)",
				];
				
				$data_array = [
                "id_produk" => $id_produk,
                "jumlah" => $jumlah,
                "harga" => $harga_jual,
                "ukuran" => $ukuran,
                "satuan" => $satuan,
                "id_satuan" => $satuan,
                "keterangan" => $ket,
                "id_bahan" => $id_bahan,
                "jenis_cetakan" => $jenis,
                "type_harga" => $type_harga,
                "status_hitung" => $status_hitung,
				"tot_ukuran" => $totukuran,
				"hpp" => $hpp,
				"diskon" => $diskon,
				"kunci" => 0,
				];
				
				
				$this->model_app->update("invoice_detail", $data_array, $where);
				} else {
				if (empty($id_produk)) {
					$id_produk = 1;
				}
				
				if (empty($jenis)) {
					$jenis = 1;
				}
				
				if (empty($totukuran)) {
					$totukuran = 0;
				}
				
				$cek_harga = $this->model_app->view_where("harga", [
				"title" => $harga,
				]);
				
				$_reload = $this->model_app
				->view_where("invoice_detail", $where)
				->row_array();
				if ($jml < $uangmuka) {
					$data = [
					"status" => 400,
					"jml" => $_reload["jumlah"],
					"harga" => $_reload["harga"],
					"diskon" => $_reload["diskon"],
					"ukuran" => $_reload["ukuran"],
					];
					} else {
					$data_array = [
					"id_produk" => $id_produk,
					"jumlah" => $jumlah,
					"harga" => $harga,
					"ukuran" => $ukuran,
					"satuan" => $satuan,
					"id_satuan" => $satuan,
					"keterangan" => $ket,
					"id_bahan" => $id_bahan,
					"jenis_cetakan" => $jenis,
					"type_harga" => $type_harga,
					"status_hitung" => $status_hitung,
					"tot_ukuran" => $totukuran,
					"hpp" => $hpp,
					"diskon" => $diskon,
					"kunci" => 0,
					];
					
					$res = $this->model_app->update(
					"invoice_detail",
					$data_array,
					$where
					);
					if ($res["status"] == "ok") {
						$data = ["status" => 200, "msg" => "Saved",'ukuran'=>$ukuran];
						} else {
						$data = ["status" => 400, "msg" => "Save Gagal"];
					}
				}
			}
			echo json_encode($data);
		}
		
		public function simpan_pajak()
		{
			cek_nput_post("GET");
			$id = $this->db->escape_str($this->input->post("id"));
			$pajak = $this->db->escape_str($this->input->post("pajak"));
			$where = ["id_invoice" => $id];
			$data = ["pajak" => $pajak];
			$res = $this->model_app->update("invoice", $data, $where);
			if ($res["status"] == "ok") {
				$data = ["ok" => "ok", "pajak" => $pajak];
				} else {
				$data = ["ok" => "err", "pajak" => 0];
			}
			echo json_encode($data);
		}
		
		public function bayar_detail()
		{
			cek_nput_post("GET");
			$id = $this->input->post("id");
			$select = "SUM(jml_bayar) AS `total`";
			$where = ["id_invoice" => $id];
			$search = $this->model_app->cek_total(
            "bayar_invoice_detail` ",
            $select,
            $where
			);
			// print_r($search);
			if (!empty($search->total)) {
				$data = $search->total;
				} else {
				$data = 0;
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function cek_jml_bayar()
		{
			cek_nput_post("GET");
			$id = $this->input->post("id");
			$select = "total_bayar AS total";
			$where = ["id_invoice" => $id];
			$search = $this->model_app->cek_total("invoice", $select, $where);
			if (!empty($search->total)) {
				$data = $search->total;
				} else {
				$data = 0;
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function cek_total_detail()
		{
			cek_nput_post("GET");
			$id = $this->input->post("id");
			$select = "SUM(jumlah * harga) AS `total`";
			$where = ["id_invoice" => $id];
			$search = $this->model_app->cek_total(
            "invoice_detail",
            $select,
            $where
			);
			if (!empty($search->total)) {
				$data = $search->total;
				} else {
				$data = 0;
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function cek_data_total()
		{
			cek_nput_post("GET");
			$id = $this->input->post("id");
			$iduser = $this->input->post("iduser");
			$pajak = $this->input->post("pajak");
			$where = ["id_invoice" => $id];
			$invoice = "total_bayar AS total";
			$searchin = $this->model_app->cek_total("invoice", $invoice, $where);
			//cek konsumen
			$idkon = $this->model_app->view_where("invoice", $where)->row();
			
			$this->cek_boleh_utang($idkon->id_konsumen,$id);
			
			//diskon
			$sisa =
            "ROUND(SUM((`invoice_detail`.`jumlah`) * (`invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))) AS sisa";
			$cari_sisa = $this->model_app->cek_total(
            "invoice_detail",
            $sisa,
            $where
			);
			////
			$select = "SUM(jumlah * harga) AS `total`";
			$search = $this->model_app->cek_total(
            "invoice_detail",
            $select,
            $where
			);
			$total_detail = $search->total - $cari_sisa->sisa;
			$kurangpajak = $searchin->total - $total_detail;
			$total_bayar = $searchin->total - $kurangpajak;
			if ($total_detail == $total_bayar and $pajak > 0) {
				$data = [
                "urutan" => 1,
                "ok" => "ok",
                "id" => $id,
                "iduser" => $iduser,
                "total" => $total_detail,
				];
				} elseif ($total_detail == $searchin->total and $pajak == 0) {
				$data = [
				"urutan" => 2,
                "ok" => "ok",
                "id" => $id,
                "idkon" => $idkon->id_konsumen,
                "iduser" => $iduser,
                "total" => $total_detail,
				];
				} else {
				$data = [
				"urutan" => 3,
                "ok" => "err",
                "id" => $id,
                "idkon" => $idkon->id_konsumen,
                "iduser" => $iduser,
                "total" => 0,
                "tipe" => "simpan_cetak",
				];
			}
			// echo json_encode($data);
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function cek_di_invoice()
		{
			cek_nput_post("GET");
			$id = $this->input->post("id");
			$total = $this->input->post("total");
			$pajak = $this->input->post("pajak");
			$where = ["id_invoice" => $id];
			// $invoice = 'total_bayar AS total';
			$invoice = "SUM(total_bayar) AS `total`";
			//cek konsumen
			$idkon = $this->model_app->view_where("invoice", $where)->row();
			//cek total invoice
			$searchin = $this->model_app->cek_total("invoice", $invoice, $where);
			//cek pajak di invoice
			
			//diskon`/100
			$sisa =
            "ROUND(SUM((`invoice_detail`.`jumlah` * `invoice_detail`.`harga`) - (`invoice_detail`.`jumlah` * `invoice_detail`.`harga` * `invoice_detail`.`diskon`/100))) AS sisa";
			$cari_sisa = $this->model_app->cek_total(
            "invoice_detail",
            $sisa,
            $where
			);
			//invoice_detail
			$select = "SUM(jumlah * harga) AS `total`";
			$search = $this->model_app->cek_total(
            "invoice_detail",
            $select,
            $where
			);
			$total_detail = $cari_sisa->sisa;
			if ($pajak > 0) {
				$pajak = $pajak;
				$total_detail = $total_detail + ($total_detail * $pajak) / 100;
			}
			if ($total_detail == $searchin->total and $pajak == 0) {
				$data = [
                "ok" => "ok",
                "id" => $id,
                "idkon" => $idkon->id_konsumen,
                "total" => $search->total,
				];
				} elseif ($total_detail == $searchin->total and $pajak > 0) {
				$data = [
                "ok" => "ok",
                "id" => $id,
                "idkon" => $idkon->id_konsumen,
                "total" => $search->total,
				];
				} else {
				$data = [
                "ok" => "err",
                "id" => $id,
                "idkon" => $idkon->id_konsumen,
                "total_1" => $searchin->total,
                "total_2" => $search->total,
                "sisa" => $cari_sisa->sisa,
                "total" => $total_detail,
                "tipe" => "simpan",
				];
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function update_data()
		{
			cek_nput_post("GET");
			$id = $this->input->post("id");
			$iduser = $this->input->post("iduser");
			$idlunas = $this->input->post("idlunas");
			$total = $this->input->post("total");
			$tipe = $this->input->post("tipe");
			$data = ["total_bayar" => $total];
			$where = ["id_invoice" => $id];
			$idkon = $this->model_app->view_where("invoice", $where)->row();
			$search = $this->model_app->update("invoice", $data, $where);
			
			//sum detail
			$cdetail = $this->model_app->cek_total(
            "invoice_detail",
            "SUM(jumlah * harga) AS `jml`",
            ["id_invoice" => $id]
			);
			if ($idlunas == 1 and $cdetail->jml != $total) {
				$this->model_app->update("invoice", ["lunas" => 0], $where);
			}
			
			//end
			if ($search["status"] == "ok") {
				$this->model_app->update(
                "tb_users",
                ["last_invoice" => $id],
                ["id_user" => $iduser]
				);
				$data = [
                "ok" => "ok",
                "id" => encrypt_url($id),
                "idkon" => $idkon->id_konsumen,
                "tipe" => $tipe,
                "total" => $total,
				];
				} else {
				$data = [
                "ok" => "err",
                "id" => 0,
                "idkon" => 0,
                "tipe" => "",
                "total" => 0,
				];
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function update_lunas()
		{
			cek_nput_post("GET");
			$noin = $this->input->post("id");
			$iduser = $this->input->post("iduser");
			$total = $this->input->post("total");
			$status = $this->input->post("status");
			
			if ($noin != null and $total > 0) {
				
				//cek jml bayar
				$select = "SUM(jml_bayar) AS `total`";
				$where = ["id_invoice" => $noin];
				$search = $this->model_app->cek_total(
                "bayar_invoice_detail`",
                $select,
                $where
				);
				//total di invoice
				$invoice = "total_bayar AS total";
				$searchin = $this->model_app->cek_total(
                "invoice",
                $invoice,
                $where
				);
				if ($searchin->total == $search->total) {
					$this->model_app->update(
                    "invoice",
                    ["lunas" => 1],
                    ["id_invoice" => $noin]
					);
					$data = [
                    "ok" => "ok",
                    "id" => $noin,
                    "iduser" => $iduser,
                    "total" => $search->total,
					];
					} else {
					$data = [
                    "ok" => "ok",
                    "id" => $noin,
                    "iduser" => $iduser,
                    "total" => $searchin->total,
					];
				}
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function trx($id = "")
		{
			$data["id"] = $id;
			$conditions["returnType"] = "count";
			$totalRec = $this->model_data->getRows($conditions);
			
			// Pagination configuration
			$config["target"] = "#dataList";
			$config["base_url"] = base_url("penjualan/ajaxPaginationData");
			$config["total_rows"] = $totalRec;
			$config["per_page"] = $this->perPage;
			
			// Initialize pagination library
			$this->ajax_pagination->initialize($config);
			
			// Get records
			$conditions = [
            "limit" => $this->perPage,
			];
			$data["posts"] = $this->model_data->getRows($conditions);
			
			$this->load->view("penjualan/trx", $data);
		}
		
		public function order()
		{
			cek_menu_akses();
			cek_crud_akses(8);
			$this->template->set("title", "Data order | " . $this->title);
			$data["id"] = "";
			$data["tgl"] = "";
			$data["select"] = [
            0 => "SEMUA",
            1 => "LUNAS",
            2 => "BELUM LUNAS",
            "baru" => "BARU",
            "pending" => "PENDING",
            "edit" => "EDIT",
            "batal" => "BATAL",
			];
			$conditions["returnType"] = "count";
			$totalRec = $this->model_data->getRows($conditions);
			
			// Pagination configuration
			$config["target"] = "#dataList";
			$config["base_url"] = base_url("penjualan/ajaxPaginationData");
			$config["total_rows"] = $totalRec;
			$config["per_page"] = $this->perPage;
			
			// Initialize pagination library
			$this->ajax_pagination->initialize($config);
			
			// Get records
			$conditions = [
            "limit" => $this->perPage,
			];
			
			$data["posts"] = $this->model_data->getRows($conditions);
			$this->template->load("main/themes", "penjualan/order", $data);
		}
		
		function ajaxPaginationData()
		{
			cek_nput_post("GET");
			$page = $this->input->post("page");
			if (!$page) {
				$offset = 0;
				} else {
				$offset = $page;
			}
			
			$limits = $this->input->post("limits");
			if (!empty($limits)) {
				$limit = $limits;
				} else {
				$limit = $this->perPage;
			}
			// Set conditions for search and filter
			$keywords = $this->input->post("keywords");
			$sortBy = $this->input->post("sortBy");
			$trx = $this->input->post("trx");
			$tgl = $this->input->post("tgl");
			if (!empty($trx)) {
				$conditions["search"]["trx"] = $trx;
			}
			if (!empty($keywords)) {
				if (substr(trim(strtoupper($keywords)), 0, 4) == NOMOR_TRX) {
					$conditions["search"]["keywords"] = $keywords;
					$arr["a"] = "a";
					} elseif (substr(trim($keywords), 0, 1) == "0") {
					$conditions["search"]["keywords"] = $keywords;
					$arr["a"] = "b";
					} elseif (substr(trim($keywords), 0, 2) == "62") {
					$conditions["search"]["keywords"] = clearnohp($keywords);
					$arr["a"] = "c";
					} elseif (substr(trim($keywords), 0, 3) == "+62") {
					$conditions["search"]["keywords"] = clearnohp($keywords);
					$arr["a"] = "d";
					} elseif (is_numeric($keywords)) {
					$conditions["where"] = ["id_invoice" => $keywords];
					$arr["a"] = "e";
					} elseif (substr(trim($keywords), 0, 1) == "#") {
					$conditions["search"]["keywords"] = clean($keywords);
					$arr["a"] = "f";
					} else {
					$conditions["search"]["keywords"] = trim($keywords);
					$arr["a"] = "g";
				}
				// print_r($arr);
			}
			if (!empty($sortBy)) {
				$conditions["search"]["sortBy"] = $sortBy;
			}
			if (!empty($limits)) {
				$conditions["search"]["limits"] = $limits;
			}
			if (!empty($tgl)) {
				$conditions["search"]["tgl"] = date_slash($tgl);
			}
			
			// Get record count
			$conditions["returnType"] = "count";
			$totalRec = $this->model_data->getRows($conditions);
			
			// Pagination configuration
			$config["target"] = "#dataList";
			$config["base_url"] = base_url("penjualan/ajaxPaginationData");
			$config["total_rows"] = $totalRec;
			$config["per_page"] = $limit;
			$config["link_func"] = "searchFilter";
			
			// Initialize pagination library
			$this->ajax_pagination->initialize($config);
			
			// Get records
			$conditions["start"] = $offset;
			$conditions["limit"] = $limit;
			if (!empty($sortBy)) {
				$conditions["search"]["sortBy"] = $sortBy;
			}
			if (!empty($limits)) {
				$conditions["search"]["limits"] = $limits;
			}
			if (!empty($tgl)) {
				$conditions["search"]["tgl"] = date_slash($tgl);
			}
			unset($conditions["returnType"]);
			$data["posts"] = $this->model_data->getRows($conditions);
			
			// Load the data list view
			$this->load->view("penjualan/ajax-order", $data, false);
		}
		
		public function pending_data()
		{
			cek_nput_post("GET");
			$noin = $this->input->post("id");
			$cari_pending = $this->model_app->view_where("invoice", [
            "status" => "pending",
            "id_invoice" => $noin,
			]);
			if ($cari_pending->num_rows() > 0) {
				$data = ["ok" => "pending"];
				} else {
				$res = $this->model_app->update(
                "invoice",
                [
				"pos" => "N",
				"status" => "pending",
				"id_user" => $this->iduser,
                ],
                ["id_invoice" => $noin]
				);
				if ($res["status"] == "ok") {
					$this->model_app->update(
                    "tb_users",
                    ["last_invoice" => 0],
                    ["id_user" => $this->iduser]
					);
					$this->session->unset_userdata("cart");
					$data = ["ok" => "ok"];
					} else {
					$data = ["ok" => "err"];
				}
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
		}
		
		public function grafik()
		{
			$page = $this->input->post("bulan");
			$hari = date("d");
			if (!empty($page)) {
				$bulan = $page;
				} else {
				$bulan = date("m");
			}
			$tahun = date("Y");
			$totalRec = $this->model_data->grafik_perbulan($bulan, $tahun);
			$hasil = [];
			if (!empty($totalRec)) {
				foreach ($totalRec as $row) {
					$hasil["omset"][] = [
                    "total" => $row->jml_bayar,
                    "tanggal" => "TGL." . $row->hari,
					];
				}
				} else {
				$hasil["omset"][] = [
                "total" => 0,
                "tanggal" =>  "TGL." . $hari,
				];
			}
			$bulan = ["bulan" => getBulan($bulan)];
			$array_merge = array_merge($hasil, $bulan);
			// print_r($array_merge);exit;
			echo json_encode($array_merge);
		}
		
		public function grafik_desain()
		{
			$page = $this->input->post("bulan");
			$hari = date("d");
			if (!empty($page)) {
				$bulan = $page;
				} else {
				$bulan = date("m");
			}
			$tahun = date("Y");
			$where = ["id_desain" => $this->iduser];
			$totalRec = $this->model_data->grafik_perbulan_desain(
            $bulan,
            $tahun,
            $where
			);
			$hasil = [];
			if (!empty($totalRec)) {
				foreach ($totalRec as $row) {
					$hasil["omset"][] = [
                    "total" => $row->counter,
                    "tanggal" => "TGL." . $row->hari,
					];
				}
				} else {
				$hasil["omset"][] = [
                "total" => 0,
                "tanggal" =>  "TGL." . $hari,
				];
			}
			$bulan = ["bulan" => getBulan($bulan)];
			$array_merge = array_merge($hasil, $bulan);
			echo json_encode($array_merge);
		}
		
		function ajaxKonsumen()
		{
			cek_nput_post("GET");
			$page = $this->input->post("page");
			if (!$page) {
				$offset = 0;
				} else {
				$offset = $page;
			}
			
			$limits = $this->input->post("limits");
			if (!empty($limits)) {
				$limit = $limits;
				} else {
				$limit = $this->perPage;
			}
			// Set conditions for search and filter
			$keywords = $this->input->post("keywords");
			$sortBy = $this->input->post("sortBy");
			
			if (!empty($keywords)) {
				$conditions["search"]["keywords"] = $keywords;
			}
			if (!empty($sortBy)) {
				$conditions["search"]["sortBy"] = $sortBy;
			}
			if (!empty($limits)) {
				$conditions["search"]["limits"] = $limits;
			}
			
			// Get record count
			$conditions["returnType"] = "count";
			$totalRec = $this->model_data->getKonsumen($conditions);
			
			// Pagination configuration
			$config["target"] = "#dataListKonsumen";
			$config["base_url"] = base_url("konsumen/ajaxKonsumen");
			$config["total_rows"] = $totalRec;
			$config["per_page"] = $limit;
			$config["link_func"] = "searchFilterKonsumen";
			
			// Initialize pagination library
			$this->ajax_pagination->initialize($config);
			
			// Get records
			$conditions["start"] = $offset;
			$conditions["limit"] = $limit;
			unset($conditions["returnType"]);
			$data["posts"] = $this->model_data->getKonsumen($conditions);
			
			// Load the data list view
			$this->load->view("konsumen/ajax-konsumen", $data, false);
		}
		
		public function cek_harga_type()
		{
			$cari_produk = $this->input->post("cari_produk");
			$id_konsumen = $this->input->post("id_konsumen_cari");
			$id_detail = $this->input->post("id_detail");
			$invoice_add = $this->input->post("invoice_add");
			$id_member = $this->input->post("idmember_add");
			// $id_member = $this->model_app->pilih_where('jenis_member','konsumen',['id'=>$id_konsumen])->row()->jenis_member;
			
			if(!empty($cari_produk) AND (int)$cari_produk){
				
				$result = $this->cari_produk($cari_produk);
				if($result !=false){
					$row =$result->row();
					$id_bahan = explode(',', $row->id_bahan);
					$id_bahan = $id_bahan[0];
					$this->cek_stok($id_bahan,1);
					$getBahan = getDetailBahan($id_bahan);
					$array = ['type_harga'=>$getBahan->type_harga,'id_bahan'=>$row->id_bahan,'id_member'=>$id_member];
					$getHarga = $this->model_data->getHarga($array);
					
					$data_insert = [
					'id_invoice'=>$invoice_add,
					'id_produk'=>$row->id,
					'jenis_cetakan'=>$row->id_jenis,
					'status_hitung'=>$getBahan->status,
					'type_harga'=>$getBahan->type_harga,
					'jumlah'=>$row->jumlah,
					'harga'=>$getHarga['harga'],
					'id_satuan'=>$getHarga['satuan'],
					'ukuran'=>$row->ukuran,
					'id_bahan'=>$getHarga['id_bahan'],
					];
					$addDetail = $this->addDetail($data_insert);
					if($addDetail['status']==true){
						
						$data = [
						'status'=>'qr',
						'id'=>$addDetail['id'],
						'kodeproduk'=>$row->title,
						'id_produk'=>$row->id,
						'harga'=>$getHarga['harga'],
						'jenis_cetakan'=>$row->jenis_cetakan,
						'id_jenis'=>$row->id_jenis,
						'bahan'=>$getHarga['title'],
						'id_bahan'=>$getHarga['id_bahan'],
						'status_hitung'=>$getBahan->status,
						'type_harga'=>$getBahan->type_harga,
						'id_satuan'=>$getHarga['satuan'],
						'ukuran'=>$row->ukuran,
						'jumlah'=>$row->jumlah,
						'lock_harga'=>$row->lock_harga,
						'iddetail'=>$id_detail,
						];
						}else{
						$data = ['status'=>false,'msg'=>'qr'];
					}
					}else{
					$data = ['status'=>false,'msg'=>'qr'];
				}
				}else{
				$id_bahan = (!empty($this->input->post('id_bahan')) ? $this->input->post('id_bahan') : 0);
				$jumlah = (!empty($this->input->post('jumlah')) ? $this->input->post('jumlah') : 0);
				
				$type_harga = $this->input->post("type_harga");
				$harga_jual = $satuan = 0;
				
				$this->cek_stok($id_bahan,$jumlah);
				
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
					if($sql1->num_rows() > 0){
						$harga_jual = $sql1->row()->harga_jual;
						$satuan = $sql1->row()->idsatuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'id_bahan'=>$id_bahan];
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
					if($sql2->num_rows() > 0){
						$harga_jual = $sql2->row()->harga_jual;
						$satuan = $sql2->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'type_harga'=>$type_harga];
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
					if($sql3->num_rows() > 0){
						$harga_jual = $sql3->row()->harga_jual;
						$satuan = $sql3->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'type_harga'=>$type_harga];
					}elseif($type_harga==4){
					$sql = $this->db->query("select id_satuan,harga_jual from range_harga where id_bahan=$id_bahan AND $jumlah between jumlah_minimal and jumlah_maksimal");
					if($sql->num_rows() > 0){
						$harga_jual = $sql->row()->harga_jual;
						$satuan = $sql->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'type_harga'=>$type_harga];
					
					//cari type harga 5
					}elseif($type_harga==5){
					$sql4 = $this->db->query("select id_satuan,harga_jual from harga_range_member where id_bahan=$id_bahan AND id_member='$id_member' AND $jumlah between jumlah_minimal and jumlah_maksimal");
					if($sql4->num_rows() > 0){
						$harga_jual = $sql4->row()->harga_jual;
						$satuan = $sql4->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'type_harga'=>$type_harga];
					}else{
					$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
					$harga_jual = $sql->row()->harga_modal;
					$satuan = $sql->row()->id_satuan;
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'type_harga'=>$type_harga];
					
				}
				
				
			}
			
			$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
			exit;
		}
		private function addDetail($param = array())
		{
			
			$res = $this->db->insert("invoice_detail", $param);
			$last_id = $this->db->insert_id();
			if ($res == true) {
				$data = ["status" => true, "id" => $last_id];
				} else {
				$data = ["status" => false, "id" => 0];
			}
			return $data;
		}
		
		private function cari_produk($name)
		{
			$query = "SELECT 
			`jenis_cetakan`.`jenis_cetakan`,
			`produk`.`barcode`,
			`produk`.`title`,
			`produk`.`ukuran`,
			`produk`.`id`,
			`produk`.`id_jenis`,
			`produk`.`id_bahan`,
			`produk`.`jumlah`,
			`produk`.`lock_harga`
			FROM
			`jenis_cetakan`
			INNER JOIN `produk` ON (`jenis_cetakan`.`id_jenis` = `produk`.`id_jenis`)
			where `produk`.`barcode`='".$name."' AND produk.pub='1'";
			$result = $this->db->query($query);
			if($result->num_rows() > 0){
				return $result;
				}else{
				return false;
			}
		}
		
		public function update_detail()
		{
			$id_konsumen = $this->input->post("idkonsumen");
			$id_bahan = $this->input->post("idbahan");
			$jumlah = $this->input->post("jumlah");
			$baris = $this->input->post("baris");
			$totukuran = $this->input->post("totukuran");
			
			$cek_status = $this->model_app->pilih_where('status_stok,type_harga,id_satuan,status','bahan',['id'=>$id_bahan])->row();
			$cek_satuan = $this->model_app->pilih_where('satuan','satuan',['id'=>$cek_status->id_satuan])->row();
			$type_harga = $cek_status->type_harga;
			
			if($cek_status->status_stok =='Y'){
				$this->cek_stok($id_bahan,$jml);
			}
			
			$status = $cek_status->status;
			
			if($status > 0){
				$jml = $totukuran;
				}else{
				$jml = $jumlah;
			}
			
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
				$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'baris'=>$baris];
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
				$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'baris'=>$baris];
				}elseif($type_harga==3){
				$id_member = $this->model_app->pilih_where('jenis_member','konsumen',['id'=>$id_konsumen])->row()->jenis_member;
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
				if($sql3->num_rows() > 0){
					$harga_jual = $sql3->row()->harga_jual;
					$satuan = $sql3->row()->id_satuan;
					}else{
					$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
					$harga_jual = $sql->row()->harga_modal;
					$satuan = $sql->row()->id_satuan;
				}
				$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'baris'=>$baris];
				}elseif($type_harga==4){
				$sql = $this->db->query("select id_satuan,harga_jual from range_harga where id_bahan=$id_bahan AND $jumlah between jumlah_minimal and jumlah_maksimal");
				if($sql->num_rows() > 0){
					$harga_jual = $sql->row()->harga_jual;
					$satuan = $sql->row()->id_satuan;
					}else{
					$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
					$harga_jual = $sql->row()->harga_modal;
					$satuan = $sql->row()->id_satuan;
				}
				$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'baris'=>$baris];
				
				}elseif($type_harga==5){
				
				$id_member = $this->model_app->pilih_where('jenis_member','konsumen',['id'=>$id_konsumen])->row()->jenis_member;
				$sql = $this->db->query("select id_satuan,harga_jual from harga_range_member where id_bahan=$id_bahan AND id_member='$id_member' AND $jumlah between jumlah_minimal and jumlah_maksimal");
				
				if($sql->num_rows() > 0){
					$harga_jual = $sql->row()->harga_jual;
					$satuan = $sql->row()->id_satuan;
					}else{
					$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
					$harga_jual = $sql->row()->harga_modal;
					$satuan = $sql->row()->id_satuan;
				}
				$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'baris'=>$baris];
				}else{
				$data = ['status'=>false];
			}
			echo json_encode($data);
		}
		
		public function cek_harga_range()
		{
			$id_konsumen = $this->input->post("id_member");
			$id_member = $this->model_app->pilih_where('jenis_member','konsumen',['id'=>$id_konsumen])->row()->jenis_member;
			$id = $this->input->post("id_bahan");
			$harga_awal = $this->input->post("harga");
			$jumlah = $this->input->post("jumlah");
			$totukuran = $this->input->post("totukuran");
			$totukuran = $totukuran !='' ? $totukuran : 1;
			$this->cek_stok($id,$jumlah);
			
			$cek_status = $this->model_app->pilih_where('status_stok,type_harga,id_satuan,status','bahan',['id'=>$id])->row();
			$cek_satuan = $this->model_app->pilih_where('satuan','satuan',['id'=>$cek_status->id_satuan])->row();
			$status = $cek_status->status;
			
			if($status > 0){
				$jml = $totukuran * $jumlah;
				}else{
				$jml = 1;
			}
			
			$type_harga = $cek_status->type_harga;
			
			
			if($type_harga==4){
				$sql = $this->db->query("select id_satuan,harga_jual from range_harga where id_bahan=$id AND $jml between jumlah_minimal and jumlah_maksimal");
				if($sql->num_rows() > 0){
					$harga_jual = ['status'=>true,'harga'=>$sql->row()->harga_jual ,'id_member'=>$id_member,'type_harga'=>$type_harga];
					}else{
					$harga_jual = ['status'=>true,'harga'=>$harga_awal,'id_member'=>$id_member,'type_harga'=>$type_harga];
				}
				}elseif($type_harga==5){
				$sql = $this->db->query("select harga_jual from harga_range_member where id_bahan=$id AND id_member='$id_member' AND $jml between jumlah_minimal and jumlah_maksimal");
				if($sql->num_rows() > 0){
					$harga_jual = ['status'=>true,'harga'=>$sql->row()->harga_jual ,'id_member'=>$id_member,'type_harga'=>$type_harga,'total'=>$jml];
					}else{
					$harga_jual = ['status'=>true,'harga'=>$harga_awal,'id_member'=>$id_member,'type_harga'=>$type_harga];
				}
				}else{
				$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id");
				$harga_jual = ['status'=>true,'harga'=>$harga_awal,'id_member'=>$id_member,'type_harga'=>$type_harga];
			}
			
			echo json_encode($harga_jual);
		}
		
		public function cek_harga_satuan()
		{
			$satuan = $this->input->post("satuan");
			$id_bahan = $this->input->post("id_bahan");
			$harga_awal = $this->input->post("harga");
			$jml = $this->input->post("jumlah");
			$totukuran = $this->input->post("totukuran");
			$totukuran = $totukuran !='' ? $totukuran : 1;
			$status = $this->input->post("status");
			$id_member = $this->db->escape_str($this->input->post('idmember'));
			
			$cek_status = $this->model_app->pilih_where('status_stok,type_harga,id_satuan,status','bahan',['id'=>$id_bahan])->row();
			$cek_satuan = $this->model_app->pilih_where('satuan','satuan',['id'=>$cek_status->id_satuan])->row();
			$type_harga = $cek_status->type_harga;
			
			if($cek_status->status_stok =='Y'){
				$this->cek_stok($id_bahan,$jml);
			}
			
			$status = $cek_status->status;
			if($status > 0){
				$jumlah = (int)$totukuran * $jml;
				}else{
				$jumlah = 1;
			}
			
			$sql = $this->db->query("select * from harga_satuan where id_bahan=$id_bahan AND  id_satuan=$satuan");
			if($sql->num_rows() > 0 AND $status==2){
				$harga_jual = ['status'=>true,'harga'=>$sql->row()->harga_jual,'satuan'=>$satuan];
				}else{
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
					$harga_jual = $sql1->row()->harga_jual * $jumlah;
					$satuan = $sql1->row()->idsatuan;
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan];
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
					`harga_satuan`.`id_satuan` = $satuan AND `harga_satuan`.`id_bahan` = $id_bahan");
					if($sql2->num_rows() > 0){
						$harga_jual = $sql2->row()->harga_jual;
						$satuan = $sql2->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan,'type_harga'=>$type_harga];
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
					if($sql3->num_rows() > 0){
						$harga_jual = $sql3->row()->harga_jual * $jumlah;
						$satuan = $sql3->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan];
					}elseif($type_harga==4){
					$sql = $this->db->query("select id_satuan,harga_jual from range_harga where id_bahan=$id_bahan AND $jumlah between jumlah_minimal and jumlah_maksimal");
					if($sql->num_rows() > 0){
						$harga_jual = $sql->row()->harga_jual;
						$satuan = $sql->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal * $jumlah;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan];
					}elseif($type_harga==5){
					$sql4 = $this->db->query("select id_satuan,harga_jual from harga_range_member where id_bahan=$id_bahan AND id_member='$id_member' AND $jumlah between jumlah_minimal and jumlah_maksimal");
					if($sql4->num_rows() > 0){
						$harga_jual = $sql4->row()->harga_jual;
						$satuan = $sql4->row()->id_satuan;
						}else{
						$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
						$harga_jual = $sql->row()->harga_modal  * $jumlah;
						$satuan = $sql->row()->id_satuan;
					}
					$data = ['status'=>true,'harga'=>$harga_jual,'satuan'=>$satuan];
					}else{
					$sql = $this->db->query("select id,id_satuan,harga_modal from bahan where id=$id_bahan");
					$harga_jual = $sql->row()->harga_modal;
					$satuan = $sql->row()->id_satuan;
					$data = ['status'=>true,'harga'=>$harga_jual * $jumlah,'satuan'=>$satuan];
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
		
		private function cek_stok($id,$jumlah)
		{
			$cek_status = $this->model_app->pilih_where('status_stok','bahan',['id'=>$id])->row()->status_stok;
			if($cek_status =='Y'){
				$jml_masuk = stok_masuk($id);
				$jml_keluar = stok_keluar($id);
				$total = $jml_masuk - $jml_keluar;
				if($jumlah > $total AND $jumlah >0){
					$data = ['status'=>false,'msg'=>'sisa stok '.$total,'stok'=>$total];
					$this->output
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
					exit;
				}
			}
			
		}
		
		private function cek_boleh_utang($id_konsumen,$id_invoice)
		{
			$max_utang = $this->model_app
			->pilih_where("max_utang,status","konsumen", ["id" => $id_konsumen])
			->row();
			
			$cek_bayar = $this->model_app->cek_total("bayar_invoice_detail","SUM(jml_bayar) AS `total`",['id_invoice'=>$id_invoice]);
			
			if ($max_utang->max_utang == 0 AND $max_utang->status==0 AND $cek_bayar->total ==0) {
				$data = ["status" => 'harus_dp', "id" => $id_invoice, "msg" => 'Belum ada pembayaran'];
				$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				exit;
			}
		}
		
		public function save_bayar_piutang()
		{
			cek_nput_post("GET");
			
			$lampiran = "";
			
			if (!empty($_FILES["lampiran"]["name"])) {
				$config["upload_path"] = "./uploads/lampiran/";
				$config["allowed_types"] = "jpeg|jpg|png|webp";
				$config["max_size"] = "1000"; // kb
				$this->load->library("upload", $config);
				$this->upload->initialize($config);
				// if (!empty($_FILES["lampiran"]["name"])) {
				if (!$this->upload->do_upload("lampiran")) {
					
					$alert = [
                    "status" => 301,
                    "msg" => $this->upload->display_errors(),
                    "id" => 0,
                    "uang" => 0,
                    "total" => 0,
					];
					$this->output
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($alert, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
					exit;
					} else {
					$data = $this->upload->data();
					$lampiran = $data["file_name"];
				}
				// }
			}
			// exit;
			$type = $this->db->escape_str($this->input->post("type"));
			$noin = $this->db->escape_str($this->input->post("noin"));
			$noin = decrypt_url($noin);
			$id_bayar = $this->db->escape_str($this->input->post("id_byr"));
			$rekening = $this->db->escape_str($this->input->post("rekening"));
			$jml_bayar = $this->db->escape_str($this->input->post("uang"));
			$sisabayar = $this->db->escape_str($this->input->post("sisabayar"));
			// echo $noin;exit;
			$alert = [];
			if ($type == "simpan_bayar") {
				$this->session->unset_userdata("cart");
				
				$data = [
                "id_invoice" => $noin,
                "tgl_bayar" => date("Y-m-d"),
                "jam_bayar" => date("H:i:s"),
                "jml_bayar" => $jml_bayar,
                "id_bayar" => $id_bayar,
                "id_sub_bayar" => $rekening,
                "id_user" => $this->iduser,
                "lampiran" => $lampiran,
				];
				
				if ($noin != null and $jml_bayar > 0) {
					$input = $this->model_app->input("bayar_invoice_detail", $data);
					if ($input["status"] == "ok") {
						$this->model_app->update(
						"invoice",
						["pos" => 'Y',"status" => 'simpan',"total_bayar" => $sisabayar],
						["id_invoice" => $noin]
						);
						$this->kas_masuk();
						//cek jml bayar
						$select = "SUM(jml_bayar) AS `total`";
						$where = ["id_invoice" => $noin];
						$search = $this->model_app->cek_total(
                        "bayar_invoice_detail`",
                        $select,$where);
						
						//total di invoice
						$invoice = "total_bayar AS total";
						$searchin = $this->model_app->cek_total("invoice",$invoice,$where);
						$sum_detail = sum_detail($noin);
						
						$sisa = $sum_detail - $search->total;
						
						if ($searchin->total == $search->total) {
							$ket_debet = "Kas penjualan No. " . $noin;
							$ket_kredit = "Pendapatan No. " . $noin;
							$reff = "O-$noin";
							$jurnal_debet = [
							"id_user" => $this->iduser,
							"no_reff" => getIdAkun($id_bayar),
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "debit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_debet,
							];
							
							$jurnal_kredit = [
							"id_user" => $this->iduser,
							"no_reff" => 411,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "kredit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_kredit,
							];
							$this->model_app->jurnal_input($jurnal_debet);
							$this->model_app->jurnal_input($jurnal_kredit);
						}
						//jika jumlah bayar belum lunas
						
						if ($search->total <=0) {
							$ket_debet = "Piutang usaha No. " . $noin;
							$ket_kredit = "Pendapatan No. " . $noin;
							$reff = "O-$noin";
							$jurnal_debet = [
							"id_user" => $this->iduser,
							"no_reff" => 112,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "debit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_debet,
							];
							
							$jurnal_kredit = [
							"id_user" => $this->iduser,
							"no_reff" => getIdAkun($id_bayar),
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "kredit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_kredit,
							];
							$this->model_app->jurnal_input($jurnal_debet);
							$this->model_app->jurnal_input($jurnal_kredit);
						}
						
						//jika bayar dp
						if ($sisa > 0) {
							$total_dibayar = $jml_bayar;
							// $total_sisa = $searchin->total - $search->total;
							//insert kas
							$ket_debet = "Kas penjualan No. " . $noin;
							$ket_kredit = "Pendapatan No. " . $noin;
							$reff = "O-$noin";
							$jurnal_debet = [
							"id_user" => $this->iduser,
							"no_reff" => 111,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "debit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_debet,
							];
							
							$jurnal_kredit = [
							"id_user" => $this->iduser,
							"no_reff" => 411,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "kredit",
							"saldo" => $jml_bayar,
							"keterangan" => $ket_kredit,
							];
							$this->model_app->jurnal_input($jurnal_debet);
							$this->model_app->jurnal_input($jurnal_kredit);
							//insert piutang
							
							$ket_debet = "Piutang usaha No. " . $noin;
							$ket_kredit = "Pendapatan No. " . $noin;
							$reff = "O-$noin";
							$jurnal_debet = [
							"id_user" => $this->iduser,
							"no_reff" => 112,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "debit",
							"saldo" => $sisa,
							"keterangan" => $ket_debet,
							];
							
							$jurnal_kredit = [
							"id_user" => $this->iduser,
							"no_reff" => 411,
							"reff" => $reff,
							"tgl_input" => today(),
							"tgl_transaksi" => today(),
							"jenis_saldo" => "kredit",
							"saldo" => $sisa,
							"keterangan" => $ket_kredit,
							];
							$this->model_app->jurnal_input($jurnal_debet);
							$this->model_app->jurnal_input($jurnal_kredit);
							
						}
						
						if ($sisa == 0) {
							$this->model_app->update(
                            "invoice",
                            ["lunas" => 1],
							["id_invoice" => $noin]
							);
							$alert = [
							"status" => 200,
							"id" => $noin,
							"uang" => $jml_bayar,
							"total" => $search->total,
							];
							} else {
							$alert = [
							"status" => 200,
							"id" => $noin,
							"uang" => $jml_bayar,
							"total" => $searchin->total,
							];
						}
						} else {
						$alert = [
                        "status" => 304,
                        "id" => 0,
                        "uang" => 0,
                        "total" => 0,
						];
					}
					} else {
					$alert = [
                    "status" => 301,
                    "msg" => "Order sudah lunas",
                    "id" => $noin,
                    "uang" => $jml_bayar,
                    "total" => 0,
					];
				}
			}
			$this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($alert));
		}
		
		private function kas_masuk()
		{
			
			$noin = $this->db->escape_str($this->input->post("noin"));
			$noin = decrypt_url($noin);
			$id_bayar = $this->db->escape_str($this->input->post("id_byr"));
			$jml_bayar = $this->db->escape_str($this->input->post("uang"));
			$rekening = $this->db->escape_str($this->input->post("rekening"));
			if ($id_bayar == 1) {
				$no_reff = 411;
				} elseif ($id_bayar == 2) {
				$no_reff = 110;
			}
			
			$autoNumber = autoNumber(
			NOMOR_REFF,
			DIGIT_REFF,
			"id_generate",
			"kas_masuk"
			);
			$this->model_app->insert("kas_masuk", [
			"no_reff" => $no_reff,
			"id_bayar" => $id_bayar,
			"id_sub_bayar" => $rekening,
			"id_user" => $this->iduser,
			"id_generate" => $autoNumber,
			"pemasukan" => $jml_bayar,
			"catatan" => "Pendapatan INVOICE NO.#" . $noin,
			]);
		}
	}
