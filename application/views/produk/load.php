<?php
	if(!empty($load)){
		$no=1;
		foreach($load as $val){
			echo '<label>Rp. '.rp($val['jml_bayar']).'&nbsp;</label>&nbsp;';
		$no++; }		
		}else{
		echo "kosong";
	}	