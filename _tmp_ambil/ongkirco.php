<?php
sleep(1);

require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");
require("../inc/class/simple_html_dom.php");

nocache;


$filenya = "ongkirco.php";
$page = nosql($_REQUEST['page']);

//jika null, anggap page 1
if (empty($page))
	{
	$page = 1;
	}



$jml_detik = 5000;




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$cc_url_asli = "http://ongkir.co/ongkir/$page.html";

$base = $cc_url_asli;



$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_URL, $base);
curl_setopt($curl, CURLOPT_REFERER, $base);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$str = curl_exec($curl);
curl_close($curl);








// Create a DOM object
$html_base = new simple_html_dom();

// Load HTML from a string
$grab = $html_base->load($str);



//isinya........
$start = "<table class=\"table\">";
$end   = "<center><span class=\"pagination pagination-centered\">";



$startPosisition = strpos($grab, $start);
$endPosisition   = strpos($grab, $end); 

$longText = $endPosisition - $startPosisition;

$result = substr($grab, $startPosisition, $longText);







// Create a DOM object
$html_base = new simple_html_dom();
// Load HTML from a string
$html_base->load($result);

//get all category links
foreach($html_base->find('a') as $element) {
	
	$nilku = trim($element->href);


	echo "$nilku <br>";
	
	//yg udah masuk
	$qcc2 = mysql_query("SELECT * FROM ongkirnya ".
							"WHERE urlnya = '$nilku'");
	$rcc2 = mysql_fetch_assoc($qcc2);
	$tcc2 = mysql_num_rows($qcc2);
	
	//jika null
	if (empty($tcc2))
		{
		//insert
		mysql_query("INSERT INTO ongkirco(urlnya, postdate) VALUES ".
						"('$nilku', '$today')");
		}

	}



$html_base->clear(); 
unset($html_base);





//lanjutkan ke halaman berikutnya
$page = $page + 1;

$ke = "$filenya?page=$page";
?>
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php




exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>