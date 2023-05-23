<div class="card-body table-responsive">
	<div class="card-block">
		<span>Pengeluaran : <?=$jenis->title;?><span>
			<table class="table table-striped table-mailcard" id="jsonuser">
				<thead class="thead-dark">
					<tr>
						<th style="width:3%!important" class="text-center">No.</th>
						<th style="width:20%!important">Tanggal</th>
						<th class="text-left">Tgl. Jatuh Tempo</th>
						<th class="text-right">Pencatat</th>
						<th style="width:100px!important" class="text-center">Cetak</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$a=0;
						$total=0;
						$total_all=0;
						$button='';
						
						if(!empty($result)){
							$no=$this->uri->segment(3)+1;
							foreach($result AS $aRow){ 
								$harga = $aRow['total_bayar'];
								
								$show ="";
								
								if($a==1){
									$show ="show";
								}
								if($no%2==0){
									$warna = "background:#ffe599";
									$warna1 = "background:#ffe599";
									$warna2 = "background:#ffe599";
									}else{
									$warna = "background:#ffe599;padding:10px";
									$warna1 = "background:#bfffcf;padding:10px";
									$warna2 = "background:#424251;color:#fff";
								}
								$qry = $this->model_app->view_where('pengeluaran_detail',['id_pengeluaran'=>$aRow['id_pengeluaran']])->result();
								$cek_total_bayar = $aRow['total_bayar'];
								
								$cek_sum_bayar = $this->model_app->sum_data('jml_bayar','bayar_pengeluaran',['id_pengeluaran'=>$aRow['id_pengeluaran']]);
								
								$cek_sum_piutang = $this->model_app->sum_data('jml_bayar','bayar_piutang',['id_pengeluaran'=>$aRow['id_pengeluaran']]);
								
								$button ='';
								$edit = 'view';
								$btn = 'btn btn-success';
								if($aRow['id_bayar']==0 OR $aRow['id_kas']==0){
									$button ='<button class="btn btn-flat btn-sm btn-info tpengeluaran" data-info="edit" data-id="'.$aRow['id_pengeluaran'].'">Edit</button>';
									$edit = 'edit';
									$btn = 'btn btn-primary';
								}
								if($aRow['id_kas']==4){
									$button ='<button class="btn btn-flat btn-sm btn-info tpengeluaran" data-info="bayar" data-id="'.$aRow['id_pengeluaran'].'">Bayar</button>';
									$edit = 'edit';
									$btn = 'btn btn-primary';
								}
								$tgl_jatuhtempo ='-';
								if($aRow['tgl_jatuhtempo']!=''){
									$tgl_jatuhtempo = dtime($aRow['tgl_jatuhtempo']);
								}
								if($aRow['lunas']=='Y'){
									$edit = 'lunas';
									$btn = 'btn btn-primary';
								}
							?>
							<tr style="<?=$warna;?>">
								<td class="text-center"><b><a href='#' data-info="<?=$edit;?>" class="tpengeluaran <?=$btn;?>" data-id="<?=$aRow['id_pengeluaran'];?>">#<?=$aRow['id_pengeluaran'];?></a></b>
							</td>
								<td class=""><b><?=dtime($aRow['tgl_pengeluaran']);?></b></td>
								<td><?=$tgl_jatuhtempo;?></td>
								<td align="right"><b><?=juser($aRow['id_user']);?></b></td>
								<td class="text-center"><a href="<?=base_url();?>pembukuan/cetak_pengeluaran/<?=$aRow['id_pengeluaran'];?>" target="_blank" class="btn btn-success btn-flat btn-sm pull-right"><b>Cetak</b></a></td>
								</tr>
								<tr data-parent="#table-guest">
									<td colspan="5" class="p-0">
										<table class="table table-striped">
											<thead class="thead-dark">
												<tr>
													<th style="width:4%!important" class="text-right">#No.</th>
													<th>Jenis</th>
													<th class="text-left" style="width:30%!important">Uraian</th>
													<th class="text-center">QTY</th>
													<th class="text-right">Nominal</th>
													<th class="text-right">Sub Total</th>
													<th class="w-10 text-right"></th>
												</tr>
											</thead>  
											<?php $total=0;$b=1; 
												foreach($qry as $Row){
													$cek_sum = $this->model_app->sum_data('jml_bayar','bayar_piutang',['id_pengeluaran'=>$aRow['id_pengeluaran']]);
													$tothar = $Row->harga * $Row->jumlah;
													$sqlj= $this->db->query("SELECT * from jenis_pengeluaran where id_jenis=".$Row->id_biaya);
													$rowj = $sqlj->row();
													$bayar ='';
													if($rowj->status==1 AND $cek_sum < 0 OR $rowj->status==1 AND $cek_sum ==''){
														$bayar ='<button class="btn btn-flat btn-sm btn-info bayar_piutang" data-info="bayar" data-total="'.$tothar.'" data-id="'.$aRow['id_pengeluaran'].'">Bayar</button>';
													}
													if($cek_sum >0){
														$bayar ='<button class="btn btn-flat btn-sm btn-success">LUNAS</button>';
													}
													
													$total = $Row->jumlah * $Row->harga;
													$total_all += $total;
												?>
												<tr>
													<td class="text-center"><?=$b;?></td>
													<td><?=jproduk('jenis_pengeluaran',$Row->id_biaya,'title');?></td>
													<td class="text-left"><?=$Row->keterangan;?></td>
													<td class="text-center"><?=$Row->jumlah;?></td>
													<td class="text-right"><?=rp($Row->harga);?></td>
													<td class="text-right"><?=rp($total);?></td>
													<td class="text-right"><?=$bayar;?></td>
												</tr>
											<?php $b++; } ?>
											<tr style="<?=$warna2;?>">
												<td></td>
												
												<td></td>
												<td></td>
												<td></td>
												<td class="text-right"><b><i>Total</i></b></td>
												<td class="text-right"><b><i><?=rp($total);?></i></b>
													<input type="hidden" class="form-control form-control-sm text-right" value="<?=$total;?>" id="subtotal" readonly>
												</td>
											</td>
											<td class="text-center"><?=$button;?></td>
										</tr>
									</table>
								</td>
								</tr>
							</tr>
						<?php } ?>
						<?php $a++;$no++;}else{ ?>
						<tr>
							<td colspan="4">Belum ada pengeluaran</td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="3" class="text-left"><strong>Total Pengeluaran</strong></td>
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
					data :{tgl:tgl,id:id,user:user},
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