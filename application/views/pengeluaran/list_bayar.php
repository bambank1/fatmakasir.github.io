<?php
    if($bayar->num_rows() >0){
    ?>
    <div class="table-responsive-sm">
        <table class="table  table-striped table-mailcard tbayar">
            <thead class="thead-dark p-0">
                <tr>
                    <th scope="col" class="w-2">#</th>
                    <th scope="col" class="w-20">Tanggal</th>
                    <th class="text-right w-20" scope="col">Sub Total</th>
                    <th scope="col" class="text-center w-8">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $total=0;
                    $no=1;
                    // echo $total_bayar->total_bayar;
                    foreach($bayar->result_array() AS $val){
                        $total += $val['jml_bayar'];
                        if ($this->session->level=='admin' OR $this->session->level=='owner'){
                            $hapus = '<button type="button" data-jml="'.$val['jml_bayar'].'" data-kunci="1"  data-idin="'.$val['id_pengeluaran'].'" data-bayar="'.$val['id_bayar'].'" data-id="'.$val['id'].'"  class="btn btn-danger btn-xs hapusbayar"><i class="fa fa-trash"></i></button>';
                            }else{
                            $hapus = '<button type="button" data-jml="'.$val['jml_bayar'].'" data-kunci="0"  data-bayar="'.$val['id_bayar'].'" data-idin="'.$val['id_pengeluaran'].'" data-id="'.$val['id'].'"  class="btn btn-danger btn-xs hapusbayar"><i class="fa fa-trash"></i></button>';
                        }
                    ?>
                    <tr>
                        <th scope="row"><?=$no;?>.</th>
                        <td><?=tgl_indo($val['tgl_bayar']);?></td>
                        <td class="text-right"><?=rp($val['jml_bayar']);?></td>
                        <td class="text-center"><?=$hapus;?></td>
                    </tr>
                    <?php 
                    $no++; }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td class="text-right" scope="col"><?=rp($total);?></td>
                    <td scope="col" class="w-6">&nbsp;</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <input type="hidden" value="<?=$no;?>" id="no_bayar" name="no_bayar" >
    <input type="hidden" value="<?=$total;?>" id="total_sudah_bayar" name="total_sudah_bayar" >
    <?php 
        }else{
        echo '<input type="hidden" value="1" id="no_bayar" name="no_bayar" >';
        echo '<input type="hidden" value="0" id="total_sudah_bayar" name="total_sudah_bayar" >';
    }
?>
<style>
.btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
</style>