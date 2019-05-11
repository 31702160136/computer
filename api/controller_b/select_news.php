<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
if (sessionIsLogin()) {
	$select_service = new SelectService();
	$data=array(
		"page"=>@$_GET["page"],
		"size"=>@$_GET["size"]
	);
	$result = $select_service -> getNews($data);
	$data_news_all=array(
		"page"=>0,
		"size"=>0
	);
	//获取所有新闻,转换总页数
	$result_news_all = $select_service -> getNews($data_news_all);
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
	succeedOfInfo("获取新闻列表成功", $res_data);
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
    "data": {
        "page": 1,
        "data": [
            {
                "id": "14",
                "title": "我是新闻",
                "describe": "撒旦",
                "content": "阿斯蒂芬发",
                "cover": "localhost:8080/computer/images/back3.png",
                "slideshow_cover": "",
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
 *  * 
 * 
 * */
?>