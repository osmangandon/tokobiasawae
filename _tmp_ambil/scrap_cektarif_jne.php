<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;


$filenya = "scrap_cektarif_jne.php";


$jml_detik = 5000;



//baca...
$qku = mysql_query("SELECT * FROM antar_kota ".
						"WHERE jne_reg = '' ". 
						"AND cektarif_jne <> '' ".
						"ORDER BY RAND();");
$rku = mysql_fetch_assoc($qku);
$ku_link = balikin($rku['cektarif_jne']);
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