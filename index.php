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