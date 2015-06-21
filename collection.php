<?php 
require_once 'class/myutil.class.php';

/*全局变量初始化*/
//初始化用户id
$user_id = -1;
//初始化是否登录标记
$islogined = false;
//初始化数据库
$db = MyUtil::getDB();

session_start();
//自己模拟数据
// $user_id = 5;
// $islogined = true;

/*获取用户id*/
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
	$islogined = true;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/friendmanager.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">
function showDg(post_id){
	var url = "collection.process.php?post_id="+post_id;
	if (confirm('确定要删除吗？')){
 		window.location.href=url
		}
}	
</script>

<title>收藏</title>
</head>

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
        
        <!--header 开始-->
    	<div id="header">
        	<div id="logo">
            	<a href="index.php"><img src="images/logo.png"/></a>
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
			
			<?php 
			/*收藏列表的显示处理*/
				$db = MyUtil::getDB();
				$sql = "select a.tiezi_id, b.tieba_id, b.tiezi_name, a.collection_time from collection a, post b where a.user_id = {$user_id} and a.tiezi_id = b.id order by a.collection_time desc";
				$count_result = $db->execute($sql);
				//遍历结果集
// 				echo "<form id='form' method='post' action='index.php'>";
				$nothing = false;
				while ($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)) {
					if ($nothing == false) $nothing = true;
					$tieba_id = $row["tieba_id"];
					$post_id = $row["tiezi_id"];
					$name = $row["tiezi_name"];
					$time = $row["collection_time"];
					echo "
						<div class='friend_item'>
							<a href='note.php?tieba_id={$tieba_id}&post_id={$post_id}'>{$name}</a>
							<span>{$time}</span>
							<input onclick='showDg($post_id)' type='button' value='删除'/>							
						</div>";
				}
				if ($nothing == false) {
					echo "
					<div class='friend_item'>
					<span>您还没有收藏过帖子，赶紧去收藏吧~</span>						
					</div>";
				}
// 				echo "</form>";
			?>            
        </div>        
    </div>
 		    
</body>
</html>
