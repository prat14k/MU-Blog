<?php
	$db_host="*****";
	$db_user="****";
	$db_pass="******";
	$db="******";
	
	@mysql_connect($db_host,$db_user,$db_pass) or die("naa ho paa raa");
	@mysql_select_db($db);
?>