<?php
include_once "./../handler/handler.php";
include_once "./../service/create_service.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$create_service = new CreateService();
	$data = array(
		"name" => @$_POST["name"],
		"username" => @$_POST["username"],
		"password" => @$_POST["password"],
		"role" => @$_POST["role"],
		"phone"=>isset($_POST["phone"]) ? $_POST["phone"]:null,
		"email"=>isset($_POST["email"]) ? $_POST["email"]:null,
		"is_status"=>isset($_POST["is_status"]) ? $_POST["is_status"]:null,
	);
	$result = $create_service -> createAdmin($data);
	if ($result) {
		succeed("注册成功");
	} else {
		error("注册失败");
	}
}else{
	error("用户未登录");
}
/*
 * 创建栏目
 * 接口状态：完成
 * 类型：Post
 * 参数：name					姓名
 * 参数：username				账号
 * 参数：password				密码
 * 参数：phone				手机号码
 * 参数：email				电子邮箱
 * 参数：is_status			状态(选填)
 * 参数：role					角色(选填)
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "注册成功",
    "code": 200
}
 * 
 * */
?>