<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Neraca saldo</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Laporan</li>
			<li class="breadcrumb-item active" aria-current="page">Neraca saldo</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12 mb-4">
			<!-- Simple Tables -->
			<div class="card">
				
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Neraca Saldo</h6>
					<form action="<?= base_url('pembukuan/neraca_saldo/detail') ?>" method="post" class="d-flex flex-row justify-content-center">
						<div class="form-group">
							<select name="bulan" id="bulan" class="form-control custom-select">
								<?php
                                            for($i=1;$i<=12;$i++){
                                                $selected = '';
                                                if(month()==($i)){
                                                    $selected = 'selected';
                                                }
                                                echo "<option value='$i' $selected>".getBulan($i)."</option>";
                                            }
                                        ?>
							</select>
						</div>
						<div class="form-group mx-3">
							<select name="tahun" id="tahun" class="form-control custom-select">
								<?php 
									if(!empty($tahun)){
										foreach($tahun as $row){
											$tahuns = date('Y',strtotime($row->tgl_transaksi));
											echo "<option value=$tahuns>".$tahuns."</option>";
										}
										}else{
										echo "<option value='".date('Y')."'>".date('Y')."</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<button class="btn btn-success" type="submit">Cari</button>
						</div>
					</form>
				</div>
				<div class="card-body table-responsive">
					<div class="card-block">
						<!-- Projects table -->
						<table class="table align-items-center table-flush" id="neraca-saldo">
							<thead class="thead-light">
								<tr>
									<th class="w-5">No.</th>
									<th scope="col">Bulan Dan Tahun</th>
									<th class="text-right">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=0;
									foreach($listJurnal as $row):
									$i++;
									$bulan = date('m',strtotime($row->tgl_transaksi));
									$tahun = date('Y',strtotime($row->tgl_transaksi));
								?>
								<tr>
									<td scope="col"><?=$i?></td>
									<td scope="col"><?= getBulan($bulan).' '.$tahun ?></td>
									<td class="text-right">
										<?= form_open('pembukuan/neraca_saldo/detail','',['bulan'=>$bulan,'tahun'=>$tahun]) ?>
										<?= form_button(['type'=>'submit','content'=>'Lihat Neraca Saldo','class'=>'btn btn-success btn-sm mr-3']) ?>
										<?= form_close() ?>
									</td>
								</tr>
								<?php
									endforeach;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form method="POST" action="<?=base_url();?>laporan/cetak_laporan_laba_rugi" id="target" target="_blank">
	<input type="hidden" name="startdate" id="startdate" readonly  />
</form>
<script>
	$(document).ready( function () {
		$('#neraca-saldo').DataTable();
	} );
	// $("#cetak_laporan").click(function(e) {
	// e.preventDefault();
	// $( "#target" ).submit();
	// });
	
	// var date2 = new Date();
	// $('.date-laporan').datepicker({        
	// format: 'mm/yyyy', 
	// "endDate": date2,
	// autoclose: true,     
	// startView: "months", 
	// minViewMode: "months", 
	// });  
	
	// // LaporanLabarugi();
	
	// function LaporanLabarugi(){
	// var tanggal = $("#tanggal").val();
	// $("#startdate").val(tanggal);
	// var urlnya = base_url+"pembukuan/laporan_neraca/";
	// $.ajax({
	// type: 'POST',
	// url: urlnya,
	// data:{tanggal:tanggal},
	// beforeSend: function(){
	// $('body').loading();
	// },
	// success: function(html){
	// $('#labaRugi').html(html);
	// $('body').loading('stop');
	// var total_pj = $("#total_um").val();
	// if(total_pj ==0){
	// $("#cetak_laporan").attr('disabled',true);
	// }else{
	// $("#cetak_laporan").attr('disabled',false);
	// }
	// },
	// error: function(xhr, status, error) {
	// var err = xhr.responseText ;
	// sweet('Server!!!',err,'error','danger');
	// $('body').loading('stop');
	// }
	// });
	// }
	
	
</script>
