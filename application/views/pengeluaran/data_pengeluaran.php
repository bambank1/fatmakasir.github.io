<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Laporan Pengeluaran <span id="test"></span></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Laporan Pengeluaran </li>
		</ol>
	</div>
    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
						</div>
						<select id="sortBy" class="form-control custom-select w-5px" onchange="FilterPengeluaran()" style="width:10px!important;padding-right:0!important">
							<option value="DESC">DESC</option>
							<option value="ASC">ASC</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control custom-select w-5px" onchange="FilterPengeluaran()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
						</select>
						<div class="input-group-append">
							<span class="input-group-text">Jenis</span>
						</div>
						<select onchange="FilterPengeluaran()" name="jenis_p" id="jenis_p" class="form-control custom-select w-1">
							<option value="">Semua</option>
							<?php  
								foreach ($jenis AS $values){
									echo '<option value="'.$values['id_jenis'].'">'.$values['title'].'</option>';
								}
							?>
						</select>
						<div class="input-group-append">
							<span class="input-group-text">Pengguna</span>
						</div>
						<select name="user" id="user"  class="custom-select" onchange="FilterPengeluaran()">
							<option value="0" style="font-weight:bold;border-bottom:1px solid #ddd;">PILIH</option>
							<?php  
								foreach ($pilihan AS $values){
									if($this->session->level=='admin' OR $this->session->level=='owner'){
										if($this->session->idu==$values['id_user']){
											echo '<option value="'.$values['id_user'].'" selected>'.$values['nama_lengkap'].'</option>';
											}else{
											echo '<option value="'.$values['id_user'].'">'.$values['nama_lengkap'].'</option>';
										}
										}else{
										if($this->session->idu==$values['id_user']){
											echo '<option value="'.$values['id_user'].'" selected>'.$values['nama_lengkap'].'</option>';
										}
									}
								}
							?>
						</select>
						<div class="input-group-append">
							<span class="input-group-text">Tanggal</span>
						</div>
						<div  id="date-pengeluaran">
							<div class="input-daterange input-group input-group-sm">
								<input type="text" onchange="FilterPengeluaran()" value="<?=$tgl_awal;?>" class="form-control" name="dari" id="dari">
								
								<input type="text" onchange="FilterPengeluaran()" value="<?=$tgl;?>" class="form-control" name="sampai" id="sampai">
							</div>
						</div>
						
						<div class="btn-group" role="group">
							<button class="btn btn-success btn-sm" onclick="FilterPengeluaran();"><i class="fa fa-search"></i></button>
							<button type="button" data-info="tambah" class="btn btn-warning tpengeluaran btn-sm" data-id="0"><i class="fa fa-plus"></i></button>
							<button class="btn btn-primary btn-sm url_doc" data-url="pengeluaran" type="button" data-toggle="tooltip" data-original-title="Dok pengeluaran" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
				<div class="post-list" id="dataListPengeluaran">
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-fullscreen-xl" id="pengeluaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah pengeluaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="load-modal"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success simpan_pengeluaran">Simpan</button>
				<button type="button" class="btn btn-info bayar_pengeluaran">Bayar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- bayar invoice -->
