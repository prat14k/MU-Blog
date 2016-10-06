<?php

class ads{
	public $word;
	public $count_of;
    public function __toString()
    {
        return $this->word;
    }

}
function cmp($a,$b)
{
	return $b->count_of - $a->count_of;
}

$handle = fopen("adds.txt", "r");
$i=0;
while($line=fscanf($handle,"%s\n"))
{
	$adds[$i]=$line;
	$i++;
}
$size_text=$i;
$ad[]=new ads();
for($i=0;$i<$size_text;$i++)
{
	$ad[$i]=new stdClass();
	$ad[$i]->word=$adds[$i][0];
	$ad[$i]->count_of=0;
}
//print_r($adds);
//start

$string=$add_string;
//end
$str=array();
$str=explode(" ",$string);
$size=count($str);

for($i=0;$i<$size;$i++)
{
	for($j=0;$j<$size_text;$j++)
	{		
        if(strcasecmp($str[$i],$ad[$j]->word)==0)
		{
			$ad[$j]->count_of++;
		}
	}
}
usort($ad,"cmp");//till here we get the words in decreasing order of their appearence
$a=$ad[0]->word;
$r=mysql_query("select * from ads where keyword LIKE '%|$a|%' OR keyword LIKE '%|$a' OR keyword LIKE '$a|%' OR keyword LIKE '$a'") or die(mysql_error());
$i=0;
while(($row=mysql_fetch_array($r)) && $i<2)
{

	echo "<a target='blank' href='".$row['link']."'><img src='ads/".$row['pic']."' alt='".$row['pic']."' style=\"height:100px;width:600px; \"></img></a><br>";
	$i++;
}

//print_r($ad);
?>