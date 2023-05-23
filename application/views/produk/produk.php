<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data produk</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data produk</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12 mb-4">
			<form action="#" method="post">
				<div class="card">
					<div class="card-header pb-0">
						<div class="input-group input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text" for"limits">LIMIT</span>
							</div>
							<select id="limits" name="limits" class="form-control custom-select w-60px" onchange="search_Produk()">
								<option value="12">12</option>
								<option value="24">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-60px" onchange="search_Produk()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<select id="jenis" name="jenis" class="form-control custom-select w-80px" onchange="search_Produk()">
								<option value="">Pilih</option>
								<?php foreach($jenis AS $val){
									echo '<option value="'.$val->id_jenis.'">'.$val->jenis_cetakan.'</option>';
								} ?>
							</select>
							<input type="text" id="keywords" class="form-control w-10" placeholder="Cari data produk" onkeyup="search_Produk();"/>
							<div class="input-group-append">
								<button class="btn btn-danger btn-sm clear_cari" type="button"><i class="fa fa-times"></i> Clear</button>
								<a href="#" data-toggle="modal" data-target="#OpenModal" data-id="0" data-toggle="tooltip" class="btn btn-info btn-sm edit_produk" data-original-title="Tambah Produk"><i class="fa fa-plus fa-1x"></i> Tambah</a>
								<a href="#" data-toggle="modal" data-target="#modalupload" data-id="0" data-toggle="tooltip" class="btn btn-success btn-sm" data-original-title="Import Produk"><i class="fa fa-file-excel-o fa-1x"></i> Import</a>
								<a href="<?=base_url();?>produk/export_produk" data-toggle="tooltip" class="btn btn-info btn-sm" data-original-title="Export Produk"><i class="fa fa-file-excel-o fa-1x"></i> Export</a>
								<a href="<?=base_url();?>produk/export_barcode" data-toggle="tooltip" class="btn btn-success btn-sm" data-original-title="Export Barcode"><i class="fa fa-barcode fa-1x"></i> Export</a>
								<button class="btn btn-primary btn-sm url_doc" data-url="produk" type="button" data-toggle="tooltip" data-original-title="Dok Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					
					<div class="card-body" id="dataProduk">
						<div class="row">
							<?php if(!empty($result)){
								$no = 1;
								
								foreach ($result as $row){
									$barcode = './uploads/barcodes/'.$row['barcode'].'.png';
									if(file_exists($barcode)){
										$barcode = base_url('uploads/barcodes/').$row['barcode'].'.png';
										}else{
										$barcode = base_url('produk/generate/').$row['barcode'];
									}
									if ($row['pub'] == 1){ 
										$aktif ='<i class="fa fa-check-circle"></i>';
										$text ='text-white'; 
										}else{ 
										$aktif = '<i class="fa fa-check-circle-o"></i>';
										$text ='text-white-50'; 
									}
									
									$hapus = '<button type="button"  class="btn btn-danger text-white" data-id="'.$row['id'].'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</button>';
								?>
								<div class="col-md-3 mb-2">
									<div class="card">
										<center><svg id="itf-1<?=$no;?>" class="w-95"></svg></center>
										<script>JsBarcode("#itf-1<?=$no;?>", "<?=$row['barcode'];?>", {format: "itf14"});</script>
										
										<div class="card-body-p">
											<h2 class="name"><?=$row['jenis_cetakan'];?></h2>
											<h4 class="job-title"><?=$row['title'];?></h4>
										</div>
										
										<div class="card-footer-p">
											<div class='btn-group btn-group-sm' role='group'>
												<button type='button' class='btn btn-info btn-sm' data-id="<?=$row["id"];?>"><span class='icon <?=$text;?>'><?=$aktif;?></span></button>
												<button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#OpenModal' data-id="<?=$row["id"];?>" data-mod='edit'><i class='fa fa-edit'></i> Edit</button><?=$hapus;?>
											</div>
										</div>
									</div>
								</div>										
								<?php
									$no++;
								}
								
							}else{ ?>
							
							<?php } ?>
							
						</div><!-- /.card-body -->
						<nav aria-label="Page navigation" class="mt-2">
							<?php 
								echo $this->ajax_pagination->create_links(); 
							?>
						</nav>
					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</form>
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
				<button class="btn btn-danger hapus_produk" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="OpenModal" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="ProdukLabel">Tambah Produk</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<div class="view-data"></div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-success simpan_produk" onclick="submit_produk()" type="button">Simpan</button> 
			</div>
		</div>
	</div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalupload" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="">Import Produk</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<form id="formUpload">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="">Upload</span>
						</div>
						<div class="custom-file">
							<input type="file" name="filess" id="filess" class="custom-file-input" >
							<label class="custom-file-label" for="filess">Choose file</label>
						</div>
					</div>
					
				</form>
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-success upload-file"  type="submit">Import</button> 
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="halaman" id="halaman" value="0">
<script>
	
	
	setInterval(function() {
        $('body').loading('stop');
	}, 1000);
	$(".upload-file").click(function(){
		var file = document.getElementById("filess");
		// $('body').loading('stop');
		if(file.files.length == 0 ){
			alert('Upload, File masih kosong!', 'warning')
			return;
		}
		
		$('#formUpload').submit();
	}); 
	$('#formUpload').submit(function(e){
        e.preventDefault(); 
        
        // var formData = $("#formreg").serialize();
        var formData = new FormData(this);
		
        $.ajax({
            type: "POST",
            url: base_url+"produk/import_data",
            dataType: 'json',
            data: formData,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            beforeSend: function () {
				$('body').loading();
			},
            success: function(data) {
                // console.log(data);
				
                if(data.status==200){
                    searchFilter();
				}
                $('#formUpload')[0].reset();
                $("#modalupload").modal('hide');
				$('.custom-file-label').html('');
				search_Produk();
				$('body').loading('stop');
                } ,error: function(xhr, status, error) {
                // showNotif('bottom-right','Inport data error',error,'error');
                $('#formUpload')[0].reset();
                $('.custom-file-label').html('');
				
				$('body').loading('stop');
			},
		});
	});
	function submit_produk(){
		var halaman = $("#halaman").val();
		 
		var dataform = $("#formproduk").serialize();
		$.ajax({
            type: "POST",
            url: base_url+"produk/save_produk",
            dataType: 'json',
            data: dataform,
			cache: false,
            beforeSend: function () {
                $('body').loading();　
			},
            success: function(data) {
				
                $('body').loading('stop');
                if(data.status==200){
                    showNotif('bottom-right','Simpan data',data.msg,'success');
					$("#OpenModal").modal('hide');
					search_Produk(halaman);
                    }else{
					cfNotif(data['alert']);
                    // showNotif('bottom-right','Simpan data',data.msg,'error');
				}
				
                } ,error: function(xhr, status, error) {
                showNotif('top-right','Simpan data',error,'error');
                $('body').loading('stop');
			}
		});
		
	}
	
	function cfNotif(data){
		Noty.overrideDefaults({
			theme: 'default',
			layout: 'topRight',
			type: 'alert',
			timeout: 4000
			
		});   
		new Noty({
			type: data['type'],
			text: data['content'],
		}).show();
	}
	
	$('#OpenModal').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).data('id');
		var mod = $(e.relatedTarget).data('mod');
		// console.log(mod)
		// return;
		if(id > 0){
			var urldata = "edit_produk";
			var tipe = 'edit';
			$("#ProdukLabel").html('Edit produk');
			}else{
			var urldata = "tambah_produk";
			var tipe = 'add';
			$("#ProdukLabel").html('Tambah produk');
		}
		$.ajax({
			type: 'POST',
			url: base_url + "produk/"+urldata,
			data: {tipe:tipe,id:id,mod:mod},
			dataType: "html",
			beforeSend: function () {
				$('body').loading();　
			},
			success: function(data) {
				$('.view-data').html(data);
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	});
	$('#OpenModal').on('shown.bs.modal', function() {
		$('#nama').focus();
	})
	
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
		
		//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
	});
	$('button.btn-default').on('click', function(e){
		if ($(this).attr("value")=='kirim')
		$('#confirm .modal-body').html('Anda yakin ingin mengirimnya');
		else
		$('#confirm .modal-body').html('unBlokir User');
		
		var $form=$(this).closest('form');
		e.preventDefault();
		$('#confirm').modal({ backdrop: 'static', keyboard: false })
		.one('click', '#delete', function (e) {
			$form.trigger('submit');
		});
	});
	
	$('.clear_cari').on('click', function(){
		$('#keywords').val('');
		$('#jenis').val('');
		$('#limits').val(10);
		search_Produk();
	});
	
	
	function search_Produk(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		var jenis = $('#jenis').val();
		$.ajax({
			type: 'POST',
			url: base_url+"produk/cariproduk/"+page_num,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits,jenis:jenis},
			beforeSend: function(){
				$('.loadings').show();
			},
			success: function(html){
				$('#halaman').val(page_num);
				$('#dataProduk').html(html);
				$('.loadings').fadeOut("slow");
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$(".loadings").hide();
			}
		});
	}
	
	$(document).on('click','.hapus_produk',function(e){
		e.preventDefault();
		var id = $("#data-hapus").val();
		var halaman = $("#halaman").val();
		$.ajax({
			url: base_url + 'produk/hapus_produk',
			data: {type:'hapus',id:id},
			method: 'POST',
			dataType:'json',
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right','Hapus data',data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				$('#confirm-delete').modal('hide');
				search_Produk(halaman);
			}
		});
	});
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$('#data-hapus').val($(e.relatedTarget).data('id'));
	});
</script>	
<style>
	.card .table td, .card .table th {
	padding-right: 1rem;
	padding-left: 1rem;
	}
</style>	