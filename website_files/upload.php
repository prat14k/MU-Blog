<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
session_start();
error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

$upload_dir = 'uploads/'.$_SESSION['username'].'/'; //specify path to your upload folder

$upload_handler = new UploadHandler(array(
											'max_file_size' => 1048576, //1MB file size
											'image_file_types' => '/\.(gif|jpe?g|png)$/i',
											'upload_dir' => $upload_dir,
											'upload_url' => 'http://multiuserblog.esy.es/'.$upload_dir,
											'thumbnail' => array('max_width' => 80,'max_height' => 80)
											));
