<?php
require('connection.php');
session_start();
$postid=$_POST['postid'];
$post=$_POST['editor1'];
//echo $post;
$userid=$_SESSION['userid'];
//echo $userid;
$postname=$_POST['postname'];
$categoryname=$_POST['category'];
//echo $categoryname;
$q="select * from category where categoryname='$categoryname'";
$r=mysql_query($q);
$row=mysql_fetch_array($r);

$categoryid=$row['categoryid'];

$q="select * from users where userid='$userid'";
$r=mysql_query($q);
while($row=mysql_fetch_array($r))
{
	$username=$row['username'];
}
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

if (preg_match_all('/(^|)(#\w+)/', $post, $arrHashtags) > 0) {
  foreach ($arrHashtags[2] as $strHashtag) {
    // Check each tag to see if there are letters or an underscore in there somewhere
    if (preg_match('/#\d*[a-z_]+/i', $strHashtag)) {
      $post= str_replace($strHashtag, '<a href="searchtags.php?tag=#'.substr($strHashtag, 1).'"> '.$strHashtag.' </a>', $post);
    }
  }
}



echo $post;

$d=date("Y-m-d");
$t=date("H:i:s");
$q="update posts set postdate='$d',posttime='$t',postcontent='$post',postname='$postname',postcategoryid='$categoryid' where postid=$postid";
$r=mysql_query($q) or die(mysql_error());
header('Location:wall.php?authorid='.$userid);
/*
$q="select * from posts where postid=2";
$r=mysql_query($q);
while($row=mysql_fetch_array($r))
{
	echo $row['postcontent'];
}
*/
?>