<!DOCTYPE html>
<?php 
require_once 'class/myutil.class.php';
$user_id = -1;
$islogined = false;
session_start();
 if(isset($_SESSION['user_id'])){
	$user_id = $_SESSION['user_id'];
	$islogined = true;
}else{
	echo "未登录";
} 

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/tiebamanager.css" rel='stylesheet' type='text/css' />
<title>贴吧管理</title>
<?php


$db = DbOperator::getInstance ();

?>
</head>

<body class="bgcolor">

	<div class="container">
		<!-- top_menu 开始 -->
		<div id="top_menu">
			<?php
			MyUtil::showTopMenu($islogined) ;
			?>
		</div>
		<!-- top_menu 结束 -->

		<!--header 开始-->
		<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" /></a>
			</div>
			<div id="nav"></div>
			<?php 
            Search::search_creat_postbar();
            ?>
		</div>
		<!--header 结束-->

		<!--moremenu 开始-->
		<div id="more_menu">
			<ul>
				<li class="default_moremenu"><a href="personal.php">个人主页</a></li>
				<li><a href="tiebamanage.php">贴吧管理</a></li>
				<li class="default_moremenu"><a href="friendmanager.php">好友管理</a></li>
				<li class="default_moremenu"><a href="collection.php">收藏</a></li>
			</ul>
		</div>
		<!--moremenu 结束-->

		<div id="content">
			<div id="leftside">
				<div class="title_bar">我是吧主</div>
 <?php
 //遍历数据库

$sql1 = "select name,id from postbar where bazu_id ='" . $user_id . "' ";
$result = $db->execute($sql1);


while($row = mysql_fetch_array($result))
{
	
	echo "<div class='tieba_name'><a href='tieba_show.php?tieba_id=".trim($row['id'])."'>".trim($row['name'])."</a> </div> ";
	
}
//$db->close();
?>
             

			</div>
			<div id="rightside">

				<div class="title_bar">我是吧务</div>
<?php 
$sql2 = "select name,id from postbar where id in(select tieba_id from appoint where bawu_id = '".$user_id."')";
$result = $db->execute($sql2);
while($row = mysql_fetch_array($result))
{
	echo "<div class='tieba_name'>
					<a href='home.php?tieba_id=".trim($row['id'])."'>".trim($row['name'])."</a>
				</div>";
}

?>

			</div>
		</div>
	</div>

</body>
</html>
