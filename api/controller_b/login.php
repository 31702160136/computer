<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
$data=array(
	"username"=>@$_POST["username"],
	"password" => @$_POST["password"]
);
$selectService = new SelectService();
$result = $selectService -> getUserInfoByUserName($data);
if($result["is_status"]!=1){
	error("此用户被禁用"); 
}else if ($result["password"] == $data["password"]) {
	sessionLogin($result);
	$data = array("name" => $result["name"]);
	succeedOfInfo("登陆成功", $data);
} else {
	sessionOutLogin();
	error("密码错误"); 
}
/*
 * 登陆
 * 接口状态：完成
 * 类型：Post
 * 参数：username				账号
 * 参数：password				密码
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "登陆成功",
    "code": 200,
    "data": {
        "name": "超级管理员"
    }
}
 * 
 * */
?>