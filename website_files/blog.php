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
{
    $postid = $_GET['postid'];
    $_SESSION['postid']=$_GET['postid'];
}
else
    $postid="";




if($userid == ""){
    if($authorid=="")
        header("Location: index.php");
}
else{
    if($authorid=="")
        header("Location: wall.php");
    else 
    {
        if($authorid==$userid)
       {     $domm="wall.php";
            if($postid=="")
            header("Location: ".$domm."?authorid=".$authorid);
        else
            header("Location: ".$domm."?authorid=".$authorid."&postid=".$postid);
        }
    }
}



if(isset($_GET['authorid']) && !empty($_GET['authorid']) )
{
    $authorid=$_GET['authorid'];
    //$userid = $_SESSION['userid'];
    if(isset($_GET['postid']) && !empty($_GET['postid']))
    {
        $postonpageid=$_GET['postid'];
    }
    else{
        $q="select * from posts where postauthorid=$authorid";
        $r=mysql_query($q) or die(mysql_error());
        $post=mysql_fetch_array($r);
        $postonpageid=$post['postid'];
    }
    /*query to load the info about the views of the user in the session variables*/
    if(isset($_SESSION['username']))
    {
        $q="select * from userviews where user_name='$_SESSION[username]'";
        $r=mysql_query($q) or die(mysql_error());
        $num=mysql_num_rows($r);
        if($num!=0)
        {
            $row=mysql_fetch_array($r);
            $_SESSION['views']=$row['viewed_post_id'];
            
            $view=explode("| ",$row['viewed_post_id']);
            /*
            print_r($view);
            $view2=explode(",",$view[0]);
            print_r($view2);
            */
            $view_post_id=$postonpageid.",".date("Y-m-d").",".date("H:m:s");
            //echo $view_post_id;
            array_push($view,$view_post_id);
            $view_post_id=implode("| ",$view);
            //echo $view_post_id;
            $q="update userviews set viewed_post_id='$view_post_id' where user_name='$_SESSION[username]'";
            $r=mysql_query($q) or die(mysql_error());
            
            
        }
        else{
            $view_post_id=$postonpageid.",".date("Y-m-d").",".date("H:m:s");
            //echo $view_post_id;
            $q="insert into userviews values(NULL,'$_SESSION[username]','$view_post_id')";
            $r=mysql_query($q) or die(mysql_error());
            $_SESSION['views']=NULL;
        }
        
            $q="update posts set postviews= postviews + 1 where postid=$postonpageid";
            $r=mysql_query($q) or die(mysql_error());
    
    }
    

    
    if(isset($_SESSION['userid']))
    {
        $q="select * from likes where likerid=$userid AND postid=$postonpageid";
        $r=mysql_query($q);
        $count=mysql_num_rows($r);
        if($count==1)
        {
            $likecolor="green";
        }
        else{
            $likecolor="black";
        }

        $q="select * from dislikes where dislikerid=$userid AND postid=$postonpageid";
        $r=mysql_query($q) ;
        $count=mysql_num_rows($r);
        if($count==1)
        {
            $dislikecolor="red";
        }
        else{
            $dislikecolor="black";
        }
    }
  
?>
<?php include('header.php');?>
<link href="BIB_files/A_002.css" rel="stylesheet">
<link href="BIB_files/css.css" rel="stylesheet" type="text/css">

<link href="BIB_files/font-awesome.css" rel="stylesheet">

<style>
body{
padding-top:80px;
}
</style>
 
<?php
include("shares.php");
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-7">
                <?php 
                include("inc.php");
                ?>
            <br>
                <!-- Blog Post -->

                <!-- Title -->
                <?php  $q="select * from posts where postauthorid = $authorid AND postid=$postonpageid";
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
                    $category=mysql_query($q) or die(mysql_error());
                     $category=mysql_fetch_array($category);
                    
                    $q="select username,`full name` from users where userid=$authorid";
                    $r=mysql_query($q) or die(mysql_error());
                     while($row=mysql_fetch_array($r)){ 
                        $add_string = trim(strip_tags($post['postname'])." ".strip_tags($post['postcontent'])." ".strip_tags($category['categoryname']));

                        ?>
                     <h3><?php echo "category <a href=\"blog.php?authorid=".$authorid."\">".$category['categoryname']."</a>";?></h3>
                   
                
                
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

               
                <hr>
                <div class="post_content" style="width:700px; overflow:hidden;">    
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
                        <div align="center" id="dis_like">
                        
                        <button type="button" class="btn btn-default" value="like" id="like_button" >&nbsp;LIKE &nbsp;&nbsp; <span class="fa fa-thumbs-up fa-lg" id="like"></span></button> &nbsp; 
                        
                        <button type="button" class="btn btn-default" value="dislike" id="dislike_button">&nbsp;DISLIKE &nbsp;&nbsp; <span class="fa fa-thumbs-down fa-lg" id="dislike"></span></button> &nbsp;
                        
                        <button type="button" class="btn btn-default" id="comm" value="comment">&nbsp;Comment &nbsp;&nbsp; <span class="glyphicon glyphicon-comment"></span></button> &nbsp;
                        <button type="button" class="btn btn-default" value="share">&nbsp;Share &nbsp;&nbsp; <span class="glyphicon glyphicon-share"></span></button> &nbsp;
                        
                        </div>
                        <?php } ?>
                </form>
                <script>
                var like = document.getElementById('like') , dislike = document.getElementById('dislike'); 
               
                    like.style.color = "<?php echo $likecolor; ?>";

                       dislike.style.color = "<?php echo $dislikecolor; ?>";

                         document.getElementById('like_button').onclick = function(){
                        
                            if(like.style.color == 'green')
                                like.style.color="black";                            
                            else
                             {   //   like.style.color = 'green';

                                   dislike.style.color="black";                            
                                   like.style.color = 'green';
                            }
                        }
                         document.getElementById('dislike_button').onclick = function(){
                            if(dislike.style.color == 'red')
                                dislike.style.color="black";                            
                            else
                                {
                                         like.style.color="black";                            
                                        dislike.style.color = 'red';
                                }
                        }
                
            </script> 
            
                <!-- Blog Comments -->
                <div id="com" style="display:none">
                    <br>
                <!-- Comments Form -->
                <div class="well" > 
                    <h4>Leave a Comment:</h4>
                    <form role="form" >
                        <div class="form-group">
                            <textarea class="form-control" rows="3" id="comment_submit"></textarea>
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

    
                echo "<br><br>";
                            
                    
    
                ?>
                <div id="adds">
                    <?php
                    include('adds_show.php');
                    ?>
                </div>
				<br>
				<br>
				<div>
									<h2>
										Suggested Posts
									</h2>
									</div>
				<div class="row">
							<?php
								
								$q="select * from posts where postcategoryid=$post[postcategoryid] and postauthorid<>$_SESSION[userid] order by rand() limit 6";
								$r=mysql_query($q);
								$num=mysql_num_rows($r);
								$i=1;
									while($row=mysql_fetch_array($r))
									{
				?>						
									
									<div class="col-md-4" style="padding-top:10px;">
										<div>
											<a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>"><img src="images/<?php echo $category['categoryname'].$i.".jpg";?>" height="230" width="200"/></a>
										</div>
										<div>
										<h4 style="max-height:40px; overflow:hidden; min-height:40px;">
											<a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>">
												<?php echo $row['postname'];?>
											</a>
										</h4>
										<button class="btn btn-primary"><a href="blog.php?postid=<?php echo $row['postid'];?>&authorid=<?php echo $row['postauthorid'];?>" style="color:black;">Continue reading &rarr;</a></button>
										</div>
									</div>	
									
				<?php				$i++;		
									}
								
				?>
				
				</div>		

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-1">
            </div>
            <div class="col-md-4">
            
                <!-- Blog Search Well -->
                
                    <?php include("search.php");
                    ?>
                    <!-- /.input-group -->
                </div>


                <?php ajax_call(); ?>
				<div class="well">
                <h4>
                  
                        More Posts from this author
                        
                      
                        
                 </h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">
                        <?php
							$q="select * from posts where postauthorid=$authorid order by rand() limit 6";
							$r=mysql_query($q);
							$num=mysql_num_rows($r);
							while($row=mysql_fetch_array($r))
							{
							echo "<li><a href=\"wall.php?authorid=".$row['postauthorid']."&"."postid=".$row['postid']."\">";
                            echo $row['postname'];
                            echo "</a></li>";
							}
									
							
							
                        ?>
                        
                        </ul>
                    </div>
                </div>
                </div>
                <!-- Blog Categories Well -->
                <div class="well">
                <h4>
                  <?php if(isset($_SESSION['userid'])){
                     if($_SESSION['userid']==$authorid)   
                        echo "Your " ; 
                        else echo "Trending ";}
                        else echo "Trending ";
                         ?>
                 posts</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">
                        <?php
                        $i=0;
                        $q="select * from posts where postauthorid=$authorid AND postid!=$postonpageid";
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
                    <h4>RSS Feeds <span class="fa-stack pull-left" id="rss_icon">
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
<?php
        showRss();
        showPosts();
        ?>

</div>
</div>
</div>
<br><br>
<?php
    include("footer.php");
    ?>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


<script>

$(document).ready(function(){
    $('.btn.btn-default').click(function(){
        //alert(color);
        var clickBtnValue = $(this).val();
        
        $.ajax({type:"POST",url:"ajx.php",data:{action:clickBtnValue}}).done(function(){}); 
        
    });

});
/*
$(document).ready(function(){
     $('.btn btn-default').click(function(){
    var clickBtnValue = $(this).val();
 $.ajax({
  type: "POST",
  url: "ajx.php",
  data: { action: "John" }
}).done(function( msg ) {
  alert( "Data Saved: " + msg );
});    

    });
*/
</script>

<?php incc(); incr(); } ?>
</body>
</html>