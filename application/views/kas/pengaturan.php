<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button class="btn btn-success btn-icon-split tambah_kas flat">
					<span class="icon text-white-50" >
						<i class="fa fa-money fa-fw"></i>
					</span>
					<span class="text">Tambah Modal</span>
				</button>
			</div>
			<div class="btn-group" role="group" aria-label="Basic example">
				<button class="btn btn-info btn-icon-split cetak_kas flat">
					<span class="icon text-white-50" >
						<i class="fa fa-edit fa-fw"></i>
					</span>
					<span class="text">Buat Laporan</span>
				</button>
			</div>
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Kas</li>
		</ol>
	</div>
	<div class="row mb-3">
		
        <!-- Kas Kecil -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100 " id="load-kas">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Kas Kecil </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-kecil">0</div>
						</div>
                        <div class="col-auto" >
							<a href="#"><i class="fa fa-fw fa-money fa-2x mdlFire"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
        <!-- Kas Penjulan -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100" id="load-kasp">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Kas Penjualan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-penjualan">0</div>
						</div>
                        <div class="col-auto">
							<a href="#">
							<i class="fa fa-money fa-2x text-success"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Kas di Bank -->
		<div class="col-xl-4 col-md-6 mb-4" >
            <div class="card h-100" id="load-kasb">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Kas Di Bank / Merchant</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 load-bank">0</div>
						</div>
                        <div class="col-auto" data-toggle='tooltip' title="Klik detail">
							<a href="javascript:void(0)" id="detail_bank">
							<i class="fa fa-money fa-2x text-info"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="DetailBank" tabindex="-1" aria-labelledby="DetailBank" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content flat">
            <form role="form" id="form-finishing">
                <div class="modal-header">
                    <h4 class="modal-title title-finishing">Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    <div id="detail-data"></div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm tutup-cari flat"
                    data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalKas" tabindex="-1" aria-labelledby="DetailBank" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content flat">
            <form role="form" id="form-finishing">
                <div class="modal-header">
                    <h4 class="modal-title title-finishing">Tambah Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text" for="sumber_kas">AKUN</span>
						</div>
						<select name="sumber_kas" id="sumber_kas" class="custom-select form-control form-control-sm sumber_kas flat" disabled>
						</select>
					</div>
					<div class="input-group input-group-sm flat mb-2">
						<div class="input-group-prepend bg-info">
							<span class="input-group-text" for="jumlah_modal">JUMLAH</span>
						</div>
						<input type="text" class="form-control form-control-sm flat" id="jumlah_modal" name="jumlah_modal" onkeyup='formatNumber(this)' >
					</div>
					<div class="input-group input-group-sm flat">
						<div class="input-group-prepend bg-info">
							<span class="input-group-text" for="keterangan">KETERANGAN</span>
						</div>
						<input type="text" class="form-control form-control-sm flat" id="keterangan" name="keterangan">
					</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm simpan_modal flat">Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm flat" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="CetakKas" tabindex="-1" aria-labelledby="CetakKas" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content flat">
            <form role="form" id="form-cetak" method="post" action="<?=base_url();?>kas/cetak_laporan" target="_blank">
                <div class="modal-header">
                    <h4 class="modal-title title-finishing">Cetak Laporan Keuangan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    <div class="form-group">
						<label for="title">Periode Bulan</label>
						<input type="text" id="tanggal"  name="tanggal" value="<?=$tanggal;?>" class="form-control date-kas" required />
					</div>
					
				</div>
                <div class="modal-footer">
					<button type="submit" name="submit" class="btn btn-info btn-icon-split flat btn-sm">
						<span class="icon text-white-50" >
							<i class="fa fa-print fa-fw"></i>
						</span>
						<span class="text">Cetak Laporan</span>
					</button>
                    <button type="button" class="btn btn-danger btn-sm tutup-cari flat"
                    data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
	
