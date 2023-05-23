<div class="table-responsive-sm">
	<table class="table">
		<thead>
			<tr>
				<th style="width:1%;" class="text-center">No.</th>
				<th style="width:1%"  class="text-center">No.Order.</th>
				<th style="width:8%"  class="text-left">Pelanggan</th>
				<th style="width:8%"  class="text-left">Kasir</th>
				<th style="width:2%"  class="text-left">Tgl.Order</th>
				<th style="width:5%"  class="text-right">Order</th>
				<th style="width:5%"  class="text-right">Pajak</th>
				<th style="width:5%"  class="text-right">Diskon</th>
				<th style="width:5%"  class="text-right">Total</th>
				<th style="width:5%"  class="text-right">Bayar</th>
				<th style="width:5%"  class="text-right">Piutang</th>
				<th style="width:2%" class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no=1;
				$t_omset=0;
				$total_beli=0;
				$totalDiskon=0;
				$totalbeli=0;
				$Totalbayar=0;
				$total_bayar=0;
				$total_diskon=0;
				$diskon=0;
				$piutang=0;
				$subtotal=0;
				$total_pajak=0;
				$total_piutang=0;
				foreach($result as $val){
					$id_invoice = encrypt_url($val['id_invoice']);
					$aksi = '';
					
					$rows = bayar($val['id_invoice']);
					if (isset($rows)) {
						$Totalbayar = $rows['Totalbayar'];
						}else{
						$Totalbayar = 0;
					}
					$t_order = sumOrder($val['id_invoice']);
					$t_omset = sumOrder($val['id_invoice']);
					$totalDiskon = totalDiskon($val['id_invoice']);
					$t_omset = $t_omset - $totalDiskon;
					$piutang = sumPiutang($val['id_invoice']);
					if($val['pajak']>0){
						$sub_tpajak = ($t_omset * $val['pajak']) /100;
						$piutang =  $t_omset + $sub_tpajak - $Totalbayar;
						}else{
						$piutang = $t_omset - $piutang[0]['piutang'];
						$sub_tpajak = $val['pajak'];
					}
					
					$subtotal = $val['jumlah'] * $val['harga'];
					if($val['diskon'] > 0){
						$diskon = ($subtotal * $val['diskon']) /100;
						$subtotal = $subtotal - $diskon;
						}else{
						$diskon = 0;
						$subtotal = $subtotal;
					}
					if($val['sisa'] >0){
						$aksi = '<button type="button" data-type="piutang" data-id="'.$id_invoice.'" data-trx="'.$val["id_transaksi"].'"  data-bayar="'.$piutang[0]['piutang'].'" data-sisa="'.$val['sisa'].'" data-total="'.sumOrder($val['id_invoice']).'" class="btn btn-info btn-sm bayar_sisa">BAYAR</button>';
					}
					$t_omset = sumOrder($val['id_invoice']);
					$totalDiskon = totalDiskon($val['id_invoice']);
					$t_omset = $t_omset - $totalDiskon;
					$piutang = sumPiutang($val['id_invoice']);
					if($val['pajak']>0){
						$sub_tpajak = ($t_omset * $val['pajak']) /100;
						$piutang =  $t_omset + $sub_tpajak - $Totalbayar;
						}else{
						$piutang = $t_omset - $piutang[0]['piutang'];
						$sub_tpajak = $val['pajak'];
					}
					$id_invoice = encrypt_url($val['id_invoice']);
					
					$totalbeli += $val['totalbeli'];
					$total_beli += $t_omset;
					$total_diskon += $diskon;
					$total_bayar += $val['totalbayar']+$val['diskon'];
					$total_pajak += $sub_tpajak;
					$total_piutang += $piutang;
				?>
				<tr>
					<td class="text-center"><?php echo $no;?></td>
					<td class="text-center">#<?=$val['id_transaksi'];?></td>
					<td class="text-left">
						<a data-toggle="tooltip" data-original-title="Kirim Ke <?=$val["no_hp"]; ?>" data-placement="left" class="text-success kirim_wa" data-id="<?=$id_invoice;?>" data-nomor="<?=($val["no_hp"]);?>" data-trx="<?=($val["id_transaksi"]);?>"  data-tgl="<?=$val["tgl_trx"];?>" href="javascript:void(0)" ><i class="fa fa-whatsapp"></i> &nbsp;<?php echo $val["namak"]; ?></a>
					</td>
					<td class="text-left"><?=$val['fo'];?></td>
					<td class="text-left"><?=date_time($val['tgl_trx'],false);?></td>
					<td class="text-right"><?=rp($t_order);?></td>
					<td class="text-right"><?=rp($sub_tpajak);?></td>
					<td class="text-right"><?=rp($totalDiskon);?></td>
					<td class="text-right"><?=rp($t_omset);?></td>
					<td class="text-right"><?=rp($val['totalbayar']);?></td>
					<td class="text-right"><?=rp($piutang);?></td>
					<td class="text-left"><?=$aksi;?></td>
				</tr>
			<?php $no++; } ?>
			
		</tbody>
		<tfoot>
			<thead class="thead-dark">
				<tr>
					<th colspan="5" style="width:1%;" class="text-left">Total</th>
					<th style="width:5%"  class="text-right"><?=rp($totalbeli);?></th>
					<th style="width:5%"  class="text-right"><?=rp($total_pajak);?></th>
					<th style="width:5%"  class="text-right"><?=rp($total_diskon);?></th>
					<th style="width:5%"  class="text-right"><?=rp($total_beli);?></th>
					<th style="width:5%"  class="text-right"><?=rp($total_bayar);?></th>
					<th style="width:5%"  class="text-right"><?=rp($total_piutang);?></th>
					<th class="text-center"></th>
					
				</tr>
			</thead>
		</tfoot>
	</table>							
	<script>
		$(".kirim_wa").click(function(e) {
			e.preventDefault();
			var id = $(this).attr('data-id');
			var nomor = $(this).attr('data-nomor');
			var trx = $(this).attr('data-trx');
			var tgl = $(this).attr('data-tgl');
			// console.log(id);
			$('#WaLabel').html('Kirim '+trx);  
			$('#OpenModalWa').modal({backdrop: 'static', keyboard: false})  
			$.ajax({
				url: base_url + 'whatsapp/get_form_wa',
				data: {id:id,nomor:nomor,tgl:tgl},
				method: 'POST',
				dataType:'html',
				beforeSend: function(){
					$('body').loading();
				},
				success: function(data) {
					$(".load-data-wa").html(data);
					$('body').loading('stop');
				},
				error: function(xhr, status, error) {
					var err = xhr.responseText ;
					sweet('Server!!!',err,'error','danger');
					$('body').loading('stop');
				}
			});
		});
		
		$('.cek_transaksi').click(function(e){
			e.preventDefault();
			var id =  $(this).data("id") // will return the number 123
			var mod = $(this).data('modedit');
			
			$.ajax({
				type: 'POST',
				url: base_url + "main/cek_akses",
				data: {id:id,mod:mod},
				dataType: "json",
				beforeSend: function () {
					$.LoadingOverlay("show", {
						background  : "rgba(165, 190, 100, 0.7)",
						fade:500,
						zIndex:100
					});
				},
				success: handleCart,
				error: function (xhr, ajaxOptions, thrownError) {
					sweet('Peringatan!!!',thrownError,'warning','warning');
				}
			});
		});
	</script>			