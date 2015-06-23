<!-- 页面统一采用UTF-8格式，且可自适应屏幕 -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="user-scalable=no, width=device-width" />
<?php
// 类似于Java中的自动import 作用同上注释代码。当定义的类名没被包含进该文件时，就会调用此方法
function __autoload($className) {
	require_once ("class/" . strtolower ( $className ) . ".class.php");
}

/**
 * 修改个人信息
 */
session_start ();
if (isset ( $_SESSION ['user_id'] )) {
	$user_id = $_SESSION ['user_id'];
$db = DbOperator::getInstance ();
	$sql0 = "SELECT a.person_image FROM USER a WHERE a.id = " . trim ( $user_id );
	$result0 = $db->execute ( $sql0 );
	while($row = mysql_fetch_array($result0))
	{
		$fileName = trim ( $row ["person_image"]);
	}
	$up = new FileUpload ();
	// //可以自己设置一些属性，也可以不设置，用默认的
	// 获取表单上传的文件并保存到指定目录，表单的名字要与这里传入的参数一致
	if ($up->upload ( 'headimage' )) {
		$fileName = $up->getFileName (); // 获取上传后的文件名，包含后缀名	
	}
	echo "<hr/>";
	$user_info = $_POST ["user_info"];
	$user_email = $_POST ["user_email"];
	$oldPass = md5($_POST ["oldPass"]);
	$newPass = md5($_POST ["newPass"]);
	$user_head_pic = $fileName;
	$sql1 = "update USER a SET a.person_image = '" . trim ( $user_head_pic ) . "', a.email = '" . trim ( $user_email ) . "', a.person_info = '" . trim ( $user_info ) . "' WHERE a.id = " . trim ( $user_id );
	$sql2 = "update USER a SET a.password = '" . trim ( $newPass ) . "' WHERE a.id = " . trim ( $user_id )." AND a.password = '" . trim ( $oldPass )."'";
 	$result1 = $db->execute ( $sql1 );
	$change1 = $db->getAffectRowsNum();
	$result2 = $db->execute ( $sql2 );
	$change2 = $db->getAffectRowsNum();
	if(0 == $change1 && 0 == $change2) {
		echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"没有修改任何信息！\");\r\n";
		echo " window.location.href=\"modify.php\";\r\n";
		echo "</script>";
		exit ();
	} else if (1 == $change1 && 0 == $change2){
		echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"个人信息修改成功！\");\r\n";
		echo " window.location.href=\"personal.php\";\r\n";
		echo "</script>";
		exit ();
	} else if(0 == $change1 && 1 == $change2) {
		echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"密码修改成功！\");\r\n";
		echo " window.location.href=\"personal.php\";\r\n";
		echo "</script>";
		exit ();
	} else if(1 == $change1 && 1 == $change2){
		echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"个人信息修改成功，密码修改成功！\");\r\n";
		echo " window.location.href=\"personal.php\";\r\n";
		echo "</script>";
		exit ();
	}
} else {
	echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"您的身份验证已过期，请重新登陆！\");\r\n";
	echo " window.location.href=\"login.php\";\r\n";
	echo "</script>";
	exit ();
}