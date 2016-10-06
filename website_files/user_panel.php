 <?php
include('connection.php');
session_start();
	if(!isset($_SESSION['userid']))
	{
		header('location: panel_login.php');
	}
	class topcategory{
		public $name;
		public $points;

		function __construct()
		{
			$name="";
			$points=0;
		}
		function setname($name)
		{
			$this->name=$name;
		}
		function setpoints($points)
		{
			$this->points=$points;
		}
	}
	function cmp($a,$b)
	{
		return ($b->points - $a->points);
	}
	
	$category=array();
	$i=0;
	$r=mysql_query("select * from category");
	while($row=mysql_fetch_array($r))
	{
		$category[$i]=new topcategory();
		$category[$i]->setname($row['categoryid']);
		$i++;
	}
	//print_r($category);
	
	$r=mysql_query("select * from posts where postauthorid=$_SESSION[userid]");
	$count_posts=mysql_num_rows($r);
	$posts=array();
	$i=0;
	$cat_size=count($category);
	while($row=mysql_fetch_array($r))
	{
		for($j=0;$j<$cat_size;$j++)
		{
			if($row['postcategoryid']==$category[$j]->name)
			{
				$category[$j]->points=$category[$j]->points+$row['points'];
			}
		}
	}
	//echo "<pre>";
	//print_r($category);
	usort($category,"cmp");
	//print_r($category);
	$string="['category','points']";
	for($i=0;$i<5;$i++)
	{
		$id=$category[$i]->name;
		$w=mysql_query("select * from category where categoryid=$id");
		$x=mysql_fetch_array($w);
		$string=$string.",['".$x['categoryname']."',".$category[$i]->points."]";
	}
	//echo $string;
	//die();
	$r=mysql_query("select sum(postviews) as views from posts where postauthorid=$_SESSION[userid]");
	$c=mysql_fetch_array($r);
	$count_views=$c['views'];
	//echo $count_views;


?>
		
<?php

include("header2.php");
?>
            
            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="dashboard.html">Home</a></li>        </ul>
            </nav>

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_a">
                                <div class="info_box_body">
                                    <span class="info_box_icon icon_book"></span>
                                    <span class="countUpMe" data-endVal="<?php echo $count_posts;?>"><?php echo $count_posts;?></span>
                                </div>
                                <div class="info_box_footer">
                                    Total Posts
                                </div>
                            </div>
                        </div>
						 <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_b">
                                <div class="info_box_body">
<?php $resss=mysql_query("SELECT COUNT(message_id) as aaa FROM recieved_mails where read_status=0 and reciever_user='".$_SESSION['username']."'");
$row = mysql_fetch_array($resss);?>
                                    <span class="info_box_icon icon_mail"></span>
                                    <span class="countUpMe" data-endVal="<?php echo $row['aaa'];?>"><?php echo $row['aaa'];?></span>
                                </div>
                                <div class="info_box_footer">
                                    Total Mail
                                </div>
                            </div>
                        </div>
						 <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_c">
                                <div class="info_box_body">
                                    <span class="info_box_icon icon_laptop"></span>
                                    <span class="countUpMe" data-endVal="<?php echo $count_views;?>"><?php echo $count_views;?></span>
                                </div>
                                <div class="info_box_footer">
                                    Total Views on all posts
                            </div>
                        </div>
						</div>
						 <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_d">
                                <div class="info_box_body">
                                    <span class="info_box_icon icon_currency"></span>
                                    <span class="countUpMe" data-endVal="<?php echo $count_posts;?>"><?php echo $count_posts;?></span>
                                </div>
                                <div class="info_box_footer">
                                    Money In Account
                            </div>
                        </div>
						</div>
 </div>
 

 </div>
 </div>

			<?php include('admin_mainmenu.php');?>
               

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

        <script src="assets/js/yukon_all.js"></script>

	    <!-- page specific plugins -->

            <!-- c3 charts -->
            <script src="assets/lib/d3/d3.min.js"></script>
            <script src="assets/lib/c3/c3.min.js"></script>
            <!-- vector maps -->
            <script src="assets/lib/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="assets/lib/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
            <!-- countUp animation -->
            <script src="assets/js/countUp.min.js"></script>
            <!-- easePie chart -->
            <script src="assets/lib/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

            <script>
                $(function() {
                    // c3 charts
                    yukon_charts.p_dashboard();
                    // countMeUp
                    yukon_count_up.init();
                    // easy pie chart
                    yukon_easyPie_chart.p_dashboard();
                    // vector maps
                    yukon_vector_maps.p_dashboard();
                    // match height
                    yukon_matchHeight.p_dashboard();
                })
            </script>

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
 </body>

</html>		