<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
		<title>User Panel(dashboard)</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- favicon -->
        <link rel="shortcut icon" href="http://multiuserblog.esy.es/myicon.ico" />
		<!-- notification -->
		<script src="notification/ohsnap.js"></script>		
        <!-- bootstrap framework -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- icon sets -->
            <!-- elegant icons -->
                <link href="assets/icons/elegant/style.css" rel="stylesheet" media="screen">
            <!-- elusive icons -->
                <link href="assets/icons/elusive/css/elusive-webfont.css" rel="stylesheet" media="screen">
            <!-- flags -->
                <link rel="stylesheet" href="assets/icons/flags/flags.css">
            <!-- scrollbar -->
                <link rel="stylesheet" href="assets/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">


        <!-- google webfonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <!-- main stylesheet -->
		<link href="assets/css/main.min.css" rel="stylesheet" media="screen" id="mainCss">

        <!-- moment.js (date library) -->
        <script src="assets/js/moment-with-langs.min.js"></script>
		<script>
		function notification()
		{
			ohSnap('Oh Snap! I cannot process your card...', {color: 'red'}); 
		}
		</script>
		

    </head>
    <body class="side_menu_active side_menu_expanded">
        <div id="page_wrapper">

          <!-- header -->
            <header id="main_header">
                <div class="container-fluid">
                    <div class="brand_section">
                        <a href="usser_panel.php"><img src="ic_launcher.png" alt="site_logo" width="43" height="36"></a>
                    </div>
                     <div class="header_user_actions dropdown">
                        <div data-toggle="dropdown" class="dropdown-toggle user_dropdown">
                            <div class="user_avatar">
                                <img src="assets/img/avatars/avatar08_tn.png" alt="" title="Carrol Clark (carrol@example.com)" width="38" height="38">
                            </div>
                            <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-right">
                            
                            <li><a href="login_page.html">Log Out</a></li>
                        </ul>
                    </div> 
                    <div class="search_section hidden-sm hidden-xs">
                        <input type="text" class="form-control input-sm">
                        <button class="btn btn-link btn-sm" type="button"><span class="icon_search"></span></button>
                    </div>
                     
                </div>
            </header>
	