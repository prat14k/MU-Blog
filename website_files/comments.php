<?php
require("connection.php");

//echo "good " ;


$comment = $_POST['comment'];
$commenter =$_POST['commenterid'];
$post = $_POST['com_postid'];

$d=date("Y-m-d");
$t=date("H:i:s");

$q ="Insert into comments values(NULL,'$comment',$commenter,0,'$post','$d','$t')";
mysql_query($q);



 $com = "select * from comments where com_postid=$post order by commentid asc";
        $resultss = mysql_query($com);
        if(mysql_num_rows($resultss)!=0)
        {
            while($row = mysql_fetch_array($resultss)){
                $presults = mysql_query("select `full name` from users where userid=".$row['commenterid']);
                $re = mysql_fetch_array($presults);
                $d=date('jS F , Y',strtotime($row['date_of_comment']));
                $t=date('h:m A',strtotime($row['time_of_comment']));
        ?>
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"> <?php echo $re['full name']; ?>
                    <small><?php echo $d; ?> at <?php echo $t; ?></small>
                </h4>
               <?php echo $row['comment']; ?>
            </div>
        </div>
        <?php
    }
}
else 
{
    ?>
    <small>No comments to show</small>
<?php }


?>