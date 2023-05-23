<div class="table-responsive-sm">
	<table class="table">
		<tbody>
			<?php 
				$omset_ppajak=0;
				$piutang=0;
				$t_omset=0;
				$totalDiskon=0;
				$total_pajak=0;
				$total_order=0;
				$total_piutang=0;
				$total_bayar=0;
				$sub_tpajak=0;
				$Totalbayar=0;
				$diskon=0;
				if(!empty($result)) {
					$no=1;
					foreach($result AS $row){
						$rows = bayar($row['id_invoice']);
						if (isset($rows)) {
							$Totalbayar = $rows['Totalbayar'];
							}else{
							$Totalbayar = 0;
						}
						$t_omset = sumOrder($row['id_invoice']);
						$totalDiskon = totalDiskon($row['id_invoice']);
						$t_omset = $t_omset - $totalDiskon;
						$piutang = sumPiutang($row['id_invoice']);
						if($row['pajak']>0){
							$sub_tpajak = ($t_omset * $row['pajak']) /100;
							$piutang =  $t_omset + $sub_tpajak - $Totalbayar;
							}else{
							$piutang = $t_omset - $piutang[0]['piutang'];
							$sub_tpajak = $row['pajak'];
						}
						if($row['status']=='batal'){
							$Totalbayar = 0;
							$t_omset = 0;
						}
						if($row["oto"]==0){
							$status = 'Buka';
							$view = 'edit';
							}elseif($row["oto"]==1){
							$status = 'Edit Order';
							$view = 'edit';
							}elseif($row["oto"]==2){
							$status = 'Hapus Pembayaran';
							$view = 'view';
							}elseif($row["oto"]==3){
							$status = 'Edit Order Lunas';
							$view = 'edit';
							}elseif($row["oto"]==4){
							$status = 'Pending';
							$view = 'view';
							}elseif($row["oto"]==5){
							$status = 'Batal';
							$view = 'view';
							}else{
							$status = 'Kunci';
							$view = 'view';
						}
					?>
					<thead class="thead-dark">
						<tr>
							<th>No.Order</th>
							<th>Tgl.Order</th>
							<th>Tgl.Selesai</th>
							<th class="text-right">Customer</th>
							<th class="text-right">Pajak</th>
							<th class="text-right">Total_Order</th>
							<th class="text-right">Bayar</th>
							<th class="text-right">Piutang</th>
							<th class="text-right">Kasir</th>
						</tr>
					</thead>
					<tr>
						<td><button class="btn btn-info btn-sm flat cek_transaksi" data-id="<?php echo $row["id_invoice"]; ?>" data-modEdit="<?=$view;?>"  id="cart"><?php echo $row["id_transaksi"]; ?></button></td>
						<td><?=dtimes($row['tgl_trx'],false,false);?></td>
						<td><?=dtimes($row['tgl_ambil'],true,false);?></td>
						<td class="text-right"><?=$row['nama'];?></td>
						<td class="text-right"><?=rp($sub_tpajak);?> </td>
						<td class="text-right"><?=rp($t_omset);?></td>
						<td class="text-right"><?=rp($Totalbayar);?></td>
						<td class="text-right"><?=rp($piutang);?></td>
						<td class="text-right"><span class="badge badge-success flat"><?=$row['kasir'];?></span></td>
					</tr> 
					<thead class="thead-light">
						<tr> 
							<th>QTY</th>
							<th class="text-right">Harga</th>
							<th class="text-right">Diskon</th>
							<th class="text-right">Sub_total</th>
							<th class="text-right">Produk</th>
							<th class="text-right">Jenis</th>
							<th colspan="3" class="text-right">Keterangan</th>
						</tr>
					</thead>
					<?php 
						$detail = detail_order($row['id_invoice']);
						// print_r($detail);
						$subtotal = 0;
						$num = 1;
						foreach($detail AS $val)
						{ 
							$subtotal = $val->jumlah * $val->harga;
							if($val->diskon > 0){
								$diskon = ($subtotal * $val->diskon) /100;
								$subtotal = $subtotal - $diskon;
								}else{
								$diskon = 0;
								$subtotal = $subtotal;
							}
						?>
						<tr>
							<td><?=$val->jumlah;?></td>
							<td class="text-right"><?=rp($val->harga);?></td>
							<td class="text-right"><?=rp($diskon);?></td>
							<td class="text-right"><?=rp($subtotal);?></td>
							<td class="text-right"><?=nama_produk($val->id_produk);?></td>
							<td class="text-right"><?=jenis_cetakan($val->jenis_cetakan);?></td>
							<td colspan="3" class="text-right"><?=$val->keterangan;?></td>
						</tr>
						<?php 
						}
						
						
						$total_order += $t_omset;
						$total_pajak += 0;
						$total_bayar += $Totalbayar;
						$total_piutang += $piutang;
					}}else{ ?>
					<tr>
						<td colspan="11">Data belum ada</td>
					</tr> 
			<?php }?>
		</tbody>
		<tfoot>
			<thead class="thead-dark">
				<tr>
					<th colspan="3">Total</th>
					<th class="text-right">&nbsp;</th>
					<th class="text-right">Pajak</th>
					<th class="text-right">Total_Order</th>
					<th class="text-right">Bayar</th>
					<th class="text-right">Piutang</th>
					<th class="text-right">&nbsp;</th>
				</tr>
			</thead>
			<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th class="text-right"><?=rp($total_pajak);?></th>
				<th class="text-right"><?=rp($total_order);?></th>
				<th class="text-right"><?=rp($total_bayar);?></th>
				<th class="text-right"><?=rp($total_piutang);?></th>
				<th>&nbsp;</th>
			</tr>
		</tfoot>
	</table>
	<nav aria-label="Page navigation" class="p-2">
		<?php 
			echo $this->ajax_pagination->create_links(); 
		?>
	</nav>
</div>
<script>
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