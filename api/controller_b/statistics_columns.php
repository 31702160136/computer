<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
if(sessionIsLogin()){
	$select_service = new SelectService();
	$result = $select_service -> statisticsColumns($data);
	succeedOfInfo("获取栏目列表成功", $result);
}else{
	error("用户未登录");
}
/*
 * 获取栏目访问统计信息
 * 接口状态：完成
 * 类型：Get
 * 参数：page
 * 参数：size
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取栏目列表成功",
    "code": 200,
    "data": [
        {
            "id": "29",
            "title": "系部概况",
            "index": "0",
            "is_status": "1",
            "creation_time": "1557997248",
            "modify_time": "1557997248",
            "count": "10"
        }
    ]
}
 * 
 * */
?>