<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data rekap pendapatan & pengeluaran</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data rekap</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
						</div>
						<select id="sortBy" class="form-control custom-select" onchange="searchRekap()" style="width:10px!important;padding-right:0!important">
							<option value="ASC">ASC</option>
							<option value="DESC">DESC</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control custom-select" onchange="searchRekap()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
						</select>
						<div class="input-group-append">
							<span class="input-group-text">Pengguna</span>
						</div>
						<select name="user" id="user"  class="custom-select" onchange="searchRekap()">
							<option value="" style="font-weight:bold;border-bottom:1px solid #ddd;" selected>PILIH</option>
							<?php  
								foreach ($pilihan AS $values){
									if($this->session->level=='admin' OR $this->session->level=='owner'){
										
										echo '<option value="'.$values['id_user'].'">'.$values['nama_lengkap'].'</option>';
										
									}
								}
							?>
						</select>
						<div class="input-group-append">
							<span class="input-group-text">Tanggal</span>
						</div>
						<input type="text" class="form-control datepicker" value="<?=$tgl;?>" name="dari" id="dari">
						<input type="text" class="form-control datepicker" value="<?=$tgl;?>" name="sampai" id="sampai">
						<div class="btn-group" role="group">
							<button type="button"  data-toggle="tooltip" title="Cari data" class="btn btn-success btn-sm" onclick="searchRekap();"><i class="fa fa-search"></i></button>
							<button type="button" data-toggle="tooltip" title="Cetak" data-info="cetak" class="btn btn-warning btn-sm cetak_rekap" data-id="0"><i class="fa fa-print"></i> Cetak</button>
						</div>
					</div>
				</div>
				<div class="post-list" id="dataList">
					<div class="card-body table-responsive">
						<div class="card-block">
							<table class="table table-bordered table-striped table-mailcard" id="jsonuser">
								<thead>
									<tr>
										<th style="width:3%!important" class="text-right">No.</th>
										<th>Tanggal</th>
										<th>Uraian</th>
										<th class="text-right">Debit</th>
										<th class="text-right">Kredit</th>
										<th class="text-right">Saldo</th>
									</tr>
								</thead>
								<tbody>
									<?php
										// print_r($result);
										$debet=0;$kredit=0;$saldo=0;$tdebet=0;$tkredit=0;$tsaldo=0;
										if(!empty($result)){
											$no=1;
											foreach($result AS $row){ 
												$debet = $row['debet'];
												$kredit = $row['kredit'];
												$tdebet += $debet;
												$tkredit +=  $kredit;
												$tsaldo +=  $debet - $kredit;
												if($debet>0){
													$saldo = $saldo + $row['debet'];			
													}else{
													$saldo = $saldo - $row['kredit'];
												}
												if($row['jenis']==1){
													$uraian = 'Pendapatan';
													}elseif($row['jenis']==2){
													$uraian = 'Kas kecil';
													}else{
													$uraian = 'Pengeluaran';
												}
												echo "<tr><td>$no</td>";
												echo "<td>".dtimes($row['create_date'],false,false)."</td>";
												echo "<td>$uraian</td>";
												echo "<td class='text-right'>".rp($debet)."</td>";
												echo "<td class='text-right'>".rp($kredit)."</td>";
												echo "<td class='text-right'>".rp($saldo)."</td></tr>";
											$no++; }
										}
									?>
									<tr>
										<td colspan="3"><strong>Total</strong></td>
										<td class='text-right'><strong><?=rp($tdebet);?></strong></td>
										<td class='text-right'><strong><?=rp($tkredit);?></strong></td>
										<td class='text-right'><strong><?=rp($tsaldo);?></strong></td>
									</tr>
								</tbody>
							</table>
							<nav aria-label="Page navigation" class="mt-2">
								<?php echo $this->ajax_pagination->create_links(); ?>
							</nav>
						</div><!-- /.card -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form id="form_rekap" method="POST" target="_blank" action="<?=base_url();?>pembukuan/cetak_rekap">
	<input type="hidden" name="id_user" id="id_user">
	<input type="hidden" name="tgl_dari" id="tgl_dari">
	<input type="hidden" name="tgl_sampai" id="tgl_sampai">
	<input type="hidden" name="cetak" value="cetak">
</form>

