<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/simple_html_dom.php");

nocache;


$filenya = "bing_ongkirco.php";


$jml_detik = 5000;





//daftar propinsi
$qku = mysql_query("SELECT * FROM provinsi ".
						"ORDER BY RAND()");
$rku = mysql_fetch_assoc($qku);
$ku_id = balikin($rku['id_prov']);
$ku_nama = cegah($rku['nama']);


//kabupaten
$qku2 = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$ku_id' ".
						"ORDER BY RAND()");
$rku2 = mysql_fetch_assoc($qku2);
$ku2_nama = cegah($rku2['nama']);
$ku_1 = cegah($rku2['nama']);
$ku_asal = seo_friendly_url2(balikin($rku2['nama']));









//daftar propinsi
$qku3 = mysql_query("SELECT * FROM provinsi ".
						"ORDER BY RAND()");
$rku3 = mysql_fetch_assoc($qku3);
$ku3_id = balikin($rku3['id_prov']);
$ku3_nama = cegah($rku3['nama']);


//kabupaten
$qku4 = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$ku3_id' ".
						"ORDER BY RAND()");
$rku4 = mysql_fetch_assoc($qku4);
$ku4_nama = cegah($rku4['nama']);
$ku2_1 = cegah($rku4['nama']);
$ku2_tujuan = seo_friendly_url2(balikin($rku4['nama']));






//masukkan database
$kdnya = md5("$ku_nama$ku2_nama$ku3_nama$ku4_nama");


//cek
$qcc = mysql_query("SELECT * FROM antar_kota ".
						"WHERE kd = '$kdnya'");
$tcc = mysql_num_rows($qcc);


//jika null
if (empty($tcc))
	{
	mysql_query("INSERT INTO antar_kota(kd, propinsi1, kota1, propinsi2, kota2, postdate) VALUES ".
					"('$kdnya', '$ku_nama', '$ku2_nama', '$ku3_nama', '$ku4_nama', '$today')");
	}









//ketahui kdnya
$yuk_kd = $kdnya;



echo "<h1>
CEKTARIF JNE : $ku_asal ke $ku2_tujuan
</h1>
<hr>
$yuk_kd
<br>";







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$nilainya = "ongkir.co+%3A+$ku_asal+ke+$ku2_tujuan";




//pengambilan data ///////////////////////////////////////////////////////////////////////////////////
$query = "$nilainya";
$useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";
$ch = curl_init ("");

curl_setopt ($ch, CURLOPT_URL, "http://www.bing.com/search?q=$query&qs=n&form=QBLH&sp=-1&pq=undefined&sc=0-12&sk=&cvid=B39DA7713EB748E2A539CDF6736A4202");


curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); // set user agent
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$str = curl_exec ($ch);
curl_close($ch);


echo $str;


// Create a DOM object
$html_base = new simple_html_dom();

// Load HTML from a string
$grab = $html_base->load($str);



//isinya........
$start = "<body>";
$end   = "</body>";


$startPosisition = strpos($grab, $start);
$endPosisition   = strpos($grab, $end); 

$longText = $endPosisition - $startPosisition;

$result = substr($grab, $startPosisition, $longText);


//echo $result;





// Create a DOM object
$html_base = new simple_html_dom();
// Load HTML from a string
$html_base->load($result);

//get all category links
foreach($html_base->find('a') as $element) {
	
	$nilku = trim($element->href);

	//echo "-> $nilku <br>";
	
	$url_asli = "cektarif.com/ongkir-jne-";
	$nilkux = substr($nilku,7,24);


	//echo "-> [$nilku]. $url_asli [$nilkux]<br>";

	

	if ($nilkux == $url_asli)
		{
	
		$nilku2 = substr($nilku,7,255);
							
		$strkuu = explode('&amp;sa=', $nilku2);
		$nilku3 = $strkuu[0];
	
		echo "$nilku3 <br>";
		
		/*
		//update
		mysql_query("UPDATE antar_kota SET cektarif_jne = '$nilku3' ".
						"WHERE kd = '$yuk_kd'");
		*/
			
		}


	}



$html_base->clear(); 
unset($html_base);






//lanjutkan ke halaman berikutnya
$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php


exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>