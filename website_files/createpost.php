<?php 
require('connection.php');
session_start();
?>


<?php
include("header.php");
?>

<br>
<br>
 <script src="ckeditor/ckeditor.js"></script>
<div style="padding : 40px 40px 40px 40px ;">
 <form action="enterpost.php" method="post">
 			<input type="text" name="postname" placeholder="enter post name">
            <br>
            <br>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
               
            </textarea>
			select category:
			<select name="category">
			<?php 
				$q="select * from category";
				$r=mysql_query($q) or die(mysql_error());
				while($row=mysql_fetch_array($r))
				{
					echo "<option>";
					echo $row['categoryname'];
					echo "</option>";
				}				
			?>
			</select>
			<br><br>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
            <input type="submit" value="create post">
        </form>
        
</div>
       <?php
include("footer.php");
?>

</body>
</html>