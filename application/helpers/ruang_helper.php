<?php 
	
	function meta_tag($par = [])
	{
		return '<title>' . $par['title'] . '</title>
		<meta name="robots" content="follow, index"/>
		<meta name="keywords" content="' . $par['keywords'] . '" />
		<link rel="shortcut icon" href="' . $par['favicon'] . '">
		<meta content="' . $par['description'] . '" name="description" />
		<meta content="' . $par['author'] . '" name="author" />
		<link rel="canonical" href="' . $par['url'] . '" />
		<meta property="og:locale" content="en_US" />
		<meta property="bb:client_area" content="' . $par['url'] . '">
		<meta property="og:url" content="' . $par['url'] . '" />
		<meta property="og:title" content="' . $par['title'] . '" />
		<meta property="og:image" content="' . $par['thumb'] . '" />
		<meta property="og:site_name" content="' . $par['title'] . '" />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="' . $par['description'] . '" />
		<meta name="twitter:description" content="' . $par['description'] . '" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@' . $par['title'] . '" />
		<meta name="twitter:title" content="' . $par['title'] . '" />
		<meta name="twitter:image" content="' . $par['thumb'] . '" />';
	}
	function dump($arr, $type="print_r",$exit='exit'){
		echo "<textarea style='width:100%; height:300px;'>";
		if($type == "print_r")
		print_r($arr);
		else
		var_dump($arr);
		echo "</textarea>";
		if($exit == "exit")
		exit;
	}
	function getDropdownList($table,$column){
		$CI =& get_instance();
		
		$query = $CI->db->select($column)->from($table)->get();
		
		if($query->num_rows() >= 1){
			$option1 = ['' => '- Pilih -'];
			$option2 = array_column($query->result_array(),
			$column[1],$column[0]);
			$options = $option1 + $option2;
			return $options;
		}
		return $options = [''=>'- Pilih -'];
	}
    function rp_to_int($teks){
		$str = str_replace('.', '', $teks);
		return $str;
	}
	function pembulatan($uang)
	{
		$ratusan = substr($uang, -3);
		if($ratusan<500)
		$akhir = $uang - $ratusan;
		else
		$akhir = $uang + (1000-$ratusan);
		return $akhir;
	}
    function random($panjang_karakter)  
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';  
        $string = '';  
        for($i = 0; $i < $panjang_karakter; $i++) {  
            $pos = rand(0, strlen($karakter)-1);  
            $string .= $karakter[$pos];
		}  
        return $string;  
	} 
    function rprp($angka){
		$hasil = "Rp. " . number_format($angka,0,',','.');
		return $hasil;
	}
    function curl_get_file_contents($url){
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $contents = curl_exec($ch); 
        curl_close($ch);      
        if ($contents) return $contents;
        else return FALSE;
	}
    
    function cek_nput_post($method='')
    {
        $ci = & get_instance();
        if ($ci->input->server('REQUEST_METHOD') === $method) {
            $data = ['status'=>400,'msg'=>'Bad Request'];
            $ci->output
            ->set_status_header(400)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
            exit;
		}
	}
    function change_case($str='')
    {
        $str = strtolower($str);
        $str = ucwords($str);
        return $str;
	}
    
    function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
        // Mengatur lebar setiap kolom (dalam satuan karakter)
        $lebar_kolom_1 = 20;
        $lebar_kolom_2 = 6;
        $lebar_kolom_3 = 8;
        $lebar_kolom_4 = 10;
        
        // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
        $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
        $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
        $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
        $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
        
        // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
        $kolom1Array = explode("\n", $kolom1);
        $kolom2Array = explode("\n", $kolom2);
        $kolom3Array = explode("\n", $kolom3);
        $kolom4Array = explode("\n", $kolom4);
        
        // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
        $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
        
        // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
        $hasilBaris = array();
        
        // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
        for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
            
            // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
            $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
            $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");
            
            // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
            $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
            $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
            
            // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
            $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
		}
        
        // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
        return implode($hasilBaris, "\n") . "\n";
	}   
    function buatBaris4Kolom58($kolom1, $kolom2, $kolom3, $kolom4) {
        // Mengatur lebar setiap kolom (dalam satuan karakter)
		$lebar_kolom_1 = 12;
		$lebar_kolom_2 = 8;
		$lebar_kolom_3 = 8;
		$lebar_kolom_4 = 9;
        
        // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
        $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
        $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
        $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
        $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);
        
        // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
        $kolom1Array = explode("\n", $kolom1);
        $kolom2Array = explode("\n", $kolom2);
        $kolom3Array = explode("\n", $kolom3);
        $kolom4Array = explode("\n", $kolom4);
        
        // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
        $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
        
        // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
        $hasilBaris = array();
        
        // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
        for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {
            
            // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
            $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
            $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");
            
            // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
            $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
            $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);
            
            // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
            $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
		}
        
        // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
        return implode("\n",$hasilBaris) . "\n";
	}
    function hp_1($handphone) {
        $jumlah_digit_handphone = strlen(substr($handphone, 3));
        // nomor handphone yang ditampilkan jika berjumlah 9 digit
        if ($jumlah_digit_handphone == 9) {
            $tampil_handphone = "+62 " . substr($handphone, 3, 3) . "-" . substr($handphone, 6, 3) . "-" . substr($handphone, 9, 3);
		}
        // nomor handphone yang ditampilkan jika berjumlah 10 digit
        if ($jumlah_digit_handphone == 10) {
            $tampil_handphone = "+62 " . substr($handphone, 3, 3) . "-" . substr($handphone, 6, 4) . "-" . substr($handphone, 10, 3);
		}
        // nomor handphone yang ditampilkan jika berjumlah 11 digit
        if ($jumlah_digit_handphone == 11) {
            $tampil_handphone = "+62 " . substr($handphone, 3, 3) . "-" . substr($handphone, 6, 4) . "-" . substr($handphone, 10, 4);
		}
        // nomor handphone yang ditampilkan jika berjumlah 12 digit
        if ($jumlah_digit_handphone == 12) {
            $tampil_handphone = "+62 " . substr($handphone, 3, 3) . "-" . substr($handphone, 6, 4) . "-" . substr($handphone, 10, 5);
		}
        return $tampil_handphone;
	}
    function hp_2($nohp) {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);
        $nohp = str_replace("-","",$nohp);
        
        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 3)=='+62'){
                $nohp = trim($nohp);
			}
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $nohp = '+62'.substr(trim($nohp), 1);
			}
		}
        return $nohp;
	}
	
    function cek_no($nohp) {
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);
        // kadang ada penulisan no hp 0811-239-345
        $nohp = str_replace("-","",$nohp);
        $nohp = str_replace("+","",$nohp);
        $nohp = clean($nohp);
        $nohp = hp_3($nohp);
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp / no telp
            if(substr(trim($nohp), 0, 1)!='0'){
                $data = ['akses'=>0,'status'=>400,'msg'=>'A No. Hp harus berawalan 08/628/+628'];
			}
            elseif(substr(trim($nohp), 0, 2)=='02'){
                $data = ['akses'=>0,'status'=>400,'msg'=>'Bukan No. Hp'];
			}
            elseif(substr(trim($nohp), 0, 2)!='08'){
                $data = ['akses'=>0,'status'=>400,'msg'=>'B No. Hp harus berawalan 08'];
			}
            elseif(substr(trim($nohp), 0, 2)=='00'){
                $data = ['akses'=>0,'status'=>400,'msg'=>'Bukan No. Hp'];
			}
            // cek apakah no hp kurang dari 10
            elseif(strlen($nohp) <=10){
                $data = ['akses'=>0,'status'=>400,'msg'=>'No. Hp kurang'];
                }else{
                $data = ['akses'=>1,'status'=>200,'msg'=>'Ok'];
			}
		}
        return $data;
        
	}
    function hp_3($nohp) {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);
        // kadang ada penulisan no hp 0811-239-345
        $nohp = str_replace("-","",$nohp);
        $nohp = str_replace("+","",$nohp);
        $nohp = clean($nohp);
        // cek apakah no hp mengandung karakter + dan 0-9
        $hp = '';
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 2)=='62'){
                // $hp = trim($nohp);
                $hp = substr_replace($nohp,'0',0,2);
			}
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '0'.substr(trim($nohp), 1);
			}
		}
        return $hp;
	}
    function clearnohp($nohp) {
		$nohp = str_replace("-","",$nohp);
		$nohp = str_replace(" ","",$nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace("(","",$nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace(")","",$nohp);
		// kadang ada penulisan no hp 0811.239.345
		$nohp = str_replace(".","",$nohp);
		
		// cek apakah no hp mengandung karakter + dan 0-9
		if(!preg_match('/[^+0-9]/',trim($nohp))){
			if(substr(trim($nohp), 0, 3)=='+62'){
				$hp = substr_replace($nohp,'0',0,3);
			}
            elseif(substr(trim($nohp), 0, 2)=='62'){
                // $hp = trim($nohp);
                $hp = substr_replace($nohp,'0',0,2);
			}
			elseif(substr(trim($nohp), 0, 1)=='0'){
				$hp = $nohp;
				}else{
				$hp = $nohp;
			}
			}else{
			$hp = $nohp;
		}
		return $hp;
	}
	function hp62($nohp) {
		// kadang ada penulisan no hp 0811 239 345
		$nohp = str_replace(" ","",$nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace("(","",$nohp);
		// kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace(")","",$nohp);
		// kadang ada penulisan no hp 0811.239.345
		$nohp = str_replace(".","",$nohp);
		// kadang ada penulisan no hp 0811-239-345
		$nohp = str_replace("-","",$nohp);
		$nohp = str_replace("+","",$nohp);
		
		// cek apakah no hp mengandung karakter + dan 0-9
		$hp = '';
		if(!preg_match('/[^+0-9]/',trim($nohp))){
			// cek apakah no hp karakter 1-3 adalah +62
			if(substr(trim($nohp), 0, 3)=='+62'){
				// $hp = trim($nohp);
				$hp = substr_replace($nohp,'62',0,3);
			}
			// cek apakah no hp karakter 1 adalah 0
			elseif(substr(trim($nohp), 0, 2)=='62'){
				$hp = substr_replace($nohp,'62',0,2);
			}
			elseif(substr(trim($nohp), 0, 1)=='0'){
				$hp = '62'.substr(trim($nohp), 1);
			}
		}
		return $hp;
	}
    function comma_to_dot($text){
        $text =  str_replace(",",".",$text);
        return $text;
	}
    function clean($text){
        $text = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($text)));
        return $text;
	}
    
    function kata($string, $limit, $break=" ", $pad="...") {
        // return with no change if string is shorter than $limit 
        if(strlen($string) <= $limit) 
        return $string; 
        $string = substr($string, 0, $limit); 
        if(false !== ($breakpoint = strrpos($string, $break))) { 
		$string = substr($string, 0, $breakpoint); } 
        return $string . $pad; 
	}
    function cetak($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
	}
    
    function cetak_meta($str,$mulai,$selesai){
        return strip_tags(html_entity_decode(substr(str_replace('"','',$str),$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
	}
    
    function sensor($teks){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT * FROM katajelek");
        foreach ($query->result_array() as $r) {
            $teks = str_replace($r['kata'], $r['ganti'], $teks);       
		}
        return $teks;
	}  
    
    function getSearchTermToBold($text, $words){
        preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
        if (!$m)
        return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<b style="color:red">$0</b>', $text);
	}
    
    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	} 
    
    function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
	}
    
    function getYEmbedUrl($url){
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
        
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
		}
        
        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
		}
        return 'https://www.youtube.com/embed/' . $youtube_id ;
	}
    function format_size($size) {
        $mod = 1024;
        $units = explode(' ','B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
		}
        return round($size, 2) . ' ' . $units[$i];
	}
    function folderSize ($dir)
    {
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : folderSize($each);
		}
        return $size;
	}
    function thumb($path,$fullname, $width, $height)
    {
        // Path to image thumbnail in your root
        $dir = $path;
        $url = base_url() . $path;
        // Get the CodeIgniter super object
        $CI = &get_instance();
        // get src file's extension and file name
        $extension = pathinfo($fullname, PATHINFO_EXTENSION);
        $filename = pathinfo($fullname, PATHINFO_FILENAME);
        $image_org = $dir . $filename . "." . $extension;
        $image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;
        $image_returned = $url . $filename . "-" . $height . '_' . $width . "." . $extension;
        
        if (!file_exists($image_thumb)) {
            // LOAD LIBRARY
            $CI->load->library('image_lib');
            // CONFIGURE IMAGE LIBRARY
            $config['source_image'] = $image_org;
            $config['new_image'] = $image_thumb;
            $config['width'] = $width;
            $config['height'] = $height;
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->clear();
		}
        return $image_returned;
	}
    function potdesc($text,$jml){
        $text = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($text)));
        //$kalimat = strip_tags($text); // membuat paragraf pada isi berita dan mengabaikan tag html
        $text = substr($text,0,$jml); // ambil sebanyak 200 karakter
        $text = substr($text,0,strrpos($text," ")); // potong per spasi kalimat
        return $text;
	}
    
    function strip_word_html($text, $allowed_tags = '')
    {
        mb_regex_encoding('UTF-8');
        //replace MS special characters first
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u', '/&ndash;/u', '/&quot;/u', '/ndash/u' );
        $replace = array('\'', '\'', '"', '"', '-');
        $text = preg_replace($search, $replace, $text);
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
        //in some MS headers, some html entities are encoded and some aren't
        //$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        //try to strip out any C style comments first, since these, embedded in html comments, seem to
        //prevent strip_tags from removing html comments (MS Word introduced combination)
        if(mb_stripos($text, '/*') !== FALSE){
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
		}
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
        //'<1' becomes '< 1'(note: somewhat application specific)
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
        $text = strip_tags($text, $allowed_tags);
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
        //strip out inline css and simplify style tags
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
        $text = preg_replace($search, $replace, $text);
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
        //some MS Style Definitions - this last bit gets rid of any leftover comments */
        $num_matches = preg_match_all("/\<!--/u", $text, $matches);
        if($num_matches){
            $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
		}
        $text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $text);
        return $text;
	}
    function rp($angka){
        $konversi = number_format($angka, 0, ',', '.');
        return $konversi;
	}
    function image_count($directory) {
		$count = count(glob("./$directory/*.*"));
        return $count;
	}
    
	function dir_size($directory) {
        $size = 0;
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
            $size += $file->getSize();
		}
        return $size;
	}
	function getDataURI($imagePath) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $type = $finfo->file($imagePath);
        return 'data:'.$type.';base64,'.base64_encode(file_get_contents($imagePath));
	}    
    
    function recursiveChmod($path, $filePerm=0644, $dirPerm=0755){
        if(!file_exists($path)){
            return false;
		}
        if(is_file($path)){
            chmod($path, $filePerm);
            } elseif(is_dir($path)) {
            $foldersAndFiles = scandir($path);
            $entries = array_slice($foldersAndFiles, 2);
            foreach($entries as $entry){
                recursiveChmod($path."/".$entry, $filePerm, $dirPerm);
			}
            chmod($path, $dirPerm);
		}
        return true;
	}
    function recursiveDelete($directory, $empty=false) {
        if(substr($directory,-1) == '/'){
            $directory = substr($directory,0,-1);
		}
        if(!file_exists($directory) || !is_dir($directory)){
            return false;
            } elseif(is_readable($directory)){
            $handle = opendir($directory);
            while (false !== ($item = readdir($handle))) {
                if($item != '.' && $item != '..') {
                    $path = $directory.'/'.$item;
                    if(is_dir($path)) {
                        recursiveDelete($path);
                        }else{
                        unlink($path);
					}
				}
			}
            closedir($handle);
            if($empty == false) {
                if(!rmdir($directory)) {
                    return false;
				}
			}
		}
        return true;
	}
    function moveFiles($src, $dst){
        if (file_exists ( $dst )){
            recursiveDelete( $dst );
		}
        if (is_dir ( $src )) {
            mkdir ( $dst );
            $files = scandir ( $src );
            foreach ( $files as $file ){
                if ($file != "." && $file != ".."){
                    moveFiles( "$src/$file", "$dst/$file" );
				}
			}
            } elseif (file_exists ( $src )){
            copy ( $src, $dst );
		}
	}
    
    function cek_info()
    {
        $ci = & get_instance();
        if ($ci->agent->is_browser())
        {
            $agent['browser'] = $ci->agent->browser().' '.$ci->agent->version();
		}
        elseif ($ci->agent->is_robot())
        {
            $agent['browser'] = $ci->agent->robot();
		}
        elseif ($ci->agent->is_mobile())
        {
            $agent['browser'] = $ci->agent->mobile();
		}
        else
        {
            $agent['browser'] = 'Unidentified User Agent';
		}
        $agent['ip'] = $ci->input->ip_address();
        $agent['os'] = $ci->agent->platform();
        
        return $agent;
	}
    function slugify($string)
    {
        // Replace unsupported characters (add your owns if necessary)
        $string = str_replace(" ", '-', $string);
        $string = str_replace("_", '-', $string);
        $string = str_replace("'", '-', $string);
        $string = str_replace(".", '-', $string);
        $string = str_replace("²", '2', $string);
		
        // Slugify and return the string
        return url_title(convert_accented_characters($string), 'dash', true);
	}
	function cleanString($text) {
		// 1) convert á ô => a o
		$text = preg_replace("/[áàâãªä]/u","a",$text);
		$text = preg_replace("/[ÁÀÂÃÄ]/u","A",$text);
		$text = preg_replace("/[ÍÌÎÏ]/u","I",$text);
		$text = preg_replace("/[íìîï]/u","i",$text);
		$text = preg_replace("/[éèêë]/u","e",$text);
		$text = preg_replace("/[ÉÈÊË]/u","E",$text);
		$text = preg_replace("/[óòôõºö]/u","o",$text);
		$text = preg_replace("/[ÓÒÔÕÖ]/u","O",$text);
		$text = preg_replace("/[úùûü]/u","u",$text);
		$text = preg_replace("/[ÚÙÛÜ]/u","U",$text);
		$text = preg_replace("/[’‘‹›‚]/u","'",$text);
		$text = preg_replace("/[“”«»„]/u",'"',$text);
		$text = str_replace("–","-",$text);
		$text = str_replace(" "," ",$text);
		$text = str_replace("ç","c",$text);
		$text = str_replace("Ç","C",$text);
		$text = str_replace("ñ","n",$text);
		$text = str_replace("Ñ","N",$text);
		
		//2) Translation CP1252. &ndash; => -
		$trans = get_html_translation_table(HTML_ENTITIES);
		$trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
		$trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
		$trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
		$trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
		$trans[chr(134)] = '&dagger;';    // Dagger
		$trans[chr(135)] = '&Dagger;';    // Double Dagger
		$trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
		$trans[chr(137)] = '&permil;';    // Per Mille Sign
		$trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
		$trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
		$trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
		$trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
		$trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
		$trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
		$trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
		$trans[chr(149)] = '&bull;';    // Bullet
		$trans[chr(150)] = '&ndash;';    // En Dash
		$trans[chr(151)] = '&mdash;';    // Em Dash
		$trans[chr(152)] = '&tilde;';    // Small Tilde
		$trans[chr(153)] = '&trade;';    // Trade Mark Sign
		$trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
		$trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
		$trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
		$trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
		$trans['euro'] = '&euro;';    // euro currency symbol
		ksort($trans);
		
		foreach ($trans as $k => $v) {
			$text = str_replace($v, $k, $text);
		}
		
		// 3) remove <p>, <br/> ...
		$text = strip_tags($text);
		
		// 4) &amp; => & &quot; => '
		$text = html_entity_decode($text);
		
		// 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
		$text = preg_replace('/[^(\x20-\x7F)]*/','', $text);
		
		$targets=array('\r\n','\n','\r','\t');
		$results=array(" "," "," ","");
		$text = str_replace($targets,$results,$text);
		
		//XML compatible
		/*
			$text = str_replace("&", "and", $text);
			$text = str_replace("<", ".", $text);
			$text = str_replace(">", ".", $text);
			$text = str_replace("\\", "-", $text);
			$text = str_replace("/", "-", $text);
		*/
		
		return ($text);
	} 
	function cleans($s) {
		$c = array (' ');
		$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','"');
		
		$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
		
		$s = strtolower(str_replace($c, '_', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
		return $s;
	}
    
	function cleanTag($text){
		$text = preg_replace('/[^a-zA-Z0-9\s]/', ' ', strip_tags(html_entity_decode($text)));
		return $text;
	}    
    function convert_to_number($rupiah)
	{
		return intval(preg_replace('/,.*|[^0-9]/', '', $rupiah));
	}                                                				
	
	/**
		* Check if a given ip is in a network
		* @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
		* @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
		* @return boolean true if the ip is in this range / false if not.
	*/
	function ip_in_range() {
		$ip = @$_SERVER['HTTP_HOST'];
		if($ip=='localhost'){
			return false;
			exit;
		}
		if (filter_var($ip, FILTER_VALIDATE_IP)) {
			return false;
			} else {
			return true;
		}
	}		