<div class="modal fade" id="bayar-pengeluaran" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content flat">
			<div class="modal-header py-1">
				<h4 class="modal-title">BAYAR PENGELUARAN #<span class="tinvoice"></span></h4>
			</div>
			<div class="modal-body pb-0">
				<div class="form-group row mb-0">
					<label  class="col-4 col-form-label"> 
						<div class="input-group">
							BAYAR&nbsp;&nbsp;
							<div class="custom-control custom-radio">
								<input type="radio" id="Bayarp1" name="Bayarp" class="custom-control-input Bayarp" value="1" checked>
								<label class="custom-control-label" for="Bayarp1"> FULL&nbsp;&nbsp;</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="Bayarp2" name="Bayarp" class="custom-control-input Bayarp" value="2" >
								<label class="custom-control-label" for="Bayarp2">SEBAGIAN</label>
							</div>
						</div>
					</label> 
					<div class="col-8">
						<div class="input-group input-group-sm mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text" for="cara_bayar">CARA BAYAR</span>
							</div>
							<select name="cara_bayar" id="cara_bayar"  class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text" for="sumber_kas">SUMBER KAS</span>
							</div>
							<select name="sumber_kas" id="sumber_kas" class="custom-select form-control form-control-sm sumber_kas" disabled>
							</select>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0 tampil">
					<label  for="jatuh_tempo" class="col-4 col-form-label"> 
						Tanggal Jatuh tempo
					</label> 
					<div class="col-8">
						<div class="input-group input-group-sm flat">
							<input type="text" class="form-control form-control-sm w-150px date_p jatuh_tempo" id="jatuh_tempo" value=""  disabled>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0">
					<label for="saldo_kas" class="col-4 col-form-label">SALDO KAS</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="saldo_kas" name="saldo_kas" type="text" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0">
					<label for="jml_bayar_pengeluaran" class="col-4 col-form-label">JUMLAH BAYAR</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="jml_bayar_pengeluaran" name="jml_bayar_pengeluaran" type="text" value="0" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0">
					<label for="total_bayar_pengeluaran" class="col-4 col-form-label">TOTAL BAYAR</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="total_bayar_pengeluaran" name="total_bayar_pengeluaran" type="text" value="0" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0">
					<label for="piutang" class="col-4 col-form-label">SISA</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="piutang" name="piutang" type="text" value="0" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0 p-0 flat">
					<label for="nominal" class="col-4 col-form-label">NOMINAL UANG</label> 
					<div class="col-8">
						<div class="btn-group" role="group">
							<button class="btn btn-primary btn-sm flat n-bayarp" data-id="50000">50.000</button>
							<button class="btn btn-secondary btn-sm flat n-bayarp" data-id="100000">100.000</button>
							<button class="btn btn-success btn-sm flat n-bayarp" data-id="200000">200.000</button>
							<button class="btn btn-info btn-sm flat n-bayarp" data-id="300000">300.000</button>
							<button class="btn btn-warning btn-sm flat n-bayarp" data-id="400000">400.000</button>
							<button class="btn btn-danger btn-sm flat n-bayarp" data-id="500000">500.000</button>
							<button type="button" onclick="uang_pas();" class="btn btn-dark btn-sm flat lunasd">UANGPAS</button>
						</div>
					</div>
				</div>
				<div class="form-group row mb-0 flat">
					<label for="jml_bayar" class="col-4 col-form-label">NOMINAL BAYAR</label> 
					<div class="col-8">
						<div class="input-group flat">
							<input id="jml_bayar" name="jml_bayar" type="text" class="form-control form-control-sm input"> 
						</div>
					</div>
				</div>
				<div class="form-group row mb-0 mt-0">
					<label for="uang_kembalian" class="col-4 col-form-label">KEMBALIAN</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="uang_kembalian" name="uang_kembalian" type="text" class="form-control form-control-sm" readonly>
							<input id="total_dibayarkan" name="total_dibayarkan" type="hidden" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row">
					<div class="col-12 load-bayar-pengeluaran"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary flat bayar_lunas" id="bayar_lunas" disabled>SIMPAN</button>
				<button type="button" class="btn btn-danger flat" data-dismiss="modal">TUTUP</button>
			</div>
		</div>
	</div>
</div>

<!-- bayar invoice -->
<div class="modal fade" id="bayar-piutang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content flat">
			<div class="modal-header py-1">
				<h4 class="modal-title-piutang">BAYAR HUTANG</h4>
			</div>
			<div class="modal-body pb-0">
				<div class="form-group row mb-0">
					<label  class="col-4 col-form-label"> 
						<div class="input-group">
							BAYAR&nbsp;&nbsp;
							<div class="custom-control custom-radio">
								<input type="hidden" id="idpengeluaranpiutang" name="idpengeluaranpiutang">
								<input type="hidden" id="idinfo" name="idinfo">
								<input type="radio" id="bayarfull" name="bpiutang" class="custom-control-input Bayarp" value="1" checked>
								<label class="custom-control-label" for="bayarfull"> FULL&nbsp;&nbsp;</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="bayarsebagian" name="bpiutang" class="custom-control-input Bayarp" value="2" >
								<label class="custom-control-label" for="bayarsebagian">SEBAGIAN</label>
							</div>
						</div>
					</label> 
					<div class="col-8">
						<div class="input-group input-group-sm mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text" for="cara_bayar_piutang">CARA BAYAR</span>
							</div>
							<select name="cara_bayar_piutang" id="cara_bayar_piutang"  class="custom-select form-control form-control-sm"  data-valueKey="id" data-displayKey="name" required>
							</select>
							<div class="input-group-prepend">
								<span class="input-group-text tujuan_kas_sumber" for="tujuan_kas">SUMBER KAS</span>
							</div>
							<select name="tujuan_kas" id="tujuan_kas" class="custom-select form-control form-control-sm tujuan_kas" disabled>
							</select>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0">
					<label for="total_piutang" class="col-4 col-form-label">TOTAL PIUTANG</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="total_piutang" name="total_piutang" type="text" value="0" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0 saldoshow">
					<label for="saldo_kas_bayar" class="col-4 col-form-label">SALDO KAS</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="saldo_kas_bayar" name="saldo_kas_bayar" type="text" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0">
					<label for="total_bayar_piutang" class="col-4 col-form-label">TOTAL BAYAR</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="total_bayar_piutang" name="total_bayar_piutang" type="text" value="0" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0">
					<label for="sisa_piutang" class="col-4 col-form-label">SISA</label> 
					<div class="col-8">
						<div class="input-group">
							<input id="sisa_piutang" name="sisa_piutang" type="text" value="0" class="form-control form-control-sm" readonly>
						</div>
					</div>
				</div> 
				<div class="form-group row mb-0 p-0 flat">
					<label for="nominal" class="col-4 col-form-label">NOMINAL UANG</label> 
					<div class="col-8">
						<div class="btn-group" role="group">
							<button class="btn btn-primary btn-sm flat n-piutang" data-id="50000">50.000</button>
							<button class="btn btn-secondary btn-sm flat n-piutang" data-id="100000">100.000</button>
							<button class="btn btn-success btn-sm flat n-piutang" data-id="200000">200.000</button>
							<button class="btn btn-info btn-sm flat n-piutang" data-id="300000">300.000</button>
							<button class="btn btn-warning btn-sm flat n-piutang" data-id="400000">400.000</button>
							<button class="btn btn-danger btn-sm flat n-piutang" data-id="500000">500.000</button>
							<button type="button" onclick="uang_pas_piutang();" class="btn btn-dark btn-sm flat lunasd">UANGPAS</button>
						</div>
					</div>
				</div>
				<div class="form-group row mb-0 flat">
					<label for="jml_bayar_piutang" class="col-4 col-form-label">JUMLAH BAYAR</label> 
					<div class="col-8">
						<div class="input-group flat">
							<input id="jml_bayar_piutang" name="jml_bayar_piutang" type="text" class="form-control form-control-sm input" onkeyup='formatNumber(this);'> 
						</div>
					</div>
				</div>
				
				<div class="form-group row">
					<div class="col-12 load-bayar-piutang"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary flat bayar_lunas_piutang" id="bayar_lunas_piutang" disabled>SIMPAN</button>
				<button type="button" class="btn btn-danger flat" data-dismiss="modal">TUTUP</button>
			</div>
		</div>
	</div>
