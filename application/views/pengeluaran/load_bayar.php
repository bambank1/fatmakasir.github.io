<div class='row'>
	<div class="col-md-12">
		<div class="d-flex">
			<div class="mr-auto p-2"><div class="d-inline p-1 bg-info text-white">No. <span id="id_pengeluaran"><?=$loadp->id_pengeluaran;?></span></div><div class="d-inline p-1 bg-warning text-white">Pencatat :<span id="nama"><?=$nama;?></span></div></div>
			<div class="p-2">
				
				<div class="input-group input-group-sm flat">
					<span class="input-group-prepend">
						<span class="input-group-text flat">Tanggal</span>
					</span>
					<input type="text" class="form-control form-control-sm flat date_p" id="date_p" value="<?=date_time($loadp->tgl_pengeluaran);?>" readonly>
				</div>
				
			</div>
			<div class="p-2">
				<div class="input-group input-group-sm bg-default border-0">
					<span class="input-group-prepend bg-default">
						<span class="input-group-text flat bg-warning border-0">Jatuh tempo</span>
					</span>
					<input type="text" class="form-control form-control-sm flat date_p" id="tempo" value="" readonly>
					
				</div>
			</div>
			<div class="p-2">
				<div class="input-group input-group-sm flat">
					<span class="input-group-prepend flat">
						<span class="input-group-text flat bg-info border-0">Sumber Kas</span>
					</span>
					<select name="kas" id="kas" class="form-control form-control-sm custom-select flat">
						<option value="0">Pilih</option>
						<?php
							foreach($kas AS $val){
								echo "<option value='{$val->id}'>$val->title</option>";
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<table class="table table-striped table-sm" id="table_pengeluaran">
			<thead class="thead-dark">
				<tr>
					<td>Uraian</td>
					<td>Jenis</td>
					<td>Supplier</td>
					<td>Qty</td>
					<td>Nominal</td>
					<td>Satuan</td>
					<td>Sub total</td>
				</tr>
			</thead>
			
			<?php 
				$no=0;
				foreach($loadd AS $val){ ?>
				<tbody><tr class="row_Count" id="row_Count<?=$no;?>">
					<td><input value="<?=$val['no'];?>" id="id_pengeluaran_<?=$no;?>" type="hidden"><input class="form-control form-control-sm flat" value="<?php echo !empty($val['keterangan']) ? $val['keterangan'] : ''; ?>" id="uraian_<?=$no;?>"  type="text" readonly></td>
					<td><input class="form-control form-control-sm flat" id="jenis_<?=$no;?>" type="text" value="<?=$val['title'];?>" readonly><input value="<?=$val['id_biaya'];?>" id="id_jenis_<?=$no;?>" type="hidden"></td>
					<td><input class="form-control form-control-sm flat" id="supplier_<?=$no;?>" type="text" value="<?=$val['nama_perusahaan'];?>" readonly><input value="<?=$val['id_supplier'];?>" id="id_supplier_<?=$no;?>" type="hidden"></td>
					<td><input class="form-control form-control-sm flat" id="jum_<?=$no;?>" type="text" value="<?=$val['jumlah'];?>" readonly></td>
					<td><input class="form-control form-control-sm flat" id="pharga_<?=$no;?>" type="text" value="<?=$val['harga'];?>" readonly></td>
					<td><input class="form-control form-control-sm flat" id="psatuan_<?=$no;?>" type="text" value="<?=$val['satuan'];?>" readonly></td>
					<td><input class="form-control form-control-sm flat" id="ptotal_<?=$no;?>" type="text" readonly></td>
				</tr></tbody>
			<?php $no++;} ?>
			
			<tfoot>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>Total</td>
					<td><input class="form-control form-control-sm flat" id="total_pengeluaran" type="text" readonly></td>
					
				</tr>
				<tr>
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
	$(document).ready(function(){
		$('#total-kas').val(formatMoney(0,0,"Rp."));
		$(".simpan_pengeluaran").removeClass('simpan_pengeluaran').addClass('bayar_pengeluaran').attr("disabled",false);
		$(".bayar_pengeluaran").removeClass('btn-success').addClass('btn-info');
		$(".bayar_pengeluaran").html('Bayar');
		$("#exampleModalLabel").html('Bayar pengeluaran');
		doPengeluaran();
	});
	
	 
	
	$("#kas" ).change(function() {
		var id = $("#kas").val();
		$.ajax({
			url:  base_url+"kas/total_kas",
			data:{id:id},
			dataType: "json",
			method: 'post',
			success: function (data) {
				$('#total-kas').val(formatMoney(data,0,"Rp."));
			}
		});
	});
	
	
</script>																				