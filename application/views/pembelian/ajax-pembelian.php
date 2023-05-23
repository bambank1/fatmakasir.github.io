<div class="card-body table-responsive">
	<div class="card-block">
		<table class="table  table-striped table-mailcard" id="jsonuser">
			<thead class="thead-dark">
				<tr>
					<th style="width:3%!important" class="text-center">No.</th>
					<th style="width:20%!important">Tanggal</th>
					<th class="text-right">Pencatat</th>
					<th class="text-right">Tgl. Jatuh Tempo</th>
					<th class="text-right">Metode Bayar</th>
					<th style="width:100px!important" class="text-center">Cetak</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					// print_r($result);
					$total_all=0;
					$button='';
					if(!empty($result)){
						$no=$this->uri->segment(3)+1;
						foreach($result AS $aRow){ 
							if($no%2==0){
								$warna = "background:#ffe599";
								$warna1 = "background:#ffe599";
								$warna2 = "background:#ffe599";
								}else{
								$warna = "background:#ffe599;padding:10px";
								$warna1 = "background:#bfffcf;padding:10px";
								$warna2 = "background:#424251;color:#fff";
							}
							$cek_total_bayar = $aRow['total_bayar'];
							
							$cek_sum_bayar = $this->model_app->sum_data('jml_bayar','bayar_pembelian',['id_pembelian'=>$aRow['id_pembelian']]);
							
							
							$button ='';
							$Cetak ='<button class="btn btn-flat btn-sm btn-success" disabled>Cetak</button>';
							$edit = 'view';
							$btn = 'btn btn-success btn-sm';
							if($aRow['id_bayar']==0 OR $aRow['id_kas']==0 AND $aRow['pos']=='N'){
								$button ='<button class="btn btn-flat btn-sm btn-info tambah_pembelian" data-info="edit" data-id="'.$aRow['id_pembelian'].'">Edit</button>';
								$edit = 'edit';
								$btn = 'btn btn-primary btn-sm';
							}
							if($cek_sum_bayar < $aRow['total_bayar'] AND $aRow['pos']=='Y'){
								$button ='<button class="btn btn-flat btn-sm btn-info tambah_pembelian" data-info="bayar" data-id="'.$aRow['id_pembelian'].'">Bayar</button>';
								$edit = 'view';
								$Cetak = '<a href="'.base_url().'pembelian/cetak_pembelian/'.$aRow['id_pembelian'].'" target="_blank" class="btn btn-success btn-flat btn-sm pull-right"><b>Cetak</b></a>';
								$btn = 'btn btn-primary btn-sm';
							}
							
							if($aRow['lunas']=='Y'){
								$edit = 'lunas';
								$btn = 'btn btn-primary btn-sm';
								$Cetak = '<a href="'.base_url().'pembelian/cetak_pembelian/'.$aRow['id_pembelian'].'" target="_blank" class="btn btn-success btn-flat btn-sm pull-right"><b>Cetak</b></a>';
								$btn = 'btn btn-primary btn-sm';
							}
							if($aRow['pos']=='N'){
								$edit = 'edit';
							}
							$blink = '';
							$tgl_jatuhtempo = '';
							if(!empty($aRow['tgl_jatuhtempo'])){
								if($aRow['tgl_jatuhtempo'] < date('Y-m-d') AND $aRow['lunas']=='N'){
									$blink = 'blink_me';
									$tgl_jatuhtempo = dtime($aRow['tgl_jatuhtempo']);
									}else{
									$tgl_jatuhtempo = dtime($aRow['tgl_jatuhtempo']);
								}
							}
						?>
						 
						<tr style="<?=$warna;?>" class="<?=$blink;?>">
							<td class="text-center"><a href='#' data-info="<?=$edit;?>" class="tambah_pembelian <?=$btn;?> " data-id="<?=$aRow['id_pembelian'];?>">#<?=$aRow['id_pembelian'];?></a>
							</td>
							<td><?=dtime($aRow['tgl_pembelian']);?></td>
							<td class="text-right"><?=juser($aRow['id_user']);?></td>
							<td class="text-right"><?=$tgl_jatuhtempo;?></td>
							<td class="text-right"><?=getJenisBayar($aRow['id_bayar']);?></td>
							<td class="text-center">
								<?=$Cetak;?>
							</td>
						</tr>
						<tr data-parent="#table-guest">
							<td colspan="6" class="p-0">
								<table class="table">
									<thead>
										<tr>
											<td class="text-center">#</td>
											<td>Jenis</td>
											<td>Uraian</td>
											<td>Qty</td>
											<td>Nominal</td>
											<td>Satuan</td>
											<td class="text-right">Subtotal</td>
											<td style="width:100px!important"></td>
										</tr>
									</thead>
									<?php
										
										$sql= $this->db->query("SELECT * from pembelian_detail where id_pembelian=".$aRow['id_pembelian'])->result_array();
										$total = 0;
										$b=1;
										foreach ($sql as $rr){
											
											$tothar = $rr['harga'] * $rr['jumlah'];
											$sqlj= $this->db->query("SELECT * from jenis_pengeluaran where id_jenis=".$rr['id_biaya']);
											$rowj = $sqlj->row();
											$bayar ='';
											//jika id_akun = 112 maka bayar piutang
											if($cek_sum_bayar!=$cek_total_bayar AND $aRow['pos']=='Y'){
												$bayar ='<button class="btn btn-flat btn-sm btn-warning bayar_piutang" data-info="bayarh" data-total="'.$tothar.'" data-id="'.$aRow['id_pembelian'].'">Bayar</button>';
											}
											
											if($cek_total_bayar > 0 AND $cek_sum_bayar == $cek_total_bayar AND $rowj->status!=1){
												$bayar ='<button class="btn btn-flat btn-sm btn-success">LUNAS</button>';
											}
											if($cek_total_bayar == ''){
												$bayar ='<button class="btn btn-flat btn-sm btn-info">BARU</button>';
											}
											
										?>
										<tr style="<?=$warna1;?>">
											<td align="center"><?=$b++;?></td>
											<td><i><?=$rowj->title;?></i></td>
											<td><i><?=$rr['keterangan'];?></i></td>
											<td><?=$rr['jumlah'];?></td>
											<td><?=rp($rr['harga']);?></td>
											<td><?=$rr['satuan'];?></td>
											<td class="text-right"><i><?=rp($tothar);?></i></td>
											<td class="text-right"><?=$bayar;?></td>
										</tr>
										
										<?php 
											$total = $total + $tothar;
											$total_all += $tothar;
										} ?>
										
										<tr style="<?=$warna2;?>">
											<td colspan="6" class="text-left"><strong>Total</strong></td>
											<td class="text-right"><b><i><?=rp($total);?></i></b>
												<input type="hidden" class="form-control form-control-sm text-right" value="<?=$total;?>" id="subtotal" readonly>
											</td>
											<td class="text-center"></td>
										</tr>
								</table>
							</td>
						</tr>
					<?php } ?>
					<?php $no++;}else{ ?>
					<tr>
						<td colspan="8">Belum ada pengeluaran</td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="4" class="text-left"><strong>Total Utang</strong></td>
					<td class="text-right"><strong><?=rp($total_all);?></strong></td>
					<td></td>
				</tr>
			</tbody>
	</table>
	<nav aria-label="Page navigation" class="mt-3">
		<?php echo $this->ajax_pagination->create_links(); ?>
	</nav>
</div><!-- /.card-body -->
</div><!-- /.card-body -->
<script>
	$(".rekap").on('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var tgl = $("#dari").val();
		var user = $('#user').val();
		var subtotal = $('#subtotal').val();
		
		if(subtotal==0){
			sweet('Peringatan!!!','Maaf Data masih kosong','warning','warning');
			return;
		}
		$.ajax({
			url: base_url + 'pembukuan/save_rekap_pengeluaran',
			method: 'POST',
			dataType: 'json',
			data :{tgl:tgl,id:id,user:user,subtotal:subtotal},
			success: function(data) {
				console.log(data);
				if(data.ok=='ok'){
					sweet('Rekap data!!!','Data berhasil direkap','success','success');
					FilterPengeluaran();
					}else{
					sweet('Rekap data!!!','Data telah direkap','warning','warning');
				}
			}
		})
	});
	</script>																				