<div class="table-responsive-sm">
	<table class="table">
		<tbody>
			<?php 
				$piutang=0;
				$t_omset=0;
				$totalDiskon=0;
				$total_order=0;
				$sub_tpajak=0;
				$Totalbayar=0;
				$diskon=0;
				$total_desain=0;
				if(!empty($result)) {
					$no=1;
					foreach($result AS $row){
						
						$id_invoice = encrypt_url($row['id_invoice']);
						$url_pdf = base_url().'operator/print_invoice/'.$id_invoice;
						$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><i class="fa fa-file-pdf-o"></i> CETAK PDF</a>';
						$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'") > <i class="fa fa-print"></i> Print </a>';
					?>
					<thead class="thead-dark">
						<tr>
							<th>No.Order</th>
							<th>Tgl.Order</th>
							<th class="text-right">Kasir</th>
							<th class="text-right">Desain</th>
							<th class="text-right">Aksi</th>
						</tr>
					</thead>
					<tr>
						<td>
							<div class="btn-group flat" role="group" aria-label="Basic example">
								<button class="btn btn-info btn-sm flat transaksi_desain" data-id="<?=$row["id_invoice"]; ?>" data-modEdit="view"><?php echo $row["id_transaksi"]; ?></button>
								<button type="button" class="btn btn-secondary btn-sm flat cari_data" data-id="<?php echo $row["id_transaksi"]; ?>"><i class="fa fa-search"></i></button>
							</div>
							
						</td>
						<td><?=dtimes($row['tgl_trx'],false,false);?></td>
						
						<td class="text-right"><span class="badge badge-success flat"><?=$row['kasir'];?></span></td>
						<td class="text-right"><span class="badge badge-success flat"><?=cekUser($row['id_desain'])['nama'];?></span></td>
						<td class="text-right">
							<?php if($row['status']=='pending' OR $row['status']=='baru'){?>
								<button type="button" class="btn btn-warning btn-sm flat" disabled>
									<i class="fa fa-print"></i> CETAK SPK
								</button>
								<?php }else{ ?>
								<div class="btn-group dropleft">
									<button type="button" class="btn btn-danger btn-sm customs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-print"></i> CETAK SPK
									</button>
									<div class="dropdown-menu">
										<?=$pdf;?>
										<?=$print;?>
									</div>
								</div>
							<?php } ?>
						</td>
					</tr> 
					
					<?php 
						
					}}else{ ?>
					<tr>
						<td colspan="5">Data belum ada</td>
					</tr> 
			<?php }?>
		</tbody>
		
	</table>
	<nav aria-label="Page navigation" class="p-2">
		<?php 
			echo $this->ajax_pagination->create_links(); 
		?>
	</nav>
</div>
<script>
	$('.cari_data').click(function(){
		$('#myModalTab').modal('show');
		var id =  $(this).data("id")
		$('#tab03').click();
		$('#cari_invoice_desain').attr('disabled',false);
		$('#updateDesain').attr('disabled',false);
		$('#cari_desain').val(id).focus();
		$('#cari_invoice_desain').click();
	})
		
	$('.transaksi_desain').click(function(e){
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
			success: handle_Cart,
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	});
</script>	