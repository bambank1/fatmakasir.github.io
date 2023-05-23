<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data pekerjaan</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data pekerjaan</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header pb-2">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
						</div>
						<select id="sortBy" class="form-control form-control-sm custom-select" onchange="search_Operator()">
							<option value="ASC">ASC</option>
							<option value="DESC" selected>DESC</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control form-control-sm custom-select" onchange="search_Operator()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">OPERATOR</span>
						</div>
						<select name="user" id="user" class="form-control form-control-sm custom-select" onchange="search_Operator()">
							<option value="0">Semua</option>
							<?php  
								foreach ($pilihan AS $values){
									echo '<option value="'.$values['id_user'].'">'.$values['nama_lengkap'].'</option>';
								}
							?>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">TANGGAL</span>
						</div>
						<div id="date-omset">
							<div class="input-daterange input-group">
								<input type="text" onchange="search_Operator()"  class="form-control form-control-sm" name="dari" id="dari" value="<?=$dari;?>">
								<input type="text" onchange="search_Operator()"  class="form-control form-control-sm" name="sampai" id="sampai" value="<?=$sampai;?>">
							</div>
						</div>
						<div class="input-group-append">
							<button type="button" data-toggle="tooltip" class="btn btn-danger btn-sm clear" id="clearCari" data-original-title="Clear" onclick="clearSearch('<?=$dari;?>')"><i class="fa fa-times fa-1x"></i> Clear</button>
							<button type="button" data-info="harian" class="btn btn-success btn-sm" data-id="0" onclick="search_Operator()"><i class="fa fa-search"></i> Lihat</button>
							<button class="btn btn-primary url_doc" data-url="lap_rincian" type="button" data-toggle="tooltip" data-original-title="Dok Operator" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
				
				<div class="card-body table-responsive">
					<div class="card-block">
						<!--div id="data_omset"></div-->
						<div class="post-list pt-0" id="dataListOmset">
							<div class="table-responsive-sm">
								<table class="table">
									<tbody>
										<?php 
											if(!empty($posts)) {
												$no=1;
												foreach($posts AS $row){ 
													$bayar = bayar($row['id_invoice']);
													// if($bayar > 0){
													$id_invoice = encrypt_url($row['id_invoice']);
													$url_pdf = base_url().'operator/print_invoice/'.$id_invoice;
													$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><i class="fa fa-file-pdf-o"></i> CETAK PDF</a>';
													$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'") > <i class="fa fa-print"></i> Print </a>';
													$detail = detail_order($row['id_invoice']);
													
												?>
												<thead class="thead-dark">
													<tr>
														<th>No.Order</th>
														<th>Tgl.Order</th>
														<th>Tgl.Selesai</th>
														<th class="text-right">Customer</th>
														<th class="text-right">Kasir</th>
														<th class="text-right">Aksi</th>
													</tr>
												</thead>
												<tr>
													<td><button class="btn btn-info btn-sm flat"><?php echo $row["id_transaksi"]; ?></button></td>
													<td><?=dtimes($row['tgl_trx'],false,false);?></td>
													<td><?=dtimes($row['tgl_ambil'],true,false);?></td>
													<td class="text-right"><?=$row['nama'];?></td>
													<td class="text-right"><span class="badge badge-success flat"><?=$row['kasir'];?></span></td>
													<td class="text-right"><div class="btn-group dropleft">
														<button type="button" class="btn btn-danger btn-sm customs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-print"></i> Cetak SPK
														</button>
														<div class="dropdown-menu">
															<?=$pdf;?>
															<?=$print;?>
														</div>
													</div></td>
												</tr> 
												<thead class="thead-light">
													<tr> 
														<th>QTY</th>
														<th class="text-right">Produk</th>
														<th class="text-right">Bahan</th>
														<th class="text-right">Keterangan</th>
														<th class="text-right">Operator</th>
														<th class="text-right">Status</th>
													</tr>
												</thead>
												<?php 
													
													// print_r($detail);
													$finishing ='';
													$num = 1;
													foreach($detail AS $val)
													{
														if($val->status==1){
															$status = '<button class="btn btn-info btn-sm flat edit_proses" data-id="'.$val->id_rincianinvoice.'">Proses</button>';
															}elseif($val->status==2){
															$status = '<button class="btn btn-success btn-sm flat">Selesai</button>';
															}else{
															$status = '<button class="btn btn-warning btn-sm flat edit_baru" data-id="'.$val->id_rincianinvoice.'">Baru</button>';
														}
														$operator = '-';
														if($val->id_operator!=0){
															$operator = juser($val->id_operator);
														}
														$bahan =  getDetailBahan($val->id_bahan)->title;
														if(!empty($val->detail)){
															$finishing = json_decode($val->detail);
														}
													?>
													<tr>
														<td><?=$val->jumlah;?></td>
														<td class="text-right"><?=nama_produk($val->id_produk);?></td>
														<td class="text-right"><?=$bahan;?></td>
														<td class="text-right">
															<?php
																if(!empty($finishing)){
																	foreach($finishing->data  AS $key=>$vals){
																		echo ' | '.$vals->title.':'.$vals->isi.' | '; 
																	}
																}
															?>
														</td>
														<td class="text-right"><?=$operator;?></td>
														<td class="text-right"><?=$status;?></td>
													</tr>
													<?php 
													}
													$count_status = count_status($row['id_invoice']);
													$sum_status = sum_status($row['id_invoice']);
													$total = $count_status * 2;
													if($sum_status==$total){
													$status_update = '<button class="btn btn-success btn-sm flat">Selesai</button>';
													$share = '<button class="btn btn-info btn-sm flat kirim_wa" data-id="'.$id_invoice.'" data-nomor="'.$row["no_hp"].'" data-trx="'.$row["id_transaksi"].'"  data-tgl="'.$row["tgl_trx"].'" ><i class="fa fa-whatsapp"></i> Kirim</button>';
													}else{
													$status_update = '<button class="btn btn-info btn-sm flat get_status" data-id="'.$row['id_invoice'].'">Update Status</button>';
													$share = '';
													}
												?>
												<tr>
													<td></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td colspan="2" class="text-right"><button class="btn btn-secondary btn-sm flat cetak_order"><i class="fa fa-print"></i> Cetak Semua</button><?= $status_update.$share;?></td>
												</tr>
												<?php
													
												}
											}
											else{ ?>
											<tr>
												<td colspan="6">Data belum ada</td>
											</tr> 
										<?php }?>
									</tbody>
								</table>
								<nav aria-label="Page navigation" class="mt-2">
									<?php echo $this->ajax_pagination->create_links(); ?>
								</nav>
							</div>
						</div>
					</div><!-- /.card-body -->
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div>
	</div>
