<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
$select_service = new SelectService();
$data=array(
	"page"=>1,
	"size"=>10
);
$res_column = $select_service -> getColumnsStatusTrue($data);
$data["column_title"]="招生就业";
$res_zhaosheng=$select_service->getNewsStatusTrueByColumnTitle($data);
$data["column_title"]="新闻动态";
$res_xibu=$select_service->getNewsStatusTrueByColumnTitle($data);
$data["column_title"]="技能竞赛";
$res_jineng=$select_service->getNewsStatusTrueByColumnTitle($data);
$data["column_title"]="公告通知";
$res_tongzhi=$select_service->getNewsStatusTrueByColumnTitle($data);
//轮播新闻
$res_slideshow=$select_service->getSlideshowsStatusTrue($data);
//图片新闻
$res_cover=$select_service->getNewsStatusTrueOfCover($data);

$column_news=array(
	"zhaosheng"=>$res_zhaosheng,
	"xibu"=>$res_xibu,
	"jineng"=>$res_jineng,
	"tongzhi"=>$res_tongzhi
);

$res_data=array(
	"column"=>$res_column,
	"column_news"=>$column_news,
	"slideshow"=>$res_slideshow,
	"cover"=>$res_cover
);

succeedOfInfo("获取新闻列表成功", $res_data);
/*
 * 获取首页信息
 * 接口状态：完成
 * 类型：Get
 * 参数：title	//通过新闻标题搜索新闻（选填）
 * 参数：column_title		//通过栏目标题搜索新闻（选填）
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