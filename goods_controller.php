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
			require_once './goods_view_ls.php';
			break;
		case 'add_get':
			require_once './goods_view_add_form.php';
			break;
		case 'add_post':
			require_once './class/goods_service.class.php';
			require_once 'class/goods.class.php';			
			$goods_name=$_POST['goods_name']; 
			$goods_category_id=$_POST['goods_category_id']; 
			$price=$_POST['price']; 
			$size=$_POST['size'];
			$color=$_POST['color']; 
			$description=$_POST['description']; 
			$website=$_POST['website']; 
			$note=$_POST['note']; 
			$goods=new Goods(null,$goods_name,$goods_category_id,null,$price,$size,$color,$description,$website,$note);
			$goods_service=new GoodsService();
			$id=$goods_service->addGoods($goods);
			
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加产品类别:".$goods_name."成功";
			
			$log_service->addLog("insert","产品类别",$id);
			header("Location: ./index.php?mod=goods&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/goods_service.class.php';
			require_once 'class/goods.class.php';
			$goods_service=new GoodsService();
			$goods=$goods_service->getGoodsById($id);
			$goods=serialize($goods);
			$_SESSION['goods']=$goods;
			require_once './goods_view_edit_form.php';
			}else{
				header("Location: ./index.php?mod=goods&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=goods&action=ls");
			}
			break;
		case 'edit_post':
			if(isset($_SESSION["id"])){
				require_once './class/goods_service.class.php';
				require_once 'class/goods.class.php';				
				$id=$_SESSION["id"];
				unset($_SESSION["id"]);
				$goods_name=$_POST['goods_name']; 
				$goods_category_id=$_POST['goods_category_id']; 
				$system_number=$_POST['system_number']; 
				$price=$_POST['price']; 
				$size=$_POST['size'];
				$color=$_POST['color']; 
				$description=$_POST['description']; 
				$website=$_POST['website']; 
				$note=$_POST['note']; 
				$goods=new Goods($id,$goods_name,$goods_category_id,$system_number,$price,$size,$color,$description,$website,$note);
				$goods_service=new GoodsService();
				$goods_service->updateGoods($goods);
				
				$_SESSION['operation']=true;
				$_SESSION['operation_msg']="修改产品:".$goods_name."成功";	
				
				$log_service->addLog("update","产品",$id);			
			}else{
				$_SESSION['operation']=false;
				$_SESSION['operation_msg']="修改产品:".$goods_name."失败";
				
			}
			header("Location: ./index.php?mod=goods&action=ls");
			break;
		case 'detail':
			if(isset($_GET['did'])){
				$id=$_GET['did'];
				if(is_numeric($id)){
				require_once './class/goods_service.class.php';
				require_once 'class/goods.class.php';
				$goods_service=new GoodsService();
				$goods=$goods_service->getGoodsById($id);
				$goods=serialize($goods);
				$_SESSION['goods']=$goods;
				require_once './goods_view_detail.php';
				}else{
					header("Location: ./index.php?mod=goods&action=ls");
				}
			}else{
					header("Location: ./index.php?mod=goods&action=ls");
			}
			break;		
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=goods&action=ls");
}

?>