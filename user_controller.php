<?php 
/*
 * @auther lion
 * @data 2013-1-30
 */
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './user_view_ls.php';
			break;
		case 'user_validate':
		    if(!imageCodeCheck()){
	    	echo '111';
	    	$_SESSION['image_code_error']=true;
	    	$url="./index.php";
	    }else{
	    	
	    	$name=trim($_POST['name']);
		$pwd=md5(trim($_POST['pwd']));
		$user=new User(null,$name,$pwd);
		$rs=UserController::validateUser($user);
		if(!$rs){
			$url="./index.php";
			$_SESSION['error']=true;
				}else{
					$url="./success.php";
	
					$_SESSION['name']=$name;
			if(isset($_POST['auto_login'])){
	
					$auto_login=$_POST['auto_login'];
 			echo $auto_login;
  				  	setcookie("name",$name,time()+3600);
    		    	setcookie("pwd",$pwd,time()+3600);
			}
	
			}
	   	 }
			break;
		case 'user_login_post':
//			require_once './class/personnel_category_service.class.php';
//			require_once 'class/personnel_category.class.php';
//			$personnel_category_name=$_POST['personnel_category_name']; 
//			$permission_name=$_POST['permission_name'];
//			$personnel_category=new PersonnelCategory(null,$personnel_category_name ,$permission_name );
//			$personnel_category_service=new PersonnelCategoryService();
//			$personnel_category_service->addPersonnelCategory($personnel_category);
//			
//			$_SESSION['operation']=true;
//			$_SESSION['operation_msg']="添加人员类别:".$personnel_category_name."成功";
			
			header("Location: ./index.php?mod=user&action=ls");
			break;	
		case 'edit_get':
//			if(isset($_GET['eid'])){
//			$id=$_GET['eid'];
//			if(is_numeric($id)){
//			require_once './class/personnel_category_service.class.php';
//			require_once 'class/personnel_category.class.php';
//			$personnel_category_service=new PersonnelCategoryService();
//			$personnel_category=$personnel_category_service->getPersonnelCategoryById($id);
//			$personnel_category=serialize($personnel_category);
//			$_SESSION['personnel_category']=$personnel_category;
//			require_once './personnel_category_view_edit_form.php';
//			}else{
//				header("Location: ./index.php?mod=user&action=ls");
//			}
//			}else{
//				header("Location: ./index.php?mod=user&action=ls");
//			}
			break;
		case 'edit_post':
//			if(isset($_SESSION["id"])){
//				require_once './class/personnel_category_service.class.php';
//				require_once 'class/personnel_category.class.php';				
//				$id=$_SESSION["id"];
//				unset($_SESSION["id"]);
//				$personnel_category_name=$_POST['personnel_category_name'];
//				$permission_name=$_POST['permission_name'];
//				$personnel_category=new PersonnelCategory($id,$personnel_category_name,$permission_name);
//				$personnel_category_service=new PersonnelCategoryService();
//				$personnel_category_service->updatePersonnelCategory($personnel_category);
//				
//				$_SESSION['operation']=true;
//				$_SESSION['operation_msg']="修改人员类别:".$personnel_category_name."成功";				
//			}else{
//				$_SESSION['operation']=false;
//				$_SESSION['operation_msg']="修改人员类别:".$personnel_category_name."失败";
//				
//			}
			header("Location: ./index.php?mod=user&action=ls");
				
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=user&action=ls");
}

function imageCodeCheck(){
	$input_image_code=$_POST['input_image_code'];
	$image_code=$_SESSION['$image_code'];
	
	if(strcmp($input_image_code , $image_code)==0){
		return true;
	}else return false;
}
?>