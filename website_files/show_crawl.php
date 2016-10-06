<?php
session_start();
  
?>
<?php include('header.php');?>
<link href="BIB_files/A_002.css" rel="stylesheet">
<style>
body{
padding-top:80px;
}
</style>
 

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-7">
                <?php 
                      include("inc.php");
                      $typee;
                      if((isset($_POST['type']))&&(isset($_POST['hyperlink'])))
                      {
                      	if((!empty($_POST['type']))&&(!empty($_POST['hyperlink'])))
                      	{
                      		$typee= $_POST['type'];
                          $hyperlink = $_POST['hyperlink'];
                          $blk=0;
	
                      	}
                      	else 
                      		echo "<meta http-equiv=\"refresh\" content=\"0;URL='index.php'\" />";

                      }
                      else
                      	  		echo "<meta http-equiv=\"refresh\" content=\"0;URL='index.php'\" />";
                      include("normal_crawl.php");
                     include("do_crawl.php");
                   if($typee=="toi")
                    {
                      
                      crawl_post($hyperlink,"div.newimgblock h1",$typee,1);
                      
                      crawl_post($hyperlink,"div.newimgblock div#loader img",$typee,2);
                      
                      crawl_post($hyperlink,"div.newimgblock div.data",$typee,3);
                    }
//include("do_crawl.php");            
                ?>
         
	

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

<?php incc(); incr(); ?>

</body>

</html>