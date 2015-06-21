<?php 
require_once 'class/myutil.class.php';
session_start();
/*全局变量初始化*/
//初始化贴吧id
$tieba_id = -1;
//初始化用户id
$user_id = -1;
//初始化是否登录标记
$islogined = false;
//是否具有管理权限
$isManager = false;
//每页显示数目
$pre_page_num = 10;
//初始化数据库
$db = MyUtil::getDB();

/*获取贴吧id和用户id*/
if(isset($_GET["tieba_id"])){
	$tieba_id = $_GET["tieba_id"];
}

if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
	$islogined = true;
}

//自己模拟数据
// $tieba_id = 1;
// $user_id = 5;
// $islogined = true;

//如果登录了，检查用户是否具有管理权限
if($islogined){
	//检查用户对该贴吧是否具有管理权限
	if(MyUtil::checkUserAuthority($user_id, $tieba_id)){
		//具有管理权限
		$isManager = true;
	}
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- 网页头部 -->
<head>
<title>贴吧名字</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/home.css" rel='stylesheet' type='text/css' />
<script type="text/javascript">    
</script>    
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
            Search::search_postbar();
            ?>
            
            <div class="nav">
            <hr/>
            </div>
            
            <div id="tieba_title_div">
            	<?php 
                /*贴吧信息的显示处理*/
            	
                   $db = MyUtil::getDB();
                   $sql = "select * from postbar where id={$tieba_id}";
                   $tieba_info = $db->execute($sql);
	                //遍历结果集
	                while($row = mysql_fetch_assoc($tieba_info, MYSQL_BOTH)){
	                	$tieba_name = $row["name"];
	                	$people_num = $row["people_num"];
	                	$tiezi_num = $row["tiezi_num"];
	                	$summary = $row["summary"];
	                	$logo_url = $row["logo_url"];
	                }
	                echo "
					<div id='tieba_icon'>
                	<a href='home.php'><img src='uploads/{$logo_url}' /></a>
                	</div>
                	<div id='tieba_title'>
	                {$tieba_name}";         
	                if(MyUtil::checkUserIsCareOfTieba($user_id, $tieba_id)){
	                	echo "<input type='submit' value='已关注' disabled='disabled'/>";
	                }
	                else{
	                	echo "<input type='submit' value='+关注' />";
	                }
                    echo "
                    <span id='focus'>
                   	 关注：{$people_num}人 &nbsp;&nbsp;&nbsp;&nbsp;
                                         帖子：{$tiezi_num}帖 &nbsp;&nbsp;&nbsp;&nbsp;
                                         简介：{$summary}
                    </span>
                    </div>";
                ?>
            </div>
            
        </div>
        <!-- header 结束 -->
        
        <!-- content 开始 -->
        <div id="content">
        <div id="fatie">
        <a class="btn_background" href="#textarea1">我要发帖</a>
        </div>
        <?php 
        /*贴吧列表的显示处理*/
        $db = MyUtil::getDB();
        $post_num = MyUtil::getTieziNumFromTieba($tieba_id); 
        $page = new Page($post_num,$pre_page_num);
        
        $sql = "select user.name,post.id,state,isFine,image_url,tiezi_name,tiezi_content,post.create_time from post,user where tieba_id = {$tieba_id} and post.create_user_id=user.id order by state desc,last_reply_time desc {$page->limit}";
        $result = $db->execute($sql);
        //遍历结果集
        while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
        	$post_id = $row["id"];
        	$state = $row["state"];
        	$isFine = $row["isFine"];
        	$user_name = $row["name"];
        	$image_url = $row["image_url"];
        	
        	$follow_num = MyUtil::getFollowNumFromTiezi($post_id);
        	echo "
				<div class='note_list'>
            	<div class='left'>";
        	if($state){
        		echo "<span>顶</span>";
        	}
        	
        	if($isFine){
        		echo "<span>精</span>";
        	}     
            echo "
				<span>{$follow_num}</span>      
                </div>
                <div class='right'>
                <a href='note.php?post_id=$post_id&tieba_id=$tieba_id'>{$row["tiezi_name"]}</a>
                <p>{$row["tiezi_content"]}</p>";
            
            if($image_url){
            	echo "<p><img src='uploads/$image_url'/>
                </p>";
            }
            
            echo "
                <p class='note_info'>by {$user_name} {$row["create_time"]}</p>
                </div>               
            	</div>         
            	<div class='note_divline'>
            	</div>  ";
        }
        ?>
        
            <div id="div_page">
                 <?php 		            
		            echo $page->fpage(3,4,5,6,7,0);
		            ?>
            </div>
   
        </div>
        <!-- content 结束 -->
        
        <!-- edit 开始 -->
        <?php
        if($islogined){
        	echo "<div id='edit'>
        	<h2 style='float:left;'>发表帖子</h2>
            <div id='edit_div'>
                <form method='post' action='sendposthandle.php'>
                        <table>
						<input type='hidden' name='action' value='1'/>
						<input type='hidden' name='tieba_id' value='$tieba_id'/>
                        <tr><td class='title_style'>标题</td></tr>
                        <tr><td><textarea id='textarea1' name='title' class='textarea' rows='1' ></textarea></td></tr>
                        <tr><td class='title_style'>内容</td></tr>
                        <tr><td><span>表情</span><span>图片</span></td></tr> 
                        <tr><td><textarea id='textarea2' name='content' class='textarea' rows='6' ></textarea></td></tr>
                        <tr><td><input class='textsubmit' type='submit' value='提交' /></td></tr>
                        </table>  
                 </form>
            </div>  
        </div>";
        } 
        else{
        	echo "<div id='edit'>
        	<h2 style='float:left;'>发表帖子</h2>
            <div id='edit_div'>
                <form method='post' action='sendposthandle.php'>
                        <table>
                        <tr><td class='title_style'>标题</td></tr>
                        <tr><td><textarea id='textarea1' name='title' class='textarea' rows='1' ></textarea></td></tr>
                        <tr><td class='title_style'>内容</td></tr>
                        <tr><td><span>表情</span><span>图片</span></td></tr>
                        <tr><td><textarea id='textarea2' name='content' class='textarea' rows='6' value='inpuudasdasd'></textarea></td></tr>
                        <tr><td><input class='textsubmit' type='submit' value='提交' disabled='disabled' /></td></tr>
						<tr><td><h3>请先<a href='login.php?ishome=1&tieba_id=$tieba_id'>登录</a>再发表帖子</h3></td></tr>
                        </table>
                 </form>
            </div>
        </div>";
        }
        ?>
        <!-- edit 结束 -->
        <?php 
        $title = null;
        $content = null;
        if(isset($_POST["title"])){
        	$title = $_POST["title"];
        }
        if(isset($_POST["content"])){
        	$content = $_POST["content"];
        }
        
        $db = MyUtil::getDB();
        if($title&&$content){
        	$sql = "insert into post(tiezi_name,tiezi_content,create_user_id,tieba_id) values('{$title}','{$content}',{$user_id},{$tieba_id})";
        	if($db->execute($sql)){
        		$now_post_num = $post_num+1;
        		$sql = "update postbar set tiezi_num = {$now_post_num} where id = {$tieba_id}";
        		if($db->execute($sql)){
        			echo "<script>location.href='home.php';</script>";
        		}	
        	}
        	else{
        		echo "<script>alert('提交失败！')</script>";
        	}
        }
        else{
        	
        }
        
        ?>
        
        
	</div>
    
</body>
</html>

