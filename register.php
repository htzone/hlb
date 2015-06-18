<!DOCTYPE html>
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
                <li><a href="personal.php">个人</a></li> 
                <li class="menudiv"></li> 
                <li><a href="index.php">主页</a></li>  
                 
            </ul>
            
        </div>
        <!-- top_menu 结束 -->
        
    	<div id="register_div">
        	<div id="logo">
            	<img src="images/logo.png"/>
            </div>
        	<form>
            	<table>
                	<tr><td class="left">头像：</td><td class="right"><input type="file" name=""/></td></tr>
                    <tr><td class="left"></td><td class="right"><img src=""/></td></tr>
                	<tr><td class="left">用户名：</td><td class="right"><input type="text" /></td></tr>
                    <tr><td class="left">设置密码：</td><td class="right"><input type="password" /></td></tr>
                    <tr><td class="left">重新输入密码：</td><td class="right"><input type="password" /></td></tr>
                    <tr><td class="left">邮箱：</td><td class="right"><input type="email" /></td></tr>
                    <tr><td class="left">XXX：</td><td class="right"><input type="email" /></td></tr>
                    <tr><td class="left">XXX：</td><td class="right"><input type="email" /></td></tr>
                    <tr><td class="left"></td><td class="right"><input class="btn" type="submit" value="提交"/><input class="btn" type="reset" value="重置"/></td></tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
