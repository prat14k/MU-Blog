<?php
include('connection.php');
$catid=$_POST['catid'];
	class toppostscategory{
		public $name;
		public $points;

		function __construct()
		{
			$name="";
			$points=0;
		}
		function setname($name)
		{
			$this->name=$name;
		}
		function setpoints($points)
		{
			$this->points=$points;
		}
	}
	function cmp($a,$b)
	{
		return ($b->points - $a->points);
	}
	
	$postname=array();
	$i=0;
	//echo $_SESSION['userid'];
	$r=mysql_query("select * from posts where postcategoryid=$catid order by  points desc limit 5") or die(mysql_error());
	//echo $r;
	//die();
	while($row=mysql_fetch_array($r))
	{
		$postname[$i]=new toppostscategory();
		$postname[$i]->setname($row['postname']);
		$postname[$i]->setpoints($row['points']);
		$i++;
	}
	//print_r($postname);
	
	$string="['postname','points']";
	for($i=0;$i<5;$i++)
	{
		$string=$string.",['".$postname[$i]->name ."',".$postname[$i]->points."]";
	}
	//echo $string;
	//die();
?>
<html>
<head>	
 <script src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawAnnotations);

function drawAnnotations() {
		var data = google.visualization.arrayToDataTable([
         <?php echo $string;?>
      ]);
      var options = {
        title: 'Top Posts Of Yours',
        annotations: {
          alwaysOutside: false,
          textStyle: {
            fontSize: 14,
            color: '#000',
            auraColor: 'none'
          }
        },
        hAxis: {
          title: 'postname',
          //format: 'h:mm a',
          //viewWindow: {
            //min: [7, 30, 0],
            //max: [17, 30, 0]
          //}
        },
        vAxis: {
          title: 'Points)'
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
</head>
<body>
	<div id="chart_div"></div>
</body>
</html>	
	