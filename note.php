<?php 
require_once 'class/myutil.class.php';
session_start();
//初始化全局变量
$user_id = -1;
$islogined = false;
//是否具有管理权限
$isManager = false;
$post_id = -1;
$tieba_id = -1;
$current_page = 1;
$pre_page_num = 6;
$current_user_face_url = "";
$current_user_name = "";
//如果session被赋值，则取出user_id的值，并设置已登录
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
	$islogined = true;
	$current_user_face_url = MyUtil::getUserFaceUrl($user_id);
	$current_user_name = MyUtil::getUserName($user_id);
}
if(isset($_GET["post_id"])){
	$post_id = $_GET["post_id"];
}
if(isset($_GET["tieba_id"])){
	$tieba_id = $_GET["tieba_id"];
}
if(isset($_GET["page"])){
	$current_page = $_GET["page"];
}

//如果登录了，检查用户是否具有管理权限
if($islogined){
	//检查用户对该贴吧是否具有管理权限
	if(MyUtil::checkUserAuthority($user_id, $tieba_id)){
		//具有管理权限
		$isManager = true;
	}

}
// $post_id =1;
// $tieba_id =1;
// $user_id = 5;
// $islogined = true;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>帖子名称</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/note.css" rel='stylesheet' type='text/css' />
<script src="javascript/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".return").click(function(){
		$(this).parents(".right").find(".reply_div").slideToggle("slow");	
	  });
});

	function collect(post_id){
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
			alert ("操作失败！");
			return
		}
		var url="sendposthandle.php"
		url=url+"?post_id="+post_id
		url=url+"&action="+7
		xmlHttp.onreadystatechange=stateChanged4
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
	}
	
	g_follow_id = -1;
	function tiezi_operate(follow_id){
		if(confirm("你确定要删除这条帖子吗？")){
		}
		else{
			return;
		}
		g_follow_id = follow_id;
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
			alert ("操作失败！");
			return
		}
		var url="sendposthandle.php"
		url=url+"?follow_id="+follow_id
		url=url+"&action="+6
		xmlHttp.onreadystatechange=stateChanged3
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
		
	}

	function care(tieba_id){
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
			alert ("关注失败！");
			return
		}
		var url="sendposthandle.php"
		url=url+"?tieba_id="+tieba_id
		url=url+"&action="+4
		xmlHttp.onreadystatechange=stateChanged2
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
	}

	var gid = -1;
	var content = "";
	var user_id =-1;
	var image_url = "";
	var user_name = "";

	function addReply(gentie_id,user_id1,image_url1,user_name1){
		gid = gentie_id;
		user_id = user_id1;
		image_url = image_url1;
		user_name = user_name1;
		
		content = document.getElementById("comment_content"+gid).value;
		xmlHttp=GetXmlHttpObject()
		if (xmlHttp==null)
		{
			alert ("回复失败！");
			return
		}
		var url="sendposthandle.php"
		url=url+"?content="+content
		url=url+"&action="+3
		url=url+"&gentie_id="+gid
		xmlHttp.onreadystatechange=stateChanged1
		xmlHttp.open("GET",url,true)
		xmlHttp.send(null)
	}

	function stateChanged1()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{	
			var div_element=document.getElementById("replydiv"+gid);
			div_element.className='replydiv'
			
			var para1=document.createElement("p");
			para1.innerHTML="<a href='friend.php?friend_id="+user_id+"'><img src='uploads/"+image_url+"'/>"+user_name+"</a>: "+content;
//	 		var node1=document.createTextNode(document.getElementById("comment_content"+gid).value);
//	 		para1.appendChild(node1);
			para1.className='reply_content'
			var para2=document.createElement("p");
			var node2=document.createTextNode(xmlHttp.responseText);
			para2.appendChild(node2);
			para2.className='reply_time'

			var element=document.getElementById("comment_div"+gid);
			element.appendChild(para1);
			element.appendChild(para2);

// 			alert ("回复成功！");
			document.getElementById("comment_content"+gid).value="";
// 			$(".return").slideUp("slow");
			
		}
	}

	function stateChanged2()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{	
			var care_button=document.getElementById("care_button");
			if(xmlHttp.responseText == "success"){
				care_button.value = "已关注";
				care_button.disabled = true;
			}
			else{
				alert("关注失败");
			}
		}
	}

	function stateChanged3()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{	
			var list_div = document.getElementById("comment_list"+g_follow_id);
			if(xmlHttp.responseText == "success"){
				list_div.style.display = "none";
			}
			else{
				alert("操作失败");
			}
		}
	}

	function stateChanged4()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{	
			var collect_button = document.getElementById("collect_button");
			if(xmlHttp.responseText == "success"){
				collect_button.value = "已收藏";
				collect_button.disabled=true;
			}
			else{
				alert("操作失败");
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
</head>

<body class="bgcolor">

    <div class="container">
    
    	<!-- top_menu 开始 -->
    	<div id="top_menu">
        
            <?php 
            MyUtil::showTopMenu($islogined);
            ?>
            
        </div>
        <!-- top_menu 结束 -->
    	
        <!--header 开始-->
    	<div id="header">
    	
        <?php 
        //------头部贴吧信息的显示处理--------
        $db = MyUtil::getDB();
        $sql = "select * from postbar where id={$tieba_id}";
        $tieba_info = $db->execute($sql);
        //遍历结果集
        while($row = mysql_fetch_assoc($tieba_info, MYSQL_BOTH)){
        	$tieba_name = $row["name"];
        	$people_num = $row["people_num"];
        	$tiezi_num = $row["tiezi_num"];
        	$logo_url = $row["logo_url"];
        }
        
        echo "
			<div id='tieba_logo'>
            	<a href='home.php?tieba_id=$tieba_id'><img src='uploads/{$logo_url}' /></a>
            </div>
            ";
        
        if($islogined){
        	if(MyUtil::checkUserIsCareOfTieba($user_id, $tieba_id)){
        		echo "
				<div id='focus'>
            	<form method='post' action=''>
                	<input type='button' value='已关注' disabled='disabled'/>
                </form>
            	</div>";
        	}
        	else{
        		echo "<div id='focus'>
            	<form method='post' action=''>
                	<input id='care_button' type='button' value='+关注' onclick=\"care($tieba_id)\"/>
                </form>
            </div>";
        	}
        }    
        echo" 
            <div id='tieba_info'>
            	<span>{$tieba_name}</span>
            	<span>关注：{$people_num}人</span>
                <span>帖子：{$tiezi_num}帖</span>
            </div>";
        ?>
        	
            
        </div>
        <!--header 结束-->
        
        <!--content 开始-->
        <div id="content">
        
        	
            <!--帖子开始-->
            <?php 
            
            echo 
            "<form id='header_operation'>";
            if($islogined){
            	if(MyUtil::isCollected($user_id, $post_id)){
            		echo "<input id='collect_button' class='btn_background' type='button' value='已收藏' disabled='disabled' onclick=\"collect($post_id)\"/>";
            	}
            	else{
            		echo "<input id='collect_button' class='btn_background' type='button' value='收藏' onclick=\"collect($post_id)\"/>";
            		}
            }   
            echo 
            " <a class='btn_background' href='#textarea'>回复</a>
            </form>
            ";
            //------跟帖列表显示处理--------
            $floor = 0;
            $db = MyUtil::getDB();
            //第一页时才显示主贴
            if($current_page == 1){
            	//显示主贴
            	$sql = "select post.tiezi_content,post.create_time,user.id,user.name,user.person_image,post.image_url from post,user where post.id = {$post_id} and post.create_user_id = user.id";
            	$result = $db->execute($sql);
            	//遍历结果集
            	while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
            	$friend_id = $row["id"];
            	$user_name = $row["name"];
            	$content = $row["tiezi_content"];
            	$person_image = $row["person_image"];
            	$image_url = $row["image_url"];
            	$create_time = $row["create_time"];
            	$floor++;
            	$content = str_replace("\n", "</br>", $content);
            	$content = str_replace("\r", "</br>", $content);
            	echo "
            	<div class='comment_list'>
            	<div class='left'>
            	<span id='lzflag'>楼主</span>
            	<a href='friend.php?friend_id=$friend_id'>
            	<img src='uploads/{$person_image}'/>
            	<p>{$user_name}</p>
            	</a>
            	</div>
            	
            	<div class='right'>
            	<p id='num'>{$floor}楼</p>
            	<p id='ctt'>{$content}</p>
            	<p id='ctt'></p>
            	<p id='info'>{$create_time}</p>
            	</div>
            	</div>";
            	}
            }
            else{
            	$floor++;
            }
            //分页设置
            $follow_num = MyUtil::getFollowNumFromTiezi($post_id);
            $page = new Page($follow_num+1,$pre_page_num);

            //显示跟帖信息  
            $sql = "select user.id as 'userid',user.name,user.person_image,follow.id as 'followid',content,create_time,image_url from follow,user where tiezi_id = {$post_id} and follow.create_user = user.id order by create_time asc {$page->limit}";
            $result = $db->execute($sql);
            //遍历结果集
            $floor = $floor + ($current_page-1)*$pre_page_num;
            while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
             	$follow_user_id = $row["userid"];
            	$user_name = $row["name"];
            	$person_image = $row["person_image"];
            	$follow_id = $row["followid"];
            	$content = $row["content"];
            	$create_time = $row["create_time"];
            	$image_url = $row["image_url"];
            	$floor++;
            	$content = str_replace("\n", "</br>", $content);
            	$content = str_replace("\r", "</br>", $content);
            	echo "
            	<div id='comment_list$follow_id' class='comment_list'>
            	<div class='left'>";
            	if(MyUtil::checkIsFloorHost($post_id, $follow_user_id)){
            		echo "<span id='lzflag'>楼主</span>";
            	}
            	echo       
            	"<a href='friend.php?friend_id=$follow_user_id'>
            	<img src='uploads/{$person_image}'/>
            	<p>{$user_name}</p>
            	</a>
            	</div>
            	
            	<div class='right'>
            	<p id='num'>{$floor}楼</p>
            	<p id='ctt'>{$content}</p>
            	<p id='ctt'></p>
            	<p id='info'>{$create_time} <span id='' class='return'>回复</span>";
            	if($isManager){
            		echo "<input type='button' value='删除' onclick=\"tiezi_operate($follow_id)\"/>";
            	}
            	echo "</p>";
            	$sql = "select user.id,user.name,user.person_image,comment.content,comment.time from comment,user where gentie_id = {$follow_id} and comment.from_id = user.id order by comment.time";
            	$comment_result = $db->execute($sql);
            	if($db->getResultRowsNum()){
            		echo "<div class='replydiv' id='replydiv$follow_id'>";
            	}
            	else {
            		echo "<div id='replydiv$follow_id'>";
            	}
            	echo "<div id='comment_div$follow_id'>";
            	while($row1 = mysql_fetch_assoc($comment_result, MYSQL_BOTH)){
            		$comment_user_id = $row1["id"];
            		$comment_user_name = $row1["name"];
             		$coment_user_person_image = $row1["person_image"];
             		$comment_content = $row1["content"];
             		$comment_time = $row1["time"];
             		echo "
            			<p class='reply_content'><a href='friend.php?friend_id=$comment_user_id'><img src='uploads/{$coment_user_person_image}'/>{$comment_user_name}</a>: {$comment_content}</p>
            			<p class='reply_time'>{$comment_time}</p>";
            	}
            	echo "</div>";
            	echo 
            	"
            	<div class='reply_div'>		
            	<form>
            	<textarea rows='3' cols='30' id='comment_content$follow_id'></textarea>";
            	if($islogined){
            		echo
            		"<input type='button' value='回复' onclick=\"addReply($follow_id,$user_id,'$current_user_face_url','$current_user_name')\">";
            	}
            	else{
            		echo "<input type='button' value='回复' onclick=\"addReply($follow_id,$user_id,'$current_user_face_url','$current_user_name')\" disabled='disabled'>
            		请先<a href='login.php?isnote=1&post_id=$post_id&tieba_id=$tieba_id'>登录</a>再回复";
            	}
            	echo
            	"</form>
            	</div>
            	</div>
            	</div>
            	</div>";
            } 
            ?>
            <div id="div_page">
                 <?php 		            
		            echo $page->fpage(3,4,5,6,7,0);
		            ?>
            </div>

        </div>
        <!--content 结束-->
        
        <!--edit 开始-->
        
        <?php 
        //显示跟帖表单
        if($islogined){
        	echo "
			<div id='edit'>
        	<h2 style='float:left;'>发表回复</h2>
            <form method='post' action='sendposthandle.php'>
                    <table>
					<input type='hidden' name='action' value='2'/>
					<input type='hidden' name='post_id' value='$post_id'/>
					<input type='hidden' name='tieba_id' value='$tieba_id'/>
                    <tr><td><span>表情</span><span>图片</span></td></tr>
                    <tr><td><textarea id='textarea' name='content' class='textarea' rows='6' ></textarea></td></tr>
                    <tr><td><input class='textsubmit' type='submit' value='提交' /></td></tr>
                    </table>  
             </form>
        	</div>";
        }
        else{
        	echo "
			<div id='edit'>
        	<h2 style='float:left;'>发表回复</h2>
            <form method='post' action='sendposthandle.php'>
                    <table>
                    <tr><td><span>表情</span><span>图片</span></td></tr>
                    <tr><td><textarea id='textarea' name='content' class='textarea' rows='6' ></textarea></td></tr>
                    <tr><td><input class='textsubmit' type='submit' value='提交' disabled='disabled'/></td></tr>
					<tr><td><h3>请先<a href='login.php?isnote=1&post_id=$post_id&tieba_id=$tieba_id'>登录</a>再发表帖子</h3></td></tr>
                    </table> 
             </form>
        	</div>";
        }
        ?>     
        <!--edit 结束-->
        
        <?php 
        
        
        ?>
        
    </div>

</body>
</html>
