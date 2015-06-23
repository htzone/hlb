<?php
header("content-type: text/html;charset=utf-8");
require_once 'class/myutil.class.php';
session_start();
$action = -1;
$title = "";
$content = "";
$user_id=-1;
$tieba_id=-1;
$post_id = -1;
$gentie_id = -1;
$operate_code = -1;
$follow_id = -1;
$friend_id = -1;

if(isset($_POST["action"])){
	$action = $_POST["action"];
}


if(isset($_GET["friend_id"])){
	$friend_id = $_GET["friend_id"];
}

if(isset($_GET["follow_id"])){
	$follow_id = $_GET["follow_id"];
}

if(isset($_GET["operate_code"])){
	$operate_code = $_GET["operate_code"];
}

if(isset($_GET["post_id"])){
	$post_id = $_GET["post_id"];
}

if(isset($_GET["tieba_id"])){
	$tieba_id = $_GET["tieba_id"];
}

if(isset($_POST["content"])){
	$content = $_POST["content"];
}

if(isset($_GET["content"])){
	$content = $_GET["content"];
}

if(isset($_GET["action"])){
	$action = $_GET["action"];
}
if(isset($_GET["gentie_id"])){
	$gentie_id = $_GET["gentie_id"];
}

if(isset($_POST["title"])){
	$title = $_POST["title"];
}

if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
}

if(isset($_POST["tieba_id"])){
	$tieba_id = $_POST["tieba_id"];
}

if(isset($_POST["post_id"])){
	$post_id = $_POST["post_id"];
}

// $user_id = 10;
switch ($action){
	//发帖/
	case 1:	
		$db = MyUtil::getDB();
		if($title&&$content){
			$sql = "insert into post(tiezi_name,tiezi_content,create_user_id,tieba_id) values('{$title}','{$content}',{$user_id},{$tieba_id})";
			if($db->execute($sql)){
				$now_post_num = MyUtil::getTieziNumFromTieba($tieba_id);
				$sql = "update postbar set tiezi_num = {$now_post_num} where id = {$tieba_id}";
				if($db->execute($sql)){
					$sql = "update user set tiezi_num = tiezi_num+1 where id = {$user_id}";
					if($db->execute($sql)){
						echo "<script>location.href='home.php?tieba_id={$tieba_id}';</script>";
					}	
				}
			}
			else{
				echo "<script>alert('提交失败！');location.href='home.php?tieba_id={$tieba_id}';</script>";
			}
		}
		else{
			 echo "<script>alert('标题或内容不能为空！');location.href='home.php?tieba_id={$tieba_id}';</script>";
		}
		break;
	//跟帖
	case 2:		
		if($content){
			$db = MyUtil::getDB();
			$sql = "insert into follow(content,create_user,tiezi_id) values('{$content}',{$user_id},{$post_id})";
			if($db->execute($sql)){	
				echo "<script>location.href='note.php?post_id={$post_id}&tieba_id={$tieba_id}';</script>";
			}
			else{
				echo "<script>alert('提交失败！');location.href='note.php?post_id={$post_id}&tieba_id={$tieba_id}';</script>";
			}
		}
		else{
			echo "<script>alert('内容不能为空！');location.href='note.php?post_id={$post_id}&tieba_id={$tieba_id}';</script>";
		}
		break;
		
	case 3:
		$db = MyUtil::getDB();
		$sql="insert into comment(content, from_id, gentie_id) values('{$content}',$user_id, $gentie_id)";
		if($db->execute($sql)){
			echo MyUtil::getCurrentTime();
		}
		else{
			echo "fuck";
		}
		break;
	case 4:
		$db = MyUtil::getDB();
		$sql="insert into care(tieba_id, user_id) values({$tieba_id}, {$user_id})";
		if($db->execute($sql)){
			$sql = "update postbar set people_num = people_num+1 where id = {$tieba_id}";
			if($db->execute($sql)){
				echo "success";
			}	
		};
		break;
	case 5:
		if($operate_code == 1){
			$db = MyUtil::getDB();
			$sql = "select state from post where id = {$post_id}";
			$result = $db->execute($sql);
			$post_state = 0;
	        while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
	        	$post_state = $row["state"]; 
	        }
	        if($post_state){
	        	$sql="update post set state = 0 where id = {$post_id}";
	        	if($db->execute($sql)){
	        		echo "code1_2";
	        	}
	        }
	        else{
	        	$sql="update post set state = 1 where id = {$post_id}";
	        	if($db->execute($sql)){
	        		echo "code1_1";
	        	}
	        }
		}
		else if($operate_code == 2){
			$db = MyUtil::getDB();
			$sql = "select isFine from post where id = {$post_id}";
			$result = $db->execute($sql);
			$post_isFine = 0;
			while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
				$post_isFine = $row["isFine"];
			}
			if($post_isFine){
				$sql = "update post set isFine = 0 where id = {$post_id}";
				if($db->execute($sql)){
					echo "code2_2";
				}
			}
			else{
				$sql = "update post set isFine = 2 where id = {$post_id}";
				if($db->execute($sql)){
					echo "code2_1";
				}
			}
		}
		else if($operate_code == 3){
			$db = MyUtil::getDB();
			$sql = "delete from post where id = {$post_id}";
			if($db->execute($sql)){
				echo "code3";
			}
		}
		break;
	case 6:
		$db = MyUtil::getDB();
		$sql = "delete from follow where id = {$follow_id}";
		if($db->execute($sql)){
			echo "success";
		}
		break;
	case 7:
		$db = MyUtil::getDB();
		if($user_id){
			$sql = "insert into collection(user_id,tiezi_id) values({$user_id}, {$post_id})";
			if($db->execute($sql)){
				$sql = "update user set collection_num = collection_num+1 where id = {$user_id}";
				if($db->execute($sql)){
					echo "success";
				}	
			}
		}
		break;
	case 8:
		$db = MyUtil::getDB();
		$sql = "insert into friend(user_id, friend_id) values($user_id, $friend_id)";
		if ($db->execute($sql)) {
			$sql = "select friends_num from user where id = {$user_id}";
			$count_result = $db->execute($sql);
			$friend_num = 0;
			while ($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)) {
				$friend_num = $row["friends_num"];
			}
			$friend_num++;
			$sql = "update user set friends_num = $friend_num where id = {$user_id}";
			$db->execute($sql);
			echo "success";
		}
		break;
	case 9:
		$db = MyUtil::getDB();
		$sql = "delete from post where id = {$post_id}";
		if ($db->execute($sql)) {
			header("location:personal.php");
		}
		else{	
		}
 	default:
 		break;
}