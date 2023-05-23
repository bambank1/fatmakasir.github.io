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
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Stok_Masuk()">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Stok_Masuk_Keluar()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Stok_Masuk();"/>
							<div class="input-group-append">
								<button class="btn btn-danger clear_search" type="button"><i class="fa fa-times"></i> Clear</button>
								<a href="<?=base_url('pembelian/data');?>" class="btn btn-info add_bahan" data-id="0"><i class="fa fa-plus"></i> Tambah</a>
								<button class="btn btn-primary url_doc" data-url="bahan" type="button" data-toggle="tooltip" data-original-title="Dok Bahan Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					
					<div class="card-body table-responsive" id="dataStokMasuk">
						<div class="card-block">
							<table class="table table-striped table-mailcard" >
								<thead>
									<tr>
										<th class="w-1 text-center">No</th>
										<th class="w-10 pl-1">Nama bahan</th>
										<th class="w-8 text-right">Stok Masuk</th>
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
											if($jml_masuk <=0 ){
												$disabled = 'disabled';
											}
											 
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'>".$row->title."</td>
											<td class='text-right'>".rp($jml_masuk)."</td>
											<td class='text-right'>
											<div class='btn-group btn-group-sm' role='group'>
											<button type='button' class='btn btn-info btn-sm detail_stok_masuk' data-id='".$row->id."' data-title='".$row->title."' ".$disabled."><i class='fa fa-search'></i> Detail</button>
											
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
							<label for="bahan">Nama bahan/jenis</label>
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

<div id="ModalStokMasuk" class="modal modal-fullscreen-xl fade" role="dialog">
    <div class="modal-dialog" id="load-save-bahan">
        <div class="modal-content flat">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalScrollableTitle">Detail Stok Keluar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body detail" >
				
			</div>
			<div class="modal-footer">
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
		search_Stok_Masuk();
	});
	
	
	function search_Stok_Masuk(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("stok/cariStokMasuk/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('#dataStokMasuk').loading();
			},
			success: function(html){
				$('#dataStokMasuk').html(html);
				$('#halaman').val(page_num);
				$('#dataStokMasuk').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#dataStokMasuk').loading('stop');
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
	
	$(document).on('click','.detail_stok_masuk',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var title = $(this).attr('data-title');
		$('.form-control').addClass('form-control-sm');
		$('.form-group').css('margin-bottom','5px');
		$('#ModalScrollableTitle').html('Detail Stok keluar bahan '+ title);
		$('#ModalStokMasuk').modal('show');
		
		$.ajax({
			url: base_url + 'stok/detail_stok_masuk',
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
	  
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$('#data-hapus').val($(e.relatedTarget).data('id'));
	});
</script>
<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>