<?php
/*
 * @auther lion
 * @date 2013-1-30
 */
class UserService{
private $g_db;
	public function __construct(){
		require_once './class/user.class.php';
		require_once './class/database.class.php';
		require_once './class/personnel_category_service.class.php';
		require_once 'class/code_names.class.php';

		$this->g_db=Database::getInstance();
	}
	public  function listAll($pageCurrent,$PageSize,$sql="select * from t_user"){

		$sql=$sql." order by id desc";
		$array_user=$this->g_db->getAll($sql,$pageCurrent,$PageSize);
		$personnel_category_service=new PersonnelCategoryService();
		foreach ($array_user as $user){
			$category_name_id=$user->category_name_id;
			$personnel_category=$personnel_category_service->getPersonnelCategoryById($category_name_id);
			$category_name=$personnel_category->personnel_category_name;
			$user->category_name=$category_name;
		}
		return $array_user;
	}
	
	public function getListRows($sql="select count(*) from t_user"){
		return $this->g_db->getRows($sql);
	}
	
	public function addUser($user){
		
		$name=$user->_get("name");
	  	$category_name_id=$user->_get("category_name_id");
		$username=$user->_get("username");
  		$pwd=$user->_get("pwd");
  		$telephone=$user->_get("telephone");
  		$email=$user->_get("email");
  		$state=CodeNames::$user_state_disable;
		$sql=sprintf("insert  into  t_user  (name,category_name_id,username,pwd,telephone,email,state)  values ('%s','%s','%s','%s','%s','%s','%s')",$name,$category_name_id,$username,$pwd,$telephone,$email,$state);
		$this->g_db->Execute($sql);
		
		return $this->g_db->getLastId();
	}
	
	public function getUserById($id){
		$sql=sprintf("select * from t_user where id=%d",$id);
		return $this->g_db->getOne($sql);
	}
	
	public function updateUser($personnel_category){
		$id=$personnel_category->_get('id');
		$personnel_category_name=$personnel_category->_get('personnel_category_name');
		$permission_name=$personnel_category->_get('permission_name');
		$sql=sprintf("update t_personnel_category set personnel_category_name='%s',permission_name='%s' where id=%d",$personnel_category_name,$permission_name,$id);
		return $this->g_db->Execute($sql);
	}
	
	public  function listAllByKeywords($pageCurrent,$PageSize,$keywords,$sql="select * from t_user,t_personnel_category where t_personnel_category.id=t_user.category_name_id and concat ( t_user.username  ,t_personnel_category.personnel_category_name , t_user.name , t_user.telephone , t_user.email , t_user.state ) like  "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		$sql=$sql." order by t_user.id desc ";
		$array_user=$this->g_db->getAll($sql,$pageCurrent,$PageSize); 
		foreach ($array_user as $user){
			$category_name_id=$user->category_name_id;
			$personnel_category_service=new PersonnelCategoryService();
			$personnel_category=$personnel_category_service->getPersonnelCategoryById($category_name_id);
			$category_name=$personnel_category->personnel_category_name;
			$user->category_name=$category_name;
		}
		return $array_user;
	}
	public  function getListRowsByKeywords($keywords,$sql="select count(*) from t_user,t_personnel_category where t_personnel_category.id=t_user.category_name_id and concat ( t_user.username  ,t_personnel_category.personnel_category_name , t_user.name , t_user.telephone , t_user.email , t_user.state ) like  "){
		$sql=sprintf($sql." '%s' ","%".$keywords."%");
		return $this->g_db->getRows($sql);
	}
	
	public function validateUser($user){
		$username=$user->_get("username");
		$pwd=$user->_get("pwd");
		$sql=sprintf("select count(*) from t_user where username='%s' and pwd='%s'",$username,$pwd);
		if($this->g_db->getRows($sql)==1)
		return true;
		else 
		return false;
	}
	public function checkUsername($user){
		$username=$user->_get("username");
		$sql=sprintf("select count(*) from t_user where username='%s' ",$username);
		if($this->g_db->getRows($sql) > 0){
		return false;
		}
		else{ 
		return true;
		}
	}
}
?>