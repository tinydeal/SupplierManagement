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
	

}