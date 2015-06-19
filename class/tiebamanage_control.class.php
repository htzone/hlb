<?php
function __autoload($className) {
	include_once  $className . ".class.php";
}

$db = DbOperator::getInstance ();

//告诉浏览器返回的数据是xml格式
header("Content-Type:text/html;charset=utf-8");
//告诉浏览器不要缓存,解决缓存的两种方式
header("Cache-Control:no-cache");
//变量获取值
$user_id="";
$tieba_id="";
$tag = $_POST['tag'];;
$user_name="";
$bazu_id="";

if($tag==0)
{
	$user_id = $_POST['user_id'];
}else if($tag==1)
{
	$user_name = $_POST['user_name'];
	$bazu_id=$_POST['bazu_id'];
}
if( $_POST['tieba_id'])
{
	$tieba_id =$_POST['tieba_id'] ;

}



// 0：表示图片路径  1：增加吧务 2：删除吧务 3贴吧名称验证
$info="";
//返回值
//$info=$user_id."/".$tag."/".$tieba_id;

//逻辑处理
/*
 * 处理动作：判断是删除还是增加，对appoint表进行操作，从tieba_id获取bazu_id
 */

switch($tag)
{

	case 0://删除贴吧
		$sql1 = "delete from appoint where bawu_id='".$user_id."' and tieba_id='".$tieba_id."'";
		if($db->execute($sql1)){
			//删除成功
			$sql2 = "select id,name from user where id in (select bawu_id from appoint where tieba_id='" . $tieba_id. "')";
			$result = $db->execute ( $sql2 );
			while ( $row = mysql_fetch_array ( $result ) ) {
				$info = $info. "<span class='bawu'>" . trim ( $row ["name"] ) . "<input class='delete' type='button' value='删除' onclick='deleteBawu(".trim ( $row ["id"] ).",".$tieba_id.")' /></span>";

			}

		}else{
			$info="删除失败";
		}
		break;

	case 1://增加吧务
		//寻找吧务id
		$sql3 ="select id from user where name='".trim($user_name)."';";

		$result1 = $db->execute($sql3);
		//echo "<br/>result:".$result1;
		if($db->getResultRowsNum()>=0){
			while($row =mysql_fetch_array ( $result1 ) )
			{
				$user_id=$row['id'];
			}

			$sql4 = "insert into appoint (bazu_id,bawu_id,tieba_id) values('".$bazu_id."','".$user_id."','".$tieba_id."')";
				
				
			if($db->execute($sql4))
			{//插入成功
				$sql5 = "select id,name from user where id in (select bawu_id from appoint where tieba_id='" . $tieba_id. "')";
				$result = $db->execute($sql5);
				while ( $row = mysql_fetch_array ( $result ) ) {
					$info = $info. "<span class='bawu'>" . trim ( $row ["name"] ) . "<input class='delete' type='button' value='删除' onclick='deleteBawu(".trim ( $row ["id"] ).",".$tieba_id.")' /></span>";
				}
			}else{
				echo "插入失败"+$sql4;
			}
		}else{
			echo "没有这个人";
		}
		break;
	default:
		$info="无任何操作";
		break;

}
$info = $info.'<span id="add">增加吧务</span>';
echo $info;


?>