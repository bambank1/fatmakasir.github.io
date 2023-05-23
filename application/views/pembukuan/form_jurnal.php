<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Form Jurnal</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Jurnal</li>
			<li class="breadcrumb-item active" aria-current="page">Form Jurnal</li>
        </ol>
    </div>
    
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-3">Jurnal <?=$button;?></h3>
                        </div>
                        <div class="col-12 my-3 form-1">
                            <form action="<?= base_url($action) ?>" method="post">
                                <?php 
                                    if(!empty($id)):
                                ?>
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <?php endif; ?>
                                <div class="row mb-4">
                                    <div class="col-4">
                                        <label for="datepicker">Tanggal</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input class="form-control" id="datepicker" name="tgl_transaksi" type="text" value="<?= $data->tgl_transaksi ?>">
                                        </div>
                                        <?= form_error('tgl_transaksi') ?>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="no_reff">Nama Akun</label>
                                        <?=form_dropdown('no_reff',getDropdownList('akun',['no_reff','nama_reff']),$data->no_reff,['class'=>'form-control','id'=>'no_reff']);?>
                                        <?= form_error('no_reff') ?>
                                    </div>
                                    <div class="col">
                                        <label for="reff">No. Reff</label>
                                        <input type="text" name="reff" class="form-control" id="reff" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="jenis_saldo">Jenis Saldo</label>
                                        <?=form_dropdown('jenis_saldo',['debit'=>'Debit','kredit'=>'Kredit'],$data->jenis_saldo,['class'=>'form-control jenis_saldo','id'=>'jenis_saldo']);?>
                                        <?= form_error('jenis_saldo') ?>
                                    </div>
                                    <div class="col">
                                        <label for="saldo">Saldo</label>
                                        <input type="text" name="saldo" class="form-control saldo" id="saldo" value="<?= $data->saldo ?>">
                                        <?= form_error('saldo') ?>
                                    </div>
                                </div>
                                <div class="col-12" id="form_jurnal_prepend">
                                    <button class="btn btn-primary" type="submit" id="button_jurnal"><?= $button ?></button>
                                </div> 
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#no_reff').change(function () {
        let nilai = $(this).val();
        $('#reff').val(nilai);
    });
    
    $(window).on('load', function () {
        let nilai = $('#no_reff').val();
        $('#reff').val(nilai);
    });
    $('#datepicker').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true,
	});
</script>            