<script src="<?= base_url('assets/'); ?>js/glightbox.min.js"></script>
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Uang Masuk</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Uang Masuk</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SETOR</span>
						</div>
						<select name="setor" id="setor" class="form-control form-control-sm custom-select w-7" onchange="search_Uangmasuk()">
							<?php if ($this->session->level == 'kasir'){ ?>
								<option value="N">BELUM</option>
								<option value="Y">SUDAH</option>
								<?php }else{ ?>
								<option value="N">BELUM</option>
								<option value="Y" selected>SUDAH</option>
							<?php } ?>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">JENIS</span>
						</div>
						<select name="jenis" id="jenis_bayar" class="form-control form-control-sm custom-select w-7" onchange="search_Uangmasuk()">
							<option value="0">Semua</option>
							<?php  
								foreach ($jenis_bayar->result_array() AS $row){
									if ($this->session->level == 'kasir'){
										echo '<option value="'.$row['id'].'">'.$row['nama_bayar'].'</option>';
										}else{
										$selected = $row['id'] == 1 ? 'selected' : '';
										echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nama_bayar'].'</option>';
									}
								}
						?>
					</select>
					<div class="input-group-prepend">
						<span class="input-group-text">KASIR</span>
					</div>
					<select name="user" id="user" class="form-control form-control-sm custom-select w-7" onchange="search_Uangmasuk()">
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
						<span class="input-group-text">TANGGAL</span>
					</div>
					<div id="date-omset">
						<div class="input-daterange input-group">
							<input type="text" onchange="search_Uangmasuk()" value="<?=$dari;?>" class="form-control form-control-sm w-10" name="dari" id="dari">
							
							<input type="text" onchange="search_Uangmasuk()" value="<?=$sampai;?>" class="form-control form-control-sm w-10" name="sampai" id="sampai">
						</div>
					</div>
					<div class="input-group-append">
						<button type="button" data-toggle="tooltip" class="btn btn-danger btn-sm clear" id="clear" data-original-title="Clear"><i class="fa fa-times fa-1x"></i> Clear</button>
						<button type="button" data-info="harian" class="btn btn-success btn-sm harian" data-id="0"><i class="fa fa-search"></i> Lihat</button>
						<button class="btn btn-primary url_doc" data-url="uang_masuk" type="button" data-toggle="tooltip" data-original-title="Dok Uang masuk" data-placement="left"><i class="fa fa-info-circle"></i></button>
					</div>
				</div>
			</div>
			
			<div class="card-body table-responsive">
				<div class="card-block">
					<div class="post-list pt-0" id="data_uang_masuk">
						<div class="table-responsive-sm">
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th style="width:1%">No.</th>
										<th style="width:2%">ID_Order</th>
										<th style="width:5%">Tgl.Transaksi</th>
										<th style="width:5%">Nama Konsumen</th>
										<th style="width:5%">Tgl.Bayar</th>
										<th style="width:5%">Keterangan</th>
										<th style="width:5%">Lampiran</th>
										<th style="width:5%" class="text-right">Jml. Bayar</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										
										$count = 0;
										
										if(!empty($result)){
											$totsetors = 0;
											$no=1;
											foreach($result AS $rows){
												$cara_bayar = $rows['nama_bayar'];
												
												$conditions['where'] = array( 
												'`bayar_invoice_detail`.id_bayar'=>$rows['id'],
												'`invoice`.`status`!='=>'baru',
												'`invoice`.`status`!='=>'pending',
												'`invoice`.`status`!='=>'batal'
												); 
												
												$databayar = $this->model_data->detailBayar($conditions);
												$totsetor = 0;
												if(!empty($databayar)){
													foreach($databayar AS $row){
														$bank = bank($row['id_sub_bayar']);
														$lampiran ='-';
														
														if(!empty($row['lampiran'])){
															$lampiran ='<a class="lightbox" href="'.base_url('uploads/lampiran/').$row['lampiran'].'">View</a>';
														}
														$nama_bayar = $row['nama_bayar'];
														
														if(!empty($bank) AND $rows['id'] !=1){
															$nama_bayar = $row['nama_bayar'] .'('.$bank.')';
														}
													?>
													<tr>
														<td><?php echo $no;?></td>
														<td>#<?php echo $row['id_invoice'];?></td>
														<td><?php echo dtimes($row['tgl_trx'],false,false);?></td>
														<td><?php echo $row['nama'];?></td>
														<td><?php echo dtimes($row['tgl_bayar'],false,false);?></td>
														<td><?=$nama_bayar;?></td>
														<td><?=$lampiran;?></td>
														<td class="text-right"><?php echo rp($row['jml_bayar']);?></td>
													</tr>
													<?php 
														$totsetor = $totsetor + $row['jml_bayar'];
														$totsetors +=  $row['jml_bayar'];
														$no++;
													} 
												} 
												
												echo '<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td><i><strong>'.$cara_bayar.'</i></strong></td>
												<td>&nbsp;</td>
												<td class="text-right"><i><strong>'.rp($totsetor).'</i></strong></td>
												</tr>';
											}
											echo '<tfoot><tr>';
											echo '<td colspan="2"><button class="btn btn-info btn-sm" id="cetak_u_masuk"><i class="fa fa-file-pdf-o"></i> Print</button></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td><i><strong>Total</i></strong></td>';
											echo '<td class="text-right"><i><strong>'.rp($totsetors).'</i></strong>
											<input type="hidden" name="total_u" id="total_u" value="'.$totsetors.'">
											</td>';
										echo '</tr></tfoot>'; ?>
										<script>
											var lightboxDescription = GLightbox({
												selector: '.lightbox',
												loop: true,
											});
										</script>
										<?php 
											$count = count($result);
											}else{
											// echo 1;
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div><!-- /.card-body -->
			</div><!-- /.card-body -->
		</div><!-- /.card -->
	</div>
</div>
</div>

<form id="form_cetak" action="<?=base_url();?>pembukuan/cetak_uang_masuk" method="post" target="_blank">
	<input type="hidden" name="dari" id="tgl_dari" value="<?=$dari;?>">
	<input type="hidden" name="sampai" id="tgl_sampai" value="<?=$sampai;?>">
	<input type="hidden" name="jenis_bayar" id="jenisbayar">
	<input type="hidden" name="id_user" id="id_user" value="0">
</form>

<style>
	
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
<!-- Modal Scrollable -->
<div class="modal fade" id="ModalVerifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" id="save-verifikasi" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Approve setoran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type='hidden' name='id' id='id_setor'>
				<input type='hidden' name='type' id="type_edit" value="edit">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="total">Total Setoran</label>
							<input type="text" name="total" id="total_setor" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="total">Tanggal Approve</label>
							<input type="date" name="tanggal" id="tanggal_verivikasi" class="form-control" required>
						</div>
						
						<label>Approve </label>
						<div class="form-group d-flex flex-row">
							<select name="status" id="status" class="form-control custom-select" required>
								<option value="1" selected>Ya</option>
								<option value="0">Tidak</option>
							</select>
						</div>	
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_verifikasi">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Scrollable -->
<div class="modal fade" id="ModalSetor" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" id="save-setor" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Approve setoran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type='hidden' name='id' id='id_setorkeu'>
				<input type='hidden' name='type' id="type_editkeu" value="edit">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="total">Total Setor</label>
							<input type="text" name="total" id="total_setorkeu" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="total">Tanggal Approve</label>
							<input type="date" name="tanggal" id="tanggal_verivikasikeu" class="form-control" required readonly>
						</div>
						<div class="form-group">
							<label for="total">Tanggal Setor</label>
							<input type="date" name="tanggal_setor" id="tanggal_setor" class="form-control" required>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_setor">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Scrollable -->
<div class="modal fade" id="ModalOwner" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" id="save-owner" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Approve Setoran Keuangan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type='hidden' name='id' id='id_setor_owner'>
				<input type='hidden' name='type' id="type_edit_owner" value="edit">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="total">Total Setoran</label>
							<input type="text" name="total" id="total_setor_owner" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="total">Tanggal Approve</label>
							<input type="date" name="tanggal" id="tanggal_verivikasi_owner" class="form-control" required>
						</div>
						
						<label>Approve </label>
						<div class="form-group d-flex flex-row">
							<select name="status" id="status" class="form-control custom-select" required>
								<option value="3" selected>Ya</option>
							</select>
						</div>	
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_owner">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on('click','.setor_btn',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// alert(id);
		$('#ModalSetor').modal({backdrop: 'static', keyboard: false});
		
		$.ajax({
			url: base_url + 'pembukuan/setor',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$("#id_setorkeu").val(data.id);
				$("#total_setorkeu").val(data.total);
				$("#tanggal_verivikasikeu").val(data.tanggal);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	$(document).on('click','.verifikasi',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// alert(id);
		$('#ModalVerifikasi').modal({backdrop: 'static', keyboard: false});
		
		$.ajax({
			url: base_url + 'pembukuan/verifikasi',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$("#id_setor").val(data.id);
				$("#total_setor").val(data.total);
				$("#tanggal_verivikasi").val(data.tanggal);
				$("#status").val(data.status);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	$(document).on('click','.approve_owner',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// alert(id);
		$('#ModalOwner').modal({backdrop: 'static', keyboard: false});
		
		$.ajax({
			url: base_url + 'pembukuan/approve_owner',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$("#id_setor_owner").val(data.id);
				$("#total_setor_owner").val(data.total);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	
	$(document).on('click','.save_owner',function(e){
		e.preventDefault();
		var id = $("#id_setor_owner").val();
		var type = $("#type_edit_owner").val();
		var total = $("#total_setor_owner").val();
		var tanggal = $("#tanggal_verivikasi_owner").val();
		  
		$.ajax({
			url: base_url + 'pembukuan/save_owner',
			data: {id:id,type:type,total:total,tanggal:tanggal},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				// $('#save-verifikasi').loading({zIndex:1060});
			},
			success: function(data) {
				if(data.status==200){
					$('#ModalOwner').modal('hide');
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				$('#save-owner').loading('stop');
				$(".harian").click();
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#save-owner').loading('stop');
			}
		});
	});
	$(document).on('click','.save_setor',function(e){
		e.preventDefault();
		var id = $("#id_setorkeu").val();
		var type = $("#type_editkeu").val();
		var total = $("#total_setorkeu").val();
		var tanggal = $("#tanggal_verivikasikeu").val();
		var tanggal_setor = $("#tanggal_setor").val();
		 
		$.ajax({
			url: base_url + 'pembukuan/setor_to_owner',
			data: {id:id,type:type,total:total,tanggal:tanggal,tanggal_setor:tanggal_setor},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				// $('#save-verifikasi').loading({zIndex:1060});
			},
			success: function(data) {
				if(data.status==200){
					$('#ModalSetor').modal('hide');
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				$('#save-setor').loading('stop');
				$(".harian").click();
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#save-setor').loading('stop');
			}
		});
	});
	$(document).on('click','.save_verifikasi',function(e){
		e.preventDefault();
		var id = $("#id_setor").val();
		var type = $("#type_edit").val();
		var total = $("#total_setor").val();
		var tanggal = $("#tanggal_verivikasi").val();
		var status = $("#status").val();
		
		$.ajax({
			url: base_url + 'pembukuan/save_verifikasi',
			data: {id:id,type:type,total:total,tanggal:tanggal,status:status},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				// $('#save-verifikasi').loading({zIndex:1060});
			},
			success: function(data) {
				if(data.status==200){
					$('#ModalVerifikasi').modal('hide');
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				$('#save-verifikasi').loading('stop');
				$(".harian").click();
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#save-verifikasi').loading('stop');
			}
		});
	});
 
	var count = <?=$count;?>;
	var date2 = new Date();
	$('#date-omset .input-daterange').datepicker({        
		format: 'dd/mm/yyyy',        
		"endDate": date2,
		autoclose: true,     
		todayHighlight: true,   
		todayBtn: 'linked',
	}); 
	$(document).on('click', '.clear', function() {
		$("#jenis_bayar").val(0);
		$("#user").val(0);
		$(".harian").click();
	});
	
	$("#cetak_u_masuk").hide();
	if(count > 0){
		$("#cetak_u_masuk").show();
	}
	
	window.onload = function(){search_Uangmasuk()};
	function search_Uangmasuk(){
		$(".harian").click();
	}
	$(document).on('click','.harian',function(e){
		e.preventDefault();
		$("#data_uang_masuk").html("");
		var info = $(this).attr('data-info');
		var setor = $("#setor").val();
		var jenis_bayar = $("#jenis_bayar").val();
		var user = $("#user").val();
		var dari = $("#dari").val();
		var sampai = $("#sampai").val();
		if(dari=="" || sampai==""){
			sweet('Peringatan!!!','Tanggal harus diisi','warning','warning');
			return;
		}
		$("#tgl_dari").val(dari);
		$("#tgl_sampai").val(sampai);
		$("#id_user").val(user);
		$("#jenisbayar").val(jenis_bayar);
		
		var url_data = base_url + 'pembukuan/data_uang_masuk';
		$.ajax({
			url: url_data,
			data: {setor:setor,user:user,jenis_bayar:jenis_bayar,dari:dari,sampai:sampai,info:info},
			method: 'POST',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				let text = data;
				let result = text.replace(/^\s+|\s+$/gm,'')
				if(result=='Data belum ada'){
					$("#data_uang_masuk").html(data);
					$("#cetak_u_masuk").hide();
					}else{
					$("#data_uang_masuk").html(data);	
					$("#cetak_u_masuk").show();
				}
				var total_u = $("#total_u").val();
				if(total_u ==0){
					$("#cetak_u_masuk").hide();
				}
				$('body').loading('stop');
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Inport data error',error,'error');
				$('body').loading('stop');
			}
		});
	});
	
	$(document).on('click','#cetak_u_masuk',function(e){
		e.preventDefault();
		
		var total_u = $("#total_u").val();
		// console.log(total_u);return
		if(total_u==0){
			sweet('Peringatan!!!','Maaf total masih kosong','warning','warning');
			}else{
			$("#form_cetak").submit();
		}
	});
	
	$(document).on('click','.setor',function(e){
		e.preventDefault();
		var info = $(this).attr('data-info');
		var jml = $("#total_u").val();
		var user = $("#user").val();
		var dari = $("#dari").val();
		var sampai = $("#sampai").val();
		if(jml==0){
			sweet('Peringatan!!!','Maaf belum ada data','warning','warning');
			return;
		}
		if(user==0){
			sweet('Peringatan!!!','Maaf pilih dulu kasirnya','warning','warning');
			return;
		}
		$.ajax({
			url: base_url + 'pembukuan/setor_uang_masuk',
			data: {user:user,total:jml,info:info,dari:dari,sampai:sampai},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				if(data.status==200){
					search_Uangmasuk();
					sweet('Sukses!!!','Uang berhasil disetor','success','success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
			}
		});
	});
	$(document).on('click','.setor_keu',function(e){
		e.preventDefault();
		var info = $(this).attr('data-info');
		var jml = $("#total_u").val();
		var user = $("#user").val();
		var dari = $("#dari").val();
		var sampai = $("#sampai").val();
		if(jml==0){
			sweet('Peringatan!!!','Maaf belum ada data','warning','warning');
			return;
		}
		if(user==0){
			sweet('Peringatan!!!','Maaf pilih dulu kasirnya','warning','warning');
			return;
		}
		$.ajax({
			url: base_url + 'pembukuan/setor_to_owner',
			data: {user:user,total:jml,info:info,dari:dari,sampai:sampai},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				if(data.status==200){
					search_Uangmasuk();
					sweet('Sukses!!!','Uang berhasil disetor','success','success');
					}else{
					sweet('Peringatan!!!','Maaf rekapan harus per kasir','warning','warning');
				}
			}
		});
	});
	</script>															