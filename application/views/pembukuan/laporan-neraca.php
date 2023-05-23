<thead class="thead-dark">
	<tr>
		<th>Aktiva Lancar</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
</thead>
<tbody>
	<?php 
	$total_aktiva = 0;
	foreach($aktiva AS $val){
		$sum_debit = sum_jurnal('debit',$val->no_reff,$bulan,$tahun);
		$sum_kredit = sum_jurnal('kredit',$val->no_reff,$bulan,$tahun);
	?>
	<tr>
		<td><?=$val->nama_reff;?></td>
		<td class="text-right"></td>
		<td class="text-right"><?=rp($sum_debit->total);?></td>
	</tr>
	<?php
		$total_aktiva +=$sum_debit->total;
		} ?>
</tbody>

<thead class="thead">
	<tr>
		<th>Jumlah Aktifa Lancar</th>
		<th>&nbsp;</th>
		<th class="text-right"><?=rp($total_aktiva);?></th>
	</tr>
</thead>
<thead class="thead-dark">
	<tr>
		<th>Aktiva Tetap</th>
		<th>&nbsp;</th>
		<th class="text-right text-white"></th>
	</tr>
</thead>
<tbody>
	<?php 
	$total_pasiva = 0;
	foreach($pasiva AS $val){
		$sum_pasiva = sum_jurnal('debit',$val->no_reff,$bulan,$tahun);
	?>
	<tr>
		<td><?=$val->nama_reff;?></td>
		<td class="text-right"><?=rp($sum_pasiva->total);?></td>
		<td class="text-right"></td>
	</tr>
	<?php
		$total_pasiva +=$sum_pasiva->total;
		} ?>
</tbody>
<thead class="thead">
	<tr>
		<th>Jumlah Aktiva Tetap</th>
		<th class="text-right"><?=rprp($total_pasiva);?></th>
		<th class="text-right"></th>
	</tr>
</thead>
<thead class="thead-dark">
	<tr>
		<th>Kewajiban</th>
		<th>&nbsp;</th>
		<th class="text-right text-white"></th>
	</tr>
</thead>
<tbody>
	<?php 
		$total_kewajiban = 0;
		foreach($kewajiban AS $val){
			$sum_kewajiban = sum_jurnal('kredit',$val->no_reff,$bulan,$tahun);
		?>
		<tr>
			<td><?=$val->keterangan;?></td>
			<td class="text-right"><?=rp($sum_kewajiban->total);?></td>
			<td class="text-right"></td>
		</tr>
		<?php
			$total_kewajiban += $sum_kewajiban->total;
		} ?>
</tbody>
<thead class="thead">
	<tr>
		<th>Total Kewajiban</th>
		<th class="text-right"><?=rprp($total_kewajiban);?></th>
		<th>&nbsp;</th>
	</tr>
</thead>
<thead class="thead-dark">
	<tr>
		<th>Modal</th>
		<th>&nbsp;</th>
		<th class="text-right text-white"></th>
	</tr>
</thead>
<tbody>
	<?php 
		$total_modal = 0;
		foreach($modal AS $val){ 
			$sum_modal = sum_jurnal('kredit',$val->no_reff,$bulan,$tahun);
		?>
		<tr>
			<td><?=$val->nama_reff;?></td>
			<td class="text-right"><?=rprp($sum_modal->total);?></td>
			<td class="text-right"></td>
		</tr>
		<?php 
			$total_modal += $sum_modal->total;
		}
		$total = $total_kewajiban+$total_modal;
		?>
</tbody>
<thead class="thead">
	<tr>
		<th>Total Kewajiban dan Modal</th>
		<th class="text-right"><?=rprp($total);?></th>
		<th>&nbsp;</th>
	</tr>
</thead>