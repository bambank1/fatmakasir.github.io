<div class="container-fluid" id="container-wrapper">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Detail Neraca Saldo</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="./">Home</a></li>
			<li class="breadcrumb-item">Laporan</li>
			<li class="breadcrumb-item active" aria-current="page">Detail Neraca Saldo</li>
        </ol>
    </div>
    <div class="row mt-5">
        <div class="col mb-5 mb-xl-0">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="card-block">
                        <div class="table-responsive">
                            <?php 
                                $a=0;
                                $debit = 0;
                                $kredit = 0;
                            ?>
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="w-15">No. Akun</th>
                                        <th>Nama Akun</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totalDebit=0;
                                        $totalKredit=0;
                                        for($i=0;$i<$jumlah;$i++) :                          
                                        $a++;
                                        $s=0;
                                        $deb = $saldo[$i];
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $data[$i][$s]->no_reff ?>
                                        </td>
                                        <td>
                                            <?= $data[$i][$s]->nama_reff ?>
                                        </td>
                                        <?php 
                                            for($j=0;$j<count($data[$i]);$j++):
                                            if($deb[$j]->jenis_saldo=="debit"){
                                                $debit = $debit + $deb[$j]->saldo;
                                                }else{
                                                $kredit = $kredit + $deb[$j]->saldo;
                                            }
                                            $hasil = $debit-$kredit;
                                            
                                            endfor 
                                        ?>
                                        <?php 
                                            if($hasil>=0){ ?>
                                            <td><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                                            <td> 0 </td>
                                            <?php $totalDebit += $hasil; ?>
                                            <?php }else{ ?>
                                            <td> 0 </td>
                                            <td><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                                            <?php $totalKredit += $hasil; ?>
                                        <?php } ?>
                                        <?php
                                            $debit = 0;
                                            $kredit = 0;
                                        ?>
                                    </tr>
                                    <?php endfor ?>
                                    <?php if($totalDebit != abs($totalKredit)){ ?>
                                        <tr>
                                            <td class="text-left"></td>
                                            <td class="text-left"><b>Total</b></td>
                                            <td class="text-danger"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                                            <td class="text-danger"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
                                        </tr>
                                        <tr class="bg-danger text-center">
                                            <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
                                        </tr>
                                        <?php }else{ ?>
                                        <tr>
                                            <td class="text-left"></td>
                                            <td class="text-left"><b>Total</b></td>
                                            <td class="text-success"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                                            <td class="text-success"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
                                        </tr>
                                        <tr class="bg-success text-center">
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
    </div>
</div>