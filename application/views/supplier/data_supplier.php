<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Supplier</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data Supplier</li>
		</ol>
	</div>
	<div class="card">
		<div class="row">
			<div class="col-md-12">
				<div class="card-header pb-0">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text" for"limits">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Supplier()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text" for="sortBy">SORT</span>
						</div>
						<select id="sortBy" class="form-control custom-select w-1" onchange="search_Supplier()">
							<option value="ASC">ASC</option>
							<option value="DESC" selected>DESC</option>
						</select>
						<input type="text" id="keywords" class="form-control w-50" placeholder="Cari data supplier" onkeyup="search_Supplier();"/>
						<div class="input-group-append">
							<button class="btn btn-danger clear" type="button"><i class="fa fa-times"></i> Clear</button>
							<button type="button" data-toggle="tooltip" title="" data-id="0" class="btn btn-info btn-sm edit_supplier" data-original-title="Tambah Supplier"><i class="fa fa-plus fa-1x"></i> Tambah</button>
							<button class="btn btn-primary url_doc" data-url="supplier" type="button" data-toggle="tooltip" data-original-title="Dok Supplier" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
				<div class="post-list pt-0" id="dataSupplier">
					<div class="card-body table-responsive">
						<div class="card-block">
							<table class="table table-bordered table-striped table-mailcard" id="jsonuser">
								<thead>
									<tr>
										<th style="width:1% !important;">No.</th>
										<th>Nama_Perusahaan</th>
										<th>Atas_Nama</th>
										<th>Jabatan</th>
										<th>No.HP</th>
										<th>Jenis_usaha</th>
										<th>Tgl.Register</th>
										<th style="width:16%;text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($result)){
										$no=1;
										foreach($result as $row){ 
										?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><a href="#" class="edit_supplier text-info" data-id="<?php echo $row["id_supplier"]; ?>"><?php echo $row["nama_perusahaan"]; ?></a></td>
											<td><?=$row["pemilik"];?></td>
											<td><?=$row["jabatan"];?></td>
											<td><?=$row["telp"];?></td>
											<td><?=$row["jenis_usaha"];?></td>
											<td><?=dtimes($row["tgl_terdaftar"],false,false);?></td>
											<td class="text-center">
												<a href="#" class="edit_supplier text-info" data-id="<?php echo $row["id_supplier"]; ?>"><i class='fa fa-edit'></i> Edit</a> | <a class="text-danger" data-id="<?=$row["id_supplier"]; ?>" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash"></i> Hapus</a>
											</td>
										</tr>
									<?php $no++;} }else{ ?>
									<tr>
										<td colspan="8">Data belum ada</td>
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
					<!-- Display posts list -->
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-supplier" class="modal left fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content flat">
            <form role="form" id="form-edit-supplier" method="post">
				<input type="hidden" class="form-control" id="id" name="id" required>
				<input type="hidden" class="form-control" id="type" name="type" required>
				<div class="modal-header bg-danger py-1 flat">
                    <h4 class="modal-title text-light">Data</h4>
				</div>
                <div class="modal-body mb-5 ">
                    <div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label">Nama Perusahaan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="nama_perusahaan" name="nama_perusahaan" required>
						</div>
					</div>
					<div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label">Atas Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="atas_nama" name="atas_nama" required>
						</div>
					</div> 
					<div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label">Jabatan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="jabatan" name="jabatan" required>
						</div>
					</div>
					<div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label">No. HP</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="no_hp" name="no_hp" required>
						</div>
					</div>
					<div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control form-control-sm" id="email" name="email" required>
						</div>
					</div>
					<div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label">Jenis Usaha</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="jenis_usaha" name="jenis_usaha" required>
						</div>
					</div>
					<div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label">No. Rekening</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="no_rekening" name="no_rekening" required>
						</div>
					</div>
                    <div class="form-group row mb-1">
                        <label class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <textarea id="alamat" name="alamat" class="form-control"
                            rows="2" required></textarea>
						</div>
					</div>
				</div>
				
                <div class="right modal-footer p-1">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger tutup-con" data-dismiss="modal">Tutup</button>
				</div>
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
				<button class="btn btn-danger hapus" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="halaman" id="halaman" value="0">
<script>
	$('.clear').on('click', function(){
		$('#keywords').val('');
		search_Supplier();
	});
	var halaman = $("#halaman").val();
	function search_Supplier(page_num){
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var limits = $('#limits').val();
        var urlnya = '<?php echo base_url("supplier/ajaxSupplier/"); ?>'+page_num
        $.ajax({
            type: 'POST',
            url: urlnya,
            data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
            beforeSend: function(){
                $('body').loading();
			},
            success: function(html){
                $('#dataSupplier').html(html);
                $('body').loading('stop');
				},
            error: function(xhr, status, error) {
                var err = xhr.responseText ;
                sweet('Server!!!',err,'error','danger');
                $('body').loading('stop');
			}
		});
	}
	$('#modal-supplier').on('shown.bs.modal', function() {
		$('#nama_perusahaan').focus();
	})
 
	$(function(){
		$(document).fcs(".form-control");
	});
	//add & edit data
	$(document).on('click', '.edit_supplier', function(e) {
        e.preventDefault();
        
        var dataID = $(this).attr('data-id');
		if(dataID > 0){
			$("#type").val('edit');
			$('.modal-title').html('Edit Data');
			$.ajax({
				'url': base_url + 'supplier/get_data',
				'data': {id: dataID},
				'method': 'POST',
				dataType: 'json',
				beforeSend: function(){
					$('body').loading();
				},
				success: function(data) {
					$('#modal-supplier').modal({backdrop: 'static', keyboard: false});
					$('#error_piutang').css('display','none');
					$("#id").val(data.id);
					$("#nama_perusahaan").val(data.nama);
					$("#atas_nama").val(data.pemilik);
					$("#jabatan").val(data.jabatan);
					$("#no_hp").val(data.telp);
					$("#email").val(data.email);
					$("#jenis_usaha").val(data.jenis);
					$("#no_rekening").val(data.rekening);
					$("#alamat").val(data.alamat);
					$("#tgl_terdaftar").val(data.tgl);
					$('.simpan').html('Update');
					$('body').loading('stop');
				},
				error: function(xhr, status, error) {
					var err = xhr.responseText ;
					sweet('Server!!!',err,'error','danger');
					$('body').loading('stop');
				}
			});
			}else{
			$('#modal-supplier').modal('show');
			$('.modal-title').html('Tambah Data');
			$('.simpan').html('Simpan');
			$("#type").val('add');
			$("#id").val(0);
			setTimeout(function (){
				$('#telepon_add').focus();
			}, 1000);
		}
	});
    $("#form-edit-supplier").submit(function(e) {
        e.preventDefault();
        var dataform = $("#form-edit-supplier").serialize();
        $.ajax({
            url: base_url + "supplier/simpan",
            type: "post",
            data: dataform,
            dataType: 'json',
			beforeSend: function(){
                $('body').loading();
			},
            success: function(arr) {
                if (arr.status == 200) {
                    showNotif('bottom-right','Hapus data',arr.msg,'success');
                    }else{
                    sweet('Peringatan!!!',arr.msg,'warning','warning');
				}
                $('#modal-supplier').modal('hide');
				search_Supplier(halaman);
				$("#form-edit-supplier")[0].reset();
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	$(document).on('click','.hapus',function(e){
		var id = $("#data-hapus").val();
		$.ajax({
			url: base_url + 'supplier/hapus',
			data: {type:'hapus',id:id},
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
				$('body').loading('stop');
				search_Supplier(halaman);
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
</script>