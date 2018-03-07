<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;


$filenya = "proses_bikin_ongkirco.php";


$jml_detik = 1000;



//baca...
$qku = mysql_query("SELECT * FROM ongkirnya ".
						"WHERE cektarif_url = '' ".
						"ORDER BY RAND();");
$rku = mysql_fetch_assoc($qku);
$ku_kd = nosql($rku['kd']);
$ku_total = balikin($rku['jml_total']);
$ku_link = balikin($rku['cektarif_url']);
$ku_prop1 = balikin($rku['propinsi1']);
$ku_kota1 = strtolower(balikin($rku['kota1']));
$ku_prop2 = balikin($rku['propinsi2']);
$ku_kota2 = strtolower(balikin($rku['kota2']));

$ku_asal = "$ku_prop1 [$ku_kota1]";
$ku_tujuan = "$ku_prop2 [$ku_kota2]";			










echo "<h1>
SCRAPE : $ku_asal ke $ku_tujuan
</h1>";





/*
//pengambilan data ///////////////////////////////////////////////////////////////////////////////////
$useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";
$ch = curl_init ("");

curl_setopt ($ch, CURLOPT_URL, $ku_link);
curl_setopt ($ch, CURLOPT_USERAGENT, $useragent); // set user agent
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$str = curl_exec ($ch);
curl_close($ch);


//echo $str;







//isinya........
$start = "<tbody>";
$end   = "</tbody>";


$startPosisition = strpos($str, $start);
$endPosisition   = strpos($str, $end); 

$longText = $endPosisition - $startPosisition;

$result = substr($str, $startPosisition, $longText);




//pecah

echo $result;





//ambil reguler
$start = "<td>REG</td>";
$end   = "Days</td>";


$startPosisition = strpos($result, $start);
$endPosisition   = strpos($result, $end); 

$longText = $endPosisition - $startPosisition;

$result1 = trim(substr($result, $startPosisition, $longText));




//sempurnakan
$search = array ("'<tr>'", "'</tr>'", "'<td>'", "'</td>'", "'<td align=\"right\">'");
$replace = array ("","", "", "", "");

$hasil2 = trim(preg_replace($search,$replace,$result1));






//sempurnakan lagi
$start1 = "REG";
$end1   = "000";

$startPosisition1 = strpos($hasil2, $start1);
$endPosisition1   = strpos($hasil2, $end1); 

$longText1 = $endPosisition1 - $startPosisition1;

$hasil3 = substr($hasil2, $startPosisition1, $longText1);



//sempurnakan
$search = array ("'REG'", "'CTC'", "','");
$replace = array ("","","000");

$hasil5 = trim(preg_replace($search,$replace,$hasil3));





//jadikan ongkir tertinggi dulu, sebelum masuk database..
$ongkirnya = round($hasil5 + ((15/100) * $hasil5));


echo "<hr>
Dengan rumus : $ku_total
<hr>
Dengan CEKTARIF.COM : $ongkirnya
<hr>";
*/









/*
$qkux = mysql_query("SELECT * FROM situs_ongkirco ".
						"WHERE (nama1 LIKE '%$ku_kota1%' ".
						"OR nama2 LIKE '%$ku_kota1%') ".
						"AND (nama2 LIKE '%$ku_kota2%' ".
						"OR nama2 LIKE '%$ku_kota2%')");
$rkux = mysql_fetch_assoc($qkux);
$tkux = mysql_num_rows($qkux);
*/




//asal.........................................................................................
//sempurnakan
$search = array ("'kab.'", "'kota'");
$replace = array ("","");
$ku_kota11 = trim(preg_replace($search,$replace,$ku_kota1));


$pecahya = explode(" ", strtolower($ku_kota11));
$pecah1 = $pecahya[0];
$pecah2 = $pecahya[1];
$pecah3 = $pecahya[2];



//jika null, kasi -
if (empty($pecah1))
	{
	//$pecah1 = "-";
	}
//jika null, kasi -
if (empty($pecah2))
	{
	//$pecah2 = "-";
	}
//jika null, kasi -
if (empty($pecah3))
	{
	//$pecah3 = "-";
	}
	









//tujuan.........................................................................................
//sempurnakan
$search = array ("'kab.'", "'kota'");
$replace = array ("","");
$ku_kota11 = trim(preg_replace($search,$replace,$ku_kota2));


$pecahya = explode(" ", strtolower($ku_kota11));
$tpecah1 = $pecahya[0];
$tpecah2 = $pecahya[1];
$tpecah3 = $pecahya[2];



//jika null, kasi -
if (empty($tpecah1))
	{
	$tpecah1 = "-";
	}
//jika null, kasi -
if (empty($tpecah2))
	{
	$tpecah2 = "-";
	}
//jika null, kasi -
if (empty($tpecah3))
	{
	$tpecah3 = "-";
	}




/*
$qkux = mysql_query("SELECT * FROM situs_ongkirco ".
						"WHERE (nama LIKE '%$pecah1%' ".
						"OR nama LIKE '%$pecah2%' ".
						"OR nama LIKE '%$pecah3%') ".
						"AND (nama2 LIKE '%$tpecah1%' ".
						"OR nama2 LIKE '%$tpecah2%' ".
						"OR nama2 LIKE '%$tpecah3%')");
$rkux = mysql_fetch_assoc($qkux);
$tkux = mysql_num_rows($qkux);
$kux_urlnya = balikin($rkux['urlnya']);
*/


echo "$pecah1 
<br>
$pecah2
<br>
$pecah3";

$qkux = mysql_query("SELECT * FROM situs_ongkirco ".
						"WHERE (nama LIKE '%$pecah1%' ".
						"AND nama2 LIKE '%$tpecah1%') ".
						"OR (nama2 LIKE '%$pecah1%' ".
						"AND nama LIKE '%$tpecah1%')");
$rkux = mysql_fetch_assoc($qkux);
$tkux = mysql_num_rows($qkux);

//jika ada
if (!empty($tkux))
	{
	$kux_urlnya = balikin($rkux['urlnya']);

	echo "-> $kux_urlnya";
	
	
	//update
	mysql_query("UPDATE ongkirnya SET cektarif_url = '$kux_urlnya' ".
					"WHERE kd = '$ku_kd'");
	
	}
else
	{
	echo "belum ada";
	}



//lanjutkan ke halaman berikutnya
$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php



exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>