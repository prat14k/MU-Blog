<?php
session_start();
include("connection.php");
include("header.php");
?>

<br>
<div style="text-align:center;">
Search in 
<form method="post" action="search_everythiing.php"><br><br>
<select name="typo" id="options">
<option id="" value=""> Select Something </option>
<option id="author" value="author"> Authors </option>
<option id="category" value="category"> Category </option>
</select>
<br><br>
<input type="text" placeholder="What to Search" name="item" id="item"/>
<br><br>
<input type="submit" value="Search"/>
<br>
OR 
<br>
<a href="searchtags.php"><button class="button button-default">search tags</button></a>
</form>
<br>

</div>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
<?php

if((isset($_POST['typo']))&&(isset($_POST['item'])))
{

       if((!empty($_POST['typo']))&&(!empty($_POST['item']))){
         $pt=mysql_real_escape_string($_POST['item']);
         $tp=mysql_real_escape_string($_POST['typo']);
               ?>
<script>

document.getElementById("item").value="<?php echo $pt; ?>";
document.getElementById("options").value="<?php echo $tp; ?>";
</script>
<?php
                  if($tp=="author"){
                          
                          $resis=mysql_query("SELECT userid,username FROM users WHERE `full name` LIKE '".$pt."%'") or die(mysql_error());
                          while($rowq = mysql_fetch_array($resis)){

                          $resi =mysql_query("SELECT * FROM posts where postauthorid=".$rowq['userid']) or die(mysql_error());
                          while($roro=mysql_fetch_array($resi)){
                          echo "<h2><a href=\"wall.php?postid=".$roro['postid']."&authorid=".$rowq['userid']."\">".$roro['postname']."</a></h2><br>";
                          $content = strip_tags(trim($roro['postcontent']));
                          $cont = substr_replace($content,"...",250);
                          echo "<h4>$cont</h4>";
                          echo "<br>By - ".$rowq['username']."<br>";
                          echo "</div></div><div class=\"row\"><br><div class=\"col-xs-12\">"; 
                       }
                    }
                 }
                 else if($tp=="category"){
                        $ee = mysql_query("SELECT categoryid from category where categoryname like '".$pt."%'");
                        $eee=mysql_fetch_array($ee);
                        $resi =mysql_query("SELECT * FROM posts where postcategoryid=".$eee['categoryid']) or die(mysql_error());
                          
                          while($rowq = mysql_fetch_array($resi)){
                            $resis=mysql_query("SELECT username FROM users WHERE userid=".$rowq['postauthorid']) or die(mysql_error());
                        
                          $roro=mysql_fetch_array($resis);
                          {
                          echo "<h2><a href=\"wall.php?postid=".$rowq['postid']."&authorid=".$rowq['postauthorid']."\">".$rowq['postname']."</a></h2><br>";
                          $content = strip_tags(trim($rowq['postcontent']));
                          $cont = substr_replace($content,"...",250);
                          echo "<h4>$cont</h4>";
                          echo "<br>By - ".$roro['username']."<br>";
                          echo "</div></div><div class=\"row\"><br><div class=\"col-xs-12\">"; 
                       }
                    }
                 }
       }
        else{
          ?>
           <script>
             alert("Fields Shouldn't  be empty...");</script>
<?php
}
}
?>
</div>
</div>
</div>
<?php

include("footer.php");
?>                <         