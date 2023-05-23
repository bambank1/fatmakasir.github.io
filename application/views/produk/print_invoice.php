<?php 
	$coun = count($detail); 
	$top = 0;
	if($coun==2){
		$top = '8cm';
		}elseif($coun==3){
		$top = '7cm';
		}elseif($coun==4){
		$top = '8cm';
		}elseif($coun==5){
		$top = '9cm';
		}elseif($coun==6){
		$top = '10cm';
		}elseif($coun==7){
		$top = '11cm';
		}elseif($coun==8){
		$top = '12cm';
		}elseif($coun==9){
		$top = '9cm';
		}elseif($coun==10){
		$top = '10cm';
		}elseif($coun==11){
		$top = '11cm';
		}elseif($coun==12){
		$top = '12cm';
		}else{
		$top = '6cm';
	}
	
	if($konsumen['no_hp']=='-'){
		$no_hp = '-';
		}else{
		$no_hp = hp_1(hp_2($konsumen['no_hp']));
	}
	if($tdetail == $total->total AND $pajak==0){
		
		$stamp  = $lunas;
		$alt    = '';
		$logo   = $logo_lunas;
		$color  = $info['warna_lunas'];
		$_waicon = $waicon['color'];
		$_mail   = $mail['color'];
		$_fbicon = $fbicon['color'];
		$_igicon = $igicon['color'];
		
		}elseif($tdetail == $total->total AND $pajak>0){
		$stamp = $lunas;
		$alt = '';
		$logo = $logo_lunas;
		$color = $info['warna_lunas'];
		$_waicon = $waicon['color'];
		$_mail   = $mail['color'];
		$_fbicon = $fbicon['color'];
		$_igicon = $igicon['color'];
		}elseif($tdetail != $total->total AND $pajak==0){
		$stamp = $blunas;
		$alt = '';
		$logo = $logo_blunas;
		$color = $info['warna_blunas'];
		$_waicon = $waicon['bw'];
		$_mail   = $mail['bw'];
		$_fbicon = $fbicon['bw'];
		$_igicon = $igicon['bw'];
		}elseif($tdetail != $total->total AND $pajak>0){
		$stamp = $blunas;
		$alt = '';
		$logo = $logo_blunas;
		$color = $info['warna_blunas'];
		$_waicon = $waicon['bw'];
		$_mail   = $mail['bw'];
		$_fbicon = $fbicon['bw'];
		$_igicon = $igicon['bw'];
		}else{
		$stamp = $blunas;
		$alt = '';
		$logo = $logo_blunas;
		$color = $info['warna_blunas'];
		$_waicon = $waicon['bw'];
		$_mail   = $mail['bw'];
		$_fbicon = $fbicon['bw'];
		$_igicon = $igicon['bw'];
	}
	if($cetak->status=='batal'){
		$stamp = '';
		$alt = 'BATAL';
		$color = "#333";
		$_waicon = $waicon['bw'];
		$_mail   = $mail['bw'];
		$_fbicon = $fbicon['bw'];
		$_igicon = $igicon['bw'];
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cetak Invoice</title>
		<link href="<?= $favicon;?>" rel="icon">
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
			background-color: <?=$color;?>;
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
			background: <?=$color;?>;
			color: #fff;
			font-weight: normal;
			padding: 5px;
			text-transform: uppercase;
			}
			
			.invoice-box table tr.details td {
			padding-bottom: 20px;
			}
			
			.invoice-box table tr.item td{
			border-bottom: 1px solid <?=$color;?>;
			}
			.invoice-box table tr.item td{
			border-bottom: 1px solid <?=$color;?>;
			}
			.invoice-box table tr.item1:first-child td {
			border-bottom:1px dotted <?=$color;?>;  
			}
			.invoice-box table tr.item2:first-child td {
			border-bottom:1px solid <?=$color;?>;  
			}
			
			.invoice-box table tr.item2:last-child td {
			border-top:1px dotted <?=$color;?>;  
			border-bottom:1px solid <?=$color;?>;  
			}
			
			.invoice-box table tr.kepada td{
			font-weight:bold;
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
			font-weight:bold;
			border-bottom:1px dotted #000;
			}
			.invoice-box table td.tkepada {
			background:<?=$color;?>;
			opacity:0.7;
			width:12%!important
			}
			.invoice-box table tr.alamat{
			color:#000;
			width:50%!important;
			vertical-align: top!important;
			}
			.invoice-box table tr.kepada td.bawah {
			color:#000;
			font-weight:normal;
			width:30%!important
			}
			
			.invoice-box table tr.alamat td.nomor {
			font-weight:bold;
			vertical-align: text-bottom!important;
			}
			.invoice-box table td.total1 {
			border-left:1px solid <?=$color;?>;
			border-top:1px solid <?=$color;?>;
			border-bottom:1px dotted <?=$color;?>;
			}
			.invoice-box table td.total2 {
			border-top:1px solid <?=$color;?>;
			border-right:1px solid <?=$color;?>;
			border-bottom:1px dotted <?=$color;?>;
			text-align:right;
			font-weight:bold;
			}
			
			.invoice-box table td.lunas1 {
			border-left:1px solid <?=$color;?>;
			border-bottom:1px solid <?=$color;?>;
			background:<?=$color;?>;
			color:#fff;
			}
			.invoice-box table td.lunas2 {
			border-right:1px solid <?=$color;?>;
			border-bottom:1px solid <?=$color;?>;
			text-align:right;
			font-weight:bold;
			background:<?=$color;?>;
			color:#fff;
			}
			
			.invoice-box table td.umuka1 {
			border-left:1px solid <?=$color;?>;
			border-bottom:1px dotted <?=$color;?>;
			}
			.invoice-box table td.umuka2 {
			border-right:1px solid <?=$color;?>;
			border-bottom:1px dotted <?=$color;?>;
			text-align:right;
			font-weight:bold;
			}
			
			.invoice-box table td.sisa1 {
			border-left:1px solid <?=$color;?>;
			border-bottom:1px solid <?=$color;?>;
			}
			.invoice-box table td.sisa2 {
			border-right:1px solid <?=$color;?>;
			border-bottom:1px solid <?=$color;?>;
			text-align:right;
			font-weight:bold;
			}
			.invoice-box table td.ttd {
			border-bottom:1px dotted <?=$color;?>;
			text-align:center;
			font-weight:bold;
			}
			.invoice-box table td.border {
			border-right:1px dotted <?=$color;?>;
			}
			
			
			.invoice-box .table img{
			position: fixed;
			z-index:-1000;
			width:200px;
			}
			.watermark{
			top:<?=$top;?>;
			right:4cm;
			width:    4.5cm;
			height:   auto;
			opacity:0.2;
			position:absolute;
			z-index:-1
			
			/** Your watermark should be behind every content**/
            }
			.alamat{font-size:11pt;}
			.sosmed{font-size:8pt;}
			
			
			
		</style>
		<?php if($html=="Y"){ ?>
			<style>
				@media print {
				.invoice-box {
				width:100%;
				margin: auto;
				padding: 10px;
				font-size: 12px;
				line-height: 18px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
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
				background: #<?=$color;?>;
				color: #fff;
				font-weight: normal;
				padding: 5px;
				text-transform: uppercase;
				}
				
				.invoice-box table tr.details td {
				padding-bottom: 20px;
				}
				
				.invoice-box table tr.item td{
				border-bottom: 1px solid #000;
				
				}
				.invoice-box table tr.kepada td{
				font-weight:bold;
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
				font-weight:bold;
				border-bottom:1px dotted #000;
				}
				.invoice-box table td.tkepada {
				background:#<?=$color;?>;
				opacity:0.7;
				width:12%!important
				}
				.invoice-box table tr.kepada td.bawah {
				color:#000;
				width:30%!important
				}
				.invoice-box table td.nomor {
				font-weight:bold;
				}
				.invoice-box table td.total1 {
				border-left:1px solid <?=$color;?>;
				border-top:1px solid <?=$color;?>;
				border-bottom:1px dotted <?=$color;?>;
				}
				.invoice-box table td.total2 {
				border-top:1px solid <?=$color;?>;
				border-right:1px solid <?=$color;?>;
				border-bottom:1px dotted <?=$color;?>;
				text-align:right;
				font-weight:bold;
				}
				.invoice-box table td.lunas1 {
				border-left:1px solid <?=$color;?>;
				border-bottom:1px solid <?=$color;?>;
				}
				.invoice-box table td.lunas2 {
				border-right:1px solid <?=$color;?>;
				border-bottom:1px solid <?=$color;?>;
				text-align:right;
				font-weight:bold;
				}
				.invoice-box table td.umuka1 {
				border-left:1px solid <?=$color;?>;
				border-bottom:1px dotted <?=$color;?>;
				}.invoice-box table td.umuka2 {
				border-right:1px solid <?=$color;?>;
				border-bottom:1px dotted <?=$color;?>;
				text-align:right;
				font-weight:bold;
				}
				.invoice-box table td.sisa1 {
				border-left:1px solid <?=$color;?>;
				border-bottom:1px solid <?=$color;?>;
				}
				.invoice-box table td.sisa2 {
				border-right:1px solid <?=$color;?>;
				border-bottom:1px solid <?=$color;?>;
				text-align:right;
				font-weight:bold;
				}
				.invoice-box table td.ttd {
				border-bottom:1px dotted #000;
				text-align:center;
				font-weight:bold;
				}
				.invoice-box table td.border {
				border-right:1px dotted #000;
				}
				
				
				.invoice-box .table img{
				position: fixed;
				z-index:-1000;
				}
				.watermark{
				top:<?=$top;?>;
				right:4cm;
				width:    4.5cm;
				height:   auto;
				opacity:0.2;
				z-index:-1
				
				/** Your watermark should be behind every content**/
				}
				.sosmed{font-size:8pt;}
				}
			</style>
			<script type="text/javascript">
				<!--
				window.print();
				window.onfocus=function(){ window.close();}
				//-->
			</script>
			<?php }
			$deskripsi = base64_decode($info['deskripsi']);
			$deskripsi = cleanString($deskripsi);
			$wa = $email = $_fb = $fb ='';
			if($info['phone']!='-'){
				$_wa = '<img src="'.$_waicon.'" alt="" height="10" />';
				$wa = $info['phone'];
			}
			if($info['email']!='-'){
				$_email = '<img src="'.$_mail.'" alt="" height="10" />';
				$email = $info['email'];
			}
			
			if($info['fb']!='-'){
				$_fb = '<img src="'.$_fbicon.'" alt="" height="10" />';
				$fb = $info['fb'];
			}
			
			$_ig ='';$ig ='';
			if($info['ig']!='-'){
				$_ig = '<img src="'.$_igicon.'" alt="" height="10" />';
				$ig = $info['ig'];
			}
			if($konsumen['tampil']==1){
				$nama = $konsumen['perusahaan'];
				$perusahaan = cek_jenis_lembaga($konsumen['jenis']);
				$telp = $konsumen['no_telp'];
				$alamat = $konsumen['alamat_lembaga'];
				}else{
				$nama = $konsumen['nama'];
				$perusahaan = cek_jenis_lembaga($konsumen['jenis']);
				$telp = $konsumen['no_hp'];
				$alamat = $konsumen['alamat'];
			}
		?>
		<style>
			img.logo{max-width:400px;max-height:100px}
		</style>
	</head>
	<body>
		<footer>
            <?=$info['title'];?> © <?php echo date("Y");?> 
		</footer>
		<div class="invoice-box">
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr class="alamat">
					<td colspan="4" rowspan="7" valign="top" style="width:60%!important">
						<img class="logo" src="<?=$logo;?>" alt="" /><br>
						<span class="alamat"><?=$deskripsi;?></span><br>
						<?=$_wa;?>&nbsp;<span class="sosmed"><?=$wa;?></span>&nbsp;<?=$_email;?>&nbsp;<span class="sosmed"><?=$email;?></span>&nbsp;<?=$_fb;?>&nbsp;<span class="sosmed"><?=$fb;?></span>&nbsp;<?=$_ig;?>&nbsp;<span class="sosmed"><?=$ig;?></span>
					</td>
					<td colspan="2" class="tgl"><?=$info['keywords'];?>, <?=date_time($cetak->tgl_trx,false);?></td>
				</tr>
				<tr class="kepada">
					<td width="244" class="tkepada">Kepada Yth.</td>
					<td width="72" class="bawah"><?=$nama;?></td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">Perusahaan</td>
					<td class="bawah"><?=$perusahaan;?></td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">Telp</td>
					<td class="bawah"><?=$telp;?></td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">Alamat</td>
					<td rowspan="2" class="bawah"><?=$alamat;?></td>
				</tr>
				<tr class="kepada">
					<td class="tkepada">&nbsp;</td>
				</tr>
				<tr class="alamat">
					<td colspan="2"  class="nomor">NO. ORDER #<?=$cetak->id_transaksi;?></td>
				</tr>
			</table>
			<table style="width:100%;margin-top:5px" cellpadding="0" cellspacing="0">
				<tr class="heading">
					<td align="left" style="width:8%!important">qty</td>
					<td style="width:15%!important">Produk</td>
					<td style="width:20%!important">Nama Barang/Merk</td>
					<td align="right" style="width:10%!important">Ukuran</td>
					<td style="width:10%!important;text-align:right">Harga</td>
					<?php if($cdiskon>0){ ?>
						<td style="width:5%!important;text-align:right">Disc%</td>
					<?php } ?>
					<td class="total" style="width:16%!important">Total harga</td>
				</tr>
				<?php 
					$no=1; 
					$totalb=0; 
					$subtotal=0; 
					$sisa=0; 
					$diskon=0; 
					$finishing ='';
					foreach($detail  AS $val){
						$diskon = $val['jumlah'] * $val['harga'] * $val['diskon']/100;
						$totalb = $val['jumlah'] * $val['harga'] - $diskon;
						$subtotal += $totalb;
						if(!empty($val['detail'])){
							$finishing = json_decode($val['detail']);
						}
						if(!empty($finishing)){
							$item1 = 'item1';
							$item2 = 'item2';
							}else{
							$item1 = 'item';
							$item2 = 'item';
						}
					?>
					<tr class="<?=$item1;?>">
						<td align="left" class="border"><?=$val['jumlah'];?> <?=get_satuan($val['satuan']);?></td>
						<td class="border"><?=$val['title'];?></td>
						<td class="border"><?=$val['nbahan'];?></td>
						<td class="border" align="right"><?=$val['ukuran'];?></td>
						<td class="border" align="right"><?=rp($val['harga']);?></td>
						<?php if($cdiskon>0){ ?>
							<td class="border" align="right"><?=rp($val['diskon']);?></td>
						<?php } ?>
						<td class="total"><?=rp($totalb);?></td>
					</tr>
					<?php 
						if(!empty($finishing)){ ?>
						<tr class="<?=$item2;?>">
							<td colspan="5">
								<?php 
									
									echo "Catatan : ";
									foreach($finishing->data  AS $key=>$vals){
										echo ' | '.$vals->title.':'.$vals->isi.' | '; 
									}
									
								?>
							</td>
						</tr>
						<?php } 
					$no++; } 
					$pajak = ($subtotal * $cetak->pajak) /100;
					$sisa = $pajak + $subtotal - $total->total;
					$cek_bayar = $pajak + $subtotal;
				?>
				
			</table>
			<img class="watermark" src="<?=$stamp;?>" width="100px" alt="" />
			<table class="table" style="width:100%;margin-top:10px" cellpadding="0" cellspacing="0">
				<tr>
					<td width="11%" rowspan="5" align="left" style="width:35%!important"><?php
						if($alt=='BATAL'){
							echo "ORDER BATAL";
							}else{
							// print_r($cetak);
						?>
					Cara Bayar : <?php if($total->total!=0){ if(isset($cara)){ echo strtoupper($cara->nama_bayar);}}else{echo "Piutang";}} ?><br>
					Pembayaran Transfer Via Rekening <br>
					<span style="font-size:8pt;line-height:12px">
						<?php foreach($bank AS $val){
							echo $val->inisial.' a.n '.$val->pemilik.' <b>'.$val->nomor_rekening.'</b><br>';
						} ?>
					</span>
					</td>
					<td width="17%" align="center" style="width:20%!important">HORMAT KAMI</td>
					<td width="0%">&nbsp;</td>
					<td width="21%" align="center" style="width:20%!important">PEMESAN</td>
					<td width="1%">&nbsp;</td>
					<td width="9%" class="total1" style="width:12%">Total Order</td>
					<td width="16%" class="total2" style="width:19%"><?=rp($subtotal);?></td>
				</tr>
				
				<?php if($cetak->pajak >0){?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td class="umuka1">Pajak <?=$cetak->pajak;?>%</td>
						<td class="umuka2"><?=rp($pajak);?></td>
					</tr>
				<?php } ?>
				<?php 
					$urutan  =0;
					$numItems = count($bdetail);
					$i = 0;
					$ni = 1;
					foreach($bdetail AS $val){
						if($sisa==0 AND $cdetail==1 AND $val['jml_bayar']==$cek_bayar){
							echo '<tr class="lunas">
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="lunas1">Bayar</td>
							<td class="lunas2">'.rp($total->total).'</td>
							</tr>';
							
							}elseif($sisa >0 AND $cdetail >=1 AND $val['jml_bayar']!=$cek_bayar){
							echo '<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="umuka1">Bayar ke-'.$ni.'</td>
							<td class="umuka2">'.rp($val['jml_bayar']).'</td>
							</tr>';
							}else{
							echo '<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>';
							if($cdetail >1 AND $total->total!=$cek_bayar){
								echo '<td class="umuka1">Bayar ke-'.$ni.'</td>';
								}elseif($cdetail >1 AND $total->total==$cek_bayar){
								if(++$i === $numItems) {
									echo '<td class="umuka1">Pelunasan</td>';
									}else{
									echo '<td class="umuka1">Bayar ke-'.$ni.'</td>';
								}
								}else{
								echo '<td class="umuka1">Pelunasan</td>';
							}
							echo '<td class="umuka2">'.rp($val['jml_bayar']).'</td>
							</tr>';
						}
					$ni++;}
				?>
				
				<tr>
					<td class="ttd"><?=$marketing['nama_lengkap'];?></td>
					<td>&nbsp;</td>
					<td class="ttd"><?=$konsumen['nama'];?></td>
					<td>&nbsp;</td>
					<?php if($sisa >0){ ?>
						<td class="sisa1">Piutang</td>
						<td class="sisa2"><?=rp($sisa);?></td>
					<?php }else{ ?>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<?php } ?>
				</tr>
				<tr>
					<td colspan="8" align="right" style="font-size:6pt">dicetak pada <?=dtimes(date('Y-m-d H:i:s'));?> | <?php if(isset($cara)){ 
					echo $cetak->cetak.' x cetak'; } ?></td>
				</tr>
				<tr>
					<td colspan="8" align="right" style="font-size:6pt;width:30%!important;line-height:6pt"><?=base64_decode($info['footer_invoice']);?></td>
				</tr>
			</table>
			
		</div>
	</body>
</html>
