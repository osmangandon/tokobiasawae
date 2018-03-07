<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;


$filenya = "ongkir_kota.php";




//cek
$qcc = mysql_query("SELECT * FROM kabupaten ".
						"ORDER BY RAND()");
$rcc = mysql_fetch_assoc($qcc);

do
	{
	$cc_idkab = nosql($rcc['id_kab']);
	$cc_nama = balikin($rcc['nama']);
	
	//update ongkir
	$ku_rand = rand(7000,15000);
	
	mysql_query("UPDATE kabupaten SET ongkir = '$ku_rand' ".
					"WHERE id_kab = '$cc_idkab'");
					
	echo "$cc_nama -> $ku_rand<br>";
	}
while ($rcc = mysql_fetch_assoc($qcc));






exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>