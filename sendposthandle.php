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

if(isset($_POST["action"])){
	$action = $_POST["action"];
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
					echo "<script>location.href='home.php?tieba_id={$tieba_id}';</script>";
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
 	default:
 		break;
}