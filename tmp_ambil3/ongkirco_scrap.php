<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");
require("../inc/class/simple_html_dom.php");



nocache;


$filenya = "ongkirco_scrap.php";


$jml_detik = 5000;



$qcc2 = mysql_query("SELECT * FROM situs_ongkirco ".
						"WHERE ongkir_jne = '' ".
						"ORDER BY RAND()");
$rcc2 = mysql_fetch_assoc($qcc2);
$cc2_kd = nosql($rcc2['kd']);
$cc2_urlnya = balikin($rcc2['urlnya']);



//pecah
$pecahku = explode("/", $cc2_urlnya);
$pecah1 = $pecahku[0];
$pecah2 = $pecahku[1];
$pecah3 = $pecahku[2];
$pecah4 = $pecahku[3];
$pecah5 = $pecahku[4];




$rulnya = "http://ongkir.co/ongkir/$pecah5/1000/";


echo "$rulnya";





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$cc_url_asli = $rulnya;

$base = $cc_url_asli;



$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_URL, $base);
curl_setopt($curl, CURLOPT_REFERER, $base);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$str = curl_exec($curl);
curl_close($curl);








// Create a DOM object
$html_base = new simple_html_dom();

// Load HTML from a string
$grab = $html_base->load($str);



//isinya........
$start = "<label class=\"control-label\">";
$end   = "Informasi Pengiriman";
$startPosisition = strpos($grab, $start);
$endPosisition   = strpos($grab, $end); 

$longText = $endPosisition - $startPosisition;

$result = substr($grab, $startPosisition, $longText);

//pecah lagi...
$pecah1 = explode("<label class=\"control-label\">", $result);
$val_jne = $pecah1[1];//jne
$val_pos = $pecah1[2];//pos






//jika jne ////////////////////////////////////////////////////////////////////////////////////
//echo "$val_jne <hr>";
echo "<h1>JNE</h1>";

$jne1 = explode("Tarif Jalur Nugraha Ekakurir (JNE) ", $val_jne);
$jne11 = $jne1[1];


//pecah lagi
$jne2 = explode(" Kg)", $jne11);
$jne22 = $jne2[0];
$jne23 = $jne2[1];

//pecah lagi
$jne3 = explode(" ke ", $jne22);
$e_dari = $jne3[0];
$e_tujuann = $jne3[1];

$e_tujuannn = explode("(", $e_tujuann);
$e_tujuan = $e_tujuannn[0];






$start = "Layanan Reguler";
$end   = "Atau ";
$startPosisition = strpos($result, $start);
$endPosisition   = strpos($result, $end); 

$longText = $endPosisition - $startPosisition;

$result_jne = substr($result, $startPosisition, $longText);




//echo $result_jne;


$pecahku = explode("<td align=\"right\">", $result_jne);
$pecah1 = $pecahku[1];



//echo $pecah1;



$pecahku2 = explode("</td>", $pecah1);
$pecah21 = $pecahku2[0];


//echo "$pecah21 <br>";



$pecahku3 = explode("Rp.", $pecah21);
$pecah31 = trim($pecahku3[1]);


echo $pecah31;



//update
mysql_query("UPDATE situs_ongkirco SET ongkir_jne = '$pecah31' ".
				"WHERE kd = '$cc2_kd'");







$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php




exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
