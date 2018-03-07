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
$eprop1 = cegah($rowstx['nama']);

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
$ekota1 = cegah($rowstx['nama']);

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
$ekec1 = cegah($rowstx['nama']);

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
$eprop2 = cegah($rowstx['nama']);

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
$ekota2 = cegah($rowstx['nama']);

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
$ekec2 = cegah($rowstx['nama']);

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
	$ku_kab_jne_yes = nosql($rku['ongkir_jne_yes']);
	$ku_kab_jne_reg = nosql($rku['ongkir_jne_reg']);
	$ku_kab_pos_express = nosql($rku['ongkir_pos_express']);
	$ku_kab_pos_kilat = nosql($rku['ongkir_pos_kilat']);
	$ku_kab_tiki_express = nosql($rku['ongkir_tiki_express']);
	$ku_kab_tiki_reg = nosql($rku['ongkir_tiki_reguler']);
	
	$qku = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kec = '$kec1'");
	$rku = mysql_fetch_assoc($qku);
	$ku_kec = nosql($rku['ongkir']);
	$ku_kec_jne_yes = nosql($rku['ongkir_jne_yes']);
	$ku_kec_jne_reg = nosql($rku['ongkir_jne_reg']);
	$ku_kec_pos_express = nosql($rku['ongkir_pos_express']);
	$ku_kec_pos_kilat = nosql($rku['ongkir_pos_kilat']);
	$ku_kec_tiki_express = nosql($rku['ongkir_tiki_express']);
	$ku_kec_tiki_reg = nosql($rku['ongkir_tiki_reguler']);




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
	$ku2_kab_jne_yes = nosql($rku2['ongkir_jne_yes']);
	$ku2_kab_jne_reg = nosql($rku2['ongkir_jne_reg']);
	$ku2_kab_pos_express = nosql($rku2['ongkir_pos_express']);
	$ku2_kab_pos_kilat = nosql($rku2['ongkir_pos_kilat']);
	$ku2_kab_tiki_express = nosql($rku2['ongkir_tiki_express']);
	$ku2_kab_tiki_reg = nosql($rku2['ongkir_tiki_reguler']);
	
	$qku2 = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kec = '$kec2'");
	$rku2 = mysql_fetch_assoc($qku2);
	$ku2_kec = nosql($rku2['ongkir']);
	$ku2_kec_jne_yes = nosql($rku2['ongkir_jne_yes']);
	$ku2_kec_jne_reg = nosql($rku2['ongkir_jne_reg']);
	$ku2_kec_pos_express = nosql($rku2['ongkir_pos_express']);
	$ku2_kec_pos_kilat = nosql($rku2['ongkir_pos_kilat']);
	$ku2_kec_tiki_express = nosql($rku2['ongkir_tiki_express']);
	$ku2_kec_tiki_reg = nosql($rku2['ongkir_tiki_reguler']);




	
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
		$ongkirya_jne_yes = round($ku_kab_jne_yes + $ku_kec_jne_yes + $ku2_kab_jne_yes + $ku2_kec_jne_yes);
		$ongkirya_jne_reg = round($ku_kab_jne_reg + $ku_kec_jne_reg + $ku2_kab_jne_reg + $ku2_kec_jne_reg);
		$ongkirya_pos_express = round($ku_kab_pos_express + $ku_kec_pos_express + $ku2_kab_pos_express + $ku2_kec_pos_express);
		$ongkirya_pos_kilat = round($ku_kab_pos_kilat + $ku_kec_pos_kilat + $ku2_kab_pos_kilat + $ku2_kec_pos_kilat);
		$ongkirya_tiki_express = round($ku_kab_tiki_express + $ku_kec_tiki_express + $ku2_kab_tiki_express + $ku2_kec_tiki_express);
		$ongkirya_tiki_reg = round($ku_kab_tiki_reg + $ku_kec_tiki_reg + $ku2_kab_tiki_reg + $ku2_kec_tiki_reg);
		}
	
	//jika kabupaten sama
	else if ($kota1 == $kota2)
		{
		$ongkirya_jne_yes = round($ku_kec_jne_yes + $ku2_kec_jne_yes);
		$ongkirya_jne_reg = round($ku_kec_jne_reg + $ku2_kec_jne_reg);
		$ongkirya_pos_express = round($ku_kec_pos_express + $ku2_kec_pos_express);
		$ongkirya_pos_kilat = round($ku_kec_pos_kilat + $ku2_kec_pos_kilat);
		$ongkirya_tiki_express = round($ku_kec_tiki_express + $ku2_kec_tiki_express);
		$ongkirya_tiki_reg = round($ku_kec_tiki_reg + $ku2_kec_tiki_reg);
		}
	else
		{
		//total
		$ongkirya_jne_yes = round($ku_kab_jne_yes + $ku_kec_jne_yes + $ku2_kab_jne_yes + $ku2_kec_jne_yes + $ongkir_prop);
		$ongkirya_jne_reg = round($ku_kab_jne_reg + $ku_kec_jne_reg + $ku2_kab_jne_reg + $ku2_kec_jne_reg + $ongkir_prop);
		$ongkirya_pos_express = round($ku_kab_pos_express + $ku_kec_pos_express + $ku2_kab_pos_express + $ku2_kec_pos_express + $ongkir_prop);
		$ongkirya_pos_kilat = round($ku_kab_pos_kilat + $ku_kec_pos_kilat + $ku2_kab_pos_kilat + $ku2_kec_pos_kilat + $ongkir_prop);
		$ongkirya_tiki_express = round($ku_kab_tiki_express + $ku_kec_tiki_express + $ku2_kab_tiki_express + $ku2_kec_tiki_express + $ongkir_prop);
		$ongkirya_tiki_reg = round($ku_kab_tiki_reg + $ku_kec_tiki_reg + $ku2_kab_tiki_reg + $ku2_kec_tiki_reg + $ongkir_prop);
		}



	//cek
	$qcc = mysql_query("SELECT * FROM ongkirnya ".
							"WHERE propinsi1 = '$eprop1' ".
							"AND kota1 = '$ekota1' ".
							"AND kec1 = '$ekec1' ".
							"AND propinsi2 = '$eprop2' ".
							"AND kota2 = '$ekota2' ".
							"AND kec2 = '$ekec2'");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);
	

	//jika null
	if (empty($tcc))
		{
		//insert maneh...	
		mysql_query("INSERT INTO ongkirnya(kd, propinsi1, kota1, kec1, propinsi2, kota2, kec2, ".
						"jne_yes, jne_reg, pos_express, pos_kilat, tiki_express, tiki_reguler, postdate) VALUES ".
						"('$x', '$eprop1', '$ekota1', '$ekec1', '$eprop2', '$ekota2', '$ekec2', ".
						"'$ongkirya_jne_yes', '$ongkirya_jne_reg', '$ongkirya_pos_express', '$ongkirya_pos_kilat', '$ongkirya_tiki_express', '$ongkirya_tiki_reg', '$today')");
		}

	





	//cek
	$qcc = mysql_query("SELECT * FROM ongkirnya ".
							"WHERE propinsi1 = '$eprop1' ".
							"AND kota1 = '$ekota1' ".
							"AND kec1 = '$ekec1' ".
							"AND propinsi2 = '$eprop2' ".
							"AND kota2 = '$ekota2' ".
							"AND kec2 = '$ekec2'");
	$rcc = mysql_fetch_assoc($qcc);
	$ku_kec_jne_yes = nosql($rcc['jne_yes']);
	$ku_kec_jne_reg = nosql($rcc['jne_reg']);
	$ku_kec_pos_express = nosql($rcc['pos_express']);
	$ku_kec_pos_kilat = nosql($rcc['pos_kilat']);
	$ku_kec_tiki_express = nosql($rcc['tiki_express']);
	$ku_kec_tiki_reg = nosql($rcc['tiki_reguler']);






	
	
	echo "JNE YES : $ku_kec_jne_yes
	<br>
	JNE REG : $ku_kec_jne_reg
	<br>
	POS EXPRESS : $ku_kec_pos_express
	<br>
	POS KILAT : $ku_kec_pos_kilat
	<br>
	TIKI EXPRESS : $ku_kec_tiki_express
	<br>
	TIKI REGULER : $ku_kec_tiki_reg
	<hr>";
	
	
	
	
	

	
	
			
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