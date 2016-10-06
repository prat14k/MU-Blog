<?php
	session_start();
	include('connection.php');
	
	$username=$_POST['username'];
	$fullname=$_POST['fullname'];
	$sex=$_POST['sex'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	
	$q="update users set username='$username',`full name`='$fullname',gender='$sex',useremail='$email',mobileno='$mobile' where userid=".$_SESSION['userid'];
	echo $q;
	$r=mysql_query($q) or die(mysql_error());
	if($r)
	{
		header('Location: wall.php?authorid='.$_SESSION['userid']);
		//echo "succesfully updated";
		
	}
	else{
		echo "error updating <a href='edit_details.php'>go back</a>";
	}
?>