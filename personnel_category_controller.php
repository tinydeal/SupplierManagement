<?php
/*
 * @auther
 * @date 2013 1-26
 */
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './personnel_category_view_ls.php';
			break;
		case 'add_get':
			echo '新增';
			break;
		case 'edit_get':
			echo '编辑';
			break;
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=personnel_category&action=ls");
}
?>
