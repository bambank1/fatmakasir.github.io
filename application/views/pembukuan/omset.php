<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Rincian penjualan</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Rincian penjualan</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header pb-2">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
						</div>
						<select id="sortBy" class="form-control form-control-sm custom-select" onchange="search_Omset()">
							<option value="ASC">ASC</option>
							<option value="DESC" selected>DESC</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control form-control-sm custom-select" onchange="search_Omset()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
							<option value="1000">1000</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">KASIR</span>
						</div>
						<select name="user" id="user" class="form-control form-control-sm custom-select" onchange="search_Omset()">
							<option value="0">Semua</option>
							<?php  
								foreach ($pilihan AS $values){
									if($this->session->idu==$values['id_user']){
										echo '<option value="'.$values['id_user'].'" selected>'.$values['nama_lengkap'].'</option>';
										}else{
										echo '<option value="'.$values['id_user'].'">'.$values['nama_lengkap'].'</option>';
									}
								}
							?>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">TANGGAL</span>
						</div>
						<div id="date-omset">
							<div class="input-daterange input-group">
								<input type="text" onchange="search_Omset()" value="<?=$dari;?>" class="form-control form-control-sm" name="dari" id="dari">
								
								<input type="text" onchange="search_Omset()" value="<?=$sampai;?>" class="form-control form-control-sm" name="sampai" id="sampai">
							</div>
						</div>
						<div class="input-group-append">
							<button type="button" data-toggle="tooltip" class="btn btn-danger btn-sm clear" id="awal" data-original-title="Clear" onclick="clearSearch('<?=$dari;?>')"><i class="fa fa-times fa-1x"></i> Clear</button>
							<button type="button" data-info="harian" class="btn btn-success btn-sm" data-id="0" onclick="search_Omset()"><i class="fa fa-search"></i> Tampilkan</button>
							<button class="btn btn-primary url_doc" data-url="lap_rincian" type="button" data-toggle="tooltip" data-original-title="Dok Rincian Penjualan" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
				
				<div class="card-body table-responsive">
					<div class="card-block">
						<!--div id="data_omset"></div-->
						<div class="post-list pt-0" id="dataListOmset">
							<div class="table-responsive-sm">
								<table class="table">
									<tbody>
										<?php 
											$omset_ppajak=0;
											$piutang=0;
											$t_omset=0;
											$totalDiskon=0;
											$total_pajak=0;
											$total_order=0;
											$total_piutang=0;
											$total_bayar=0;
											$sub_tpajak=0;
											$Totalbayar=0;
											$diskon=0;
											if(!empty($posts)) {
												$no=1;
												foreach($posts AS $row){ 
													$rows = bayar($row['id_invoice']);
													if (isset($rows)) {
														$Totalbayar = $rows['Totalbayar'];
														}else{
														$Totalbayar = 0;
													}
													$t_omset = sumOrder($row['id_invoice']);
													$totalDiskon = totalDiskon($row['id_invoice']);
													$t_omset = $t_omset - $totalDiskon;
													$piutang = sumPiutang($row['id_invoice']);
													if($row['pajak']>0){
														$sub_tpajak = ($t_omset * $row['pajak']) /100;
														$piutang =  $t_omset + $sub_tpajak - $Totalbayar;
														}else{
														$piutang = $t_omset - $piutang[0]['piutang'];
														$sub_tpajak = $row['pajak'];
													}
													if($row['status']=='batal'){
														$Totalbayar = 0;
														$t_omset = 0;
													}
													if($row["oto"]==0){
														$status = 'Buka';
														$view = 'edit';
														}elseif($row["oto"]==1){
														$status = 'Edit Order';
														$view = 'edit';
														}elseif($row["oto"]==2){
														$status = 'Hapus Pembayaran';
														$view = 'view';
														}elseif($row["oto"]==3){
														$status = 'Edit Order Lunas';
														$view = 'edit';
														}elseif($row["oto"]==4){
														$status = 'Pending';
														$view = 'view';
														}elseif($row["oto"]==5){
														$status = 'Batal';
														$view = 'view';
														}else{
														$status = 'Kunci';
														$view = 'view';
													}
												?>
												<thead class="thead-dark">
													<tr>
														<th>No.Order</th>
														<th>Tgl.Order</th>
														<th>Tgl.Selesai</th>
														<th class="text-right">Customer</th>
														<th class="text-right">Pajak</th>
														<th class="text-right">Total_Order</th>
														<th class="text-right">Bayar</th>
														<th class="text-right">Piutang</th>
														<th class="text-right">Kasir</th>
													</tr>
												</thead>
												<tr>
													<td><button class="btn btn-info btn-sm flat cek_transaksi" data-id="<?php echo $row["id_invoice"]; ?>" data-modEdit="<?=$view;?>"  id="cart"><?php echo $row["id_transaksi"]; ?></button></td>
													<td><?=dtimes($row['tgl_trx'],false,false);?></td>
													<td><?=dtimes($row['tgl_ambil'],true,false);?></td>
													<td class="text-right"><?=$row['nama'];?></td>
													<td class="text-right"><?=rp($sub_tpajak);?> </td>
													<td class="text-right"><?=rp($t_omset);?></td>
													<td class="text-right"><?=rp($Totalbayar);?></td>
													<td class="text-right"><?=rp($piutang);?></td>
													<td class="text-right"><span class="badge badge-success flat"><?=$row['kasir'];?></span></td>
												</tr> 
												<thead class="thead-light">
													<tr> 
														<th>QTY</th>
														<th class="text-right">Harga</th>
														<th class="text-right">Diskon</th>
														<th class="text-right">Sub_total</th>
														<th class="text-right">Produk</th>
														<th class="text-right">Jenis</th>
														<th colspan="2" class="text-right">Keterangan</th>
													</tr>
												</thead>
												<?php 
													$detail = detail_order($row['id_invoice']);
													// print_r($detail);
													$subtotal = 0;
													$num = 1;
													foreach($detail AS $val)
													{ 
														$subtotal = $val->jumlah * $val->harga;
														if($val->diskon > 0){
															$diskon = ($subtotal * $val->diskon) /100;
															$subtotal = $subtotal - $diskon;
															}else{
															$diskon = 0;
															$subtotal = $subtotal;
														}
													?>
													<tr>
														<td><?=$val->jumlah;?></td>
														<td class="text-right"><?=rp($val->harga);?></td>
														<td class="text-right"><?=rp($diskon);?></td>
														<td class="text-right"><?=rp($subtotal);?></td>
														<td class="text-right"><?=nama_produk($val->id_produk);?></td>
														<td class="text-right"><?=jenis_cetakan($val->jenis_cetakan);?></td>
														<td colspan="2" class="text-right"><?=$val->keterangan;?></td>
													</tr>
													<?php 
													}
													$total_order += $t_omset;
													$total_pajak += 0;
													$total_bayar += $Totalbayar;
													$total_piutang += $piutang;
												}}else{ ?>
												<tr>
													<td colspan="11">Data belum ada</td>
												</tr> 
										<?php }?>
									</tbody>
									<tfoot>
										<thead class="thead-dark">
											<tr style="border-bottom:1px solid #000!important">
												<th colspan="3">Total</th>
												<th class="text-right">&nbsp;</th>
												<th class="text-right">Pajak</th>
												<th class="text-right">Total_Order</th>
												<th class="text-right">Bayar</th>
												<th class="text-right">Piutang</th>
												<th class="text-right">&nbsp;</th>
											</tr>
										</thead>
										<tr>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
											<th class="text-right"><?=rp($total_pajak);?></th>
											<th class="text-right"><?=rp($total_order);?></th>
											<th class="text-right"><?=rp($total_bayar);?></th>
											<th class="text-right"><?=rp($total_piutang);?></th>
											<th>&nbsp;</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div><!-- /.card-body -->
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div>
	</div>
</div>
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
	.small {
    height: 30px;
    padding: 2px 10px;
	}
	button, input, select, textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
	}
</style>
<script>
	var date2 = new Date();
	$('#date-omset .input-daterange').datepicker({        
        format: 'dd/mm/yyyy',        
		"endDate": date2,
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
	}); 
	
	// search_Filter();
	function search_Omset(page_num){
		page_num = page_num?page_num:0;
		var user = $('#user').val();
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		var urlnya = '<?php echo base_url("pembukuan/harian/"); ?>'+page_num
		$.ajax({
			type: 'POST',
			url: urlnya,
			data:{page:page_num,user:user,dari:dari,sampai:sampai,sortBy:sortBy,limits:limits},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#dataListOmset').html(html);
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
			}
		});
	}
	
	function clearSearch(tgl){
		$('#dari').val(tgl);
		search_Omset();
	}
	function search_omset(){
		$(".harian").click();
	}
	
</script>			