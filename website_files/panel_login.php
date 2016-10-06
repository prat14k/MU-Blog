<!doctype html>
<html lang="en">
    
<head>
<meta charset="UTF-8">
<script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">

        <title>MU Blogging Panel Login Page</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- bootstrap framework -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!-- google webfonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- elegant icons -->
        <link href="assets/icons/elegant/style.css" rel="stylesheet" media="screen">
        <!-- main stylesheet -->
		<link href="assets/css/main.min.css" rel="stylesheet" media="screen">

        <!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>

<?php
include('connection.php');
	if(isset($_POST['submit']))
	{
		$r=mysql_query("select * from users where username='$_POST[username]' and password='$_POST[password]'");
		//echo "hi";
		//die();
		if(mysql_num_rows($r)>0)
		{
			session_start();
			$row=mysql_fetch_array($r);
			$_SESSION['userid']=$row['userid'];
			$_SESSION['username']=$row['username'];
			header('location: user_panel.php');
		}
		else
		{
			echo "<script>sweetAlert('Ooops..!!','your username or password is wrong','error');</script>";
			?>
			<script>
			window.location='panel_login.php';
			</script>
			<?php
		}
	}
?>
        
    </head>
    <body class="login_page">

        <div class="login_header" style="background:black;">
           <a href="index.php"> <img src="ic_launcher.png" alt="site_logo"> </a>
        </div>
        <div class="login_register_form">
            <div class="form_wrapper animated-short" id="login_form">
                <h3 class="sepH_c"><span>Login</span> \ <a href="javascript:void(0)" class="form-switch" data-switch-form="register_form">Register</a></h3>
                <form action="panel_login.php" method="post">
                    <div class="input-group input-group-lg sepH_a">
                        <span class="input-group-addon"><span class="icon_profile"></span></span>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><span class="icon_key_alt"></span></span>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="sepH_c text-right">
                        <a href="javascript:void(0)" class="small">Forgot password?</a>
                    </div>
                    <div class="form-group sepH_c">
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Log In" name="submit">
                    </div>
                </form>
            </div>
            <div class="form_wrapper animated-short" id="register_form" style="display:none">
                <h3 class="sepH_c"><span>Register</span> \ <a href="javascript:void(0)" class="form-switch" data-switch-form="login_form">Login</a></h3>
                <form action="#">
                    <div class="input-group input-group-lg sepH_a">
                        <span class="input-group-addon"><span class="icon_profile"></span></span>
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group input-group-lg sepH_a">
                        <span class="input-group-addon"><span class="icon_key_alt"></span></span>
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="input-group input-group-lg sepH_c">
                        <span class="input-group-addon"><span class="icon_mail_alt"></span></span>
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group sepH_c">
                        <a href="dashboard.html" class="btn btn-lg btn-success btn-block">Register</a>
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(function () {
                $('.form-switch').on('click', function (e) {
                    e.preventDefault();

                    var $switchTo = $(this).data('switchForm'),
                        $thisForm = $(this).closest('.form_wrapper');

                    $('.form_wrapper').removeClass('fadeInUpBig');
                    $thisForm.addClass('fadeOutDownBig');

                    setTimeout(function () {
                        $thisForm.removeClass('fadeOutDownBig').hide();
                        $('#' + $switchTo).show().addClass('fadeInUpBig');
                    }, 300);

                });
            });
        </script>
        
        <script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','../../www.google-analytics.com/analytics.js','ga');
		  
			ga('create', 'UA-54304677-1', 'auto');
			ga('send', 'pageview');
		</script>
	
    </body>

<!-- Mirrored from yukon-admin.tzdthemes.com/html/login_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 11:38:28 GMT -->
</html>