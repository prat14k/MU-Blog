<?php
$post=$_POST['post'];
echo $post;
$handle = fopen("words.txt", "r");
$i=0;
while($line=fscanf($handle,"%s %s %s\n"))
{
	$words[$i]=$line;
	$i++;
}
$post_breaked=explode(" ",$post);
$size_post=count($post_breaked);
$size_words=count($words);
//echo $post_breaked[3];
//echo strcasecmp($post_breaked[3],$words[3][0]);
//echo "<pre>";
for($i=0;$i<$size_post;$i++)
{
	for($j=0;$j<$size_words;$j++)
	{
		//echo strcasecmp($post_breaked[$i],$words[$j][0]);
		//echo $post_breaked[$i]." ".$words[$j][0];
		//echo strcasecmp($post_breaked[$i],$words[$j][0]);
		//echo strlen($post_breaked[$i]);
		if(strlen($post_breaked[$i])==$words[$j][1])
		{
			if(strcasecmp($post_breaked[$i],$words[$j][0])==0)
			{
				$post_breaked[$i]=$words[$j][2];
			}
		}
	}
}
$post=implode(" ",$post_breaked);
echo $post;
//echo "<pre>";
//print_r($post_breaked);
//print_r($words);
?>