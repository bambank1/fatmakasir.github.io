<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cetak Invoice</title>
		<link href="#" rel="icon">
		<script src="<?= base_url('assets/'); ?>js/JsBarcode.all.min.js" type="text/javascript"></script>
		<style>
			body {
			background: rgb(204,204,204); 
			}
			page {
			background: white;
			display: block;
			margin: 0 auto;
			margin-bottom: 0.5cm;
			 
			}
			page[size="A4"] {  
			width: 21cm;
			height: 29.7cm; 
			}
			page[size="A4"][layout="landscape"] {
			width: 29.7cm;
			height: 21cm;  
			}
			page[size="A3"] {
			width: 29.7cm;
			height: 42cm;
			}
			page[size="A3"][layout="landscape"] {
			width: 42cm;
			height: 29.7cm;  
			}
			page[size="A5"] {
			width: 14.8cm;
			height: 21cm;
			}
			page[size="A5"][layout="landscape"] {
			width: 21cm;
			height: 14.8cm;  
			}
			@media print {
			body, page {
			margin: 0;
			box-shadow: 0;
			}
			}
			* {
			box-sizing: border-box;
			}
			
			.column {
			float: left;
			width: 25%;
			padding: 5px;
			}
			
			/* Clearfix (clear floats) */
			.row::after {
			content: "";
			clear: both;
			display: table;
			}
			
			/* Tata letak responsif - membuat ketiga kolom bertumpuk, bukan bersebelahan */
			@media screen and (max-width: 500px) {
			.column {
			width: 100%;
			}
			}
		</style>
		<script type="text/javascript">
			<!--
			window.print();
			window.onfocus=function(){ window.close();}
			//-->
		</script>
	</head>
	<body>
		<page size="A4">
			<div class="invoice-box row">
				<?php 
					
					$urutan  =0;
					foreach($result AS $row){ ?>
					<div class="column">
						<center><svg id="itf-1<?=$no;?>" style="width:180px;height:100px"></svg></center>
						<script>JsBarcode("#itf-1<?=$no;?>", "<?=$row['barcode'];?>", {format: "itf14"});</script>					
					</div>			
					<?php 	}
				?>
				
			</div>
		</page>
	</body>
</html>