<div class="modal fade" id="modalKas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Input Kas Kecil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
				</button>
			</div>
            <div class="modal-body">
                <form id="formKode" method="POST">
                    <input type="hidden" class="form-control" id="kode" name="kode">
                    <div class="form-group">
						<div class="input-group input-group-sm mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Max. Saldo Kas Kecil</span>
							</div>
							<input type="text" value="" class="form-control inputs" id="kaskecil" readonly>
							<div class="input-group-append">
								<a href="<?=base_url('kas/pengaturan');?>" data-toggle="tooltip" title="Edit max saldo" class="btn btn-primary"><i class="fa fa-edit"></i></a>
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group input-groups">
								<span class="input-group-prepend">
									<span class="input-group-text bg-warning text-white">Saldo tersimpan</span>
								</span>
								<input type="text" class="form-control inputs" id="saldo" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group input-groups">
								<span class="input-group-prepend">
									<span class="input-group-text bg-success text-white">Nominal</span>
								</span>
								<input type="text" class="form-control inputs" id="total">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" id="simpan-kas">Simpan Kas</button>
				</div>
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
	padding: 3px;
	background:#f7f7f7;
	}
	.card .table td, .card .table th {
	padding-right: 5px;
	padding-left: 5px;
	background:#f7f7f7
	}
	.form-control {
	height: 30px;
	padding: 2px 10px;
	}
	button, input, select, textarea {
	font-family: inherit;
	font-size: inherit;
	line-height: inherit;
	}
	.input-group-text {
	padding:0 5px!important;
	margin-bottom: 0;
	}
</style>
<script>
	$('.datepicker').datepicker({clearBtn: true,format: "dd/mm/yyyy"});
	// searchRekap();
	$(document).on('click','.cetak_rekap',function(e){
		e.preventDefault();
		var info = $(this).attr('data-info');
		var id_user = $("#user").val();
		if(id_user==''){
			sweet('Peringatan!!!','Maaf pengguna harus dipilih','warning','warning');
			return;
		}
		$("#id_user").val(id_user);
		var dari = $("#dari").val();
		$("#tgl_dari").val(dari);
		var sampai = $("#sampai").val();
		$("#tgl_sampai").val(sampai);
		if(dari=='' || sampai ==''){
			sweet('Peringatan!!!','Maaf tanggal harus dipilih','warning','warning');
			return;
		}
		$( "#form_rekap" ).submit();
		
	});
	
	$(document).on('click','.tambah_kas',function(e){
		e.preventDefault();
		var info = $(this).attr('data-info');
		var id = $(this).attr('data-id');
		
		$("#myModalLabel").html("Input Kas Kecil");
		$.ajax({
			type: "POST",
			url: base_url+"pembukuan/load_kas",
			data: {id:id,info:info},
			beforeSend: function () {
				// $('.se-pre-con').fadeIn();
			},
			success: function(res) {
				$("#modalKas").modal("show");
				var kaskecil = formatMoney(res.nominal, 0, "Rp.");
				$('#kaskecil').val(kaskecil);
				var saldo = formatMoney(res.saldo, 0, "Rp.");
				if(res.saldo < res.nominal){
					var total = parseInt(res.nominal) - parseInt(res.saldo);
					}else{
					// saldo = saldo;
					// $('#total').attr("readonly",true);
					total = 0;
				}
				console.log(saldo)
				console.log(total)
				$('#saldo').val(saldo);
				$('#total').val(total);
				// $('.se-pre-con').fadeOut("slow");
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	});
	
	
	$(document).on('click','#simpan-kas',function(e){
		e.preventDefault();
		var info = $(this).attr('data-info');
		var total = $("#total").val();
		if(total=='' || total==0){
			sweet('Peringatan!!!','Maaf nominal masih kosong','warning','warning');
			return;
		}
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url("pembukuan/simpan_kas"); ?>',
			data:{total:total},
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(data){
				if(data.status==200)
				{
					sweet('Notif!!!',data.msg,'success','success');
					}else{
					sweet('Notif!!!',data.msg,'warning','warning');
				}
				searchRekap();
				$('.loading').fadeOut("slow");
				$("#modalKas").modal("hide");
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	});
	
	$('.datepicker').datepicker({clearBtn: true,format: "dd/mm/yyyy"});
	function searchRekap(page_num){
		page_num = page_num?page_num:0;
		// var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		var user = $('#user').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url("ajax/ajaxRekap/"); ?>'+page_num,
			data:{page:page_num,sortBy:sortBy,limits:limits,dari:dari,sampai:sampai,id_kasir:user},
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(html){
				$('#dataList').html(html);
				$('.loading').fadeOut("slow");
			}
		});
	}
</script>																							