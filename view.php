<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AWIN mitdb ECG system</title>

    <!-- Bootstrap Core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mitdb
                    <small>AWIN Lab</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
		<!-- charrrrrrrrrt -->
		<?php include("data.php"); ?>
            </div>
             <!-- 產生按鈕--> 
            <div class="col-md-4">
                <h3>Select samples</h3>
	      <form  method="POST" target="data.php">
		<div class="btn-group" data-toggle="buttons">
                 <?php
		  require_once("DB_config.php");
    		  require_once("DB_class.php");
		 if($_SESSION['username'] != null)
                 {
		  $db = new DB();
                  $db->connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);	
		 for($opt=1;$opt<=48;$opt++)
		{
		  $db->query("SELECT `mitchum` FROM `table-index` WHERE `number` = $opt");
                  while($row = $db->fetch_array())
                       $num=$row[0];
                   
        	  echo "
		  <label class=\"btn btn-primary btn-sm col-sm-3\"><input type=\"checkbox\" autocomplete=\"off\" name=\"sample[]\" value=\"$num\">$num</label>
        	 ";
        	 }
		}
		else
                {
        		echo '<meta http-equiv=REFRESH CONTENT=2;url=index.html>';
		}
		 ?>
		</div>
		
	<h4>    </h4>
	<!-- 下拉選單 -->
	<div class="btn-group dropup">
		<div class="btn-group">
                	<button type="button" class="btn btn-default btn_start dropdown-toggle"  data-toggle="dropdown">
                        	Start Time
                        	<span class="caret"></span>
                	</button>
        		 <ul class="dropdown-menu" >
                                <li><a class="li_1" href="#"  value="'\'0:00.000\''">0:00</a></li>
                                <li><a class="li_1" href="#"  value="'\'0:10.000\''">0:10</a></li>
                                <li><a class="li_1" href="#"  value="'\'0:20.000\''">0:20</a></li>
                                <li><a class="li_1" href="#"  value="'\'0:30.000\''">0:30</a></li>
                                <li><a class="li_1" href="#"  value="'\'0:40.000\''">0:40</a></li>
                        </ul>
			<input type='hidden' name='start'>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-default btn_end   dropdown-toggle" data-toggle="dropdown">
				End Time
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" >
				<li><a  class="li_2" href="#" value="'\'0:10.000\''">0:10</a></li>
				<li><a  class="li_2" href="#" value="'\'0:20.000\''">0:20</a></li>
				<li><a  class="li_2" href="#" value="'\'0:30.000\''">0:30</a></li>
				<li><a  class="li_2" href="#" value="'\'0:40.000\''">0:40</a></li>
				<li><a  class="li_2" href="#" value="'\'0:50.000\''">0:50</a></li>
				<li><a  class="li_2" href="#" value="'\'0:59.997\''">0:59</a></li>
			</ul>
			<input type='hidden' name='end'>
 		</div>
		<button type="submit" class="btn btn-default">查詢</button>
	</div>
	</form>

	   </div> 
        </div>
        
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Jin 2017</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>

    <!-- jQuery 配合下拉選單使用 -->
<script>
     $(function(){

    	$(".li_1").on('click', function(){
	$(".btn_start").text($(this).text());
	var value = $(this).attr("value");
	$("input[name='start']").val(value);
   	});


	$(".li_2").on('click', function(){
        $(".btn_end").text($(this).text());
	 var value = $(this).attr("value");
        $("input[name='end']").val(value);
        });

    });
</script>

</body>

</html>
