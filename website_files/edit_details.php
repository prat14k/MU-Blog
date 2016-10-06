<!DOCTYPE html>
<html>
    
<!-- Mirrored from yukon-admin.tzdthemes.com/html/pages-user_profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 11:38:28 GMT -->
<head>

 <script src="sweetalert-master/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
<?php
	session_start();
	include('connection.php');
	
				include('header.php');
			
	$username=$_SESSION['username'];
	$userid=$_SESSION['userid'];
	$q="select * from users where userid=$userid";
	$r=mysql_query($q) or die(mysql_error());
	$details=mysql_fetch_array($r);
	
	if (isset($_POST['submit'])) 
	{
		//echo "hi";
	
		$old_pass=$_POST['old'];
		$new_pass=$_POST['pass1'];
		$con_pass=$_POST['pass2'];
		$q="select password from users where userid=$_SESSION[userid]";
		$r=mysql_query($q) or die(mysql_error());
		$pass=mysql_fetch_array($r);
		//echo md5('14031995');
		
		if($old_pass==$pass['password'])
		{
			$new=$new_pass;
			$con=$con_pass;
			//echo $new." ".$con;
			//die();
			if($new==$con)
			{
				$r=mysql_query("update users set password='$new' where userid=$_SESSION[userid]") or die(mysql_error());
				if($r)
				{
					echo "<script>swal('Yippiee..!!','your password changed succesfully','success');</script>";
				
				}
				else{
					echo "<script>sweetAlert('Ooops..!!','error changing password','error');</script>";
					
				}
			}
			else{
				
				echo "<script>sweetAlert('Ooops..!!','your new password and confirm password doesnt match','error');</script>";
				
			}
		}
		else{
			echo "<script>sweetAlert('Ooops..!!','your old password is wrong','error');</script>";
		}
		
}
//end change password logic
	
	
	
