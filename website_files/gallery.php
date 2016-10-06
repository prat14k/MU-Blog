 <?php
	session_start();
include("connection.php");
include("header2.php");	
?>
            <!-- magnific -->
            <link href="assets/lib/magnific-popup/magnific-popup.css" rel="stylesheet" media="screen">

            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="dashboard.html">Home</a></li>
		            <li><span>Components</span></li>
		            <li><span>Gallery</span></li>
		        </ul>
            </nav>

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
                    <div class="gallery_filer">
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" type="text" placeholder="Filter by name, tag etc..." id="gallery_search" />
                                <span class="help-block">Eg. business, creative, photoshop</span>
                            </div>
                        </div>
                    </div>
                    <hr/>
					<?php
						$dirname = "uploads/".$_SESSION['username']."/";
						$images = glob($dirname."*.jpg");
						?>
					<ul class="gallery_grid">
						<?php
							foreach($images as $image) {
						
						//echo '<img src="'.$image.'" /><br />';
						
					//	}
					?>
                    
                        <li><!-- blueimp/uploads/$_SESSION['userid']/-->
                            <a href="<?php echo $image;?>" class="img_wrapper" title="<?php echo str_replace($dirname,"",$image);?>">
                                <img src="<?php echo $image;?>" alt=""/>
                                <span class="gallery_image_zoom">
                                    <span class="arrow_expand"></span>
                                </span>
                                <span class="hide gallery_image_tags">
                                 </span>
                            </a>
                        </li>
					<?php } ?>	
						                    </ul>
                </div>
            </div>
            <?php
            include("admin_mainmenu.php");
            ?>

        </div>

        <!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- jQuery Cookie -->
        <script src="assets/js/jqueryCookie.min.js"></script>
        <!-- Bootstrap Framework -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- retina images -->
        <script src="assets/js/retina.min.js"></script>
        <!-- switchery -->
        <script src="assets/lib/switchery/dist/switchery.min.js"></script>
        <!-- typeahead -->
        <script src="assets/lib/typeahead/typeahead.bundle.min.js"></script>
        <!-- fastclick -->
        <script src="assets/js/fastclick.min.js"></script>
        <!-- match height -->
        <script src="assets/lib/jquery-match-height/jquery.matchHeight-min.js"></script>
        <!-- scrollbar -->
        <script src="assets/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- Yukon Admin functions -->
        <script src="assets/js/yukon_all.js"></script>

	    <!-- page specific plugins -->

            <!-- magnific -->
            <script src="assets/lib/magnific-popup/jquery.magnific-popup.min.js"></script>

            <script>
                $(function() {
                    // gallery filter
                    yukon_gallery.search_gallery();
                    // magnific lightbox
                    yukon_magnific.p_components_gallery();
                })
            </script>
        
        <!-- style switcher -->
        <div id="style_switcher">
            <a class="switcher_toggle"><i class="icon_cog"></i></a>
            <div class="style_items">
                <div class="heading_b"><span class="heading_text">Top Bar Color</span></div>
                <ul class="clearfix" id="topBar_style_switch">
                    <li class="sw_tb_style_0 style_active" title=""><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_1" title="topBar_style_1"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_2" title="topBar_style_2"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_3" title="topBar_style_3"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_4" title="topBar_style_4"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_5" title="topBar_style_5"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_6" title="topBar_style_6"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_7" title="topBar_style_7"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_8" title="topBar_style_8"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_9" title="topBar_style_9"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_10" title="topBar_style_10"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_11" title="topBar_style_11"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_12" title="topBar_style_12"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_13" title="topBar_style_13"><span class="icon_check_alt2"></span></li>
                    <li class="sw_tb_style_14" title="topBar_style_14"><span class="icon_check_alt2"></span></li>
                </ul>
            </div>
            <hr/>
            <div class="clearfix hidden-sm hidden-md hidden-xs sepH_b">
                <label>Fixed layout</label>
                <div class="pull-right"><input type="checkbox" id="fixed_layout_switch" class="js-switch mini-switch"></div>
            </div>
            <div class="style_items hidden-sm hidden-md hidden-xs" id="fixed_layout_bg_switch">
                <hr/>
                <div class="heading_b"><span class="heading_text">Background</span></div>
                <ul class="clearfix">
                    <li class="sw_bg_0" title="bg_0"></li>
                    <li class="sw_bg_1" title="bg_1"></li>
                    <li class="sw_bg_2" title="bg_2"></li>
                    <li class="sw_bg_3" title="bg_3"></li>
                    <li class="sw_bg_4" title="bg_4"></li>
                    <li class="sw_bg_5" title="bg_5"></li>
                    <li class="sw_bg_6" title="bg_6"></li>
                    <li class="sw_bg_7" title="bg_7"></li>
                </ul>
                <hr/>
            </div>
            <div class="clearfix sepH_b">
                <label>Top Menu</label>
                <div class="pull-right"><input type="checkbox" id="top_menu_switch" class="js-switch mini-switch"></div>
            </div>
            <div class="clearfix sepH_b">
                <label>Hide Breadcrumbs</label>
                <div class="pull-right"><input type="checkbox" id="breadcrumbs_hide" class="js-switch mini-switch"></div>
            </div>
            <div class="text-center sepH_a">
                <button data-toggle="modal" data-target="#showCSSModal" id="showCSS" class="btn btn-default btn-xs btn-outline" type="button">Show CSS</button>
            </div>
        </div>
        <div class="modal fade" id="showCSSModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">CSS Classes</h4>
                    </div>
                    <div class="modal-body">
                        <pre id="showCSSPre"></pre>
                    </div>
                </div>
            </div>
        </div>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','../../www.google-analytics.com/analytics.js','ga');
		  
			ga('create', 'UA-54304677-1', 'auto');
			ga('send', 'pageview');
		</script>

    </body>

<!-- Mirrored from yukon-admin.tzdthemes.com/html/components-gallery.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 11:40:09 GMT -->
</html>
