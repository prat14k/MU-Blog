<?php
include('connection.php');
session_start();

$postid=$_GET['postid'];

$q="delete from posts where postid=$postid";
$r=mysql_query($q) or die(mysql_error());
header("Location: admin_allposts.php");
?>