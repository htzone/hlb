<?php 
require_once 'class/myutil.class.php';

/*全局变量初始化*/
$user_id = -1;
//初始化是否登录标记
$islogined = false;
//是否具有管理权限
$isManager = false;

session_start();
//自己模拟数据
// $user_id = 5;

/*获取用户id*/
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
<script src="javascript/jquery.js"></script>
</head>
<!-- 主体 -->
<body class="bgcolor">

	<div class="container">
    	<!-- top_menu 开始 -->
    	<div id="top_menu">
        
           <?php 
           MyUtil::showTopMenu($islogined);
           ?>
            
        </div>
        <!-- top_menu 结束 -->
        
        <!-- header 开始 -->
		<div id="header">
        
        	<div id="top_logo">
            	<a href="index.php"><img src="images/logo.png"/></a>
            </div>
            <?php 
            Search::search_postbar();
            ?>
            
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


