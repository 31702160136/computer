<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$data=array(
		"column_id"=>@$_GET["column_id"],
		"page"=>@$_GET["page"],
		"size"=>@$_GET["size"]
	);
	$result = $select_service ->getNewsByColumnId($data);
	$data_news_all=array(
		"column_id"=>@$_GET["column_id"],
		"page"=>0,
		"size"=>0
	);
	$result_news_all = $select_service ->getNewsByColumnId($data_news_all);
	if(isset($data["size"]) && $data["size"]!=0){
		$size=$data["size"];
	}else{
		$size=10;
	}
	$page=getPage($result_news_all, $size);
	//封装数据
	$res_data=array(
		"total_page"=>$page,
		"data"=>$result
	);
	succeedOfInfo("获取新闻信息成功", $res_data);
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
    "data": {
        "total_page": 2,
        "data": [
            {
                "id": "23",
                "title": "555",
                "describe": "2",
                "content": "1",
                "cover": "localhost:8080",
                "slideshow_cover": "localhost:8080",
                "type": "驱蚊器",
                "contributor": "杨鸿燊",
                "is_hot": "0",
                "is_top": "0",
                "is_status": "0",
                "column_id": "5",
                "user_id": "4",
                "creation_time": "1557464235",
                "modify_time": "1557464235",
                "column": "2"
            }
        ]
    }
}
 * 
 * */
?>