<div class="table-responsive-sm">
	<div class="card-block">
		<table class="table table-striped table-mailcard" id="jsonuser">
			<thead>
				<tr>
					<th style="width:4% !important;">NO.ORDER</th>
					<th class="pl-0" style="width:14% !important;">TGL.ORDER</th>
					<th class="w-10">PELANGGAN</th>
					<th style="width:10% !important;">KASIR</th>
					<th class="text-right w-10">TOTAL</th>
					<th class="text-right w-10">BAYAR</th>
					<th class="text-right w-10">SISA</th>
					<th style="width:3%;">STATUS</th>
					<th style="width:3%;">LUNAS</th>
					<th style="width:3%;">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($posts)){ 
					$no=1;
					$totalorder=0;
					$totalbayar=0;
					$totalsisa=0;
					foreach($posts as $row){
						$pdf = $print = $target = $pelunasan = $edit = $batal = $view = '';
						$lunas = '<span class="badge badge-primary flat">BELUM</span>';
						$id_invoice = encrypt_url($row['id_invoice']);
						$url_pdf = base_url().'produk/print_invoice/'.$id_invoice;
						$url_print = base_url().'produk/print_invoice_html/'.$id_invoice;
						
						echo "<script>
						var url_print =  '$url_print';
						</script>";
						if($row["oto"]==0){
							$status = 'BUKA';
							$view = 'edit';
							}elseif($row["oto"]==1){
							$status = 'EDIT ORDER';
							$view = 'edit';
							}elseif($row["oto"]==2){
							$status = 'HAPUS PEMBAYARAN';
							$view = 'view';
							}elseif($row["oto"]==3){
							$status = 'EDIT ORDER LUNAS';
							$view = 'edit';
							}elseif($row["oto"]==4){
							$status = 'PENDING';
							$view = 'view';
							}elseif($row["oto"]==5){
							$status = 'BATAL';
							$view = 'batal';
							}else{
							$status = 'KUNCI';
							$view = 'view';
						}
						if($row["cetak"]>0){
							$cetak = 'YA';
							}else{
							$cetak = 'BELUM';
						}
						if($row["status"]=='baru'){
							$status = '<span class="badge badge-primary flat">BARU</span>';
							}else if($row["status"]=='simpan'){
							$status = '<span class="badge badge-success flat">SIMPAN</span>';
							}else if($row["status"]=='edit'){
							$status = '<span class="badge badge-info flat">EDIT ORDER</span>';
							}else if($row["status"]=='pending'){
							$status = '<span class="badge badge-warning">PENDING</span>';
							}else if($row["status"]=='batal'){
							$status = '<span class="badge badge-danger flat"><i class="fa fa-times"></i>  BATAL ORDER</span>';
						}
						if($row["lunas"]==1 AND $row["status"]!='simpan'){
							$lunas = '<span class="badge badge-success flat">LUNAS</span>';
							$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><span class="badge badge-success flat"><i class="fa fa-file-pdf-o"></i> PRINT PDF</span></a>';
							$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'") ><span class="badge badge-primary flat"><i class="fa fa-print"></i> PRINT ORDER</span></a>';
							$target = '_blank';
							$pelunasan = '';
							}elseif($row["lunas"]==1 AND $row["status"]=='simpan'){
							$lunas = '<span class="badge badge-success flat">LUNAS</span>';
							$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><span class="badge badge-success flat"><i class="fa fa-file-pdf-o"></i> PRINT PDF</span></a>';
							$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'"); ><span class="badge badge-primary flat"><i class="fa fa-print"></i> PRINT ORDER</span></a>';	
						}
						if($row["status"]=='baru' AND $row["id_konsumen"]==1){
							$print = '';
							$edit = '<a href="#" class="dropdown-item cek_order"  data-id="'.$row["id_invoice"].'" data-modEdit="'.$view.'"  id="cart"><span class="badge badge-info flat">EDIT ORDER</span></a>';
							$pelunasan = '';
							$batal = '<a class="dropdown-item pending_order" data-modEdit="pending" data-id="'.$row["id_invoice"].'" href="#"><span class="badge badge-warning flat">PENDING</span></a>';
						}
						if($row["status"]=='baru' AND $row["id_konsumen"]!=1){
							$print = '';
							$edit = '<a href="#" class="dropdown-item cek_order"  data-id="'.$row["id_invoice"].'" data-modEdit="edit" id="cart"><span class="badge badge-info flat">EDIT ORDER</span></a>';
							$pelunasan = '';
							$batal = '<a class="dropdown-item pending_order" data-modEdit="pending" data-id="'.$row["id_invoice"].'" href="#"><span class="badge badge-warning flat">PENDING</span></a>';
						}
						if($row["status"]=='simpan' AND $row["lunas"]==0){
							$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><span class="badge badge-success flat"><i class="fa fa-file-pdf-o"></i> PRINT PDF</span></a>';
							$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'") ><span class="badge badge-primary flat"><i class="fa fa-print"></i> PRINT ORDER</span></a>';
							if($this->session->level=='admin'){
								$edit = '<a href="#" class="dropdown-item cek_order" data-id="'.$row["id_invoice"].'" data-modEdit="'.$view.'"  id="cart"><span class="badge badge-info flat">EDIT ORDER</span></a>';
								$batal = '<a class="dropdown-item batal_order" data-modEdit="batal" data-id="'.$row["id_invoice"].'" href="#"><span class="badge badge-danger flat"><i class="fa fa-times"></i>  BATAL ORDER</span></a>';
							}
							$pelunasan = '<a class="dropdown-item cek_order" href="#"><span class="badge badge-success flat" data-id="'.$row["id_invoice"].'" data-modEdit="pelunasan"  id="cart">Pelunasan</span></a>';
						}
						if($row["status"]=='simpan' AND $row["lunas"]==1){
							$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><span class="badge badge-success flat"><i class="fa fa-file-pdf-o"></i> PRINT PDF</span></a>';
							$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'") ><span class="badge badge-primary flat"><i class="fa fa-print"></i> PRINT ORDER</span></a>';
							if($this->session->level=='admin'){
								$edit = '';
								$batal = '<a class="dropdown-item batal_order" data-modEdit="batal" data-id="'.$row["id_invoice"].'" href="#"><span class="badge badge-danger flat"><i class="fa fa-times"></i> BATAL ORDER</span></a>';
							}
							$pelunasan = '';
						}
						$button = $pdf.$print.$edit.$pelunasan.$batal;
						$sumPiutang = sumPiutang($row["id_invoice"]);
						$sumOrderDiskon = sumOrderDiskon($row["id_invoice"]);
						if($sumOrderDiskon->diskon){
							$sumOrder = sumOrder($row['id_invoice']) - $sumOrderDiskon->sisa;
							}else{
							$sumOrder = sumOrder($row['id_invoice']);
						}
						$sisa = $row['total_bayar'] - $sumPiutang[0]['piutang'];
						if(($row["status"]=='baru' AND $row["id_konsumen"]!=1) OR ($sumOrder != $sumPiutang[0]['piutang'] AND $row["id_konsumen"]!=1)){
							
							$lunas = '<a class="bayar_sisa" data-modEdit="bayar" data-id="'.$id_invoice.'" data-trx="'.$row["id_transaksi"].'"  data-bayar="'.$sumPiutang[0]['piutang'].'" data-sisa="'.$sisa.'" data-total="'.$sumOrder.'" href="#"><span class="badge badge-info flat">BAYAR</span></a>';
							
						}
						
						$totalorder += sumOrder($row['id_invoice']) - $sumOrderDiskon->sisa;
						$totalbayar += $sumPiutang[0]['piutang'];
						$totalsisa += $sisa;
					?>
					<tr>
						<td><button data-id="<?php echo $row["id_invoice"]; ?>" data-modEdit="<?=$view;?>" id="cart" class="btn btn-info btn-sm flat cek_order">#<?php echo $row["id_transaksi"]; ?></button></td>
						<td class="pl-0"><?php echo dtimes($row["tgl_trx"],false,false); ?></td>
						<td>
							<?php if($row["status"]=='simpan' AND $row["id_konsumen"]!=1){ ?>
								<a data-toggle="tooltip" data-original-title="Kirim Ke <?=$row["no_hp"]; ?>" data-placement="left" class="text-success kirim_wa" data-id="<?=$id_invoice;?>" data-nomor="<?=($row["no_hp"]);?>" data-trx="<?=($row["id_transaksi"]);?>"  data-tgl="<?=$row["tgl_trx"];?>" href="javascript:void(0)" ><i class="fa fa-whatsapp"></i> &nbsp;<?php echo $row["nama"]; ?></a>
								<?php }else{ ?>
								<a class="text-secondary" href="#"><i class="fa fa-whatsapp"></i> &nbsp;<?php echo $row["nama"]; ?></a>
							<?php } ?>
						</td>
						<td><?php echo $row["nama_lengkap"]; ?></td>
						<td align='right'><?php echo rp($sumOrder); ?></td>
						<td align='right'><?php echo rp($sumPiutang[0]['piutang']); ?></td>
						<td align='right'><?php echo rp($sisa); ?></td>
						<td><?php echo $status; ?></td>
						<td><?php echo $lunas; ?></td>
						<td class="aksi"><div class="btn-group dropleft flat">
							<button type="button" class="btn btn-danger btn-sm customs dropdown-toggle flat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								AKSI
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">NO. #<?php echo $row["id_transaksi"]; ?></a>
								<div class="dropdown-divider"></div>
								<?=$button;?>
							</div>
						</div></td>
					</tr>
				<?php $no++; } ?>
				<tr>
					<td class="font-weight-bold" colspan="2">TOTAL ORDER</td>
					<td></td>
					<td></td>
					<td class="text-right font-weight-bold w-10"><?=rp($totalorder);?></td>
					<td class="text-right font-weight-bold w-10"><?=rp($totalbayar);?></td>
					<td class="text-right font-weight-bold w-10"><?=rp($totalsisa);?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php }else{ ?>
				<tr><td colspan="11">Belum ada penjualan</td></tr>
				<?php } ?>
			</tbody>
		</table>
		<nav aria-label="Page navigation example" class="p-2">
			<?php echo $this->ajax_pagination->create_links(); ?>
		</nav>
	</div><!-- /.card-body -->
</div><!-- /.card-body -->
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
	
	$('.cek_order').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		var id =  $(this).data("id") // will return the number 123
		var mod = $(this).data('modedit');
		
		$.ajax({
			type: 'POST',
			url: base_url + "main/cek_akses",
			data: {id:id,mod:mod},
			dataType: "json",
			beforeSend: function () {
				$('body').loading();
			},
			success: handle_Cart,
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	});
</script>