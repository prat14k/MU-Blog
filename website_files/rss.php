<?php
   $q=$_POST["q"];
   
   if($q=="cnn") {
      $xml=("http://rss.cnn.com/rss/cnn_topstories.rss");
   }
   
   elseif($q=="bbc") {
      $xml=("http://newsrss.bbc.co.uk/rss/newsonline_world_edition/americas/rss.xml");
   }
   
   elseif($q="pcw"){
      $xml=("http://www.pcworld.com/index.rss");
   }
   $xmlDoc = new DOMDocument();
   $xmlDoc->load($xml);
   
   $channel=$xmlDoc->getElementsByTagName('channel')->item(0);
   
   $channel_title = $channel->getElementsByTagName('title')
   ->item(0)->childNodes->item(0)->nodeValue;
   
   $channel_link = $channel->getElementsByTagName('link')
   ->item(0)->childNodes->item(0)->nodeValue;
   
   $channel_desc = $channel->getElementsByTagName('description')
   ->item(0)->childNodes->item(0)->nodeValue;
   
   echo("<p><a href='" . $channel_link . "'>" . $channel_title . "</a>");
   echo("<br>");
   echo($channel_desc . "</p>");
   
   $x=$xmlDoc->getElementsByTagName('item');
   
   for ($i=0; $i<=2; $i++) {
      $item_title=$x->item($i)->getElementsByTagName('title')
      ->item(0)->childNodes->item(0)->nodeValue;
      
      $item_link=$x->item($i)->getElementsByTagName('link')
      ->item(0)->childNodes->item(0)->nodeValue;
      
      $item_desc=$x->item($i)->getElementsByTagName('description')
      ->item(0)->childNodes->item(0)->nodeValue;
      
      echo ("<p><a href='" . $item_link . "'>" . $item_title . "</a>");
      echo ("<br>");
      echo trim($item_desc . "</p>");
   }
?>