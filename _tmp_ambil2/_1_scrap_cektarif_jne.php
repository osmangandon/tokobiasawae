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
						"AND cektarif_jne = '' ".
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
						
						






echo "update...";

mysql_query("UPDATE ongkirnya SET cektarif_jne = '$ongkirnya' ".
				"WHERE kd = '$ku_kd'");	






//lanjutkan ke halaman berikutnya
$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php



exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>