<?php 
require_once 'class/myutil.class.php';

/*全局变量初始化*/
//初始化搜索关键字
$search_text = null;
//初始化用户id
$user_id = -1;
//初始化是否登录标记
$islogined = false;

session_start();

//自己模拟数据
// $user_id = 5;
// $islogined = true;

/*获取贴吧id和用户id*/
if(isset($_GET["kw"])){
	$search_text = $_GET["kw"];
}

if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
	$islogined = true;
}



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>欢乐吧_帖吧搜索</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/search.css" rel='stylesheet' type='text/css' />
<script src="javascript/jquery.js"></script>
</head>


<!-- 主体 -->
<body class="bgcolor">

	<div class="container">
    
    	 <!-- top_menu 开始 -->
    	<div id="top_menu">
        <?php 
        /*顶部菜单信息显示处理*/
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
           	if ($islogined)
            Search::search_creat_postbar($search_text);
           	else
           	Search::search_postbar($search_text);
           ?>
            
        </div>
        <div id="content">
        	<div id="content_search">
            	<?php 
            	echo "<p ><b style=\"color:red\">\"{$search_text}\"</b>&nbsp;&nbsp;&nbsp;&nbsp;吧尚未创建</p>";
            	?>
        	</div>
        </div>
        
    </div>
</body>
</html>