<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Detail Order Konsumen</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('konsumen');?>">Pelanggan</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail Order Pelanggan</li>
        </ol>
    </div>
    <div class="card">
		<div class="row">
			<div class="col-md-12">
				<div class="card-header pb-0">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
                        </div>
						<select id="sortBy" class="form-control custom-select w-5" onchange="FilterKonsumen()">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
                        </select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
                        </div>
						<select id="limits" name="limits" class="form-control custom-select" onchange="FilterKonsumen()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
                        </select>
						<input type="text" id="keywords" class="form-control" placeholder="Cari data" onkeyup="FilterKonsumen();"/>
                        <div class="input-group-prepend">
                            <button type="button" data-member="<?=$member;?>" data-jenis="<?=$jenis;?>"  data-id="<?php echo encrypt_url($id); ?>" class="btn btn-warning edit_konsumen_detail">
                                <i class="fa fa-fw fa-user"></i> Detail
                            </button>
                        </div>
                    </div>
                </div>
                <div class="post-list pt-0" id="dataKonsumen">
                    <div class="card-body table-responsive">
						<div class="card-block">
                            <table class="table">
                                <?php 
                                    $omset_ppajak=0;
                                    $t_omset=0;
                                    $t_detail=0;
                                    $sisa=0;
                                    $t_omset_a=0;
                                    $t_bayar=0;
                                    $t_piutang=0;
                                    if(!empty($result)) {
                                        $no=1;
                                        foreach($result AS $row){
                                            $bayar = "SELECT 
                                            `bayar_invoice_detail`.`id_invoice`,
                                            SUM(`bayar_invoice_detail`.`jml_bayar`) AS `bayar`
                                            FROM
                                            `bayar_invoice_detail`
                                            WHERE
                                            `bayar_invoice_detail`.`id_invoice` = '$row[id_invoice]'
                                            GROUP BY
                                            `bayar_invoice_detail`.`id_invoice`";
                                            $rowb= $this->db->query($bayar)->row_array();
                                            if (isset($rowb)){
                                                $_bayar = $rowb['bayar'];
                                                }else{
                                                $_bayar = 0;
                                            }
                                            $omset_ppajak = $row['total_bayar'] + ($row['total_bayar'] * $row['pajak']/100);
                                            
                                            $sisa = $omset_ppajak - $_bayar;
                                            $t_omset_a += $omset_ppajak;
                                            $t_bayar += $row['total_bayar'];
                                            $t_piutang += $sisa;
                                            
                                            $detail = "SELECT 
                                            `jenis_cetakan`.`jenis_cetakan` AS nama_jenis,
                                            `invoice_detail`.`id_invoice`,
                                            `invoice_detail`.`id_produk`,
                                            `invoice_detail`.`jenis_cetakan`,
                                            `invoice_detail`.`keterangan`,
                                            `invoice_detail`.`jumlah`,
                                            `invoice_detail`.`harga`,
                                            `invoice_detail`.`diskon`,
                                            `invoice_detail`.`satuan`,
                                            `invoice_detail`.`ukuran`,
                                            `invoice_detail`.`id_bahan`
                                            FROM
                                            `invoice_detail`
                                            INNER JOIN `jenis_cetakan` ON (`invoice_detail`.`jenis_cetakan` = `jenis_cetakan`.`id_jenis`)
                                            WHERE id_invoice='$row[id_invoice]'";
                                            if($row["oto"]==0){
												$status = 'Buka';
												$view = 'edit';
												}elseif($row["oto"]==1){
												$status = 'Edit Order';
												$view = 'edit';
												}elseif($row["oto"]==2){
												$status = 'Hapus Pembayaran';
												$view = 'view';
												}elseif($row["oto"]==3){
												$status = 'Edit Order Lunas';
												$view = 'edit';
												}elseif($row["oto"]==4){
												$status = 'Pending';
												$view = 'view';
												}elseif($row["oto"]==5){
												$status = 'Batal';
												$view = 'view';
												}else{
												$status = 'Kunci';
												$view = 'view';
                                            }
                                            // $datas= $this->db->query($detail)->result();
                                            $_data= $this->db->query($detail);
                                        ?>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width:1%!important" class="pr-0">No.Order</th>
                                                <th class="text-right pl-0 pr-0">Tanggal_order</th>
                                                <th class="text-right">Order</th>
                                                <th class="text-left">Pajak</th>
                                                <th class="text-right">Total_Beli</th>
                                                <th class="text-left">Total_Bayar</th>
                                                <th class="text-right">Piutang</th>
                                                <th class="text-left">Kasir</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td><button data-id="<?php echo $row["id_invoice"]; ?>" data-modEdit="<?=$view;?>" id="cart" class="btn btn-info btn-sm flat cek_transaksi">#<?php echo $row["id_transaksi"]; ?></button></td>
                                            
                                            <td class="text-right pl-0 pr-0"><?=dtimes($row['tgl_trx'],false,false);?></td>
                                            <td class="text-right"><?=RP($row['total_bayar']);?></td>
                                            <td><?=$row['pajak'];?>%</td>
                                            <td class="text-right"><?=rp($omset_ppajak);?></td>
                                            <td class="text-left"><?=rp($_bayar);?></td>
                                            <td class="text-right"><?=rp($sisa);?></td>
                                            <td><?=$row['nama_lengkap'];?></td>
                                        </tr> 
                                        <thead class="thead-light">
                                            <th>Jumlah</th>
                                            <th class="text-right pl-0 pr-0">Harga</th>
                                            <th class="text-right">Sub total</th>
                                            <th class="text-left">Diskon</th>
                                            <th class="text-right ">Harga_beli</th>
                                            <th>Keterangan</th>
                                            <th class="text-left">&nbsp;</th>
                                            <th class="text-left">Jenis</th>
                                        </tr>
                                        <?php 
                                            
                                            foreach($_data->result_array() AS $val){ 
                                                $t_detail = $val['jumlah']*$val['harga'];
                                                $t_omset = ($val['jumlah']*$val['harga']) - ($val['jumlah']*$val['harga'] * $val['diskon']/100);
                                                // $t_omset_a += ($val['jumlah']*$val['harga']) - ($val['jumlah']*$val['harga'] * $val['diskon']/100);
                                            ?>
                                            <tr>
                                                <td class="text-left"><?=$val['jumlah'];?></td>
                                                <td class="text-right pl-0 pr-0"><?=rp($val['harga']);?></td>
                                                <td class="text-right"><?=rp($t_detail);?></td>
                                                <td><?=$val['diskon'];?>%</td>
                                                <td class="text-right"><?=rp($t_omset);?></td>
                                                <td><?=$val['keterangan'];?></td>
                                                <td class="text-left"></td>
                                                <td><?=$val['nama_jenis'];?></td>
                                            </tr> 
                                            
                                            <?php }
                                        }
                                    }else{ ?>
                                    <tr><th colspan="9">Data belum ada</th></tr> 
                                <?php }?>
                                <tfoot>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th class="text-right"><?=rp($t_omset_a);?></th>
                                        <th class="text-left"><?=rp($t_bayar);?></th>
                                        <th class="text-right"><?=rp($t_piutang);?></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <nav aria-label="Page navigation example">
                            <?php echo $this->ajax_pagination->create_links(); ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>        
    </div>            
