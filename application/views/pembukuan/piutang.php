<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Laporan piutang</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Laporan piutang</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="<?=base_url();?>laporan/cetak_piutang" method="post" id="cetak-piutang" target="_blank">
				<div class="card">
					<div class="card-header pb-0">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text">KASIR</span>
							</div>
							<select name="user" id="user" class="form-control custom-select" onchange="search_Piutang()">
								<option value="0">Semua</option>
								<?php  
									foreach ($pilihan AS $values){
										if($this->session->idu==$values['id_user']){
											echo '<option value="'.$values['id_user'].'" selected>'.$values['nama_lengkap'].'</option>';
											}else{
											echo '<option value="'.$values['id_user'].'">'.$values['nama_lengkap'].'</option>';
										}
									}
								?>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text">PERIODE</span>
							</div>
							<input type="text" onchange="search_Piutang()" value="<?=$periode;?>" class="form-control form-control-sm w-5 date-piutang" name="periode" id="periode" autocomplete="off">
							<input type="text" onkeyup="search_Piutang()" class="form-control w-15" name="keywords" id="keywords" placeholder="Cari nomor order">
							<div class="input-group-append">
								<button type="button" data-toggle="tooltip" class="btn btn-danger btn-sm clear" id="clear" data-original-title="Clear"><i class="fa fa-times fa-1x"></i> Clear</button>
								<button type="button" data-info="cari" class="btn btn-success cari_piutang" data-id="0"><i class="fa fa-search"></i> Cari</button>
								<button class="btn btn-info print_pdf_piutang" data-url="piutang" type="button" data-toggle="tooltip" data-original-title="Cetak Piutang" data-placement="left"><i class="fa fa-file-pdf-o"></i> Print</button>
								<button class="btn btn-primary url_doc" data-url="piutang" type="button" data-toggle="tooltip" data-original-title="Dok Piutang" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					<div class="card-body table-responsive">
						<div class="card-block">
							<div id="data_piutang"></div>
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal left fade" id="OpenModalWa" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content flat">
			<div class="modal-header">
				<h4 class="modal-title" id="WaLabel">Kirim Invoice</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<div class="load-data-wa"></div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success kirim_pesan" type="button"><i class="fa fa-send"></i>Kirim</button> 
				<button class="btn btn-danger" data-dismiss="modal" type="button">Batal</button> 
			</div>
		</div>
	</div>
</div>
<style>
	.custom-select {
    display: inline-block;
    width: 100%;
    height: 43px;
    padding: 5px 1.75rem 5px .75rem;
	
	}
	
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 2px;
	
	}
	.card .table td, .card .table th {
    padding-right: 5px;
    padding-left: 5px;
	}
	
	button, input, select, textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
	}
</style>
<script>
	
	$(".kirim_pesan").click(function(e) {
		var dataform = $("#form-wa").serialize();
		$.ajax({
            type: "POST",
            url: base_url+"whatsapp/kirim_pesan",
            dataType: 'json',
            data: dataform,
			cache: false,
            beforeSend: function () {
                $('body').loading();　
			},
            success: handleKirim
			,error: function(xhr, status, error) {
                showNotif('top-right','Simpan data',error,'error');
                $('body').loading('stop');
			}
		});
		
	});
	function handleKirim(data) {
		
		 $('#OpenModalWa').modal('hide'); 
		if(data.status==true){
			showNotif('bottom-right','Simpan data',data.msg.detail,'success');
			}else{
			var number = data.target; 
			var message = encodeURIComponent(data.msg);
			var url_wa = getLinkWhastapp(number,message)
			window.open(url_wa, '_blank');
		}
	}
	
	function getLinkWhastapp(number, message) {
		var url = 'https://wa.me/' 
		+ number 
		+ '?text='
		+ message
		return url
	}
	
	var date2 = new Date();
	$('.date-piutang').datepicker({        
        format: 'M yyyy', 
		"endDate": date2,
        autoclose: true,     
        startView: "months", 
		minViewMode: "months",
	});  
	$(document).ready(function() {
		$(".cari_piutang").trigger('click');
	});
	function search_Piutang(){
		$(".cari_piutang").click();
	}
	$(document).on('click','.cari_piutang',function(e){
		e.preventDefault();
		var info = $(this).attr('data-info');
		var user = $("#user").val();
		var periode = $("#periode").val();
		var keywords = $("#keywords").val();
		
		if(periode==''){
			$("#periode").focus()
			return;
		}
		$.ajax({
			url: base_url + 'pembukuan/cari_piutang',
			data: {user:user,periode:periode,info:info,keywords:keywords},
			method: 'POST',
			beforeSend: function () {
				$('body').loading();
			},
			success: function(data) {
				$("#data_piutang").html(data);
				$("#rekapan").attr('disabled',false);
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
			}
		});
	});
	$(document).on('click','.clear',function(e){
		e.preventDefault();
		$('#user').val(0);
		$('#keywords').val('');
		$(".cari_piutang").click();
	});
	
	$(document).on('click','.print_pdf_piutang',function(e){
		e.preventDefault();
		$("#cetak-piutang").submit();
	});
	
	
</script>			