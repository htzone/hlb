<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/register.css" rel='stylesheet' type='text/css' />
<title>贴吧信息</title>
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
                	<tr><td class="left">贴吧logo：</td><td class="right"><img src="images/timg.jpg"/></td></tr>
                	<tr><td class="left">贴吧名字：</td><td class="right">滑板吧</td></tr>
                    <tr><td class="left">贴吧简介：</td><td class="right">滑板滑板换起来！！！</td></tr>
                    <tr><td class="left">吧务：</td><td class="right">
                    <span class="bawu">小黑黑</span>
                    <span class="bawu">小Weiwei</span>
                    </td></tr>
                    <tr><td class="left"></td><td class="right"><a class="update" href="tieba_modify.php">修改</a></td></tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
