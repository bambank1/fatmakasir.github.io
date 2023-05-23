<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LAPORAN STOK BARANG</title>
		
		<style>
			@page {
			margin: 30px 0 0 0;
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
			margin: -20px auto 30px ;
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
			background-color: #333;
			color: white;
			text-align: center;
            }
			
			.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
			page-break-inside: auto;
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
			background:#333;
			color: #fff;
			font-weight: bold;
			padding: 5px;
			}
			.invoice-box table tr.profit td {
			background: #444444;
			color: #fff;
			font-weight: bold;
			padding: 5px;
			}
			
			.invoice-box table tr.details td {
			padding-bottom: 20px;
			}
			.invoice-box table tr.item td{
			border-bottom: 1px dotted #333;
			}
			
			.invoice-box table td.title{
			font-weight: bold;
			}
			.invoice-box table tr.kepada td{
			color: #fff;
			border-bottom:1px dotted #000
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
			font-weight: bold;
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
			.invoice-box table td.nomor {
			border-left:1px dotted #000;
			border-right:1px dotted #000;
			}
			.invoice-box table td.border {
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
			.alamat{font-size:10pt;}
			.sosmed{font-size:8pt;}
			img.logo{max-width:200px;max-height:100px}
		</style>
	</head>
	
	<body>
		
		<?php
			
			if(!empty($laporan)){
				$logo = $logo_blunas;
				$color = $info['warna_blunas'];
				$waicon = $waicon['bw'];
				$mail   = $mail['bw'];
				$fbicon = $fbicon['bw'];
				$igicon = $igicon['bw'];
				$alamat = base64_decode($info['deskripsi']);
				$alamat = cleanString($alamat);
				$wa = $email = $_fb = $fb ='';
				if($info['phone']!='-'){
					$_wa = '<img src="'.$waicon.'" alt="" height="10" />';
					$wa = $info['phone'];
				}
				if($info['email']!='-'){
					$_email = '<img src="'.$mail.'" alt="" height="10" />';
					$email = $info['email'];
				}
				
				if($info['fb']!='-'){
					$_fb = '<img src="'.$fbicon.'" alt="" height="10" />';
					$fb = $info['fb'];
				}
				
				$_ig ='';$ig ='';
				if($info['ig']!='-'){
					$_ig = '<img src="'.$igicon.'" alt="" height="10" />';
					$ig = $info['ig'];
				}
			?>
			<footer>
				<?=$info['title'];?> © <?php echo date("Y");?> 
			</footer>
			<div class="invoice-box">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr class="alamat">
						<td colspan="4" rowspan="5" valign="top" style="width:60%!important">
							<img class="logo" src="<?=$logo;?>" alt="" /><br>
							<span class="alamat"><?=$alamat;?></span><br>
							<?=$_wa;?>&nbsp;<span class="sosmed"><?=$wa;?></span>&nbsp;<?=$_email;?>&nbsp;<span class="sosmed"><?=$email;?></span>&nbsp;<?=$_fb;?>&nbsp;<span class="sosmed"><?=$fb;?></span>&nbsp;<?=$_ig;?>&nbsp;<span class="sosmed"><?=$ig;?></span>
						</td>
						<td colspan="2" class="tgl">LAPORAN STOK BARANG</td>
					</tr>
					
					<tr class="kepada">
						<td class="tkepada">Dicetak oleh</td>
						<td class="bawah"><?=$user['nama_lengkap'];?></td>
					</tr>
					<tr class="kepada">
						<td class="tkepada">Dicetak pada</td>
						<td class="bawah"><?=dtimes(date('Y-m-d H:i'),true,true);?></td>
					</tr>
				</table>
				<table style="width:100%;" cellpadding="0" cellspacing="0">
					<tr class="heading">
						<td align="center" style="width:3%!important">NO</td>
						<td style="width:15%!important">NAMA BARANG</td>
						<td style="width:10%!important;text-align:center">STOK MASUK</td>
						<td style="width:10%!important;text-align:center">STOK KELUAR</td>
						<td style="width:10%!important;text-align:center">SISA STOK</td>
					</tr>
					
					<?php
						$no=1;
						$jml_masuk=0;
						$jml_keluar=0;
						$sisa=0;
						$total_masuk=0;
						$total_keluar=0;
						$total_sisa=0;
 
						foreach($laporan as $row){ 
							$jml_masuk = stok_masuk($row->id);
							$jml_keluar = stok_keluar($row->id);
							$sisa = $jml_masuk - $jml_keluar;
							
							$total_masuk += $jml_masuk;
							$total_keluar += $jml_keluar;
							$total_sisa += $sisa;
							 
						?>
						<tr class="item">
							<td class="nomor" align="center"><?=$no++;?></td>
							<td class="border"><?=$row->title; ?></td>
							<td class="border" align='center'><?=rp($jml_masuk); ?></td>
							<td class="border" align='center'><?=rp($jml_keluar); ?></td>
							<td class="border" align='center'><?=rp($sisa); ?></td>
						</tr>
					<?php } ?>
					<tr class="heading">
						<td class="font-weight-bold">TOTAL</td>
						<td></td>
						<td align='right'><?=rp($total_masuk);?></td>
						<td align='right'><?=rp($total_keluar);?></td>
						<td align='right'><?=rp($total_sisa);?></td>
					</tr>
				</table>
			</div>
		</body>
		<?php }else{ echo "Belum ada data penjualan";} ?>
		</html>
										