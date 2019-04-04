<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../utils/session_status.php";
if(sessionIsLogin()){
	$create_service = new CreateService();
	$data=array(
		"title"=>@$_POST["title"],
		"is_start"=>isset($_POST["is_start"]) ? $_POST["is_start"]:null,
		"index"=>isset($_POST["index"]) ? $_POST["index"]:null
	);
	$result=$create_service->createColumn($data);
	if($result){
		succeed("创建栏目成功");
	}else{
		error("创建栏目失败");
	}
}else{
	error("用户未登录");
}

?>