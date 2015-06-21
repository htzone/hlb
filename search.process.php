<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once 'class/myutil.class.php';

$search_text;
if (isset($_POST["search_text"])) {
	$search_text = $_POST["search_text"];
}
$db = MyUtil::getDB();
if($search_text) {
	$sql = "select id from postbar where name = '{$search_text}'";
 	$result = $db->execute($sql);
	$id=null;
	while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
		$id = $row[0] ;
	}
	if ($id === null) {
		$sql = $sql = "select id from postbar where name = '{$search_text}吧'";
		$result = $db->execute($sql);
		while($row = mysql_fetch_assoc($result, MYSQL_BOTH)){
			$id = $row[0] ;
		}
	}
	if ($id > 0) {
		echo "<script>location.href='home.php?tieba_id={$id}';</script>";
		// 		header("location:home.php?tieba_id={$id}");
	} else {
		echo "<script>location.href='search.php?kw={$search_text}';</script>";
	}
}
else {
	echo "<script>location.href='index.php';</script>";
}

?>