<?php
session_start();

require('connection.php');
if((isset($_GET['authorid']))&&(!empty($_GET['authorid'])))
    $authorid = $_GET['authorid'];
else
    $authorid="";

if((isset($_SESSION['userid']))&&(!empty($_SESSION['userid'])))
    $userid=$_SESSION['userid'];
else
    $userid="";

if((isset($_GET['postid']))&&(!empty($_GET['postid'])))
    $postid = $_GET['postid'];
else
    $postid="";

if($userid == ""){
    if($authorid=="")
        header("Location: index.php");
    else
    {  
         
            if($postid=="")
                header("Location: blog.php?authorid=".$authorid);
            else
                header("Location: blog.php?authorid=".$authorid."&postid=".$postid);
         
    }
}
else{
        if($authorid!=""){
        if($authorid!=$userid)
        {
            $domm = "blog.php";
            if($postid=="")
                header("Location: ".$domm."?authorid=".$authorid);
            else
                header("Location: ".$domm."?authorid=".$authorid."&postid=".$postid);
        }
    
    }
}

   $authorid = $userid;
    if(isset($_GET['postid']))
    {
    $postonpageid=$_GET['postid'];
    }
    else{
        $q="select * from posts where postauthorid=$userid";
        $r=mysql_query($q) or die(mysql_error());
        $post=mysql_fetch_array($r);
        $postonpageid=$post['postid'];
    }
   
 include('header.php');   
?>

<style>
#c1{
padding-top:80px;
}
</style>
<?php
include("shares.php");
?>

    <!-- Page Content -->
    <div class="container" id="c1">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-7">
                <?php 
                include("inc.php");
                ?>
            <br>
                <!-- Blog Post -->

                <!-- Title -->
                <?php  $q="select * from posts where postauthorid = $userid AND postid=$postonpageid";
                        $r=mysql_query($q) or die(mysql_error());
                        //$count=mysql_num_rows($r);
                        //$i=0;
                        $post=mysql_fetch_array($r);
                        echo "<h1>"; echo $post['postname']; echo "</h1>";
                        
                ?>      
                        <!-- Author -->

                <p class="lead">
                    <?php

                    $q="select categoryname from category where categoryid=".$post['postcategoryid'];
                    $cat=mysql_query($q) or die(mysql_error());
                     while($category=mysql_fetch_array($cat));
                    

                    $q="select username,`full name` from users where userid=$userid";
                    $r=mysql_query($q) or die(mysql_error());
                     while($row=mysql_fetch_array($r)){ ?>
                     <h3><?php echo "under <a href=\"blog.php?authorid=".$authorid."\">".$category['categoryname']."</a>";?></h3>
                    <!--//echo "<h2> Author : ".."</h2>";
                -->
                
                    by <?php 
                         echo "<a href=\"blog.php?authorid=".$authorid."\"> ".$row['full name']."</a>";
                    
                    }?>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on 
                <?php 
        
                        echo $post['postdate']." "."at"." ".$post['posttime'];
                       
                ?> 
                <!--  August 24, 2013 at 9:00 PM   --></p>
                    
                <hr>

                <!-- Preview Image -->
                <!--<img class="img-responsive" src="http://placehold.it/900x300" alt="">
