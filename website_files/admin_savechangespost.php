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
//echo $post;
$d=date("Y-m-d");
$t=date("H:i:s");
$q="update posts set postdate='$d',posttime='$t',postcontent='$post',postname='$postname',postcategoryid='$categoryid' where postid=$postid";
$r=mysql_query($q) or die(mysql_error());
header('Location:admin_allposts.php');
/*
$q="select * from posts where postid=2";
$r=mysql_query($q);
while($row=mysql_fetch_array($r))
{
	
}
*/
?>