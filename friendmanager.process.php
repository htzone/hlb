<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once 'class/myutil.class.php';
$user_id = -1;
$friend_id = null;
// $user_id = 5;
session_start();
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
}
if (isset($_GET["friend_id"])) {
	$friend_id = $_GET["friend_id"];
}
$db = MyUtil::getDB();
$sql = "delete from friend where user_id = {$user_id} and friend_id = {$friend_id}";
// echo "<script>alert('$sql')</script>";
if ($db->execute($sql)) {
	echo "<script>location.href='friendmanager.php'</script>";
} else {
	echo "<script>window.hostory.go(-1);</script>";
}