-->
                <hr>
                    
                <div class="post_content">
                <!-- Post Content -->
                <?php 
                    
                        echo $post['postcontent'];
                    
                ?>
                
                </div>
                
                <hr>
                <form role="form" action="editpost.php" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="<?php echo $postonpageid;?>" name="postid"></textarea>
                        </div>
                        <?php 
                        if(isset($_SESSION['userid'])){ ?>
                        <div align="center">
                   <!--     <button type="button" class="btn btn-default">&nbsp;LIKE &nbsp;&nbsp; <span class="glyphicon glyphicon-thumbs-up"></span></button> &nbsp;
                        <button type="button" class="btn btn-default">&nbsp;UNLIKE &nbsp;&nbsp; <span class="glyphicon glyphicon-thumbs-down"></span></button> &nbsp;
                       --> 
                        <button type="button" class="btn btn-default" id="comm">&nbsp;Comment &nbsp;&nbsp; <span class="glyphicon glyphicon-comment"></span></button> &nbsp;
                        <button type="button" class="btn btn-default">&nbsp;Share &nbsp;&nbsp; <span class="glyphicon glyphicon-share"></span></button> &nbsp;
                        <button type="submit" class="btn btn-primary ">&nbsp;EDIT&nbsp;&nbsp; <span class="glyphicon glyphicon-edit"></span></button>
                        </div>
                        <?php } ?>
                </form>

                
                <!-- Blog Comments -->
                <div id="com" style="display:none">
                    <br>
                <!-- Comments Form -->
                <div class="well" > 
                    <h4>Leave a Comment:</h4>
                    <form role="form" >
                        <div class="form-group">
                            <textarea class="form-control" rows="3" id="comment_submit"> </textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="ajx_comments(); dellete(); return false;">Submit</button>
                    </form>
                </div>
            </div>
                <script>
                    document.getElementById("comm").onclick = function(event){
                            var comment_block  = document.getElementById("com");
                        if(comment_block.style.display=="none")
                            comment_block.style.display="block";
                        else
                            comment_block.style.display="none";
                    }
                   
                </script>
                <hr>

                <!-- Posted Comments -->
                <div id="all_comments">
                  <?php   include("com_ajx.php");
                ?>
                </div>
                <?php
               include("comment_ajx.php");
?>

    

                <?php 
                echo "<br><br>";        
               

                ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->
           
            <div class="col-md-4 col-md-offset-1">
            
                <!-- Blog Search Well -->
                
                    <?php include("search.php");
                    ?>
                    <!-- /.input-group -->
                </div>
                <?php ajax_call(); ?>
                <!-- Blog Categories Well -->
                <div class="well">
                <h4>
                  <?php if(isset($_SESSION['userid'])){
                     if($_SESSION['userid']==$authorid)   
                        echo "Your " ; 
                        else echo "Trendiing ";}
                        else echo "Trendiing ";
                         ?>
                 posts</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">
                        <?php
                        $i=0;
                        $q="select * from posts where postauthorid=$userid AND postid!=$postonpageid";
                        $r=mysql_query($q) or die(mysql_error());
                        while($postlinks=mysql_fetch_array($r))
                        {
                            $i++;
                            echo "<li><a href=\"wall.php?authorid=".$postlinks['postauthorid']."&"."postid=".$postlinks['postid']."\">";
                            echo $postlinks['postname'];
                            echo "</a><br><br></li>";
                            if($i>8)
                                break;
                        }
                        ?>
                        
                        </ul>
                    </div>
                </div>
                </div>
                

                <div class="well">              
                    <h4>RSS Feeds <span class="fa-stack pull-right" id="rss_icon">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
                </span></h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Please Select an option to get RSS:</p>
                          <form>
                             <select onchange="showRSS(this.value)">
                                <option value="">Select an RSS-feed:</option>
                                <option value="cnn">CNN</option>
                                <option value="bbc">BBC News</option>
                                <option value="pc">PC World</option>
                             </select>
                          </form>
                          <br>
                          <div id="output">RSS-feeds</div>
                        </div>
                    </div>
                </div>
             
                <div class="well">              
                    <h4>Popular category Blogs </h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Please Select an category to get popular feeds:</p>
                          <form>
                             <select onchange="showPOSTS(this.value)">
                                <option value="">Select an Category</option>
                                <option value="tech">Technology</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="sports">Sports</option>
                             </select>
                          </form>
                          <br>
                          <div id="output_posts">Popular feeds</div>
                        </div>
                    </div>
                </div>
            <?php
include("normal_crawl.php");
?>
            <div class="well">              
                    <h4>Twitter's Post <span class="fa-stack pull-left" id="twitter_icon" >
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                </span></h4>
                    <div class="row">
                        <div class="col-lg-12">

                            <?php
                            $cnt=0;
                            crawl_site("https://blog.twitter.com","div.View-content--loadMoreResults h3 a");
                        ?>

                        </div>
                    </div>
                </div>                           

                
                <!-- <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
            <!--    </div>
            

                <!-- Side Widget Well -->
                
            </div>

        </div>
        <?php
        showRss();
        showPosts();
        ?>
        <!-- /.row -->

        <hr>
        
        <!-- Footer -->
    
    </div>
    </div>
</div>
    <!-- /.container -->

    <?php
    include("footer.php");
    ?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>