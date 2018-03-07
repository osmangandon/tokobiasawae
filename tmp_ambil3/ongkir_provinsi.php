<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;


$filenya = "ongkir_provinsi.php";




//cek
$qcc = mysql_query("SELECT * FROM provinsi ".
						"ORDER BY RAND()");
$rcc = mysql_fetch_assoc($qcc);

do
	{
	$cc_idprov = nosql($rcc['id_prov']);
	$cc_nama = balikin($rcc['nama']);
	
	//update ongkir
	$ku_rand = rand(2000,3000);
	
	mysql_query("UPDATE provinsi SET ongkir = '$ku_rand' ".
					"WHERE id_prov = '$cc_idprov'");
					
	echo "$cc_nama -> $ku_rand<br>";
	}
while ($rcc = mysql_fetch_assoc($qcc));






exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>