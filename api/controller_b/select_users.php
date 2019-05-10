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
/*
 * 获取用户信息，如果不填页数默认获取10条
 * 接口状态：完成
 * 类型：Get
 * 参数：page		//数据页数
 * 参数：size		//当前页数量
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取用户列表成功",
    "code": 200,
    "data": [
        {
            "id": "1",
            "name": "超级管理员",
            "username": "admin",
            "password": "admin",
            "role": "超级管理员",
            "phone": null,
            "email": null,
            "is_status": "1",
            "creation_time": "1553779168",
            "modify_time": "1553779168"
        }
    ]
}
 * 
 * */
?>