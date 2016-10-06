<?php ?>
<div class="well">
                    <h4>Search</h4><div align="center">
                    <input type="radio" id="tag_s" name="rad">&nbsp; Tag &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="post_s" name="rad"> &nbsp; Post <br></div>
                    <div id="error"></div><br>
                    <div class="input-group">
                        <input type="text" class="form-control" id="sear" placeholder="Search" onkeyup="findmatch();">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>

      
                        <div id="res">

</div>



<?php 

function ajax_call(){

?>

                <script type="text/javascript"> 
                    function findmatch()
                    {
                        b = document.getElementById('tag_s');
                        p = document.getElementById('post_s');
                        var v;
                        if(b.checked==true){
                            v=1;
                        }
                        else if(p.checked ==true){
                            v=2;
                        }
                        else
                        {
                            document.getElementById('error').innerHTML='<br>Please first Select What to search';
                            document.getElementById('sear').value='';
                            return;
                        }
                       document.getElementById('error').innerHTML='';
                    //  document.getElementById('o').value;
                        if(window.XMLHttpRequest)
                        {
                            xmlhttp= new XMLHttpRequest();
                        }
                        else
                        {
                            xmlhttp = new ActiveXObject();
                        }
                        
                        xmlhttp.onreadystatechange = function()
                        {
                            if(xmlhttp.readyState == 4 && xmlhttp.status==200)
                            {
                                document.getElementById('res').innerHTML = xmlhttp.responseText;
                            }
                        }
                        parameter = 'key='+document.getElementById('sear').value+'&val='+v;
                        xmlhttp.open('POST','ajx.php',true);
                        xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                        xmlhttp.send(parameter);
                    }


                </script>
                <!-- Blog Categories Well -->



<?php } ?>

<?php

function showRss(){
?>

<script>
         function showRSS(str) {
            if (str.length==0) { 
               document.getElementById("output").innerHTML="";
               return;
            }
         
            if (window.XMLHttpRequest) {
               xmlhttp=new XMLHttpRequest();
            }
            else 
            {
               xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
               if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                  document.getElementById("output").innerHTML=xmlhttp.responseText;
               }
            }
            
            parameter = 'q='+str;
            xmlhttp.open('POST','rss.php',true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send(parameter);
        

         }
      </script>


<?php
}
?>

<?php

function showPosts(){
?>

<script>
         function showPOSTS(str) {
            if (str.length==0) { 
               document.getElementById("output").innerHTML="";
               return;
            }
         
            if (window.XMLHttpRequest) {
               xmlhttp=new XMLHttpRequest();
            }
            else 
            {
               xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
               if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                  document.getElementById("output_posts").innerHTML=xmlhttp.responseText;
               }
            }
            
            parameter = 'q='+str;
            xmlhttp.open('POST','site_crawl.php',true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send(parameter);
        

         }
      </script>


<?php
}
?>