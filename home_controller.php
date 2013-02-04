<?php
/*
 * @auther udzhou
 * @date 2013 2-4
 */
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'latest_problem':
			require_once './home_view_latest_problem.php';
			break;
		case 'price_change':
			require_once './home_view_price_change.php';
			break;		
		default:
			break;		
	}
}else{
	header("Location: ./index.php?mod=home&action=latest_problem");
}
?>
