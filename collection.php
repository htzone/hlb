<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/friendmanager.css" rel='stylesheet' type='text/css' />

<title>收藏</title>
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
            	<img src="images/logo.png"/>
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
        
        <div id="content">
        	<div class="title_bar">
            	我的收藏
            </div>

            <div class="friend_item">
                <a href="note.php">大叔大叔大飒飒大发阿斯顿...的</a>
                <span>2015-05-08 21:12:15</span>
                
                <input type="button" value="删除"/>
            	
            </div>
            <div class="friend_item">
                <a href="note.php">那asd屋阿尼陀佛...啊</a>
                <span>2015-05-08 21:12:15</span>
                <input type="button" value="删除"/>
            </div>
            <div class="friend_item">
                <a href="note.php">那asd屋阿佛啊sdadsdas...</a>
                <span>2015-05-08 21:12:15</span>
                <input type="button" value="删除"/>
            </div>
        </div>
        
    </div>
 		    
</body>
</html>
