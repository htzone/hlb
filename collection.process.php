<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once 'class/myutil.class.php';
/*获取用户id*/
$post_id = null;
$user_id = -1;
$islogined = false;

session_start();
//自己模拟数据
// $user_id = 5;
// $islogined = true;

/*获取用户id*/
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
	$islogined = true;
}

if (isset($_GET["post_id"])) {
	$post_id = $_GET["post_id"];
}

$db = MyUtil::getDB();
$sql = "delete from collection where user_id = {$user_id} and tiezi_id = {$post_id}";
if ($db->execute($sql)) {
 	echo "<script>location.href='collection.php'</script>";
} else {
	echo "<script>window.hostory.go(-1);</script>";
}