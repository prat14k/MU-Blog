<?php
session_start();
include("conn.php");
if((isset($_GET['message_id']))&&(isset($_GET['type']))){
    if((!empty($_GET['message_id']))&&(!empty($_GET['type']))) {
        if($_GET['type']=='send'){
            $res = mysql_query("SELECT * FROM sent_mails where message_id=".$_GET['message_id']);
            if(mysql_num_rows($res)!=1){
                header("Location: pages-mailbox.php");
            }
        }
        else if($_GET['type']=="recieved"){
            $res=mysql_query("SELECT * FROM recieved_mails where message_id=".$_GET['message_id']) or die(mysql_error());
            if(mysql_num_rows($res)!=1){

                header("Location: pages-mailbox.php");
            }    
        }
        else
            header("Location: pages-mailbox.php");   
    }
    else
        header("Location: pages-mailbox.php");   
}
else
    header("Location: pages-mailbox.php");   


include("header2.php");
?>

            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="user_panel.php">Home</a></li>
                    <li><span>Pages</span></li>
                    <li><a href="pages-mailbox.html">Mailbox</a></li>
                    <li><span>Details</span></li>
		        </ul>
            </nav>

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-lg-2">
                            <a href="pages-mailbox_compose.php" class="btn btn-primary btn-outline btn-sm">Compose</a>
                            <hr/>
                            <div class="list-group mailbox_menu">
                                <a href="pages-mailbox.php" class="list-group-item">
                                    <span class="menu_icon icon_download"></span>Inbox
                                </a>
                                <a href="pages-mailbox.php" class="list-group-item">
                                    <span class="menu_icon icon_upload"></span>Sent
                                </a>
                                <a href="pages-mailbox.php" class="list-group-item">
                                    <span class="menu_icon icon_error-circle_alt"></span>Spam
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-default">Reply</button>
                                        <button type="button" class="btn btn-default">Spam</button>
                                        <button type="button" class="btn btn-default text-danger">Delete</button>
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-4 text-right">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-default bs_ttip" data-placement="bottom" title="Prev"><span class="el-icon-chevron-left"></span></button>
                                        <button type="button" class="btn btn-default bs_ttip" data-placement="bottom" title="Next"><span class="el-icon-chevron-right"></span></button>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <?php 
                            $t = $_GET['type'];
                            $row=mysql_fetch_array($res);
                            if($t=="recieved"){ 
                                ?>
                            <div class="mail_details_top clearfix">
                                <div class="mail_date">
                                    <?php
                                    
                                    echo $row["recieve_date"]." ".$row["recieve_time"];
                                    ?>
                                </div>
                                <div class="mail_user_image">
                                    <img src="http://placehold.it/64x64" width="38" height="38" alt="">
                                </div>
                                <div class="mail_user_info">
                                    <h2><?php

                                        echo $row['name'];

                                    ?></h2>
                                    <span class="text-muted"><?php

                                        echo $row['sender_email'];

                                    ?></span>
                                </div>
                            </div>
                            <?php
                            }
                            else{ ?>
                            <div class="mail_details_top clearfix">
                                <div class="mail_date">
                                    <?php
                                    echo $row["send_date"]." ".$row["send_time"];
                                    ?>
                                </div>
                                <div class="mail_user_image">
                                    <img src="http://placehold.it/64x64" width="38" height="38" alt="">
                                </div>
                                <div class="mail_user_info">

                                    <span class="text-muted"><?php

                                        echo $row['reciever_email'];

                                    ?></span>
                                </div>
                            </div>
                           <?php } ?>
                            <div class="mail_details_content">
                                <?php

                                        echo $row['message'];

                                    ?>                                
                            </div>
                        </div>
                    </div>
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

<!-- Mirrored from yukon-admin.tzdthemes.com/html/pages-mailbox_message.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 11:39:10 GMT -->
</html>
