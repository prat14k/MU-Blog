<?php
require('connection.php');
session_start();
$post=$_POST['editor1'];
$userid=$_SESSION['userid'];
$postname=$_POST['postname'];
$categoryname=$_POST['category'];
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
//echo $post;
//if (preg_match_all('/(^|\s)(#\w+)/', $post, $arrHashtags) > 0) {
if (preg_match_all('/(^|)(#\w+)/', $post, $arrHashtags) > 0) {
  foreach ($arrHashtags[2] as $strHashtag) {
    // Check each tag to see if there are letters or an underscore in there somewhere
    if (preg_match('/#\d*[a-z_]+/i', $strHashtag)) {
      $post= str_replace($strHashtag, '<a href="searchtags.php?tag=#'.substr($strHashtag, 1).'"> '.$strHashtag.' </a>', $post);
    }
  }
}

//echo $post;

$d=date("Y-m-d");
$t=date("H:i:s");
$q="insert into posts values(NULL,'$userid','$d','$t','$post','$postname',0,0,NULL,0,'$categoryid',0)";
$r=mysql_query($q) or die(mysql_error());
header('Location:admin_allposts.php');
/*
$q="select * from posts where postid=2";
$r=mysql_query($q);
while($row=mysql_fetch_array($r))
{
	echo $row['postcontent'];
}
*/
?>