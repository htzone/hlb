<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/personal.css" rel='stylesheet' type='text/css' />
<title>个人主页</title>
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
        
        <!--header 开始-->
    	<div id="header">
        	<div id="logo">
            	<a href="index.php"><img src="images/logo.png"/></a>
            </div>
            <div id="nav">
            </div>
            <div id="search">
            	<form action="" method="post">
                    <input id="search_text" type="text" placeholder="Search.." required/>
                    <input id="search_button" type="button" value="进入贴吧" />
                    <a id="create_button" href="tieba_modify.php">创建贴吧</a>
                </form>
            </div>
        </div>
        <!--header 结束-->
        
        <!--moremenu 开始-->
        <div id="more_menu">
            	<ul>
                	<li><a href="personal.php">个人主页</a></li>
                	<li><a href="tiebamanage.php">贴吧管理</a></li>
                    <li><a href="friendmanager.php">好友管理</a></li>
                    <li><a href="collection.php">收藏</a></li>  
                </ul>
        </div>
        <!--moremenu 结束-->
        
        <!--left_side 开始-->
        <div id="left_side">
        	<div id="head_sculptrue">
            	<img src="images/1427624916950.jpg"/>
                <p>小Weiwei</p>
            </div>
            <div id="personal_info">
            	<p>发帖数：123</p><hr/>
                <p>收藏：23</p><hr/>
                <p>好友：5</p><hr/>
                <p><a href="modify.php">修改个人资料</a></p>
            </div>
        </div>
        <!--left_side 结束-->
        
        <div id="right_side">
        <h3>最近发帖</h3>
        	<div class="line1">
            	<span class="title"><a href="note.php">我要好好学习天天向上</a></span><span class="time">2015-05-11 12:22:11  删除</span>
            </div>
            <div class="line2">
            	<span class="title"><a href="note.php">我要好好学习天天向上</a></span><span class="time">2015-05-11 12:22:11  删除</span>
            </div>
            <div class="line1">
            	<span class="title"><a href="note.php">我要好好学习天天向上</a></span><span class="time">2015-05-11 12:22:11  删除</span>
            </div>
            <div class="line2">
            	<span class="title"><a href="note.php">我要好好学习天天向上</a></span><span class="time">2015-05-11 12:22:11  删除</span>
            </div>
        </div>
        
        <!--more 开始-->
        <div id="more">
        	
        	<div id="my_tieba">
            	<table>
                <th class="th_style">我的贴吧</th>
                <tr><td><a href="home.php">滑板吧</a></td></tr>
                <tr><td><a href="home.php">滑板吧</a></td></tr>
                <tr><td><a href="home.php">滑板吧</a></td></tr>
                <tr><td><a href="home.php">滑板吧</a></td></tr>
                </table>
            </div>
            <div id="my_friend">
                <table>
                <th class="th_style">我的好友</th>
                <tr><td><a href="friend.php">小黑黑</a></td></tr>
                <tr><td><a href="friend.php">小黑黑</a></td></tr>
                <tr><td><a href="friend.php">小黑黑</a></td></tr>
                </table>
            </div>
            
        </div>
        <!--more 结束-->
        
    </div>
</body>
</html>
