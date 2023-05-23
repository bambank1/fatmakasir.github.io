
<div class="table-responsive">
	<table class="table align-items-center table-flush">
		<thead class="thead-light">
			<tr>
				<th>Jenis Produk & Jasa</th>
				<th class="text-right w-5">Jumlah</th>
				<th class="text-right w-15">Omset</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$jumlah = 0;
				$grandtotal = 0;
			if(!empty($result)){
				$no = 1;
				foreach ($result as $row){
					// $total = $row->jml * $row->harga;
					$jumlah += $row->jumlah;
					$total = $row->total - $row->diskon;
					$grandtotal += $row->total - $row->diskon;
				?>
				<tr>
					<td><?=$row->jenis_cetakan;?></td>
					<td class="text-right"><?=$row->jumlah;?></td>
					<td align="right"><?=rp($total);?></td>
				</tr>
			<?php }} ?>
		</tbody>
		<tfoot class="thead-light">
			<tr>
				<th>Total Omset</th>
				<th class="text-right"><?=$jumlah;?></th>
				<th class="text-right"><?=rp($grandtotal);?></th>
			</tr>
		</tfoot>
	</table>
</div>
