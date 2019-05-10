<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$data=array(
		"column_id"=>@$_GET["column_id"],
		"page"=>@$_GET["page"],
		"size"=>@$_GET["size"]
	);
	$result = $select_service ->getNewsByColumnId($data);
	succeedOfInfo("获取新闻信息成功", $result);
} else {
	error("用户未登录");
}
/*
 * 通过栏目id获取新闻列表信息
 * 接口状态：完成
 * 类型：Get
 * 参数：column_id
 * 参数：page
 * 参数：size
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取新闻信息成功",
    "code": 200,
    "data": [
        {
            "id": "14",
            "title": "我是新闻",
            "describe": "撒旦",
            "content": "阿斯蒂芬发",
            "cover": "localhost:8080/computer/images/back3.png",
            "slideshow_cover": "localhost:8080",
            "type": "阿斯蒂芬",
            "contributor": "案说法",
            "is_hot": "0",
            "is_top": "0",
            "is_status": "0",
            "column_id": "5",
            "user_id": "1",
            "creation_time": "1554393797",
            "modify_time": "1554393797",
            "column": "2"
        }
    ]
}
 * 
 * */
?>