<script>
	$(document).ready(function() {
		kecil();penjualan();bank();
		$('#load-kas,#load-kasp,#load-kasb').loading( {theme: 'dark'})
	});
	var date2 = new Date();
	$('.date-kas').datepicker({  
		language: 'id',
        format: 'MM yyyy', 
		"endDate": date2,
        autoclose: true,     
        startView: "months", 
		minViewMode: "months",
	});  
	function kecil(){
		$.ajaxQueue({
			url:  base_url+"kas/total_kas_kecil",
			cache: false,
			success: function (data) {
				$('#load-kas').loading('stop')
				$('.load-kecil').html(data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
				$('#load-kas').loading('stop');
			}
		});
	}
	
	function penjualan(){
		$.ajaxQueue({
			url:  base_url+"kas/total_kas_penjualan",
			cache: false,
			success: function (data) {
				$('#load-kasp').loading('stop');
				$('.load-penjualan').html(data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
				$('#load-kasp').loading('stop');
			}
		});
	}
	
	function bank(){
		$.ajaxQueue({
			url:  base_url+"kas/total_kas_bank",
			cache: false,
			success: function (data) {
				$('#load-kasb').loading('stop');
				$('.load-bank').html(data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
				$('#load-kasb').loading('stop');
			}
		});
	}
	$(document).on("click", "#detail_bank", function(event) {
		event.preventDefault();
		$("#DetailBank").modal({
			backdrop : "static",
			keyboard : false
		});
		$.ajax({
			method : "POST",
			url : base_url + "kas/detail_bayar",
			beforeSend : function() {
				// $(".tbayar").loading({zIndex:1060});
			},
			dataType:'html',
			success : function(data) {
				$("#detail-data").html(data)
			},
			error : function(res, status, httpMessage) {
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
				
			}
		});
	});
	
	$(document).on("click", ".cetak_kas", function(event) {
		event.preventDefault();
		$("#CetakKas").modal({
			backdrop : "static",
			keyboard : false
		});
		$.ajax({
			method : "POST",
			url : base_url + "kas/detail_bayar",
			beforeSend : function() {
				// $(".tbayar").loading({zIndex:1060});
			},
			dataType:'html',
			success : function(data) {
				$("#detail-data").html(data)
			},
			error : function(res, status, httpMessage) {
				sweet("Peringatan!!!", httpMessage, "warning", "warning");
				
			}
		});
	});
	
	$(document).on("click", ".tambah_kas", function(event) {
		event.preventDefault();
		$("#ModalKas").modal({
			backdrop : "static",
			keyboard : false
		});
		$.ajax({
			url: base_url + "kas/load_jenis_kas",
			type: 'post',
			data: {type:'cari'},
			dataType: 'json',
			success: function (response) {
				var len = response.length;
				$(".sumber_kas").attr("disabled", false);
				$("#sumber_kas").append("<option value='0'>Pilih</option>");
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					$("#sumber_kas").append("<option value='" + id + "'>" + name + "</option>");
				}
			}
		});
	});
	
	$(document).on("click", ".simpan_modal", function(event) {
		event.preventDefault();
		var akun = $("#sumber_kas").val();
		if(akun==0){
			sweet("Peringatan!!!", 'Akun belum dipilih', "warning", "warning");
			return
		}
		var jumlah = angka($("#jumlah_modal").val());
		if(jumlah=='' || jumlah ==0){
			sweet("Peringatan!!!", 'Jumlah masih kosong', "warning", "warning");
			return
		}
		var keterangan = $("#keterangan").val();
		if(keterangan==''){
			sweet("Peringatan!!!", 'Keterangan masih kosong', "warning", "warning");
			return
		}
		
		$.ajax({
			url: base_url + "kas/simpan_modal",
			type: 'post',
			data: {type:'simpan',akun:akun,jumlah:jumlah,keterangan:keterangan},
			dataType: 'json',
			success: function (response) {
				$("#ModalKas").modal('hide');
				kecil();penjualan();bank();
				$('#load-kas,#load-kasp,#load-kasb').loading( {theme: 'dark'})
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('#load-kas,#load-kasp,#load-kasb').loading('stop')
			}
		});
	});
</script>