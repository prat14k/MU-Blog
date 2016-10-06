<?php
require("connection.php");
session_start();
if((isset($_POST['key']))&&(!empty($_POST['key']))){
	$see =$_POST['key'];
	$v = $_POST['val'];
	if($v==1){

    $see[0]='#'; 
    $cn = 0;
    $query = "select * from posts";
    $res = @mysql_query($query);
    if(mysql_num_rows($res)==0)
        echo "<h1> Nothing to show </h1> ";
    else{
        while($row = mysql_fetch_array($res)){
        
  $content = trim(strip_tags($row['postcontent']));
                                    if((preg_match('/'.$see.'/',$content))&&($see!=""))
                                    { 	
                                if($row['postauthorid']==$_SESSION['userid'])
					$dom="wall.php";
				else
					$dom="blog.php";
				$rr = mysql_fetch_array(mysql_query("select username from users where userid='".$row['postauthorid']."'"));
				echo " <p class=\"cover\"><a href=\"".$dom."?postid=".$row['postid']."&authorid=".$row['postauthorid']."\"> ".$row['postname']."        --by        ".$rr['username']."</a></p>";
        echo "</div> </div>";
           }
        
        }
    } 



?></div>
	<?php
}
	else
	{
		$q="SELECT * from posts where postname LIKE '".$see."%'";
		
		$res = mysql_query($q);
		if(mysql_num_rows($res)!=0){
		
			while($row = mysql_fetch_array($res)){
				
				if($row['postauthorid']==$_SESSION['userid'])
					$dom="wall.php";
				else
					$dom="blog.php";
				$rr = mysql_fetch_array(mysql_query("select username from users where userid='".$row['postauthorid']."'"));
				echo " <p class=\"cover\"><a href=\"".$dom."?postid=".$row['postid']."&authorid=".$row['postauthorid']."\"> ".$row['postname']."        --by        ".$rr['username']."</a></p>";
			}
			
		}
		else
			echo "";
	}
	/*
	$res = mysql_query($q);
	echo "<select>";
	if(mysql_num_rows($res)!=0){
		while($row = mysql_fetch_array($res)){
			echo "<option> <a href="$row[0];
		}
	}
*/
}

if (isset($_POST['action'])) 
{
    switch ($_POST['action']) 
	{
        case 'like':
            like();
            break;
        case 'dislike':
            dislike();
            break;
			
    }
}

function like() {
	$userid=$_SESSION['userid'];
	$postid=$_SESSION['postid'];
	$q="select * from dislikes where dislikerid=$userid AND postid=$postid";
	$q1="select * from likes where likerid=$userid AND postid=$postid";
	$r1=mysql_query($q1);
	$r=mysql_query($q);
	$countlike=mysql_num_rows($r1);
	$countdislike=mysql_num_rows($r);
	if($countlike==0 && $countdislike==0)
	{
		$q="insert into likes values(NULL,$postid,$userid)";
		$r=mysql_query($q) or die(mysql_errno());
		$q = "UPDATE `posts` SET `postlikes` = `postlikes`+'1',`points`=`points`+'3' WHERE `postid` = $postid";
		//$q="update posts set points=points+3 and postlikes=postlikes+1 where postid=$postid";
		$r=mysql_query($q) or die(mysql_error());
		
	}
	elseif($countlike==0 && $countdislike==1)
	{
		$q="delete from dislikes where dislikerid=$userid AND postid=$postid";
		$r=mysql_query($q) or die(mysql_error()); 
		
		$q="insert into likes values(NULL,$postid,$userid)";
		$r=mysql_query($q) or die(mysql_errno());
		
		$q="update posts set points=points+5,postlikes=postlikes+1,postdislikes=postdislikes-1 where postid=$postid";
		
		$r=mysql_query($q) or die(mysql_error());
	}
	elseif($countlike==1 && $countdislike==0)
	{
		$q="delete from likes where likerid=$userid AND postid=$postid";
		$r=mysql_query($q) or die(mysql_error()); 
		
		$q="update posts set points=points-3,postlikes=postlikes-1 where postid=$postid";
		$r=mysql_query($q) or die(mysql_error());
	}
   echo "The like function is called.";
   die();
    exit;
}

function dislike() {
	$userid=$_SESSION['userid'];
	$postid=$_SESSION['postid'];
	$q="select * from dislikes where dislikerid=$userid AND postid=$postid";
	$q1="select * from likes where likerid=$userid AND postid=$postid";
	$r1=mysql_query($q1) or die(mysql_error());
	$r=mysql_query($q) or die(mysql_error());
	$countlike=mysql_num_rows($r1);
	$countdislike=mysql_num_rows($r);
	if($countlike==0 && $countdislike==0)
	{
		$q="insert into dislikes values(NULL,$postid,$userid)";
		$r=mysql_query($q) or die(mysql_errno());
		
		$q="update posts set points=points-2,postdislikes=postdislikes+1 where postid=$postid";
		$r=mysql_query($q) or die(mysql_error());
	}
	elseif($countlike==1 && $countdislike==0)
	{
		$q="delete from likes where likerid=$userid AND postid=$postid";
		$r=mysql_query($q) or die(mysql_error()); 
		
		$q="insert into dislikes values(NULL,$postid,$userid)";
		$r=mysql_query($q) or die(mysql_errno());
		
		$q="update posts set points=points-5,postlikes=postlikes-1 , postdislikes=postdislikes+1 where postid=$postid";
		$r=mysql_query($q) or die(mysql_error());
	}
	elseif($countlike==0 && $countdislike==1)
	{
		$q="delete from dislikes where dislikerid=$userid AND postid=$postid";
		$r=mysql_query($q) or die(mysql_error()); 
		
		$q="update posts set points=points+2 , postdislikes=postdislikes-1 where postid=$postid";
		$r=mysql_query($q) or die(mysql_error());
	}
    //echo "The dislike function is called.";
    exit;
}

?>		