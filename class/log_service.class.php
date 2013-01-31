<?php
/*
 * @auther udzhou
 * @date 2013-1-30
 */
class LogService{
	private $g_db;
	public function __construct(){
		require_once './class/log.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_log"){
		$sql=$sql." order by id desc";
		$array_log=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_log;
	}
	
	public function getListRows($sql="select count(*) from t_log"){
		return $this->g_db->getRows($sql);
	}
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select * from t_log where concat (username , operation_msg ) like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by id desc";
		$array_log=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_log;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*) from t_log where concat (username , operation_msg ) like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	public function addLog($operation,$modify_type,$id){		
		date_default_timezone_set('PRC');
		if(isset($_SESSION['username'])){
			$log_username=$_SESSION['username'];//等用户功能做好后改为登录用户名$_SESSION['username']
		}
		else{
			$log_username="新用户";
		}
		if(!$id)
			$id=$this->g_db->getLastId();
		$log_modified=date('Y-m-d H:i:s');
		$log_operation_msg=$log_username;		
		switch ($operation) {
			case 'insert':
				$log_operation_msg.="添加编号为".$id."的".$modify_type;					
				break;
			case 'update':
				$log_operation_msg.="更改了编号为".$id.$modify_type."的信息";
				break;
			case 'login':
				$log_operation_msg.="登录系统";
				break;
			case 'register':
				$log_operation_msg.="注册帐号,编号为".$id;
				break;
			case 'delete':
				$log_operation_msg.="删除了编号为".$id.$modify_type."的信息";
				break;
			default:
				# code...
				break;
		}
		$sql=sprintf("insert into t_log (operation_msg,username,modified) values('%s','%s','%s')",$log_operation_msg,$log_username,$log_modified);
		$this->g_db->Execute($sql);
	}
}