</div>
<div class="modal fade" id="OpenModalOperator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelPengguna">Update Status</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">No. Order</span>
					</div>
					<input type="text" id="noorder" name="noorder" class="form-control" readonly>
					<input type="hidden" id="no_order" name="no_order" class="form-control" readonly>
				</div>
				<div class="form-group">
					<select name="status_baru" class="form-control custom-select" id="status_baru">
						<option value="0">Pilih status</option>
						<option value="1">Proses</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  id="btn-baru" class="btn btn-success simpan_baru">Simpan</button>
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="OpenModalProses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelPengguna">Update Status</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">No. Order</span>
					</div>
					<input type="text" id="noorderproses" name="noorderproses" class="form-control" readonly>
					<input type="hidden" id="no_order_proses" name="no_order_proses" class="form-control" readonly>
				</div>
				<div class="form-group">
					<select name="status_proses" class="form-control custom-select" id="status_proses">
						<option value="1">Pilih status</option>
						<option value="2">Selesai</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  id="btn-proses" class="btn btn-success simpan_proses">Simpan</button>
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="OpenModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelPengguna">Update Status</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">No. Order</span>
					</div>
					<input type="text" id="id_invoice" name="id_invoice" class="form-control" readonly>
				</div>
				<div class="form-group">
					<select name="status_update" class="form-control custom-select" id="status_update">
						<option value="0">Pilih status</option>
						<option value="1">Proses</option>
						<option value="2">Selesai</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button"  id="btn-proses" class="btn btn-success update_status">Simpan</button>
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
			</div>
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
<script>
	$(".kirim_wa").click(function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var nomor = $(this).attr('data-nomor');
		var trx = $(this).attr('data-trx');
		var tgl = $(this).attr('data-tgl');
		// console.log(id);
		$('#WaLabel').html('Kirim '+trx);  
		$('#OpenModalWa').modal({backdrop: 'static', keyboard: false})  
		$.ajax({
			url: base_url + 'whatsapp/get_form_wa',
			data: {id:id,nomor:nomor,tgl:tgl},
			method: 'POST',
			dataType:'html',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$(".load-data-wa").html(data);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	
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
	function open_popup(id)
	{
		
		var w = 880;
		var h = 570;
		var l = Math.floor((screen.width-w)/2);
		var t = Math.floor((screen.height-h)/2);
		if(thermal===1){
			$.post(base_url+"operator/print_invoice_html/"+id,{id: id},
			function(data, status){
				if(status=='success'){
					// alert("Data: " + data + "\nStatus: " + status);
				}
			});
			}else{
			var url_cetak = base_url +'operator/print_invoice_html/'+id;
			window.open(url_cetak, 'Cetak Invoice', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
		}
	}
</script>
<style>
	.custom-select {
    display: inline-block;
    width: 100%;
	height: 40px;
	padding: 5px 1.75rem 5px .75rem;
	
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
	padding: 2px;
	
	}
	.card .table td, .card .table th {
	padding-right: 5px;
	padding-left: 5px;
	}
	.small {
	height: 30px;
	padding: 2px 10px;
	}
	button, input, select, textarea {
	font-family: inherit;
	font-size: inherit;
	line-height: inherit;
	}
</style>
<script>
	var date2 = new Date();
	$('#date-omset .input-daterange').datepicker({        
        format: 'dd/mm/yyyy',        
		"endDate": date2,
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
	}); 
	
	// search_Filter();
	function search_Operator(page_num){
		page_num = page_num?page_num:0;
		var user = $('#user').val();
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		var urlnya = base_url+"laporan/ajaxoperator/"+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,user:user,dari:dari,sampai:sampai,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#dataListOmset').html(html);
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
			}
		});
	}
	
	
	$(document).on('click','.get_status',function(e){
		var id = $(this).attr('data-id');
		$('#id_invoice').val(id);
		$('#OpenModalUpdate').modal('show');
	});
	
	$(document).on('click','.update_status',function(e){
		var id = $('#id_invoice').val();
		var status_update = $('#status_update').val();
		if(status_update==0){
			showNotif('bottom-right','Alert','Pilih status','warning');
			$('#status_update').focus()
			return;
		}
		$.ajax({
			url: base_url + 'laporan/simpan_laporan',
			data: {type:'update',id:id,status:status_update},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
                $('body').loading();　
			},
			success: function(data) {
				$('#OpenModalUpdate').modal('hide');
				search_Operator();
				
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	
	$(document).on('click','.edit_baru',function(e){
		var id = $(this).attr('data-id');
		// console.log(id)
		$.ajax({
			url: base_url + 'laporan/get_laporan',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
                $('body').loading();　
				$('#OpenModalOperator').modal('show');
			},
			success: function(data) {
				$('#noorder').val(data.idorder);
				$('#no_order').val(data.id);
				$('#status_baru').val(data.status);
				
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	
	$(document).on('click','.edit_proses',function(e){
		var id = $(this).attr('data-id');
		// console.log(id)
		$.ajax({
			url: base_url + 'laporan/get_laporan',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
                $('body').loading();　
				$('#OpenModalProses').modal('show');
			},
			success: function(data) {
				$('#noorderproses').val(data.idorder);
				$('#no_order_proses').val(data.id);
				$('#status_proses').val(data.status);
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	$(document).on('click','.simpan_baru',function(e){
		var noorder = $('#noorder').val();
		var id = $('#no_order').val();
		var status_baru = $('#status_baru').val();
		if(status_baru==0){
			showNotif('bottom-right','Alert','Pilih status','warning');
			$('#status_baru').focus()
			return;
		}
		// console.log(id)
		$.ajax({
			url: base_url + 'laporan/simpan_laporan',
			data: {type:'proses',id:id,status:status_baru},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
                $('body').loading();　
				$('#OpenModalOperator').modal('show');
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right',data.title,data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				$('#OpenModalOperator').modal('hide');
				search_Operator();
				
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	
	$(document).on('click','.simpan_proses',function(e){
		var noorder= $('#noorderproses').val();
		var id = $('#no_order_proses').val();
		var status_proses = $('#status_proses').val();
		if(status_proses==1){
			showNotif('bottom-right','Alert','Pilih status','warning');
			$('#status_proses').focus()
			return;
		}
		// console.log(id)
		$.ajax({
			url: base_url + 'laporan/simpan_laporan',
			data: {type:'selesai',id:id,noorder:noorder,status:status_proses},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
                $('body').loading();　
				$('#OpenModalProses').modal('show');
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right',data.title,data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				$('#OpenModalProses').modal('hide');
				search_Operator();
				
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	function clearSearch(tgl){
		$('#dari').val(tgl);
		search_Operator();
	}
</script>				