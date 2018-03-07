<?php
session_start();


ini_set('max_execution_time', 0);



//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");
	


nocache;

//nilai
$filenya = "ongkirco_nama.php";
$judul = "set nama, nama2";
$judulku = $judul;
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}




$jml_detik = 5000;
$limit = 100;



//lanjutkan ke halaman berikutnya
$ke = $filenya;
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php







//query
$p = new Pager();
$start = $p->findStart($limit);

$kuerine = "SELECT * FROM situs_ongkirco ".
				"WHERE nama = '' ".
				"ORDER BY RAND()";
$sqlcount = $kuerine;
$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);



do
	{
	$d_kd = nosql($data['kd']);
	$d_urlnya = balikin($data['urlnya']);
			
	//pecah
	$ku_d = explode("/", $d_urlnya);
	$ku_d1 = $ku_d[4];
	
	
	$ku_e = explode("-ke-", $ku_d1);
	$ku_e1 = $ku_e[0];
	$ku_e2 = $ku_e[1];
	
	
	//dari	
	$ku_f = explode("-", $ku_e1);
	$ku_f1 = trim($ku_f[2]);
	$ku_f2 = trim($ku_f[3]);
	$ku_f3 = trim($ku_f[4]);
	$ku_f4 = trim($ku_f[5]);
	$ku_f5 = trim($ku_f[6]);
	$ku_f6 = trim($ku_f[7]);

	$ku_dari = trim("$ku_f1 $ku_f2 $ku_f3 $ku_f4 $ku_f5 $ku_f6");

	
	
	//tujuan	
	$ku_g = explode("-", $ku_e2);
	$ku_g1 = trim($ku_g[0]);
	$ku_g2 = trim($ku_g[1]);
	$ku_g3 = trim($ku_g[2]);
	$ku_g4 = trim($ku_g[3]);
	$ku_g5 = trim($ku_g[4]);
	$ku_g6 = trim($ku_g[5]);

	$ku_tujuan = trim("$ku_g1 $ku_g2 $ku_g3 $ku_g4 $ku_g5 $ku_g6");
		
				
		
	//update
	mysql_query("UPDATE situs_ongkirco SET nama = '$ku_dari', ".
					"nama2 = '$ku_tujuan' ".
					"WHERE kd = '$d_kd'");	
	
	
	echo "<p>
	$d_urlnya
	<br>
	[$ku_dari]. [$ku_tujuan]
	</p>";
	}
while ($data = mysql_fetch_assoc($result));








exit();
?>