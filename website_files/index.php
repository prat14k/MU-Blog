<!-- Custom Fonts -->
<!--    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
-->

    <?php
session_start();
 include("header.php"); ?>


<link href="css/clean-blog.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="BIB_files/css.css" rel="stylesheet" type="text/css">

<link href="BIB_files/font-awesome.css" rel="stylesheet">
<link href="BIB_files/A.css" rel="stylesheet">
<style>
body{
    padding-top: 1px;
    margin-bottom: 0px; 
}
</style>
	
	<?php
include('connection.php');
class suggestion{
    public $postid;
    public $view_date;
    public $view_time;
    function __construct()
    {
        $this->post_id=0;
        $this->view_date="0000-00-00";
        $this->view_time="00:00:00";
    }
    
}
class recommend{
    public $author;
    public $post_id;
    public $category;
    public $post_name;
    //public $post_count;
}

class details{

    public $postname;
    public $postdate;
    public $posttime;
    public $content;
    public $postlikes;
    public $id;
    public $author;
    public $postdislikes;
    public $postshare;
    public $postcategoryid;
    public $postpoints;
}

session_start();
if(!isset($_SESSION['username']))
    $_SESSION['username']="gtambi143";
    if(isset($_SESSION['username']))
    {
        $r=mysql_query("select * from userviews where user_name='$_SESSION[username]' ");
        $row=mysql_fetch_array($r);
        if($row)
        {
            $viewed=explode("| ",$row['viewed_post_id']);
            //print_r($viewed);
            $size=count($viewed);
            //echo $size;
            $i=0;
            $array_of_view[]=new suggestion();
            $array_of_seen_posts[] = new details();
            while($i!=$size)
            {
                $view=explode(",",$viewed[$i]);
                //print_r($view);
                //echo"<br>";
                //echo $view[0]." ";
                $array_of_view[$i]=new stdClass();

                $array_of_view[$i]->postid=$view[0];
                $array_of_view[$i]->view_date=$view[1];
                $array_of_view[$i]->view_time=$view[2]; 
                //echo $array_of_view[$i]->postid;  
                $i++;               
            }
            $memory = array();
            /* Our return values, with some useless defaults */
            $i=0;
            //echo $array_of_view[$i]->postid;
            $array_author=array();
            $array_for_recommended[]=new recommend();
            while($i!=$size)
            {
                $postid=$array_of_view[$i]->postid;
                @$r=mysql_query("select * from posts where postid=$postid ");
                @$row=mysql_fetch_array($r);
                $array_of_seen_posts[$row['postid']] = new stdClass();
                $array_for_recommended[$i]=new stdClass();
                $array_of_seen_posts[$row['postid']]->postname=$row['postname'];
                $array_of_seen_posts[$row['postid']]->postdate=$row['postdate'];
                $array_of_seen_posts[$row['postid']]->content=$row['postcontent'];
                $array_of_seen_posts[$row['postid']]->id=$row['postid'];
                $array_of_seen_posts[$row['postid']]->author=$row['postauthorid'];
                            
                $array_for_recommended[$i]->author=$row['postauthorid'];
                $array_author[$i]=$row['postauthorid'];
                $array_for_recommended[$i]->post_id=$row['postid'];
                $array_for_recommended[$i]->category=$row['postcategoryid'];
                
                $array_for_recommended[$i]->post_name=$row['postname'];
                $i++;
            }
            //print_r($array_for_recommended);
            //echo "<br><br>";
            //$array_author=array(1,1,1,2,3,2,3,3,2);
            $array=array();
            $array=array_unique($array_author,SORT_REGULAR);//till here we got the distinct authors who's posts are viewed by the user
            $array=array_values($array);
            //print_r($array);
            $total_posts=8;
            $total_author=count($array);
            $per_author=floor($total_posts/$total_author);
            $i=0;
            ?>
                      

           
	
	
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Navigation -->
    
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1 style="color:#b5afaf;">MU Blogging</h1>
                        <hr class="small">
                        <span class="subheading" style="color:#d08d3f;font-weight:bold;">Read ,Write and Explore the world !!!</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <br><br>

        <?php

        include("inc.php");

        ?>

    <div class="panel-group" id="accordion">
    <div class="panel panel-default">
                
    <div class="container">
        <a href="#recommended" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">
        <div class="panel-heading">
                    <div class="panel-title">
            <div><h2 class="front_heading">Recommended Posts </h2></div>
		</div>
    </div>
    </a>
    <div id="recommended" class="panel-collapse collapse">    
                    <div class="panel-body">
                
        <div class="row">
    <?php    
              //$post_diff_authors=array();
                $ii=0;
                while($i!=$total_author)//in this loop we get the recommended posts
                {
                    $q="select * from posts where postauthorid=$array[$i] order by rand() limit $per_author";
                    $r=mysql_query($q);
                    while(@$row=mysql_fetch_array($r))
                    {  
						$cat_id=$row['postcategoryid'];
						$s="select * from category where categoryid=$cat_id";
						$t=mysql_query($s);
						$cat=mysql_fetch_array($t);
						$cat_name=$cat['categoryname'];
						//echo rand(1,6);
						
						//$i= rand(1,6);
                        ?>
                        <div class="col-md-3">
                            <div class="post-preview">
                                <div class="post">
                                    <div class="thumb">
                                        <a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>">
                                            <img src="images/<?php echo $cat_name.rand(1,6).".jpg";?>" height="100" width="200"/>
                                        </a>
                                    </div>
                                    <h4 class="make_over">
                                        <a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>">
                                            <?php echo $row['postname']; ?>
                                        </a>
                                    </h4> 
                                    <p class="make_over"> <?php 
                                        $content = strip_tags(trim($row['postcontent']));
                                        $cont = substr_replace($content,"...",150);
                                        echo $cont;
                                     ?>
                                    </p><br>
                                    <ul class="pager">
                                        <li class="next">
                                            <a href="blog.php?postid=<?php echo $row['postid']; ?>&authorid=<?php echo $row['postauthorid']; ?>">Continue Reading &rarr;</a>
                                        </li>
                                    </ul> 
                                </div>
                            </div>
                        </div>
                    <?php             

                        $ii++;
                        if($ii%4 == 0){ ?>
                            </div> <br><br>
                            <div class = "row">
                            <?php
                        }                          
                    }
                    $i++;
                    
                }
            
            ?>
          	</div>
        </div>
    </div>
    <br>
        </div>

    </div>

        <hr class="medium">
    <div class="panel panel-default">
                
    <div class="container">
        <a href="#popular" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">
        <div class="panel-heading">
                    <div class="panel-title">
        <div><h2 class="front_heading"> Popular posts </h2></div>
                </div>
            </div>
            </a>
            <div id="popular" class="panel-collapse collapse">    
        <div class="panel-body">
   
            <div class="row">    

            <?php

                //for finding the mst viewed author
            for($i=0;$i<$size;$i++){
                $memory[$array_for_recommended[$i]->author] = 0;  //initializing the memory to 0
            } 
            
            for($i=0;$i<$size;$i++){
                $memory[$array_for_recommended[$i]->author] ++ ;  // storing the no. of appearence of the key
            }

            $MAXX =-1;
            $index=0;
            for($i=0;$i<$size;$i++){
                if($memory[$array_for_recommended[$i]->author] > $MAXX){
                    $index = $array_for_recommended[$i]->author;
                    $MAXX = $memory[$index];
                }  

            } // finding the max value of it
            $ii=0;
             $QUE1 = "SELECT * FROM posts where postauthorid = $index ORDER BY points DESC";
            $resultt = mysql_query($QUE1) or die("QUE1");
            while($row = mysql_fetch_array($resultt))
			{
				$cat_id=$row['postcategoryid'];
						$s="select * from category where categoryid=$cat_id";
						$t=mysql_query($s);
						$cat=mysql_fetch_array($t);
						$cat_name=$cat['categoryname'];
						//echo rand(1,6);					
        ?>



                        <div class="col-md-3">
                            <div class="post-preview">
                                <div class="post">
                                         <div class="thumb">
                                        <a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>">
                                            <img src="images/<?php echo $cat_name.rand(1,6).".jpg";?>" height="100" width="200"/>
                                        </a>
                                    </div>
                                    <h4 class="make_over">
                                        <a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>">
                                            <?php echo $row['postname']; ?>
                                        </a>
                                    </h4>  
                                    <p class="make_over"> <?php 
                                        $content = strip_tags(trim($row['postcontent']));
                                        //$cont = substr_replace($content," ......",150);
                                        echo $content;
                                     ?>
                                    </p><br>
                                    <ul class="pager">
                                        <li class="next">
                                            <a href="blog.php?postid=<?php echo $row['postid']; ?>&authorid=<?php echo $row['postauthorid']; ?>">Continue Reading &rarr;</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php             

                        $ii++;
                        if($ii>7)
                            break;
                        
                        if($ii%4 == 0){ ?>
                            </div> <br><br>
                            <div class = "row">
                            <?php
                        }                          
                    }            
            ?>
            </div>
        </div>
    </div>
    <br>
        </div>
    </div>
    
        <hr class="medium">
    <div class="panel panel-default">
                
    <div class="container">
        <a href="#recent" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">
        <div class="panel-heading">
                    <div class="panel-title">
       <div><h2 class="front_heading"> Recent posts </h2></div>
                
            </div>
        </div>
        </a>
        <div id="recent" class="panel-collapse collapse">    
                 <div class="panel-body">
   


                <div class="row">    

                    <?php

                    function dateDiff($start, $end) {
                      $start_ts = strtotime($start);
                      $end_ts = strtotime($end);
                      $diff = $end_ts - $start_ts;
                      return round($diff / 86400);
                    }
                    
                     
                    
                    $QUE2 = "SELECT * FROM  posts where postauthorid = $index ORDER BY postdate DESC";
                    $resultt = mysql_query($QUE2) or die("QUE2");
                    
                    $ii=0;
                    
                    while($row = mysql_fetch_array($resultt)){
						$cat_id=$row['postcategoryid'];
						$s="select * from category where categoryid=$cat_id";
						$t=mysql_query($s);
						$cat=mysql_fetch_array($t);
						$cat_name=$cat['categoryname'];
						//echo rand(1,6);	
                        if(dateDiff($row['postdate'], date('Y-m-d')) < 16 ){

                        ?>
                            <div class="col-md-3">
                                <div class="post-preview">
                                <div class="post">
                                      <div class="thumb">
                                        <a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>">
                                            <img src="images/<?php echo $cat_name.rand(1,6).".jpg";?>" height="100" width="200"/>
                                        </a>
                                    </div>
                                    <h4 class="make_over">
                                        <a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>">
                                            <?php echo $row['postname']; ?>
                                        </a>
                                    </h4>  
                                    <p class="make_over"> <?php 
                                        $content = strip_tags(trim($row['postcontent']));
                                        //$cont = substr_replace($content," ......",150);
                                        echo $content;
                                     ?>
                                    </p><br>
                                    <ul class="pager">
                                        <li class="next">
                                            <a href="blog.php?postid=<?php echo $row['postid']; ?>&authorid=<?php echo $row['postauthorid']; ?>">Continue Reading &rarr;</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php             

                        $ii++;
                        if($ii>7)
                            break;
                        
                        if($ii%4 == 0){ ?>
                            </div> <br><br>
                            <div class = "row">
                            <?php
                        }    

                    }
                }            
            ?>
            </div>  
        </div> </div>  
        <br></div> </div>  

    
        <hr class="medium">
    

    <div class="panel panel-default">
                
    <div class="container">
        <a href="#recent_viewed" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">
        <div class="panel-heading">
            <div class="panel-title">
            <div><h2 class="front_heading"> Recently viewed posts </h2></div>
        
            </div>
        </div>
    </a>
        <div id="recent_viewed" class="panel-collapse collapse">    
                 <div class="panel-body">
        
                <div class="row">    

                    <?php
                        $Result = mysql_query("SELECT postid FROM posts");
                        $space = array();
                        while($row = mysql_fetch_array($Result)){
                            $space[$row['postid']] = 0;  //initializing the memory to 0
                        } 
                        
                        for($i=0;$i<$size;$i++){
                            $space[$array_of_view[$i]->postid] ++ ;  // storing the no. of appearence of the key
                        }

                        echo "<br>  <br>";
                        arsort($space);
                        $i = 0;
                        foreach( $space as $key => $value )
                        {
                            if(dateDiff($array_of_seen_posts[$key]->postdate , date('Y-m-d')) < 21 ){
                                
                    
                        ?>
                            <div class="col-md-3">
                                <div class="post-preview">
                                <div class="post">
                                    <div class="thumb">
                                        <a href="http://all-free-download.com/free-website-templates/">
                                            <img src="img/_thumb2.jpg" />
                                        </a>
                                    </div>
                                    <h4 class="make_over">
                                        <a href="http://all-free-download.com/free-website-templates/">
                                            <?php echo $array_of_seen_posts[$key]->postname; ?>
                                        </a>
                                    </h4> 
                                    <p class="make_over"> <?php 
                                        $content = strip_tags(trim($array_of_seen_posts[$key]->content));
                                      //  $cont = substr_replace($content," ......",150);
                                        echo $content;
                                     ?>
                                    </p><br>
                                    <ul class="pager">
                                        <li class="next">
                                            <a href="blog.php?postid= <?php echo $array_of_seen_posts[$key]->id; ?>&authorid= <?php echo $array_of_seen_posts[$key]->author; ?>">Continue Reading &rarr;</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php             
                            $i++;
                            if($i>7)
                                break;
                         if($i%4 == 0){ ?>
                            </div> <br><br>
                            <div class = "row">
                            <?php
                        }    

                    }
                }            
            ?>
     </div>  
        </div> </div>  
     <br>   </div> </div>  

    </div>
<?php
include("footer.php");
?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>
</body>
</html>
<?php incc(); incr(); 
if(isset($_GET['val']) and ($_GET['val']==1)){
        ?> <script> alert("Invalid Username/E-mail or password"); </script>
<?php } ?>

<?php


    }
}
/*
 //echo $index." ".$memory[$index];

        //  

            



            $Result = mysql_query("SELECT postid FROM posts");
            $space = array();
            while($row = mysql_fetch_array($Result)){
                $space[$row['postid']] = 0;  //initializing the memory to 0
            } 
            
            for($i=0;$i<$size;$i++){
                $space[$array_of_view[$i]->postid] ++ ;  // storing the no. of appearence of the key
            }

            echo "<br> Recently viewed max <br>";
            arsort($space);
            $i = 0;
            foreach( $space as $key => $value )
            {
                if(dateDiff($array_of_seen_posts[$key]->postdate , date('Y-m-d')) < 21 ){
                    echo $array_of_seen_posts[$key]->postname . "<br>";
                    $i++;
                    if($i>10)
                        break;
                }
            }
            
        }
        else{
            //new user
        }
    }
    */
?>