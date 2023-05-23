<div class="modal fade modal-fullscreen-xl mymodal" id="OpenCart-1" tabindex="-1"
aria-labelledby="OpenCart-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content flat">
            <div class="modal-header bg-danger py-1 flat">
                <h5 class="modal-title text-white">INVOICE #<span class="tinvoice"></span></h5>
                <button type="button" class="btn btn-secondary btn-sm flat" data-dismiss="modal">TUTUP [ESC]</button>
            </div>
            <div class="modal-body" id="keranjang">
                <div class="load-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-toggle='tooltip' data-placement="top" title="Tutup [ESC]" class="btn btn-danger btn-sm flat" data-dismiss="modal">TUTUP [ESC]</button>
                <button type="button" class="btn btn-danger btn-sm batal_order flat" data-toggle='tooltip' title="Batal Order" id="batal_order"><i class="fa fa-times"></i> BATAL ORDER</button>
                <a href="javascript:void(0);"  data-toggle="modal" data-target="#modal-shortcut"  class="btn btn-info btn-sm mr-auto flat" data-url="transaksi" data-toggle="tooltip" data-original-title="Shortcut" data-placement="top">
					<span class="icon text-white-50">
						<i class="fa fa-info-circle fa-fw fa-lg"></i>
                    </span>	
                </a>
                <button type="button" class="btn btn-info btn-sm print_pdf flat" data-toggle='tooltip' title="Print Pdf" id="print_pdf"><i class="fa fa-file-pdf-o"></i> PRINT</button>
                
                <button type="button" class="btn btn-info btn-sm print flat" data-toggle='tooltip' title="Print [CTRL+P]" id="print">SIMPAN & CETAK ORDER</button>
                <button type="button" class="btn btn-success btn-sm bayarin flat" id="bayarin" data-toggle='tooltip' title="Bayar [CTRL+B]" >BAYAR</button>
                <button type="button" class="btn btn-warning btn-sm pending flat" id="pending" data-toggle='tooltip' title="Pending">PENDING</button>
                <!--button type="button" class="btn btn-danger btn-sm batalin" id="batalin" data-toggle='tooltip' title="Batal" disabled>Cancel</button-->
            </div>
        </div>
    </div>
</div>
<!--div class="modal fade modal-fullscreen-xl" id="OpenTrx-1" tabindex="-1"
aria-labelledby="OpenTrx-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content flat">
            <div class="modal-header py-1">
                <h5 class="modal-title">Data transaksi</h5>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
            <div class="modal-body scrollbar-dynamic">
                <div class="load-trx"></div>
            </div>
            
        </div>
    </div>
</div-->
<div class="modal fade" id="button-qr" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Scan Barcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
        
                <div id="qr-reader" style="width: 100%;text-align:center"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-shortcut" tabindex="-1"
aria-labelledby="modal-shortcut" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content flat">
        <div class="modal-header py-1">
            <h5 class="modal-title">SHORTCUT TRANSAKSI</h5>
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
        <div class="modal-body">
            <ul class="pl-3">
                <li><small>F1 : CARI PRODUK</small></li>
                <li><small>F2 : CARI PELANGGAN</small></li>
                <li><small>F3 : TAMBAH PELANGGAN</small></li>
                <li><small>CTRL + P : SIMPAN | CETAK INVOICE</small></li>
                <li><small>CTRL + B : BAYAR INVOICE</small></li>
                <li><small>CTRL + L : KEMBALI KE AWAL BARIS KOLOM</small></li>
                <li><small>ESC : TUTUP KERANJANG</small></li>
                <li><small>TAB/ENTER/CTRL + ENTER : PINDAH KOLOM KE KANAN</small></li>
                <li><small>SHIFT + ENTER : PINDAH KOLOM KE KIRI</small></li>
            </ul>
        </div>
        
    </div>
