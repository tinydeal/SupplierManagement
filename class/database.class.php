<?php	
   

   
final class Database {

	private static $instance = null;
	//定义默认数据库主机名
	public static $dbhost = 'localhost';
	//定义默认数据库主机端口
	public static $dbport = 3306;
	//定义默认数据库名
	public static $dbname = 'supplier_management';
	//定义默认数据库用户名
	public static $dbuser = 'root';
	//定义默认数据库密码
	public static $dbpass = '123456';
	//
	public static $stmt = null;
	//数据库查询次数
	public static $querycount = 0;
	//
	public static $DB = null;
	//数据库版本
	public static $version = 0;
	//是否调试模式
	public static $debug = 0;

	private function __construct(){
		self::$dbhost = "localhost";
		self::$dbport = 3306;
		self::$dbname = "supplier_management";
		self::$dbuser = "root";
		self::$dbpass = "";
		self::connect();
	}

    // getInstance
    public static function getInstance(){
    	if(self::$instance == null){
    		self::$instance = new Database();
    	}
    	return self::$instance;
    }

	/********************************************
	* 作用:连接数据库
	*********************************************/
	private function connect() {
		self::$DB = new PDO('mysql:host='.self::$dbhost.';port='.self::$dbport.';dbname='.self::$dbname, self::$dbuser, self::$dbpass);
		if (self::$DB) {
			self::$version = self::$DB->getAttribute(PDO::ATTR_SERVER_VERSION);
			if (self::$version > '4.1') {
				self::$DB->exec("SET NAMES 'utf8'");
			}
			if(self::$version > '5.0.1') {
				self::$DB->exec("SET sql_mode=''");
			}
		} else {
			self::halt('Can not connect MySQL Server or DataBase.');
		}
	}

	/********************************************
	* 作用:获取数据库出错信息
	*********************************************/
	private function getErrInfo() {
		if (self::getErrNo() != '00000') {
			$info = (self::$stmt) ? self::$stmt->errorInfo() : self::$DB->errorInfo();
			self::halt($info[2]);
		}
	}


	/********************************************
	* 作用:获取数据库出错代号
	*********************************************/
	function getErrNo() {
		if (self::$stmt) {
			return self::$stmt->errorCode();
		} else {
			return self::$DB->errorCode();
		}
	}

	/********************************************
	* 作用:输出数据库出错信息
	*********************************************/
	private function halt($msg =''){

		$message  = "<html>\n<head>\n";
		$message .= "<meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\">\n";
		$message .= "<style type=\"text/css\">\n";
		$message .=  "* {font:12px Verdana;}\n";
		$message .=  "</style>\n";
		$message .= "</head>\n";
		$message .= "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#006699\" vlink=\"#5493B4\">\n";

		$message .= "<p>Mysql error:</p><pre><b>".htmlspecialchars($msg)."</b></pre>\n";
		$message .= "<b>Mysql error description</b>: ".htmlspecialchars(self::getErrInfo())."\n<br />";
		$message .= "<b>Date</b>: ".date("Y-m-d @ H:i")."\n<br />";
		$message .= "<b>Script</b>: http://".$_SERVER['HTTP_HOST'].getenv("REQUEST_URI")."\n<br />";

		$message .= "</body>\n</html>";
		echo $message;
		exit;
	}

	/********************************************
	* 作用:获取当前库的所有表名
	* 返回:当前库的所有表名
	* 类型:数组
	*********************************************/
	public function getTablesName() {
		self::$stmt = self::$DB->query('SHOW TABLES FROM '.self::$dbname);
		self::getErrInfo();
		$result = self::$stmt->fetchAll(PDO::FETCH_NUM);
		self::$stmt = null;
		return $result;
	}

	/********************************************
	* 作用:获取数据表里的字段
	* 返回:表字段结构
	* 类型:数组
	*********************************************/
	public function getFields($table) {
		self::$stmt = self::$DB->query("DESCRIBE $table");
		self::getErrInfo();
		$result = self::$stmt->fetchAll(PDO::FETCH_ASSOC);
		self::$stmt = null;
		return $result;
	}

	/********************************************
	* 作用:获取所有数据
	* 返回:表内记录
	* 类型:数组
	* 参数:select * from table
	*********************************************/
	public function getAll($sql, $type=PDO::FETCH_OBJ) {
		if (self::$debug) {
			echo $sql.'<br />';
		}
		$result = array();
		self::$stmt = self::$DB->query($sql);
		self::getErrInfo();
		self::$querycount++;
		$result = self::$stmt->fetchAll($type);
		self::$stmt = null;
		return $result;
	}

	/********************************************
	* 作用:获取单行数据
	* 返回:表内记录
	* 类型:数组
	* 参数:select * from table where id='1'
	*********************************************/
	public function getOne($sql, $type=PDO::FETCH_ASSOC) {
		if (self::$debug) {
			echo $sql.'<br />';
		}
		$result = array();
		self::$stmt = self::$DB->query($sql);
		self::getErrInfo();
		self::$querycount++;
		$result = self::$stmt->fetch($type);
		self::$stmt = null;
		return $result;
	}

	/********************************************
	* 获取记录总数
	* 返回:记录数
	* 类型:数字
	* 参数:select count(*) from table
	*********************************************/
	public function getRows($sql = '') {
		if ($sql) {
			if (self::$debug) {
				echo $sql.'<br />';
			}
			self::$stmt = self::$DB->query($sql);
			self::getErrInfo();
			self::$querycount++;
			$result = self::$stmt->fetchColumn();
			self::$stmt = null;
		} elseif (self::$stmt) {
			$result = self::$stmt->rowCount();
		} else {
			$result = 0;
		}
		return $result;
	}

	/********************************************
	* 作用:获得最后INSERT的主键ID
	* 返回:最后INSERT的主键ID
	* 类型:数字
	*********************************************/
	public function getLastId() {
		return self::$DB->lastInsertId();
	}

	/********************************************
	* 作用:执行INSERT\UPDATE\DELETE
	* 返回:执行语句影响行数
	* 类型:数字
	*********************************************/
	public function Execute($sql) {	
		$return = self::$DB->exec($sql);
		self::getErrInfo();
		self::$querycount++;
		return $return;
	}

	/********************************************
	* 作用:关闭数据连接
	*********************************************/
	public function CloseDB() {	
		self::$DB = null;
	}
    
}
?>