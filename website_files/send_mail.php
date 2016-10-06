<?php

session_start();
$see_me = "@multiuserblog.esy.es";
include("conn.php");
if((isset($_POST['mail_to']))&&(isset($_POST['mail_subject']))&&(isset($_POST['editor1']))){

	$to=$_POST['mail_to'];
	
	$subj = $_POST['mail_subject'];
	$msg = $_POST['editor1'];

	//echo $to."<br>";
//	echo $subj."<br>";
//	echo $mesg."<br>";
//	die();
	if((!empty($to))&&(!empty($subj))&&(!empty($msg))){
		$p = strpos($to,$see_me);
		if($p===false){
			die();
		}
		else{
			$d=date("Y-m-d");
			$t=date("H:i:s");
			$to=str_replace($see_me,"",$to);
			
			mysql_query("INSERT INTO recieved_mails values (null,'$msg',null,'".$_SESSION['username'].$see_me."','$to',0,'$subj',0,0,'',0,0,'$d','$t')") or die(mysql_error());
		}
		$d=date("Y-m-d");
		$t=date("H:i:s");
		$to=$_POST['mail_to'];
		mysql_query("INSERT INTO send_mails values (null,'$msg',null,'".$_SESSION['username']."','".$_POST['mail_to']."',0,'$subj',0,0,'$d','$t',0)")or die("q2");

		if(isset($_POST['mail_cc'])){
				if(!empty($_POST['mail_cc'])){
					if(strpos($_POST['mail_cc'],$see_me)===false)
						mail($_POST['mail_cc'],$subj,$mesg);
					else{
							$d=date("Y-m-d");
							$t=date("H:i:s");
							$tot=chop($_POST['mail_cc'],$see_me);
							mysql_query("INSERT INTO recieved_mails values (null,'$msg',null,'".$_SESSION['username'].$see_me."','$tot',0,'$subj',0,0,'',0,0,'$d','$t')")or die("q3");	
					}
						$d=date("Y-m-d");
						$t=date("H:i:s");
						
						mysql_query("INSERT INTO send_mails values (null,'$msg',null,'".$_SESSION['username']."','".$_POST['mail_cc']."',0,'$subj',0,0,'$d','$t',0)")or die("q4");

				}
			}

		header("Location: pages-mailbox.php?it=1");
	}
	else
		header("Location: pages-mailbox_compose.php?err=1");
}
?>
