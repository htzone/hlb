<?php 
require_once 'class/myutil.class.php';
//初始化全局变量
$user_id = -1;
$islogined = false;
//如果session被赋值，则取出user_id的值，并设置已登录
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
	$islogined = true;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- 网页头部 -->
<head>
<title>欢乐吧</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/index.css" rel='stylesheet' type='text/css' />
</head>
<!-- 主体 -->
<body class="bgcolor">

	<div class="container">
    	<!-- top_menu 开始 -->
    	<div id="top_menu">
        <?php 
        //显示顶部菜单
        MyUtil::showTopMenu($islogined);
        ?>    
        </div>
        <!-- top_menu 结束 -->
        
        <!-- header 开始 -->
		<div id="header">
        
        	<div id="top_logo">
            	<img src="images/logo.png"/>
            </div>
            
            <div id="head_other">
                <form action="" method="post">
                    <input id="search_text" type="text" placeholder="Search.." required/>&nbsp;&nbsp;
                    <input id="search_button" type="submit" value="进入贴吧" />
                </form>
            </div>
            
        </div>
        <!-- header 结束 -->
        
        <!-- content 开始 -->
        <div id="content">
        	
            <h1>猜你喜欢</h1>
        	<!--以下是贴吧的图标-->
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            <div class="tieba_icon">
            		<a href="home.php">
                        <img src="images/timg.jpg" alt="" />
                        <p>滑板吧</p>	
                    </a>
            </div>
            
            <div class="nav">
            </div>
            
            <div id="dontlike">
            <form method="post" action="">
            	<input type="submit" value="不喜欢？换一批" />
            </form>
            </div> 
            
        </div>
        <!-- content 结束 -->
        
        <!-- footer 开始 -->
        <div id="footer">
        Copyright© 2015 <a href="www.htzone.cn" style="text-decoration:none; color:#000">www.htzone.cn<a> 
        </div>
        <!-- footer 结束 -->
        
	</div>
    
</body>
</html>


