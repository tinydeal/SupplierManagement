<?php
/*
 * @auther lion
 * @date 2013-1-26
 */
require_once "./class/code_names.class.php";
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
			if(strstr($_SESSION['user_permission_name'],CodeNames::permission_name_procurement)||strstr($_SESSION['user_permission_name'],CodeNames::permission_name_administrator))
				require_once './supplier_category_controller.php';
			else
				header("Location: ./index.php?mod=home");
			break;
		case 'supplier':
			if(strstr($_SESSION['user_permission_name'],CodeNames::permission_name_procurement)||strstr($_SESSION['user_permission_name'],CodeNames::permission_name_administrator))
				require_once './supplier_controller.php';
			else
				header("Location: ./index.php?mod=home");
			break;

		case 'goods_category':
			if(strstr($_SESSION['user_permission_name'],CodeNames::permission_name_procurement)||strstr($_SESSION['user_permission_name'],CodeNames::permission_name_administrator))
				require_once './goods_category_controller.php';
			else
				header("Location: ./index.php?mod=home");
			break;
			
		
		case 'goods':
			if(strstr($_SESSION['user_permission_name'],CodeNames::permission_name_procurement)||strstr($_SESSION['user_permission_name'],CodeNames::permission_name_administrator))
				require_once './goods_controller.php';
			else
				header("Location: ./index.php?mod=home");
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