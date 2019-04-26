<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$data=array(
		"page"=>@$_GET["page"],
		"size"=>@$_GET["size"]
	);
	$result = $select_service -> getUsers($data);
	for($i=0;$i<count($result);$i++){
		if($result[$i]["role"]=="superAdmin"){
			$result[$i]["role"]="超级管理员";
		}else if($result[$i]["role"]=="admin"){
			$result[$i]["role"]="普通管理员";
		}
	}
	succeedOfInfo("获取用户列表成功", $result);
} else {
	error("用户未登录");
}
?>