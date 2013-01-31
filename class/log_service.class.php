<?php
class LogService{
	private $g_db;
	public function __construct(){
		require_once './class/log.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_log"){

		$array_log=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_log;
	}
	
	public function getListRows($sql="select count(*) from t_log"){
		return $this->g_db->getRows($sql);
	}
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select * from t_log where concat (username , operation_msg ) like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$array_log=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_log;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*) from t_log where concat (username , operation_msg ) like "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	public function addLog($operation,$modify_type,$id){
		date_default_timezone_set('PRC');
		$log_username="username";//等用户功能做好后改为登录用户名$_SESSION['username']
		$log_modified=date('Y-m-d H:i:s');
		$log_operation_msg=$log_username;
			switch ($operation) {
				case 'insert':
					$log_operation_msg.="添加新的".$modify_type;
					$sql=sprintf("insert into t_log (operation_msg,username,modified) values('%s','%s','%s')",$log_operation_msg,$log_username,$log_modified);
					$this->g_db->Execute($sql);
					break;
				case 'update':
					$log_operation_msg.="更改了编号为".$modify_type;
					break;
				case 'delete':
					# code...
					break;
				default:
					# code...
					break;
			}
	}
}