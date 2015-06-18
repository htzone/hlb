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
    	
        <!--header 开始-->
    	<div id="header">
        
        	<div id="tieba_logo">
            	<a href="home_bawu.php"><img src="images/timg.jpg" /></a>
            </div>
            
            <div id="focus">
            	<form method="post" action="">
                	<input type="button" value="+关注" />
                </form>
            </div>
            
            <div id="tieba_info">
            	<span>滑板吧</span>
            	<span>关注：20231人</span>
                <span>帖子：123124帖</span>
            </div>
            
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
            <div class="comment_list">
            	<div class="left">
                	<span id="lzflag">楼主</span>
                	<a href="friend.php">
                	<img src="images/1427624902785.jpg"/>
                   	<p>小涛</p>
                    </a>
                </div>
                
                <div class="right">
               		 <p id="num">1楼</p>
               		 <p id="ctt">你好啊阿大声道静安寺都快来大神快来大神快来决定将,收定将,。。。</p>
                     <p id="ctt"><img src="images/timg.jpg"/><img src="images/timg.jpg"/></p>
                     <p id="info">2015-05-11 20:11:01  <span id="" class="return">回复</span><input type="button" value="删除"/></p>
                     <div class="reply_div">
                     	<form method="" action="">
                        	<textarea rows="3" cols="30"></textarea>
                            <input type="button" value="回复"/>
                        </form>
                     </div>
                </div>
            </div>
            <!--帖子结束-->
            
            <!--帖子开始-->
            <div class="comment_list">
            	<div class="left">
                	<!--<span id="lzflag">楼主</span>-->
                	<a href="friend.php">
                	<img src="images/1427624876850.jpg"/>
                   	<p>小黑黑</p>
                    </a>
                </div>
                
                <div class="right">
               		 <p id="num">2楼</p>
               		 <p id="ctt">fuck sdasdasdsd撒打算为全文上大大时代阿大声道将,收定将dasdasd,。。。</p>
                     <p id="info">2015-05-11 20:11:01  <span id="" class="return">回复</span><input type="button" value="删除"/></p>
                     <div class="reply_div">
                     	<form method="" action="">
                        	<textarea rows="3"></textarea>
                            <input type="button" value="回复"/>
                        </form>
                     </div>
                </div>
            </div>
            <!--帖子结束-->
            
             <!--帖子开始-->
            <div class="comment_list">
            	<div class="left">
                	<span id="lzflag">楼主</span>
                	<a href="friend.php">
                	<img src="images/1427624902785.jpg"/>
                   	<p>小涛</p>
                    </a>
                </div>
                
                <div class="right">
               		 <p id="num">3楼</p>
               		 <p id="ctt">你好啊阿大声道静安寺都快来大神快来大神快来决定将,收定将,。。。</p>
                     <p id="info">2015-05-11 20:11:01  <span id="" class="return">回复</span><input type="button" value="删除"/></p>
                     <div class="reply_div">
                     	<form method="" action="">
                        	<textarea rows="3"></textarea>
                            <input type="button" value="回复"/>
                        </form>
                     </div>
                </div>
            </div>
            <!--帖子结束-->
            
             <!--帖子开始-->
            <div class="comment_list">
            	<div class="left">
                	<!--<span id="lzflag">楼主</span>-->
                	<a href="friend.php">
                	<img src="images/1427624916950.jpg"/>
                   	<p>小Weiwei</p>
                    </a>
                </div>
                
                <div class="right">
               		 <p id="num">4楼</p>
               		 <p id="ctt">fuck sdasdasdsd撒打算为全文上大大时代阿大声道将,收定将d按时大大说的大大说的阿萨达大厦大大说的大大说的阿。。。</p>
                     <p id="info">2015-05-11 20:11:01  <span id="" class="return">回复</span><input type="button" value="删除"/></p>
                     <div class="reply_div">
                     	<form method="" action="">
                        	<textarea rows="3"></textarea>
                            <input type="button" value="回复"/>
                        </form>
                     </div>
                </div>
            </div>
            <!--帖子结束-->
  
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