</div>
<style>
	.cell-1 {
	border-collapse: separate;
	border-spacing: 0 4em;
	background: #ffffff;
	border-bottom: 5px solid transparent;
	background-clip: padding-box;
	cursor: pointer
	}
	
	
	.table-elipse {
	cursor: pointer
	}
	
	.row-child {
	background-color: #dbdbea;
	}
</style>
<script>
	var bayar_rupiah = document.getElementById('jml_bayar');
	bayar_rupiah.addEventListener('keyup', function(e)
	{
		bayar_rupiah.value = formatRupiah(this.value, 'Rp. ');
		jml_bayar = angka(this.value);
		piutang = angka($("#piutang").val());
		if(parseInt(jml_bayar)>parseInt(piutang)){
			uang_kembalian = parseInt(jml_bayar) - parseInt(piutang);
			total_dibayarkan = piutang;
			$("#uang_kembalian").val(formatMoney(uang_kembalian, 0, "Rp."));
			}else{
			total_dibayarkan = jml_bayar;
			$("#uang_kembalian").val(formatMoney(0, 0, "Rp."));
		}
		$("#total_dibayarkan").val(total_dibayarkan);
	});		
	
	var jml_bayarpiutang = document.getElementById('jml_bayar_piutang');
	jml_bayarpiutang.addEventListener('keyup', function(e)
	{
		jml_bayarpiutang.value = formatRupiah(this.value, 'Rp. ');
		jml_bayar = angka(this.value);
		piutang = angka($("#sisa_piutang").val());
		if(parseInt(jml_bayar)>parseInt(piutang)){
			$("#jml_bayar_piutang").val(formatMoney(piutang, 0, "Rp."));
			}else{
			
			$("#jml_bayar_piutang").val(jml_bayar(0, 0, "Rp."));
		}
		$("#total_dibayarkan").val(total_dibayarkan);
	});		
	$('.input').click(function() {
		this.select();
	});
	function uang_pas() {
		piutang = angka($("#piutang").val());
		$("#total_dibayarkan").val(piutang);
		$("#jml_bayar").val(formatMoney(piutang, 0, "Rp."));
		$("#uang_kembalian").val(formatMoney(0, 0, "Rp."));	
	}
	function load_list_bayar(id){
		$.ajax({
			'url': base_url + 'pengeluaran/list_bayar',
			'data': {
				id: id
			},
			'method': 'POST',
			success: function(data) {
				$(".load-bayar-pengeluaran").html(data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	}
	
	$("#Bayarp1").change(function() {
		if(this.checked) {
			// console.log(2)
			var piutang = angka($("#piutang").val());
			$("#jml_bayar").val(formatMoney(piutang, 0, "Rp."));
			$("#total_dibayarkan").val(piutang);
			$("#jml_bayar").attr("readonly",true);
			$(".lunasp").attr("disabled",true);
			$(".n-bayarp").attr("disabled",true);
		}
	});
	$(".n-bayarp").click(function() {
		var ubayar = $(this).attr('data-id');
		console.log(ubayar);
		var piutang = angka($("#piutang").val());
		if(ubayar > parseInt(piutang)){
			kembalian = parseInt(ubayar) - parseInt(piutang);
			$("#jml_bayar").val(formatMoney(ubayar, 0, "Rp."));
			$("#uang_kembalian").val(formatMoney(kembalian, 0, "Rp."));
			$("#total_dibayarkan").val(piutang);
			}else{
			$("#jml_bayar").val(formatMoney(ubayar, 0, "Rp."));
			$("#uang_kembalian").val(formatMoney(0, 0, "Rp."));
			$("#total_dibayarkan").val(ubayar);
		}
		$("#uangm").val(formatMoney(ubayar, 0, "Rp."));
		
	});
	$("#Bayarp2").change(function() {
		if(this.checked) {
			$("#jml_bayar").val(formatMoney(0,0,"Rp."));
			$("#total_dibayarkan").val(0);
			$("#jml_bayar").attr("readonly",false);
			$(".lunasp").attr("disabled",false);
			$(".n-bayarp").attr("disabled",false);
		}
	});
	$("#sumber_kas" ).change(function() {
		var id = $("#sumber_kas").val();
		$.ajax({
			url:  base_url+"kas/total_kas",
			data:{id:id},
			dataType: "json",
			method: 'post',
			success: function (data) {
				$('#saldo_kas').val(formatMoney(data,0,"Rp."));
				$('.bayar_lunas').attr('disabled',false);
			}
		});
	});
	
	$("#tujuan_kas" ).change(function() {
		var id = $("#tujuan_kas").val();
		$.ajax({
			url:  base_url+"kas/total_kas",
			data:{id:id},
			dataType: "json",
			method: 'post',
			success: function (data) {
				$('#saldo_kas_bayar').val(formatMoney(data,0,"Rp."));
				$('.bayar_lunas').attr('disabled',false);
			}
		});
	});
	$("#cara_bayar" ).change(function() {
		var id = $("#cara_bayar").val();
		$('.sumber_kas').attr('disabled',true);
		$('.jatuh_tempo').attr('disabled',true);
		$("#sumber_kas").empty();
		// console.log(2);
		// if(id==2){
		$.ajax({
			url: base_url + "pengeluaran/jenis_kas",
			type: 'post',
			data: {id:id,type:'cari'},
			dataType: 'json',
			success: function (response) {
				var len = response.length;
				$(".sumber_kas").attr("disabled", false);
				$("#sumber_kas").append("<option value='0'>Pilih</option>");
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					$("#sumber_kas").append("<option value='" + id + "'>" + name + "</option>");
				}
			}
		});
		if(id==3){
			$('.jatuh_tempo').attr('disabled',false);
		}
		// $("#sumber_kas").append("<option value='0'>Pilih</option>");
		// }else{
		// $('.bayar_lunas').attr('disabled',true);
		// }
	});
	function load_jenis_bayar(){
		$.ajax({
			url: base_url + "pembayaran/jenis_pembayaran_pengeluaran",
			type: 'GET',
			dataType: 'json',
			beforeSend: function () {
				$("#cara_bayar").append("<option value='loading'>loading</option>");
				$("#cara_bayar").empty();
			},
			success: function (response) {
				$("#cara_bayar option[value='loading']").remove();
				$("#cara_bayar").append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					$("#cara_bayar").append("<option value='" + id + "'>" + name + "</option>");
				}
			}
		});
	}
	function load_total_bayar(id){
		var retval = 0;
		$.ajax({
			'url': base_url + 'pengeluaran/load_total_bayar',
			'data': {id: id},
			'method': 'POST',
			success: function(data) {
				retval = data;
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
		// console.log(retval);
		return retval;
	}
	
	
	$(document).on('click','.bayar_pengeluaran',function(e){
		e.preventDefault();
		var total_bayar = 0;
		var idpengeluaran = $("#idpengeluaran").val();
		var total_pengeluaran = angka($("#total_pengeluaran").val());
		if (angka($('#total_pengeluaran').val()) == '' || angka($('#total_pengeluaran').val()) == 0){
			sweet('Peringatan!!!','Total masih kosong','warning','warning');
			return;
		}
		load_list_bayar(idpengeluaran);
		$('#bayar-pengeluaran').modal({backdrop: 'static', keyboard: false});
		// var jml_bayar_pengeluaran = angka($("#jml_bayar_pengeluaran").val());
		
		$("#sumber_kas").attr("disabled",true);
		$("#Bayarp1").filter(function () {
			var piutang = angka($("#piutang").val());
			// console.log(piutang);
			if(this.checked) {
				$("#jml_bayar_pengeluaran").val(formatMoney(total_pengeluaran, 0, "Rp."));					
				// $("#jml_bayar").val(formatMoney(piutang, 0, "Rp."));
				$("#jml_bayar").attr("readonly",true);
				$(".lunasp").attr("disabled",true);
				$(".n-bayarp").attr("disabled",true);
				// $("#total_dibayarkan").val(piutang);
				}else{
				// $("#total_dibayarkan").val(0);
				$("#jml_bayar").val(formatMoney(0, 0, "Rp."));
			}
		});
		$("#uang_kembalian").val(formatMoney(0, 0, "Rp."));
		
		total_bayar = $("#total_sudah_bayar").val();	
		if(parseInt(total_bayar) > 0){
			var hitung_bayar = parseInt(total_pengeluaran) - parseInt(total_bayar);
			$("#total_bayar_pengeluaran").val(total_bayar(0, 0, "Rp."));					
			$("#piutang").val(formatMoney(hitung_bayar, 0, "Rp."));			
			// console.log(1)
			}else{
			$("#total_bayar_pengeluaran").val(formatMoney(0, 0, "Rp."));					
			$("#piutang").val(formatMoney(total_pengeluaran, 0, "Rp."));					
			// console.log(2)
		}
		load_jenis_bayar();
		load_detail_bayar()
		// return;
	});
	
	
	function load_detail_bayar()
	{
		let total_bayar_pengeluaran = angka($("#total_bayar_pengeluaran").val());
		let jml_bayar_pengeluaran   = angka($("#jml_bayar_pengeluaran").val());
		let piutang                 = angka($("#piutang").val());
		let bayar = parseInt(jml_bayar_pengeluaran) - parseInt(total_bayar_pengeluaran);
		$("#total_dibayarkan").val(bayar);
		$("#jml_bayar").val(formatMoney(bayar, 0, "Rp."));
		$("#saldo_kas").val(formatMoney(0, 0, "Rp."));
		// console.log("bayar"+bayar)
	}
	
	$(document).ready(function(){
		FilterPengeluaran();
	});
	function FilterPengeluaran(page_num){
		page_num = page_num?page_num:0;
		// var keywords = $('#keywords').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		var user = $('#user').val();
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		var jenis = $("#jenis_p").val();
		if(jenis == 0){
			$.ajax({
				type: 'POST',
				url: base_url + 'ajax/ajaxPengeluaran/'+page_num,
				data:{page:page_num,sortBy:sortBy,limits:limits,user:user,dari:dari,sampai:sampai},
				beforeSend: function(){
					$('body').loading();
				},
				success: function(html){
					$('#dataListPengeluaran').html(html);
					$('body').loading('stop');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
					$('body').loading('stop');
				}
			});
			}else{
			
			$.ajax({
				type: 'POST',
				url: base_url+'ajax/ajaxPengeluaranProduk/'+page_num,
				data:{page:page_num,sortBy:sortBy,limits:limits,user:user,dari:dari,sampai:sampai,jenis:jenis},
				beforeSend: function(){
					$('.loading').show();
				},
				success: function(html){
					$('#dataListPengeluaran').html(html);
					$('.loading').fadeOut("slow");
				},
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
			// sweet('Peringatan!!!',jenis,'warning','warning');
		}
	}
	$(document).on('click','.tpengeluaran',function(e){
		e.preventDefault();
		var dataID = $(this).attr('data-id');
		var info = $(this).attr('data-info');
		var user = $("#user").val();
		// alert(info);
		$.ajax({
			'url': base_url + 'pengeluaran/load_modal',
			'method': 'POST',
			data :{id:dataID,info:info,user:user},
			success: function(data) {
				if(data=='error'){
					sweet('Peringatan!!!','Maaf Data telah direkap & tidak bisa di edit','warning','warning');
					}else{
					$("#pengeluaran").modal('show');
					$(".load-modal").html(data);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		})
	});
	$(document).on('click','.simpan_pengeluaran',function(e){
		e.preventDefault();
		// console.log(3)
		var id = $("#idpengeluaran").val();
		var date_p = $("#date_p").val();
		
		var total = angka($("#total_pengeluaran").val());
		var saldo = angka($("#total-kas").val());
		var c = $("#table_pengeluaran > tbody").children().length;
		
		
		for (var a = 0; a < c; a++) {
			if ($('#uraian_'+a).val() == '-' || $('#uraian_'+a).val() == ''){
				$( "#uraian_"+a ).focus();
				sweet('Peringatan!!!','Uraian masih kosong','warning','warning');
				return;
			}
			if ($('#jenis_'+a).val() == '-' || $('#jenis_'+a).val() == ''){
				$( "#jenis_"+a ).focus();
				sweet('Peringatan!!!','Jenis masih kosong','warning','warning');
				return;
			}
			if ($('#jum_'+a).val() == '-' || $('#jum_'+a).val() == '' || $('#jum_'+a).val() == 0){
				$( "#jum_"+a ).focus();
				sweet('Peringatan!!!','Jumlah masih kosong','warning','warning');
				return;
			}
			if ($('#pharga_'+a).val() == '-' || angka($('#pharga_'+a).val()) == ''){
				$( "#pharga_"+a ).focus();
				sweet('Peringatan!!!','Harga masih kosong','warning','warning');
				return;
			}
			if ($('#psatuan_'+a).val() == '-' || $('#psatuan_'+a).val() == ''){
				$( "#psatuan_"+a ).focus();
				sweet('Peringatan!!!','Satuan masih kosong','warning','warning');
				return;
			}
		}
		if (angka($('#total_pengeluaran').val()) == '' || angka($('#total_pengeluaran').val()) == 0){
			sweet('Peringatan!!!','Total masih kosong','warning','warning');
			return;
		}
		
		$.ajax({
			type: "POST",
			url: base_url + "pengeluaran/save_pengeluaran",
			data: { id:id,total:total,tgl:date_p},
			dataType: "json",
			beforeSend: function(){
				$('body').loading();
			},
			success: function(res) {
				if (res.ok == 'ok') {
					sweet_time(500,'Status!!!',res.msg);
					$("#dari").val(date_p);
					FilterPengeluaran();
					$("#pengeluaran").modal('hide');
					} else {
					sweet('Peringatan!!!','Maaf data gagal disimpan','warning','warning');
				}
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('body').loading('stop');
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	})
	
	$(".bayar_lunas").on('click', function(e) {
		e.preventDefault();
		
		var id = $("#idpengeluaran").val();
		var jatuh_tempo = $("#jatuh_tempo").val();
		var cara_bayar = $("#cara_bayar").val();
		var pencatat = $("#pencatat").val();
		var sumber_kas = $("#sumber_kas").val();
		var jml_bayar = angka($("#total_dibayarkan").val());
		var total = angka($("#total_pengeluaran").val());
		var saldo = angka($("#saldo_kas").val());
		
		
		if(sumber_kas==0){
			sweet('Peringatan!!!','Maaf sumber kas belum dipilih','warning','warning');
			return;
		}
		if(cara_bayar==0){
			sweet('Peringatan!!!','Maaf cara bayar belum dipilih','warning','warning');
			return;
		}
		if(parseInt(saldo)==0 && cara_bayar!=3){
			sweet('Peringatan!!!','Maaf saldo kas kosong','warning','warning');
			return;
		}
		if(cara_bayar==3){
			jatuh_tempo = jatuh_tempo;
			}else{
			jatuh_tempo = null;
		}
		
		if(parseInt(jml_bayar)==0 && cara_bayar !=3){
			sweet('Peringatan!!!','Maaf jumlah bayar masih kosong','warning','warning');
			return;
		}
		
		if(parseInt(jml_bayar) > parseInt(saldo) && cara_bayar!=3){
			sweet('Peringatan!!!','Maaf saldo kas kurang','warning','warning');
			return;
		}
		
		if (angka($('#total_pengeluaran').val()) == '' || angka($('#total_pengeluaran').val()) == 0){
			sweet('Peringatan!!!','Total masih kosong','warning','warning');
			return;
		}
		$('.bayar_lunas').attr('disabled',true);
		// return;
		$.ajax({
			type: "POST",
			url: base_url + "pengeluaran/simpan_bayar_pengeluaran",
			data: { id:id,total:total,jml_bayar:jml_bayar,jatuh_tempo:jatuh_tempo,cara_bayar:cara_bayar,sumber_kas:sumber_kas},
			dataType: "json",
			beforeSend: function(){
				$('body').loading();
			},
			success: function(res) {
				if (res.status == 200) {
					$('.simpan_pengeluaran').attr('disabled',false);
					$('.simpan_pengeluaran').removeClass('btn-warning').addClass('btn-info');
					sweet_time(500,'Status!!!',res.msg);
					FilterPengeluaran();
					} else {
					sweet('Peringatan!!!','Maaf data gagal disimpan','warning','warning');
				}
				$("#bayar-pengeluaran").modal('hide');
				$('body').loading('stop');
				$('.bayar_lunas').attr('disabled',false);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('body').loading('stop');
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('.bayar_lunas').attr('disabled',false);
			}
		});
	})
	function jenis_bayar_piutang(){
		$.ajax({
			url: base_url + "pembayaran/jenis_pembayaran_piutang",
			type: 'GET',
			dataType: 'json',
			beforeSend: function () {
				$("#cara_bayar_piutang").append("<option value='loading'>loading</option>");
				$("#cara_bayar_piutang").empty();
			},
			success: function (response) {
				$("#cara_bayar_piutang option[value='loading']").remove();
				$("#cara_bayar_piutang").append("<option value=''>Pilih</option>");
				var len = response.length;
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					$("#cara_bayar_piutang").append("<option value='" + id + "'>" + name + "</option>");
				}
			}
		});
	}
	$('.tujuan_kas').attr('disabled',true);
	$("#cara_bayar_piutang" ).change(function() {
		var id = $("#cara_bayar_piutang").val();
		$('.tujuan_kas').attr('disabled',true);
		if(id >0){
			$(".tujuan_kas").attr("disabled", false);
		}
		$("#tujuan_kas").empty();
		$.ajax({
			url: base_url + "pengeluaran/jenis_kas",
			type: 'post',
			data: {id:id,type:'cari'},
			dataType: 'json',
			success: function (response) {
				var len = response.length;
				
				$("#tujuan_kas").append("<option value='0'>Pilih</option>");
				for (var i = 0; i < len; i++) {
					var id = response[i]['id'];
					var name = response[i]['name'];
					$("#tujuan_kas").append("<option value='" + id + "'>" + name + "</option>");
				}
			}
		});
	});
	$(document).on('click','.bayar_piutang',function(e){
		e.preventDefault();
		var dataID = $(this).attr('data-id');
		var info = $(this).attr('data-info');
		var total = $(this).attr('data-total');
		var user = $("#user").val();
		if(info=='bayarh'){
			$(".tujuan_kas_sumber").html('SUMBER KAS');
			$(".modal-title-piutang").html('BAYAR HUTANG USAHA #'+dataID);
			$(".saldoshow").show();
			}else{
			$(".tujuan_kas_sumber").html('TUJUAN KAS');
			$(".modal-title-piutang").html('BAYAR PIUTANG #'+dataID);
			$(".saldoshow").hide();
		}
		$("#idpengeluaranpiutang").val(dataID);
		$.ajax({
			'url': base_url + 'pengeluaran/load_bayar',
			'method': 'POST',
			data :{id:dataID,info:info,user:user},
			success: function(data) {
				if(data=='error'){
					sweet('Peringatan!!!','Maaf Data telah direkap & tidak bisa di edit','warning','warning');
					}else{
					$('#bayar-piutang').modal({backdrop: 'static', keyboard: false});
					// $("#bayar-piutang").modal('show');
					$(".idpiutang").html(dataID);
					$(".load-bayar-piutang").html(data);
					var bayar = $("#total_sudah_bayar_piutang").val();
					var sisa = parseInt(total) - parseInt(bayar);
					$("#total_piutang").val(formatMoney(total, 0, "Rp."));
					$("#total_bayar_piutang").val(formatMoney(bayar, 0, "Rp."));
					$("#sisa_piutang").val(formatMoney(sisa, 0, "Rp."));
				}
				jenis_bayar_piutang();
				load_bpiutang();
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		})
	});
	function load_bpiutang(){
		$("#bayarfull").filter(function () {
			var total_piutang = angka($("#total_piutang").val());
			var total_bayar_piutang = angka($("#total_bayar_piutang").val());
			if(total_bayar_piutang <= 0){
				piutang = total_piutang;
				}else{
				piutang = parseInt(total_piutang) - parseInt(total_bayar_piutang);
			}
			if(this.checked) {
				$("#sisa_piutang").val(formatMoney(piutang, 0, "Rp."));					
				$("#jml_bayar_piutang").val(formatMoney(piutang, 0, "Rp."));					
				$("#jml_bayar_piutang").attr("readonly",true);
				$(".bayar_lunas_piutang").attr("disabled",false);
				$(".n-pengeluaran").attr("disabled",true);
				
				}else{
				$("#jml_bayar_piutang").val(formatMoney(0, 0, "Rp."));	
				$("#sisa_piutang").val(formatMoney(piutang, 0, "Rp."));		
				$("#total_dibayarkan").val(0);
			}
		});
	}
	$(".n-piutang").click(function() {
		var ubayar = $(this).attr('data-id');
		var sisa_piutang = angka($("#sisa_piutang").val());
		
		if(ubayar > parseInt(sisa_piutang)){
			
			$("#jml_bayar_piutang").val(formatMoney(sisa_piutang, 0, "Rp."));
			$("#kembalian_bayar").val(formatMoney(kembalian, 0, "Rp."));
			
			$(".bayar_lunas_piutang").attr("disabled",false);
			}else{
			$("#jml_bayar_piutang").val(formatMoney(ubayar, 0, "Rp."));
			$("#kembalian_bayar").val(formatMoney(0, 0, "Rp."));
		}
		
	});
	$("#bayarfull").change(function() {
		var total_piutang = angka($("#total_piutang").val());
		var total_bayar_piutang = angka($("#total_bayar_piutang").val());
		if(total_bayar_piutang <= 0){
			piutang = total_piutang;
			}else{
			piutang = parseInt(total_piutang) - parseInt(total_bayar_piutang);
		}
		if(this.checked) {
			$("#jml_bayar_piutang").val(formatMoney(piutang, 0, "Rp."));
			$("#jml_bayar_piutang").attr("readonly",true);
			$(".n-piutang").attr("disabled",true);
			$("#kembalian_bayar").val(formatMoney(0, 0, "Rp."));
			$(".bayar_lunas_piutang").attr("disabled",false);
		}
	});
	
	$("#bayarsebagian").change(function() {
		if(this.checked) {
			$("#jml_bayar_piutang").val(formatMoney(0,0,"Rp."));
			
			$("#jml_bayar_piutang").attr("readonly",false);
			$(".n-piutang").attr("disabled",false);
			$("#kembalian_bayar").val(formatMoney(0, 0, "Rp."));
		}
	});
	function uang_pas_piutang() {
		var total_piutang = angka($("#total_piutang").val());
		var piutang = angka($("#sisa_piutang").val());
		if(piutang <= 0){
			piutang = total_piutang;
			}else{
			piutang = piutang;
		}
		
		$("#jml_bayar_piutang").val(formatMoney(piutang, 0, "Rp."));
		$("#kembalian_bayar").val(formatMoney(0, 0, "Rp."));	
	}
	$(".bayar_lunas_piutang").on('click', function(e) {
		e.preventDefault();
		
		var id = $("#idpengeluaranpiutang").val();
		var cara_bayar = $("#cara_bayar_piutang").val();
		var sumber_kas = $("#tujuan_kas").val();
		var jml_bayar = angka($("#jml_bayar_piutang").val());
		var total = angka($("#total_piutang").val());
		var sisa_piutang = angka($("#total_bayar_piutang").val());
		var saldo_kas_bayar = angka($("#saldo_kas_bayar").val());
		var idinfo = angka($("#idinfo").val());
		
		if(sisa_piutang==total){
			sweet('Peringatan!!!','Piutang sudah lunas','warning','warning');
			return;
		}
		if(sumber_kas==0){
			sweet('Peringatan!!!','Maaf tujuan kas belum dipilih','warning','warning');
			return;
		}
		if(cara_bayar==0){
			sweet('Peringatan!!!','Maaf cara bayar belum dipilih','warning','warning');
			return;
		}
		
		if(parseInt(jml_bayar)==0){
			sweet('Peringatan!!!','Maaf jumlah bayar masih kosong','warning','warning');
			return;
		}
		
		if(parseInt(saldo_kas_bayar) < parseInt(jml_bayar) && idinfo=='bayarh'){
			sweet('Peringatan!!!','Maaf saldo tidak mencukupi','warning','warning');
			return;
		}
		
		if (angka($('#total_piutang').val()) == '' || angka($('#total_piutang').val()) == 0){
			sweet('Peringatan!!!','Total masih kosong','warning','warning');
			return;
		}
		
		// return;
		$.ajax({
			type: "POST",
			url: base_url + "pengeluaran/simpan_bayar_piutang",
			data: {idinfo:idinfo,id:id,total:total,jml_bayar:jml_bayar,cara_bayar:cara_bayar,sumber_kas:sumber_kas},
			dataType: "json",
			beforeSend: function(){
				$('body').loading();
			},
			success: function(res) {
				if (res.status == 200) {
					sweet_time(500,'Status!!!',res.msg);
					FilterPengeluaran();
					} else {
					sweet('Peringatan!!!',res.msg,'warning','warning');
				}
				$("#bayar-piutang").modal('hide');
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('body').loading('stop');
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	})
	
	$('#bayar-piutang').on('hide.bs.modal', function() {
		$("#tujuan_kas").val('');
		$("#tujuan_kas").attr('disabled',true);
		
		$("#jml_bayar_piutang").val(formatMoney(0, 0, "Rp."));
		$("#kembalian_bayar").val(formatMoney(0, 0, "Rp."));
		FilterPengeluaran();
	});
	
	$('#pengeluaran').on('hide.bs.modal', function() {
		FilterPengeluaran();
	});
	
	var date2 = new Date();
	$('#date-pengeluaran .input-daterange').datepicker({        
        format: 'dd/mm/yyyy', 
		"endDate": date2,
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
	});    
	
</script>																																				