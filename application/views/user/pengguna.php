<style>.card .table td, .card .table th {padding-right: 1rem;padding-left: 1rem;}</style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data pengguna</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Data pengguna</li>
		</ol>
	</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  d-flex flex-row align-items-center justify-content-between">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" for"limits">LIMIT</span>
						</div>
                        <select id="limits" name="limits" class="form-control custom-select w-1" onchange="searchPengguna()">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
						</select>
                        <div class="input-group-prepend">
                            <span class="input-group-text" for="sortBy">SORT</span>
						</div>
                        <select id="sortBy" class="form-control custom-select w-1" onchange="searchPengguna()">
                            <option value="ASC">ASC</option>
                            <option value="DESC" selected>DESC</option>
						</select>
                        <input type="text" id="keywords" class="form-control w-40" placeholder="Cari data" onkeyup="search_Bahan();"/>
                        <div class="input-group-append">
                            <button class="btn btn-danger clear" type="button"><i class="fa fa-times"></i></button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#OpenModalUser" data-id="0" data-mod="add"><i class="fa fa-plus"></i> Tambah</button>
						</div>
					</div>
				</div>
                <div class="card-body">
                    <div class="loading-overlay" style="display:none"><div class="overlay-content">Loading.....</div></div>
                    <div id="posts_content">
                        <?php if(!empty($record)){ ?>
                            <div class="posts_list">
                                <table class="table table-bordered table-striped table-mailcard">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="w-1 text-center">No</th>
                                            <th class="w-15 text-left">Nama</th>
                                            <th class="w-15 text-left">Email</th>
                                            <th class="w-15 text-left">Tgl. Reg</th>
                                            <th class="w-5 text-center">Aktif</th>
                                            <th class="w-12 text-center">Aksi</th>
										</tr>
									</thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach ($record as $row){
                                                if ($row['level'] == 'admin'){ 
                                                    $hapus = '<a data-id="'.$row['id_user'].'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash text-info"></i> Hapus</a>';
                                                    }else{ 
                                                    $hapus = '<a class="text-danger" data-id="'.$row['id_user'].'" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash"></i> Hapus</a>';
												}
                                                if ($row['aktif'] == 'Y'){ $aktif ='<i class="fa fa-check-circle"></i>'; }else{ $aktif = '<i class="fa fa-check-circle-o"></i>'; }
                                                $kode = encrypt_url($row['id_user']);
                                                echo "<tr><td>$no</td>
                                                <td><a href='javascript:void(0);' data-toggle='modal' data-target='#OpenModalUser' data-id='".encrypt_url($row['id_user'])."' data-mod='edit' class='text-info'>".$row['nama_lengkap']."</a></td>
                                                <td>$row[email]</td>
                                                <td>$row[tgl_daftar]</td>
                                                <td class='text-center'>$aktif</td>
                                                <td><center>
                                                <a href='javascript:void(0);' data-toggle='modal' data-target='#OpenModalUser' data-id='".encrypt_url($row['id_user'])."' data-mod='edit' class='openPopup text-info'><i class='fa fa-edit'></i> Edit</a> | $hapus
                                                </center></td>
                                                </tr>";
                                                $no++;
											}
										?>
									</tbody>
								</table> 
							</div>
                            <?php echo $this->ajax_pagination->create_links(); ?>
                            <?php }else{ ?>
                            <table class='table table-bordered'>
                                <tr>
                                    <td>Belum ada data</td>
								</tr>
							</table>
						<?php } ?>
					</div>
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div>
	</div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="confirm-delete" role="dialog" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
				<button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
			</div>
			<div class="modal-body">
				<p>Anda akan menghapus satu url, prosedur ini tidak dapat diubah.</p>
				<p>Apakah Anda ingin melanjutkan?</p>
				<p class="debug-url"></p>
				<input type="hidden" id="data-hapus">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger hapus_user" type="button">YA</button> 
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="OpenModalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelPengguna">Tambah Pengguna</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body pb-0 mt-0 pt-1">
                <div class="load-pengguna"></div>
			</div>
			<div class="modal-footer">
				<button type="button" onClick="simpanMember()" id="btn-bahan" class="btn btn-success">Submit</button>
				<button type="button" class="btn bg-red" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<style>
    .select2-container {
    width: 100% !important;
    padding: 0;
    }
