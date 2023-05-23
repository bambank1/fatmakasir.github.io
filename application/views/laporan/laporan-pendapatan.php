<?php
	$laba_bersih = $penjualan[0]->jml_bayar - $pengeluaran[0]->jml_bayar;
	
?>

<thead class="thead-dark">
	<tr>
		<th>Produk & Jasa</th>
		<th>&nbsp;</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>Penjualan Produk & Jasa</td>
		<td class="text-right"><?=rp($penjualan[0]->jml_bayar);?></td>
	</tr>
</tbody>

<thead class="thead-dark">
	<tr>
		<th>Beban & Biaya</th>
		<th>&nbsp;</th>
	</tr>
</thead>
<tbody>
	
	<tr>
		<td>Pengeluaran Biaya Produksi DLL</td>
		<td class="text-right"><?=rp($pengeluaran[0]->jml_bayar);?></td>
	</tr>
</tbody>
<thead class="thead-light">
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
</thead>
<tfoot class="thead-dark">
	<tr>
		<th>Total pendapatan</th>
		<th class="text-right"><input type="hidden" id="total_um" value="<?=($laba_bersih);?>"><?=rp($laba_bersih);?></th>
	</tr>
</tfoot>	