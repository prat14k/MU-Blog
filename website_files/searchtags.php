<?php 
session_start();
require("connection.php");
include("header.php");

?>
<link href="BIB_files/A_002.css" rel="stylesheet">


<!-- Page Content -->
    <div class="container" id="contain">
    <style>
        #contain{
            padding : 40px 40px 40px 40px;
        }
    </style>
    
<br>
    <?php 
                include("inc.php");
                ?>
<br>
<?php
if(!isset($_GET['tag'])){
$_GET['tag']="";
}
?>
<form action="searchtags.php" method="get">
<input type="text" name="tag" value="<?php echo $_GET['tag']; ?>" />
<br><br><br>
<input type="submit" value="Search tag" />
</form>
<?php 
    $tag = $_GET['tag'];
    $tag[0]='#'; 
    $cn = 0;
    $query = "select * from posts";
    $res = @mysql_query($query);
    if(mysql_num_rows($res)==0)
        echo "<h1> Nothing to show </h1> ";
    else{
        while($row = mysql_fetch_array($res)){
        
  $content = trim(strip_tags($row['postcontent']));
                                    if((preg_match('/'.$tag.'/',$content))&&($tag!=""))
                                    {  ?>
        <div class="row">
            <div class="col-xs-12">
            <!-- Blog Post Content Column -->
            
                
        <h2> <?php  echo $row['postname']."<br>";  ?> </h2>

          <p><span class="glyphicon glyphicon-time"></span> Posted on 
                <?php 
        
                        echo $post['postdate']." "."at"." ".$post['posttime'];
                       
                echo $tag;
                ?> 
                <!--  August 24, 2013 at 9:00 PM   --></p>


                <?php            $cont = substr_replace($content,"...",150);
                                        echo $cont; 
                                          $cn++;?>
                                    
                        <br><br>
                        <a href="blog.php?authorid=<?php echo $row['postauthorid']; ?>&postid=<?php echo $row['postid'];?>"> Continue Reading  </a>
<?php

        echo "</div> </div>";
           }
        
        }
    } 



?></div>
<?php include("footer.php");
?>
</body>
</html>	