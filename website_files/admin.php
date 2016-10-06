<?php 
include('connection.php');
session_start();
if(isset($_SESSION['VAL']))
	$val=$_SESSION['VAL'];
else 
	$val=0;
if($_SERVER['REQUEST_METHOD']=="POST"){
	if((isset($_POST['user']))&&(isset($_POST['pass']))){
	$user=$_POST['user'];
	$pass= $_POST['pass'];
	$_SESSION['VAL']=0;
		if(($user == "gtambi")&&($pass=="gtambi")||($user == "14k")&&($pass=="14k"))
		{
			$val=1;
		}
	
	}

	else if((isset($_POST['details']))&&(isset($_POST['keywords']))){
	
		$val=2;
	}
}
?>
<!DOCTYPE html>
<html lang="en-us">
<meta charset="utf-8" />
<head>
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php 
if($val!=0){
	if($val==1){
		$_SESSION['VAL']=1;
?>
			<div class="form" style="display:inline-block">
						<form action="enter_ads.php" method="post" enctype="multipart/form-data">
				
				<input type="text" name="keywords" placeholder="keywords" height="200px" width="120px" >  
				<input type="text" name="name" placeholder="file name" height="200px" width="120px" > 
				<input type="text" name="details" placeholder="details" height="200px" width="120px" > 
				<input type="text" name="link" placeholder="link" height="200px" width="120px" > 
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <input type="submit" value="Upload " name="submit">
		</form>
		</div>
		<?php

	}
	die();
}


?>
<div class="form">
<div class="header"><h2>Admin Sign In</h2></div>
<div class="login">
<form method="post" action="">

<input type="text" name="user" required class="text" placeholder="User Name Or Email"/>
<input type="password" name="pass" required class="text" placeholder="User Password"/>

<input type="submit" value="LOGIN" >
</form>
<!--
<div class="social">
<a href="#"><div class="fb"><i class="fa fa-facebook-f"></i> &nbsp; Login With Facebook</div></a>
<a href="#"><div class="tw"><i class="fa fa-twitter"></i> &nbsp;  Login With Twitter</div></a>
</div>
</div><br/>
<div class="sign">
<div class="need">Need new account ?</div>
<div class="up"><a href="">Sign Up</a></div>
-->
</div>
</div>

</body>
</html>