<?php 
require('connection.php');
session_start();
?>
 <?php
	if(!isset($_SESSION['userid']))
	{
		header('location: panel_login.php');
	}

include("header2.php");
?>


		<link href="blueimp/style.css" rel="stylesheet" type="text/css">
     
     
        <!-- moment.js (date library) -->
     	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		 <script src="ckeditor/ckeditor.js"></script>
		 
		  <!-- uplaoder -->
            <link href="assets/lib/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" media="screen">

   
            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="dashboard.html">Home</a></li>        </ul>
            </nav>

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
<h2>Multi File Upload </h2>
<div class="upload-wrapper">
<div id="error_output"></div>
    <!-- file drop zone -->
    <div id="dropzone">
        <i>Drop files here</i>
        <!-- upload button -->
        <span class="button btn-blue input-file">
            Browse Files <input id="fileupload" type="file" name="files[]" multiple>
        </span>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
</div>

<script src="js/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="js/load-image.all.min.js"></script> 
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<script src="js/jquery.fileupload-video.js"></script>
<script src="js/jquery.fileupload-audio.js"></script>
<script src="js/jquery.fileupload-validate.js"></script>
<script language="javascript">
$(function(){
    'use strict';
    var fi = $('#fileupload'); //file input 
    var process_url = 'http://multiuserblog.esy.es/upload.php'; //PHP script
    var progressBar = $('<div/>').addClass('progress').append($('<div/>').addClass('progress-bar')); //progress bar
    var uploadButton = $('<button/>').addClass('button btn-blue upload').text('Upload');    //upload button
    
    uploadButton.on('click', function () {
        var $this = $(this), data = $this.data();
        data.submit().always(function () {
                $this.parent().find('.progress').show();
                $this.parent().find('.remove').remove();
                $this.remove();
        });
    });

    //initialize blueimp fileupload plugin
    fi.fileupload({
        url: process_url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|mp4|mp3)$/i,
        maxFileSize: 1048576, //1MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/ 
        .test(window.navigator.userAgent),
        previewMaxWidth: 50,
        previewMaxHeight: 50,
        previewCrop: true,
        dropZone: $('#dropzone')
    });
    
    fi.on('fileuploadadd', function (e, data) {
            data.context = $('<div/>').addClass('file-wrapper').appendTo('#files');
            $.each(data.files, function (index, file){  
            var node = $('<div/>').addClass('file-row');
            var removeBtn  = $('<button/>').addClass('button btn-red remove').text('Remove');
            removeBtn.on('click', function(e, data){
                $(this).parent().parent().remove();
            });
            
            var file_txt = $('<div/>').addClass('file-row-text').append('<span>'+file.name + ' (' +format_size(file.size) + ')' + '</span>');
            
            file_txt.append(removeBtn);
            file_txt.prependTo(node).append(uploadButton.clone(true).data(data));
            progressBar.clone().appendTo(file_txt);
            if (!index){
                node.prepend(file.preview);
            }
            
            node.appendTo(data.context);
        });
    });

    fi.on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
            if (file.preview) {
                node .prepend(file.preview);
            }
            if (file.error) {
                node.append($('<span class="text-danger"/>').text(file.error));
            }
            if (index + 1 === data.files.length) {
                data.context.find('button.upload').prop('disabled', !!data.files.error);
            }
    });
    
    fi.on('fileuploadprogress', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        if (data.context) {
            data.context.each(function () {
                $(this).find('.progress').attr('aria-valuenow', progress).children().first().css('width',progress + '%').text(progress + '%');
            });
        }
    });

    fi.on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>') .attr('target', '_blank') .prop('href', file.url);
                $(data.context.children()[index]).addClass('file-uploaded');
                $(data.context.children()[index]).find('canvas').wrap(link);
                $(data.context.children()[index]).find('.file-remove').hide(); 
                var done = $('<span class="text-success"/>').text('Uploaded!');
                $(data.context.children()[index]).append(done);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index]).append(error);
            }
        });
    });
    
    fi.on('fileuploadfail', function (e, data) {
     $('#error_output').html(data.jqXHR.responseText);
    });
    
    function format_size(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }
            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }
            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }
            return (bytes / 1000).toFixed(2) + ' KB';
        }
});
</script>
        
 </div>
 </div>	
			

			<?php include('admin_mainmenu.php'); ?>
 </div>


 <!-- jQuery -->
      <!--  <script src="assets/js/jquery.min.js"></script> -->
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
			  <!-- uplaoder -->
            <script src="assets/lib/plupload/js/plupload.full.min.js"></script>
            <script src="assets/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>

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
					 // multiuploader
					 yukon_uploader.p_forms_extended();
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

<!-- Mirrored from yukon-admin.tzdthemes.com/html/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 May 2015 11:38:21 GMT -->
</html>
