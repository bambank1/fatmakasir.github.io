<style>
	.card .table td, .card .table th {
    padding-right: 1rem;
    padding-left: 1rem;
	}
</style>

<div class="container-fluid mb-3" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button class="btn btn-success btn-icon-split cek_transaksi flat" data-id="0" data-modEdit="baru">
					<span class="icon text-white-50" >
						<i class="fa fa-cart-plus fa-fw"></i>
					</span>
					<span class="text">Tambah Transaksi</span>
				</button>
				<a href="#" class="btn btn-info btn-icon-split ceklunas">
					<span class="icon text-white-50">
						<i class="fa fa-shopping-cart fa-fw"></i>
					</span>
					<span class="text">Transaksi Lunas</span>
				</a>
				<a href="#" class="btn btn-primary btn-icon-split cekBaru">
					<span class="icon text-white-50">
						<i class="fa fa-shopping-cart fa-fw"></i>
					</span>
					<span class="text">Transaksi Baru</span>
				</a>
				<a href="#" class="btn btn-warning btn-icon-split cekPending">
					<span class="icon text-white-50">
						<i class="fa fa-shopping-cart fa-fw"></i>
					</span>
					<span class="text">Transaksi Pending</span>
				</a>
				<a href="#" class="btn btn-danger btn-icon-split cekBatal">
					<span class="icon text-white-50">
						<i class="fa fa-shopping-cart fa-fw"></i>
					</span>
					<span class="text">Transaksi Batal</span>
				</a>
				<a href="javascript:void(0);" class="btn btn-info btn-icon-split url_doc flat" data-url="transaksi" data-toggle="tooltip" data-original-title="Dokumentasi Transaksi" data-placement="left">
					<span class="icon text-white-50">
						<i class="fa fa-info-circle fa-fw fa-lg"></i>
					</span>	
				</a>
			</div>
		</h1>
		
	</div>
	<div class="card">
		<div class="row">
			<div class="col-md-12">
				<div class="card-header pb-2">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text flat">SORT</span>
						</div>
						<select id="sortBy" class="form-control custom-select w-5" onchange="searchFilter()">
							<option value="DESC" selected>TERBARU</option>
							<option value="ASC">TERLAMA</option>
							<option value="min_order">ORDER KECIL - BESAR</option>
							<option value="max_order">ORDER BESAR - KECIL</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control custom-select w-5" onchange="searchFilter()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">PILIH</span>
						</div> 
						<select id="trx" name="trx" class="form-control custom-select w-5" onchange="searchFilter()">
							<?php foreach($select AS $key=>$val){
								echo '<option value="'.$key.'">'.$val.'</option>';
							}
							?>
						</select>
						<input type="text" id="tgl" value="<?=$tgl;?>" class="form-control w-5 date-order" onchange="searchFilter();" placeholder="dd/mm/yyyy"/>
						<input type="text" id="keywords" class="form-control w-15" placeholder="Cari data" onkeyup="searchFilter();"/>
						<div class="btn-group" role="group" aria-label="Basic example">
							<button type="button"  class="btn btn-danger btn-sm clear flat" id="clear" data-toggle="tooltip" data-original-title="Clear filter"><i class="fa fa-times fa-1x"></i> Clear</button>
							<button type="button"  class="btn btn-info btn-sm print_order flat" id="print_order" data-toggle="tooltip" data-original-title="Print PDF"><i class="fa fa-file-pdf-o fa-1x"></i> Print</button>
						</div>
					</div>
				</div>
				
				<div class="post-list pt-0" id="dataList">
					<div class="table-responsive-sm">
						<div class="card-block">
							<table class="table  table-striped table-mailcard">
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
												$edit = '<a href="#" class="dropdown-item cek_transaksi"  data-id="'.$row["id_invoice"].'" data-modEdit="'.$view.'"  id="cart"><span class="badge badge-info flat">EDIT ORDER</span></a>';
												$pelunasan = '';
												$batal = '<a class="dropdown-item pending_order" data-modEdit="pending" data-id="'.$row["id_invoice"].'" href="#"><span class="badge badge-warning flat">PENDING</span></a>';
											}
											if($row["status"]=='baru' AND $row["id_konsumen"]!=1){
												$print = '';
												$edit = '<a href="#" class="dropdown-item cek_transaksi"  data-id="'.$row["id_invoice"].'" data-modEdit="edit" id="cart"><span class="badge badge-info flat">EDIT ORDER</span></a>';
												$pelunasan = '';
												$batal = '<a class="dropdown-item pending_order" data-modEdit="pending" data-id="'.$row["id_invoice"].'" href="#"><span class="badge badge-warning flat">PENDING</span></a>';
											}
											if($row["status"]=='simpan' AND $row["lunas"]==0){
												$pdf = '<a class="dropdown-item" href="'.$url_pdf.'" target="_blank"><span class="badge badge-success flat"><i class="fa fa-file-pdf-o"></i> PRINT PDF</span></a>';
												$print = '<a class="dropdown-item" href=javascript:open_popup("'.$id_invoice.'") ><span class="badge badge-primary flat"><i class="fa fa-print"></i> PRINT ORDER</span></a>';
												if($this->session->level=='admin'){
													$edit = '<a href="#" class="dropdown-item cek_transaksi" data-id="'.$row["id_invoice"].'" data-modEdit="'.$view.'"  id="cart"><span class="badge badge-info flat">EDIT ORDER</span></a>';
													$batal = '<a class="dropdown-item batal_order" data-modEdit="batal" data-id="'.$row["id_invoice"].'" href="#"><span class="badge badge-danger flat"><i class="fa fa-times"></i>  BATAL ORDER</span></a>';
												}
												$pelunasan = '<a class="dropdown-item cek_transaksi" href="#"><span class="badge badge-success flat" data-id="'.$row["id_invoice"].'" data-modEdit="pelunasan"  id="cart">Pelunasan</span></a>';
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
											<td><button data-id="<?php echo $row["id_invoice"]; ?>" data-modEdit="<?=$view;?>" id="cart" class="btn btn-info btn-sm flat cek_transaksi">#<?php echo $row["id_transaksi"]; ?></button></td>
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
									<?php $no++;} ?>
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
									<tr>
										<td colspan="11">Belum ada penjualan</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<nav aria-label="Page navigation" class="p-2">
								<?php 
									echo $this->ajax_pagination->create_links(); 
								?>
							</nav>
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
					<!-- Display posts list -->
					
				</div>
			</div>
		</div>
	</div>
