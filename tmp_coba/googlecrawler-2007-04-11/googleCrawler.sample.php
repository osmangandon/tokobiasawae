<?php
include "googleCrawler.class.php";


$keywordsGot="Cricket";//write the keywords here for search
echo "Search Results for  <b>".$keywordsGot."</b><br>";




	$pageNeed=1;//enter here how many pages you want to crawl

	for($n=0;$n<$pageNeed;$n++)
	{	
		echo "In Page---<b>".($n+1)."</b><br>";
	
		$spider=new googleCrawler($keywordsGot,$n);

	
		
		$spider->getGoogleDivs();
		$links=$spider->getGoogleLinks();
		$titles=$spider->getGoogleTitles();
		$descriptions=$spider->getGoogleDescriptions();
			
		for($i=1;$i<(count($links))+1;$i++)
		{			
			echo "<div><a href=\"".$links[$i]."\">".$titles[$i]."</a><br>";
			echo $descriptions[$i]."</div><br>";	
					
		}
	}
?>
