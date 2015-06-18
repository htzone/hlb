<?php
/**
 * 数据库操作类
 * @author hetao
 *
 */
class DbOperator{
	//用于保存数据库操作返回结果
	private $result = null;
	//数据库实例对象
	private static $dbOperator = null;

	//获取数据库操作对象实例方法
	public static function getInstance(){
		if(DbOperator::$dbOperator == null){
			DbOperator::$dbOperator = new DbOperator();
		}
		return DbOperator::$dbOperator;
	}

	//构造方法
	public function __construct(){
		//这里采用本地的mysql服务器
		@mysql_connect("localhost", "root", "") or die("对不起，数据库连接失败...");
		@mysql_select_db("hlba") or die("对不起，数据库不存在或不可用...");
	}

	
	/**
	 * 数据库操作执行方法
	 * @param string $sql 执行的sql语句
	 * @return mixed 如果是查询操作则返回一个查询结果集；如果是其他操作则返回一个表示执行操作是否正确完成的boolean
	 */
	public function execute($sql){
		//采用UTF-8编码格式获取查询结果
		mysql_query("set names UTF8");
		$this->result = @mysql_query($sql) or die("SQL语句执行失败！");
		return $this->result;
	}

	
	/**
	 * 数据库关闭方法
	 */
	public function close(){
		return @mysql_close();
	}

	//获取结果集的行数
	public function getResultRowsNum(){
		if($this->result && is_resource($this->result)){
			return @mysql_num_rows($this->result);
		}
	}

	//获取结果集的列数
	public function getResultColumnNum(){
		if($this->result && is_resource($this->result) ){
			return @mysql_num_fields($this->result);
		}
	}

	//获取受影响的行数
	public function getAffectRowsNum(){
		if($this->result === true){
			return @mysql_affected_rows();
		}
	}
}