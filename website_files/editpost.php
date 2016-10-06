<?php
require('connection.php');
session_start();
$userid=$_SESSION['userid'];
$postid=$_POST['postid'];
$q="select * from posts where postid='$postid'";
$r=mysql_query($q);
while($row=mysql_fetch_array($r))
{
	$postcontent=$row['postcontent'];
	$postname=$row['postname'];
	$postcategory=$row['postcategoryid'];
}
?>

<?php
include("header.php");
?>

<br><br>
<div style="padding : 40px 40px 40px 40px ;">
 <script src="ckeditor/ckeditor.js"></script>
 <form action="savechanges.php" method="post">
			<input type="hidden" name="postid" value="<?php echo $postid;?>">
			<br>
 			<input type="text" name="postname" placeholder="enter post name" value="<?php echo $postname; ?>">
            <br>
            <br>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                <?php
					echo $postcontent;
				?>
            </textarea>
			
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
			<select name="category">
			
				<?php 
				$q="select * from category";
				$r=mysql_query($q) or die(mysql_error());
				while($row=mysql_fetch_array($r))
				{
					if($row['categoryid']==$postcategory)
					{
						echo "<option selected=\"selected\">";
						echo $row['categoryname'];
						echo "</option>";
					}
					else {
						echo "<option>";
						echo $row['categoryname'];
						echo "</option>";
					}
				}				
			?>
			</select>
            <input type="submit" value="edit post">
			
        </form>
        </div>
       <?php
	include("footer.php");
	?>

</body>
</html>