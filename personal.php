<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/personal.css" rel='stylesheet' type='text/css' />
<title>个人主页</title>
</head>
<?php 
require_once 'class/myutil.class.php';
$islogined = false;
$user_id = -1;
session_start();
if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
	$islogined = true;
}else{
	//不存在id
// 	$user_id = 1;
	echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"您的身份验证已过期，请重新登陆！\");\r\n";
	echo " window.location.href=\"login.php\";\r\n";
	echo "</script>";
	exit ();
} 
// function __autoload($className) {
// 	include_once "class/" . $className . ".class.php";
// }
$db = MyUtil::getDB();
?>
<body class="bgcolor">
	<div class="container">
    
     <!-- top_menu 开始 -->
    	<div id="top_menu">
        
           <?php 
           MyUtil::showTopMenu($islogined)
           ?>
            
        </div>
        <!-- top_menu 结束 -->
        
        <!--header 开始-->
    	<div id="header">
        	<div id="logo">
            	<a href='index.php'><img src="images/logo.png"/></a>
            </div>
            <div id="nav">
            </div>
           <?php 
            Search::search_creat_postbar();
            ?>
        </div>
        <!--header 结束-->
        
        <!--moremenu 开始-->
        <div id="more_menu">
            	<ul>
                	<li id="more_menu_selected"><a href="personal.php">个人主页</a></li>
                	<li><a href="tiebamanage.php">贴吧管理</a></li>
                    <li><a href="friendmanager.php">好友管理</a></li>
                    <li><a href="collection.php">收藏</a></li>  
                </ul>
        </div>
        <!--moremenu 结束-->
        
        <!--left_side 开始-->
        <?php 
        	$sql1 = "SELECT a.person_image, a.name, a.tiezi_num, a.collection_num, a.friends_num FROM USER a WHERE a.id =".trim($user_id);
        	$result1 = $db->execute($sql1);
        	$tiezi_num = null;
        	$tiezi_num = MyUtil::getTieziNum($user_id);
        	while($row = mysql_fetch_array($result1))
        	{
        		echo "<div id=\"left_side\">";
        		echo "<div id=\"head_sculptrue\">";
        		echo "<img src='uploads/".trim($row["person_image"])."'/>";
        		echo "<p>".trim($row["name"])."</p>";
        		echo "</div>";
        		echo " <div id=\"personal_info\">";
        		echo "<p>发帖数：<a href='#'>".$tiezi_num."</a></p><hr/>";
        		echo "<p>收藏：<a href='collection.php'>".trim($row["collection_num"])."</a></p><hr/>";
        		echo "<p>好友：<a href='friendmanager.php'>".trim($row["friends_num"])."</a></p><hr/>";
        		echo "<p><a href=\"modify.php\">修改个人资料</a></p>";
        		echo "</div>";
        		echo "</div>";
        	}
        ?>
        <!--left_side 结束-->
        
        <div id="right_side">
        <h3>最近发帖</h3>
        <?php 
        	$sql2 = "SELECT a.id, a.tiezi_name, a.create_time, a.tieba_id FROM post a WHERE a.create_user_id = ".trim($user_id)." ORDER BY a.create_time DESC LIMIT 0,10";
        	$result2 = $db->execute($sql2);
//         	echo $db->getResultRowsNum();
        	$counter = 1;
        	while($row = mysql_fetch_array($result2))
        	{
        		if($counter % 2 == 1){
        			echo "<div class=\"line1\">";
        		} else {
        			echo "<div class=\"line2\">";
        		}
        		echo "<span class=\"title\"><a href=\"note.php?post_id=".trim($row["id"])."&tieba_id=".trim($row["tieba_id"]). "\">".trim($row["tiezi_name"])."</a></span><span class=\"time\">".trim($row["create_time"])."<a href=\"sendposthandle.php?action=9&post_id=".trim($row["id"])."&tieba_id=".trim($row["tieba_id"]). "\">删除</a></span>";
        		echo "</div>";
        		$counter++;
        	}
        ?>
        </div>
        
        <!--more 开始-->
        <div id="more">
        	
        	<div id="my_tieba">
            	<table>
                <th class="th_style">关注的贴吧</th>
                <?php 
        			$sql3 = "SELECT a.id, a.name FROM postbar a, care b, USER c WHERE a.id = b.tieba_id AND b.user_id = c.id AND c.id = ".trim($user_id);
        			$result3 = $db->execute($sql3);
        			while($row = mysql_fetch_array($result3))
        			{
        				echo " <tr><td><a href=\"home.php?tieba_id=".trim($row["id"])."\">".trim($row["name"])."</a></td></tr>";
        			}
       			?>
                </table>
            </div>
            <div id="my_friend">
                <table>
                <th class="th_style">我的好友</th>
                <?php 
        			$sql4 = "SELECT b.id, b.name FROM friend a, USER b WHERE a.friend_id = b.id AND a.user_id = ".trim($user_id);
        			$result4 = $db->execute($sql4);
        			while($row = mysql_fetch_array($result4))
        			{
        				echo " <tr><td><a href=\"friend.php?friend_id=".trim($row["id"])."\">".trim($row["name"])."</a></td></tr>";
        			}
       			?>
                </table>
            </div>
            
        </div>
        <!--more 结束-->
        
    </div>
</body>
</html>
