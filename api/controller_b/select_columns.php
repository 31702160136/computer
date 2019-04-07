<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if(sessionIsLogin()){
	$select_service = new SelectService();
	$result = $select_service -> getColumns();
	succeedOfInfo("获取栏目列表成功", $result);
}else{
	error("用户未登录");
}
?>