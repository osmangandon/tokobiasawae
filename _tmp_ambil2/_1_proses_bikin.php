<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");


nocache;



$filenya = "proses_bikin.php";
$page = nosql($_REQUEST['page']);

//jika null, anggap page 1
if (empty($page))
	{
	$page = 1;
	}



$jml_detik = 5000;



//daftar propinsi
$qku = mysql_query("SELECT * FROM provinsi ".
						"ORDER BY RAND()");
$rku = mysql_fetch_assoc($qku);
$ku_id = balikin($rku['id_prov']);
$ku_nama = cegah($rku['nama']);
$ku_urutan = cegah($rku['urutan']);


//kabupaten
$qku2 = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$ku_id' ".
						"ORDER BY RAND()");
$rku2 = mysql_fetch_assoc($qku2);
$ku2_idkab = cegah($rku2['id_kab']);
$ku2_nama = cegah($rku2['nama']);
$ku2_ongkir = cegah($rku2['ongkir']);


//kecamatan
$qku3 = mysql_query("SELECT * FROM kecamatan ".
						"WHERE id_kab = '$ku2_idkab' ".
						"ORDER BY RAND()");
$rku3 = mysql_fetch_assoc($qku3);
$ku3_idkab = cegah($rku3['id_kec']);
$ku3_nama = cegah($rku3['nama']);
$ku3_ongkir = cegah($rku3['ongkir']);












//daftar propinsi
$qkuu = mysql_query("SELECT * FROM provinsi ".
						"ORDER BY RAND()");
$rkuu = mysql_fetch_assoc($qkuu);
$kuu_id = balikin($rkuu['id_prov']);
$kuu_nama = cegah($rkuu['nama']);
$kuu_urutan = cegah($rkuu['urutan']);


//kabupaten
$qkuu2 = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$kuu_id' ".
						"ORDER BY RAND()");
$rkuu2 = mysql_fetch_assoc($qkuu2);
$kuu2_idkab = cegah($rkuu2['id_kab']);
$kuu2_nama = cegah($rkuu2['nama']);
$kuu2_ongkir = cegah($rkuu2['ongkir']);


//kecamatan
$qkuu3 = mysql_query("SELECT * FROM kecamatan ".
						"WHERE id_kab = '$kuu2_idkab' ".
						"ORDER BY RAND()");
$rkuu3 = mysql_fetch_assoc($qkuu3);
$kuu3_idkab = cegah($rkuu3['id_kec']);
$kuu3_nama = cegah($rkuu3['nama']);
$kuu3_ongkir = cegah($rkuu3['ongkir']);






//selisih propinsi
$jml_prop = $kuu_urutan - $ku_urutan;

if ($jml_prop < 0)
	{
	$jml_prop = $ku_urutan - $kuu_urutan;
	}






//jika propinsi sama
if ($ku_id == $kuu_id)
	{
	$jml_total = round($ku2_ongkir + $ku3_ongkir + $kuu2_ongkir + $kuu3_ongkir);
	}

//jika kabupaten sama
else if ($ku2_idkab == $kuu2_idkab)
	{
	$jml_total = round($ku3_ongkir + $kuu3_ongkir);		
	}
else
	{
	//totalnya
	//$jml_total = round($ku2_ongkir + $ku3_ongkir + $kuu2_ongkir + $kuu3_ongkir + ($jml_prop * 5000));
	$jml_total = round($ku2_ongkir + $ku3_ongkir + $kuu2_ongkir + $kuu3_ongkir + ($jml_prop * 3000));
	}




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







echo "<p>
$ku_nama [$ku2_nama] [$ku3_nama] -> $kuu_nama [$kuu2_nama] [$kuu3_nama]
</p>
<hr>
JNE YES : $jml_jne_yes
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





//masukkan database
$kdnya = md5("$ku_nama$ku2_nama$ku3_nama$kuu_nama$kuu2_nama$kuu3_nama");


//cek
$qcc = mysql_query("SELECT * FROM ongkirnya ".
						"WHERE kd = '$kdnya'");
$tcc = mysql_num_rows($qcc);


//jika null
if (empty($tcc))
	{
	mysql_query("INSERT INTO ongkirnya(kd, propinsi1, kota1, kec1, propinsi2, kota2, kec2, ".
					"jml_kota1, jml_kec1, jml_kota2, jml_kec2, jml_prop, jml_total, ".
					"jne_yes, jne_reg, pos_express, pos_kilat, tiki_express, tiki_reguler, postdate) VALUES ".
					"('$kdnya', '$ku_nama', '$ku2_nama', '$ku3_nama', '$kuu_nama', '$kuu2_nama', '$kuu3_nama', ".
					"'$ku2_ongkir', '$ku3_ongkir', '$kuu2_ongkir', '$kuu3_ongkir', '$jml_prop', '$jml_total', ".
					"'$jml_jne_yes', '$jml_jne_reg', '$jml_pos_express', '$jml_pos_kilat', '$jml_tiki_express', '$jml_tiki_reguler', '$today')");
	}
//nek wes ono, hapus... entri maneh...
else
	{
	//hapus sek
	mysql_query("DELETE FROM ongkirnya WHERE kd = '$kdnya'");
	
	//insert maneh...	
	mysql_query("INSERT INTO ongkirnya(kd, propinsi1, kota1, kec1, propinsi2, kota2, kec2, ".
				"jml_kota1, jml_kec1, jml_kota2, jml_kec2, jml_prop, jml_total, ".
				"jne_yes, jne_reg, pos_express, pos_kilat, tiki_express, tiki_reguler, postdate) VALUES ".
				"('$kdnya', '$ku_nama', '$ku2_nama', '$ku3_nama', '$kuu_nama', '$kuu2_nama', '$kuu3_nama', ".
				"'$ku2_ongkir', '$ku3_ongkir', '$kuu2_ongkir', '$kuu3_ongkir', '$jml_prop', '$jml_total', ".
				"'$jml_jne_yes', '$jml_jne_reg', '$jml_pos_express', '$jml_pos_kilat', '$jml_tiki_express', '$jml_tiki_reguler', '$today')");

	}




?>
<script>setTimeout("location.href='<?php echo $filenya;?>'", 1000);</script>

<?php




exit();
?>