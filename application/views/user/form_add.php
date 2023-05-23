<form id="formAdd">
	<input type="hidden" class="form-control" id="id" name="id">
	<input type="hidden" class="form-control" id="type" name="type" value="<?=$tipe;?>">
	
	<div class="row">
		<div class="col-md-6">
			<div class="card-block">
				<div class="form-group mb-1">
					<label for="mail">Email</label>
					<input type="email" name="mail" value="" class="form-control form-control-sm" id="mail" placeholder="Email" required="">
				</div>
				<div class="form-group mb-1">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Password Pengguna" value="" required="">
				</div>
				<div class="form-group mb-1">
					<label for="title">Nama Lengkap</label>
					<input type="text" name="title" value="" class="form-control form-control-sm" id="title" placeholder="Nama Lengkap" required="">
				</div>
				<div class="form-group mb-1">
					<label for="title">Jabatan</label>
					<input type="text" name="jabatan" class="form-control form-control-sm" id="jabatan" placeholder="jabatan" required="">
				</div>
				<div class="form-group mb-1">
					<label for="daftar">TGL. Daftar </label>
					<input type="date" name="daftar" class="form-control form-control-sm dpd1"  id="daftar">
				</div>
				<div class="form-group mb-1">
					<label for="phone">No. Handphone</label>
					<input type="text" name="phone" value="" class="form-control form-control-sm" id="phone" placeholder="No. Handphone">
				</div>
				<div class="form-group mb-1">
					<label for="alamat">Alamat</label>
					<input type="text" name="alamat" value="Serang" class="form-control form-control-sm" id="alamat" placeholder="Alamat">
				</div>
				
				
			</div>
		</div>
		<div class="col-md-6">
			<div class="card-block">
				<div class="form-group mb-1">
					<label for="profit">Menu Akses</label>
					
				</div>
				<div class="over-user">
					<input id="select_all" type="checkbox"> <label for='selectAll'> Select All</label>
					<!-- text input -->
					<?php
						$lv = $this->session->id_lv;
						$resultz = $this->db->query("SELECT * FROM menuadmin where FIND_IN_SET('$lv', CONCAT(id_level, ',')) AND aktif='Y' order by urutan");
						foreach ($resultz->result_array() as $rowz){
							$dataT[$rowz['idparent']][] = $rowz;
						}
						echo checkbox($dataT,0,0,0);
					?>
				</div>
				
				<div class="form-group mb-1">
					<label>Level Akses</label>
					<select name="id_level" class="form-control form-control-sm custom-select">
						<?php
							$tampil=$this->db->query("SELECT * FROM hak_akses");
							foreach($tampil->result_array() AS $we){
								echo "<option value=$we[id_level] selected>$we[nama]</option>"; 
							}
						?>
					</select>
					
				</div>
				<div class="form-group mb-1">	
					<label>Type Akses</label>
					<?php
						foreach($kategori as $rowz){
							$options[$rowz->id] = $rowz->title;
						}
						$data = array(
						'name'=>'cat[]', 
						'class'=>'form-control form-control-sm select2'
						);
						echo form_multiselect($data, $options, [], '');
					?>
					
				</div>
				<div class="form-group mb-0">
					<label>Aktif</label>
					<div class="">
						<label>
							<input type="radio" class="minimal" name="aktif" id="optionsRadios1" value="N" checked="">
							Tidak
							<input type="radio" class="minimal" name="aktif" id="optionsRadios2" value="Y">
							Ya
						</label>
					</div>
				</div>
			</div>
		</div> 
	</div>
</form>
<script>
	$(".select2").select2({
		placeholder: "--Pilih--",
		allowClear: true
	});
	
	$(document).ready(function(){
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