
<meta
	http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
/**
 * 贴吧修改页面的控制类，获取提交的数据，并且进行数据的处理，写入数据库之中
 *
 */
//获取
function __autoload($className) {
	include_once  $className . ".class.php";
}

$db = DbOperator::getInstance ();
$fileUpload = new FileUpload();
//获取变量
$fileUpload->set("path", "../uploads");
$uploadFlag = false ;//上传成功与否
$tag = $_GET['tag'];
$tieba_id="";
$bazu_id="";
if($tag==1){//修改
	$tieba_id = $_GET['tieba_id'];
}else if($tag==0)
{
	$bazu_id=$_GET['bazu_id'];
	$uploadFlag = $fileUpload->upload('logo_url');//上传成功与否
}
$logoname="";
$name = $_POST['name'];
$summary = $_POST['summary'];

//处理数据
if($uploadFlag){
	$logoname = $fileUpload->getFileName();//获取该过的图片名称
	echo "<script type='text/javascript'>alert('获取图片名称成功 ');</script>";
}else{
	
}
//将数据插入到数据库之中
echo $tag+"<br/>";
echo $logoname."/".$name."/".$summary+"<br/>";


$sql="";

if($tag==1)
{
	
	$sql4 = "select * from postbar where name='".$name."'";
	$result4 = $db->execute($sql4);
	if($db->getResultRowsNum()==0)
	{	
	$sql="update postbar set name='".$name."',summary='".$summary."' where id=".$tieba_id;

	}else{
		$sql="update postbar set name='".$name."',summary='".$summary."' where id=".$tieba_id;
		
	}

}else{
$sql4 = "select * from postbar where name='".$name."'";
	$result4 = $db->execute($sql4);
	if($db->getResultRowsNum()==0)
	{	
	$sql="insert into postbar(name,logo_url,summary,bazu_id) values('".$name."','".$logoname."','".$summary."','".$bazu_id."')";

	}else{
		$sql="insert into postbar(name,logo_url,summary,bazu_id) values('".$name."','".$logoname."','".$summary."','".$bazu_id."')";
		
		
	}
	//$sql="insert into postbar(name,logo_url,summary,bazu_id) values('".$name."','".$logoname."','".$summary."','".$bazu_id."')";
}
echo $sql;
$result = $db->execute($sql);
if($tag==1){
	if($result > 0)
	{

		echo "<scipt type=‘text/javascript’>alert('修改成功 ！')</script>";
		header("Location:../tieba_show.php?tieba_id=".$tieba_id);
		exit;
	}else{

		echo "<scipt type=‘text/javascript’>alert('修改成失败！')</script>";
		header("Location:../tieba_modify.php?tieba_id=".$tieba_id);
	}
}else if($tag==0)
{
	if($result > 0)
	{
		$sql3 = "select id from postbar where name='".$name."' and logo_url='".$logoname."'";
		$result = $db->execute($sql3);
		while($row = mysql_fetch_array($result))
		{
			$tieba_id = $row['id'];
		}
		echo "<scipt type=‘text/javascript’>alert('创建成功 ！')</script>";
		header("Location:../tieba_show.php?tieba_id=".$tieba_id);
		exit;
	}else{

		echo "<scipt type=‘text/javascript’>alert('创建失败！')</script>";
		header("Location:../tieba_create.php");
	}
}


//跳回show页面，实现刷新就行了，显示修改后的界面

