<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- 网页头部 -->
<head>
<title>贴吧名字</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/home.css" rel='stylesheet' type='text/css' />
</head>
<!-- 主体 -->
<body class="bgcolor">

	<div class="container">
    
    	 <!-- top_menu 开始 -->
    	<div id="top_menu">
        
            <ul>
            	<li><a href="register.php">注册</a></li>
                <li class="menudiv"></li>
                <li><a href="login.php">登录</a></li>
                <li class="menudiv"></li>
                <li><a href="personal.php">个人</a></li> 
                <li class="menudiv"></li> 
                <li><a href="index.php">主页</a></li>  
                 
            </ul>
            
        </div>
        <!-- top_menu 结束 -->
        
        <!-- header 开始 -->
		<div id="header">
        
        	<div id="top_logo">
            	<a href="index.php"><img src="images/logo.png"/></a>
            </div>
            
            <div id="head_other">
                <form action="" method="post">
                    <input id="search_text" type="text" placeholder="Search.." required/>&nbsp;&nbsp;
                    <input id="search_button" type="submit" value="进入贴吧" />
                </form>
            </div>
            
            <div class="nav">
            <hr/>
            </div>
            
            <div id="tieba_title_div">
            	<div id="tieba_icon">
                	<a href="home_bawu.php"><img src="images/timg.jpg" /></a>
                </div>
                <div id="tieba_title">
                	滑板吧
                    <input type="submit" value="+关注"/>
                    <span id="focus">
                    关注：20231人 &nbsp;&nbsp;&nbsp;&nbsp;
                    帖子：123124帖 &nbsp;&nbsp;&nbsp;&nbsp;
                    简介：滑板，滑板，滑板，滑板，滑板，滑起来。
                    </span>
                </div>

            </div>
            
        </div>
        <!-- header 结束 -->
        
        <!-- content 开始 -->
        <div id="content">
        <div id="fatie">
        <a class="btn_background" href="#textarea1">我要发帖</a>
        </div>
        
        <!--note_list_item 开始-->
        	<div class="note_list">
            
            	<div class="left">
                <span>23712</span>
                </div>
                
                <div class="right">
                <a href="note_bawu.php">各位大神，这板子怎么样啊，感觉</a>
                <span>
                	<input type="button" value="置顶" />
                    <input type="button" value="加精" />
                    <input type="button" value="删除" />
                </span>
                <p>各位大神，这板子怎么样dasdasddasd货吗？</p>
                <p><img src="images/m1.jpg"/>
                <img src="images/m1.jpg"/></p>
                
                <p class="note_info">by hetao 2015-05-12 20:10:02</p>
                </div>
                
            </div>         
            <div class="note_divline">
            </div>
           <!--note_list_item 结束-->
           
           <!--note_list_item 开始-->
        	<div class="note_list">
            
            	<div class="left">
                <span>23712</span>
                </div>
                
                <div class="right">
                <a href="note_bawu.php">各位大神，这板子怎么样啊，感觉</a>
                <span>
                	<input type="button" value="置顶" />
                    <input type="button" value="加精" />
                    <input type="button" value="删除" />
                </span>
                <p>各位大神，这板子怎么样dasdasddasd货吗？</p>
                <p><img src="images/m1.jpg"/>
                <img src="images/m1.jpg"/></p>
                
                <p class="note_info">by hetao 2015-05-12 20:10:02</p>
                </div>
                
            </div>         
            <div class="note_divline">
            </div>
           <!--note_list_item 结束-->
           
           <!--note_list_item 开始-->
        	<div class="note_list">
            
            	<div class="left">
                <span>23712</span>
                </div>
                
                <div class="right">
                <a href="note_bawu.php">各位大神，这板子怎么样啊，感觉</a>
                <span>
                	<input type="button" value="置顶" />
                    <input type="button" value="加精" />
                    <input type="button" value="删除" />
                </span>
                <p>各位大神，这板子怎么样dasdasddasd货吗？</p>
                <p><img src="images/m1.jpg"/>
                <img src="images/m1.jpg"/></p>
                
                <p class="note_info">by hetao 2015-05-12 20:10:02</p>
                </div>
                
            </div>         
            <div class="note_divline">
            </div>
           <!--note_list_item 结束-->

            <div id="div_page">
                <ul>
                	<li><a href="#">首页</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">7</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">尾页</a></li>
                </ul>
            </div>
        
            
            
        </div>
        <!-- content 结束 -->
        
        <!-- edit 开始 -->
        <div id="edit">
        	<h2 style="float:left;">发表帖子</h2>
            <div id="edit_div">
                <form method="" action="">
                        <table>
                        <tr><td class="title_style">标题</td></tr>
                        <tr><td><textarea id="textarea1" name="xxxx" class="textarea" rows="1" ></textarea></td></tr>
                        <tr><td class="title_style">内容</td></tr>
                        <tr><td><span>表情</span><span>图片</span></td></tr> 
                        <tr><td><textarea id="textarea2" name="xxxx" class="textarea" rows="6" ></textarea></td></tr>
                        <tr><td><input class="textsubmit" type="submit" value="提交" /></td></tr>
                        </table>  
                 </form>
            </div>  
        </div>
        <!-- edit 结束 -->
        
	</div>
    
</body>
</html>