?>

		<meta charset="UTF-8">
		<title>Yukon Admin HTML v1.5 (pages-user_profile2)</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

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

    </head>
    <body class="side_menu_active side_menu_expanded">
        <div id="page_wrapper">

            <!-- header -->
			
			<!--
            <header id="main_header">
                <div class="container-fluid">
                    <div class="brand_section">
                        <a href="dashboard.html"><img src="assets/img/logo.png" alt="site_logo" width="63" height="26"></a>
                    </div>
                    <ul class="header_notifications clearfix">
                        <li class="dropdown">
                            <span class="label label-danger">8</span>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-envelope"></i></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <img src="assets/img/avatars/avatar02_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor sit amet&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <img src="assets/img/avatars/avatar03_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor sit&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <img src="assets/img/avatars/avatar04_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <img src="assets/img/avatars/avatar05_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor sit amet&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-xs btn-primary btn-block">All messages</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown" id="tasks_dropdown">
                            <span class="label label-danger">14</span>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-tasks"></i></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <div class="clearfix">
                                            <div class="label label-warning pull-right">Medium</div>
                                            <small class="text-muted">YUK-21 (24.07.2014)</small>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                    </li>
                                    <li>
                                        <div class="clearfix">
                                            <div class="label label-danger pull-right">High</div>
                                            <small class="text-muted">YUK-8 (26.07.2014)</small>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                    </li>
                                    <li>
                                        <div class="clearfix">
                                            <div class="label label-success pull-right">Medium</div>
                                            <small class="text-muted">DES-14 (25.07.2014)</small>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-xs btn-primary btn-block">All tasks</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown">
                            <span class="label label-primary">2</span>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-bell"></i></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                        <small class="text-muted">20 minutes ago</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor sit&hellip;</p>
                                        <small class="text-muted">44 minutes ago</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor&hellip;</p>
                                        <small class="text-muted">10:55</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-xs btn-primary btn-block">All Alerts</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="header_user_actions dropdown">
                        <div data-toggle="dropdown" class="dropdown-toggle user_dropdown">
                            <div class="user_avatar">
                                <img src="assets/img/avatars/avatar08_tn.png" alt="" title="Carrol Clark (carrol@example.com)" width="38" height="38">
                            </div>
                            <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="pages-user_profile.html">User Profile</a></li>
                            <li><a href="pages-user_profile2.html">User Profile 2</a></li>
                            <li><a href="login_page.html">Log Out</a></li>
                        </ul>
                    </div>
                    <div class="search_section hidden-sm hidden-xs">
                        <input type="text" class="form-control input-sm">
                        <button class="btn btn-link btn-sm" type="button"><span class="icon_search"></span></button>
                    </div>
                </div>
            </header>
			-->
		
            <!-- breadcrumbs -->
           

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <img class="user_profile_img" src="assets/img/avatars/avatar08.png" alt="" width="76" height="76" />
                            <h1 class="user_profile_name"> <?php echo $details['full name'];?></h1>
                            <p class="user_profile_info">Author At MU-Blogging</p>
                           
						</div>
                    </div>
                    <hr/>
					<a href="#loginModal" role="button" id="togg" data-toggle="modal" data-target="#loginModal">Change Password</a>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" action="save_details.php" method="post">
                                <h3 class="heading_a"><span class="heading_text">General info</span></h3>
                                <div class="form-group">
                                    <label for="profile_username" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="profile_username" name="username" value="<?php echo $details['username'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profile_name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="profile_name" name="fullname" value="<?php echo $details['full name'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profile_bday" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $details['useremail'];?>">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="profile_bday" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-10">
                                        male<input type="radio"  id="sex" <?php if($details['gender']=="male"){ echo "checked";}?> value="male" name="sex">
										female<input type="radio"  id="sex" <?php if($details['gender']=="female"){ echo "checked";}?> value="female" name="sex">
                                    </div>
                                </div>
                                <h3 class="heading_a"><span class="heading_text">Contact info</span></h3>
                                <div class="form-group">
                                    <label for="profile_skype" class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mobile" value="<?php echo $details['mobileno'];?>" name="mobile">
                                    </div>
                                </div>
                                
                             
                                <hr/>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <input type="submit" class="btn-primary btn" name="submit" value="Save"/>
                                        <button class="btn-default btn" href="wall.php">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                </div>
            </div>
            
            <!-- main menu -->
			<!--
            <nav id="main_menu">
                <div class="menu_wrapper">
                    <ul>
                        <li class="first_level">
                            <a href="dashboard.html">
                                <span class="icon_house_alt first_level_icon"></span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="icon_document_alt first_level_icon"></span>
                                <span class="menu-title">Forms</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Forms</li>
                                <li><a href="forms-regular_elements.html">Regular Elements</a></li>
                                <li><a href="forms-extended_elements.html">Extended Elements</a></li>
                                <li><a href="forms-gridforms.html">Gridforms</a></li>
                                <li><a href="forms-validation.html">Validation</a></li>
                                <li><a href="forms-wizard.html">Wizard</a></li>
                            </ul>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="icon_folder-alt first_level_icon"></span>
                                <span class="menu-title">Pages</span>
                                <span class="label label-danger">12</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Pages</li>
                                <li><a href="pages-chat.html">Chat</a></li>
                                <li><a href="pages-contact_list.html">Contact List</a></li>
                                <li><a href="error_404.html">Error 404</a></li>
                                <li><a href="pages-help_faq.html">Help/Faq</a></li>
                                <li><a href="pages-invoices.html">Invoices</a></li>
                                <li><a href="login_page.html">Login Page</a></li>
                                <li><a href="login_page2.html">Login Page 2</a></li>
                                <li><a href="pages-mailbox.html">Mailbox</a></li>
                                <li><a href="pages-mailbox_compose.html">Mailbox (compose)</a></li>
                                <li><a href="pages-mailbox_message.html">Mailbox (details)</a></li>
                                <li><a href="pages-search_page.html">Search Page</a></li>
                                <li><a href="pages-user_list.html">User List</a></li>
                                <li><a href="pages-user_profile.html">User Profile</a></li>
                                <li><a class="act_nav" href="pages-user_profile2.html">User Profile 2</a></li>
                            </ul>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="icon_puzzle first_level_icon"></span>
                                <span class="menu-title">Components</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Components</li>
                                <li><a href="components-bootstrap.html">Bootstrap</a></li>
                                <li><a href="components-gallery.html">Gallery</a></li>
                                <li><a href="components-grid.html">Grid</a></li>
                                <li><a href="components-icons.html">Icons</a></li>
                                <li><a href="components-notifications_popups.html">Notifications/Popups</a></li>
                                <li><a href="components-typography.html">Typography</a></li>
                            </ul>
                        </li>
                        <li class="first_level">
                            <a href="javascript:void(0)">
                                <span class="icon_lightbulb_alt first_level_icon"></span>
                                <span class="menu-title">Plugins</span>
                                <span class="label label-danger">6</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Plugins</li>
                                <li><a href="plugins-ace_editor.html">Ace Editor</a></li>
                                <li><a href="plugins-calendar.html">Calendar</a></li>
                                <li><a href="plugins-charts.html">Charts</a></li>
                                <li><a href="plugins-gantt_chart.html">Gantt Chart</a></li>
                                <li><a href="plugins-google_maps.html">Google Maps</a></li>
                                <li><a href="plugins-tables_footable.html">Tables</a></li>
                                <li><a href="plugins-vector_maps.html">Vector Maps</a></li>
                            </ul>
                        </li>
                        <li class="first_level has_submenu">
                            <a href="javascript:void(0)">
                                <span class="first_level_icon icon_menu-circle_alt2"></span>
                                <span class="menu-title">Sub menu</span>
                            </a>
                            <ul>
                                <li class="submenu-title">Sub menu</li>
                                <li><a href="javascript:void(0)">01. Lorem ipsum</a></li>
                                <li class="has_submenu">
                                    <a href="javascript:void(0)">02. Lorem ipsum</a>
                                    <ul>
                                        <li class="has_submenu">
                                            <a href="javascript:void(0)">02.1 Lorem ipsum dolor sit amet</a>
                                            <ul>
                                                <li><a href="javascript:void(0)">02.1.1 Lorem ipsum</a></li>
                                                <li><a href="javascript:void(0)">02.1.2 Lorem ipsum</a></li>
                                                <li><a href="javascript:void(0)">02.1.3 Lorem ipsum</a></li>
                                                <li><a href="javascript:void(0)">02.1.4 Lorem ipsum</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0)">02.2 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">02.3 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">02.4 Lorem ipsum</a></li>
                                    </ul>
                                </li>
                                <li class="has_submenu">
                                    <a href="javascript:void(0)">03. Lorem ipsum</a>
                                    <ul>
                                        <li><a href="javascript:void(0)">03.1 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">03.2 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">03.3 Lorem ipsum</a></li>
                                        <li><a href="javascript:void(0)">03.4 Lorem ipsum</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">04. Lorem ipsum</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="menu_toggle">
                    <span class="icon_menu_toggle">
                        <i class="arrow_carrot-2left toggle_left"></i>
                        <i class="arrow_carrot-2right toggle_right" style="display:none"></i>
                    </span>
                </div>
            </nav>
			-->

        </div>

        <!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- jQuery Cookie -->
        <script src="assets/js/jqueryCookie.min.js"></script>
        <!-- Bootstrap Framework -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- retina images -->
        <script src="assets/js/retina.min.js"></script>
        <!-- switchery -->
        <script src="assets/lib/switchery/dist/switchery.min.js"></script>
        <!-- typeahead -->
        <script src="assets/lib/typeahead/typeahead.bundle.min.js"></script>
        <!-- fastclick -->
        <script src="assets/js/fastclick.min.js"></script>
        <!-- match height -->
        <script src="assets/lib/jquery-match-height/jquery.matchHeight-min.js"></script>
        <!-- scrollbar -->
        <script src="assets/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- Yukon Admin functions -->
        <script src="assets/js/yukon_all.js"></script>


        <!-- style switcher -->
        <div id="style_switcher">
            <a class="switcher_toggle"><i class="icon_cog"></i></a>
            <div class="style_items">
                <div class="heading_b"><span class="heading_text">Top Bar Color</span></div>
                <ul class="clearfix" id="topBar_style_switch">
                    <li class="sw_tb_style_0 style_active" title=""><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_1" title="topBar_style_1"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_2" title="topBar_style_2"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_3" title="topBar_style_3"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_4" title="topBar_style_4"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_5" title="topBar_style_5"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_6" title="topBar_style_6"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_7" title="topBar_style_7"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_8" title="topBar_style_8"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_9" title="topBar_style_9"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_10" title="topBar_style_10"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_11" title="topBar_style_11"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_12" title="topBar_style_12"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_13" title="topBar_style_13"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_14" title="topBar_style_14"><span class="icon_check_alt2"></span></li>
                </ul>
            </div>
            <hr/>
            <div class="clearfix hidden-sm hidden-md hidden-xs sepH_b">
                <label>Fixed layout</label>
                <div class="pull-right"><input type="checkbox" id="fixed_layout_switch" class="js-switch mini-switch"></div>
            </div>
            <div class="style_items hidden-sm hidden-md hidden-xs" id="fixed_layout_bg_switch">
                <hr/>
                <div class="heading_b"><span class="heading_text">Background</span></div>
                <ul class="clearfix">
                    <li class="sw_bg_0" title="bg_0"></li>
                    <li class="sw_bg_1" title="bg_1"></li>
                    <li class="sw_bg_2" title="bg_2"></li>
                    <li class="sw_bg_3" title="bg_3"></li>
                    <li class="sw_bg_4" title="bg_4"></li>
                    <li class="sw_bg_5" title="bg_5"></li>
                    <li class="sw_bg_6" title="bg_6"></li>
                    <li class="sw_bg_7" title="bg_7"></li>
                </ul>
                <hr/>
            </div>
            <div class="clearfix sepH_b">
                <label>Top Menu</label>
                <div class="pull-right"><input type="checkbox" id="top_menu_switch" class="js-switch mini-switch"></div>
            </div>
            <div class="clearfix sepH_b">
                <label>Hide Breadcrumbs</label>
                <div class="pull-right"><input type="checkbox" id="breadcrumbs_hide" class="js-switch mini-switch"></div>
            </div>
            <div class="text-center sepH_a">
                <button data-toggle="modal" data-target="#showCSSModal" id="showCSS" class="btn btn-default btn-xs btn-outline" type="button">Show CSS</button>
            </div>
        </div>
        <div class="modal fade" id="showCSSModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">CSS Classes</h4>
                    </div>
                    <div class="modal-body">
                        <pre id="showCSSPre"></pre>
                    </div>
                </div>
            </div>
        </div>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','../../www.google-analytics.com/analytics.js','ga');
		  
			ga('create', 'UA-54304677-1', 'auto');
			ga('send', 'pageview');
		</script>
		
		
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">×</button>
              <h1 class="text-center">Change Passsword</h1>
          </div>
          <div class="modal-body">
            
        <h3 style="display:none;">Invalid username/email or password </h3>
            
              <form class="form col-md-12 center-block" method="POST" action="edit_details.php">
                <div class="form-group">
                  <input type="password" class="form-control input-lg" name="old" placeholder="Old Password" id="pass">
                </div>
                <div class="form-group">
                  <input type="password" name="pass1" class="form-control input-lg" placeholder="New Password" id="pass">
                </div>
				<div class="form-group">
                  <input type="password" name="pass2" class="form-control input-lg" placeholder="Confirm Password" id="pass">
                </div>
                <div class="form-group">
                  <!-- <button class="btn btn-primary btn-lg btn-block">Sign In</button> -->
                  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Change Password" name="submit">
                  
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <div class="col-md-12">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              </div>    
          </div>
      </div>
    </div>
</div>
		
		
		
		

    </body>

<!-- Mirrored from yukon-admin.tzdthemes.com/html/pages-user_profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 11:38:28 GMT -->
</html>
