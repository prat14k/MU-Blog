<script>
	

    function ajx_comments(){

            if (($('textarea#comment_submit').val() != undefined)&& ($('textarea#comment_submit').val() != "")) {
   			var msg = $('textarea#comment_submit').val();
	}
	else
		return;
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
                    document.getElementById('all_comments').innerHTML = xmlhttp.responseText;
                }
            }
            parameter = 'comment='+msg+'&commenterid='+<?php echo $_SESSION['userid'] ?>+'&com_postid='+<?php echo $postonpageid; ?>;
            xmlhttp.open('POST','comments.php',true);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xmlhttp.send(parameter);
            console.log(parameter+" "+msg);
        
	
        }

	function dellete(){
	 $('textarea#comment_submit').val('') ;
	}
    </script>