<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MU Blog - a MultiUser blogging website</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">
    <link href="fa/css/font-awesome.min.css" rel="stylesheet" >
<link href="BIB_files/A_002.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">MU blogging</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Recent Blogs</a>
                    </li>
                            <li>
                                                
      			<a href="search_everythiing.php"><span class="glyphicon glyphicon-search"></span>Search</a>
					</li>
										
                    
	<!--
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
-->                </ul>
				
				
				  
				 <!--<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#">HTML</a></li>
					<li><a href="#">CSS</a></li>
					<li><a href="#">JavaScript</a></li>
				  </ul> -->
				
                 <ul class="nav navbar-nav navbar-right">
                    <?php
                    if(isset($_SESSION['userid'])){ ?>
					<li>
                                                
                                                	
						<a href="panel_login.php"><span class="glyphicon glyphicon-th-list"></span>Panel</a>
					</li>
					<li>
                                                

						<a href="wall.php?authorid=<?php echo $_SESSION['userid'];?>"><span class="glyphicon glyphicon-book"></span>Wall</a>
					</li>
                    <li>
                        <a href="createpost.php" class="glyphicon glyphicon-pencil">&nbsp;CreatePost</a>
                    </li>
					<li>
                         

                        <a href="untangle/index.html" class="glyphicon glyphicon-ball">&nbsp;<span class="glyphicon glyphicon-play"></span>Play</a>
                    </li> 
					<li>
                                                

						<a href="edit_details.php" class=""><span class="glyphicon glyphicon-edit"></span>Edit Profile</a>
					
					</li>
					<li>
                        <a href="logout.php" class="glyphicon glyphicon-log-out">&nbsp;Logout</a>
                    </li>
					
					
                    
                    <?php } 
                    else
                    {   ?> 
                        <li >
                        <a href="#loginModal" role="button" id="togg" data-toggle="modal" data-target="#loginModal" class="glyphicon glyphicon-log-in">&nbsp;Login</a>
                    </li> 
                    <li>
                        <a href="#registerModal" role="button" id="toggl" data-toggle="modal" data-target="#registerModal" class="glyphicon glyphicon-user">&nbsp;Signup</a>
                        </li>
                        
                        <?php 

                    } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>