</div>         

<div id="edit-konsumen-detail" class="modal left fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content flat">
            <form role="form" id="form-edit-detail" method="post">
                <div class="modal-header bg-danger py-1 flat">
                    <h4 class="modal-title text-light">Edit Pelanggan</h4>
                </div>
                <div class="modal-body">
                    <span id="error_input"></span>
                    <div class="form-group row mb-0">
                        <label class="col-sm-5 col-form-label">Tlp. pelanggan</label>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <input class="form-control phone form-control-sm" id="telepon_edit" name="telepon_edit" autofocus="" required>
                                <input type="hidden" class="form-control" id="id_edit" name="id_edit" >
                            </div>
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
                        <label class="col-sm-5 col-form-label">Nama pelanggan</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm" id="nama_edit" name="nama_edit" autofocus="autofocus" required>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-5 col-form-label">Alamat pelanggan</label>
                        <div class="col-sm-7">
                            <textarea id="alamat_edit" name="alamat_edit" class="form-control" rows="1" required></textarea>
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
                        </div>
                    </div> 
                    <div class="form-group row mb-0 tampil_lembaga">
                        <label class="col-sm-5 col-form-label">Nama perusahaan</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm" id="nama_perusahaan_edit" name="nama_perusahaan_edit">
                        </div>
                    </div>
                    <div class="form-group row mb-1 tampil_lembaga">
                        <label class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <textarea id="alamat_perusahaan_edit" name="alamat_perusahaan_edit" class="form-control" rows="1"></textarea>
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
                <div class="right modal-footer p-1">
                    <button type="submit" class="btn btn-success update_data">Update</button>
                    <button type="button" class="btn btn-danger tutup-con" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="idkon" value="<?=$id;?>">
