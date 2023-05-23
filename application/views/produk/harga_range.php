<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Harga range</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Harga range</li>
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
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Range()">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Range()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Range();"/>
							<div class="input-group-append">
								<button class="btn btn-danger btn-sm clearR" type="button"><i class="fa fa-times"></i> Clear</button>
								<button class="btn btn-primary btn-sm url_doc" data-url="range" type="button" data-toggle="tooltip" data-original-title="Dok Harga Range" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					<?php echo $this->session->flashdata('message'); ?>
					<div class="card-body table-responsive"  id="dataRange">
						<div class="card-block">
							<table class="table table-bordered table-striped table-mailcard">
								<thead>
									<tr>
										<th class="w-1 text-center">No</th>
										<th class="">Nama Barang</th>
										<th class="w-15">Jumlah Min</th>
										<th class="w-15">Jumlah Max</th>
										<th class="w-15 text-right">Harga Jual</th>
										<th class="w-15 text-center">Status | Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($result)){
										$no = 1;
										foreach ($result as $row){
											if ($row->pub == 0){ $aktif ='<i class="fa fa-check-circle"></i>'; }else{ $aktif = '<i class="fas fa-minus-circle text-danger"></i>'; }
											$hapus = '<a class="text-info" data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash text-danger"></i> Hapus</a>';
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'><a class='btn-sm add_harga text-info' title='Edit Data' data-id='$row->id' href='#'>{$row->title}</a></td>
											<td class='text-left'>{$row->jumlah_minimal}</td>
											<td class='text-left'>{$row->jumlah_maksimal}</td>
											<td class='text-right'>".rp($row->harga_jual)."</td>
											<td class='text-center pl-0 pr-0'><center>
											<a class='btn-sm add_satuan text-info' title='Edit Data' data-id='$row->id' href='#'><i class='fa fa-edit text-info'></i> Edit</a> | ".$hapus."
											</center></td>
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
<div class="modal fade" id="ModRange" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-scrollable" id="save-satuan" role="document">
		<div class="modal-content">
			<div class="modal-header pt-1 pb-1">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Harga range</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="loading_range">
				<form id="form_harga" method="post">
					<input type='hidden' name='id_range' id='id_range' value='0'>
					<input type='hidden' name='type' id="type">
					<div class="form-group mb-1">
						<label for="bahan">Nama barang</label>
						<select name="bahan" id="bahan" class="form-control form-control-sm" required>
							<option value="">Pilih</option>
							<?php foreach($bahan AS $val){ ?>
								<option value="<?=$val->id;?>"><?=$val->title;?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback" id="id_bahan_error"></div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-md-6 mb-1">
							<label for="jml_min">Jumlah Min</label>
							<input type="text" name="jml_min" id="jml_min" class="form-control form-control-sm" required>
							<div class="invalid-feedback" id="jml_min_error"></div>
						</div>
						<div class="col-md-6 mb-1">
							<label for="jml_max">Jumlah Max</label>
							<input type="text" name="jml_max" id="jml_max" class="form-control form-control-sm" required>
							<div class="invalid-feedback" id="jml_max_error"></div>
						</div>
					</div>
					<div class="form-group row mb-2">
						<div class="col-md-6">
							<label for="harga_jual">Harga jual</label>
							<input type="text" onkeyup='formatNumber(this)' name="harga_jual" id="harga_jual" class="form-control form-control-sm" required>
							<div class="invalid-feedback" id="harga_jual_error"></div>
						</div>
						<div class="col-md-6">
							<label for="aktif">Aktif </label>
							<select name="aktif" id="aktif" class="form-control form-control-sm" required>
								<option value="">Pilih</option>
								<option value="0">Ya</option>
								<option value="1">Tidak</option>
							</select>
							<div class="invalid-feedback" id="aktif_error"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer p-1">
					<button type="button" name="submit" class="btn btn-info save_harga">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="confirm-delete">
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
	$('.clearR').on('click', function(){
		$('#keywords').val('');
		search_Range();
	});
	$('.save_harga').on('click', function(){
		$('#form_harga').submit();
		
	});
	
	function search_Range(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("produk/cariRange/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('.table-mailcard').loading();
			},
			success: function(html){
				$('#dataRange').on('loading.stop', function(event, loading) {
					$('#dataRange').html(html);
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
	$('#ModRange').on('shown.bs.modal', function() {
		$('.invalid-feedback').html('');
		$(".form-control").removeClass("is-invalid");
	})
	$(document).on('click','.add_harga',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('#ModRange').modal({backdrop: 'static', keyboard: false});
		if(id==0){
			$("#type").val('add');
			return;
			}else{
			$("#type").val('edit');
		}
		$.ajax({
			url: base_url + 'produk/edit_range',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$("body").loading({zIndex:1060});
			},
			success: function(data) {
				$("#id_range").val(data.id);
				$("#bahan").val(data.bahan);
				$("#jml_min").val(data.jml_min);
				$("#jml_max").val(data.jml_max);
				$("#harga_jual").val(data.harga);
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
	$('#bahan').on('change', function() {
		$("#bahan").removeClass("is-invalid").addClass("is-valid");
	});
	$('#aktif').on('change', function() {
		$("#aktif").removeClass("is-invalid").addClass("is-valid");
	});
	$("#jml_min").keyup(function(){
		$("#jml_min").removeClass("is-invalid").addClass("is-valid");
	});
	$("#jml_max").keyup(function(){
		$("#jml_max").removeClass("is-invalid").addClass("is-valid");
	});
	$("#harga_jual").keyup(function(){
		$("#harga_jual").removeClass("is-invalid").addClass("is-valid");
	});
	
	$("#ModRange").on("hidden.bs.modal", function() {
		$('#form_harga')[0].reset();
	});
	
	$('#form_harga').submit(function(e){
		e.preventDefault(); 
		var halaman = $("#halaman").val();
		// var formData = $("#formreg").serialize();
		var formData = new FormData(this);
		
		$.ajax({
			type: "POST",
			url: base_url+"produk/save_range",
			data: formData,
			processData:false,
            contentType:false,
			dataType: 'json',
			beforeSend: function () {
				$("body").loading({zIndex:1060});
			},
			success: function(data) {
				// console.log(data.id_bahan_error)
				$('body').loading('stop');
				if(data.error)
				{
					if(data.id_bahan_error != '')
					{
						$("#bahan").addClass("is-invalid");
						$("#id_bahan_error").html(data.id_bahan_error);
						}else{
						$("#bahan").removeClass("is-invalid").addClass("is-valid");
						$("#id_bahan_error").html('');
					}
					if(data.jml_min_error != '')
					{
						$("#jml_min").addClass("is-invalid");
						$("#jml_min_error").html(data.jml_min_error);
						}else{
						$("#jml_min").removeClass("is-invalid").addClass("is-valid");
						$("#jml_min_error").html('');
					}
					
					if(data.jml_max_error != '')
					{
						$("#jml_max").addClass("is-invalid");
						$("#jml_max_error").html(data.jml_max_error);
						}else{
						$("#jml_max").removeClass("is-invalid").addClass("is-valid");
						$("#jml_max_error").html('');
					}
					if(data.harga_jual_error != '')
					{
						$("#harga_jual").addClass("is-invalid");
						$("#harga_jual_error").html(data.harga_jual_error);
						}else{
						$("#harga_jual").removeClass("is-invalid").addClass("is-valid");
						$("#harga_jual_error").html('');
					}
					if(data.aktif_error != '')
					{
						$("#aktif").addClass("is-invalid");
						$("#aktif_error").html(data.aktif_error);
						}else{
						$("#aktif").removeClass("is-invalid").addClass("is-valid");
						$("#aktif_error").html('');
					}
					return;
					}else{
					search_Range(halaman);
				}
				
				$("#ModRange").modal('hide');
				$('#form_harga')[0].reset();
				} ,error: function(xhr, status, error) {
				showNotif('bottom-right','data error',error,'error');
				$('#form_harga')[0].reset();
				$('body').loading('stop');
			},
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
				search_Range(halaman);
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