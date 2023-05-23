<div class="table-responsive-sm">
	<table class="table">
		<tbody>
			<?php 
				if(!empty($posts)) {
					$no=1;
					foreach($posts AS $row){ 
						$bayar = bayar($row['id_invoice']);
						$id_invoice = encrypt_url($row['id_invoice']);
						$url_pdf = base_url().'operator/print_invoice/'.$id_invoice;
						$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><i class="fa fa-file-pdf-o"></i> CETAK PDF</a>';
						$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'") > <i class="fa fa-print"></i> Print </a>';
						$detail = detail_order($row['id_invoice']);
					?>
					<thead class="thead-dark">
						<tr>
							<th>No.Order</th>
							<th>Tgl.Order</th>
							<th>Tgl.Selesai</th>
							<th class="text-right">Customer</th>
							<th class="text-right">Kasir</th>
							<th class="text-right">Aksi</th>
						</tr>
					</thead>
					<tr>
						<td><button class="btn btn-info btn-sm flat"><?php echo $row["id_transaksi"]; ?></button></td>
						<td><?=dtimes($row['tgl_trx'],false,false);?></td>
						<td><?=dtimes($row['tgl_ambil'],true,false);?></td>
						<td class="text-right"><?=$row['nama'];?></td>
						<td class="text-right"><span class="badge badge-success flat"><?=$row['kasir'];?></span></td>
						<td class="text-right"><div class="btn-group dropleft">
							<button type="button" class="btn btn-danger btn-sm customs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-print"></i> Cetak SPK
							</button>
							<div class="dropdown-menu">
								<?=$pdf;?>
								<?=$print;?>
							</div>
						</div></td>
					</tr> 
					<thead class="thead-light">
						<tr> 
							<th>QTY</th>
							<th class="text-right">Produk</th>
							<th class="text-right">Bahan</th>
							<th class="text-right">Keterangan</th>
							<th class="text-right">Operator</th>
							<th class="text-right">Status</th>
						</tr>
					</thead>
					<?php 
						$finishing ='';
						$num = 1;
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
							
							$bahan =  getDetailBahan($val->id_bahan)->title;
							if(!empty($val->detail)){
								$finishing = json_decode($val->detail);
							}
						?>
						<tr>
							<td><?=$val->jumlah;?></td>
							<td class="text-right"><?=nama_produk($val->id_produk);?></td>
							<td class="text-right"><?=$bahan;?></td>
							<td class="text-right">
								<?php
									if(!empty($finishing)){
										foreach($finishing->data  AS $key=>$vals){
											echo ' | '.$vals->title.':'.$vals->isi.' | '; 
										}
									}
								?>
							</td>
							<td class="text-right"><?=$operator;?></td>
							<td class="text-right"><?=$status;?></td>
						</tr>
						<?php 
						} 
						$count_status = count_status($row['id_invoice']);
						$sum_status = sum_status($row['id_invoice']);
						$total = $count_status * 2;
						if($sum_status==$total){
							$status_update = '<button class="btn btn-success btn-sm flat">Selesai</button>';
							$share = '<button class="btn btn-info btn-sm flat kirim_wa" data-id="'.$id_invoice.'" data-nomor="'.$row["no_hp"].'" data-trx="'.$row["id_transaksi"].'"  data-tgl="'.$row["tgl_trx"].'" ><i class="fa fa-whatsapp"></i> Kirim</button>';
							}else{
							$status_update = '<button class="btn btn-info btn-sm flat get_status" data-id="'.$row['id_invoice'].'">Update Status</button>';
							$share = '';
						}
					?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td colspan="2" class="text-right"><button class="btn btn-secondary btn-sm flat cetak_order"><i class="fa fa-print"></i> Cetak Semua</button><?= $status_update.$share;?></td>
					</tr>
					<?php
						
					}}else{ ?>
					<tr>
						<td colspan="11">Data belum ada</td>
					</tr> 
			<?php }?>
		</tbody>
	</table>
	<nav aria-label="Page navigation" class="mt-2">
		<?php echo $this->ajax_pagination->create_links(); ?>
	</nav>
</div>	
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
	
</script>