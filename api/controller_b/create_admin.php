<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$create_service = new CreateService();
	$select_service=new SelectService();
	//查询当前用户的角色
	$result=$select_service->getUserInfoByUserName(getSessionUserName());
	//只有超级管理员才能注册普通管理员
	if($result["role"]=="superAdmin"){
		$data = array(
		"name" => @$_POST["name"],
		"username" => @$_POST["username"],
		"password" => @$_POST["password"],
		"phone"=>isset($_POST["phone"]) ? $_POST["phone"]:null,
		"email"=>isset($_POST["email"]) ? $_POST["email"]:null
		);
		$result = $create_service -> createAdmin($data);
		if ($result) {
			succeed("注册成功");
		} else {
			error("注册失败");
		}
	}else{
		error("普通管理员无此权限");
	}
}else{
	error("用户未登录");
}
?>