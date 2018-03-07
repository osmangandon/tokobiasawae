<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;


$filenya = "scrap_cektarif_jne.php";


$jml_detik = 5000;



//baca...
$qku = mysql_query("SELECT * FROM ongkirnya ".
						"WHERE cektarif_url <> '' ".
						"ORDER BY RAND();");
$rku = mysql_fetch_assoc($qku);
$ku_kd = nosql($rku['kd']);
$ku_total = balikin($rku['jml_total']);
$ku_link = balikin($rku['cektarif_url']);
$ku_prop1 = balikin($rku['propinsi1']);
$ku_kota1 = balikin($rku['kota1']);
$ku_prop2 = balikin($rku['propinsi2']);
$ku_kota2 = balikin($rku['kota2']);

$ku_asal = "$ku_prop1 [$ku_kota1]";
$ku_tujuan = "$ku_prop2 [$ku_kota2]";			










echo "<h1>
SCRAPE : $ku_asal ke $ku_tujuan
</h1>
[$ku_link]";






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
						
						







//cek asal /////////////////////////////////////////////////////////////////
$asalku = explode("ongkir-jne-", $ku_link);
$pecah_asalku1 = $asalku[1];
$asalkua = explode("-ke", $pecah_asalku1);
$pecah_asalkua = $asalkua[0];


//sempurnakan
$search = array ("'kab'", "'kota'");
$replace = array ("","");
$ku_kota11 = trim(preg_replace($search,$replace,$pecah_asalkua));


$pecahya = explode("-", strtolower($ku_kota11));
$pecah1 = $pecahya[0];
$pecah2 = $pecahya[1];
$pecah3 = $pecahya[2];



//jika null, kasi -
if (empty($pecah1))
	{
	$pecah1 = "-";
	}
//jika null, kasi -
if (empty($pecah2))
	{
	$pecah2 = "-";
	}
//jika null, kasi -
if (empty($pecah3))
	{
	$pecah3 = "-";
	}
	
	
	
	
	

echo "$pecah1
<br>
$pecah2
<br>
$pecah3
<hr>";






//cek tujuan/////////////////////////////////////////////////////////////////
$tujuanku = explode("-ke-", $ku_link);
$pecah_asalku1 = $tujuanku[1];

//sempurnakan
$search = array ("'kab'", "'kota'");
$replace = array ("","");
$ku_kota11 = trim(preg_replace($search,$replace,$pecah_asalku1));

$pecahya = explode("-", strtolower($ku_kota11));
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
	
	
	
//echo "$pecah_asalku1";


echo "$tpecah1
<br>
$tpecah2
<br>
$tpecah3
<hr>";









//asal
$asal_pecah1 = "$pecah1-ke";
$asal_pecah2 = "$pecah2-ke";
$asal_pecah3 = "$pecah3-ke";




/*
$qkux = mysql_query("SELECT * FROM ongkirnya ".
						"WHERE (kota1 LIKE '%$pecah1%' ".
						"OR kota1 LIKE '%$pecah2%' ".
						"OR kota1 LIKE '%$pecah3%') ".
						"AND kd = '$ku_kd'");
$rkux = mysql_fetch_assoc($qkux);
$tkux = mysql_num_rows($qkux);
*/



$qkux = mysql_query("SELECT * FROM ongkirnya ".
						"WHERE (kota1 LIKE '%$pecah1%' ".
						"OR kota1 LIKE '%$pecah2%' ".
						"OR kota1 LIKE '%$pecah3%') ".
						"AND (kota2 LIKE '%$tpecah1%' ".
						"OR kota2 LIKE '%$tpecah2%' ".
						"OR kota2 LIKE '%$tpecah3%') ".
						"AND kd = '$ku_kd'");
$rkux = mysql_fetch_assoc($qkux);
$tkux = mysql_num_rows($qkux);




echo $tkux;




/*
//lanjutkan ke halaman berikutnya
$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php
*/


exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>