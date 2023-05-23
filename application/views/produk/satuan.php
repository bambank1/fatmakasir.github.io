<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Satuan</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Satuan</li>
		</ol>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<form action="#" method="post">
				<div class="card">
					<div class="card-header pb-0">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text" for"limits">LIMIT</span>
							</div>
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Satuan()">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Satuan()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Satuan();"/>
							<div class="input-group-append">
								<button class="btn btn-danger btn-sm clear" type="button"><i class="fa fa-times"></i> Clear</button>
								<button type="button" class="btn btn-info add_satuan" data-id="0"><i class="fa fa-plus"></i> Tambah</button>
								<button class="btn btn-primary btn-sm url_doc" data-url="satuan" type="button" data-toggle="tooltip" data-original-title="Dok Satuan Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					<?php echo $this->session->flashdata('message'); ?>
					<div class="card-body table-responsive"  id="dataSatuan">
						<div class="card-block">
							<table class="table table-striped table-mailcard">
								<thead>
									<tr>
										<th class="w-1 text-center">No</th>
										<th class="w-10">satuan</th>
										<th class="w-25">Nama satuan</th>
										<th class="w-10">Jumlah satuan</th>
										<th class="w-10 text-center">Status | Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($result)){
										$no = 1;
										foreach ($result as $row){
											if ($row->pub == 0){ 
											$aktif ='<i class="fa fa-check-circle"></i>'; 
											$text ='text-white'; 
											}else{ 
											$aktif = '<i class="fa fa-minus-circle"></i>'; 
											$text ='text-white-50'; 
											}
											
											$hapus = '<button type="button" class="btn btn-danger btn-sm text-white"  data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</button>';
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'><a class='btn-sm add_satuan text-info' title='Edit Data' data-id='$row->id' href='#'>{$row->satuan}</a></td>
											<td class='text-left'>{$row->nama_satuan}</td>
											<td class='text-left'>{$row->jumlah}</td>
											<td class='text-right'>
											<div class='btn-group btn-group-sm' role='group'>
											<button type='button' class='btn btn-info btn-sm' data-id='".$row->id."'><span class='icon $text'>$aktif</span></button>
											<button type='button' class='btn btn-info btn-sm add_satuan' data-id='".$row->id."'><i class='fa fa-edit'></i> Edit</button>
											$hapus
											</div>
											</td>
											</tr>";
											$no++;
										} }else{ ?>
										<tr>
											<td colspan="5">Data belum ada</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<nav aria-label="Page navigation" class="mt-2">
								<?php 
									echo $this->ajax_pagination->create_links(); 
								?>
							</nav>
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="ModSatuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" id="save-satuan" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="satuanModalScrollableTitle">Satuan produk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<input type='hidden' name='satuan_id' id='satuan_id'>
				<input type='hidden' name='type' id="type">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="judul">Satuan</label>
							<input type="text" name="judul" id="judul" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="nama">Nama satuan</label>
							<input type="text" name="nama" id="nama" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="jumlah">Jumlah satuan</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" required>
						</div>
						<label>Aktif </label>
						<div class="form-group d-flex flex-row">
							<select name="aktif" id="aktif" class="form-control custom-select" required>
								<option value="">Pilih</option>
								<option value="0">Ya</option>
								<option value="1">Tidak</option>
							</select>
						</div>	
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_satuan">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="confirm-delete" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<p>Anda akan menghapus satu url, prosedur ini tidak dapat diubah.</p>
				<p>Apakah Anda ingin melanjutkan?</p>
				<p class="debug-url"></p>
				<input type="hidden" id="data-hapus">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="halaman" id="halaman" value="0">
<script>
	$('.clear').on('click', function(){
		$('#keywords').val('');
		search_Satuan();
	});
	
	function search_Satuan(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("produk/cariSatuan/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('.table-mailcard').loading();
			},
			success: function(html){
				$('#dataSatuan').on('loading.stop', function(event, loading) {
					$('#dataSatuan').html(html);
					$('#halaman').val(page_num);
				});
				$('.table-mailcard').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('.table-mailcard').loading('stop');
			}
		});
	}
	$('#ModSatuan').on('shown.bs.modal', function() {
		$('#judul').focus();
	})
	$(document).on('click','.add_satuan',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('#ModSatuan').modal({backdrop: 'static', keyboard: false});
		if(id==0){
            $("#satuanModalScrollableTitle").html('Add Satuan produk');
            $("#type").val('add');
            $("#satuan_id").val(id);
			return;
			}else{
			 $("#satuanModalScrollableTitle").html('Edit Satuan produk');
            $("#type").val('edit');
		}
		$.ajax({
			url: base_url + 'produk/edit_satuan',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$("#satuan_id").val(data.id);
				$("#judul").val(data.judul);
				$("#nama").val(data.nama);
				$("#jumlah").val(data.jumlah);
				$("#aktif").val(data.aktif);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	$('#aktif').on('change', function() {
		$("#aktif").removeClass("is-invalid").addClass("is-valid");
	});
	$("#judul").keyup(function(){
		$("#judul").removeClass("is-invalid").addClass("is-valid");
	});
	$("#jumlah").keyup(function(){
		$("#jumlah").removeClass("is-invalid").addClass("is-valid");
	});
	$("#nama").keyup(function(){
		$("#nama").removeClass("is-invalid").addClass("is-valid");
	});
	$(document).on('click','.save_satuan',function(e){
		e.preventDefault();
		var id = $("#satuan_id").val();
		var type = $("#type").val();
		var judul = $("#judul").val();
		var nama = $("#nama").val();
		var jumlah = $("#jumlah").val();
		var aktif = $("#aktif").val();
		var halaman = $("#halaman").val();
		if(judul==''){
			$("#judul").addClass('is-invalid');
			$("#judul").focus();
			return;
		}
		if(nama==''){
			$("#nama").addClass('is-invalid');
			$("#nama").focus();
			return;
		}
		if(jumlah==''){
			$("#jumlah").addClass('is-invalid');
			$("#jumlah").focus();
			return;
		}
		if(aktif==''){
			$("#aktif").addClass('is-invalid');
			return;
		}
		$.ajax({
			url: base_url + 'produk/save_satuan',
			data: {id:id,type:type,judul:judul,nama:nama,jumlah:jumlah,aktif:aktif},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('#save-satuan').loading({zIndex:1070,message:'saving data...'});
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				
				$('#ModSatuan').modal('hide');
				search_Satuan(halaman);
				$('#save-satuan').loading('stop');
				
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				gload('hide');
				search_Satuan(halaman);
				$('#save-satuan').loading('stop');
			}
		});
	});
	$(document).on('click','.hapus',function(e){
		var id = $("#data-hapus").val();
		var halaman = $("#halaman").val();
		$.ajax({
			url: base_url + 'produk/hapus_satuan',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				if(data.status==200){
					$('#confirm-delete').modal('hide');
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				search_Satuan(halaman);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$('#data-hapus').val($(e.relatedTarget).data('id'));
	});
	$('body').on('hidden.bs.modal', '.modal', function() {
		$('.form-control').val('')
	});
</script>