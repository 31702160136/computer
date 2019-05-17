<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$data=array(
		"username"=>@$_GET["username"]
	);
	$result = $select_service ->getUserInfoByUserName($data);
	$data=array(
		"id"=>$result["id"],
		"name"=>$result["name"],
		"username"=>$result["username"],
		"role"=>$result["role"],
		"phone"=>$result["phone"],
		"email"=>$result["email"],
		"creation_time"=>$result["creation_time"]
	);
	//封装数据
	$res_data=array(
		"total_page"=>1,
		"data"=>$data
	);
	succeedOfInfo("获取用户信息成功", $res_data);
} else {
	error("用户未登录");
}
/*
 * 获取通过账号用户信息
 * 接口状态：完成
 * 类型：Get
 * 参数：username		//账号
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "获取用户信息成功",
    "code": 200,
    "data": {
        "total_page": 1,
        "data": {
            "id": "4",
            "name": "小4",
            "username": "1233",
            "role": "admin",
            "phone": null,
            "email": null,
            "creation_time": "1553779527"
        }
    }
}
 * 
 * */
?>