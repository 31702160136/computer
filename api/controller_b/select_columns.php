<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if(sessionIsLogin()){
	$select_service = new SelectService();
	$data=array(
		"page"=>@$_GET["page"],
		"size"=>@$_GET["size"]
	);
	$result = $select_service -> getColumns($data);
	succeedOfInfo("获取栏目列表成功", $result);
}else{
	error("用户未登录");
}
?>