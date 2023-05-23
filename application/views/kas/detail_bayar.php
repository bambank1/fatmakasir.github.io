<div class="table-responsive-sm">
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th style="width:2%">No</th>
				<th style="width:5%">Nama Bank/Merchant</th>
				<th class="text-right" style="width:3%">Total KAS</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$totsetors = 0;
				$total = 0;
				// print_r($result);
				if(!empty($result)) {
					$no=1;
					foreach($result AS $rows){
					$total = $rows->total - $rows->total_pengeluaran;
					
					?>
					<tr>
						<td><?=$no;?></td>
						<td><?=$rows->inisial;?></td>
						<td class="text-right"><?=rp($total);?></td>	 
					</tr>
					<?php 
						 
						$no++;
					}
					
				}else{ ?>
				<tr>
					<td colspan="11">Data belum ada</td>
				</tr> 
			<?php }?>
		</tbody>
	</table>
</div>