</style>

<script>
     
    function searchPengguna(page_num){
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: base_url+'user/ajaxPengguna/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
            beforeSend: function(){
                $('body').loading();
			},
            success: function(html){
                $('#posts_content').html(html);
                $('body').loading('stop');
			}
		});
	}
	
	$('#OpenModalUser').on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).data('id');
		var mod = $(e.relatedTarget).data('mod');
		
		if(id != 0){
			var urldata = "edit_user";
			var tipe = 'edit';
            $("#myModalLabelPengguna").html("Edit Pengguna")
			}else{
			var urldata = "add_user";
			var tipe = 'new';
		}
		$.ajax({
			type: 'POST',
			url: base_url + "user/"+urldata,
			data: {tipe:tipe,id:id,mod:mod},
			dataType: "html",
			beforeSend: function () {
				$('body').loading();
			},
			success: function(data) {
				$('.load-pengguna').html(data);
				$('body').loading('stop');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				sweet('Peringatan!!!',thrownError,'warning','warning');
			}
		});
	});
	
    
    function simpanMember()
    {
        // console.log('submit');
        if($("#mail").val()==''){
            $("#mail").addClass('form-control-warning');
            showNotif('top-center','Input Data','Harus diisi','warning');
            $("#mail").focus();
            return;
		}
        if($("#title").val()==''){
            $("#title").addClass('form-control-warning');
            showNotif('top-center','Input Data','Harus diisi','warning');
            $("#title").focus();
            return;
		}
		if($("#jabatan").val()==''){
            $("#jabatan").addClass('form-control-warning');
            showNotif('top-center','Input Data','Harus diisi','warning');
            $("#jabatan").focus();
            return;
		}
        if($("#daftar").val()==''){
            $("#daftar").addClass('form-control-warning');
            showNotif('top-center','Input Data','Harus diisi','warning');
            $("#daftar").focus();
            return;
		}
        if($("#phone").val()==''){
            $("#phone").addClass('form-control-warning');
            showNotif('top-center','Input Data','Harus diisi','warning');
            $("#phone").focus();
            return;
		}
        if($("#alamat").val()==''){
            $("#alamat").addClass('form-control-warning');
            showNotif('top-center','Input Data','Harus diisi','warning');
            $("#alamat").focus();
            return;
		}
        
        var formData = $("#formAdd").serialize();
        $.ajax({
            type: "POST",
            url: base_url+"user/simpan_pengguna",
            dataType: 'json',
            data: formData,
            beforeSend: function () {
                $('body').loading();　
			},
            success: function(data) {
                $('body').loading('stop');
                if(data.status==200){
                    showNotif('bottom-right',data.title,data.msg,'success');
                    }else{
                    showNotif('bottom-right',data.title,data.msg,'error');
				}
                $("#OpenModalUser").modal('hide');
                searchPengguna();
                } ,error: function(xhr, status, error) {
                showNotif('bottom-right','Peringatan',error,'error');
                $('body').loading('stop');
			}
		});
	}
    $(document).on('click','.hapus_user',function(e){
		var id = $("#data-hapus").val();
		$.ajax({
			url: base_url + 'user/hapus_user',
			data: {id:id},
			method: 'POST',
			dataType:'json',
			beforeSend: function () {
                $('body').loading();　
			},
			success: function(data) {
				if(data.status==200){
					showNotif('bottom-right',data.title,data.msg,'success');
					}else{
					sweet('Peringatan!!!',data.msg,'warning','warning');
				}
				searchPengguna();
				$('#confirm-delete').modal('hide');
				$('body').loading('stop');　
				},error: function(xhr, status, error) {
                showNotif('bottom-right','Update',error,'error');
				$('body').loading('stop');　
			}
		});
	});
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$('#data-hapus').val($(e.relatedTarget).data('id'));
	});
</script>        