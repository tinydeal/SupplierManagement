<?php
/*
 * @auther lion
 * @date 2013-2-2
 */
class ProblemService{
	private $g_db;
	public function __construct(){
		require_once 'class/problem.class.php';
		require_once './class/database.class.php';
		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_problem"){

		$sql=$sql." order by modified desc";
		$array_problem=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		require_once 'class/supplier_service.class.php';
		$supplier_service=new SupplierService();
		foreach ($array_problem as $problem){
			$supplier_id=$problem->supplier_id;
			$supplier=$supplier_service->getSupplierById($supplier_id);
			$supplier_name=$supplier->supplier_name;
			$problem->supplier_name=$supplier_name;
		}
		return $array_problem;
	}
	public function getListRows($sql="select count(*) from t_problem"){
		return $this->g_db->getRows($sql);
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select  *  from t_problem,t_supplier where t_supplier.id=t_problem.supplier_id and concat ( t_problem.problem_name_category ,t_supplier.supplier_name,t_problem.description ) like  "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by t_problem.id desc ";
		$array_goods=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		return $array_goods;
	}
	public  function getListRowsByKeywords($keywords,$sql="select  *  from t_problem,t_supplier where t_supplier.id=t_problem.supplier_id and concat ( t_problem.problem_name_category ,t_supplier.supplier_name,t_problem.description ) like   "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql); 
	}
	public function addProblem($problem){
		$problem_name_category=$problem->_get('problem_name_category');
		$supplier_id=$problem->_get('supplier_id');
		$description=$problem->_get('description');
		$note=$problem->_get('note');
		$created=date('Y-m-d H:i:s');
		$sql=sprintf("insert  into  t_problem  (problem_name_category,supplier_id,description,note,created)  values ('%s','%s','%s','%s','%s')",$problem_name_category,$supplier_id,$description,$note,$created);
		$this->g_db->Execute($sql);
		return $this->g_db->getLastId();
	}
	
	public function getProblemById($id){
		$sql=sprintf("select * from t_problem where id=%d",$id);
		$problem=$this->g_db->getOne($sql);
		require_once 'class/supplier_service.class.php';
		$supplier_service=new SupplierService();
		$supplier_id=$problem->supplier_id;
		$supplier=$supplier_service->getSupplierById($supplier_id);
		$supplier_name=$supplier->supplier_name;
		$problem->supplier_name=$supplier_name;
		return $problem;
	}
	public function updateProblem($problem){
		$id=$problem->_get('id');
		$problem_name_category=$problem->_get('problem_name_category');
		$supplier_id=$problem->_get('supplier_id');
		$description=$problem->_get('description');
		$note=$problem->_get('note');
		$sql=sprintf("update t_problem  set problem_name_category='%s',supplier_id='%s',description='%s',note='%s'  where id=%d",$problem_name_category,$supplier_id,$description,$note,$id);
		return $this->g_db->Execute($sql);
	}
}
?>