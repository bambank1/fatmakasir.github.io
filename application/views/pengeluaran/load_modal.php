<?php
	if($loadp->tgl_jatuhtempo==null){
		$tgl_jatuhtempo = "";
		}else{
		$tgl_jatuhtempo = $loadp->tgl_jatuhtempo;
	}
	$readonly = '';
	$disabled = '';
	if($info=='bayar'){
		$readonly = 'readonly';
		$disabled = 'disabled';
	}
	if($info=='view'){
		$readonly = 'readonly';
		$disabled = 'disabled';
		echo '<script>';
		echo '$(".simpan_pengeluaran").removeClass("btn-success").addClass("btn-warning").attr("disabled",true);';
		echo '$(".bayar_pengeluaran").removeClass("btn-success").addClass("btn-warning").attr("disabled",true);';
		echo '</script>';
	}
	
	if($info=='edit'){
		$readonly = '';
		$disabled = '';
		echo '<script>';
		echo '$(".simpan_pengeluaran").removeClass("btn-success").addClass("btn-warning").attr("disabled",false);';
		echo '$(".bayar_pengeluaran").removeClass("btn-success").addClass("btn-warning").attr("disabled",false);';
		echo '</script>';
	}
	
	if($info=='lunas'){
		$readonly = 'readonly';
		$disabled = 'disabled';
		echo '<script>';
		echo '$(".simpan_pengeluaran").removeClass("btn-success").addClass("btn-warning").attr("disabled",true);';
		echo '$(".bayar_pengeluaran").removeClass("btn-success").addClass("btn-warning").attr("disabled",true);';
		echo '</script>';
	}
	
