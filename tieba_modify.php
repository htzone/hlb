<!DOCTYPE html>
<?php
require_once 'class/myutil.class.php';
session_start ();
$user_id = -1;
$islogined = false;
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
<link href="css/register.css" rel='stylesheet' type='text/css' />
<title>贴吧修改</title>
<?php
$db = DbOperator::getInstance ();
if (isset ( $_GET ['tieba_id'] )) {
	$tieba_id = $_GET ['tieba_id'];
} else {
	$tieba_id = -1;//不能在这个页面执行修改的动作，因为吧务和图片上传都是异步执行的，首先必须存在才行
}
?>
<script src="http://localhost/hlb/javascript/jquery.js"></script>
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
		//alert("获取xmlHttp对象");
		return xmlHttp;
	}
	function deleteBawu(id,tieba_id)
	{
		var tag=0;//代表删除
		//alert("删除事件："+id+"/"+tag+"/"+tieba_id);
		if(id!=null&&tieba_id!=null&&id!=""&&tieba_id!="")
		{
			if(confirm("你确定删除此吧务吗？"))
				dealOperation(id,tag,tieba_id);
		}		
	}
	
	function addBawu(tieba_id)
	{
		var tag=1;//代表增加
		var name=$u("friendname").value;
		
		if(name!=null&&tieba_id!=null&&name!=""&&tieba_id!="")
		{
			//alert(tag+"/"+name+"/"+tieba_id);
			dealOperation(name,tag,tieba_id);
		}
	}
	
	var myXmlHttp ;
	//获取filepath
	function dealOperation(user,tag,tieba_id){
		myXmlHttp = getXmlHttoObject();
		//alert("处理事件的函数:"+id+"/"+tag+"/"+tieba_id);
		if(myXmlHttp)
		{			
			var url="http://localhost/hlb/class/tiebamanage_control.class.php";
			var data="";
			if(tag==0)
			{
				data = "tag="+tag+"&user_id="+user+"&tieba_id="+tieba_id;
			}else{

				data = "tag="+tag+"&user_name="+user+"&tieba_id="+tieba_id+"&bazu_id=<?php echo $user_id ?>";
			}
						
			//alert(data); 
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

	 function uploadimg(theform){ 
	     //提交当前表单    
	     theform.submit();
	 }
</script>


</head>

<body class="bgcolor">
<div class="container"><!-- top_menu 开始 -->
<div id="top_menu">

<ul>
	
<?php 
MyUtil::showTopMenu($islogined);
?>

</ul>

</div>
<!-- top_menu 结束 -->

<div id="register_div">
<div id="logo"><a href="index.php"><img src="images/logo.png"/></a></div>

<table border='0' width="100%">



<tr height='50'><td class='left'>贴吧logo：</td><td class='right'>
<form action="uppic.php?tieba_id=<?php echo $tieba_id ?>" method="post" enctype="multipart/form-data" target="upframe" onsubmit="uploadimg(this); return false;">
<input type='file' name='mypic' value='' id='logofile' />
<input type='submit' value='上传'/>
</form>
</td></tr>

<form action="class/tieba_modify.class.php?tag=1&tieba_id=<?php echo $tieba_id ?>" method="post" enctype="multipart/form-data">

<?php
if($tieba_id>=0)
{
$sql1 = "select id,name ,logo_url,summary from postbar where id=" . trim ( $tieba_id );

$result = $db->execute ( $sql1 );

while ( $row = mysql_fetch_array ( $result ) ) {
	echo "<tr height='100'><td class='left'></td><td class='right'> <div id='showpic'><image width='100'  height='100' src='uploads/".trim ( $row ["logo_url"] )."' /></div></td></tr>";
	echo "<tr height='100'><td class='left'>贴吧名字：</td><td class='right'><input type='text' name='name' value='" . trim ( $row ["name"] ) . "'/></td></tr>";
	echo "<tr height='100'><td class='left'>贴吧简介：</td><td class='right'><textarea name='summary' cols='40' rows='4' draggable='false' dropzone='move'>" . trim ( $row ["summary"] ) . "</textarea></td></tr>";

	
	?>
	<tr height='100'>
		<td class='left'>吧务：</td>
		<td class='right'>
		<div id="show"><?php 
		$sql2 = "select id,name from user where id in (select bawu_id from appoint where tieba_id='" . trim ( $row ["id"] ) . "')";

		$result = $db->execute ( $sql2 );
		while ( $row = mysql_fetch_array ( $result ) ) {
			echo "<span class='bawu'>" . trim ( $row ["name"] ) . "<input class='delete' type='button' value='删除' onclick='deleteBawu(".trim ( $row ["id"] ).",".$tieba_id.")' /></span>";
		}

}
}
?> <span id="add">增加吧务</span></div>
		<div id="add_div"><input id="friendname" type="text"
			placeholder="输入好友名称" /> <input type="button" onclick='addBawu(<?php echo $tieba_id ?>);'
			value="确定" /></div>
		</td>
	</tr>

	<tr height='50'>
		<td class='left'></td>
		<td class='right'><input class='btn' type='submit' value='提交' /> <input
			class='btn' type='reset' value='重置' /></td>
	</tr>
	
	</form>

</table>
<iframe id="upframe" name="upframe" src="uppic.php"
		width="300" height="300" style="display:none;"> </iframe>
</div>
</div>
</body>
</html>
