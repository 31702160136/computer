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
	$result = $select_service -> getRecycleBins($data);
	$data_recycle_all=array(
		"page"=>0,
		"size"=>0
	);
	//获取所有回收新闻,转换总页数
	$result_recycle_all = $select_service -> getRecycleBins($data_recycle_all);
	if(isset($data["size"]) && $data["size"]!=0){
		$size=$data["size"];
	}else{
		$size=10;
	}
	$page=getPage($result_recycle_all, $size);
	//封装数据
	$res_data=array(
		"total_page"=>$page,
		"data"=>$result
	);
	succeedOfInfo("获取回收站列表成功", $res_data);
} else {
	error("用户未登录");
}
/*
 * 获取回收站新闻列表信息，如果不填页数默认获取10条
 * 接口状态：完成
 * 类型：Get
 * 参数：page		//数据页数
 * 参数：size		//当前页数量
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取回收站列表成功",
    "code": 200,
    "data": {
        "total_page": 3,
        "data": [
            {
                "id": "24",
                "title": "1224",
                "describe": "asd",
                "content": null,
                "cover": "localhost:8080/computer/images/psycidxhamvjuweoqfbzgrltnk1557642959.png",
                "slideshow_cover": "",
                "type": "1",
                "contributor": "ss",
                "is_hot": "0",
                "is_top": "0",
                "is_status": "0",
                "column_id": "5",
                "user_id": "4",
                "creation_time": "1557642959",
                "modify_time": "1557642959",
                "recycle_time": "1557651810"
            }
        ]
    }
}
 *  * 
 * 
 * */
?>