</div>
</div>
<div class="modal fade modal-fullscreen-xl" id="OpenKon" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content flat">
            <div class="modal-header py-1">
                <h5 class="modal-title">Data Konsumen</h5>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
            <div class="modal-body scrollbar-dynamic">
                <div class="load-data-konsumen"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-cari-2" tabindex="-1" aria-labelledby="modal-cari" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content flat">
            <form role="form" id="form-cari">
                <div class="modal-header py-1">
                    <h4 class="modal-title">Cari Pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="data-cari"></div>
                    <p style="color:red;font-weight:bold;display:none" id="error_piutang"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger tutup-cari"
                    data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan" disabled>Pilih</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="modal-tambah-1" class="modal fade left" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content flat">
            <div class="modal-header py-1">
                <h4 class="modal-title">Tambah Pelanggan</h4>
                <button type="button" class="close tutup-con" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" id="form-tambah" method="post">
                    <span id="error_input"></span>
                    <input type="hidden" class="form-control" id="id_nya" name="id_nya">
                    <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label">Telepon</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <input class="form-control form-control-sm flat shift-focus" minlength="10" id="telepon_add" name="telepon_add" autofocus required>
                                <input type="hidden" id="type_add" name="type_add">
                                <div class="input-group-append" id="dispu"></div>
                            </div>
                            <div id="feedback-telp" class="feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label">Panggilan</label>
                        <div class="col-sm-7">
                            <select name="panggilan_add" id="panggilan_add" class="custom-select form-control form-control-sm pl-1  flat shift-focus"
                            required>
                                <option value="" selected>Pilih</option>
                                <option value="Bpk">Bpk</option>
                                <option value="Ibu">Ibu</option>
                                <option value="Mba">Mba</option>
                                <option value="Mas">Mas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm flat shift-focus" minlength="3" id="nama_add" name="nama_add" required>
                            <div id="feedback-nama" class="feedback">Nama pelanggan</div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea id="alamat_add" name="alamat_add" class="form-control flat shift-focus" minlength="5" rows="1" required></textarea>
                            <div class="feedback">Alamat pelanggan</div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Member</label>
                        <div class="col-sm-7">
                            <select name="jenis_member_add" id="jenis_member_add" class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Jenis</label>
                        <div class="col-sm-7">
                            <select name="jenis_lembaga_add" id="jenis_lembaga_add" class="custom-select form-control form-control-sm flat shift-focus"  data-valueKey="id" data-displayKey="name" required>
                            </select>
                            <div class="feedback">personal/perusahaan/lembaga</div>
                        </div>
                    </div> 
                    <div class="form-group row mb-0 tampil_add">
                        <label class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm flat shift-focus" id="perusahaan_add" name="perusahaan_add">
                            <div class="feedback">Nama perusahaan/lembaga</div>
                        </div>
                    </div>
                    <div class="form-group row mb-1 tampil_add">
                        <label class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea id="alamat_perusahaan_add" name="alamat_perusahaan_add" class="form-control flat shift-focus" rows="1"></textarea>
                            <div class="feedback">Alamat perusahaan/lembaga</div>
                        </div>
                    </div>
                    <div class="form-group row mb-0 tampil_add">
                        <label class="col-sm-5 col-form-label">Telepon</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm flat shift-focus" id="no_telp_add" name="no_telp_add" value="Personal"><div class="feedback">Telepon perusahaan</div>
                        </div>
                    </div>
                    <div class="form-group row mb-0 tampil_add">
                        <label class="col-sm-5 col-form-label">Tampilkan Data</label>
                        <div class="col-sm-7">
                            <select name="tampil_data" id="tampil_data" class="form-control custom-select form-control-sm pl-1 flat" required>
                                <option value="0" selected>Pribadi</option>
                                <option value="1">Perusahaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label">Referal</label>
                        <div class="col-sm-7">
                            <select name="via_add" id="via_add" class="form-control custom-select form-control-sm pl-1 flat shift-focus" required>
                                <option value="build" selected>langsung</option>
                                <option value="wa">whatsapp</option>
                                <option value="fb">facebook</option>
                                <option value="ig">instagram</option>
                                <option value="tw">twitter</option>
                                <option value="em">email</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label">Boleh Utang</label>
                        <div class="col-sm-7">
                            <select name="status_add" id="status_add" class="form-control custom-select form-control-sm pl-1 flat shift-focus" required>
                                <option value="0" selected>Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label">Max Ngutang</label>
                        <div class="col-sm-7">
                            <div class="input-group input-group-sm">
                                <input type="number" min='0' class="form-control form-control-sm flat shift-focus" id="max_u_add" name="max_u_add" value="0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kali</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save-cari">Simpan</button>
                <button type="button" class="btn btn-danger tutup-con" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-edit-konsumen" class="modal left fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content flat">
            <form role="form" id="form-edit-k" method="post">
                <div class="modal-header py-1">
                    <h4 class="modal-title">Edit Pelanggan</h4>
                    <button type="button" class="close tutup-con" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="error_input"></span>
                    <div class="form-group row mb-0">
                        <label for="telepon_edit" class="col-sm-5 col-form-label">pelanggan</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <input class="form-control phone form-control-sm" id="telepon_edit" name="telepon_edit" autofocus="" required>
                                <input type="hidden" class="form-control" id="id_edit" name="id_edit" >
                            </div>
                            <div id="feedback-telp" class="feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Panggilan</label>
                        <div class="col-sm-7">
                            <select name="panggilan_edit" id="panggilan_edit" class="form-control custom-select pl-1"
                            required>
                                <option value="" selected></option>
                                <option value="Bpk">Bpk</option>
                                <option value="Ibu">Ibu</option>
                                <option value="Mba">Mba</option>
                                <option value="Mas">Mas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm" id="nama_edit" name="nama_edit" autofocus="autofocus" required>
                            <div id="feedback-nama" class="feedback">Nama pelanggan</div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea id="alamat_edit" name="alamat_edit" class="form-control" rows="1" required></textarea>
                            <div id="feedback-alamat" class="feedback">Alamat pelanggan</div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Member</label>
                        <div class="col-sm-7">
                            <select name="jenis_member_edit" id="jenis_member_edit" class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Jenis</label>
                        <div class="col-sm-7">
                            <select name="jenis_lembaga_edit" id="jenis_lembaga_edit" class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
                            </select>
                            <div id="feedback-jenis" class="feedback">personal/perusahaan/lembaga</div>
                        </div>
                    </div> 
                    <div class="form-group row mb-0 tampil_lembaga">
                        <label class="col-sm-5 col-form-label">Nama</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm" id="nama_perusahaan_edit" name="nama_perusahaan_edit" value="Personal">
                            <div id="feedback-nama-perusahaan" class="feedback">Nama perusahaan/lembaga</div>
                        </div>
                    </div>
                    <div class="form-group row mb-1 tampil_lembaga">
                        <label class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea id="alamat_perusahaan_edit" name="alamat_perusahaan_edit" class="form-control" rows="1"></textarea>
                            <div id="feedback-alamat-perusahaan" class="feedback">Alamat perusahaan/lembaga</div>
                        </div>
                    </div>
                    <div class="form-group row mb-0 tampil_lembaga">
                        <label class="col-sm-5 col-form-label">No. Telepon</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm" id="no_telp_edit" name="no_telp_edit" value="Personal">
                        </div>
                    </div>
                    <div class="form-group row mb-1 tampil_lembaga">
                        <label class="col-sm-5 col-form-label">Tampilkan Data</label>
                        <div class="col-sm-7">
                            <select name="tampil_edit" id="tampil_edit" class="form-control custom-select form-control-sm pl-1 flat" required>
                                <option value="0" selected>Pribadi</option>
                                <option value="1">Perusahaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Referal</label>
                        <div class="col-sm-7">
                            <select name="via_edit" id="via_edit" class="form-control custom-select form-control-sm pl-1" required>
                                <option value="build" selected>langsung</option>
                                <option value="wa">whatsapp</option>
                                <option value="fb">facebook</option>
                                <option value="ig">instagram</option>
                                <option value="tw">twitter</option>
                                <option value="em">email</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Boleh Utang</label>
                        <div class="col-sm-7">
                            <select name="status_edit" id="status_edit" class="form-control custom-select form-control-sm pl-1" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Max Ngutang</label>
                        <div class="col-sm-7">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-sm" id="max_u" name="max_u">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kali</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-danger tutup-con" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- cetak invoice -->
