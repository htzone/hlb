<!DOCTYPE html>
<?php 
header("content-type:text/html;charset=utf-8");
require_once 'class/myutil.class.php';
include "class/mysql.class.php";
if (!empty($_POST['reg'])){
	//用户名来进行判断
	if (empty($_POST['name'])){
		exit("<script>alert('用户名不能为空!');
			location.href='register.php'</script>");
	}
	//对用户密码进行判断
	if($_POST['password']!=$_POST['repassword']){
		exit("<script>alert('两次输入的密码不一致!');
			location.href='register.php'</script>");
	}
	//注册功能
	//判断用户名是否已经存在
	$sql = "select * from user where name='{$_POST['name']}'";
	$query=mysql_query($sql);
	$usernums=mysql_num_rows($query);
	if($usernums!=0){
	exit("<script>alert('用户名已经存在!请重新注册!');
				location.href='register.php'</script>");
	}
	$fileName = "default.png";
	$up = new FileUpload();
	if($up->upload('person_image')){
		$fileName = $up->getFileName();
	}
	else {
// 		$error = $up->getErrorMsg();
// 		echo "<p>{$error}</p>";
	}
	
	if(isset($_POST['person_image'])){
		$sql = "insert into user set name='{$_POST['name']}',person_image='{$_POST['person_image']}',
	password='".md5($_POST['password'])."',email='{$_POST['email']}',person_info='{$_POST['content']}'";
	}
	else{
		$sql = "insert into user set name='{$_POST['name']}',person_image='{$fileName}',
		password='".md5($_POST['password'])."',email='{$_POST['email']}',person_info='{$_POST['content']}'";
	}
// 	$sql = "insert into user set name='{$_POST['name']}',person_image='{$_POST['person_image']}',
// 	password='".md5($_POST['password'])."',email='{$_POST['email']}',person_info='{$_POST['content']}'";
	$result = mysql_query($sql);
	
	$id = mysql_insert_id();
	if($result){
		session_start();
		$_SESSION["user_id"] = $id;
		exit("<script>alert('注册成功!');
				location.href='index.php'</script>");
	}else{
	exit("<script>alert('注册失败!');
				location.href='register.php'</script>");
	}

}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/register.css" rel='stylesheet' type='text/css' />
<title>注册页面</title>
</head>

<body class="bgcolor">
	<div class="container">
    
    <!-- top_menu 开始 -->
    	<div id="top_menu">
        
            <ul>
            	<li><a href="register.php">注册</a></li>
                <li class="menudiv"></li>
                <li><a href="login.php">登录</a></li>
                <li class="menudiv"></li>
                <li><a href="index.php">主页</a></li>  
                 
            </ul>
            
        </div>
        <!-- top_menu 结束 -->
        
    	<div id="register_div">
        	<div id="logo">
            	<img src="images/logo.png"/>
            </div>
        	<form action="" method="post" enctype="multipart/form-data">
            	<table>
                	<tr>
                		<td class="left">头像：</td>
                		<td class="right"><input type="file" name="person_image"/></td>
                	</tr>
                    <tr>
                    	<td class="left"></td>
                    	<td class="right"><img src=""/></td>
                    </tr>
                	<tr>
                		<td class="left">用户名：</td>
                		<td class="right"><input type="text" name="name" /></td>
                	</tr>
                    <tr>
                    	<td class="left">设置密码：</td>
                    	<td class="right"><input type="password" name="password" /></td>
                    </tr>
                    <tr>
                    	<td class="left">重新输入密码：</td>
                    	<td class="right"><input type="password" name="repassword"/></td>
                    </tr>
                    <tr>
                    	<td class="left">邮箱：</td>
                    	<td class="right"><input type="text" name="email"/></td>
                    </tr>
                    
                    <tr>
                    	<td class="left">个人信息：</td>
                    	<td class="right"><textarea name="content"></textarea></td>
                    </tr>
                    <tr>
                    	<td class="left"></td>
                    	<td class="right"><input class="btn" type="submit" name="reg" value="提交"/><input class="btn" type="reset" value="重置"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
