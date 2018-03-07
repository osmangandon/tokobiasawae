<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/simple_html_dom.php");

nocache;


$filenya = "cektarif_url.php";


$jml_detik = 5000;





//daftar propinsi
$qku = mysql_query("SELECT * FROM ongkirnya ".
						"ORDER BY RAND()");
$rku = mysql_fetch_assoc($qku);
$ku_kd = balikin($rku['kd']);
$ku_prop1 = balikin($rku['propinsi1']);
$ku_kota1 = balikin($rku['kota1']);
$ku_prop2 = balikin($rku['propinsi2']);
$ku_kota2 = balikin($rku['kota2']);

$ku_asal = seo_friendly_url2("$ku_kota1");
$ku_tujuan = seo_friendly_url2("$ku_kota2");



echo "<h1>
BERBURU URL : $ku_prop1 [$ku_kota1] ke $ku_prop2 [$ku_kota2]
</h1>
<hr>";







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$nilainya = "cektarif+jne+%3A+$ku_asal+ke+$ku_tujuan";




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


//echo $str;


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
		


		
		//update
		mysql_query("INSERT INTO situs_cektarif(kd, urlnya, postdate) VALUES ".
						"('$x', '$nilku3', '$today')");
			
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