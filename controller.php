<?php
/*
 * @auther lion
 * @date 2013-1-26
 */
if(!isset($_SESSION['username'])){
	header("Location: ./login.php");
}
if(isset($_GET['mod'])){
	$mod=$_GET['mod'];
	switch ($mod){
		case 'home':
			require_once './home_controller.php';
			break;
		case 'supplier_category':
			require_once './supplier_category_controller.php';
			break;
		case 'supplier':
			require_once './supplier_controller.php';
			break;
		case 'goods_category':
			require_once './goods_category_controller.php';
			break;
		case 'goods':
			require_once './goods_controller.php';
			break;
		case 'order':
			require_once './order_controller.php';
			break;
		case 'problem':
			require_once './problem_controller.php';
			break;
		case 'personnel_category':
			require_once './personnel_category_controller.php';
			break;
		case 'user':
			require_once './user_controller.php';
			break;
		case 'log':
			require_once './log_controller.php';
			break;
		default:	
			break;
	}
}else{
	header("Location: ./index.php?mod=home");
}

 
?>