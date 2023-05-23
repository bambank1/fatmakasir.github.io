<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?=$judul;?></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$judul;?></li>
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
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Stok_Keluar()">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Stok_Keluar_Keluar()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Stok_Keluar();"/>
							<div class="input-group-append">
								<button class="btn btn-danger clear_search" type="button"><i class="fa fa-times"></i> Clear</button>
								<button type="button" class="btn btn-info add_bahan" data-id="0"><i class="fa fa-plus"></i> Input</button>
								<button class="btn btn-primary url_doc" data-url="bahan" type="button" data-toggle="tooltip" data-original-title="Dok Bahan Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					
					<div class="card-body table-responsive" id="dataStokKeluar">
						<div class="card-block">
							<table class="table table-striped table-mailcard" >
								<thead>
									<tr>
										<th class="w-1 text-center">No</th>
										<th class="w-10 pl-1">Nama bahan</th>
										<th class="w-8 text-right">Stok Keluar</th>
										<th class="w-8 text-right">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($result)){
										$no = 1;
										$total = 0;
										foreach ($result as $row){
											
											$jml_masuk = stok_masuk($row->id);
											$jml_keluar = stok_keluar($row->id);
											$total = $jml_masuk - $jml_keluar;
											
											$disabled = '';
											if($jml_keluar <=0 ){
												$disabled = 'disabled';
											}
											
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'>".$row->title."</td>
											<td class='text-right'>".$jml_keluar."</td>
											<td class='text-right'>
											<div class='btn-group btn-group-sm' role='group'>
											<button type='button' class='btn btn-info btn-sm detail_bahan' data-id='".$row->id."' data-title='".$row->title."' ".$disabled."><i class='fa fa-search'></i> Detail</button>
											
											</div>
											</td>
											</tr>";
											$no++;
										} }else{ ?>
										<tr>
											<td colspan="4">Data belum ada</td>
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
<div id="ModalBahan" class="modal left fade" role="dialog">
    <div class="modal-dialog" id="load-save-bahan">
        <div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Stok Keluar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
				<input type="hidden" name="type" id="type" class="form-control" required>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="bahan">Nama barang/jenis</label>
							<select class="form-control pakainfo select-box" id="bahan">
								<option value="">Pilih bahan</option>
								<?php foreach($bahan AS $val){ ?>
									<option value="<?=$val->id;?>"><?=$val->title;?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="harga_beli">Harga Beli</label>
							<input type="text"  name="harga_beli" id="harga_beli" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="harga_jual">Harga Jual</label>
							<input type="text"  name="harga_jual" id="harga_jual" class="form-control" readonly>
						</div>
						
						<div class="form-group">
							<label for="total">Jumlah Stok</label>
							<div class="input-group input-group-sm">
								<input type="text" name="total" id="total" class="form-control" readonly>
								<div class="input-group-append">
									<span class="input-group-text" id="satuan"></span>
								</div>
							</div>
							
						</div>
						
						<div class="form-group">
							<label for="jumlah">Stok Keluar</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" required>
						</div>
						
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" name="keterangan" id="keterangan" class="form-control" required>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_stok_keluar">Simpan [ctrl+s]</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="ModalDetail" class="modal modal-fullscreen-xl fade" role="dialog">
    <div class="modal-dialog" id="load-save-bahan">
        <div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalScrollableTitle">Detail Stok Keluar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body detail"></div>
			<div class="modal-footer">
				<a href="" target="_blank" id="cetak" class="btn btn-info btn-icon-split flat btn-sm">
					<span class="icon text-white-50" >
						<i class="fa fa-print fa-fw"></i>
					</span>
					<span class="text">Cetak Laporan</span>
				</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="halaman" id="halaman" value="0">
<script>
	$(".select-box").chosen();
	
	$('.clear_search').on('click', function(){
		$('#keywords').val('');
		search_Stok_Keluar();
	});
	
	
	function search_Stok_Keluar(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("stok/cariStokKeluar/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('#dataStokKeluar').loading();
			},
			success: function(html){
				$('#dataStokKeluar').html(html);
				$('#halaman').val(page_num);
				$('#dataStokKeluar').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#dataStokKeluar').loading('stop');
			}
		});
	}
	$(document).ready(function() {
		$('input').click(function() {
			this.select();
		});
	});
	
	shortcut.add("ctrl+s",function() {
		$(".save_stok_keluar").click();
	});
	function clearform(){
		$("#bahan").val("");
		$("#harga_beli").val("");
		$("#harga_jual").val("");
		$("#total").val("");
		$("#satuan").val("");
		$("#id_satuan").val("");
		$("#jumlah").val("");
	}
	
	
	$(function(){
		$(document).fcs(".form-control");
	});
	
	$(document).on('click','.detail_bahan',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var title = $(this).attr('data-title');
		$('.form-control').addClass('form-control-sm');
		$('.form-group').css('margin-bottom','5px');
		$('#ModalScrollableTitle').html('Detail Stok keluar bahan '+ title);
		$('#ModalDetail').modal('show');
		$("#cetak").attr("href", base_url+"stok/cetak_stok_keluar/"+id+"/?type=pdf")
		$.ajax({
			url: base_url + 'stok/detail_stok_keluar',
			data: {type:'detail',id:id},
			method: 'POST',
			
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				
				$('.detail').html(data);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	$(document).on('click','.add_bahan',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('.form-control').addClass('form-control-sm');
		$('.form-group').css('margin-bottom','5px');
		clearform();
		$('#ModalBahan').modal('show');
		if(id==0){
            $("#type").val('add');
			return
			}else{
            $("#type").val('edit');
		}
	});
	$(document).on('change','#bahan',function(e){
		e.preventDefault();
		var id = $(this).val();
		// console.log(id);
		// return
		
		$.ajax({
			url: base_url + 'produk/edit_bahan',
			data: {type:'edit',id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				console.log(data);
				$("#bahan_id").val(data.id);
				$("#harga_beli").val(data.modal);
				$("#harga_jual").val(data.tertinggi);
				$("#id_satuan").val(data.id_satuan);
				$("#satuan").html(data.satuan);
				$("#total").val(data.total);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	$("#bahan").change(function(){
		if($("#bahan").val()==''){
			$("#bahan").addClass('is-invalid');
			}else{
			$("#bahan").removeClass("is-invalid").addClass("is-valid");
		}
	});
	
	$("#jumlah").keyup(function(){
		$("#jumlah").removeClass("is-invalid").addClass("is-valid");
	});
	$("#keterangan").keyup(function(){
		$("#keterangan").removeClass("is-invalid").addClass("is-valid");
	});
	
	$(document).on('click','.save_stok_keluar',function(e){
		e.preventDefault();
		var type = $("#type").val();
		var bahan = $("#bahan").val();
		var harga_beli = angka($("#harga_beli").val());
		var harga_jual = angka($("#harga_jual").val());
		var total = angka($("#total").val());
		var jumlah = angka($("#jumlah").val());
		var keterangan = angka($("#keterangan").val());
		
		var halaman = $("#halaman").val();
		if(bahan==''){
			$("#bahan").addClass('is-invalid');
			$("#bahan").focus();
			return;
		}
		if(harga_beli==''){
			$("#harga_beli").addClass('is-invalid');
			$("#harga_beli").focus();
			return;
		}
		if(harga_jual==''){
			$("#harga_jual").addClass('is-invalid');
			$("#harga_jual").focus();
			return;
		}
		if(jumlah==''){
			$("#jumlah").addClass('is-invalid');
			$("#jumlah").focus();
			return;
		}
		if(parseInt(jumlah) > parseInt(total)){
			showNotif('top-right','Warning stok','Stok keluar melebihi stok','warning');
			$("#jumlah").focus();
			return
		}
		$.ajax({
			url: base_url + 'stok/save_stok_keluar',
			data: {type:type,bahan:bahan,harga_beli:harga_beli,harga_jual:harga_jual,jumlah:jumlah},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('#load-save-bahan').loading({zIndex:1060,theme:'dark'});
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right','Stok keluar',data.msg,'success');
					$('#ModalBahan').modal('hide');
					}else{
					sweet('Peringatan!!!','Data gagal disimpan','warning','warning');
				}
				$('#confirm-delete').modal('hide');
				search_Stok_Keluar(halaman);
				$('#load-save-bahan').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#load-save-bahan').loading('stop');
			}
		});
	});
	
	$(document).on('click','.hapus',function(e){
		e.preventDefault();
		var id = $("#data-hapus").val();
		var halaman = $("#halaman").val();
		$.ajax({
			url: base_url + 'produk/hapus_bahan',
			method: 'POST',
			dataType:'json',
			data:{id:id,type:"hapus"},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				if(data.status==200){
					$('#confirm-delete').modal('hide');
					sweet_time(500,'Status!!!',data.msg);
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				search_Stok_Keluar(halaman);
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
</script>
<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>