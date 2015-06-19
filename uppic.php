

<?php

function __autoload($className) {
	include_once  "./class/".$className . ".class.php";
}
$tieba_id = $_GET['tieba_id'];
$db = DbOperator::getInstance ();
$fileUpload = new FileUpload();
$uploadFlag = $fileUpload->upload('mypic');//上传成功与否
$fikename="";
if($uploadFlag){
	$logoname = $fileUpload->getFileName();//获取该过的图片名称
	$sql = "update postbar set logo_url='".$logoname."'";
	$result = $db->execute($sql);
	if($result>0)
	{
	$logopath = './uploads/'.$logoname;
		?>
<body onload="finishupload(parent,'<?php echo $logopath; ?>');">
	<img src="<?php echo $logopath; ?>" />
	<script type="text/javascript">

        function finishupload(theframe,thefile){
//      var file="showpic.php?img=" + thefile;        
//         if(theframe.runajax){
//          theframe.runajax("showpic",file);
//         }
//         else{
//          alert("Error");
//         }
        theframe.document.getElementById("showpic").innerHTML = "<img width='100' height='100' src='"+thefile+"' />";

        
        }

      
       
       </script>
</body>
<?php
echo $result;
echo $logopath;
	}
}else{
	echo "<script type='text/javascript'> alert('".$fileUpload->getErrorMsg()."');</script>";
	

}
// 允许上传文件的 MIME 类型
