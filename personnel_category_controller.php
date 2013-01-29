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
			require_once './personnel_category_view_add_form.php';
			break;
		case 'add_post':
			require_once './class/personnel_category_service.class.php';
			require_once 'class/personnel_category.class.php';
			$category_name=$_POST['category_name'];
			$permission_name=$_POST['permission_name'];
			$personnel_category=new PersonnelCategory(null,$category_name ,$permission_name );
			$personnel_category_service=new PersonnelCategoryService();
			$personnel_category_service->addPersonnelCategory($personnel_category);
			session_start();
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加人员类别:".$category_name."成功";
			
			header("Location: ./index.php?mod=personnel_category&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/personnel_category_service.class.php';
			require_once 'class/personnel_category.class.php';
			$personnel_category_service=new PersonnelCategoryService();
			$personnel_category=$personnel_category_service->getPersonnelCategoryById($id);
			$personnel_category=serialize($personnel_category);
			$_SESSION['personnel_category']=$personnel_category;
			require_once './personnel_category_view_edit_form.php';
			}else{
				header("Location: ./index.php?mod=personnel_category&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=personnel_category&action=ls");
			}
			break;
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=personnel_category&action=ls");
}
?>
