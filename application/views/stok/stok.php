<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data stok barang</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">stok barang</li>
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
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Stok()">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Stok()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Stok();"/>
							<div class="input-group-append">
								<button class="btn btn-danger clear_stok" type="button"><i class="fa fa-times"></i> Clear</button>
								<!--button type="button" class="btn btn-info add_bahan" data-id="0"><i class="fa fa-plus"></i> Tambah</button-->
								<button type="button"  class="btn btn-secondary btn-sm print_stok flat" id="print_stok" data-toggle="tooltip" data-original-title="Print PDF"><i class="fa fa-file-pdf-o fa-1x"></i> Print</button>
								<button class="btn btn-primary url_doc" data-url="stok" type="button" data-toggle="tooltip" data-original-title="Dok Bahan Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					
					<div class="card-body table-responsive" id="dataStok">
						<div class="card-block">
							<table class="table table-striped table-mailcard" >
								<thead>
									<tr>
										<th class="w-1 text-center">No</th>
										<th class="w-10 pl-1">Merk</th>
										<th class="w-8 text-right">Stok Masuk</th>
										<th class="w-8 text-right">Stok Keluar</th>
										<th class="w-10 text-right">Total Stok</th>
										<!--th class="w-8 text-right">Aksi</th-->
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
											$detail = "<td class='text-right'>
											<div class='btn-group btn-group-sm' role='group'>
											<button type='button' class='btn btn-info btn-sm add_bahan' data-id='".$row->id."'><i class='fa fa-search'></i> Detail</button>
											
											</div>
											</td>";
											$hapus = '<a class="text-white" data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</a>';
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'>".$row->title."</td>
											<td class='text-right'>".$jml_masuk."</td>
											<td class='text-right'>".$jml_keluar."</td>
											<td class='text-right'>".$total."</td>
											</tr>";
											$no++;
										} }else{ ?>
										<tr>
											<td colspan="7">Data belum ada</td>
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
				<h5 class="modal-title" id="exampleModalScrollableTitle">Bahan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" >
				<input type="hidden" name="type" id="type" class="form-control" required>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="judul">Nama Barang</label>
							<select class="form-control select-box" id="bahan_stok">
								<option value="">Pilih bahan</option>
								<?php foreach($bahan AS $val){ ?>
									<option value="<?=$val->id;?>"><?=$val->title;?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="harga_modal">Harga Beli</label>
							<input type="text" onkeyup='formatNumber(this)' name="harga_beli" id="modal_stok" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="terendah">Harga Jual</label>
							<input type="text" onkeyup='formatNumber(this)' name="harga_jual" id="tertinggi_stok" class="form-control" required>
						</div>
						
						<div class="form-group">
							<label for="jumlah">Jumlah Beli</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" required>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_stok">Simpan [ctrl+s]</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="halaman" id="halaman" value="0">
<form method="POST" action="<?=base_url();?>laporan/cetak_stok_bahan" id="target_print_stok" target="_blank">
	<input type="hidden" name="sortby_cetak" id="sortby_cetak" readonly  />
	<input type="hidden" name="trx_cetak" id="trx_cetak" readonly />
	<input type="hidden" name="tanggal_cetak" id="tanggal_cetak" readonly  />
</form>
<script>
	$("#print_stok").click(function(e) {
		e.preventDefault();
		$( "#target_print_stok" ).submit();
	});
	$(".select-box").chosen();
	// $('.chosen-search input').autocomplete({
	// source: function( request, response ) {
	// $.ajax({
	// url: base_url+"stok/bahan/?name="+request.term,
	// data:{name:request.term},
	// dataType: "json",
	// success: function( data ) {
	
	// $('.select-box').empty();
	// response( $.map( data, function( item ) {
	
	// $('.select-box').append('<option value="'+item.id+'">' + item.name + '</option>');
	
	// }));
	// $(".select-box").trigger("chosen:updated");
	// }
	// });
	// }
	// });
	
	$('.clear_stok').on('click', function(){
		$('#keywords').val('');
		search_Stok();
	});
	
	
	function search_Stok(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("stok/cariStok/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('#dataStok').loading();
			},
			success: function(html){
				$('#dataStok').html(html);
				$('#halaman').val(page_num);
				$('#dataStok').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#dataStok').loading('stop');
			}
		});
	}
	$(document).ready(function() {
		$('input').click(function() {
			this.select();
		});
	});
	
	shortcut.add("ctrl+s",function() {
		$(".save_stok").click();
	});
	function clearform(){
		$("#bahan_id").val("");
		$("#judul").val("");
		$("#harga_modal").val("");
		$("#terendah").val("");
		$("#tertinggi").val("");
		$("#satuan").val("");
		$("#id_satuan").val("");
		$("#stok").val("");
		$("#aktif").val("");
	}
	
	$('#ModalBahan').on('shown.bs.modal', function() {
		$('#judul').focus();
	})
	$(function(){
		$(document).fcs(".form-control");
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
		$.ajax({
			url: base_url + 'produk/edit_bahan',
			data: {type:'edit',id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				console.log(data.id)
				$("#bahan_stok").val(data.id).trigger("chosen:updated");
				$("#judul").val(data.judul);
				$("#modal_stok").val(data.modal);
				$("#terendah_stok").val(data.terendah);
				$("#tertinggi_stok").val(data.tertinggi);
				$("#id_satuan").val(data.id_satuan);
				$("#satuan").val(data.satuan);
				$("#stok").val(data.stok);
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
	$("#bahan").change(function(){
		if($("#bahan").val()==''){
			$("#bahan").addClass('is-invalid');
			}else{
			$("#bahan").removeClass("is-invalid").addClass("is-valid");
		}
	});
	$("#harga_beli").keyup(function(){
		$("#harga_beli").removeClass("is-invalid").addClass("is-valid");
	});
	$("#harga_jual").keyup(function(){
		$("#harga_jual").removeClass("is-invalid").addClass("is-valid");
	});
	$("#jumlah").keyup(function(){
		$("#jumlah").removeClass("is-invalid").addClass("is-valid");
	});
	
	$(document).on('click','.save_stok',function(e){
		e.preventDefault();
		var id = $("#bahan_stok").val();
		var type = $("#type").val();
		var bahan = $("#bahan").val();
		var harga_beli = angka($("#modal_stok").val());
		var harga_jual = angka($("#tertinggi_stok").val());
		var jumlah = angka($("#jumlah").val());
		
		var halaman = $("#halaman").val();
		if(bahan==''){
			$("#bahan_stok").addClass('is-invalid');
			$("#bahan_stok").focus();
			return;
		}
		if(harga_beli==''){
			$("#modal_stok").addClass('is-invalid');
			$("#modal_stok").focus();
			return;
		}
		if(harga_jual==''){
			$("#tertinggi_stok").addClass('is-invalid');
			$("#tertinggi_stok").focus();
			return;
		}
		if(jumlah==''){
			$("#jumlah").addClass('is-invalid');
			$("#jumlah").focus();
			return;
		}
		
		$.ajax({
			url: base_url + 'stok/save_stok',
			data: {id:id,type:type,bahan:bahan,harga_beli:harga_beli,harga_jual:harga_jual,jumlah:jumlah},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('#load-save-bahan').loading({zIndex:1060,theme:'dark'});
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right','Hapus data',data.msg,'success');
					$('#ModalBahan').modal('hide');
					}else{
					sweet('Peringatan!!!','Data gagal disimpan','warning','warning');
				}
				$('#confirm-delete').modal('hide');
				search_Stok(halaman);
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
				search_Stok(halaman);
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