?>
<div class='row'>
	<div class="col-md-12">
		<div class="d-flex">
			<input type="hidden" id="idpengeluaran" value="<?=$loadp->id_pengeluaran;?>" readonly>
			<div class="mr-auto p-2"><div class="d-inline p-2 bg-info text-white">No. <span id="id_pengeluaran"><?=$loadp->id_pengeluaran;?></span></div><div class="d-inline p-2 bg-default">Kasir : <span id="nama"><?=$nama;?></span></div></div>
			<div class="p-2">
				<div class="input-group input-group-sm flat">
					<span class="input-group-prepend">
						<span class="input-group-text">Tanggal Transaksi</span>
					</span>
					<input type="text" class="form-control form-control-sm w-150px date_p" id="date_p" value="<?=tgl_sampai_slash($loadp->tgl_pengeluaran);?>" readonly>
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-striped table-sm" id="table_pengeluaran">
			<thead>
				<tr>
					<td>Uraian</td>
					<td>Jenis akun</td>
					<td>Supplier</td>
					<td>Qty</td>
					<td>Nominal</td>
					<td>Satuan</td>
					<td>Sub total</td>
					<td><button class="btn btn-info btn-sm add_mores" <?=$disabled;?>><i class="fa fa-plus"></i></button></td>
				</tr>
			</thead>
			
			<?php 
				$no=0;
				foreach($loadd AS $val){ ?>
				<tbody><tr class="row_Count" id="row_Count<?=$no;?>">
					<td><input value="<?=$val['no'];?>" id="id_pengeluaran_<?=$no;?>" type="hidden">
					<input class="form-control form-control-sm inputs" value="<?php echo !empty($val['keterangan']) ? $val['keterangan'] : ''; ?>" id="uraian_<?=$no;?>" onchange="saved(<?=$no;?>);" type="text" <?=$readonly;?>></td>
					<td>
						<div class="input-group mb-3">
							<input class="form-control form-control-sm inputs" id="jenis_<?=$no;?>" type="text" value="<?=$val['title'];?>" onchange="doPengeluaran();saved(<?=$no;?>);" <?=$readonly;?>>
							<input value="<?=$val['id_biaya'];?>" id="id_jenis_<?=$no;?>" type="hidden">
							
						</div>
					</td>
					<td>
						<div class="input-group mb-3">
							<input class="form-control form-control-sm flat inputs" id="supplier_<?=$no;?>" type="text" value="<?=$val['nama_perusahaan'];?>" <?=$readonly;?>>
							<input value="<?=$val['id_supplier'];?>" id="id_supplier_<?=$no;?>" type="hidden">
							
						</div>
					</td>
					<td><input class="form-control form-control-sm inputs" id="jum_<?=$no;?>" type="text" value="<?=$val['jumlah'];?>" onchange="doPengeluaran();saved(<?=$no;?>);" <?=$readonly;?>></td>
					<td><input class="form-control form-control-sm inputs" id="pharga_<?=$no;?>" type="text" value="<?=$val['harga'];?>" onchange="doPengeluaran();saved(<?=$no;?>);" onkeyup='formatNumber(this)' <?=$readonly;?>></td>
					<td><input class="form-control form-control-sm inputs" id="psatuan_<?=$no;?>" type="text" value="<?=$val['satuan'];?>" onchange="doPengeluaran();saved(<?=$no;?>);" <?=$readonly;?>></td>
					<td><input class="form-control form-control-sm" id="ptotal_<?=$no;?>" type="text" readonly></td>
					<td><button class="btn btn-danger btn-sm del_more" onclick="del_more(<?=$no;?>)" <?=$disabled;?>><i class="fa fa-times"></i></button></td>
				</tr></tbody>
			<?php $no++;} ?>
			
			<tfoot>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Total Pengeluaran</td>
					<td><input class="form-control form-control-sm" id="total_pengeluaran" type="text" readonly></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<script>
	var info = '<?=$info;?>';
	
	$(document).ready(function(){
		$('.btn').tooltip();
		$('#total-kas').val(formatMoney(0,0,"Rp."));
		cek_total();
	});
	$(".inputs").focus(function() {
		$(this).select();
	});
	function cek_total()
	{
		// console.log(1);
		var total = angka($('#total_pengeluaran').val());
		if(parseInt(total) ==0){
			$(".simpan_pengeluaran").attr("disabled",true);
			$(".simpan_pengeluaran").removeClass('btn-success').addClass('btn-warning').attr("disabled",true);
			// $(".add_mores").removeClass('btn-info').addClass('btn-default').attr("disabled",false);
			// $(".del_more").removeClass('btn-danger').addClass('btn-default').attr("disabled",false);
			}else if(info!='lunas'){
			$(".simpan_pengeluaran").removeClass('btn-warning').addClass('btn-success').attr("disabled",false);
			$(".bayar_pengeluaran").attr("disabled",false);
			// $(".add_mores").removeClass('btn-default').addClass('btn-info').attr("disabled",false);
			// $(".del_more").removeClass('btn-default').addClass('btn-danger').attr("disabled",false);
		}
	}
	
	// function cek_saldo(a)
	// {
	// doPengeluaran();
	// saved(a);
	// cek_total();
	// }
	doPengeluaran();
	window.onload = doPengeluaran;	
	$('.date_p').datepicker({clearBtn: true,format: "dd/mm/yyyy"});
	
	$(".add_mores").on('click', function() {
		i = $('#table_pengeluaran > tbody').length;
		var cols = '<tbody><tr id="row_Count'+i+'" class="row_Count"><td><input type="hidden" id="id_pengeluaran_'+i+'" /><input type="text" id="uraian_'+i+'" class="form-control form-control-sm"/></td>';
		cols +='<td><input class="form-control form-control-sm" id="jenis_'+i+'" type="text"  onchange="doPengeluaran();saved('+i+');"><input  id="id_jenis_'+i+'" type="hidden"></td>';
		cols +='<td><input class="form-control form-control-sm" id="supplier_'+i+'" type="text"  onchange="doPengeluaran();saved('+i+');"><input  id="id_supplier_'+i+'" type="hidden"></td>';
		cols +='<td><input type="text" id="jum_'+i+'" class="form-control form-control-sm"/></td><td> <input type="text" id="pharga_'+i+'" class="form-control form-control-sm" onkeyup="formatNumber(this)"/></td><td> <input type="text" id="psatuan_'+i+'" class="form-control form-control-sm" value="0" onchange="doPengeluaran();saved('+i+')" /></td><td> <input type="text" id="ptotal_'+i+'" class="form-control form-control-sm"/></td><td> <button class="btn btn-danger btn-sm" onclick="del_more('+i+');"><i class="fa fa-times"></i></button></td></tr></tbody>';
		$('#table_pengeluaran').append(cols);
		insert_detail_pengeluaran(i);
		load_jenis(i);
		satuan_load(i);
		supplier_load(i);
	}); //--end function--------------------------
	function insert_detail_pengeluaran(a) {
		var str = $("#id_pengeluaran").text();
		$.ajax({
			type: "POST",
			url: base_url + "pengeluaran/add_detail",
			data: { id: str },
			dataType: "json",
			success: function(res) {
				if (res.ok == 'ok') {
					$("#id_pengeluaran_" + a).val(res.idr);
					$("#jenis_" + a).val('-');
					$("#id_jenis_" + a).val(res.jenis);
					} else {
					sweet('Peringatan!!!',res.msg,'warning','warning');
				}
			}
		});
	}
	function save_data() {
		var id = $("#idpengeluaran").val(); 
		var tempo = $("#tempo").val(); 
		var jenis_bayar = $("#jenis_bayar").val(); 
		var kas = $("#kas").val(); 
		var total = angka($("#total_pengeluaran").val());
		if(jenis_bayar!=3){
			var tempo = null; 
		}
		$.ajax({
			type: "POST",
			url: base_url + "pengeluaran/save_data",
			data: { id:id,tempo:tempo,jenis_bayar:jenis_bayar,kas:kas,total:total},
			dataType: "json",
			success: function(res) {
				$("#tempo").val(res.tgl)
			}
		});
	}
	function saved(a) {
		id = document.getElementById("id_pengeluaran_" + a.toString()).value; 
		ket = document.getElementById("uraian_" + a.toString()).value; 
		jenis = document.getElementById("id_jenis_" + a.toString()).value; 
		jum = angka(document.getElementById("jum_" + a.toString()).value); 
		harga = angka(document.getElementById("pharga_" + a.toString()).value); 
		satuan = document.getElementById("psatuan_" + a.toString()).value; 
		$.ajax({
			type: "POST",
			url: base_url + "pengeluaran/save_detail",
			data: { id:id,ket:ket,jum:jum,harga:harga,satuan:satuan,jenis:jenis},
			dataType: "json",
			success: function(res) {
				if (res.ok == 'ok') {
					$("#id_pengeluaran_" + a).val(res.id);
					} else {
					alert('error');
				}
			}
		});
	}
	function del_more(i){
		id = document.getElementById("id_pengeluaran_" + i.toString()).value; 
		$.ajax({
			type: "POST",
			url: base_url + "pengeluaran/hapus_detail",
			data: { id:id},
			dataType: "json",
			success: function(res) {
				if (res.ok == 'ok') {
					// $("#id_pengeluaran_" + a).val(res.id);
					jQuery('#row_Count' + i.toString()).remove();
					} else {
					alert('error');
				}
			}
		});
	}
	var c = $("#table_pengeluaran > tbody").children().length;	
	for (var a = 0; a < c; a++) {
		load_jenis(a);
		satuan_load(a);
		supplier_load(a);
	}
	function satuan_load(x){
		$('#psatuan_' + x).autocomplete({
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
					}
				});
			},
			autoFocus: true,
			minLength: 0,
			select: function(event, ui) {
				var names = ui.item.data.split("|");
				id_arr = $(this).attr('id');
				id = id_arr.split("_");
				$('#psatuan_' + id[1]).val(names[1]);
			}
			
		});
	}
	function load_jenis(a){
		$("#jenis_" + a).autocomplete({
			source: function(request, response) {
				$.ajax({
					url: base_url + 'produk/ajax',
					dataType: "json",
					method: 'post',
					data: {
						name_startsWith: request.term,
						type: 'jenis_pengeluaran',
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
					}
				});
			},
			autoFocus: true,
			minLength: 0,
			select: function(event, ui) {
				var names = ui.item.data.split("|");
				$('#jenis_'+a).val(names[0]);
				$('#id_jenis_'+a).val(names[1]);
			},
			change: function (event, ui) {
				var names = ui.item.data;
				if(names[0]=="NONE"){
					$('#jenis_'+a).val("-");
					$('#id_jenis_'+a).val(1);
				}
			}
			
		});
	}
	
	function supplier_load(a){
		$("#supplier_" + a).autocomplete({
			source: function(request, response) {
				$.ajax({
					url: base_url + 'produk/ajax',
					dataType: "json",
					method: 'post',
					data: {
						name_startsWith: request.term,
						type: 'supplier',
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
					}
				});
			},
			autoFocus: true,
			minLength: 0,
			select: function(event, ui) {
				var names = ui.item.data.split("|");
				$('#supplier_'+a).val(names[0]);
				$('#id_supplier_'+a).val(names[1]);
			},
			change: function (event, ui) {
				var names = ui.item.data.split("|");
				if(names[0]=="NONE"){
					$('#supplier_'+a).val("-");
					$('#id_supplier_'+a).val(1);
				}
			}
			
		});
	}
</script>																