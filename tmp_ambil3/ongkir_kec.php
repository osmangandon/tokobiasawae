<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;


$filenya = "ongkir_kec.php";




//cek
$qcc = mysql_query("SELECT * FROM kecamatan ".
						"ORDER BY RAND()");
$rcc = mysql_fetch_assoc($qcc);

do
	{
	$cc_no = $cc_no + 1;
	$cc_idkab = nosql($rcc['id_kec']);
	$cc_nama = balikin($rcc['nama']);
	
	//update ongkir
	$ku_rand = rand(3000,7000);
	
	//bulatke
	$i_harga22 = round($ku_rand);
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$jml_total = $i_harga22 + $i_hargku;
	
	
	
	//jadikan ongkir
	$i_harga22 = $jml_total;
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$jml_jne_yes = $i_harga22 + $i_hargku;
	
	
	$i_harga22 = round($jml_total - ((10/100) * $jml_total));
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$jml_jne_reg = $i_harga22 + $i_hargku;
	
	
	$i_harga22 = round($jml_total - ((20/100) * $jml_total));
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$jml_pos_express = $i_harga22 + $i_hargku;
	
	
	
	$i_harga22 = round($jml_total - ((25/100) * $jml_total));
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$jml_pos_kilat = $i_harga22 + $i_hargku;
	
	
	
	$i_harga22 = round($jml_total - ((11/100) * $jml_total));
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$jml_tiki_express = $i_harga22 + $i_hargku;
	
	
	
	
	$i_harga22 = round($jml_total - ((15/100) * $jml_total));
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$jml_tiki_reguler = $i_harga22 + $i_hargku;
	
	
	
	
	
	mysql_query("UPDATE kecamatan SET ongkir = '$jml_total', ".
					"ongkir_jne_yes = '$jml_jne_yes', ".
					"ongkir_jne_reg = '$jml_jne_reg', ".
					"ongkir_pos_express = '$jml_pos_express', ".
					"ongkir_pos_kilat = '$jml_pos_kilat', ".
					"ongkir_tiki_express = '$jml_tiki_express', ".
					"ongkir_tiki_reguler = '$jml_tiki_reguler' ".
					"WHERE id_kec = '$cc_idkab'");
					
	echo "[$cc_no]. $cc_nama -> $ku_rand<br>";
	}
while ($rcc = mysql_fetch_assoc($qcc));






exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>