<div class="modal fade modal-fullscreen-xl" id="print-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-2 flat">
                <h4 class="modal-title">Cetak Invoice #<span class="cetak_invoice"></span> <span class="invoice_print_url"></span>&nbsp;&nbsp;<span class="print_url"></span></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body p-0 scrollbar-inner">
                <div id="loading" class="text-center" style="">
                    <img src="<?=base_url('assets/img/ajax-loader.gif');?>" alt="" />
                    &nbsp;&nbsp;Sedang memuat INVOICE ORDER #<span class="cetak_invoice"></span>
                </div>
                <div id="error">Load Timeout Klik disini&nbsp;&nbsp;<span class="invoice_print_url"></span>&nbsp;&nbsp;<span class="print_url"></span></div>
                <div class="load-pdf"></div>
            </div>
        </div>
    </div>
</div>

<!-- bayar invoice -->
<div class="modal fade" id="pembayaran-5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" id="saving-bayar">
        <div class="modal-content flat">
            <div class="modal-header py-1">
                <h4 class="modal-title">BAYAR INVOICE #<span class="tinvoice"></span></h4>
            </div>
            <div class="modal-body pb-0">
                <div class="form-group row mb-0">
                    <label  class="col-4 col-form-label"> 
                        <div class="input-group">
                            BAYAR&nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Bayar1" name="Bayar" class="custom-control-input Bayar" value="1" checked>
                                <label class="custom-control-label" for="Bayar1"> FULL&nbsp;&nbsp;</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Bayar2" name="Bayar" class="custom-control-input Bayar" value="2" >
                                <label class="custom-control-label" for="Bayar2">SEBAGIAN</label>
                            </div>
                        </div>
                    </label> 
                    <div class="col-8">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="id_byr">CARA BAYAR</span>
                            </div>
                            <select name="id_byr" id="id_byr" onchange="sumawal()" class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="rekening">REKENING</span>
                            </div>
                            <select name="rekening" id="rekening" class="custom-select form-control form-control-sm rekening" disabled>
                            </select>
                        </div>
                    </div>
                </div> 
                <div class="form-group row mb-0 lampiran">
                    <label for="lampiran" class="col-4 col-form-label">Bukti Transfer</label> 
                    <div class="col-8">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary preview p-0 flat" id="preview" >
                                    <img class="img-preview mklbItem" id="imageresource" src="<?=base_url('assets/img/bone.jpg');?>"  data-toggle='tooltip' title="Preview bukti transfer" style="width: 30px; height: 30px; object-fit: cover;">
                                </button>
                            </div>
                            <div class="custom-file form-control-sm">
                                <input class="custom-file-input" name='lampiran' id="lampiran" type="file" accept="image/*">
                                <label class="custom-file-label" for="lampiran">Format file jpeg | jpg | png | webp</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <label for="pajak" class="col-4 col-form-label">PPN | Total Pajak</label> 
                    <div class="col-4">
                        <div class="input-group">
                            <input id="pajak" name="pajak" value="0" type="text" onchange="inputan()" class="form-control form-control-sm"> 
                            <div class="input-group-append">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-sm flat pajakd" id="pajakd">% INPUT PAJAK</button>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <button style="display:none" type="button" onclick="savpajak();" class="btn btn-success btn-sm flat savpajak" id="savpajak" data-toggle='tooltip' title="Simpan Pajak"><i class="fa fa-save"></i></button>
                                        <button style="display:none" type="button" onclick="batal();" class="btn btn-danger btn-sm batal" id="batal"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input id="sumpajak" name="sumpajak" type="text" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row mb-0">
                    <label for="sisabayar" class="col-4 col-form-label">TOTAL ORDER</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="sisabayar" name="sisabayar" type="text" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div> 
                <div class="form-group row mb-0">
                    <label for="totalbyr" class="col-4 col-form-label">SISA</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="totalbyr" name="totalbyr" type="text" value="0" class="form-control form-control-sm" readonly>
                            <input id="total_bayar" name="total_bayar" type="hidden" value="0" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div> 
                <div class="form-group row mb-0 p-0 flat">
                    <label for="nominal" class="col-4 col-form-label">NOMINAL</label> 
                    <div class="col-8">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary btn-sm flat n-bayar" data-id="50000">50.000</button>
                            <button class="btn btn-secondary btn-sm flat n-bayar" data-id="100000">100.000</button>
                            <button class="btn btn-success btn-sm flat n-bayar" data-id="200000">200.000</button>
                            <button class="btn btn-info btn-sm flat n-bayar" data-id="300000">300.000</button>
                            <button class="btn btn-warning btn-sm flat n-bayar" data-id="400000">400.000</button>
                            <button class="btn btn-danger btn-sm flat n-bayar" data-id="500000">500.000</button>
                            <button type="button" onclick="lunasd();" class="btn btn-dark btn-sm flat lunasd">UANGPAS</button>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0 flat">
                    <label for="uangm" class="col-4 col-form-label">JUMLAH BAYAR</label> 
                    <div class="col-8">
                        <div class="input-group flat">
                            <input id="uangm" name="uangm" type="text" onchange="inputan()" onkeyup="kembalian()" class="form-control form-control-sm input"> 
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0 mt-0">
                    <label for="kembalian" class="col-4 col-form-label">KEMBALIAN</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="kembalian" name="kembalian" type="text" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div> 
                
                <div class="form-group row">
                    <div class="col-12 load-bayar"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary flat bayar_l" id="bayar_l" disabled>SIMPAN</button>
                <button type="button" class="btn btn-danger flat" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

