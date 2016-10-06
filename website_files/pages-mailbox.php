<?php 
session_start();
include("conn.php");
include("header2.php");
?>
            <!-- footable -->
            <link href="assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">

            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="dashboard.html">Home</a></li>
		            <li><span>Pages</span></li>
		            <li><span>Mailbox</span></li>
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
                                <button class="active list-group-item" onClick="mail_ajx('inbox');" id="inbox">
                                    <span class="menu_icon icon_download"></span>Inbox
                                </button>
                                <button class="list-group-item" onclick="mail_ajx('sent');" id="sent">
                                    <span class="menu_icon icon_upload"></span>Sent
                                </button>
                                <button class="list-group-item" onclick="mail_ajx('spam');" id="spam">
                                    <span class="menu_icon icon_error-circle_alt"></span>Spam
                                </button>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-10">
                            
                            <hr/>

                            <div id="messsg"></div>
                            <div id="mail_results">
                                <table id="mailbox_table" class="table table-yuk2 bg-fill toggle-arrow-tiny" data-page-size="20" data-filter="#message_filter">
                                    <thead>
                                        <tr>
                                            <th class="cw footable_toggler"></th>
                                            <th class="cw"><input type="checkbox" id="msgSelectAll"></th>
                                            <th class="cw"></th>
                                            <th data-hide="phone,tablet">From</th>
                                            <th>Subject</th>
                                            <th data-hide="phone">Date</th>
                                        </tr>
                                    </thead>
                                        <?php
                                           $results=mysql_query("SELECT message_id,message,file,sender_email,subject,read_status,name,favourite,recieve_date FROM recieved_mails WHERE trash_status=0 AND reciever_user='".$_SESSION['username']."' AND spam=0");
                                            if(mysql_num_rows($results)==0)
                                            {
                                                ?>
                                                    <script type="text/javascript">
                                                        document.getElementById("messsg").innerHTML ="<h3 align=\"center\">No mails to show !!!</h3>"; 
                                                    </script>

                                                <?php
                                            }
                                            else{
                                                    ?>

                                                    <script type="text/javascript">
                                                        document.getElementById("messsg").innerHTML =""; 
                                                    </script>
                                                    <?php
                                                echo "<tbody>";
                                                while($row=mysql_fetch_array($results)){
                                                    $r = (int)$row['read_status'];
                                                    if($r==0){
                                                        
                                                        ?>

                                                        <tr class='unreaded'>
                                                    <?php
                                                    }
                                                    else
                                                        echo "<tr>";
                                                    ?>
                                            <td></td>
                                            <td><div><input type="checkbox" class="msgSelect" /></div></td>
                                            <?php   if($row['favourite']==0)
                                                        echo "<td class=\"mbox_star\">";
                                                    else
                                                        echo "<td class=\"mbox_star marked\">"; ?>
                                            <span class="icon_star_alt"></span></td>
                                            <td>    
                                                    <?php
                                                    $d=date('D j/m/y',strtotime($row['recieve_date']));
                                                    echo $row['name'] . "</td>";
                                                    echo "<td><a href=\"pages-mailbox_message.php?message_id=".$row['message_id']."&type=recieved\">".$row['subject']."</a></td>";
                                                    echo "<td>".$d."</td>";
                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";
                                            }        
                                        ?>
                                    <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="6">
                                                <ul class="pagination pagination-sm"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="nothing"></div>
        <script>
        //debugger;
            var type="inbox";
            var prev = document.getElementById("inbox");
            function mail_ajx(strr){

            prev.className = "list-group-item";
            prev =document.getElementById(strr);
            prev.className="active list-group-item";

            if(window.XMLHttpRequest)
            {
                xmlhttp= new XMLHttpRequest();
            }
            else
            {
                xmlhttp = new ActiveXObject('MicrosoftXMLHTTP');
            }
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState == 4 && xmlhttp.status==200)
                {
                    document.getElementById('mail_results').innerHTML = xmlhttp.responseText;
                }
            }
            parameter = 'get_type='+strr;
            type=strr;
            xmlhttp.open('POST','mail_results.php',true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send(parameter);
        }
    </script>

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

            <!-- footable -->
            <script src="assets/lib/footable/footable.min.js"></script>
            <script src="assets/lib/footable/footable.paginate.min.js"></script>
            <script src="assets/lib/footable/footable.filter.min.js"></script>

            <script>
                $(function() {
                    // footable
                    yukon_footable.p_pages_mailbox();

                    yukon_mailbox.init();
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
<?php
    if(isset($_GET['it'])==1){
?>  
    <script type="text/javascript">alert("Mail is sent !!!");</script>

<?php
    }
    ?>
</html>
	