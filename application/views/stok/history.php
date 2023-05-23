<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?=$judul;?></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$judul;?></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
			<div class="card-header pb-0">
			<?=$judul;?> <?=periode_stok($id);?>
			<a class="m-0 float-right btn btn-danger btn-sm" href="<?=base_url('stok/cetak_history/').encrypt_url($id);?>/?type=pdf" target="_blank"><i class="fa fa-print"></i> Cetak Laporan</a>
			</div>
				<div class="card-body table-responsive" id="dataStok">
					<div class="card-block">
						<table class="data table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Barang</th>
									<th>Tanggal</th>
									<th class="text-right">Masuk</th>
									<th class="text-right">Keluar</th>
									<th class="text-right">Stok Akhir</th>
									<th>Keterangan</th>
								</tr>			
							</thead>
							<tbody>
								<?php
									if(isset($query)){
										$n = 1;
										$detail = 1;
										foreach($query as $idmaster=>$isi){
											if(isset($list_cc[$idmaster])){
												$nama = $list_cc[$idmaster];
												$mutasi = 0;
												$masuk = $keluar = 0;
												foreach($isi as $tgl => $row){
													$date = date("Y-m-d",$tgl);
													
													$terima = "";
													if(isset($row['masuk'])){
														$terima = $row['masuk'];
														$mutasi += $terima;
													}
													$kirim = "";
													if(isset($row['keluar'])){
														$kirim = $row['keluar'];
														$mutasi -= $kirim;
													}
													
													$ket = isset($row['ket']) ? "<em>$row[ket]</em>" : "";
													
													echo "
													<tr>
													<td>$n</td>
													<td>$nama</td>
													<td>".dtime($date)."</td>
													<td class='text-right'>$terima</td>
													<td class='text-right'>$kirim</td>
													<td class='text-right'><strong>$mutasi</strong></td>
													<td>$ket</td>
													</tr>
													";
													$n++;
													
												}
												
											}
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>