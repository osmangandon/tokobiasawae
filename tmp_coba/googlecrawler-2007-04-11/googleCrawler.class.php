<?php
/*
This is the class for google crawler
it only takes the keywords and pageNumbers as parameters of the constructor and 
crawls in the google search results for links,titles and descriptions
you can use this crawler in your site as search engine(not real,but will search through google)
*/
class googleCrawler
{
	var $content;
	var $divs;
		
	function googleCrawler($keywordsGot,$pageNum)
	{	
		if(substr_count($keywordsGot,' ')>0)
			$keywords=str_replace(' ','+',$keywordsGot);
		else 
			$keywords=$keywordsGot;
		
		if($pageNum==0)
			$this->content=file_get_contents("http://www.google.com/search?q=".$keywords);
		else
		{
			$index=($pageNum*10);
			$this->content=file_get_contents("http://www.google.com/search?q=".$keywords."&start=".$index);
		}		
			
				
	}
	
	
	function getGoogleDivs()
	{					
			$j = 0;
			for ($i=0;$i<=strlen($this->content);$i++)
			{				
				if (substr($this->content,$i,strlen('<div class=g'))=='<div class=g') 
				{
					$j++;
					$st=$i;//+strlen('<div class=g>')+1;
					$k=$i;
					while (substr($this->content,$k,strlen('</div>'))!='</div>')
					{
						$k++;
					}
					$en=$k+strlen('</div>');
					$this->divs[$j]=substr($this->content,$st,$en-$st);
				}			
			}		
										
	}
	
	
	function getGoogleLinks()
	
	{
		
			for($n=1;$n<count($this->divs)+1;$n++)
			{		
				for ($i=0;$i<=strlen($this->divs[$n]);$i++)
				{				
					if (substr($this->divs[$n],$i,strlen('<h2 class=r>'))=='<h2 class=r>') 
					{					
						$st=$i+strlen('<h2 class=r><a href=')+1;
						
						$k=$i;
						while (substr($this->divs[$n],$k,strlen(' class=l'))!=' class=l')
						{
							$k++;
						}
						$en=$k-1;
						$links[$n]=substr($this->divs[$n],$st,$en-$st);
					}			
				}	
			}
			
			return $links;	
	}
	
	function getGoogleTitles()
	
	{
		
			for($n=1;$n<count($this->divs)+1;$n++)
			{		
				for ($i=0;$i<=strlen($this->divs[$n]);$i++)
				{				
					if (substr($this->divs[$n],$i,strlen('<h2 class=r>'))=='<h2 class=r>') 
					{					
						$st=$i+strlen('<h2 class=r><a href=')+1;
						
						$k=$i;
						while (substr($this->divs[$n],$k,strlen('</a>'))!='</a>')
						{
							$k++;
						}
						$en=$k;
						$allParts[$n]=substr($this->divs[$n],$st,$en-$st)."end$";
					}			
				}	
			}
			
			for($n=1;$n<count($allParts)+1;$n++)
			{
				$withoutB=str_replace('<b>','',$allParts[$n]);
				$withoutBold[$n]=str_replace('</b>','',$withoutB);
			}
			
			for($n=1;$n<count($withoutBold)+1;$n++)
			{
				for ($i=0;$i<=strlen($withoutBold[$n]);$i++)
				{				
					if (substr($withoutBold[$n],$i,strlen('>'))=='>') 
					{					
						$st=$i+1;
						
						$k=$i;
						while (substr($withoutBold[$n],$k,strlen('end$'))!='end$')
						{
							$k++;
						}
						$en=$k;
						$titles[$n]=substr($withoutBold[$n],$st,$en-$st);
					}			
				}	
			}
			return $titles;	
	}
	
	function getGoogleDescriptions()
	
	{
		
			for($n=1;$n<count($this->divs)+1;$n++)
			{		
				for ($i=0;$i<=strlen($this->divs[$n]);$i++)
				{				
					if (substr($this->divs[$n],$i,strlen('<font size=-1>'))=='<font size=-1>') 
					{					
						$st=$i+strlen('<font size=-1>');
						
						$k=$i;
						while (substr($this->divs[$n],$k,strlen('<span class=a>'))!='<span class=a>')
						{
							$k++;
						}
						$en=$k;
						$descriptions[$n]=substr($this->divs[$n],$st,$en-$st);
					}			
				}	
			}
			
			return $descriptions;	
	}
	
	
}
?>