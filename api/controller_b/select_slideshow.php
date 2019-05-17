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
	$result = $select_service -> getSlideshows($data);
	$data_slideshow_all=array(
		"page"=>0,
		"size"=>0
	);
	//获取所有新闻,转换总页数
	$result_slideshow_all = $select_service -> getSlideshows($data_slideshow_all);
	if(isset($data["size"]) && $data["size"]!=0){
		$size=$data["size"];
	}else{
		$size=10;
	}
	$page=getPage($result_slideshow_all, $size);
	//封装数据
	$res_data=array(
		"total_page"=>$page,
		"data"=>$result
	);
	succeedOfInfo("获取轮播新闻列表成功", $res_data);
} else {
	error("用户未登录");
}
/*
 * 获取轮播新闻列表信息，如果不填页数默认获取10条
 * 接口状态：完成
 * 类型：Get
 * 参数：page		//数据页数
 * 参数：size		//当前页数量
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取轮播新闻列表成功",
    "code": 200,
    "data": {
        "total_page": 1,
        "data": [
            {
                "id": "6",
                "index": "6",
                "is_status": "0",
                "news_id": "44",
                "creation_time": "1",
                "modify_time": "1558057606",
                "title": "计算机工程系简介",
                "describe": "测试",
                "slideshow_cover": "",
                "column": "系部概况"
            }
        ]
    }
}
 *  * 
 * 
 * */
?>