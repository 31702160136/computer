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
/*
 * 获取栏目列表信息
 * 接口状态：完成
 * 类型：Get
 * 参数：page
 * 参数：size
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "获取栏目列表成功",
    "code": 200,
    "data": [
        {
            "id": "5",
            "title": "sadaaaa",
            "index": "12",
            "is_status": "1",
            "creation_time": "1554366223",
            "modify_time": "1555424211"
        }
    ]
}
 * 
 * */
?>