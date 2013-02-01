<?php 
/*
 * @auther lion	
 * @date 2013-2-1
 */

require_once './class/log_service.class.php';
$log_service=new LogService();
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './goods_category_view_ls.php';
			break;
		case 'add_get':
			require_once './goods_category_view_add_form.php';
			break;
		case 'add_post':
			require_once './class/goods_category_service.class.php';
			require_once 'class/goods_category.class.php';			
			
			$goods_category_name=$_POST['goods_category_name']; 
			$goods_category=new GoodsCategory(null,$goods_category_name);
			$goods_category_service=new GoodsCategoryService();
			$id=$goods_category_service->addGoodsCategory($goods_category);
			
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加产品类别:".$goods_category_name."成功";
			
			$log_service->addLog("insert","产品类别",$id);
			header("Location: ./index.php?mod=goods_category&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/goods_category_service.class.php';
			require_once 'class/goods_category.class.php';
			$goods_category_service=new GoodsCategoryService();
			$goods_category=$goods_category_service->getGoodsCategoryById($id);
			$goods_category=serialize($goods_category);
			$_SESSION['goods_category']=$goods_category;
			require_once './goods_category_view_edit_form.php';
			}else{
				header("Location: ./index.php?mod=goods_category&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=goods_category&action=ls");
			}
			break;
		case 'edit_post':
			if(isset($_SESSION["id"])){
				require_once './class/goods_category_service.class.php';
				require_once 'class/goods_category.class.php';				
				$id=$_SESSION["id"];
				unset($_SESSION["id"]);
				$goods_category_name=$_POST['goods_category_name'];
				$goods_category=new GoodsCategory($id,$goods_category_name);
				$goods_category_service=new GoodsCategoryService();
				$goods_category_service->updateGoodsCategory($goods_category);
				
				$_SESSION['operation']=true;
				$_SESSION['operation_msg']="修改人员类别:".$goods_category_name."成功";	
				
				$log_service->addLog("update","人员类别",$id);			
			}else{
				$_SESSION['operation']=false;
				$_SESSION['operation_msg']="修改人员类别:".$goods_category_name."失败";
				
			}
			header("Location: ./index.php?mod=goods_category&action=ls");
				
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=goods_category&action=ls");
}
?>