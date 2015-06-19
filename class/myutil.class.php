<?php
function __autoload($className){
	require_once ("class/".strtolower($className).".class.php");
}

class MyUtil{
	
	public static function getUri($query){
		$request_uri = $_SERVER["REQUEST_URI"];
		$url = strstr($request_uri, "?")?$request_uri:$request_uri."?";
	
		if(is_array($query)){
			$url .= http_build_query($query);
		}
		else if($query != ""){
			$url .= "&".trim($query, "?&");
		}
	
		$arr = parse_url($url);
	
		if(isset($arr["query"])){
			parse_str($arr["query"], $arrs);
			unset($arrs["page"]);
			$url = $arr["path"]."?".http_build_query($arrs);
		}
	
		if(strstr($url, "?")){
			if(substr($url, -1) != '?'){
				$url = $url.'&';
			}
		}
		else{
			$url = $url.'?';
		}
	
		return $url;
	}
	
	public static function checkIsFloorHost($post_id, $user_id){
		$create_user_id = null;
		$sql = "select create_user_id from post where id = {$post_id}";
		$result = DbOperator::getInstance()->execute($sql);
		while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
			$create_user_id = $row["create_user_id"];
		}
		if($user_id == $create_user_id){
			return true;
		}
		else {
			return false;
		}
	}
	
	public static function getTieziNumFromTieba($tieba_id){
		$sql = "select count(id) from post where tieba_id = {$tieba_id}";
		$count_result = DbOperator::getInstance()->execute($sql);
		//遍历结果集
		while($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)){
			$post_num = $row[0] ;
		}
		return $post_num;
	}
	
	public static function getFollowNumFromTiezi($post_id){
		$sql = "select count(id) from follow where tiezi_id = {$post_id}";
		$count_result = DbOperator::getInstance()->execute($sql);
		//遍历结果集
		while($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)){
			$follow_num = $row[0] ;
		}
		return $follow_num;
	}
	
	public static function showTopMenu($islogined){
		if($islogined){
			echo '
					<ul>
	                <li><a href="logout.php">注销</a></li>
	                <li class="menudiv"></li>
	                <li><a href="personal.php">个人</a></li>
					<li class="menudiv"></li>
	                <li><a href="index.php">主页</a></li>
	                </ul>';
		}
		else{
			echo '
					<ul>
	            	<li><a href="register.php">注册</a></li>
	                <li class="menudiv"></li>
	                <li><a href="login.php">登录</a></li>
	                <li class="menudiv"></li>
	                <li><a href="index.php">主页</a></li>
	            	</ul>';
		}
	}
	
	public static function getCurrentTime(){
		date_default_timezone_set('PRC');
		return date("Y-m-d H:i:s");
	}
	
	public static function getDB(){
		return DbOperator::getInstance();
	}

	public static function checkUserIsCareOfTieba($user_id, $tieba_id){
		$sql = "select tieba_id from care where user_id = {$user_id}";
		$care_result = DbOperator::getInstance()->execute($sql);
		$care_teiba_list = array();
		while($row = mysql_fetch_assoc($care_result, MYSQL_BOTH)){
			$care_teiba_list[] = $row["tieba_id"];
		}
		 
		if(in_array($tieba_id, $care_teiba_list)){
			return true;
		}
		else{
			return false;
		}
	}
	
	//判断用户是否具有管理权限
	public static  function checkUserAuthority($user_id, $tieba_id){
		$bazu_id = -1;
		$bawu_id = -1;
		$result1 = DbOperator::getInstance()->execute("select * from appoint where tieba_id = {$tieba_id}");
		//遍历结果集
		if($result1 != null){
			while($row = mysql_fetch_assoc($result1, MYSQL_BOTH)){
				$bazu_id = $row["bazu_id"];
				$bawu_id = $row["bawu_id"];
			}
		}
		else{
			$result1 = DbOperator::getInstance()->execute("select bazu_id from postbar where id = {$tieba_id}");
			while($row = mysql_fetch_assoc($result1, MYSQL_BOTH)){
				$bazu_id = $row["bazu_id"];
			}
		}
	
		if($user_id == $bazu_id || $user_id == $bawu_id){
			//该用户具有对该贴吧的管理权限
// 					echo "我具有管理权限！";
			return true;
		}
		else{
// 					echo "我不具有管理权限！";
			return false;
		}
	
	}
}