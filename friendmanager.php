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
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/friendmanager.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">
function showDg(friend_id){
	var url = "friendmanager.process.php?friend_id="+friend_id;
	if (confirm('确定要删除吗？')){
 		window.location.href=url
		}
}	
</script>
<title>好友管理</title>
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
                	<li class="default_moremenu"><a href="personal.php">个人主页</a></li>
                	<li class="default_moremenu"><a href="tiebamanage.php">贴吧管理</a></li>
                    <li><a href="friendmanager.php">好友管理</a></li>
                    <li class="default_moremenu"><a href="collection.php">收藏</a></li>
                </ul>
        </div>
        <!--moremenu 结束-->
        
        <div id="content">
        	<div class="title_bar">
            	我的好友
            </div>
			
			<?php 
				/*好友列表的显示处理*/
				$db = MyUtil::getDB();
				$sql = "select a.friend_id, b.name from friend a, user b where a.friend_id = b.id and a.user_id = {$user_id} order by b.name";
				$count_result = $db->execute($sql);
				//遍历结果集
				$nothing = false;
				while ($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)) {
					if ($nothing == false) $nothing = true;
					$friend_id = $row["friend_id"];
					$friend_name = $row["name"];
					echo "
						<div class='friend_item'>
							<a href='friend.php?friend_id={$friend_id}'>{$friend_name}</a>
							<input onclick='showDg({$friend_id})' type='button' value='删除'/>
						</div>";
				}
				if ($nothing == false) {
					echo "
					<div class='friend_item'>
					<span>您还没有好友，赶紧去添加好友吧~</span>
					</div>";
				}				
			?>			
        </div>        
    </div>
 		    
</body>
</html>
