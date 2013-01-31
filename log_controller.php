<?php
/*
 * @auther udzhou
 * @date 2013 1-30
 */
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './log_view_ls.php';
			break;		
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=log&action=ls");
}
?>
