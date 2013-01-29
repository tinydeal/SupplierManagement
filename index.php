<?php
/*
 * @auther lion
 * @date 2013-1-26
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />
<?php
require_once './includes/css.php';
require_once './includes/js.php';
?> 
<title>供应商管理系统</title>
</head>
<body>
<?php
require_once './includes/top.php';
?>

<div class="container-fluid">
<div class="row-fluid">
<div class="span2">

	  <!--Sidebar content-->
      <?php require_once './includes/sidebar.php';?>
    </div>
<div class="span10">
<div class="operation">
<?php 
session_start();
if(isset($_SESSION["operation"])){
	$operation_msg=$_SESSION["operation_msg"];
	$flag;
	if ($_SESSION["operation"]){
		$flag="success";
	}else {
		$flag="error";
	}
	echo "<div class='alert fade in alert-".$flag."'>
	        <button type='button' class='close' data-dismiss='alert' >&times;</button>
	        <strong>".$operation_msg."</strong>
	        </div>";
	unset($_SESSION["operation"]);
	
}

?>
</div>
<!--Body content-->
 <?php require_once './controller.php';?>
</div>
</div>
</div>


<?php
require_once './includes/bottom.php';
?>
</body>
</html>