<?php
	$html = '';
	foreach($posts AS $row)
	{
		$bayar = bayar($row['id_invoice']);
		// if($bayar > 0){
			$detail = detail_pekerjaan($row['id_invoice']);
			foreach($detail AS $val)
			{
				if($val->status==1){
					$status = '<button class="btn btn-info btn-sm flat edit_proses" data-id="'.$val->id_rincianinvoice.'">Proses</button>';
					}elseif($val->status==2){
					$status = '<button class="btn btn-success btn-sm flat">Selesai</button>';
					}else{
					$status = '<button class="btn btn-warning btn-sm flat edit_baru" data-id="'.$val->id_rincianinvoice.'">Baru</button>';
				}
				$operator = '-';
				if($val->id_operator!=0){
					$operator = juser($val->id_operator);
				}
			?>
			<tr>
				<td><?=$row['id_transaksi'];?></td>
				<td><?=$val->jumlah;?></td>
				<td class="text-left"><?=nama_produk($val->id_produk);?></td>
				<td class="text-left"><?=jenis_cetakan($val->jenis_cetakan);?></td>
				<td class="text-left"><?=$val->keterangan;?></td>
				<td class="text-left"><?=$operator;?></td>
				<td class="text-right"><?=$status;?></td>
			</tr>
		<?php }  }			