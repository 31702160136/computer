<body>
	<form action="test.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file" />
		<br />
		<input type="submit" name="ok" value="提交"/>
	</form>
</body>
<?php
if (@$_POST["ok"]) {
	$fileType=$_FILES["file"]["type"];//获取图片类型
	$fileType=round($_FILES["file"]["size"]/1024/1024,2);//获取文件大小
	$tmpimg=$_FILES["file"]["tmp_name"];//获取临时文件名
	move_uploaded_file($tmpimg, "../../images/".$_FILES["file"]["name"]);
	//提醒，保存路径在数据库的时候使用目录与文件名保存，读取文件的时候获取当前服务器链接加上文件目录与文件返回
	echo $_SERVER['HTTP_HOST']."/computer/images/".$_FILES["file"]["name"];
}
?>