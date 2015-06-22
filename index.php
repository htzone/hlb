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
        	
            
        	<!--以下是贴吧的图标-->
        	<?php 
        		$db = MyUtil::getDB();
        		$sql = "select id, name, logo_url from postbar order by people_num desc, tiezi_num desc limit 50";
        		$count_result = $db->execute($sql);
        		$cnt = 0;
        		$cnt = $db->getResultRowsNum();        		
        		if ($cnt < 1) {
        			echo "<h1 align='center'>还没有贴吧被创建，去创建属于你的贴吧~</h1>";
        		}
        		else {
        			echo "<h1>猜你喜欢</h1>";
        			if ($cnt <= 10) {
        				while ($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)) {
        					$id = $row["id"];
        					$name = $row["name"];
        					$logo = $row["logo_url"];
        					echo "
								<div name='reco' class='tieba_icon' style='display:inline'>
									<a href='home.php?tieba_id=$id'>
        								<img src = 'uploads/$logo' alt=''>
        								<p>$name</p
        							</a>
        						</div>";
        				}
        			}
        			else {
        				$i = 0;
        				while ($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)) {
        					$i++;
        					$id = $row["id"];
        					$name = $row["name"];
        					$logo = $row["logo_url"];
        					if ($i <= 10) {
        						echo "<div name='reco' class='tieba_icon' style='display:inline'>";
        					} else {
        						echo "<div name='reco' class='tieba_icon' style='display:none'>";
        					}
        					echo "        					
        							<a href='home.php?tieba_id=$id'>
        								<img src = 'uploads/$logo' alt=''>
        								<p>$name</p>
        							</a>
        						</div>";
        						
        				}
        				echo "
        					<div class='nav'>
        						</div>
        					
        						<div id='dontlike'>
        						<button id='button'>不喜欢？换一批</button>
        					</div>";
        			}
        			
        		}
        	?>            
        </div>
        <!-- content 结束 -->
        
        <!-- footer 开始 -->
        <div id="footer">
        Copyright© 2015 <a href="www.htzone.cn" style="text-decoration:none; color:#000">www.htzone.cn<a> 
        </div>
        <!-- footer 结束 -->
        
	</div>
<script type="text/javascript">
var i = 10;
document.getElementById('button').onclick=function() {
	var a = document.getElementsByName('reco'), len = a.length;
	for (var j = 0; j < len; j++) {
		a[j].style.display='none';
	}
	if (i+10 > len) {
		var k = len-10;
		for ( ; k < len; k++) {
			a[k].style.display='inline';
		}
		i = 0;
	} else {
		for (var j = 0; j < 10; j++) {
			a[i].style.display='inline';
			i = (i+1)%len;
		}
	}
	
}
</script> 
</body>
</html>


