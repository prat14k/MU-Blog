<?php
session_start();
include("conn.php");

if((isset($_POST['get_type']))&&(!empty($_POST['get_type']))){

	$type=$_POST['get_type'];
	if($type=='inbox'){
        
		echo "<table id=\"mailbox_table\" class=\"table table-yuk2 bg-fill toggle-arrow-tiny\" data-page-size=\"20\" data-filter=\"#message_filter\">";
		echo "<thead>";
		echo "<tr>";
        echo "<th class=\"cw footable_toggler\"></th>";
        echo "<th class=\"cw\"><input type=\"checkbox\" id=\"msgSelectAll\"></th>";
        echo "<th class=\"cw\"></th>";
        echo "<th data-hide=\"phone,tablet\">From</th>";
        echo "<th>Subject</th>";
        echo "<th data-hide=\"phone\">Date</th>";
		echo "</tr>";
		echo "</thead>";

        $results=mysql_query("SELECT message_id,message,file,sender_email,subject,read_status,name,favourite,recieve_date FROM recieved_mails WHERE trash_status=0 AND reciever_user='".$_SESSION['username']."' AND spam=0");
        if(mysql_num_rows($results)==0)
        {
            ?>
              <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="6">
                                                <ul class="pagination pagination-sm"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <h3> No Mails to show !!! </h3>
            <?php
        }
        else{
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
                echo "<td><a href=\"pages-mailbox_message.php?id=".$row['message_id']."\">".$row['subject']."</a></td>";
                echo "<td>".$d."</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        }        
    }            

	else if($type=='sent'){

		echo "<table id=\"mailbox_table\" class=\"table table-yuk2 bg-fill toggle-arrow-tiny\" data-page-size=\"20\" data-filter=\"#message_filter\">";
		echo "<thead>";
		echo "<tr>";
       echo "<th class=\"cw footable_toggler\"></th>";
       echo "<th class=\"cw\"><input type=\"checkbox\" id=\"msgSelectAll\"></th>";
       echo "<th class=\"cw\"></th>";
       echo "<th data-hide=\"phone,tablet\">To</th>";
       echo "<th>Subject</th>";
       echo "<th data-hide=\"phone\">Date</th>";
		echo "</tr>";
		echo "</thead>";

	 $results=mysql_query("SELECT message_id,message,reciever_email,subject,favourite,send_date FROM send_mails WHERE trash_status=0 AND sender_username='".$_SESSION['username']."'");
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
                $d=date('D j/m/y',strtotime($row['send_date']));
                echo $row['reciever_email'] . "</td>";
                echo "<td><a href=\"pages-mailbox_message.php?id=".$row['message_id']."\">".$row['subject']."</a></td>";
                echo "<td>".$d."</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        }        	
	}
	else if($type=='spam'){


		echo "<table id=\"mailbox_table\" class=\"table table-yuk2 bg-fill toggle-arrow-tiny\" data-page-size=\"20\" data-filter=\"#message_filter\">";
		echo "<thead>";
		echo "<tr>";
       echo "<th class=\"cw footable_toggler\"></th>";
       echo "<th class=\"cw\"><input type=\"checkbox\" id=\"msgSelectAll\"></th>";
       echo "<th class=\"cw\"></th>";
       echo "<th data-hide=\"phone,tablet\">From</th>";
       echo "<th>Subject</th>";
       echo "<th data-hide=\"phone\">Date</th>";
		echo "</tr>";
		echo "</thead>";

	    $results=mysql_query("SELECT message_id,message,sender_email,subject,read_status,name,favourite,recieve_date FROM recieved_mails WHERE trash_status=0 AND reciever_user='".$_SESSION['username']."' AND spam=1");
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
                echo "<td><a href=\"pages-mailbox_message.php?id=".$row['message_id']."\">".$row['subject']."</a></td>";
                echo "<td>".$d."</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        }        
		
	}		
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
