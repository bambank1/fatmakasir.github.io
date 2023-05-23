<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data bahan/Jenis</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Bahan</li>
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
							<select id="limits" name="limits" class="form-control custom-select w-1" onchange="search_Bahan()">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sortBy">SORT</span>
							</div>
							<select id="sortBy" class="form-control custom-select w-1" onchange="search_Bahan()">
								<option value="ASC">ASC</option>
								<option value="DESC" selected>DESC</option>
							</select>
							<input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Bahan();"/>
							<div class="input-group-append">
								<button class="btn btn-danger clear" type="button"><i class="fa fa-times"></i> Clear</button>
								<button type="button" class="btn btn-info add_bahan" data-id="0"><i class="fa fa-plus"></i> Tambah</button>
								<button class="btn btn-primary url_doc" data-url="bahan" type="button" data-toggle="tooltip" data-original-title="Dok Bahan Produk" data-placement="left"><i class="fa fa-info-circle"></i></button>
							</div>
						</div>
					</div>
					
					<div class="card-body table-responsive" id="dataBahan">
						<div class="card-block">
							<table class="table table-striped table-mailcard" >
								<thead>
									<tr>
										<th class="w-1 text-center">No</th>
										<th class="w-10">Nama bahan/jenis</th>
										<th class="w-8 text-right">Harga Modal</th>
										<th class="w-8 text-right">Harga Jual</th>
										<th class="w-2">Satuan</th>
										<th class="w-8 text-right">Status | Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($result)){
										$no = 1;
										foreach ($result as $row){
											if ($row->pub == 1){ 
												$aktif ='<i class="fa fa-check-circle"></i>'; 
												$text ='text-white'; 
												}else{ 
												$aktif = '<i class="fa fa-times"></i>'; 
												$text ='text-white-50'; 
											}
											$hapus = '<a class="text-white" data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</a>';
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'><a class='btn-sm add_bahan text-info' title='Edit Data' data-id='".$row->id."' href='#'>".$row->title."</a></td>
											<td class='text-right'>".rp($row->harga_modal)."</td>
											<td class='text-right'>".rp($row->harga)."</td>
											<td>".$row->satuan."</td>
											<td class='text-right'>
											<div class='btn-group btn-group-sm' role='group'>
											<button type='button' class='btn btn-info btn-sm' data-id='".$row->id."'><span class='icon $text'>$aktif</span></button>
											<button type='button' class='btn btn-info btn-sm add_bahan' data-id='".$row->id."'><i class='fa fa-edit'></i> Edit</button>
											<button type='button' class='btn btn-danger btn-sm'>$hapus</button>
											</div>
											</td>
											</tr>";
											$no++;
										} }else{ ?>
										<tr>
											<td colspan="6">Data belum ada</td>
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
				<input type='hidden' name='bahan_id' id='bahan_id' value='0'>
				<input type='hidden' name='type' id="type">
				<input type="hidden" name="id_satuan" id="id_satuan" class="form-control" required>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="judul">Nama bahan/jenis</label>
							<input type="text" name="judul" id="judul" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="harga_modal">Modal</label>
							<input type="text" onkeyup='formatNumber(this)' name="harga_modal" id="harga_modal" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="terendah">Harga Jual Terendah</label>
							<input type="text" onkeyup='formatNumber(this)' name="terendah" id="terendah" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="harga">Harga Jual Tertinggi</label>
							<input type="text" onkeyup='formatNumber(this)' name="tertinggi" id="tertinggi" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="satuan">Satuan</label>
							<input type="text" name="satuan" id="satuan" class="form-control" required>
						</div>
						<label>Aktif </label>
						<div class="form-group d-flex flex-row">
							<select name="aktif" id="aktif" class="form-control custom-select" required>
								<option value="">Pilih</option>
								<option value="1">Ya</option>
								<option value="0">Tidak</option>
							</select>
						</div>	
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" name="submit" class="btn btn-info save_bahan">Simpan [ctrl+s]</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
		search_Bahan();
	});
	
	
	function search_Bahan(page_num){
		page_num = page_num?page_num:0;
		var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		
		var urlnya = '<?php echo base_url("produk/cariBahan/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,keywords:keywords,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('#dataBahan').loading();
			},
			success: function(html){
				$('#dataBahan').html(html);
				$('#halaman').val(page_num);
				$('#dataBahan').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#dataBahan').loading('stop');
			}
		});
	}
	$(document).ready(function() {
		$('input').click(function() {
			this.select();
		});
	});
	
	shortcut.add("ctrl+s",function() {
		$(".save_bahan").click();
	});
	function clearform(){
		$("#bahan_id").val("");
		$("#judul").val("");
		$("#harga_modal").val("");
		$("#terendah").val("");
		$("#tertinggi").val("");
		$("#satuan").val("");
		$("#id_satuan").val("");
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
				$("#bahan_id").val(data.id);
				$("#judul").val(data.judul);
				$("#harga_modal").val(data.modal);
				$("#terendah").val(data.terendah);
				$("#tertinggi").val(data.tertinggi);
				$("#id_satuan").val(data.id_satuan);
				$("#satuan").val(data.satuan);
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
	
	$("#judul").keyup(function(){
		$("#judul").removeClass("is-invalid").addClass("is-valid");
	});
	$("#harga_modal").keyup(function(){
		$("#harga_modal").removeClass("is-invalid").addClass("is-valid");
	});
	$("#terendah").keyup(function(){
		$("#terendah").removeClass("is-invalid").addClass("is-valid");
	});
	$("#tertinggi").keyup(function(){
		$("#tertinggi").removeClass("is-invalid").addClass("is-valid");
	});
	$("#satuan").keyup(function(){
		$("#satuan").removeClass("is-invalid").addClass("is-valid");
	});
	
	$("#satuan").change(function(){
		if($("#satuan").val()=='Data tidak ditemukan'){
			$("#satuan").addClass('is-invalid');
			}else{
			$("#satuan").removeClass("is-invalid").addClass("is-valid");
		}
	});
	
	$("#aktif").change(function(){
		$("#aktif").removeClass("is-invalid").addClass("is-valid");
	});
	$(document).on('click','.save_bahan',function(e){
		e.preventDefault();
		var id = $("#bahan_id").val();
		var type = $("#type").val();
		var judul = $("#judul").val();
		var modal = angka($("#harga_modal").val());
		var terendah = angka($("#terendah").val());
		var tertinggi = angka($("#tertinggi").val());
		var satuan = angka($("#id_satuan").val());
		var aktif = $("#aktif").val();
		var halaman = $("#halaman").val();
		if(judul==''){
			$("#judul").addClass('is-invalid');
			$("#judul").focus();
			return;
		}
		if(modal==''){
			$("#harga_modal").addClass('is-invalid');
			$("#harga_modal").focus();
			return;
		}
		if(terendah==''){
			$("#terendah").addClass('is-invalid');
			$("#terendah").focus();
			return;
		}
		if(tertinggi==''){
			$("#tertinggi").addClass('is-invalid');
			$("#tertinggi").focus();
			return;
		}
		if(satuan==''){
			$("#satuan").addClass('is-invalid');
			$("#satuan").focus();
			return;
		}
		if(aktif==''){
			$("#aktif").addClass('is-invalid');
			$("#aktif").focus();
			return;
		}
		$.ajax({
			url: base_url + 'produk/save_bahan',
			data: {id:id,type:type,judul:judul,modal:modal,terendah:terendah,tertinggi:tertinggi,satuan:satuan,aktif:aktif},
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
				search_Bahan(halaman);
				$('#load-save-bahan').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('#load-save-bahan').loading('stop');
			}
		});
	});
	
	
	$('#satuan').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url + 'produk/ajax',
                dataType: "json",
                method: 'post',
                data: {
                    name_startsWith: request.term,
                    type: 'satuan_table',
                    row_num: 1
				},
                success: function(data) {
                    response($.map(data, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[0],
                            value: code[0],
                            data: item
						}
					}));
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
		},
        autoFocus: true,
        minLength: 0,
        select: function(event, ui) {
            var names = ui.item.data.split("|");
			id_arr = $(this).attr('id');
			id = id_arr.split("_");
            $('#satuan').val(names[0]);
            $('#id_satuan').val(names[1]);
		}
		
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
				search_Bahan(halaman);
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