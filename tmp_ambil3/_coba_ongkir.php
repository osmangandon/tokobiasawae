<?php
session_start();

//fungsi - fungsi
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
$tpl = LoadTpl("../template/coba.html");


nocache;

//nilai
$filenya = "coba_ongkir.php";
$judul = "Coba Ongkir";
$judulku = $judul;
$juduly = $judul;
$prop1 = nosql($_REQUEST['prop1']);
$kota1 = nosql($_REQUEST['kota1']);
$kec1 = nosql($_REQUEST['kec1']);
$prop2 = nosql($_REQUEST['prop2']);
$kota2 = nosql($_REQUEST['kota2']);
$kec2 = nosql($_REQUEST['kec2']);





//isi *START
ob_start();

//js
require("../inc/js/jumpmenu.js");
require("../inc/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form name="formx" method="post" action="'.$filenya.'">

ASAL : 
<hr>
Propinsi : ';
echo "<select name=\"prop1\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qstx = mysql_query("SELECT * FROM provinsi ".
						"WHERE id_prov = '$prop1'");
$rowstx = mysql_fetch_assoc($qstx);
$stx_kd = nosql($rowstx['id_prov']);
$stx_nama = balikin($rowstx['nama']);

echo '<option value="'.$stx_kd.'">'.$stx_nama.'</option>';

$qst = mysql_query("SELECT * FROM provinsi ".
						"WHERE id_prov <> '$prop1' ".
						"ORDER BY nama ASC");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['id_prov']);
	$st_nama = nosql($rowst['nama']);

	echo '<option value="'.$filenya.'?prop1='.$st_kd.'&kota1='.$kota1.'&kec1='.$kec1.'&prop2='.$prop2.'&kota2='.$kota2.'&kec2='.$kec2.'">'.$st_nama.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>, 




Kota/Kabupaten : ';
echo "<select name=\"kota1\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qstx = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_kab = '$kota1'");
$rowstx = mysql_fetch_assoc($qstx);
$stx_kd = nosql($rowstx['id_kab']);
$stx_nama = balikin($rowstx['nama']);

echo '<option value="'.$stx_kd.'">'.$stx_nama.'</option>';

$qst = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$prop1' ".
						"AND id_kab <> '$kota1' ".
						"ORDER BY nama ASC");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['id_kab']);
	$st_nama = nosql($rowst['nama']);

	echo '<option value="'.$filenya.'?prop1='.$prop1.'&kota1='.$st_kd.'&kec1='.$kec1.'&prop2='.$prop2.'&kota2='.$kota2.'&kec2='.$kec2.'">'.$st_nama.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>, 


Kecamatan : ';
echo "<select name=\"kec1\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qstx = mysql_query("SELECT * FROM kecamatan ".
						"WHERE id_kec = '$kec1'");
$rowstx = mysql_fetch_assoc($qstx);
$stx_kd = nosql($rowstx['id_kec']);
$stx_nama = balikin($rowstx['nama']);

echo '<option value="'.$stx_kd.'">'.$stx_nama.'</option>';

$qst = mysql_query("SELECT * FROM kecamatan ".
						"WHERE id_kab = '$kota1' ".
						"AND id_kec <> '$kec1' ".
						"ORDER BY nama ASC");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['id_kec']);
	$st_nama = nosql($rowst['nama']);

	echo '<option value="'.$filenya.'?prop1='.$prop1.'&kota1='.$kota1.'&kec1='.$st_kd.'&prop2='.$prop2.'&kota2='.$kota2.'&kec2='.$kec2.'">'.$st_nama.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>
<br>
<br>




TUJUAN : 
<hr>
Propinsi : ';
echo "<select name=\"prop2\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qstx = mysql_query("SELECT * FROM provinsi ".
						"WHERE id_prov = '$prop2'");
$rowstx = mysql_fetch_assoc($qstx);
$stx_kd = nosql($rowstx['id_prov']);
$stx_nama = balikin($rowstx['nama']);

echo '<option value="'.$stx_kd.'">'.$stx_nama.'</option>';

$qst = mysql_query("SELECT * FROM provinsi ".
						"WHERE id_prov <> '$prop2' ".
						"ORDER BY nama ASC");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['id_prov']);
	$st_nama = nosql($rowst['nama']);

	echo '<option value="'.$filenya.'?prop1='.$prop1.'&kota1='.$kota1.'&kec1='.$kec1.'&prop2='.$st_kd.'&kota2='.$kota2.'&kec2='.$kec2.'">'.$st_nama.'</option>';
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>, 




Kota/Kabupaten : ';
echo "<select name=\"kota2\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qstx = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_kab = '$kota2'");
$rowstx = mysql_fetch_assoc($qstx);
$stx_kd = nosql($rowstx['id_kab']);
$stx_nama = balikin($rowstx['nama']);

echo '<option value="'.$stx_kd.'">'.$stx_nama.'</option>';

$qst = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$prop2' ".
						"AND id_kab <> '$kota2' ".
						"ORDER BY nama ASC");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['id_kab']);
	$st_nama = nosql($rowst['nama']);

	echo '<option value="'.$filenya.'?prop1='.$prop1.'&kota1='.$kota1.'&kec1='.$kec1.'&prop2='.$prop2.'&kota2='.$st_kd.'&kec2='.$kec2.'">'.$st_nama.'</option>';	
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>, 





Kecamatan : ';
echo "<select name=\"kec2\" onChange=\"MM_jumpMenu('self',this,0)\">";

//terpilih
$qstx = mysql_query("SELECT * FROM kecamatan ".
						"WHERE id_kec = '$kec2'");
$rowstx = mysql_fetch_assoc($qstx);
$stx_kd = nosql($rowstx['id_kec']);
$stx_nama = balikin($rowstx['nama']);

