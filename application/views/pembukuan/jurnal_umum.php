<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Jurnal Umum</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Jurnal</li>
			<li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li>
        </ol>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col my-3">
                            <a href="<?= base_url('jurnal/tambah') ?>" class="btn btn-primary mt-2">Tambah Jurnal</a>
                        </div>
                        <div class="col my-3">
                            <form action="<?= base_url('jurnal/detail') ?>" method="post" class="d-flex flex-row justify-content-end">
                                <div class="form-group">
                                    <select name="bulan" id="bulan" class="form-control custom-select">
                                        <?php
                                            for($i=1;$i<=12;$i++){
                                                $selected = '';
                                                if(month()==($i)){
                                                    $selected = 'selected';
                                                }
                                                echo "<option value='$i' $selected>".getBulan($i)."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mx-3">
                                    <select name="tahun" id="tahun" class="form-control custom-select">
                                        <?php 
                                            foreach($tahun as $row){
                                                $tahuns = date('Y',strtotime($row->tgl_transaksi));
                                                echo "<option value=$tahuns>".$tahuns."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
					<div class="card-block">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="jurnal-umum">
                            <thead class="thead-light">
                                <tr>
                                    <th class="w-5">No.</th>
                                    <th scope="col">Bulan Dan Tahun</th>
                                    <th class="text-right ">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=0;
                                    foreach($listJurnal as $row):
                                    $i++;
                                    $bulan = date('m',strtotime($row->tgl_transaksi));
                                    $tahun = date('Y',strtotime($row->tgl_transaksi));
                                ?>
                                <tr>
                                    <td scope="col"><?=$i?></td>
                                    <td scope="col"><?= bulan_indo($bulan).' '.$tahun ?></td>
                                    <td class="text-right ">
                                        <?= form_open('jurnal/detail','',['bulan'=>$bulan,'tahun'=>$tahun]) ?>
                                        <?= form_button(['type'=>'submit','content'=>'Lihat Jurnal','class'=>'btn btn-success']) ?>
                                        <?= form_close() ?>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready( function () {
		$('#jurnal-umum').DataTable();
    } );
</script>