<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Aktifitas Transaksi <span id="test"></span></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Aktifitas Transaksi</li>
		</ol>
	</div>
    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="input-group input-group-sm">
						<div class="input-group-prepend">
							<span class="input-group-text">SORT</span>
						</div>
						<select id="sortBy" class="form-control custom-select w-5px" onchange="FilterLog()" style="width:10px!important;padding-right:0!important">
							<option value="DESC">DESC</option>
							<option value="ASC">ASC</option>
						</select>
						<div class="input-group-prepend">
							<span class="input-group-text">LIMIT</span>
						</div>
						<select id="limits" name="limits" class="form-control custom-select w-5px" onchange="FilterLog()">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="500">500</option>
						</select>
						
						<div class="input-group-append">
							<span class="input-group-text">Pengguna</span>
						</div>
						<select name="user" id="user"  class="custom-select" onchange="FilterLog()">
							<option value="" style="font-weight:bold;border-bottom:1px solid #ddd;">SEMUA</option>
							<?php  
								foreach ($user AS $values){
									echo '<option value="'.$values['id_user'].'">'.$values['nama_lengkap'].'</option>';
								}
							?>
						</select>
						<div class="input-group-append">
							<span class="input-group-text">Tanggal</span>
						</div>
						<div  id="date-pengeluaran">
							<div class="input-daterange input-group input-group-sm">
								<input type="text" onchange="FilterLog()" value="<?=$dari;?>" class="form-control" name="dari" id="dari">
								
								<input type="text" onchange="FilterLog()" value="<?=$sampai;?>" class="form-control" name="sampai" id="sampai">
							</div>
						</div>
						
						<div class="btn-group" role="group">
							<button class="btn btn-success btn-sm" onclick="FilterLog();"><i class="fa fa-search"></i> TAMPILKAN</button>
							<button class="btn btn-primary btn-sm url_doc" data-url="log" type="button" data-toggle="tooltip" data-original-title="Dok Log Transaksi" data-placement="left"><i class="fa fa-info-circle"></i></button>
						</div>
					</div>
				</div>
				<div class="post-list" id="dataLog">
					<div class="card-body table-responsive">
						<div class="card-block">
							<table class="table table-striped table-mailcard">
								<thead class="thead-dark">
									<tr>
										<th class="w-2 text-center">#</th>
										<th class="w-10">ID.Transaksi</th>
										<th class="w-25">Tanggal</th>
										<th class="text-left">Catatan</th>
										<th class="text-left">Kasir</th>
										<th class="w-10 text-right">Nominal</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$total_masuk=0;
										$total_keluar=0;
										$button='';
										if(!empty($result)){
											$no=$this->uri->segment(3)+1;
											foreach($result AS $aRow){
												if($aRow->pemasukan){
													$nominal = '<span class="text-success">'.rp($aRow->pemasukan).'</span>';
													$jenis = '<button class="btn btn-success btn-sm"><i class="fa fa-arrow-circle-right"></i></button>';
													$total_masuk += $aRow->pemasukan;
													}else{
													$nominal = '<span class="text-danger">'.rp($aRow->pengeluaran).'</span>';
													$jenis = '<button class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i></button>';
													$total_keluar +=$aRow->pengeluaran;
												}
											?>
											<tr style="">
												<td class="text-center"><?=$jenis;?></td>
												<td class="text-left"><?=$aRow->id_generate;?></td>
												<td class="text-left"><?=dtimes($aRow->create_date,true,false);?></td>
												<td class="text-left"><?=$aRow->catatan;?></td>
												<td class="text-left"><?=$aRow->nama_lengkap;?></td>
												<td class="text-right"><?=$nominal;?></td>
											</tr>
										<?php $no++;} ?>
										<?php }else{ ?>
										<tr>
											<td colspan="6">BELUM ADA DATA</td>
										</tr>
									<?php } ?>
									<tr>
										<td class="w-2 text-center"><button class="btn btn-success btn-sm"><i class="fa fa-arrow-circle-right"></i></button></td>
										<td colspan="3" class="text-left text-success"><strong>TOTAL PEMASUKAN</strong></td>
										<td colspan="3" class="text-right text-success"><strong><?=rp($total_masuk);?></strong></td>
									</tr>
									<tr>
										<td class="w-2 text-center"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i></button></td>
										<td colspan="3" class="text-left text-danger"><strong>TOTAL PENGELUARAN</strong></td>
										<td colspan="3" class="text-right text-danger"><strong><?=rp($total_keluar);?></strong></td>
									</tr>
								</tbody>
							</table>
							<nav aria-label="Page navigation">
								<?php echo $this->ajax_pagination->create_links(); ?>
							</nav>
						</div><!-- /.card-body -->
					</div><!-- /.card-body -->
					<!-- Display posts list -->
					
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.cell-1 {
	border-collapse: separate;
	border-spacing: 0 4em;
	background: #ffffff;
	border-bottom: 5px solid transparent;
	background-clip: padding-box;
	cursor: pointer
	}
	
	
	.table-elipse {
	cursor: pointer
	}
	
	.row-child {
	background-color: #dbdbea;
	}
</style>
<script>
	
	function FilterLog(page_num){
		page_num = page_num?page_num:0;
		var sortBy = $('#sortBy').val();
		var limits = $('#limits').val();
		var user = $('#user').val();
		var dari = $('#dari').val();
		var sampai = $('#sampai').val();
		$.ajax({
			type: 'POST',
			url: base_url+'aktifitas/ajaxlog/'+page_num,
			data:{page:page_num,sortBy:sortBy,limits:limits,user:user,dari:dari,sampai:sampai},
			beforeSend: function(){
				$('body').loading();
			},
			success: function(html){
				$('#dataLog').html(html);
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
				$('body').loading('stop');
			}
		});
		
	}
	var date2 = new Date();
	$('#date-pengeluaran .input-daterange').datepicker({        
		format: 'dd/mm/yyyy', 
		"endDate": date2,
		autoclose: true,     
		todayHighlight: true,   
		todayBtn: 'linked',
	});    
</script>																																					