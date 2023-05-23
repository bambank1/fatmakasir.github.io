<?php
    
    if(!empty($result)){
        $no =0;
        foreach($result AS $val){
            $tanggal = dtimes($val->create_date,false,false);
            $time = times($val->create_date,true,true);
            
            $dari = getNameKas($val->no_reff);
            $ke = getNameKas($val->no_reff);
            
            if($val->pengeluaran > 0){
                $pengeluaran = $val->pengeluaran;
                $getNameBank ='';
                if($val->id_sub_bayar > 0){
                    $getNameBank = bank($val->id_sub_bayar);
                }
                
            ?>
            <div class="vertical-timeline-item vertical-timeline-element">
                <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-warning"> </i> </span>
                    <div class="vertical-timeline-element-content bounce-in">
                        <h4 class="timeline-title">PENGELUARAN dari <?=$dari;?> <?=$getNameBank;?></h4>
                        <p>Sebesar Rp.  <span class="text-danger"><?=rp($pengeluaran);?></span></p> <b class="text-danger"><?=$tanggal;?></b>
                        <span class="vertical-timeline-element-date"><?=$time;?></span>
                    </div>
                </div>
            </div>
            <?php } 
            if($val->pemasukan > 0){
                $pemasukan = $val->pemasukan;
                $getNameBank ='';
                if($val->id_sub_bayar > 0){
                    $getNameBank = bank($val->id_sub_bayar);
                }
            ?>
            <div class="vertical-timeline-item vertical-timeline-element">
                <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-success"> </i> </span>
                    <div class="vertical-timeline-element-content bounce-in">
                        <h4 class="timeline-title">PEMASUKAN ke <?=$ke;?> <?=$getNameBank;?></h4>
                        <p>Sebesar Rp. <span class="text-success"><?=rp($pemasukan);?></span></p> 
                        <b class="text-success"><?=$tanggal;?></b>
                        <span class="vertical-timeline-element-date"><?=$time;?></span>
                    </div>
                </div>
            </div>
            
        <?php } $no++; } ?>
        <nav aria-label="Page navigation" class="mt-2 pull-right">
            <?php 
                echo $this->ajax_pagination->create_links(); 
            ?>
        </nav>
<?php }else{ echo "NONE";}  ?>
