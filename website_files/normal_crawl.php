<?php 
$type = "";
include("simple_html_dom.php");
$cnt=0;

$crawled_urls=array();
$found_urls=array();

function rel2abs($rel, $base){
 if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
 if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;
 extract(parse_url($base));
 $path = preg_replace('#/[^/]*$#', '', $path);
 if ($rel[0] == '/') $path = '';
 $abs = "$host$path/$rel";
 $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
 for($n=1; $n>0;$abs=preg_replace($re,'/', $abs,-1,$n)){}
 $abs=str_replace("../","",$abs);
 return $scheme.'://'.$abs;
}

function perfect_url($u,$b){
 $bp=parse_url($b);
 if(@(($bp['path']!="/" && $bp['path']!="") || $bp['path']=='')){
  if($bp['scheme']==""){$scheme="http";}else{$scheme=$bp['scheme'];}
  $b=$scheme."://".$bp['host']."/";
 }
 if(substr($u,0,2)=="//"){
  $u="http:".$u;
 }
 if(substr($u,0,4)!="http"){
  $u=rel2abs($u,$b);
 }
 return $u;
}

function crawl_site($u,$parameter){
 //global $crawled_urls;
 $uen=urlencode($u);
 //if((array_key_exists($uen,$crawled_urls)==0 || $crawled_urls[$uen] < date("YmdHis",strtotime('-25 seconds', time())))){
  $html = file_get_html($u);
  //$crawled_urls[$uen]=date("YmdHis");
  foreach($html->find($parameter) as $li)
  {
   $url=perfect_url($li->href,$u);
   //echo $url."<br>";   
   $enurl=urlencode($url);
   //echo $enurl."<br>";
   //echo substr($url,0,4);
   //print_r($found_urls);
   if(@($url!='' && substr($url,0,4)!="mail" && substr($url,0,4)!="java" && array_key_exists($enurl,$found_urls)==0)){
    $found_urls[$enurl]=1;
 // $tt = $GLOBALS['type'];
    //$base = "show_crawl.php?type=".$tt."&hyperlink=";
   echo "<a href='".$url."'>".$li->plaintext."</a><br><br>";
    @$cnt++;
    if($cnt>5)
      break;
  //echo $li->outertext."<br>";
    } 
  }
}
//}
$cnt=0;


?>