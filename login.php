<!DOCTYPE html>
<?php 
include "class/mysql.class.php";
header("content-type: text/html;charset=utf-8");
//判断是否提交
$ishome = 0;
$isnote = 0;
$tieba_id = 0;
$post_id = 0;
if(isset($_GET["ishome"])){
	$ishome = $_GET["ishome"];
}
if(isset($_GET["isnote"])){
	$isnote = $_GET["isnote"];
}
if(isset($_GET["tieba_id"])){
	$tieba_id = $_GET["tieba_id"];
}
if(isset($_GET["post_id"])){
	$post_id = $_GET["post_id"];
}

if (!empty($_POST['login'])){
	if(empty($_POST['name'])){
		exit("<script>alert('用户名不能为空!');
				location.href='login.php'</script>");
	}

	$sql = "select * from user where
	name='{$_POST['name']}'";
	$query=mysql_query($sql);
	$user=mysql_fetch_assoc($query);
	if($user){
	//密码的判断
		if($user['password']==md5($_POST['password'])){
	//登录成功的代码
        session_start();
        $_SESSION["user_id"] = $user["id"];
        if($ishome){
        	exit("<script>alert('登录成功!');
		location.href='home.php?tieba_id=$tieba_id'</script>");
        }
        if($isnote){
        	exit("<script>alert('登录成功!');
        			location.href='note.php?post_id=$post_id&tieba_id=$tieba_id'</script>");
        }
		exit("<script>alert('登录成功!');
		location.href='index.php'</script>");
    	}else{
    		//登录失败，密码错误
    		exit("<script>alert('用户名或密码错误');
		location.href='login.php'</script>");
    	}
    }else{
    	exit("<script>alert('该用户不存在!请注册!');
				location.href='register.php'</script>");
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/login.css" rel='stylesheet' type='text/css' />
<title>登录页面</title>
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
    	
    	<div id="login_div">
            <form method="post" action="">
            
                <table>
                	<h1 class="header">登录</h1>
                    <tr>
                    	<td class="left">用户名：</td>
                    	<td class="right"><input type="text" name="name" /></td>
                    </tr>
                    <tr>
                    	<td class="left">密码：</td>
                    	<td class="right"><input type="password" name="password" /></td>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td ><input class="btn" type="submit" name="login" value="登录"/>
                    		 <input class="btn" type="reset" value="重置"/></td>
                    </tr>
                </table>
            
            </form>
   			
        </div>
    </div>
</body>
</html>
