<?php
/*
 * @auther udzhou
 * @date 2013 1-31
 */
require_once './class/log_service.class.php';
$log_service=new LogService();
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './supplier_category_view_ls.php';
			break;
		case 'add_get':
			require_once './supplier_category_view_add_form.php';
			break;
		case 'add_post':
			require_once './class/supplier_category_service.class.php';
			require_once 'class/supplier_category.class.php';			
			
			$supplier_category_name=$_POST['supplier_category_name'];			
			$supplier_category=new SupplierCategory(null,$supplier_category_name);
			$supplier_category_service=new SupplierCategoryService();
			$supplier_category_service->addSupplierCategory($supplier_category);
			
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加供应商类别:".$supplier_category_name." 成功";
			$log_service->addLog("insert","供应商类别",null);
			header("Location: ./index.php?mod=supplier_category&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/supplier_category_service.class.php';
			require_once 'class/supplier_category.class.php';
			$supplier_category_service=new SupplierCategoryService();
			$supplier_category=$supplier_category_service->getSupplierCategoryById($id);
			$supplier_category=serialize($supplier_category);
			$_SESSION['supplier_category']=$supplier_category;
			require_once './supplier_category_view_edit_form.php';
			}else{
				header("Location: ./index.php?mod=supplier_category&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=supplier_category&action=ls");
			}
			break;
		case 'edit_post':
			if(isset($_SESSION["id"])){
				require_once './class/supplier_category_service.class.php';
				require_once 'class/supplier_category.class.php';				
				$id=$_SESSION["id"];
				unset($_SESSION["id"]);
				$supplier_category_name=$_POST['supplier_category_name'];				
				$supplier_category=new SupplierCategory($id,$supplier_category_name);
				$supplier_category_service=new SupplierCategoryService();
				$supplier_category_service->updatesupplierCategory($supplier_category);
				
				$_SESSION['operation']=true;
				$_SESSION['operation_msg']="修改供应商类别:".$supplier_category_name." 成功";	
				$log_service->addLog("update","供应商类别",$id);			
			}else{
				$_SESSION['operation']=false;
				$_SESSION['operation_msg']="修改供应商类别:".$supplier_category_name." 失败";
				
			}
			header("Location: ./index.php?mod=supplier_category&action=ls");
				
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=supplier_category&action=ls");
}
?>
