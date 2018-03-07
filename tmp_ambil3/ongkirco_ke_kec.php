<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");
require("../inc/class/simple_html_dom.php");



nocache;


$filenya = "ongkirco_ke_kec.php";


$jml_detik = 5000;



$qcc2 = mysql_query("SELECT * FROM situs_ongkirco ".
						"WHERE ongkir_jne <> '' ".
						"AND kota1 <> '' ".
						"AND kota2 <> '' ".						
						"ORDER BY RAND()");
$rcc2 = mysql_fetch_assoc($qcc2);
$cc2_kd = nosql($rcc2['kd']);
$cc2_ongkir = nosql($rcc2['ongkir_jne']);
$cc2_kota1 = balikin($rcc2['kota1']);
$cc2_kota2 = balikin($rcc2['kota2']);




//dapatkan ID kabupaten/kota nya...
$qku = mysql_query("SELECT * FROM kabupaten ".
					"WHERE nama = '$cc2_kota1'");
$rku = mysql_fetch_assoc($qku);
$ku_idkab = nosql($rku['id_kab']);
$ku_idprov = nosql($rku['id_prov']);

//provinsi
$qkuu = mysql_query("SELECT * FROM provinsi ".
						"WHERE id_prov = '$ku_idprov'");
$rkuu = mysql_fetch_assoc($qkuu);
$kuu_nama = balikin($rkuu['nama']);

	


//dapatkan ID kabupaten/kota nya...
$qku2 = mysql_query("SELECT * FROM kabupaten ".
					"WHERE nama = '$cc2_kota2'");
$rku2 = mysql_fetch_assoc($qku2);
$ku2_idkab = nosql($rku2['id_kab']);
$ku2_idprov = nosql($rku2['id_prov']);

//provinsi
$qkuu2 = mysql_query("SELECT * FROM provinsi ".
						"WHERE id_prov = '$ku2_idprov'");
$rkuu2 = mysql_fetch_assoc($qkuu2);
$kuu2_nama = balikin($rkuu2['nama']);


echo "[$kuu_nama]. $cc2_kota1 -> [$kuu2_nama]. $cc2_kota2
<br>
[ongkir antar kota : $cc2_ongkir].
<hr>";


//tampilkan daftar kecamatan
$qku = mysql_query("SELECT * FROM kecamatan ".
					"WHERE id_kab = '$ku_idkab'");
$rku = mysql_fetch_assoc($qku);

do
	{
	$ku_idkec = nosql($rku['id_kec']);
	$ku_namakec = balikin($rku['nama']);
	$ku_ongkir = nosql($rku['ongkir']);

	echo "$ku_idkec. $ku_namakec. [ongkir $ku_ongkir]. 
	<br>";
	
		
	//tampilkan daftar kecamatan
	$qku21 = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kab = '$ku2_idkab'");
	$rku21 = mysql_fetch_assoc($qku21);
	
	do
		{
		$ku21_idkec = nosql($rku21['id_kec']);
		$ku21_namakec = balikin($rku21['nama']);
		$ku21_ongkir = nosql($rku21['ongkir']);
	
		echo "tujuan -> $ku21_idkec. $ku21_namakec. [ongkir $ku21_ongkir]. 
		<br>";
		
	
		$nomernya = $nomernya + 1;
		$xyz = md5("$x$nomernya$menit$detik");		
		
		

		//simpan ke database...
		//total
		$jml_total = round($cc2_ongkir + $ku_ongkir + $ku21_ongkir);
		$jml_jne_yes = $jml_total;

		
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
		
		
		
		


		//cek
		$qcc = mysql_query("SELECT * FROM ongkirnya ".
								"WHERE propinsi1 = '$kuu_nama' ".
								"AND kota1 = '$cc2_kota1' ".
								"AND kec1 = '$ku_namakec' ".
								"AND propinsi2 = '$kuu2_nama' ".
								"AND kota2 = '$cc2_kota2' ".
								"AND kec2 = '$ku21_namakec'");
		$rcc = mysql_fetch_assoc($qcc);
		$tcc = mysql_num_rows($qcc);
		$cc_kd = nosql($rcc['kd']);
		
		
		echo "<hr>$cc_kd
		<hr>";

	
		//jika null
		if (empty($tcc))
			{
			//insert maneh...	
			mysql_query("INSERT INTO ongkirnya(kd, propinsi1, kota1, kec1, propinsi2, kota2, kec2, ".
							"jne_yes, jne_reg, pos_express, pos_kilat, tiki_express, tiki_reguler, postdate) VALUES ".
							"('$xyz', '$kuu_nama', '$cc2_kota1', '$ku_namakec', '$kuu2_nama', '$cc2_kota1', '$ku21_namakec', ".
							"'$jml_jne_yes', '$jml_jne_reg', '$jml_pos_express', '$jml_pos_kilat', '$jml_tiki_express', '$jml_tiki_reg', '$today')");
			}

		else
			{
			//update
			mysql_query("UPDATE ongkirnya SET propinsi1 = '$kuu_nama', ". 
							"kota1 = '$cc2_kota1', ".
							"kec1 = '$ku_namakec', ".
							"propinsi2 = '$kuu2_nama', ".
							"kota2 = '$cc2_kota1' ".
							"kec2 = '$ku21_namakec', ".
							"jne_yes = '$jml_jne_yes', ".
							"jne_reg = '$jml_jne_reg', ".
							"pos_express = '$jml_pos_express', ".
							"pos_kilat = '$jml_pos_kilat', ".
							"tiki_express = '$jml_tiki_express', ".
							"tiki_reguler = '$jml_tiki_reg', ".
							"postdate = '$today' ".
							"WHERE kd = '$cc_kd'");

			}				

		
		

		
		
		
		
		
				
		}
	while ($rku21 = mysql_fetch_assoc($qku21));
	
	
	
	echo "<hr><br>";
				
	}
while ($rku = mysql_fetch_assoc($qku));








echo "<br><br><br>";






	





$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php




exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
