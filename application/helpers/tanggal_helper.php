<?php 
    function koreksi_tgl($date){
        $date = str_replace('-', '/', $date);
        $date = date('d/m/Y H:i', strtotime($date));
        return $date; 
	}
    
    function copyYear($copyYear='')
    {
        if($copyYear==''){
            $copyYear = 2015; 
		}
        $curYear = date('Y'); 
        return 'copyright &#169;&#160;' . $copyYear . (($copyYear != $curYear) ? ' - ' . $curYear : ''); 
	}
    
    function today()
    {
        return date('Y-m-d H:i:s'); //2020-12-01
	}
    function day_ymd()
    {
        return date('Y-m-d'); //2020-12-01
	}
    function month()
    {
        return date('m'); //2020-12-01
	}
    function year()
    {
        return date('Y'); //2020-12-01
	}
    
    function get_day($day){
        $day = date('Y-m-d', strtotime($day));
        return $day;
	}
    
    function getMonth($month){
        $month = date("m",strtotime($month));
        return $month;
	}
    
    function getYear($month){
        $month = date("Y",strtotime($month));
        return $month;
	}
    
    function periode($date){
        $date = date('m-Y', strtotime($date));
        list( $bulan, $tahun ) = explode( '-', $date );
        return ['bulan'=>$bulan,'tahun'=>$tahun];
	}    
    function date_my($date){
        list( $bulan, $tahun ) = explode( '/', $date );
        return ['bulan'=>$bulan,'tahun'=>$tahun];
	}
    function tgl_awal_dash(){
        $tgl = date('Y-m-d',strtotime(date('Y-m-').'01'));
        return $tgl;       
	} 
    
    function tgl_dari_slash(){
        $tgl = date('d/m/Y',strtotime(date('Y-m-').'01'));
        return $tgl;       
	} 
    
    function tgl_sampai_slash(){
        $tgl = date('d/m/Y',strtotime(date('Y-m-d')));
        return $tgl; //01/12/2020
	} 
    
    function jam_replace($jam){
        $jam = str_replace("-",":",$jam);
        return $jam;       
	} 
    
    function tgl_indo($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.' '.$bulan.' '.$tahun; // 01 12 2020
	} 
    
	function tgl_ambil_1($tglp){
        $tgl_post = date('Y-m-d',strtotime($tglp));
        return $tgl_post;		 
	}
	function tgl_ambil($tglp){
        $tgl_post = date('d/m/Y',strtotime($tglp));
        return $tgl_post;		 
	}
    function tgl_view($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = substr($tgl,5,2);
        $tahun = substr($tgl,0,4);
        return $tanggal.'-'.$bulan.'-'.$tahun;       
	}
    
    function tgl_grafik($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.'_'.$bulan;       
	}   
    
    
    function date_slash($date){
        list($tanggal,$bulan,$tahun) = explode( '/', $date);
        return $tahun.'-'.$bulan.'-'.$tanggal;
	}
    
    function tgl_koreksi($date){
        $date = str_replace('/', '-', $date);
        $date = date('Y-m-d H:i', strtotime($date));
        return $date; 
	}
    
    function date_replace_slash($var){
        $date = str_replace('/', '-', $var);
        $date = date('Y-m-d', strtotime($date));
        return $date; //d/m/y to Y-m-d
	}
    
    function date_dmy($date){
        $date = DateTime::createFromFormat('m/d/Y', $date);
        $date = $date->format('Y-m-d');
        return $date;
	}
    function hari_ini($w){
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $hari_ini = $seminggu[$w];
        return $hari_ini;
	}
    function xhari($tgl){
        $tanggal 	= strtotime($tgl);
		$hari_arr 	= Array ('0'=>'Minggu',
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>'Jum`at',
        '6'=>'Sabtu'
        );
		$hari 	= @$hari_arr[date('w',$tanggal)];
        return $hari;	
	}
    function times($tgl,$Jam=true,$Wib=true){
        $tanggal 	= strtotime($tgl);
		$jam 	= $Jam ? date ('H:i',$tanggal) : '';
		$wib	= $Wib ? 'WIB' :'';
		return "$jam $wib";	
        
	}
    
    function jam_koreksi($tgl,$Jam=true){
        $tanggal 	= strtotime($tgl);
		$jam 	= $Jam ? date ('H:i',$tanggal) : '';
		return $jam;	
        
	}
    function dtimes($tgl,$Jam=true,$Wib=true){
        $tanggal 	= strtotime($tgl);
        $hari_arr 	= Array (	'0'=>'Minggu',
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>'Jum`at',
        '6'=>'Sabtu'
        );
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= date('m',$tanggal);
		$thn 	= date('Y',$tanggal);
		$jam 	= $Jam ? date ('H:i',$tanggal) : '';
		$wib	= $Wib ? 'WIB' :'';
		return "$hari, $tggl/$bln/$thn $jam $wib";	
        
	}
    function date_time($tgl,$Jam=true){
        $tanggal 	= strtotime($tgl);
        $hari_arr 	= Array (	'0'=>'Minggu',
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>'Jum`at',
        '6'=>'Sabtu'
        );
        
		$tggl 	= date('j',$tanggal);
		$bln 	= date('m',$tanggal);
		$thn 	= date('Y',$tanggal);
        $jam 	= $Jam ? date ('H:i',$tanggal) : '';
		return "$tggl/$bln/$thn $jam";	
        
	}
    function dtime($tgl){
        $tanggal 	= strtotime($tgl);
        $hari_arr 	= Array (	'0'=>'Minggu',
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>'Jum`at',
        '6'=>'Sabtu'
        );
		$hari 	= @$hari_arr[date('w',$tanggal)];
		$tggl 	= date('j',$tanggal);
		$bln 	= date('m',$tanggal);
		$thn 	= date('Y',$tanggal);
		return "$hari, $tggl/$bln/$thn";	
        
	}
	function jam_ambil($jam){
        $jam_post = date('H:i',strtotime($jam));
        return $jam_post;		 
	}
	
    function getBulan($bln){
        switch ($bln){
            case 1: 
            return "Januari";
            break;
            case 2:
            return "Februari";
            break;
            case 3:
            return "Maret";
            break;
            case 4:
            return "April";
            break;
            case 5:
            return "Mei";
            break;
            case 6:
            return "Juni";
            break;
            case 7:
            return "Juli";
            break;
            case 8:
            return "Agustus";
            break;
            case 9:
            return "September";
            break;
            case 10:
            return "Oktober";
            break;
            case 11:
            return "November";
            break;
            case 12:
            return "Desember";
            break;
		}
	} 
    function loopBulan(){
        $bulan=array(1=>"Januari",
        2=>"Februari",
        3=>"Maret",
        4=>"April",
        5=>"Mei",
        6=>"Juni",
        7=>"Juli",
        8=>"Agustus",
        9=>"September",
        10=>"Oktober",
        11=>"November",
        12=>"Desember");
        return $bulan;
	}
    
    if ( ! function_exists('bulan'))
    {
        function bulan($bln)
        {
            switch ($bln)
            {
                case 'Januari':
                return "01";
                break;
                case 'Februari':
                return "02";
                break;
                case "Maret":
                return "03";
                break;
                case "April":
                return "04";
                break;
                case "Mei":
                return "05";
                break;
                case 'Juni':
                return "06";
                break;
                case 'Juli':
                return "07";
                break;
                case 'Agustus':
                return "08";
                break;
                case 'September':
                return "09";
                break;
                case 'Oktober':
                return "10";
                break;
                case 'November':
                return "11";
                break;
                case 'Desember':
                return "12";
                break;
			}
		}
	}
    
    if ( ! function_exists('short_bulan'))
    {
        function short_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                return "01";
                break;
                case 2:
                return "02";
                break;
                case 3:
                return "03";
                break;
                case 4:
                return "04";
                break;
                case 5:
                return "05";
                break;
                case 6:
                return "06";
                break;
                case 7:
                return "07";
                break;
                case 8:
                return "08";
                break;
                case 9:
                return "09";
                break;
                case 10:
                return "10";
                break;
                case 11:
                return "11";
                break;
                case 12:
                return "12";
                break;
			}
		}
	}
    function getBlnAgenda($bln){
        switch ($bln){
            case 1: 
            return "Jan";
            break;
            case 2:
            return "Feb";
            break;
            case 3:
            return "Mar";
            break;
            case 4:
            return "Apr";
            break;
            case 5:
            return "Mei";
            break;
            case 6:
            return "Jun";
            break;
            case 7:
            return "Jul";
            break;
            case 8:
            return "Agu";
            break;
            case 9:
            return "Sep";
            break;
            case 10:
            return "Okt";
            break;
            case 11:
            return "Nov";
            break;
            case 12:
            return "Des";
            break;
		}
	} 
    if ( ! function_exists('bulan_indo'))
    {
        function bulan_indo($bln)
        {
            switch ($bln)
            {
                case 1:
                return "Januari";
                break;
                case 2:
                return "Februari";
                break;
                case 3:
                return "Maret";
                break;
                case 4:
                return "April";
                break;
                case 5:
                return "Mei";
                break;
                case 6:
                return "Juni";
                break;
                case 7:
                return "Juli";
                break;
                case 8:
                return "Agustus";
                break;
                case 9:
                return "September";
                break;
                case 10:
                return "Oktober";
                break;
                case 11:
                return "November";
                break;
                case 12:
                return "Desember";
                break;
			}
		}
	}
    
    function date_piutang($date){
        list($bulan,$tahun) = explode( ' ', $date);
         return ['bulan'=>$bulan,'tahun'=>$tahun];
	}
    
    function getBlnPiutang($bln){
        switch ($bln){
            case "Jan": 
            return 1;
            break;
            case "Feb":
            return 2;
            break;
            case "Mar":
            return 3;
            break;
            case "Apr":
            return 4;
            break;
            case "May":
            return 5;
            break;
            case "Jun":
            return 6;
            break;
            case "Jul":
            return 7;
            break;
            case "Aug":
            return 8;
            break;
            case "Sep":
            return 9;
            break;
            case "Oct":
            return 10;
            break;
            case "Nov":
            return 11;
            break;
            case "Dec":
            return 12;
            break;
		}
	} 
    
    function cek_terakhir($datetime, $full = false) {
        $today = time();    
        $createdday= strtotime($datetime); 
        $datediff = abs($today - $createdday);  
        $difftext="";  
        $years = floor($datediff / (365*60*60*24));  
        $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
        $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
        $hours= floor($datediff/3600);  
        $minutes= floor($datediff/60);  
        $seconds= floor($datediff);  
        //year checker  
        if($difftext=="")  
        {  
            if($years>1)  
            $difftext=$years." Tahun";  
            elseif($years==1)  
            $difftext=$years." Tahun";  
		}  
        //month checker  
        if($difftext=="")  
        {  
            if($months>1)  
            $difftext=$months." Bulan";  
            elseif($months==1)  
            $difftext=$months." Bulan";  
		}  
        //month checker  
        if($difftext=="")  
        {  
            if($days>1)  
            $difftext=$days." Hari";  
            elseif($days==1)  
            $difftext=$days." Hari";  
		}  
        //hour checker  
        if($difftext=="")  
        {  
            if($hours>1)  
            $difftext=$hours." Jam";  
            elseif($hours==1)  
            $difftext=$hours." Jam";  
		}  
        //minutes checker  
        if($difftext=="")  
        {  
            if($minutes>1)  
            $difftext=$minutes." Menit";  
            elseif($minutes==1)  
            $difftext=$minutes." Menit";  
		}  
        //seconds checker  
        if($difftext=="")  
        {  
            if($seconds>1)  
            $difftext=$seconds." Detik";  
            elseif($seconds==1)  
            $difftext=$seconds." Detik";  
		}  
        return $difftext;  
	}                    
    
    function bulan_tahun($tanggal){
        
        $bulan = array (
		1 =>   	'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
		);
        
		$var = explode('-', $tanggal);
        
		return $bulan[ (int)$var[1] ] . ' ' . $var[0];
        
	}
    function tgl_indonesia($tanggal){
        
        $bulan = array (
		1 =>   	'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
		);
        
		$var = explode('-', $tanggal);
        
		return $var[2] .' '. $bulan[ (int)$var[1] ] . ' ' . $var[0];
        
	}
	
	function ucapan()
	{
		$waktu=gmdate("H:i",time()+7*3600);
		$t=explode(":",$waktu);
		$jam=$t[0];
		$menit=$t[1];
		
		if ($jam >= 00 and $jam < 10 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Pagi";
			}
			}else if ($jam >= 10 and $jam < 15 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Siang";
			}
			}else if ($jam >= 15 and $jam < 18 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Sore";
			}
			}else if ($jam >= 18 and $jam <= 24 ){
			if ($menit >00 and $menit<60){
				$ucapan="Selamat Malam";
			}
			}else {
			$ucapan="Error";
			
		}
		
		return $ucapan;
	}
