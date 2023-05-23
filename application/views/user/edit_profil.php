<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?=$judul;?></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$judul;?></li>
		</ol>
	</div>
	<?php
		echo $this->session->flashdata('message');
		$attributes = array('class'=>'form-horizontal','role'=>'form');
		echo form_open_multipart($this->uri->segment(1).'/profil',$attributes); 
		
	?>
	
	<input type='hidden' name='id' value='<?=$rows['sesi_login'];?>'>
	<div class="row">
		<div class="col-md-6">
			<!-- Form Basic -->
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><?=$judul;?></h6>
					
				</div>
				<div class="card-body">
					
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" name="email" class="form-control" value="<?=$rows['email'];?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama">Nama lengkap</label>
						<input type="text" name="nama" class="form-control" value="<?=$rows['nama_lengkap'];?>" required>
					</div>
					<div class="form-group">
						<label for="jabatan">Jabatan</label>
						<input type="text" name="jabatan" class="form-control" value="<?=$rows['app_secret'];?>" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control" value="">
					</div>
					<?php  
						if ($rows['level'] == 'admin' AND $rows['parent']==0){ 
							$readonly ='readonly';
							$read ='';
							}else{
							$readonly ='';
							$read ='readonly';
						}
					?>
					<div class="form-group">
						<label>Level akses</label>
						<select name="level" class="custom-select form-control" <?=$readonly;?>>
							<?php 
								$akses=$this->model_app->view_where_ordering('hak_akses',array('level'=>$rows['level']),'id_level','ASC')->result_array();
								if(!empty($akses)){
									foreach($akses AS $key=>$val){
										if($val['id_level']==$rows['id_level']){
											echo '<option value="'.$val['id_level'].','.$val['level'].'" selected>'.$val['nama'].'</option>';
											}else{
											echo '<option value="'.$val['id_level'].','.$val['level'].'">'.$val['nama'].'</option>';
										}
									}
								} 
							?>
						</select>
					</div>
					
					<div class="form-group d-flex flex-row">
						<?php if ($rows['aktif']=='Y'){ ?>
							<div class="col-sm-3">Status</div>
							<div class="col-sm-9"><span class="badge badge-success flat">Aktif</span>
								<input type="hidden" value="Y" id="aktif1" name="aktif">
							</div>
							
						<?php } ?>
					</div>	
					<button type="submit" name="submit" class="btn btn-success">Update</button>
					<a href="<?=base_url();?>user" class="btn btn-danger">Batal</a>
                    
				</div>
			</div>
			
			
		</div>
		<div class="col-md-6">
			<!-- Form Basic -->
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Menu akses pengguna</h6>
				</div>
				<div class="card-body">
                    <div class="over-profile">
						<input id="select_all" class="minimal" type="checkbox"> <label for='select_all'> Select All</label>
						<!-- text input -->
						<?php
							$lv = $rows['id_level'];
							$parent = $rows['parent'];
							$resultz = $this->db->query("SELECT * FROM menuadmin where FIND_IN_SET('$lv', CONCAT(id_level, ',')) AND aktif='Y' order by urutan");
							if($resultz->num_rows() >0){
								foreach ($resultz->result_array() as $rowz){
									$dataTz[$rowz['idparent']][] = $rowz;
								}
								echo checkbox($dataTz,0,$rowz['idparent'],$rows['idmenu'],$parent);
							}
						?>
					</div>
					<div class="form-group">	
						<label>Type Akses</label>
						<?php  
							if ($rows['level'] == 'admin' AND $rows['parent']==0){ ?>
							<select id="akses" name="akses[]" class="form-control select2-profil" multiple="multiple" <?=$read;?>>
								<?php
									foreach($kategori as $rowz){
										$dataTzx[$rowz->id_parent][] = $rowz;
									}
									echo select_badge($dataTzx,0,0,$rows['type_akses']);
								?>
							</select>
							<?php }else{
								foreach($kategori as $rowz){
									$dataTzx[$rowz->id_parent][] = $rowz;
								}
								echo "<br>";
								echo select_badge($dataTzx,0,$rows['parent'],$rows['type_akses']);
							}
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>
<style>
	select[readonly] {
	background: #eee;
	pointer-events: none;
	touch-action: none;
	}
</style>
<script>
	
	var parent = "<?=$rows['parent'];?>";
	if(level=='admin' && parent==0){
		$('.over-profile').slimScroll({
			height: '300px'
		});
		}else{
		$('.over-profile').slimScroll({
			height: '350px'
		});
	}
	
	$('select[readonly=readonly] option:not(:selected)').prop('disabled', true);
	$(document).ready(function(){
		// firs_load();
		$('#select_all').on('click',function(){
			if(this.checked){
				$('.checkbox').each(function(){
					this.checked = true;
				});
				}else{
				$('.checkbox').each(function(){
					this.checked = false;
				});
			}
		});
		
		$('.checkbox').on('click',function(){
			if($('.checkbox:checked').length == $('.checkbox').length){
				$('#select_all').prop('checked',true);
				}else{
				$('#select_all').prop('checked',false);
			}
		});
	});
	</script>								