<script>
    $("#status" ).change(function() {
        var id = $("#status").val();
        if(id == 1){
            $("#max_u").prop("readonly", true);
            }else{
            $("#max_u").prop("readonly", false);
        }
    });
    $(document).on('click', '.edit_konsumen_detail', function(e) {
        e.preventDefault();
        
        var dataID = $(this).attr('data-id');
        var jenis = $(this).attr('data-jenis');
        var member = $(this).attr('data-member');
        // console.log(member)
        $.ajax({
            'url': base_url + 'konsumen/cek_konsumen',
            'data': {id: dataID},
            'method': 'POST',
            dataType: 'json',
			beforeSend: function(){
				$('body').loading();
                load_jenis_lembaga('edit',jenis);
                load_jenis_member('edit',member);
            },
            success: function(data) {
                // console.log(data)
                if(level!='admin')
                {
                    $('.update_data').attr('disabled',true);
                }
                
                if(data.jenis>1){
                    $('.tampil_lembaga').show();
                    }else{
                    $('.tampil_lembaga').hide();
                }
                $('#edit-konsumen-detail').modal('show');
                $('#error_piutang').css('display','none');
                $("#id_edit").val(data.id);
                $("#panggilan_edit").val(data.panggilan);
                $("#telepon_edit").val(data.nohp);
                $("#nama_edit").val(data.nama);
                $("#alamat_edit").val(data.alamat1);
                $("#jenis_member_edit").val(data.jenis_member);
                $("#jenis_lembaga_edit").val(data.jenis);
                $("#nama_perusahaan_edit").val(data.perusahaan);
                $("#alamat_perusahaan_edit").val(data.alamat2);
                $("#no_telp_edit").val(data.no_telp);
                $("#via_edit").val(data.via);
                $("#status_edit").val(data.boleh);
                $("#tampil_edit").val(data.tampil);
                $("#max_u").val(data.max);
                $('body').loading('stop');
            },
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
            }
        })
    });
    $("#form-edit-detail").submit(function(e) {
        e.preventDefault();
        var dataform = $("#form-edit-detail").serialize();
        $.ajax({
            url: base_url + "konsumen/update_konsumen",
            type: "post",
            data: dataform,
            dataType: 'json',
			beforeSend: function(){
				$('body').loading();
            },
            success: function(arr) {
                if (arr.status == 200) {
                    $('.edit_konsumen_detail').attr('data-member', arr.idmember);
                    sweet('Update!!!',arr.msg,'success','arr.ok');
                    searchFilterKonsumen();
                    }else{
                    sweet('Peringatan!!!',arr.msg,'warning','warning');
                }
                $('#edit-konsumen-detail').modal('hide');
				$('body').loading('stop');
            },
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
            }
        });
    });
    function FilterKonsumen(page_num){
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limits = $('#limits').val();
        var idkon = $('#idkon').val();
        var urlnya = '<?php echo base_url("konsumen/ajaxDKonsumen/"); ?>'+page_num
        $.ajax({
            type: 'POST',
            url: urlnya,
            data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits,idkon:idkon},
            beforeSend: function(){
                $('.loadings').show();
            },
            success: function(html){
                $('#dataKonsumen').html(html);
                $('.loadings').fadeOut("slow");
            }
        });
    }
</script>    