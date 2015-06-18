<?php 
require_once 'class/myutil.class.php';
//初始化全局变量
$user_id = -1;
$islogined = false;
$post_id = -1;
$tieba_id = -1;
$current_page = 1;
$pre_page_num = 6;
//如果session被赋值，则取出user_id的值，并设置已登录
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
	$islogined = true;
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

$user_id = 5;
$islogined = true;
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
            	<a href='home.php'><img src='uploads/{$logo_url}' /></a>
            </div>
            ";
        
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
                	<input type='button' value='+关注' />
                </form>
            </div>";
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
        
        	<form id="header_operation" method="post" action="">
            	<input class="btn_background" type="button" value="只看楼主"/>
            	<input class="btn_background" type="button" value="收藏"/>
                <a class="btn_background" href="#textarea">回复</a>
            </form>
            <!--帖子开始-->
            <?php 
            //------跟帖列表显示处理--------
            $floor = 0;
            $db = MyUtil::getDB();
            //第一页时才显示主贴
            if($current_page == 1){
            	//显示主贴
            	$sql = "select post.tiezi_content,post.create_time,user.name,user.person_image,post.image_url from post,user where post.id = {$post_id} and post.create_user_id = user.id";
            	$result = $db->execute($sql);
            	//遍历结果集
            	while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
            	$user_name = $row["name"];
            	$content = $row["tiezi_content"];
            	$person_image = $row["person_image"];
            			$image_url = $row["image_url"];
            			$create_time = $row["create_time"];
            	$floor++;
            	echo "
            	<div class='comment_list'>
            	<div class='left'>
            	<span id='lzflag'>楼主</span>
            	<a href='friend.php'>
            	<img src='uploads/{$person_image}'/>
            	<p>{$user_name}</p>
            	</a>
            	</div>
            	
            	<div class='right'>
            	<p id='num'>{$floor}楼</p>
            	<p id='ctt'>{$content}</p>
            	<p id='ctt'><img src='images/timg.jpg'/><img src='images/timg.jpg'/></p>
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
            	echo "
            	<div class='comment_list'>
            	<div class='left'>";
            	if(MyUtil::checkIsFloorHost($post_id, $follow_user_id)){
            		echo "<span id='lzflag'>楼主</span>";
            	}
            	echo "
            	<a href='friend.php'>
            	<img src='uploads/{$person_image}'/>
            	<p>{$user_name}</p>
            	</a>
            	</div>
            	
            	<div class='right'>
            	<p id='num'>{$floor}楼</p>
            	<p id='ctt'>{$content}</p>
            	<p id='ctt'><img src='images/timg.jpg'/><img src='images/timg.jpg'/></p>
            	<p id='info'>{$create_time}  <span id='' class='return'>回复</span></p>
            	<div class='reply_div'>
            	<form method='' action=''>
            	<textarea rows='3' cols='30'></textarea>
            	<input type='button' value='回复'/>
            	</form>
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
        <div id="edit">
        	<h2 style="float:left;">发表回复</h2>
            <form method="" action="">
                    <table>
                    <tr><td><span>表情</span><span>图片</span></td></tr>
                    <tr><td><textarea id="textarea" name="xxxx" class="textarea" rows="6" ></textarea></td></tr>
                    <tr><td><input class="textsubmit" type="submit" value="提交" /></td></tr>
                    </table>  
             </form>
        </div>
        <!--edit 结束-->
        
    </div>

</body>
</html>
