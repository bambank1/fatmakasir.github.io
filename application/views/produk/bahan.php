<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Harga produk</h1>
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
								<button class="btn btn-danger clear_bahan" type="button"><i class="fa fa-times"></i> Clear</button>
								<button type="button" class="btn btn-info add_bahan" data-id="0"><i class="fa fa-plus"></i> Tambah</button>
								<button type="button"  class="btn btn-secondary btn-sm print_order flat" id="print_bahan" data-toggle="tooltip" data-original-title="Print PDF"><i class="fa fa-file-pdf-o fa-1x"></i> Print</button>
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
										<th>Nama Barang/Merk</th>
										<th class="">Kategori</th>
										<th class="w-8 text-right">Harga_Beli</th>
										<th class="w-2 text-right">Jml.Stok</th>
										<th class="w-2">Satuan</th>
										<th class="w-2 text-center">Stok</th>
										<th class="w-20 text-right">Status | Aksi</th>
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
											if ($row->status_stok == 'Y'){ 
												$stok ='<i class="fa fa-check-circle"></i>'; 
												}else{ 
												$stok = '<i class="fa fa-times"></i>'; 
											}
											$jml_masuk = stok_masuk($row->id) - stok_keluar($row->id);
											$hapus = '<button type="button" class="btn btn-danger btn-sm text-white"  data-id="'.$row->id.'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</button>';
											echo "<tr><td class='text-center'>$no</td>
											<td class='pl-1'><a class='btn-sm add_bahan text-info' title='Edit Data' data-id='".$row->id."' href='#'>".$row->title."</a></td>
											<td class='text-left'>".jenis_cetakan($row->id_jenis)."</td>
											<td class='text-right'>".rp($row->harga_modal)."</td>
											<td class='text-right'>".rp($jml_masuk)."</td>
											<td>".$row->satuan."</td>
											<td class='text-center'>".$stok."</td>
											<td class='text-right'>
											<div class='btn-group btn-group-sm' role='group'>
											<button type='button' class='btn btn-success btn-sm menu_harga' data-type='".$row->type_harga."' data-id='".$row->id."' data-toggle='tooltip' data-original-title='Pengaturan Harga' data-placement='left'><span class='icon'><i class='fa fa-bars'></i></span></button>
											<button type='button' class='btn btn-info btn-sm' data-id='".$row->id."'><span class='icon $text'>$aktif</span></button>
											<button type='button' class='btn btn-info btn-sm add_bahan' data-id='".$row->id."'><i class='fa fa-edit'></i> Edit</button>
											$hapus
											</div>
											</td>
											</tr>";
											$no++;
										} }else{ ?>
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
				</div><!-- /.card -->
			</form>
		</div>
	</div>
</div>
<div id="ModalBahan" class="modal left fade" role="dialog">
    <div class="modal-dialog" id="load-save-bahan">
        <div class="modal-content flat">
			<div class="modal-header pt-1 pb-1">
				<h5 class="modal-title" id="exampleModalScrollableTitle">Nama Barang/Merk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-2" id="LoadingBahan">
				<input type='hidden' name='bahan_id' id='bahan_id' value='0'>
				<input type='hidden' name='type' id="type">
				<input type="hidden" name="id_satuan" id="id_satuan" class="form-control" required>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group mb-0">
							<label for="judul">Nama Barang/Merk</label>
							<input type="text" name="judul" id="judul" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<label for="kategori">Kategori</label>
							<select name="kategori" id="kategori" class="form-control custom-select" required>
								<option value="">Pilih</option>
								<?php foreach($kategori AS $val){ ?>
									<option value="<?=$val->id_jenis;?>"><?=$val->jenis_cetakan;?></option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group row">
							<div class="col-md-12">
								<label>Hitung Ukuran</label>
								<select name="ukuran" id="ukuran" class="form-control custom-select" required>
									<option value="1">Ya</option>
									<option value="0" selected>Tidak</option>
								</select>
							</div>	
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label for="harga_modal">Harga Beli</label>
								<input type="text" onkeyup='formatNumber(this)' name="harga_modal" id="harga_modal" class="form-control form-control-sm" required>
							</div>
							
							<div class="col-md-6">
								<label for="satuan">Satuan</label>
								<input type="text" name="satuan" id="satuan" class="form-control" required>
							</div>
							
						</div>	
						<div class="form-group row">
							<div class="col-md-6">
								<label>Stok </label>
								<select name="stok" id="stok" class="form-control custom-select" required>
									<option value="">Pilih</option>
									<option value="Y">Ya</option>
									<option value="N">Tidak</option>
								</select>
							</div>	
							<div class="col-md-6">
								<label>Aktif </label>
								<select name="aktif" id="aktif" class="form-control custom-select" required>
									<option value="">Pilih</option>
									<option value="1">Ya</option>
									<option value="0">Tidak</option>
								</select>
							</div>	
							<div class="col-md-12 jenis" style="display:none">
								<label>Jenis Bahan/Barang </label>
								<select name="jenis" id="jenis" class="form-control custom-select" required>
									<option value="0">Barang/Bahan Baku</option>
									<option value="1">Barang/Bahan Jadi</option>
								</select>
							</div>	
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

<div id="ModalHarga" class="modal fade modal-fullscreen-xl" role="dialog">
    <div class="modal-dialog" id="load-save-bahan">
        <div class="modal-content flat">
			<div class="modal-header pt-1 pb-1">
				<h5 class="modal-title" id="TitleHarga">Pengaturan Harga</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-2" id="LoadingBahan">
				<div class="tab-vertical">
					<ul class="nav nav-tabs shadow-none" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active"  data-toggle="tab" href="#tab_1" role="tab" aria-controls="satu" aria-selected="true">
							<input type="radio" radio-id="radio_1" id="radio_1"  name="tabs" value="1"> Satu harga</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab_2" role="tab" aria-controls="satuan" aria-selected="false"><input type="radio" radio-id="radio_2"  id="radio_2" name="tabs" value="2"> Berdasarkan satuan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab_3" role="tab" aria-controls="level" aria-selected="false"><input type="radio" radio-id="radio_3"  id="radio_3" name="tabs" value="3"> Berdasarkan level</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  data-toggle="tab" href="#tab_4" role="tab" aria-controls="jumlah" aria-selected="false"><input type="radio" radio-id="radio_4" id="radio_4" name="tabs" value="4"> Berdasarkan jumlah</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  data-toggle="tab" href="#tab_5" role="tab" aria-controls="range" aria-selected="false"><input type="radio" radio-id="radio_5" id="radio_5" name="tabs" value="5"> Berdasarkan jumlah & Level</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent3">
						<input type="hidden" name="id_harga_menu" id="id_harga_menu" readonly  />
						<div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="harga-satu-tab">
							<h5>Satu Harga</h5>
							<div class="form-group row">
								<label for="load_satuan" class="col-sm-3 col-form-label">Satuan Dasar</label>
								<div class="col-sm-9">
									<select name="load_satuan" id="load_satuan" class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" onchange="save_satu_harga()" required>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="harga_pokok" class="col-sm-3 col-form-label">Harga Pokok</label>
								<div class="col-sm-2">
									<input type="text" name="harga_pokok" id="harga_pokok" class="form-control" onchange="hitung();" required>
								</div>
								<div class="col-sm-1">
									<input type="text" name="persen" id="persen" class="form-control" onchange="hitung()" required>
								</div>
								<div class="col-sm-2">
									% = Harga Jual
								</div>
								<div class="col-sm-4">
									<input type="text" name="harga_jual" id="harga_jual" class="form-control" onchange="save_satu_harga()" required>
								</div>
							</div>
							
						</div>
						<div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="harga-satuan-tab">
							<h5>Berdasarkan Satuan</h5>
							<div id="load_satuan_harga"></div>
						</div>
						<div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="harga-level-tab">
							<h5>Berdasarkan level</h5>
							<div id="load_harga_level"></div>
						</div>
						<div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="harga-jumlah-tab">
							<h5>Berdasarkan Jumlah</h5>
							<div id="load_range"></div>
						</div>
						<div class="tab-pane fade" id="tab_5" role="tabpanel" aria-labelledby="harga-range-tab">
							<h5>Berdasarkan Jumlah & Level</h5>
							<div id="load_range_level"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
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
<form method="POST" action="<?=base_url();?>laporan/cetak_data_bahan" id="target_print_bahan" target="_blank">
	<input type="hidden" name="sortby_cetak" id="sortby_cetak" readonly  />
	<input type="hidden" name="trx_cetak" id="trx_cetak" readonly />
	<input type="hidden" name="tanggal_cetak" id="tanggal_cetak" readonly  />
</form>
<script>
	$("#ModalHarga").on("hidden.bs.modal", function() {
		search_Bahan();
	});
	
	$(document).ready(function() {
		
      	$("#stok").change(function(){
			if($("#stok").val()=='Y'){
				$(".jenis").show();
				}else{
				$(".jenis").hide();
			}
		});
		
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href") 
            if (target == '#tab_1') {
				$("#radio_1").prop("checked", true);
				var radio1 = $("#radio_1").val();
				
				save_tab(1);
			}
			if (target == '#tab_2') {
				$("#radio_2").prop("checked", true);
				var radio2 = $("#radio_2").val();
				save_tab(2);
			}
            if (target == '#tab_3') {
				$("#radio_3").prop("checked", true);
				var radio3 = $("#radio_3").val();
				save_tab(3);
                
			}
            if (target == '#tab_4') {
				$("#radio_4").prop("checked", true);
				var radio4 = $("#radio_4").val();
				save_tab(4);
			}
			if (target == '#tab_5') {
				$("#radio_5").prop("checked", true);
				var radio5 = $("#radio_5").val();
				save_tab(5);
			}
            
		});
        
	});
	
	
	$("#print_bahan").click(function(e) {
		e.preventDefault();
		$( "#target_print_bahan" ).submit();
	});
	$('.clear_bahan').on('click', function(){
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
	function hitung(){
		var harga_pokok = $('#harga_pokok').val();
		var persen = $('#persen').val();
		var total = (parseInt(harga_pokok) * parseInt(persen)) / 100;
		var harga_jual = parseInt(harga_pokok) + parseInt(total);
		$('#harga_jual').val(harga_jual);
		save_satu_harga();
	}
	
	function save_tab(idtab)
	{
		var id = $('#id_harga_menu').val();
		// console.log(idtab)
		$.ajax({
			url: base_url + 'produk/save_tab',
			data: {id:id,idtab:idtab},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$("body").loading({zIndex:1060});
			},
			success: function(data) {
				// console.log(idtab)
				if(idtab==1){
					load_satuan(data.id)
					load_satu_harga(id)
				}
				if(idtab==2){
					load_satuan(data.id)
					load_satuan_harga(id)
				}
				if(idtab==3){
					load_satuan(data.id)
					load_harga_level(id)
				}
				if(idtab==4){
					load_range(id)
				}
				if(idtab==5){
					load_range_level(id)
				}
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	}
	
	function save_satu_harga()
	{
		var id = $('#id_harga_menu').val();
		var tab = 1;
		var satuan = $('#load_satuan').val();
		var harga_pokok = $('#harga_pokok').val();
		var persen = $('#persen').val();
		var harga_jual = $('#harga_jual').val();
		$.ajax({
			url: base_url + 'produk/save_satu_harga',
			data: {id:id,tab:tab,satuan:satuan,harga_pokok:harga_pokok,persen:persen,harga_jual:harga_jual},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
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
		$("#kategori").val("");
		$("#harga_modal").val("");
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
	
	
	$(document).on('click','.menu_harga',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var idtype = $(this).attr('data-type');
		$('.form-control').addClass('form-control-sm');
		$('.form-group').css('margin-bottom','5px');
		// clearform();
		$('#ModalHarga').modal('show');
		
		$.ajax({
			url: base_url + 'produk/atur_harga',
			data: {type:'edit',id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$("body").loading({zIndex:1060});
			},
			success: function(data) {
				$("#id_harga_menu").val(data.id);
				$("#TitleHarga").html(data.judul);
				$("#harga_pokok").val(data.modal);
				$('#myTab a[href="#tab_' + data.type_harga + '"]').tab('show');
				$("#radio_"+data.type_harga).prop("checked", true);
				if(data.type_harga==1){
					load_satu_harga(data.id)
					load_satuan(data.id_satuan)
					}else if(data.type_harga==2){
					load_satuan_harga(data.id)
					}else if(data.type_harga==3){
					load_harga_level(data.id)
					load_satu_harga(data.id)
					}else if(data.type_harga==4){
					load_range(data.id)
					}else if(data.type_harga==5){
					load_range_level(data.id)
				}
				// console.log(data.type_harga)
				// if(activeTab==1){
				// }
				
				
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	});
	function load_satu_harga(id)
	{
		$.ajax({
			url: base_url + 'produk/load_satu_harga',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('body').loading();
			},
			success: function(data) {
				$("#persen").val(data.persen);
				$("#harga_jual").val(data.jual);
				$('body').loading('stop');
			},
			error: function(xhr, status, error) {
				var err = xhr.responseText ;
				sweet('Server!!!',err,'error','danger');
				$('body').loading('stop');
			}
		});
	}
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
				$("#kategori").val(data.kategori);
				$("#harga_modal").val(data.modal);
				$("#id_satuan").val(data.id_satuan);
				$("#satuan").val(data.satuan);
				$("#ukuran").val(data.ukuran);
				$("#stok").val(data.stok);
				$("#aktif").val(data.aktif);
				$('body').loading('stop');
				
				if(data.stok=='Y'){
					$(".jenis").show();
					}else{
					$(".jenis").hide();
				}
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
	
	$("#satuan").keyup(function(){
		$("#satuan").removeClass("is-invalid").addClass("is-valid");
	});
	
	$("#kategori").change(function(){
		if($("#kategori").val()=='Data tidak ditemukan'){
			$("#kategori").addClass('is-invalid');
			}else{
			$("#kategori").removeClass("is-invalid").addClass("is-valid");
		}
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
		var kategori = $("#kategori").val();
		var modal = angka($("#harga_modal").val());
		var satuan = angka($("#id_satuan").val());
		var ukuran = angka($("#ukuran").val());
		var aktif = $("#aktif").val();
		var stok = $("#stok").val();
		var jenis = $("#jenis").val();
		var halaman = $("#halaman").val();
		if(judul==''){
			$("#judul").addClass('is-invalid');
			$("#judul").focus();
			return;
		}
		if(kategori==''){
			$("#kategori").addClass('is-invalid');
			$("#kategori").focus();
			return;
		}
		if(modal==''){
			$("#harga_modal").addClass('is-invalid');
			$("#harga_modal").focus();
			return;
		}
		
		if(satuan==''){
			$("#satuan").addClass('is-invalid');
			$("#satuan").focus();
			return;
		}
		if(stok==''){
			$("#stok").addClass('is-invalid');
			$("#stok").focus();
			return;
		}
		if(aktif==''){
			$("#aktif").addClass('is-invalid');
			$("#aktif").focus();
			return;
		}
		$.ajax({
			url: base_url + 'produk/save_bahan',
			data: {id:id,type:type,judul:judul,kategori:kategori,modal:modal,satuan:satuan,aktif:aktif,stok:stok,jenis:jenis,ukuran:ukuran},
			method: 'POST',
			dataType:'json',
			beforeSend: function(){
				$('#load-save-bahan').loading({zIndex:1060,theme:'dark'});
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right','Simpan data',data.msg,'success');
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
	
	function load_satuan(idjenis){
		// console.log(idjenis)
		$.ajax({
			url: base_url + "produk/load_satuan",
			type: 'POST',
			dataType: 'json',
			beforeSend: function () {
				$("#load_satuan").append("<option value='loading'>loading</option>");
				$("#load_satuan").empty();
			},
			success: function (response) {
				// $("#jenis_lembaga_"+jenis+" option[value='loading']").remove();
				$("#load_satuan").append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					if(id==idjenis){
						$("#load_satuan").append("<option value='" + id + "' selected>" + name + "</option>");
						}else{
						$("#load_satuan").append("<option value='" + id + "'>" + name + "</option>");
					}
					
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	
	function load_harga_level(idjenis){
		
		$.ajax({
			url: base_url + "produk/load_harga_level",
			type: 'POST',
			data:{id:idjenis},
			dataType: 'html',
			beforeSend: function () {
				$("#load_harga_level").empty();
			},
			success: function (response) {
				$("#load_harga_level").html(response);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	function load_range(idjenis){
		
		$.ajax({
			url: base_url + "produk/load_range",
			type: 'POST',
			data:{id:idjenis},
			dataType: 'html',
			beforeSend: function () {
				$("#load_range").empty();
			},
			success: function (response) {
				$("#load_range").html(response);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	
	function load_range_level(idjenis){
		
		$.ajax({
			url: base_url + "produk/load_range_level",
			type: 'POST',
			data:{id:idjenis},
			dataType: 'html',
			beforeSend: function () {
				$("#load_range_level").empty();
			},
			success: function (response) {
				$("#load_range_level").html(response);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	
	function  load_satuan_harga(idbahan){
		
		$.ajax({
			url: base_url + "produk/satuan_harga",
			type: 'POST',
			data:{id:idbahan},
			dataType: 'html',
			beforeSend: function () {
				$("#load_satuan_harga").empty();
			},
			success: function (response) {
				$("#load_satuan_harga").html(response);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
</script>
<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>