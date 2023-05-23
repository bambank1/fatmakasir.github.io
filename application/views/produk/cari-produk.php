<div class="row">
	<?php if(!empty($result)){
		$no = 1;
		
		foreach ($result as $row){
			$barcode = './uploads/barcodes/'.$row['barcode'].'.png';
			if(file_exists($barcode)){
				$barcode = base_url('uploads/barcodes/').$row['barcode'].'.png';
				}else{
				$barcode = base_url('produk/generate/').$row['barcode'];
			}
			if ($row['pub'] == 1){ 
				$aktif ='<i class="fa fa-check-circle"></i>';
				$text ='text-white'; 
				}else{ 
				$aktif = '<i class="fa fa-check-circle-o"></i>';
				$text ='text-white-50'; 
			}
			
			$hapus = '<button type="button" class="btn btn-danger text-white" data-id="'.$row['id'].'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash "></i> Hapus</button>';
		?>
		<div class="col-md-3 mb-2">
			<div class="card">
				<!--div class="card-header-p" style="background-image: url(<?=$barcode;?>); background-repeat: no-repeat; background-size: 240px 105px;">
				</div-->
				<center><svg id="itf-1<?=$no;?>" class="w-95"></svg></center>
				<script>JsBarcode("#itf-1<?=$no;?>", "<?=$row['barcode'];?>", {format: "itf14"});</script>
				<div class="card-body-p">
					<h2 class="name"><?=$row['jenis_cetakan'];?></h2>
					<h4 class="job-title"><?=$row['title'];?></h4>
				</div>
				
				<div class="card-footer-p">
					<div class='btn-group btn-group-sm' role='group'>
						<button type='button' class='btn btn-info btn-sm' data-id="<?=$row["id"];?>"><span class='icon <?=$text;?>'><?=$aktif;?></span></button>
						<button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#OpenModal' data-id="<?=$row["id"];?>" data-mod='edit'><i class='fa fa-edit'></i> Edit</button><?=$hapus;?>
					</div>
				</div>
			</div>
			
		</div>										
		<?php
			$no++;
		}
		
	}else{ ?>
	
	<?php } ?>
	
</div><!-- /.card-body -->
<nav aria-label="Page navigation" class="mt-2">
	<?php 
		echo $this->ajax_pagination->create_links(); 
	?>
</nav>
