<!DOCTYPE html>
<?php
session_start ();
if(isset($_SESSION['user_id'])){
 $id = $_SERVER['user_id'];
  }else{
 	echo "未登录";
 		$user_id = 4;
  }
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/register.css" rel='stylesheet' type='text/css' />
<title>贴吧修改</title>
<script src="http://localhost/hldb/javascript/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#add").click(function(){
		$("#add_div").slideToggle("slow");	
	  });
	}); 
</script>
<script type="text/javascript">
	function getXmlHttoObject(){
	//不同获取不同
	var xmlHttp;
		if(window.ActiveXObject)
		{
			xmlHttp = new ActiveXObject("Miscrosoft.XMLHTTP");
		}else{

			xmlHttp = new XMLHttpRequest();
		}
		alert("获取xmlHttp对象");
		return xmlHttp;
	}
	function deleteBawu(id)
	{
		var tag=3;//代表删除
		//alert("删除事件："+id+"/"+tag+"/"+tieba_id);
		if(id!=null&&tieba_id!=null&&id!=""&&tieba_id!="")
		{
			if(confirm("你确定删除此吧务吗？"))
				dealOperation(id,tag);
		}		
	}
	
	function addBawu()
	{
		var tag=4;//代表增加
		var name=$u("friendname").value;
		
		if(name!=null&&name!="")
		{
			alert(tag+"/"+name);
			dealOperation(name,tag);
		}
	}
	
	var myXmlHttp ;
	//获取filepath
	function dealOperation(user,tag){
		myXmlHttp = getXmlHttoObject();
		//alert("处理事件的函数:"+id+"/"+tag+"/"+tieba_id);
		if(myXmlHttp)
		{			
			var url="http://localhost/hldb/class/tiebamanage_control.class.php";
			var data="";
			if(tag==3)//删除吧务
			{
				data = "tag="+tag+"&user_id="+user;
			}else if(tag == 4){//增加指定的吧务到前台

				data = "tag="+tag+"&user_name="+user;//user_name是加入的贴吧name
			}
						
			alert(data); 
			 myXmlHttp.open("post",url,true);

			myXmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			myXmlHttp.onreadystatechange = showlog;
			myXmlHttp.send(data);		
				
		}

	}

	//回调函数,处理操作
	function showlog(){
		//取出返回值
		//alert(myXmlHttp.readyState);
		if(myXmlHttp.readyState==4)
		{
		
			$u("show").innerHTML=myXmlHttp.responseText;
			
				$("#add").click(function(){
					$("#add_div").slideToggle("slow");	
				  });
				
		}
	}
	function $u(id)
	{
		 return document.getElementById(id);
	}
</script>

</head>

<body class="bgcolor">
<div class="container"><!-- top_menu 开始 -->
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
<div id="logo"><img src="images/logo.png" /></div>
<form action="class/tieba_modify.class.php?tag=0&bazu_id=<?php echo $user_id?>" method="post"
	enctype="multipart/form-data">
<table>

	<tr>
		<td class='left'>贴吧logo：</td>
		<td class='right'><input type='file' name='logo_url'
			value='' id='logofile' /></td>
	</tr>
	<tr>
		<td class='left'>贴吧名字：</td>
		<td class='right'><input type='text' name='name' value='' /></td>
	</tr>
	<tr>
		<td class='left'>贴吧简介：</td>
		<td class='right'><textarea name='summary' cols='40' rows='4'
			draggable='false' dropzone='move'></textarea></td>
	</tr>


	<tr>
		<td class='left'></td>
		<td class='right'><input class='btn' type='submit' value='提交' /> <input
			class='btn' type='reset' value='重置' /></td>
	</tr>
</table>
</form>
</div>
</div>
</body>
</html>
