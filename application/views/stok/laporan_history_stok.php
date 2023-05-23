<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$title;?></title>
		<link href="<?= FCPATH; ?>assets/vendor/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css">
		<style>
			@page {
			margin: 0 0;
            }
			body {
			margin-top: 0cm;
			margin-left: 0.5cm;
			margin-right: 1cm;
			margin-bottom: 0cm;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }
			
			.invoice-box {
			width:100%;
			margin: 0 auto;
			padding: 10px;
			font-size: 12px;
			line-height: 18px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
			}
			/** Define the footer rules **/
            footer {
			position: fixed; 
			bottom: 0cm; 
			left: 0cm; 
			right: 0cm;
			height: 0.5cm;
			padding:5px;
			
			/** Extra personal styles **/
			background-color:#333;
			color: white;
			text-align: center;
            }
			
			.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
			}
			
			.invoice-box table td {
			padding: 0 5px 0 5px;
			vertical-align: top;
			}
			
			.invoice-box table tr td:nth-child(2) {
			
			}
			
			.invoice-box table tr.top table td {
			padding-bottom: 0;
			}
			
			.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
			}
			
			.invoice-box table tr.information table td {
			
			}
			
			.invoice-box table tr.heading td {
			background: #333;
			color: #fff;
			font-weight: bold;
			padding: 5px;
			}
			
			.invoice-box table tr.details td {
			padding-bottom: 20px;
			}
			
			.invoice-box table tr.item td{
			border-bottom: 1px dotted #000;
			
			}
			.invoice-box table tr.kepada td{
			color: #fff;
			border-bottom:1px dotted #000
			}
			
			.invoice-box table tr.item.last td {
			
			}
			
			.invoice-box table tr.total{
			font-weight: bold;
			text-align:right;
			}
			.invoice-box table tr.hormat{
			font-weight: bold;
			text-align:left;
			}
			.invoice-box table tr.pelanggan{
			font-weight: bold;
			text-align:center;
			}
			.invoice-box table td.total {
			text-align:right;
			}
			.invoice-box table td.tgl {
			border-bottom:1px dotted #000;
			font-weight:bold;
			}
			.invoice-box table td.tkepada {
			background:#333;
			width:12%!important
			}
			.invoice-box table tr.kepada td.bawah {
			color:#000;
			width:30%!important
			}
			.invoice-box table td.total1 {
			border-left:1px solid #000;
			border-top:1px solid #000;
			border-bottom:1px dotted #000;
			}
			.invoice-box table td.total2 {
			border-top:1px solid #000;
			border-right:1px solid #000;
			border-bottom:1px dotted #000;
			text-align:right;
			font-weight:bold;
			}
			.invoice-box table td.umuka1 {
			border-left:1px solid #000;
			border-bottom:1px dotted #000;
			}.invoice-box table td.umuka2 {
			border-right:1px solid #000;
			border-bottom:1px dotted #000;
			text-align:right;
			font-weight:bold;
			}
			.invoice-box table td.sisa1 {
			border-left:1px solid #000;
			border-bottom:1px solid #000;
			}
			.invoice-box table td.sisa2 {
			border-right:1px solid #000;
			border-bottom:1px solid #000;
			text-align:right;
			font-weight:bold;
			}
			.invoice-box table td.ttd {
			border-bottom:1px dotted #000;
			text-align:center;
			font-weight:bold;
			}
			.invoice-box table td.borderl {
			border-left:1px dotted #000;
			}
			.invoice-box table td.borderr {
			border-right:1px dotted #000;
			}
			
			
			.invoice-box .table img{
			position: fixed;
			z-index:-1000;
			}
			.watermark{
			right:4cm;
			width:    4.5cm;
			height:   auto;
			opacity:0.2;
			z-index:-1
			
			/** Your watermark should be behind every content**/
            }
			.border{border:1px solid #333}
			.text-right{text-align:right}
			.text-center{text-align:center}
		</style>
	</head>
	
	<body>
		
		<?php
			if(isset($query)){
				$alamat = base64_decode($info['deskripsi']);
				$alamat = cleanString($alamat);
				$wa = $email = $_fb = $fb ='';
				if($info['phone']!='-'){
					$wa = $info['phone'];
				}
				if($info['email']!='-'){
					$email = $info['email'];
				}
				
				if($info['fb']!='-'){
					$fb = '<i class="fa fa-facebook-square"></i>&nbsp;<span class="sosmed">'.$info['fb'].'</span>&nbsp;';
				}
				
				$_ig ='';$ig ='';
				if($info['ig']!='-'){
					$ig = '<i style="margin-top:1px" class="fa fa-instagram"></i>&nbsp;<span class="sosmed">'.$info['ig'].'</span>';
				}
			?>
			<footer>
				<?=$info['title'];?> © <?php echo date("Y");?> 
			</footer>
			<div class="invoice-box">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="4" rowspan="5"><img src="<?=$logo;?>" style="width:100%; max-width:350px;"></td>
						<td colspan="2" class="tgl">LAPORAN HISTORY STOK</td>
					</tr>
					<tr class="">
						<td colspan="2"><?=periode_stok($id);?></td>
					</tr>
					<tr class="">
						<td colspan="2"></td>
					</tr>
					<tr class="kepada">
						<td class="tkepada">Dicetak pada</td>
						<td class="bawah"><?=date('d/m/Y');?></td>
					</tr>
					<tr class="kepada">
						<td class="tkepada">Dicetak oleh</td>
						<td class="bawah"><?=$user['nama_lengkap'];?></td>
					</tr>
					<tr class="">
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="4">
							<span class="alamat"><?=$alamat;?></span><br>
							<i style="margin-bottom:-3px" class="fa fa-whatsapp"></i>&nbsp;<span class="sosmed"><?=$wa;?></span> <i style="margin-bottom:-3px" class="fa fa-envelope-square"></i>&nbsp;<span class="sosmed"><?=$email;?></span> <?=$fb;?> <?=$ig;?> </td>
						<td colspan="2"></td>
					</tr>
				</table>
				<table style="width:100%;margin-top:5px" cellpadding="0" cellspacing="0">
					<tr class="heading">
						<td style="width:3%!important" class="text-right">No.</td>
						<td class="hormat">Nama Barang</td>
						<td style="width:10%!important" class="hormat">Tanggal</td>
						<td style="width:12%!important" class="total">Stok Masuk</td>
						<td style="width:12%!important" class="total">Stok Keluar</td>
						<td style="width:10%!important" class="total">Stok Akhir</td>
						<td style="width:5%!important" class="total">Ket</td>
					</tr>
					 
					<?php 
						
						$no = 1;
						$total = 0;
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
													<td class='text-right border'>$n.</td>
													<td class='border'>$nama</td>
													<td class='border'>".date_time($date,false)."</td>
													<td class='text-center border'>$terima</td>
													<td class='text-center border'>$kirim</td>
													<td class='text-center border'><strong>$mutasi</strong></td>
													<td class='text-right border'>$ket</td>
													</tr>
													";
													$n++;
													
												}
												
											}
										}
					?>
					 
				</table>
				<table class="table" style="width:100%;margin-top:50px;margin-left:5%" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="3">Manggarwetan , <?=tgl_indonesia(date('Y-m-d'));?></td>
					</tr>
					<tr>
						<td align="left"><?=$owner;?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
						</tr><tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
						</tr><tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td class="bold" align="left"><?=ttd_user('owner');?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</div>
		</body>
	<?php }else{ echo "Belum ada data penjualan";} ?>
</html>
