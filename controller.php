<?php
/*
 * @auther lion
 * @date 2013-1-26
 */
if(isset($_GET['mod'])){
	$mod=$_GET['mod'];
	switch ($mod){
		case 'personnel_category':
			require_once './personnel_category_controller.php';
			break;
		default:	
			break;
	}
}else{
	header("Location: ./index.php?mod=personnel_category");
}

 
?>