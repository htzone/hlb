<?php 
require_once 'class/myutil.class.php';
/*全局变量初始化*/
$friend_id = -1;
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

/*获取用户id和好友id*/
if(isset($_GET["friend_id"])){
	$friend_id = $_GET["friend_id"];
}
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
<link href="css/friend.css" rel='stylesheet' type='text/css' />
<script src="javascript/jquery.js"></script>
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
        <?php 
        	$db = MyUtil::getDB();
        	$sql = "select id, name, person_image, person_info from user where id = {$friend_id}";
        	$count_result = $db->execute($sql);
        	while ($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)) {
        		$friend_id = $row["id"];
        		$friend_name = $row["name"];
        		$person_image = $row["person_image"];
        		$person_info = $row["person_info"];
        		if (empty($person_info)) {
        			$person_info = "这家伙很懒，啥都没写 (^_^)";
        		}
        		echo "
					<div id='content'>
						<div id='header'>
							<div id='title'>
							{$friend_name}
							</div>
							<div id = 'head_sculptrue'>
								<img src='uploads/{$person_image}' alt='赶快上传你的头像吧~'/>
							</div>
							<div id='info_div'>
								<span>&nbsp;&nbsp;{$friend_name}</span>
								<form methon='post' action=''>";
				$cnt = 0;
				if ($islogined) {
					$sql = "select * from friend where user_id=$user_id and friend_id=$friend_id";
					$db->execute($sql);					
					$cnt = $db->getResultRowsNum();
				}
				
				if ($cnt > 0) {
					echo"
									<input id='add' type='button' value='已加好友' disabled='disabled'/>";
				} else {
					if ($islogined) {
						echo"
									<input id='add' type='button' value='+ 好友' onclick='add_friend($friend_id)'/>";
					} else {
						echo"
									<input id='add' type='button' value='+ 好友' disabled='disabled' />";
					}
					
				}				
				echo"
								<form>
							</div>
						</div>
						<div id='personal_info'>
							<h3>个人简介</h3>
							<div class='line'></div>
							<p>{$person_info}</p>
							<h3>关注的贴吧</h3>
							<div class='line'></div>";
				$sql = "select b.id, b.name from care a, postbar b where a.user_id = {$friend_id} and a.tieba_id = b.id";
				$count_result = $db->execute($sql);
				$nothing = false;
				while ($row = mysql_fetch_assoc($count_result, MYSQL_BOTH)) {
					if ($nothing == false) $nothing = true;
					$tieba_id = $row["id"];
					$tieba_name = $row["name"];
					echo "<span><a href='home.php?tieba_id={$tieba_id}'>{$tieba_name}</a></span>";
				}
				if ($nothing == false) {
					echo "<p>Ta还没有关注过贴吧~</p>";
				}
				echo "    			
					</div>
        		</div>
    		</div>";
							
        	}
        ?>
	</div>
<script type="text/javascript">
// document.getElementById('add').onclick=function(){
// 	var a = document.getElementById('add');
// 	a.disabled='disabled';
// 	a.value='已加关注';
// }
function add_friend(friend_id) {
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp == null) {
		alert("添加好友失败！");
		return;
	}
	var url="sendposthandle.php";
	url=url+"?friend_id="+friend_id+"&action="+8;
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChanged()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
	 	var a = document.getElementById('add');
	 	if(xmlHttp.responseText == "success"){
	 	 	a.disabled='disabled';
	 	 	a.value='已加好友';
		}
	 	else {
			alert(xmlHttp.responseText+"添加好友失败！");
		}
	}
}
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		//Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
</script>
</body>
</html>
