<div class="table-responsive-sm p-0">
	<div class="card-block p-0">
		<table class="table table-striped table-mailcard" id="jsonuser">
			<thead>
				<tr>
					<th style="width:3% !important;">NO.ORDER</th>
					<th style="width:9% !important;">TGL.ORDER</th>
					<th class="w-10">PELANGGAN</th>
					<th style="width:5% !important;">KASIR</th>
					<th class="text-right w-10">STATUS</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($posts)){ 
					$no=$this->uri->segment(3)+1;
					foreach($posts as $row){
						$sumPiutang = sumPiutang($row["id_invoice"]);
						$sisa = $row['total_bayar'] - $sumPiutang[0]['piutang'];
						$lunas = '';
						if($sisa > 0){
							$lunas = '<span class="badge badge-primary flat">SISA<br>'.rp($sisa).'</span>';
							}
						if($row['status'] =='baru'){
							$lunas = '<span class="badge badge-info flat">BARU</span>';
						}
						if($row['status'] =='pending'){
							$lunas = '<span class="badge badge-warning flat">PENDING</span>';
						}
						if($row['lunas'] ==1){
							$lunas = '<span class="badge badge-success flat">LUNAS</span>';
						}
						$detail = detail_order($row['id_invoice']);
					?>
					<tr>
						<td><button data-id="<?php echo $row["id_invoice"]; ?>" data-modEdit="" id="cart" class="btn btn-info btn-sm flat cek_transaksi">#<?php echo $row["id_transaksi"]; ?></button></td>
						<td><?php echo dtimes($row["tgl_trx"],false,false); ?></td>
						<td><?php echo $row["nama"].' - '.$row["no_hp"]; ?></td>
						<td><?php echo $row["nama_lengkap"]; ?></td>
					<td align='right'><?php echo $lunas; ?></td>
					</tr>
					
					<tr> 
					<th class="w-2">QTY</th>
					<th class="text-left">Harga</th>
					<th class="text-left">Sub_total</th>
					<th class="text-left">Produk</th>
					<th class="text-right">Keterangan</th>
					</tr>
					
					<?php 
						$detail = detail_order($row['id_invoice']);
						// print_r($detail);
						$subtotal = 0;
						$num = 1;
						foreach($detail AS $val)
						{ 
							$subtotal = $val->jumlah * $val->harga;
							
						?>
						<tr>
							<td><?=$val->jumlah;?></td>
							<td class="text-left"><?=rp($val->harga);?></td>
							<td class="text-left"><?=rp($subtotal);?></td>
							<td class="text-left"><?=nama_produk($val->id_produk);?></td>
							<td class="text-right"><?=$val->keterangan;?></td>
						</tr>
						
						
					<?php }  $no++; } }else{ ?>
					<tr><td colspan="5">Belum ada penjualan</td></tr>
				<?php } ?>
			</tbody>
		</table>
		<nav aria-label="Page navigation example" class="p-2">
			<?php echo $this->ajax_pagination->create_links(); ?>
		</nav>
	</div><!-- /.card-body -->
</div><!-- /.card-body -->
<style>
	.custom-select {
    display: inline-block;
    width: 100%;
    height: 30px;
    padding: 5px 1.75rem 5px .75rem;
	
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 2px;
	
	}
	.card .table td, .card .table th {
    padding-right: 5px;
    padding-left: 5px;
	}
	
</style>
<script>
	$('.cek_transaksi').click(function(e){
		e.preventDefault();
		var id =  $(this).data("id") // will return the number 123
		var mod = $(this).data('modedit');
		$('#myModalTab').modal('hide');
		
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