<!DOCTYPE html>
<html>
<head>
  <meta  charset="utf-8">
  <!--Script Reference-->
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
</head>
<body>
  <img src="https://tracking.zingchart.com/piwik/piwik.php?idsite=5&rec=1&action_name=Download+Package&idgoal=28" style="border:0" alt="" />
  <!--Chart Placement-->
<?php
    include("DB_config.php");
    include("DB_class.php");
    $db = new DB();
    $db->connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
	/* 接收資料 */
	$value=$_POST['sample'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	if($value!=0)
        {
	/* 陣列轉換及切割 */
	$select =implode($value);
	$sp = str_split($select,3);
        $draw=array(); 
		foreach($sp as $label)
		{
			$data=array();
			$time=array();
        		$i=0;
			/* 四種狀況判斷 */
                        if($start == '' && $end == '')	
			$db->query("SELECT * FROM `$label`");
			
			else if($start == '' &&  $end != '')
                        $db->query("SELECT * FROM `$label` WHERE `'Elapsed time'` BETWEEN '\'0:00.000\'' AND $end ");

			else if($start != '' &&  $end == '')
			$db->query("SELECT * FROM `$label` WHERE `'Elapsed time'` BETWEEN $start AND '\'0:59.997\'' ");
                        
			else
                        $db->query("SELECT * FROM `$label` WHERE `'Elapsed time'` BETWEEN $start AND $end ");
	
			 while($row = $db->fetch_array())
                	 {	
		 	 $data[$i]=$row[1].',';
			 $time[$i]=$row[0].',';
		 	 $i++;
		 	 }
		 	$data=implode($data);
			$time=implode($time);
			/* 輸出圖表格式 */
		 	echo"<div id=\"chartDiv$label\"></div>";
			echo "<script>var myLabel$label=[$data];
				      var myData$label=[$time];
                              </script>  ";
			
			$draw[$label]	 =	"zingchart.render({
    					id:\"chartDiv$label\",
    					width:\"100%\",
    					height:250,
    					data:{
    						\"type\":\"line\",
    						\"title\":{
        					\"text\":\"$label\"
    						},
    						\"scale-x\":{
        					\"labels\":myData$label
    						},
    						\"series\":[
        					{
            					\"values\":myLabel$label
        					}
						]
						}
						}); ";
			

		
				
		}
        /* 輸出圖表 */
	echo"<script>window.onload=function(){";

	foreach($sp as $label)     
	echo $draw[$label];
	echo "};</script>";

	}
?>

</body>
</html>
