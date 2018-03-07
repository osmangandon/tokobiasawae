<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");
require("../inc/class/simple_html_dom.php");



nocache;


$filenya = "ongkirco_ke_db.php";


$jml_detik = 5000;



$qcc2 = mysql_query("SELECT * FROM situs_ongkirco ".
						"WHERE ongkir_jne <> '' ".
						"ORDER BY RAND()");
$rcc2 = mysql_fetch_assoc($qcc2);
$cc2_kd = nosql($rcc2['kd']);
$cc2_urlnya = balikin($rcc2['urlnya']);
$cc2_ongkir = balikin($rcc2['ongkir_jne']);



//pecah
$pecahku = explode("/", $cc2_urlnya);
$pecah1 = $pecahku[0];
$pecah2 = $pecahku[1];
$pecah3 = $pecahku[2];
$pecah4 = $pecahku[3];
$pecah5 = $pecahku[4];



$pecahku = explode("-ke-", $pecah5);
$asal1 = $pecahku[0];
$tujuan1 = $pecahku[1];

$pecahku = explode("-", $asal1);
$asal1 = $pecahku[2];
$asal2 = $pecahku[3];
$asal3 = $pecahku[4];
$asal4 = $pecahku[5];



$pecahku = explode("-", $tujuan1);
$tujuan1 = $pecahku[0];
$tujuan2 = $pecahku[1];
$tujuan3 = $pecahku[2];
$tujuan4 = $pecahku[3];



$asalnya = trim("$asal1 $asal2 $asal3 $asal4");
$tujuannya = trim("$tujuan1 $tujuan2 $tujuan3 $tujuan4");

//echo "$pecah5 -> $asal1 $asal2 $asal3 $asal4";
//echo "$pecah5 -> $tujuan1 $tujuan2 $tujuan3 $tujuan4";




//hilangkan : kota, kab, utara, selatan, timur, barat, tengah, pusat

$search = array ("'kota'", "'kab.'", "'utara'", "'selatan'", "'timur'", "'barat'", "'tengah'", "'pusat'");
$replace = array ("", "", "", "", "", "", "");
$asalnya2 = preg_replace($search,$replace,$asalnya);





$search = array ("'kota'", "'kab.'", "'utara'", "'selatan'", "'timur'", "'barat'", "'tengah'", "'pusat'");
$replace = array ("", "", "", "", "", "", "");
$tujuannya2 = preg_replace($search,$replace,$tujuannya);




echo "$cc2_kd
<hr>
$asalnya -> $asalnya2
<br>
$tujuannya -> $tujuannya2
<br>
[$cc2_ongkir]";





//asal
$pecahku = explode(" ", $asalnya2);
$asal1 = $pecahku[0];
$asal2 = $pecahku[1];
$asal3 = $pecahku[3];

//jika null
if (empty($asal1))
	{
	$asal1 = "+";
	}

if (empty($asal2))
	{
	$asal2 = "+";
	}
	
if (empty($asal3))
	{
	$asal3 = "+";
	}











//tujuan
$pecahku = explode(" ", $tujuannya2);
$tujuan1 = $pecahku[0];
$tujuan2 = $pecahku[1];
$tujuan3 = $pecahku[3];

//jika null
if (empty($tujuan1))
	{
	$tujuan1 = "+";
	}
if (empty($tujuan2))
	{
	$tujuan2 = "+";
	}
if (empty($tujuan3))
	{
	$tujuan3 = "+";
	}






//cari ke data kota
$qku = mysql_query("SELECT * FROM kabupaten ".
						"WHERE nama LIKE '%$asal1%' ".
						"OR nama LIKE '%$asal2%' ".
						"OR nama LIKE '%$asal3%'");
$rku = mysql_fetch_assoc($qku);
$asal_nama = balikin($rku['nama']);



//cari ke data kota
$qku = mysql_query("SELECT * FROM kabupaten ".
						"WHERE nama LIKE '%$tujuan1%' ".
						"OR nama LIKE '%$tujuan2%' ".
						"OR nama LIKE '%$tujuan3%'");
$rku = mysql_fetch_assoc($qku);
$tujuan_nama = balikin($rku['nama']);




echo "<hr>
$asal_nama -> $tujuan_nama";





//update
mysql_query("UPDATE situs_ongkirco SET kota1 = '$asal_nama', ".
				"kota2 = '$tujuan_nama' ".
				"WHERE kd = '$cc2_kd'");







$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php




exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
