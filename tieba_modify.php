<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/register.css" rel='stylesheet' type='text/css' />
<title>贴吧修改</title>
<script src="javascript/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#add").click(function(){
		$("#add_div").slideToggle("slow");	
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
        
    	<div id="register_div">
        	<div id="logo">
            	<img src="images/logo.png"/>
            </div>
        	<form>
            	<table>
                	<tr><td class="left">贴吧logo：</td><td class="right"><input type="file" name=""/></td></tr>
                    <tr><td class="left"></td><td class="right"><img src=""/></td></tr>
                	<tr><td class="left">贴吧名字：</td><td class="right"><input type="text" /></td></tr>
                    <tr><td class="left">贴吧简介：</td><td class="right"><textarea name="" cols="40" rows="4" draggable="false" dropzone="move"></textarea></td></tr>
                    <tr><td class="left">吧务：</td><td class="right">
                    <span class="bawu">小黑黑<input class="delete" type="button" value="删除"/></span>
                    <span class="bawu">小Weiwei<input class="delete"type="button" value="删除"/></span>
                    <!--自己发挥了-->
                    <span id="add">增加吧务</span>
                    <div id="add_div">
                    	<input type="text" placeholder="输入好友名称" /> <input type="button" value="确定" />
                    </div>
                    </td></tr>
                    <tr><td class="left"></td><td class="right"><input class="btn" type="submit" value="提交"/><input class="btn" type="reset" value="重置"/></td></tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
