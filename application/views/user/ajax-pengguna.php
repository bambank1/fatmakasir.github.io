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
<script>
    $(document).ready(function(){
        $('.openPopup').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.modal-body1').load(dataURL,function(){
                $('#myModalEdit').modal({show:true});
            });
        }); 
    });    
</script>