<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");


nocache;



$filenya = "datakirim.php";



//daftar propinsi
$qku = mysql_query("SELECT * FROM provinsi ".
						"ORDER BY RAND()");
$rku = mysql_fetch_assoc($qku);
$ku_id = balikin($rku['id_prov']);
$ku_nama = cegah($rku['nama']);


//kabupaten
$qku2 = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$ku_id' ".
						"ORDER BY RAND()");
$rku2 = mysql_fetch_assoc($qku2);
$ku2_nama = cegah($rku2['nama']);









//daftar propinsi
$qku3 = mysql_query("SELECT * FROM provinsi ".
						"ORDER BY RAND()");
$rku3 = mysql_fetch_assoc($qku3);
$ku3_id = balikin($rku3['id_prov']);
$ku3_nama = cegah($rku3['nama']);


//kabupaten
$qku4 = mysql_query("SELECT * FROM kabupaten ".
						"WHERE id_prov = '$ku3_id' ".
						"ORDER BY RAND()");
$rku4 = mysql_fetch_assoc($qku4);
$ku4_nama = cegah($rku4['nama']);





//jadikan pretty
$ku2_namax = seo_friendly_url($ku2_nama);

//hilangkan kata kota
$search = array ("'kota-'");
$replace = array ("");
$ku2_namax2 = preg_replace($search,$replace,$ku2_namax);

//jika kabupaten
$ku2_namax3 = explode("kab-", $ku2_namax2);
$ku2_namax31 = $ku2_namax3[1];


//jika null
if (empty($ku2_namax31))
	{
	$asalnya = "$ku2_namax2";		
	}
else
	{
	$asalnya = "$ku2_namax31-$ku2_namax2";
	}
	
	
	
	
	





$ku4_namax = seo_friendly_url($ku4_nama);

//hilangkan kata kota
$search = array ("'kota-'");
$replace = array ("");
$ku4_namax2 = preg_replace($search,$replace,$ku4_namax);


//jika kabupaten
$ku4_namax3 = explode("kab-", $ku4_namax2);
$ku4_namax31 = $ku4_namax3[1];

//jika null
if (empty($ku4_namax31))
	{
	$tujuannya = "$ku4_namax2";		
	}
else
	{
	$tujuannya = "$ku4_namax31-$ku4_namax2";
	}






//jadikan url
http://cektarif.com/ongkir-jne-ketapang-kab-ketapang-ke-jakarta-selatan-1-2018.html

$kenya = "http://cektarif.com/ongkir-jne-$asalnya-ke-$tujuannya-1-2018.html";




/*
echo "<p>
$ku_nama [$ku2_nama] -> $ku3_nama [$ku4_nama]
</p>

<p>
[$ku2_namax2 : $ku2_namax31] -> [$ku4_namax2 : $ku4_namax31]
</p>
<hr>

<p>
$kenya
</p>";
*/




//dapatkan ongkir jne
//1. dari cektarif.com
//2. bila gak ada, ambil dari ongkir.co
//3. ambil dari google


echo "<p>
$ku_nama [$ku2_nama] -> $ku3_nama [$ku4_nama]
</p>";



//masukkan database
$kdnya = md5("$ku_nama$ku2_nama$ku3_nama$ku4_nama");


//cek
$qcc = mysql_query("SELECT * FROM antar_kota ".
						"WHERE kd = '$kdnya'");
$tcc = mysql_num_rows($qcc);


//jika null
if (empty($tcc))
	{
	mysql_query("INSERT INTO antar_kota(kd, propinsi1, kota1, propinsi2, kota2, postdate) VALUES ".
					"('$kdnya', '$ku_nama', '$ku2_nama', '$ku3_nama', '$ku4_nama', '$today')");
	}




?>
<script>setTimeout("location.href='<?php echo $filenya;?>'", 1000);</script>

<?php




exit();
?>