echo '<option value="'.$stx_kd.'">'.$stx_nama.'</option>';

$qst = mysql_query("SELECT * FROM kecamatan ".
						"WHERE id_kab = '$kota2' ".
						"AND id_kec <> '$kec2' ".
						"ORDER BY nama ASC");
$rowst = mysql_fetch_assoc($qst);

do
	{
	$st_kd = nosql($rowst['id_kec']);
	$st_nama = nosql($rowst['nama']);

	echo '<option value="'.$filenya.'?prop1='.$prop1.'&kota1='.$kota1.'&kec1='.$kec1.'&prop2='.$prop2.'&kota2='.$kota2.'&kec2='.$st_kd.'">'.$st_nama.'</option>';		
	}
while ($rowst = mysql_fetch_assoc($qst));

echo '</select>';







//ketahui ongkos kirim
if ((!empty($prop1)) AND (!empty($prop2)) AND (!empty($kota1)) AND (!empty($kota2)) AND (!empty($kec1)) AND (!empty($kec2)))
	{
	echo "<hr>hitung...";
	//hitung ongkos kirim
	//asal
	$qku = mysql_query("SELECT * FROM provinsi ".
							"WHERE id_prov = '$prop1'");
	$rku = mysql_fetch_assoc($qku);
	$ku_prop = nosql($rku['ongkir']);
	$ku_urutan = cegah($rku['urutan']);
	
	$qku = mysql_query("SELECT * FROM kabupaten ".
							"WHERE id_kab = '$kota1'");
	$rku = mysql_fetch_assoc($qku);
	$ku_kab = nosql($rku['ongkir']);
	
	$qku = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kec = '$kec1'");
	$rku = mysql_fetch_assoc($qku);
	$ku_kec = nosql($rku['ongkir']);




	//tujuan
	$qku2 = mysql_query("SELECT * FROM provinsi ".
							"WHERE id_prov = '$prop2'");
	$rku2 = mysql_fetch_assoc($qku2);
	$ku2_prop = nosql($rku2['ongkir']);
	$ku2_urutan = cegah($rku2['urutan']);
	
	$qku2 = mysql_query("SELECT * FROM kabupaten ".
							"WHERE id_kab = '$kota2'");
	$rku2 = mysql_fetch_assoc($qku2);
	$ku2_kab = nosql($rku2['ongkir']);
	
	$qku2 = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kec = '$kec2'");
	$rku2 = mysql_fetch_assoc($qku2);
	$ku2_kec = nosql($rku2['ongkir']);




	
	//selisih propinsi
	$jml_prop = $ku2_urutan - $ku_urutan;
	$ongkir_prop = round($jml_prop * 3000);
		
	if ($jml_prop < 0)
		{
		$jml_prop = $ku_urutan - $ku2_urutan;
		$ongkir_prop = round($jml_prop * 3000);
		}






	
	//jika propinsi sama
	if ($prop1 == $prop2)
		{
		$ongkirya = round($ku_kab + $ku_kec + $ku2_kab + $ku2_kec);
		}
	
	//jika kabupaten sama
	else if ($kota1 == $kota2)
		{
		$ongkirya = round($ku_kab + $ku_kec + $ku2_kab + $ku2_kec);
		}
	else
		{
		//total
		$ongkirya = round($ku_kab + $ku_kec + $ku2_kab + $ku2_kec + $ongkir_prop);
		}

	//bulatke
	$i_harga22 = round($ongkirya);
	$i_harga2i = substr($i_harga22,-2);
	$i_hargku = 100 - $i_harga2i;
	$total_ongkir = $i_harga22 + $i_hargku;
	$jml_total = $total_ongkir;

	
	echo "<h1>
	TOTAL ONGKIR : $total_ongkir
	</h1>";






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
	
	
	
	
	
	
	
	echo "JNE YES : $jml_jne_yes
	<br>
	JNE REG : $jml_jne_reg
	<br>
	POS EXPRESS : $jml_pos_express
	<br>
	POS KILAT : $jml_pos_kilat
	<br>
	TIKI EXPRESS : $jml_tiki_express
	<br>
	TIKI REGULER : $jml_tiki_reguler
	<hr>";
	
	
	
	
	

	
	/*
	//cek
	$qcc = mysql_query("SELECT * FROM ongkirnya ".
							"WHERE propinsi1 = '$epropinsi1' ".
							"AND kota1 = '$ekota1' ".
							"AND kec1 = '$ekec1' ".
							"AND propinsi2 = '$epropinsi2' ".
							"AND kota2 = '$ekota2' ".
							"AND kec2 = '$ekec2'");
	$tcc = mysql_num_rows($qcc);
	
	

		//insert maneh...	
		mysql_query("INSERT INTO ongkirnya(kd, propinsi1, kota1, kec1, propinsi2, kota2, kec2, ".
					"jml_kota1, jml_kec1, jml_kota2, jml_kec2, jml_prop, jml_total, ".
					"jne_yes, jne_reg, pos_express, pos_kilat, tiki_express, tiki_reguler, postdate) VALUES ".
					"('$kdnya', '$ku_nama', '$ku2_nama', '$ku3_nama', '$kuu_nama', '$kuu2_nama', '$kuu3_nama', ".
					"'$ku2_ongkir', '$ku3_ongkir', '$kuu2_ongkir', '$kuu3_ongkir', '$jml_prop', '$jml_total', ".
					"'$jml_jne_yes', '$jml_jne_reg', '$jml_pos_express', '$jml_pos_kilat', '$jml_tiki_express', '$jml_tiki_reguler', '$today')");
	*/

	
	
			
	}




echo '</form>
<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();


require("../inc/niltpl.php");


//diskonek
exit();
?>