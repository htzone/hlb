<!DOCTYPE html>
<?php
require_once 'class/myutil.class.php';
$user_id = -1;
$islogined = false;
session_start ();
if(isset($_SESSION['user_id'])){
 $user_id = $_SESSION['user_id'];
 $islogined = true;
  }else{
 	echo "<script>alert('未登陆，请先登陆');
 	location.href('login.php');
 	</script>";
 	
  }
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/register.css" rel='stylesheet' type='text/css' />
<title>贴吧修改</title>
<script src="./javascript/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$("#add").click(function(){
		$("#add_div").slideToggle("slow");	
	  });
	}); 
</script>
<script type="text/javascript"><!--
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
			var url="class/tiebamanage_control.class.php";
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
	function uploadinfo()
	{
		
		var name = $u('name').value;
		
		if(name=="")
		{
			alert('贴吧名称不能为空!');
			
		}else{

			$u('createform').submit();
		}
		
	}
	
--></script>

</head>

<body class="bgcolor">
<div class="container"><!-- top_menu 开始 -->
<div id="top_menu">

<?php 
	MyUtil::showTopMenu($islogined);
?>

</div>
<!-- top_menu 结束 -->

<div id="register_div">
<div id="logo"><a href="index.php"><img src="images/logo.png"/></a></div>
<form action="class/tieba_modify.class.php?tag=0&bazu_id=<?php echo $user_id?>" method="post"
	enctype="multipart/form-data" id='createform'>
<table>

	<tr>
		<td class='left'>贴吧logo：</td>
		<td class='right'><input type='file' name='logo_url'
			value='' id='logofile' /></td>
	</tr>
	<tr>
		<td class='left'>贴吧名字：</td>
		<td class='right'><input type='text' name='name' value='' id='name'/></td>
	</tr>
	<tr>
		<td class='left'>贴吧简介：</td>
		<td class='right'><textarea name='summary' cols='40' rows='4'
			draggable='false' dropzone='move'></textarea></td>
	</tr>


	<tr>
		<td class='left'></td>
		<td class='right'><input class='btn' type='button' onclick='uploadinfo();'  value='提交' /> <input
			class='btn' type='reset' value='重置' /></td>
	</tr>
</table>
</form>
</div>
</div>
</body>
</html>
