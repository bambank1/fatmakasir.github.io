<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Kategori produk</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Kategori produk</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="#" method="post">
				<div class="card">
					<div class="card-header pb-0">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text">LIMIT</span>
							</div>
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Jenis()">
								<option value="10" selected>10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Jenis()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Jenis();"/>
							<div class="input-group-append">
								<button class="btn btn-danger clear_jenis" type="button"><i class="fa fa-times"></i> Clear</button>
								<button type="button" class="btn btn-info jenis" data-id="0"><i class="fa fa-plus"></i> Tambah</button>
								<button class="btn btn-primary url_doc" data-url="jenis" type="button" data-toggle="tooltip" data-original-title="Dok Kategori Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					
					<div class="card-body table-responsive"  id="dataJenis">
						<div class="card-block">
							<table class="table table-striped table-mailcard">
								<thead>
									<tr>
										<th class='w-1 text-center'>No</th>
										<th>Uraian</th>
										<th class='w-20 text-right'>Status | Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($result)){
										$no = 1;
										
										foreach ($result as $row){
											
											if ($row['pub'] == 'Y'){ $aktif ='<i class="fa fa-check-circle text-white" title="Aktif"></i>'; }else{ $aktif = '<i class="fa fa-minus-circle text-danger" title="Nonaktif"></i>'; }
											
											if ($row['id_jenis'] == 9){
												$edit_jenis = "<a class='btn-sm text-warning' href='#'>$row[jenis_cetakan]</a>";
												$edit_btn = "<a class='btn btn-secondary btn-sm text-white' href='#'><i class='fa fa-edit'></i> Edit</a>";
												$hapus = '<a class="btn btn-secondary btn-sm text-white" href="#"><i class="fa fa-trash "></i> Hapus</a>';
												}else{
												$edit_jenis = "<a class='btn-sm jenis text-info' title='Edit Data' data-id='$row[id_jenis]' href='#'>$row[jenis_cetakan]</a>";
												$edit_btn = "<a class='btn btn-info btn-sm jenis text-white' title='Edit Data' data-id='$row[id_jenis]' href='#'><i class='fa fa-edit'></i> Edit</a>";
												$hapus = '<a class="btn btn-danger btn-sm text-white" data-id="'.$row['id_jenis'].'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</a>';
											}
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'>$edit_jenis</td>
											<td class='text-right'><div class='btn-group btn-group-sm' role='group'>
											<button type='button' class='btn btn-info btn-sm ' data-id='".$row['id_jenis']."'><span class='icon text-white'>$aktif</span></button>$edit_btn $hapus
											</div></td>
											</tr>";
											$no++;
										} 
									}else{ ?>
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
<!-- Modal Scrollable -->
<div class="modal fade" id="ModalJenis" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" id="save-jenis" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Kategori produk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type='hidden' name='jenis_id' id='jenis_id' value='0'>
				<input type='hidden' name='type' id="type">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Kategori</label>
							<input type="text" name="judul" id="judul" class="form-control" required>
						</div>
						<label>Aktif </label>
						<div class="form-group d-flex flex-row">
							<select name="aktif" id="aktif" class="form-control custom-select" required>
								<option value="Y" selected>Ya</option>
								<option value="N">Tidak</option>
							</select>
						</div>	
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_jenis">Simpan</button>
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

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="confirm-rollback" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Confirm</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<p>Anda akan menginput data dummy kategori produk, prosedur ini tidak dapat diubah.</p>
				<p>Apakah Anda ingin melanjutkan?</p>
				<p class="debug-url"></p>
				<input type="hidden" id="data-rollback">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger rollback" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="halaman" id="halaman" value="0">
<script>
	$(function(){
		$(document).fcs(".form-control");
	});
	
	$('.clear_jenis').on('click', function(){
		$('#keywords').val('');
		search_Jenis();
	});
	
	function search_Jenis(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("produk/cariJenis/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('#dataJenis').loading();
			},
			success: function(html){
				$('#dataJenis').html(html);
				$('#halaman').val(page_num);
				$('#dataJenis').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#dataJenis').loading('stop');
			}
		});
	}
	$('#ModalJenis').on('shown.bs.modal', function() {
		$('#judul').focus();
	})
	$(document).on('click','.jenis',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		// alert(id);
		$('#ModalJenis').modal({backdrop: 'static', keyboard: false});
		if(id==0){
            $("#type").val('add');
			return
			}else{
            $("#type").val('edit');
		}
		$.ajax({
			url: base_url + 'produk/edit_jenis',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$("#jenis_id").val(data.id);
				$("#judul").val(data.judul);
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
	$(document).on('click','.save_jenis',function(e){
		e.preventDefault();
		var id = $("#jenis_id").val();
		var type = $("#type").val();
		var judul = $("#judul").val();
		var aktif = $("#aktif").val();
		var halaman = $("#halaman").val();
		if(judul==''){
			$("#judul").addClass('is-invalid');
			$("#judul").focus();
			return;
		}
		
		if(aktif==''){
			$("#aktif").addClass('is-invalid');
			return;
		}
		$.ajax({
			url: base_url + 'produk/save_jenis',
			data: {id:id,type:type,judul:judul,aktif:aktif},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('#save-jenis').loading({zIndex:1060});
			},
			success: function(data) {
				if(data.status==200){
					$('#ModalJenis').modal('hide');
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				search_Jenis(halaman);
				$('#save-jenis').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#save-jenis').loading('stop');
			}
		});
	});
	$(document).on('click','.hapus',function(e){
		var id = $("#data-hapus").val();
		var halaman = $("#halaman").val();
		$.ajax({
			url: base_url + 'produk/hapus_jenis',
			data: {type:'hapus',id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				$('#confirm-delete').modal('hide');
				search_Jenis(halaman);
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
<style>
	.card .table td, .card .table th {
    padding-right: 1rem;
    padding-left: 1rem;
	}
</style>