<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Jurnal Umum Detail</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Jurnal</li>
			<li class="breadcrumb-item active" aria-current="page">Jurnal Umum Detail</li>
        </ol>
    </div>
    
    <div class="row">
        <div class="col mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Akun</th>
                                <th scope="col">Ref</th>
                                <th scope="col">Debet</th>
                                <th scope="col">Kredit</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;
                                foreach($jurnals as $row):
                                if($row->jenis_saldo=='debit'):
                            ?>
                            <tr>
                                <td>
                                    <?= tgl_indo($row->tgl_transaksi) ?>
                                </td>
                                <td>
                                    <?= $row->nama_reff ?>
                                </td>
                                <td>
                                    <?= $row->no_reff ?>
                                </td>
                                <td>
                                    <?= 'Rp. '.number_format($row->saldo,0,',','.') ?>
                                </td>
                                <td>
                                    Rp. 0
                                </td>
                                <td class="d-flex justify-content-center">
                                    <?= form_open('jurnal/edit_form','',['id'=>$row->id_transaksi]) ?>
                                    <?= form_button(['type'=>'submit','content'=>'Edit','class'=>'btn btn-warning mr-3']) ?>
                                    <?= form_close() ?>
                                    
                                    <?= form_open('jurnal/hapus',['class'=>'form'],['id'=>$row->id_transaksi]) ?>
                                    <?= form_button(['type'=>'submit','content'=>'Hapus','class'=>'btn btn-danger hapus']) ?>
                                    <?= form_close() ?>
                                </td>       
                            </tr>
                            <?php 
                                endif;
                                if($row->jenis_saldo=='kredit'):
                            ?>
                            <tr>
                                <td><?= tgl_indo($row->tgl_transaksi) ?></td>
                                <td class="text-right"><?= $row->nama_reff ?></td>
                                <td><?= $row->no_reff ?></td>
                                <td>
                                    Rp. 0
                                </td>
                                <td>
                                    <?= 'Rp. '.number_format($row->saldo,0,',','.') ?>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <?= form_open('jurnal/edit_form','',['id'=>$row->id_transaksi]) ?>
                                    <?= form_button(['type'=>'submit','content'=>'Edit','class'=>'btn btn-warning mr-3']) ?>
                                    <?= form_close() ?>
                                    
                                    <?= form_open('jurnal/hapus',['class'=>'form'],['id'=>$row->id_transaksi]) ?>
                                    <?= form_button(['type'=>'submit','content'=>'Hapus','class'=>'btn btn-danger hapus']) ?>
                                    <?= form_close() ?>
                                </td>       
                            </tr>  
                            <?php endif;?>
                            <?php endforeach ?>
                            <?php if($totalDebit->saldo != $totalKredit->saldo){ ?>
                                <tr>
                                    <td colspan="3" class="text-center"><b>Jumlah Total</b></td>
                                    <td class="text-danger"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
                                    <td colspan="2" class="text-danger"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
                                </tr>
                                <tr  class="text-center bg-danger ">
                                    <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
                                </tr>
                                <?php }else{  ?>
                                <tr>
                                    <td colspan="3" class="text-center"><b>Jumlah Total</b></td>
                                    <td class="text-success"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
                                    <td colspan="2" class="text-success"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
                                </tr>
                                <tr class="text-center bg-success">
                                    <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>