<?php
@ini_set("output_buffering", "Off");
	@ini_set('implicit_flush', 1);
	@ini_set('zlib.output_compression', 0);
	@ini_set('max_execution_time',1200);

	include 'GoogleSpeechToText.php';
	include_once('/simplehtmldom_1_5/simple_html_dom.php');
	//$videoId="YqeW9_5kURI";
    $link;
	downVideo2Audio($videoId,$filename);

	

	function downVideo2Audio($videoId,$filename){
		//$o=shell_exec("youtube-dl -U");
		$output = shell_exec("youtube-dl -f 140 https://www.youtube.com/watch?v=".$videoId." -o ".$filename.".m4a 2>&1");
		//var_dump($output);
		echo "Created a m4a audio file";
		echo "<br>";
		echo "to save file right click on the download link and select save link as";
		echo "<br>";
		echo "<a href='$filename".".m4a"."'>download</a>";

	}
	/*
	splitAudio($videoId.".m4a");
	function splitAudio($file2){// in m4a format
		
		//$output = shell_exec("ffmpeg/ffmpeg -i ".$file2." -t 00:00:05 -c copy small-1.m4a -ss 00:00:05 -t 00:00:05 -codec copy small-2.m4a -ss 00:00:10 -t 00:00:05 -codec copy small-3.m4a -ss 00:00:15 -t 00:00:05 -codec copy small-4.m4a -ss 00:00:20 -codec copy small-5.m4a 2>&1");
		//$output = shell_exec("ffmpeg -i ".$file2." -t 00:00:10 -c copy small-1.m4a 	-ss 00:00:10 -codec copy small-2.m4a 2>&1");
		 $output1 = shell_exec("ffmpeg/ffmpeg -i ".$file2." nn.mp3 2>&1");
		 var_dump($output1);

	}
	@ini_set("output_buffering", "Off");
	@ini_set('implicit_flush', 1);
	@ini_set('zlib.output_compression', 0);
	@ini_set('max_execution_time',1200);
	for ($i=1; $i <= 4; $i++) { 
		convert2Flac("small-".$i);
		//echo "small-1";
		
		send2SpeechAPI("small-".$i.".flac");
		if(sleep(2)!=0)
        {
        echo "sleep failed script terminating"; 
        break;
        }
       flush();
       ob_flush();

		//send2SpeechAPI("s.flac");


	
	}


	function convert2Flac($file3){
		//echo $file3;
		//echo "ffmpeg -i ".$file3.".m4a ".$file3.".flac 2>&1 ";
		$output = shell_exec("ffmpeg -i ".$file3.".m4a  ".$file3.".flac 2>&1 ");

	}
	@ini_set("output_buffering", "Off");
	@ini_set('implicit_flush', 1);
	@ini_set('zlib.output_compression', 0);
	@ini_set('max_execution_time',1200);
	function send2SpeechAPI($file4){//in flac
		$apiKey = "AIzaSyA1h8b3dOtDF4806XFBeOLs5607a4JV11c";
		$speech = new GoogleSpeechToText($apiKey);
		$file = realpath(__DIR__ . "/".$file4); // Full path to the file.
		$bitRate = 44100; // The bit rate of the file.
		try{

			$result = $speech->process($file, $bitRate, 'en-US');// Result Of speech converted text from google speec
			//echo $result;
			str_replace("\"","\\\"",$result);
			$k= strchr($result,"pt");
			$g= strchr($k,":");
			$h=strchr($g,"\"");
			$k=strchr($h,substr($h,1,strlen($h)));
			$j= strchr($k,"}",true);
			$final = substr($j,0,strlen($j)-1);
			if(strpos($final,"\""))
			{
			echo $final2= strchr($final,"\"",true);
			send2Alchemy($final2);
			}
			else
			{
			    echo $final;
			    send2Alchemy($final);
			}
			

		}
		catch(Exception $e){
			echo $e->getMessage() . " <br> " ; 
		}

		//echo "printed";
		

	}
	
	//send2Alchemy('I like to play basketball. like BMW. like to play in the ground. like Honda bikes.  like SAP Labs. like to code in Java.');
	function send2Alchemy($str){
		require_once 'alchemyapi.php';
		$alchemyapi = new AlchemyAPI();
		$demo_text = $str;
		
		
		
		echo PHP_EOL;
		 $arr = array();


		$response = $alchemyapi->entities('text',$demo_text, array('sentiment'=>1));

		if ($response['status'] == 'OK') {
			//echo '## Response Object ##', PHP_EOL;
			//echo print_r($response);

			echo PHP_EOL;
			//echo '## Entities ##', PHP_EOL;
			foreach ($response['entities'] as $entity) {
				echo 'entity: ', $entity['text'], PHP_EOL;
				array_push($arr, $entity['text']);
							
				if (array_key_exists('score', $entity['sentiment'])) {
					//echo ' (' . $entity['sentiment']['score'] . ')', PHP_EOL;
				} else {
					echo PHP_EOL;
				}
				
				echo PHP_EOL;
			}
		} 
		else {
			echo 'Error in the entity extraction call: ', $response['statusInfo'];
		}
		// keyword and entity extraction done using AlchemyAPI
		$response = $alchemyapi->keywords('text',$demo_text, array('sentiment'=>1));

		if ($response['status'] == 'OK') {
			//echo '## Response Object ##', PHP_EOL;
			//echo print_r($response);

			echo PHP_EOL;
			//echo '## Keywords ##', PHP_EOL;
			foreach ($response['keywords'] as $keyword) {
				echo 'keyword: ', $keyword['text'], PHP_EOL;
				array_push($arr, $keyword['text']);

				 			
				if (array_key_exists('score', $keyword['sentiment'])) {
					//echo ' (' . $keyword['sentiment']['score'] . ')', PHP_EOL;
				} else {
					echo PHP_EOL;
				}
				echo PHP_EOL;
			}
		} else {
			echo 'Error in the keyword extraction call: ', $response['statusInfo'];
		}
		print_r($arr);

		
		//if($arr[0]==null||$arr[1]==null)
		//{
		//	echo "didnt recognize anything";
		   
         //}
         //else
         //{
         	getAd($arr);
         //}



	}
	$ar1 = array();
	function getAd($a){
			$first;
			print_r($a);
			$second;
		if($a[0] != null ){
			$first = $a[0];
			$second = $a[1];
		}else{

			echo "error";
		}
		$html;
		$html = file_get_html('http://www.ask.com/pictures?qsrc=1&o=0&l=dir&q='.$first.'+ad&qo=serpSearchTopBox');
		// Find all images 
		//$ret = $html->find('.ui-display-image ui-state-fade-out');
		$c = 0;
		$links=array();

		foreach($html->find('img') as $element){
			if ($c>0) {
				break;
			}
			$c = $c +1;
			$ar1['param1'] = $element->src;
			echo $element->src . '<br>';
			$links[0]=$element->src;
			
		} 
		$html = file_get_html('http://www.ask.com/pictures?qsrc=1&o=0&l=dir&q='.$second.'+ad&qo=serpSearchTopBox');
		// Find all images 
		//$ret = $html->find('.ui-display-image ui-state-fade-out');
		$c = 0;
		

		foreach($html->find('img') as $element){
			if ($c>0) {
				break;
			}
			
			$ar1['param2'] = $element->src;
			echo $element->src . '<br>';
			$link=$element->src;
			$links[1]=$link;
			$c = $c +1;
			//html_method($link);


		}
		html_method($links);
		

    		 



	}
function html_method($links)
{	


	
echo "<img name=\"img1\"src=\"".$links[0]."\" style=\"width:304px;height:228px\" >
    <img name=\"img2\" src=\"".$links[1]."\" style=\"width:304px;height:228px\" >";



}*/
?>