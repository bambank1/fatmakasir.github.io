<thead class="thead-dark">
	<tr>
		<th>Pendapatan</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
</thead>
<tbody>
	
	<tr>
		<td><?=$pendapatan->nama_reff;?></td>
		<td class="text-right"></td>
		<td class="text-right"><?=rp($saldo);?></td>
	</tr>
	<?php 
		$hpp = sum_hpps($bulan,$tahun);
		$laba_kotor =$saldo - $hpp ;
	?>
</tbody>

<thead class="thead-dark">
	<tr>
		<th>Harga Pokok Penjualan</th>
		<th>&nbsp;</th>
		<th class="text-right text-white"><?=rprp($hpp);?></th>
	</tr>
</thead>
<thead class="thead">
	<tr>
		<th>Laba Kotor</th>
		<th>&nbsp;</th>
		<th class="text-right"><?=rprp($laba_kotor);?></th>
	</tr>
</thead>
<thead class="thead-dark">
	<tr>
		<th>Beban & Biaya</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
</thead>

<tbody>
	<?php 
		$total_beban = 0;
		foreach($pengeluaran AS $val){
			$beban = sum_jurnal('debit',$val->no_reff,$bulan,$tahun);
		?>
		<tr>
			<td><?=$val->keterangan;?></td>
			<td class="text-right"><?=rp($beban->total);?></td>
			<td class="text-right"></td>
		</tr>
		<?php 
			$total_beban += $beban->total;
		} ?>
</tbody>

<?php 
	$laba = 0;
	$rugi = 0;
	$laba_rugi = $saldo - $hpp;
	if($laba_rugi > $total_beban){
		$laba = $laba_rugi - $total_beban;
	?>
	<tfoot class="thead-dark">
		<tr>
			<th>LABA BERSIH</th>
			<th>&nbsp;</th>
			<th class="text-right"><?=rprp($laba);?></th>
		</tr>
	</tfoot>	
	<?php }elseif($total_beban > $laba_rugi){ 
		$rugi = $laba_rugi - $total_beban;
	?>
	<tfoot class="thead-dark">
		<tr>
			<th>LABA RUGI</th>
			<th>&nbsp;</th>
			<th class="text-right"><?=rprp($rugi);?></th>
		</tr>
	</tfoot>
	<?php }else{ ?>
	<tfoot class="thead-dark">
		<tr>
			<th>LABA RUGI</th>
			<th class="text-right"><input type="hidden">0</th>
			<th class="text-right"><input type="hidden">0</th>
		</tr>
	</tfoot>
<?php } ?>
<tfoot class="thead-">
	<tr>
		<th>Total Beban</th>
		<th class="text-right"><input type="hidden" id="total_sum" value="<?=($total_beban);?>"><?=rprp($total_beban);?></th>
		<th>&nbsp;</th>
	</tr>
</tfoot>	