</div>
<form method="POST" action="<?=base_url();?>laporan/cetak_order_harian" id="target_print" target="_blank">
	<input type="hidden" name="sortby_cetak" id="sortby_cetak" readonly  />
	<input type="hidden" name="trx_cetak" id="trx_cetak" readonly />
	<input type="hidden" name="tanggal_cetak" id="tanggal_cetak" readonly  />
</form>

<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal left fade" id="OpenModalWa" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content flat">
			<div class="modal-header">
				<h4 class="modal-title" id="WaLabel">Kirim Invoice</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<div class="load-data-wa"></div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success kirim_pesan" type="button"><i class="fa fa-send"></i>Kirim</button> 
				<button class="btn btn-danger" data-dismiss="modal" type="button">Batal</button> 
			</div>
		</div>
	</div>
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
	
	$(".kirim_pesan").click(function(e) {
		var dataform = $("#form-wa").serialize();
		$.ajax({
            type: "POST",
            url: base_url+"whatsapp/kirim_pesan",
            dataType: 'json',
            data: dataform,
			cache: false,
            beforeSend: function () {
                $('body').loading();　
			},
            success: handleKirim
			,error: function(xhr, status, error) {
                showNotif('top-right','Simpan data',error,'error');
                $('body').loading('stop');
			}
		});
		
	});
	
	function handleKirim(data) {
		
		$('#OpenModalWa').modal('hide'); 
		if(data.status==true){
			showNotif('bottom-right','Simpan data',data.msg.detail,'success');
			}else{
			var number = data.target; 
			var message = encodeURIComponent(data.msg);
			var url_wa = getLinkWhastapp(number,message)
			window.open(url_wa, '_blank');
		}
	}
	
	function getLinkWhastapp(number, message) {
		var url = 'https://wa.me/' 
		+ number 
		+ '?text='
		+ message
		return url
	}
	
	function open_popup(id)
	{
		
		var w = 880;
		var h = 570;
		var l = Math.floor((screen.width-w)/2);
		var t = Math.floor((screen.height-h)/2);
		if(thermal===1){
			$.post(base_url+"produk/print_invoice_html/"+id,{id: id},
			function(data, status){
				if(status=='success'){
					// alert("Data: " + data + "\nStatus: " + status);
				}
			});
			}else{
			var url_cetak = base_url +'produk/print_invoice_html/'+id;
			window.open(url_cetak, 'Cetak Invoice', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
		}
	}
	
	
	$("#print_order").click(function(e) {
		e.preventDefault();
		var sortby = $('#sortBy').val();
		var trx = $('#trx').val();
		var tanggal = $('#tgl').val();
		if(tanggal==''){
			sweet('Print Notif!!!','Tanggal masih kosong','warning','warning');
			return;
		}
		$('#sortby_cetak').val(sortby);
		$('#trx_cetak').val(trx);
		$('#tanggal_cetak').val(tanggal);
		$( "#target_print" ).submit();
	});
	var date2 = new Date();
	$('.date-order').datepicker({        
        format: 'dd/mm/yyyy', 
		"endDate": date2,
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
	});  
	
</script>			