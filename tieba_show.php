<!DOCTYPE html>
<?php 
require_once 'class/myutil.class.php';
session_start();
$user_id =-1;
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
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="css/global.css" rel='stylesheet' type='text/css' />
<link href="css/register.css" rel='stylesheet' type='text/css' />
<title>贴吧信息</title>
<?php 

$db = DbOperator::getInstance ();
if(isset($_GET['tieba_id']))
{
	$tieba_id = $_GET['tieba_id'];
}else {
	$tieba_id=1;
}


?>
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
        
    	<div id="register_div">
        	<div id="logo">
            	<a href="index.php"><img src="images/logo.png"/></a>
            </div>
        	<form>
            	<table>
            	<?php 
            		$sql1 = "select id,name ,logo_url,summary from postbar where id=".trim($tieba_id);
            	
            		$result = $db->execute($sql1);
            		
            		while($row = mysql_fetch_array($result))
            		{
            			echo "<tr><td class='left'>贴吧logo：</td><td class='right'><img src='uploads/".trim($row["logo_url"])."'/></td></tr>";
            			echo "<tr><td class='left'>贴吧名字：</td><td class='right'>".trim($row["name"])."</td></tr>";
            			echo "<tr><td class='left'>贴吧简介：</td><td class='right'>".trim($row["summary"])."</td></tr>";
            			echo "  <tr><td class='left'>吧务：</td><td class='right'>";
            			$sql2 = "select name from user where id in (select bawu_id from appoint where tieba_id='".trim($row["id"])."')";
						
            			$result = $db->execute($sql2);
            			while($row = mysql_fetch_array($result))
            			{
            				echo "<span class='bawu'>".trim($row["name"])."</span>";
            			}
            			echo " </td></tr>";
            			echo " <tr><td class='left'></td><td class='right'><a class='update' href='tieba_modify.php?tieba_id=".$tieba_id."'>修改</a></td></tr>";
            		}
            	?>
             
                   
                  
                </table>
            </form>
        </div>
    </div>
</body>
</html>
