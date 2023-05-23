<?php
    defined("BASEPATH") or exit("No direct script access allowed");
    
    class Pembelian extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            
            cek_session_login();
            $this->load->helper("date");
            $this->db->query(
            "SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));"
            );
            $this->perPage = 10;
            $this->iduser = $this->session->idu;
            $this->title = info()["title"];
        }
        public function data()
        {
            cek_menu_akses();
            $format = "%Y-%m-%d";
            $harian = mdate($format);
            $data["title"] = "Faktur Pembelian | " . $this->title;
            $tgl_awal = date("01/m/Y", strtotime($harian));
            $data["tgl_awal"] = $tgl_awal;
            $data["tgl"] = date("d/m/Y");
            $data['dari'] = date('01/m/Y', strtotime(today()));
			$data['sampai'] = date('t/m/Y', strtotime(today()));
            // $data['jenis'] = $this->model_app->view_where('jenis_pengeluaran',array('id_akun'=>102,'id_akun'=>515,'kunci'=>0,'pub'=>'Y'))->result_array();
            $data["jenis"] = $this->model_app
            ->view_where(
            "jenis_pengeluaran",
            ["pub" => "Y",'kunci'=>0]
            )
            ->result_array();
            $data["pilihan"] = $this->model_app->view("tb_users");
            
            $conditions["where"] = [
            "tgl_pembelian" => $harian,
            ];
            $conditions["returnType"] = "count";
            $totalRec = $this->model_data->getPembelian($conditions);
            // Pagination configuration
            $config["target"] = "#dataListpembelian";
            $config["base_url"] = base_url("ajax/ajaxPembelian");
            $config["total_rows"] = $totalRec;
            $config["per_page"] = $this->perPage;
            
            // Initialize pagination library
            $this->ajax_pagination->initialize($config);
            
            // Get records
            $conditions = [
            "limit" => $this->perPage,
            ];
            $conditions["where"] = [
            "tgl_pembelian" => $harian,
            ];
            $data["result"] = $this->model_data->getPembelian($conditions);
            
            $this->template->load("main/themes", "pembelian/pembelian", $data);
        }
        public function simpan_bayar_pembelian()
        {
            // $post = $this->input->post();
            // print_r($post);exit;
            $id_pembelian = $this->db->escape_str($this->input->post("id"));
            $total = $this->db->escape_str($this->input->post("total"));
            $jml_bayar = $this->db->escape_str($this->input->post("jml_bayar"));
            
            $cara_bayar = $this->db->escape_str($this->input->post("cara_bayar"));
            $sumber_kas = $this->db->escape_str($this->input->post("sumber_kas"));
            $reff = "B-$id_pembelian";
            //bayar tempo
            if ($cara_bayar == 3) {
                $jatuh_tempo = $this->db->escape_str(
                $this->input->post("jatuh_tempo")
                );
                $jatuh_tempo = date_slash($jatuh_tempo);
                $data = [
                "total_bayar" => $total,
                "tgl_jatuhtempo" => $jatuh_tempo,
                "id_kas" => $sumber_kas,
                "id_bayar" => $cara_bayar,
                ];
                $where = [
                "id_pembelian" => $id_pembelian,
                "id_user" => $this->iduser,
                ];
                $res = $this->model_app->update("pembelian", $data, $where);
                
                if ($res["status"] == "ok") {
                    $data = ["status" => 200, "msg" => "simpan data"];
                    } else {
                    $data = ["status" => 400, "msg" => "error"];
                }
                
                $ket_debet = "Pembelian No. " . $id_pembelian;
                $ket_kredit = "Utang Pembelian No. " . $id_pembelian;
                $jurnal_debet = [
                "id_user" => $this->iduser,
                "no_reff" => 102,
                "reff" => $reff,
                "tgl_input" => today(),
                "tgl_transaksi" => today(),
                "jenis_saldo" => "debit",
                "saldo" => $jml_bayar,
                "keterangan" => $ket_debet,
                ];
                
                $jurnal_kredit = [
                "id_user" => $this->iduser,
                "no_reff" => getIdAkun($cara_bayar),
                "reff" => $reff,
                "tgl_input" => today(),
                "tgl_transaksi" => today(),
                "jenis_saldo" => "kredit",
                "saldo" => $jml_bayar,
                "keterangan" => $ket_kredit,
                ];
                $this->model_app->jurnal_input($jurnal_debet);
                $this->model_app->jurnal_input($jurnal_kredit);
                } else {
                if ($jml_bayar < $total) {
                    
                    //insert hutang usaha
                    $ket_debet = "Pembelian No. " . $id_pembelian;
                    $ket_kredit = "Utang Pembelian No. " . $id_pembelian;
                    $total_jurnal = $total - $jml_bayar;
                    $jurnal_debet = [
                    "id_user" => $this->iduser,
                    "no_reff" => 102,
                    "reff" => $reff,
                    "tgl_input" => today(),
                    "tgl_transaksi" => today(),
                    "jenis_saldo" => "debit",
                    "saldo" => $total_jurnal,
                    "keterangan" => $ket_debet,
                    ];
                    
                    $jurnal_kredit = [
                    "id_user" => $this->iduser,
                    "no_reff" => 211,
                    "reff" => $reff,
                    "tgl_input" => today(),
                    "tgl_transaksi" => today(),
                    "jenis_saldo" => "kredit",
                    "saldo" => $total_jurnal,
                    "keterangan" => $ket_kredit,
                    ];
                    $this->model_app->jurnal_input($jurnal_debet);
                    $this->model_app->jurnal_input($jurnal_kredit);
                    
                    //inser bayar_pembelian
                    $ket_debet = "Pembelian No. " . $id_pembelian;
                    $ket_kredit = "Utang Pembelian No. " . $id_pembelian;
                    $jurnal_debet = [
                    "id_user" => $this->iduser,
                    "no_reff" => 102,
                    "tgl_input" => today(),
                    "tgl_transaksi" => today(),
                    "jenis_saldo" => "debit",
                    "saldo" => $jml_bayar,
                    "keterangan" => $ket_debet,
                    ];
                    
                    $jurnal_kredit = [
                    "id_user" => $this->iduser,
                    "no_reff" => getIdAkun($cara_bayar),
                    "tgl_input" => today(),
                    "tgl_transaksi" => today(),
                    "jenis_saldo" => "kredit",
                    "saldo" => $jml_bayar,
                    "keterangan" => $ket_kredit,
                    ];
                    $this->model_app->jurnal_input($jurnal_debet);
                    $this->model_app->jurnal_input($jurnal_kredit);
                }  
                if ($jml_bayar == $total) {
                    $ket_debet = "Pembelian No. " . $id_pembelian;
                    $ket_kredit = "Bayar Pembelian No. " . $id_pembelian;
                    $jurnal_debet = [
                    "id_user" => $this->iduser,
                    "no_reff" => 102,
                    "reff" => $reff,
                    "tgl_input" => today(),
                    "tgl_transaksi" => today(),
                    "jenis_saldo" => "debit",
                    "saldo" => $jml_bayar,
                    "keterangan" => $ket_debet,
                    ];
                    
                    $jurnal_kredit = [
                    "id_user" => $this->iduser,
                    "no_reff" => getIdAkun($cara_bayar),
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
                $data = [
                "id_pembelian" => $id_pembelian,
                "tgl_bayar" => date("Y-m-d"),
                "jml_bayar" => $jml_bayar,
                "id_bayar" => $cara_bayar,
                "id_sub_bayar" => $sumber_kas,
                "id_user" => $this->iduser,
                ];
                $_data = [
                "total_bayar" => $total,
                "id_kas" => $sumber_kas,
                "id_bayar" => $cara_bayar,
                ];
                $where = [
                "id_pembelian" => $id_pembelian,
                "id_user" => $this->iduser,
                ];
                $update = $this->model_app->update("pembelian", $_data, $where);
                if ($update["status"] == "ok") {
                    $input = $this->model_app->input("bayar_pembelian", $data);
                    if ($input["status"] == "ok") {
                        $data = ["status" => 200, "msg" => "sukses"];
                        $autoNumber = autoNumber(
                        NOMOR_REFF,
                        DIGIT_REFF,
                        "id_generate",
                        "kas_masuk"
                        );
                        $this->model_app->insert("kas_masuk", [
                        "id_bayar" => $cara_bayar,
                        "no_reff" => $sumber_kas,
                        "id_user" => $this->iduser,
                        "id_generate" => $autoNumber,
                        "pengeluaran" => $jml_bayar,
                        "catatan" => "Pembelian No.#" . $id_pembelian,
                        ]);
                        } else {
                        $data = ["status" => 400, "msg" => "Input Gagal"];
                    }
                    } else {
                    $data = ["status" => 400, "msg" => "error"];
                }
            }
            $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
        }
        
        public function simpan_bayar_piutang()
        {
            // print_r($_POST);exit;
            $idinfo = $this->db->escape_str($this->input->post("idinfo"));
            $id_pembelian = $this->db->escape_str($this->input->post("id"));
            $total = $this->db->escape_str($this->input->post("total"));
            $jml_bayar = $this->db->escape_str($this->input->post("jml_bayar"));
            $cara_bayar = $this->db->escape_str($this->input->post("cara_bayar"));
            $sumber_kas = $this->db->escape_str($this->input->post("sumber_kas"));
            
            $reff = "B-$id_pembelian";
            $data = [
            "id_pembelian" => $id_pembelian,
            "tgl_bayar" => date("Y-m-d"),
            "jml_bayar" => $jml_bayar,
            "id_bayar" => $cara_bayar,
            "id_sub_bayar" => $sumber_kas,
            "id_user" => $this->iduser,
            ];
            if ($idinfo == "bayarh") {
                $cek_sum = $this->model_app->sum_data(
                "jml_bayar",
                "bayar_pembelian",
                ["id_pembelian" => $id_pembelian]
                );
                if ($cek_sum < $total) {
                    $input = $this->model_app->input("bayar_pembelian", $data);
                    if ($input["status"] == "ok") {
                        $data = ["status" => 200, "msg" => "sukses"];
                        $autoNumber = autoNumber(
                        NOMOR_REFF,
                        DIGIT_REFF,
                        "id_generate",
                        "kas_masuk"
                        );
                        $this->model_app->insert("kas_masuk", [
                        "id_bayar" => $cara_bayar,
                        "no_reff" => $sumber_kas,
                        "id_user" => $this->iduser,
                        "id_generate" => $autoNumber,
                        "pengeluaran" => $this->input->post("total"),
                        "catatan" => "Bayar Utang No.#" . $id_pembelian,
                        ]);
                        } else {
                        $data = ["status" => 400, "msg" => "Input Gagal"];
                    }
                    } else {
                    $data = ["status" => 400, "msg" => "jumlah bayar kebesaran"];
                }
                } else {
                $cek_sum = $this->model_app->sum_data(
                "jml_bayar",
                "bayar_pembelian",
                ["id_pembelian" => $id_pembelian]
                );
                if ($cek_sum < $total) {
                    $input = $this->model_app->input("bayar_pembelian", $data);
                    if ($input["status"] == "ok") {
                        $cek_sum_ulang = $this->model_app->sum_data(
                        "jml_bayar",
                        "bayar_pembelian",
                        ["id_pembelian" => $id_pembelian]
                        );
                        if ($cek_sum_ulang == $jml_bayar) {
                            $this->model_app->update(
                            "pembelian",
                            ["lunas" => "Y"],
                            ["id_pembelian" => $id_pembelian]
                            );
                        }
                        $ket_debet = "Bayar Utang No. " . $id_pembelian;
                        $ket_kredit = "Bayar Utang No. " . $id_pembelian;
                        $jurnal_debet = [
                        "id_user" => $this->iduser,
                        "no_reff" => 102,
                        "reff" => $reff,
                        "tgl_input" => today(),
                        "tgl_transaksi" => today(),
                        "jenis_saldo" => "debit",
                        "saldo" => $jml_bayar,
                        "keterangan" => $ket_debet,
                        ];
                        
                        $jurnal_kredit = [
                        "id_user" => $this->iduser,
                        "no_reff" => getIdAkun($cara_bayar),
                        "reff" => $reff,
                        "tgl_input" => today(),
                        "tgl_transaksi" => today(),
                        "jenis_saldo" => "kredit",
                        "saldo" => $jml_bayar,
                        "keterangan" => $ket_kredit,
                        ];
                        $this->model_app->jurnal_input($jurnal_debet);
                        $this->model_app->jurnal_input($jurnal_kredit);
                        
                        $data = ["status" => 200, "msg" => "sukses"];
                        $autoNumber = autoNumber(
                        NOMOR_REFF,
                        DIGIT_REFF,
                        "id_generate",
                        "kas_masuk"
                        );
                        $this->model_app->insert("kas_masuk", [
                        "id_bayar" => $cara_bayar,
                        "no_reff" => $sumber_kas,
                        "id_user" => $this->iduser,
                        "id_generate" => $autoNumber,
                        "pengeluaran" => $jml_bayar,
                        "catatan" => "Bayar Utang No.#" . $id_pembelian,
                        ]);
                        } else {
                        $data = ["status" => 400, "msg" => "Input Gagal"];
                    }
                    } else {
                    $data = ["status" => 400, "msg" => "jumlah bayar kebesaran "];
                }
            }
            
            $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
        }
        public function jenis_kas()
        {
            $id = $this->db->escape_str($this->input->post("id"));
            if ($id == 2) {
                $result = $this->model_app->view_where("jenis_kas", [
                "id" => 3,
                "kunci" => 0,
                ]);
                } elseif ($id == 3) {
                $result = $this->model_app->view_where("jenis_kas", [
                "id" => 4,
                "kunci" => 1,
                ]);
                } else {
                $result = $this->model_app->view_where("jenis_kas", [
                "id !=" => 3,
                "kunci" => 0,
                ]);
            }
            $data = [];
            foreach ($result->result() as $row) {
                $data[] = ["id" => $row->id_akun, "name" => $row->title];
            }
            
            $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
        }
        
        public function save_data()
        {
            $id = $this->input->post("id");
            $idkas = $this->input->post("kas");
            $jenis_bayar = $this->input->post("jenis_bayar");
            if ($this->input->post("tempo") == "") {
                $tgl = null;
                } else {
                $tgl = date_slash($this->input->post("tempo"));
            }
            $data = [
            "total_bayar" => $this->input->post("total"),
            "tgl_jatuhtempo" => $tgl,
            "id_kas" => $idkas,
            "id_bayar" => $jenis_bayar,
            ];
            
            $where = ["id_pembelian" => $id, "id_user" => $this->iduser];
            $res = $this->model_app->update("pembelian", $data, $where);
            if ($res["status"] == "ok") {
                $data = [
                "ok" => 200,
                "msg" => "ok",
                "tgl" => $this->input->post("tempo"),
                ];
                } else {
                $data = ["ok" => 400, "msg" => "error"];
            }
            $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
        }
        
        public function save_pembelian()
        {
            $id = $this->input->post("id");
            
            $sql = $this->model_app->view_where("pembelian", [
            "id_pembelian" => $id,
            "pos" => "N",
            "stok" => "N",
            ]);
            if ($sql->num_rows() > 0) {
                $sql = $this->model_app
                ->view_where("pembelian_detail", ["id_pembelian" => $id])
                ->result();
                foreach ($sql as $val) {
                    $batch[] = [
                    "id_bahan" => $val->id_bahan,
                    "jumlah" => $val->jumlah,
                    "ket" => $val->keterangan,
                    "create_date" => today(),
                    ];
                }
                $this->db->insert_batch("stok_masuk", $batch);
            }
            $id_user = $this->iduser;
            $tgl = date_slash($this->input->post("tgl"));
            $cek = $this->model_app->view_where("pembelian", [
            "id_pembelian" => $id,
            "id_bayar" => 0,
            ]);
            if ($cek->num_rows() > 0) {
                $data = ["status" => false, "bayar" => 0];
                } else {
                $data = [
                "total_bayar" => $this->input->post("total"),
                "pos" => "Y",
                "stok" => "Y",
                "tgl_pembelian" => $tgl,
                ];
                $where = ["id_pembelian" => $id, "id_user" => $id_user];
                $res = $this->model_app->update("pembelian", $data, $where);
                if ($res["status"] == "ok") {
                    $this->model_app->update(
                    "tb_users",
                    ["last_idbeli" => 0],
                    ["id_user" => $id_user]
                    );
                    $this->update_harga_barang($id);
                    $this->session->unset_userdata("cartbeli");
                    $data = ["status" => true, "id" => $id];
                    } else {
                    $data = ["status" => false, "id" => ""];
                }
            }
            $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
        }
        
        private function update_harga_barang($id_beli){
			$cek_harga = $this->model_app->pilih_where('id_bahan,jumlah,harga','pembelian_detail',['id_pembelian'=>$id_beli]);
			foreach($cek_harga->result() AS $row){
				$harga_modal = $this->model_app->pilih_where('harga_modal','bahan',['id'=>$row->id_bahan])->row()->harga_modal;
				$sql_stok = $this->model_app->sum_stok('stok_masuk',['id_bahan'=>$row->id_bahan])->row()->total;
				$harga_baru = ($harga_modal * $sql_stok) + ($row->harga * $row->jumlah);
				$stok_baru = $sql_stok + $row->jumlah;
				$update_harga_baru = $harga_baru / $stok_baru;
				// echo ceil($update_harga_baru);
				$this->model_app->update('bahan',['harga_modal'=>ceil($update_harga_baru)],['id'=>$row->id_bahan]);
            }
        }
        
        public function save_detail()
        {
            $id = $this->input->post("id");
            $bahan = $this->input->post("bahan");
            $jenis = $this->input->post("jenis");
            if (empty($jenis)) {
                $jenis = 1;
            }
            // $ket = strtolower($this->input->post('ket'));
            // $ket = ucwords($ket);
            
            $data = [
            "id_bahan" => $bahan,
            "id_biaya" => $jenis,
            "jumlah" => $this->input->post("jum"),
            "harga" => $this->input->post("harga"),
            "satuan" => $this->input->post("satuan"),
            ];
            $where = ["no" => $id];
            $res = $this->model_app->update("pembelian_detail", $data, $where);
            if ($res["status"] == "ok") {
                $data = ["ok" => "ok", "id" => $id];
                } else {
                $data = ["error"];
            }
            echo json_encode($data);
        }
        public function hapus_detail()
        {
            $idx = $this->input->post("id");
            $id = ["no" => $idx];
            $res = $this->model_app->hapus("pembelian_detail", $id);
            if ($res["status"] == "ok") {
                $data = ["ok" => "ok", "msg" => "Data berhasil dihapus"];
                } else {
                $data = ["ok" => "err", "msg" => "Data gagal dihapus"];
            }
            $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($data));
        }
        
        public function add_detail()
        {
            $id = $this->db->escape_str($this->input->post("id"));
            $res = $this->model_app->input("pembelian_detail", [
            "id_pembelian" => $id,
            "id_biaya" => 1,
            ]);
            $last_id = $res["id"];
            if ($res["status"] == "ok") {
                $data = [
                "ok" => "ok",
                "idr" => $last_id,
                "jenis" => 1,
                "msg" => "sukses",
                ];
                } else {
                $data = [
                "ok" => "no",
                "idr" => 0,
                "jenis" => 1,
                "msg" => "Input Gagal",
                ];
            }
            echo json_encode($data);
        }
        
        public function load_modal()
        {
            $info = $this->db->escape_str($this->input->post("info"));
            $id = $this->db->escape_str($this->input->post("id"));
            $iduser = $this->db->escape_str($this->input->post("user"));
            $format = "%Y-%m-%d";
            $mdate = mdate($format);
            
            $arr["a"] = "";
            $data["jenis_bayar"] = $this->model_app
            ->view_where("jenis_bayar", ["publish" => "Y"])
            ->result();
            if ($iduser == "" and $id != 0) {
                $arr["a"] = "a";
                $search = $this->model_app->edit("pembelian", [
                "id_pembelian" => $id,
                ]);
                $rows = $search->row();
                $data["info"] = $info;
                $data["loadp"] = $rows;
                $data["loadd"] = $this->model_app
                ->pembelian_detail([
                "pembelian_detail.id_pembelian" => $rows->id_pembelian,
                ])
                ->result_array();
                $cek_user = $this->model_app
                ->edit("tb_users", ["id_user" => $rows->id_user])
                ->row();
                $data["nama"] = $cek_user->nama_lengkap;
                $data["id_user"] = $cek_user->id_user;
                $this->load->view("pembelian/load_modal", $data, false);
                } else {
                if (empty($iduser)) {
                    $iduser = $this->iduser;
                    } else {
                    $iduser = $iduser;
                }
                $cek_user = $this->model_app
                ->edit("tb_users", ["id_user" => $iduser])
                ->row();
                $data["nama"] = $cek_user->nama_lengkap;
                $data["id_user"] = $iduser;
                
                //tambah
                if ($info == "tambah") {
                    if (isset($this->session->cartbeli)) {
                        $arr["a"] = "b";
                        $cek = $this->model_app->edit("pembelian", [
                        "id_pembelian" => $this->session->cartbeli,
                        "id_user" => $iduser,
                        ]);
                        $rows = $cek->row();
                        $data["info"] = $info;
                        $data["loadp"] = $rows;
                        $data["loadd"] = $this->model_app
                        ->pembelian_detail([
                        "pembelian_detail.id_pembelian" =>
                        $rows->id_pembelian,
                        ])
                        ->result_array();
                        $iddel = [
                        "id_bahan" => 0,
                        "id_pembelian" => $rows->id_pembelian,
                        ];
                        $res = $this->model_app->delete("pembelian_detail", $iddel);
                        $this->load->view("pembelian/load_modal", $data, false);
                        } else {
                        $arr["a"] = "c";
                        $array = ["tgl_pembelian" => $mdate, "id_user" => $iduser];
                        $this->model_app->insert("pembelian", $array);
                        $last_id = $this->db->insert_id();
                        $this->session->set_userdata(["cartbeli" => $last_id]);
                        $this->model_app->insert("pembelian_detail", [
                        "id_pembelian" => $last_id,
                        "id_biaya" => 1,
                        ]);
                        $data["info"] = $info;
                        $data["loadp"] = $this->model_app
                        ->view_where("pembelian", ["id_pembelian" => $last_id])
                        ->row();
                        $data["loadd"] = $this->model_app
                        ->pembelian_detail([
                        "pembelian_detail.id_pembelian" => $last_id,
                        ])
                        ->result_array();
                        $iddel = ["id_bahan" => 0, "id_pembelian" => $last_id];
                        $res = $this->model_app->delete("pembelian_detail", $iddel);
                        $this->model_app->update(
                        "tb_users",
                        ["last_idbeli" => $last_id],
                        ["id_user" => $iduser]
                        );
                        
                        $this->load->view("pembelian/load_modal", $data, false);
                    }
                    //edit
                    } elseif ($info == "bayar") {
                    $arr["a"] = "d";
                    $search = $this->model_app->edit("pembelian", [
                    "id_pembelian" => $id,
                    ]);
                    $rows = $search->row();
                    if ($rows->rekap == "Y") {
                        echo "error";
                        } else {
                        $data["info"] = $info;
                        $data["loadp"] = $rows;
                        $data["loadd"] = $this->model_app
                        ->pembelian_detail([
                        "pembelian_detail.id_pembelian" =>
                        $rows->id_pembelian,
                        ])
                        ->result_array();
                        $iddel = [
                        "id_bahan" => 0,
                        "id_pembelian" => $rows->id_pembelian,
                        ];
                        $res = $this->model_app->delete("pembelian_detail", $iddel);
                        $this->load->view("pembelian/load_modal", $data, false);
                    }
                    } elseif ($info == "edit" or $info == "view") {
                    $arr["a"] = "e";
                    $search = $this->model_app->edit("pembelian", [
                    "id_pembelian" => $id,
                    ]);
                    $rows = $search->row();
                    $data["info"] = $info;
                    $data["loadp"] = $rows;
                    $data["loadd"] = $this->model_app
                    ->pembelian_detail([
                    "pembelian_detail.id_pembelian" => $rows->id_pembelian,
                    ])
                    ->result_array();
                    $iddel = [
                    "id_bahan" => 0,
                    "id_pembelian" => $rows->id_pembelian,
                    ];
                    $res = $this->model_app->delete("pembelian_detail", $iddel);
                    $this->load->view("pembelian/load_modal", $data, false);
                    } elseif ($info == "lunas") {
                    $arr["a"] = "f";
                    $search = $this->model_app->edit("pembelian", [
                    "id_pembelian" => $id,
                    ]);
                    $rows = $search->row();
                    $data["info"] = $info;
                    $data["loadp"] = $rows;
                    $data["loadd"] = $this->model_app
                    ->pembelian_detail([
                    "pembelian_detail.id_pembelian" => $rows->id_pembelian,
                    ])
                    ->result_array();
                    $iddel = [
                    "id_bahan" => 0,
                    "id_pembelian" => $rows->id_pembelian,
                    ];
                    $res = $this->model_app->delete("pembelian_detail", $iddel);
                    $this->load->view("pembelian/load_modal", $data, false);
                }
            }
            // print_r($arr);
        }
        public function load_total_bayar()
        {
            $id = $this->db->escape_str($this->input->post("id"));
            $total = $this->model_cek->sum_pembelian(["id_pembelian" => $id]);
            echo $total;
        }
        public function load_bayar()
        {
            $info = $this->db->escape_str($this->input->post("info"));
            $id = $this->db->escape_str($this->input->post("id"));
            $iduser = $this->db->escape_str($this->input->post("user"));
            $format = "%Y-%m-%d";
            $mdate = mdate($format);
            $data["jenis_bayar"] = $this->model_app
            ->view_where("jenis_bayar", ["publish" => "Y"])
            ->result();
            if ($id > 0) {
                $search = $this->model_app->edit("bayar_pembelian", [
                "id_pembelian" => $id,
                ]);
                $data["bayar"] = $search;
                if($info=='bayarh'){
                    $this->load->view("pembelian/list_piutang", $data, false);
                    }else{
                    $this->load->view("pembelian/list_bayar", $data, false);
                }
            }
        }
        public function list_bayar()
        {
            $noin = $this->db->escape_str($this->input->post("id"));
            $data["total_bayar"] = $this->model_app
            ->pilih("total_bayar", "pembelian", ["id_pembelian" => $noin])
            ->row();
            $data["bayar"] = $this->model_app->view_where("bayar_pembelian", [
            "id_pembelian" => $noin,
            ]);
            $this->load->view("pembelian/list_bayar", $data);
        }
        public function del_bayar()
        {
            cek_nput_post("GET");
            cek_crud_akses(10);
            $id = $this->db->escape_str($this->input->post("id"));
            $idin = $this->db->escape_str($this->input->post("noin"));
            $kunci = $this->db->escape_str($this->input->post("kunci"));
            $jml = $this->db->escape_str($this->input->post("jml"));
            $idbayar = $this->db->escape_str($this->input->post("idbayar"));
            
            if ($this->session->level == "admin" or $this->session->level == "owner") 
            {
                $where = ["id" => $id, "id_pembelian" => $idin];
                } else {
                $where = ["id" => $id, "id_pembelian" => $idin, "kunci" => $kunci];
            }
            $res = $this->model_app->delete("bayar_pembelian", $where);
            if ($res == true) {
                $_where = ["catatan" => "Pembelian No.#" . $idin];
                $this->model_app->delete("kas_masuk", $_where);
                $this->model_app->delete("jurnal_transaksi", ['reff'=>'B-'.$idin]);
                // if ($idbayar == 1) {
                // $no_reff = 411;
                // } elseif ($idbayar == 2) {
                // $no_reff = 111;
                // }
                // $autoNumber = autoNumber(
                // NOMOR_REFF,
                // DIGIT_REFF,
                // "id_generate",
                // "kas_keluar"
                // );
                // $this->model_app->insert("kas_keluar", [
                // "no_reff" => $no_reff,
                // "id_bayar" => $idbayar,
                // "id_user" => $this->iduser,
                // "id_generate" => $autoNumber,
                // "catatan" => "Hapus pembelian No.#" . $idin,
                // "pengeluaran" => $jml,
                // ]);
                $data = ["ok" => "ok", "uang" => $jml];
                } else {
                $data = ["ok" => "no", "uang" => 0];
            }
            echo json_encode($data);
        }
        
        public function del_bayar_utang()
        {
            cek_nput_post("GET");
            cek_crud_akses(10);
            $id = $this->db->escape_str($this->input->post("id"));
            $idin = $this->db->escape_str($this->input->post("noin"));
            $kunci = $this->db->escape_str($this->input->post("kunci"));
            $jml = $this->db->escape_str($this->input->post("jml"));
            $idbayar = $this->db->escape_str($this->input->post("idbayar"));
            
            if ($this->session->level == "admin" or $this->session->level == "owner") 
            {
                $where = ["id" => $id, "id_pembelian" => $idin];
                } else {
                $where = ["id" => $id, "id_pembelian" => $idin, "kunci" => $kunci];
            }
            $res = $this->model_app->delete("bayar_pembelian", $where);
            if ($res == true) {
                $_where = ["catatan" => "Bayar Utang No.#" . $idin];
                $this->model_app->delete("kas_masuk", $_where);
                $this->model_app->delete("jurnal_transaksi", ['reff'=>'B-'.$idin]);
                $data = ["ok" => "ok", "uang" => $jml];
                } else {
                $data = ["ok" => "no", "uang" => 0];
            }
            echo json_encode($data);
        }
        public function cetak_pembelian($noid)
        {
            $id = ["id_pembelian" => $noid];
            
            $search = $this->model_app->view_where("pembelian", $id);
            $data["logo"] = FCPATH . "uploads/" . info()["logo"];
            
            if ($search->num_rows() > 0) {
                $this->session->unset_userdata("cartbeli");
                $row = $search->row_array();
                $data["cetak"] = $row;
                $data["info"] = info();
                $data["detail"] = $this->model_app
                ->view_where("pembelian_detail", ["id_pembelian" => $noid])
                ->result_array();
                $data["user"] = $this->model_app
                ->view_where("tb_users", ["id_user" => $row["id_user"]])
                ->row_array();
                $this->load->library("pdf");
                $this->pdf->setPaper("A5", "landscape");
                $this->pdf->filename =
                "pembelian_" . $noid . "_" . $row["tgl_pembelian"];
                $this->pdf->load_view("pembelian/cetak_pembelian", $data);
                // $this->load->view('pembukuan/cetak_pengeluaran',$data);
                } else {
                $data["heading"] = "Halaman error";
                $data["message"] = "Data tidak ditemukan";
                $this->load->view("errors/html/error_404", $data);
            }
        }
        
        public function cetak_periode()
        {
            $periode = $this->input->post('periode');
            list($bulan,$tahun) = explode(' ',$periode);
            $bulan = getBlnPiutang($bulan);
            $data = $this->model_data->getMonthPembelian($bulan,$tahun);
            print_r($data);exit;
            $id = ["id_pembelian" => $noid];
            
            $search = $this->model_app->view_where("pembelian", $id);
            $data["logo"] = FCPATH . "uploads/" . info()["logo"];
            
            if ($search->num_rows() > 0) {
                $this->session->unset_userdata("cartbeli");
                $row = $search->row_array();
                $data["cetak"] = $row;
                $data["info"] = info();
                $data["detail"] = $this->model_app
                ->view_where("pembelian_detail", ["id_pembelian" => $noid])
                ->result_array();
                $data["user"] = $this->model_app
                ->view_where("tb_users", ["id_user" => $row["id_user"]])
                ->row_array();
                $this->load->library("pdf");
                $this->pdf->setPaper("A5", "landscape");
                $this->pdf->filename =
                "pembelian_" . $noid . "_" . $row["tgl_pembelian"];
                $this->pdf->load_view("pembelian/cetak_pembelian", $data);
                // $this->load->view('pembukuan/cetak_pengeluaran',$data);
                } else {
                $data["heading"] = "Halaman error";
                $data["message"] = "Data tidak ditemukan";
                $this->load->view("errors/html/error_404", $data);
            }
        }
    }
