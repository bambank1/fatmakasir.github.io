<form id="formAdd">
	<input type="hidden" value="<?=encrypt_url($arr->id_user);?>" class="form-control" id="id" name="id">
	<input type="hidden" value="edit" class="form-control" id="type" name="type">
	
	<div class="row mt-0 pt-0">
		<div class="col-md-6">
			<div class="card-block">
				<div class="form-group mb-1 mt-0 pt-0">
					<label for="mail">Email</label>
					<input type="email" name="mail" value="<?=$arr->email;?>" class="form-control form-control-sm" id="mail" placeholder="Email" required="" readonly>
				</div>
				<div class="form-group mb-1">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Password Pengguna" value="" required="">
				</div>
				<div class="form-group mb-1">
					<label for="title">Nama Lengkap</label>
					<input type="text" name="title" value="<?=$arr->nama_lengkap;?>" class="form-control form-control-sm" id="title" placeholder="Nama Lengkap" required="">
				</div>
				<div class="form-group mb-1">
					<label for="title">Jabatan</label>
					<input type="text" name="jabatan" value="<?=$arr->app_secret;?>" class="form-control form-control-sm" id="jabatan" placeholder="jabatan" required="">
				</div>
				<div class="form-group mb-1">
					<label for="daftar">TGL. Daftar </label>
					<input type="date" name="daftar" value="<?=($arr->tgl_daftar);?>" class="form-control form-control-sm dpd1"  id="daftar">
				</div>
				<div class="form-group mb-1">
					<label for="phone">No. Handphone</label>
					<input type="text" name="phone" value="<?=$arr->no_hp;?>" class="form-control form-control-sm" id="phone" placeholder="No. Handphone">
				</div>
				
				<div class="form-group mb-1">
					<label for="alamat">Alamat</label>
					<input type="text" name="alamat" value="<?=$arr->alamat;?>" class="form-control  form-control-sm" id="alamat" placeholder="Alamat Percetakan">
				</div>
				
				
			</div>
		</div>
		<div class="col-md-6">
			<div class="card-block">
				<div class="form-group mb-0">
					<label for="profit">Menu Akses</label>
				</div>
				<div class="over-users">
					<input id="select_all" type="checkbox"> <label for='select_all'> Select All</label>
					<!-- text input -->
					<?php
							$lv = $arr->id_level;
							$resultz = $this->db->query("SELECT * FROM menuadmin where FIND_IN_SET('$lv', CONCAT(id_level, ',')) AND aktif='Y' order by urutan");
							foreach ($resultz->result_array() as $rowz){
								$dataT[$rowz['idparent']][] = $rowz;
							}
							 
							echo checkbox($dataT,0,$rowz['idparent'],$arr->idmenu);
						?>
				</div>
				
				<div class="form-group mb-1">
					<label>Level Akses</label>
					<select name='id_level' class="form-control  form-control-sm">
						<?php
							if($arr->level=="admin") {
								$tampil=$this->db->query("SELECT * FROM hak_akses");
								foreach($tampil->result_array() AS $we){
									if ($arr->id_level==$we['id_level']){
										echo "<option value=$we[id_level] selected>$we[nama]</option>";
										}else{
										echo "<option value=$we[id_level]>$we[nama]</option>"; 
									}
								}
								}else{
								$tampil = $this->db->query("select * FROM hak_akses where id_level IN ($arr->idlevel)");
								if ($arr->id_level==0){
									echo "<option value=0 selected>Pilih Level Akses</option>"; 
								}
								foreach($tampil->result_array() AS $w){
									if ($arr->id_level==$w['id_level']){
									echo "<option value=$w[id_level] selected>$w[nama]</option>";}
									else{
									echo "<option value=$w[id_level]>$w[nama]</option>";}}
							}
						?>
					</select>
				</div>
				<div class="form-group mb-1">	
					<label>Type Akses</label>
					<select id="cat" name="cat[]" class="form-control select2-multiple" multiple="multiple">
						<?php
							foreach($kategori as $rowz){
								$dataTz[$rowz->id_parent][] = $rowz;
							}
							echo select_kbox($dataTz,0,0,$arr->type_akses);
						?>
					</select>	
				</div>
				
				<div class="form-group mb-0"> 
					<div class="">
						<label>
							<?php if($arr->level=="admin") { ?>
								<input type="hidden" name="aktif" value="Y" checked>
								<?php }else{ ?>
								<?php if($arr->aktif=="Y") { ?>
									<input type="radio" name="aktif" id="optionsRadios1" value="N" class="minimal">
									aktif N
									<input type="radio" name="aktif" id="optionsRadios2" class="minimal" value="Y" checked>
									aktif Y
									<?php }else{ ?>
									<input type="radio" class="minimal" name="aktif" id="optionsRadios1" value="N" checked>
									aktif N
									<input type="radio" class="minimal" name="aktif" id="optionsRadios2" value="Y">
									aktif Y
									<?php 	}
								} ?>
						</label>
					</div>
				</div>
			</div>
		</div> 
	</div>
</form>
<style>
    .select2-container {
    width: 100% !important;
    padding: 0;
	}
</style>
<script>
	$('.over-users').slimScroll({
		height: '200px'
	});
	 
	$(document).ready(function(){
		$('.select2-multiple').select2();
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