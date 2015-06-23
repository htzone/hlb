<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/register.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">
function checkPass(){
	var myform  = document.getElementById("change_info");
	
	var myemail = document.getElementById("myemail");
	var oldPass = document.getElementById("oldPass").value;
	var newPass = document.getElementById("newPass").value;
	var configPass = document.getElementById("configPass").value;
	reg=/^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/gi;
	if(!reg.test(myemail.value))
	{
		alert("非法的电子邮件");		
	}
	else{
		if(0 != oldPass && newPass.length == 0){
			alert("新密码长度不能为空！");
		} else if(0 != oldPass && newPass.length != 0 && configPass.length != 0){
			if(newPass != configPass) {
				alert("两次输入的新密码不相同");
				
			} else {
				myform.submit();
			}
		}
		else{
			myform.submit();
		}
	}
	
}
</script>
<title>修改个人信息</title>
</head>
<?php

require_once 'class/myutil.class.php';
$user_id = -1;
$islogined = false;
session_start ();
if (isset ( $_SESSION ['user_id'] )) {
	$user_id = $_SESSION ['user_id'];
	$islogined = true;
} else {
	//不存在id
// 	$user_id = 1;
	echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"您的身份验证已过期，请重新登陆！\");\r\n";
	echo " window.location.href=\"login.php\";\r\n";
	echo "</script>";
	exit ();
}

$db = MyUtil::getDB();
?>
<body class="bgcolor">
	<div class="container">

		<!-- top_menu 开始 -->
		<div id="top_menu">
		<?php 
		MyUtil::showTopMenu($islogined);
		?>	
		</div>
		<!-- top_menu 结束 -->

		<div id="register_div">
			<div id="logo">
				<img src="images/logo.png" />
			</div>
			<form id="change_info" enctype="multipart/form-data"
				action="change_person_info.php" method="post" >
				<table>
            	 <?php
					$sql1 = "SELECT a.person_image, a.name, a.email, a.person_info FROM USER a WHERE a.id =" . trim ( $user_id );
					$result1 = $db->execute ( $sql1 );
					while ( $row = mysql_fetch_array ( $result1 ) ) {
						echo "<tr><td class=\"left\">昵称：</td><td class=\"right\">". trim (  $row ["name"] )."</td></tr>";
						echo "<tr><td class=\"left\">头像：</td><td class=\"right\"><input type=\"file\" name=\"headimage\"/></td></tr>";
 						echo "<tr><td class=\"left\"></td><td class=\"right\"><img src='uploads/". trim ( $row ["person_image"] ) ."'/></td></tr>";
						echo "<tr><td class=\"left\">邮箱：</td><td class=\"right\"><input id='myemail' type=\"text\" name=\"user_email\" value=\"" . trim ( $row ["email"] ) . "\" /></td></tr>";
						echo "<tr><td class=\"left\">旧密码：</td><td class=\"right\"><input type=\"password\" id='oldPass' name=\"oldPass\" \" /></td></tr>";
						echo "<tr><td class=\"left\">新密码：</td><td class=\"right\"><input type=\"password\" id='newPass' name=\"newPass\" \" /></td></tr>";
						echo "<tr><td class=\"left\">确认密码：</td><td class=\"right\"><input type=\"password\" id='configPass' name=\"configPass\" \" /></td></tr>";
						echo "<tr><td class=\"left\">个人简介：</td><td class=\"right\"><textarea name=\"user_info\" \">". trim ( $row ["person_info"] ) ."</textarea></td></tr>";
					}
				?>
       		 	 <tr>
						<td class="left"></td>
						<td class="right"><input class="btn" type="button" value="提交" onclick="checkPass()"/><input
							class="btn" type="reset" value="重置" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
