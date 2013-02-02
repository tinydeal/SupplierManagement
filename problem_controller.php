<?php 
/*
 * @auther lion
 * @date 2013-2-2
 */
require_once './class/log_service.class.php';
$log_service=new LogService();
if(isset($_GET['action'])){
	$action=$_GET['action'];
	switch ($action){
		case 'ls':
			require_once './problem_view_ls.php';
			break;
		case 'add_get':
			require_once './problem_view_add_form.php';
			break;
		case 'add_post':
			require_once './class/problem_service.class.php';
			require_once 'class/problem.class.php';			
			$problem_name_category=$_POST['problem_name_category']; 
			$supplier_id=$_POST['supplier_id']; 
			$description=$_POST['description']; 
			$note=$_POST['note'];
			$problem=new Problem(null,$problem_name_category,$supplier_id,$description,$note);
			$problem_service=new ProblemService();
			$id=$problem_service->addProblem($problem);
			
			$_SESSION['operation']=true;
			$_SESSION['operation_msg']="添加合作问题记录:".$problem_name_category."成功";
			
			$log_service->addLog("insert","合作问题记录",$id);
			header("Location: ./index.php?mod=problem&action=ls");
			break;	
		case 'edit_get':
			if(isset($_GET['eid'])){
			$id=$_GET['eid'];
			if(is_numeric($id)){
			require_once './class/problem_service.class.php';
			require_once 'class/problem.class.php';
			$problem_service=new ProblemService();
			$problem=$problem_service->getProblemById($id);
			$problem=serialize($problem);
			$_SESSION['problem']=$problem;
			require_once './problem_view_edit_form.php';
			}else{
				header("Location: ./index.php?mod=problem&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=problem&action=ls");
			}
			break;
		case 'edit_post':
			if(isset($_SESSION["id"])){
				require_once './class/problem_service.class.php';
				require_once 'class/problem.class.php';				
				$id=$_SESSION["id"];
				unset($_SESSION["id"]);
				$problem_name_category=$_POST['problem_name_category']; 
				$supplier_id=$_POST['supplier_id']; 
				$description=$_POST['description']; 
				$note=$_POST['note'];
				$problem=new Problem(null,$problem_name_category,$supplier_id,$description,$note);
				$problem_service=new ProblemService();
				$id=$problem_service->updateProblem($problem);
				
				$_SESSION['operation']=true;
				$_SESSION['operation_msg']="修改合作问题记录:".$problem_name_category."成功";	
				
				$log_service->addLog("update","合作问题记录",$id);			
			}else{
				$_SESSION['operation']=false;
				$_SESSION['operation_msg']="修改合作问题记录:".$problem_name_category."失败";
				
			}
			header("Location: ./index.php?mod=problem&action=ls");
			break;
		case 'detail':
				if(isset($_GET['did'])){
			$id=$_GET['did'];
			if(is_numeric($id)){
			require_once './class/problem_service.class.php';
			require_once 'class/problem.class.php';
			$problem_service=new ProblemService();
			$problem=$problem_service->getProblemById($id);
			$problem=serialize($problem);
			$_SESSION['problem']=$problem;
			require_once './problem_view_detail.php';
			}else{
				header("Location: ./index.php?mod=problem&action=ls");
			}
			}else{
				header("Location: ./index.php?mod=problem&action=ls");
			}
			break;		
		default:
			break;			
	}
}else{
	header("Location: ./index.php?mod=problem&action=ls");
}
?>