<!-- bayar invoice -->
<div class="modal fade" id="pembayaran-sisa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" id="saving-bayar">
        <div class="modal-content flat">
            <div class="modal-header py-1">
                <h4 class="modal-title">BAYAR INVOICE #<span class="tinvoice-1"></span></h4>
            </div>
            <div class="modal-body pb-0">
                <div class="form-group row mb-0">
                    <label  class="col-4 col-form-label"> 
                        <div class="input-group">
                            BAYAR&nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Bayar1-1" name="Bayar" class="custom-control-input Bayar" value="1" checked>
                                <label class="custom-control-label" for="Bayar1-1"> FULL&nbsp;&nbsp;</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Bayar2-1" name="Bayar" class="custom-control-input Bayar" value="2" >
                                <label class="custom-control-label" for="Bayar2-1">SEBAGIAN</label>
                            </div>
                        </div>
                    </label> 
                    <div class="col-8">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="id_byr-1">CARA BAYAR</span>
                            </div>
                            <select name="id_byr" id="id_byr-1"  class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="rekening-1">REKENING</span>
                            </div>
                            <select name="rekening" id="rekening-1" class="custom-select form-control form-control-sm rekening-1" disabled>
                            </select>
                        </div>
                    </div>
                </div> 
                <div class="form-group row mb-0 lampiran-1">
                    <label for="lampiran-1" class="col-4 col-form-label">Bukti Transfer</label> 
                    <div class="col-8">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary preview p-0 flat" id="preview-1" >
                                    <img class="img-preview mklbItem-1" id="imageresource-1" src="<?=base_url('assets/img/bone.jpg');?>"  data-toggle='tooltip' title="Preview bukti transfer" style="width: 30px; height: 30px; object-fit: cover;">
                                </button>
                            </div>
                            <div class="custom-file form-control-sm">
                                <input class="custom-file-input" name='lampiran' id="lampiran-1" type="file" accept="image/*">
                                <label class="custom-file-label" for="lampiran-1">Format file jpeg | jpg | png | webp</label>
                            </div>
                        </div>
                    </div>
                </div>
                 
                <div class="form-group row mb-0">
                    <label for="sisabayar-1" class="col-4 col-form-label">TOTAL ORDER</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="sisabayar-1" name="sisabayar" type="text" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div> 
                <div class="form-group row mb-0">
                    <label for="totalbyr-1" class="col-4 col-form-label">SISA</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="totalbyr-1" name="totalbyr" type="text" value="0" class="form-control form-control-sm" readonly>
                            <input id="total_bayar-1" name="total_bayar" type="hidden" value="0" class="form-control form-control-sm" readonly>
                            <input id="id_invoice_bayar" name="no_invoice" type="hidden" value="0" class="form-control form-control-sm" readonly>
                            <input id="type_bayar-1" name="type_bayar" type="hidden" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div> 
                <div class="form-group row mb-0 p-0 flat">
                    <label for="nominal" class="col-4 col-form-label">NOMINAL</label> 
                    <div class="col-8">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-primary btn-sm flat n-bayar-1" data-id="50000">50.000</button>
                            <button class="btn btn-secondary btn-sm flat n-bayar-1" data-id="100000">100.000</button>
                            <button class="btn btn-success btn-sm flat n-bayar-1" data-id="200000">200.000</button>
                            <button class="btn btn-info btn-sm flat n-bayar-1" data-id="300000">300.000</button>
                            <button class="btn btn-warning btn-sm flat n-bayar-1" data-id="400000">400.000</button>
                            <button class="btn btn-danger btn-sm flat n-bayar-1" data-id="500000">500.000</button>
                            <button type="button" onclick="lunas_1();" class="btn btn-dark btn-sm flat lunas-1">UANGPAS</button>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0 flat">
                    <label for="uangm-1" class="col-4 col-form-label">JUMLAH BAYAR</label> 
                    <div class="col-8">
                        <div class="input-group flat">
                            <input id="uangm-1" name="uangm" type="text" onchange="inputan_1()" onkeyup="formatNumber(this);kembalian_1()" class="form-control form-control-sm input"> 
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0 mt-0">
                    <label for="kembalian-1" class="col-4 col-form-label">KEMBALIAN</label> 
                    <div class="col-8">
                        <div class="input-group">
                            <input id="kembalian-1" name="kembalian" type="text" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div> 
                
                <div class="form-group row">
                    <div class="col-12 load-bayar-sisa"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary flat bayar_kan" id="bayar_kan" disabled>SIMPAN</button>
                <button type="button" class="btn btn-danger flat" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="DetailCart" tabindex="-1" aria-labelledby="DetailCart" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content flat">
            <form role="form" id="form-finishing">
                <div class="modal-header">
                    <h4 class="modal-title title-finishing">Finishing</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="finishing"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm tutup-cari flat"
                    data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="cetaksimpan" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content flat">
            <div class="modal-header py-1">
                <h3 class="modal-title">Cetak & Simpan data?</h3>
            </div>
            <div class="modal-body">
                <div class="form-group text-center">
                    <!-- Cetak dan Posting data-->
                    <p>Anda akan mencetak dan menyimpan data. 
                    <br>Pastikan data yang anda masukan sudah benar.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success okprint" type="button" id="print">Ya</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

