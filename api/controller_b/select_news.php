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
	$result = $select_service -> getNews($data);
	succeedOfInfo("获取新闻列表成功", $result);
} else {
	error("用户未登录");
}
/*
 * 获取新闻列表信息，如果不填页数默认获取10条
 * 接口状态：完成
 * 类型：Get
 * 参数：page		//数据页数
 * 参数：size		//当前页数量
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取新闻列表成功",
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