<div id="modal-batal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content flat">
            <form role="form" id="form-batal" method="post">
                <div class="modal-header py-1">
                    <h4 class="modal-title">Batal Order</h4>
                    <button type="button" class="close tutup-con" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="error_input"></span>
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">NO. ORDER</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" id="notrx" name="notrx" readonly="readonly" >
                                <input type="hidden" class="form-control form-control-sm" id="no_order" name="no_order" readonly="readonly" >
                                <input type="hidden" class="form-control form-control-sm" id="mod_batal" name="mod_batal" readonly="readonly" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">NOMINAL</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input class="form-control form-control-sm" id="total_batal" name="total_batal" readonly="readonly" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">BAYAR VIA</label>
                        <div class="col-sm-9">
                            <select name="id_byrbatal" id="id_byrbatal" class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">REKENING</label>
                        <div class="col-sm-9">
                            <select name="rekening_bayar" id="rekening_bayar" class="custom-select form-control form-control-sm rekening" disabled>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">DARI KAS</label>
                        <div class="col-sm-9">
                            <select name="sumber_kas_batal" id="sumber_kas_batal" class="custom-select form-control form-control-sm sumber_kas_batal" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">SALDO KAS</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="saldo_kas_batal" name="saldo_kas_batal" readonly="readonly" >
                        </div>
                    </div>
                    
                    <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label">KETERANGAN</label>
                        <div class="col-sm-9">
                            <textarea id="keterangan" name="keterangan" class="form-control"
                            rows="2"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="save-batal">Simpan</button>
                    <button type="button" class="btn btn-danger tutup-con" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="myModalTab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                <div class="tabs active" id="tab01">
                    <h6 class="font-weight-bold">Akses Order</h6>
                </div>
                <div class="tabs" id="tab02">
                    <h6 class="text-muted">Cari Order</h6>
                </div>
                <div class="tabs" id="tab03">
                    <h6 class="text-muted">Manage File, Folder & Desain</h6>
                </div>
                <!--div class="tabs" id="tab04">
                    <h6 class="text-muted">Operator</h6>
                </div-->
            </div>
            <div class="line"></div>
            <div class="modal-body p-0 load-cari">
                <fieldset class="show" id="tab011">
                    <div class="bg-light mt-3">
                        <div class="form-group pb-2 px-3">
                            <div class="input-group">
                                <input type="text" id="keyword_cari" class="form-control bg-light border-1" placeholder="No. Order" aria-label="Search" style="border-color: #3f51b5;" autofocus >
                                <div class="input-group-append">
                                    <button class="btn btn-primary cari_invoice" type="button" id="cari_invoice">
                                        <i class="fa fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="hasil_cari"></div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="tab021">
                    <div class="bg-light mt-3">
                        <div class="form-group pb-2 px-3">
                            <div class="input-group">
                                <input type="text" id="cari_order" class="form-control bg-light border-1" placeholder="No. Order | No. HP | Nama " aria-label="Search" autofocus >
                                <div class="input-group-append">
                                    <button class="btn btn-info cari_order" type="button" id="cari_invoice_order" disabled><i class="fa fa-search fa-sm"></i></button>
                                </div>
                            </div>
                            
                            <div class="mt-2" id="hasil_cari_order"></div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="tab031">
                    <div class="bg-light">
                        <form class="mt-3" id="form-desain">
                            <div class="form-group pb-2 px-3">
                                <div class="input-group">
                                    <input type="text" id="cari_desain" class="form-control bg-light border-1" placeholder="No. Order" aria-label="Search" autofocus >
                                    <div class="input-group-append">
                                        <button class="btn btn-success cari_desain" type="button" id="cari_invoice_desain" onclick="cariDesain()">
                                            <i class="fa fa-search fa-sm"></i>
                                        </button>
                                        <button class="btn btn-info updateDesain" type="button" id="updateDesain">
                                            Update Desain
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group mt-3 mb-2">
                                    <label for="exampleFormControlInput1">Nama Folder</label>
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Link Folder</span>
                                        </div>
                                        <input type="text" class="form-control" id="link_folder" name="link_folder" readonly>
                                        <input type="hidden" class="form-control" id="link_folder_hide" name="link_folder_hide" readonly>
                                        <div class="input-group-append">
                                            <button data-clipboard-action="copy" data-clipboard-target="#link_folder" class="btn btn-outline-secondary cbtn" type="button">Copy</button>
                                            <button class="btn btn-primary cek_folder" type="button">Cek & Buat Folder</button>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Nama Pelanggan</span>
                                        </div>
                                        <input type="text" class="form-control" id="link_pelanggan" name="link_pelanggan" readonly>
                                        <div class="input-group-append">
                                            <button data-clipboard-target="#link_pelanggan" class="btn btn-outline-secondary cbtn" type="button">Copy</button>
                                            <button class="btn btn-primary buka_folder" type="button">Buka Folder</button>
                                        </div>
                                    </div>
                                    
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Nama Save File</span>
                                        </div>
                                        <input type="text" class="form-control" id="saved_file" name="saved_file" readonly>
                                        <div class="input-group-append">
                                            <button data-clipboard-target="#saved_file" class="btn btn-outline-secondary cbtn" type="button">Copy</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3 mb-2">
                                    <label for="exampleFormControlInput1">Nama File Cetak</label>
                                    <div id="detail_cetak"></div>
                                    <p><code>U:Ukuran|Q:QTY|B:Bahan|P:Produk|K:Keterangan|TGL:Tgl. Ambil|FO:Kasir</code></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>
                <fieldset id="tab041">
                    <div class="bg-light mt-3">
                        <div class="form-group pb-2 px-3">
                            <div class="input-group">
                                <input type="text" id="cari_operator" class="form-control bg-light border-1" placeholder="No. Order" aria-label="Search" autofocus >
                                <div class="input-group-append">
                                    <button class="btn btn-warning cari_operator" type="button" id="cari_invoice_operator">
                                        <i class="fa fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <h5 class="text-center mb-4 mt-0 pt-4">Cari Operator Dalam pengembangan</h5>
                            <div id="hasil_cari_operator"></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="line"></div>
            <div class="modal-footer">
                <div id="tab01_">
                    <button type="button" class="btn btn-primary save_cari" >Simpan</button>
                </div>
                <div id="tab02_" class="display-none">
                    
                </div>
                <div id="tab03_" class="display-none">
                    
                </div>
                <div id="tab04_" class="display-none">
                    <button type="button" class="btn btn-warning save_cari4" >Simpan</button>
                </div>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<style>
    iframe,#error {
    display: none;
    }
    
    #error {
    height: 100%;
    justify-content: center;
    align-items: center;
    }
    .error {
    color: #5a5c69;
    font-size: 8px;
    position: relative;
    line-height: 1;
    width: 12.5rem;
    }
    .custom-select.form-control-sm {
    height: calc(1.5em + .5rem + 2px);
    padding: .25rem .5rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;
    }
    .feedback{font-size:8pt}
</style>