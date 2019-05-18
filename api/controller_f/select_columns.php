<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
if(sessionIsLogin()){
	$select_service = new SelectService();
	$data=array(
		"page"=>@$_GET["page"],
		"size"=>@$_GET["size"]
	);
	$result = $select_service -> getColumnsStatusTrue($data);
	$data_column_all=array(
		"page"=>0,
		"size"=>0
	);
	$result_column_all = $select_service ->getColumnsStatusTrue($data_column_all);
	if(isset($data["size"]) && $data["size"]!=0){
		$size=$data["size"];
	}else{
		$size=10;
	}
	$page=getPage($result_column_all, $size);
	//封装数据
	$res_data=array(
		"total_page"=>$page,
		"data"=>$result
	);
	succeedOfInfo("获取栏目列表成功", $res_data);
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
 * 返回数量：多条
{
    "status": true,
    "message": "获取栏目列表成功",
    "code": 200,
    "data": {
        "total_page": 15,
        "data": [
            {
                "id": "5",			//栏目id
                "title": "教学科研",	//栏目标题
                "index": "1",		//排序权重，可以不管，已经排序好
                "is_status": "1",	//是否启动，默认获取启动栏目
                "creation_time": "1554366223",
                "modify_time": "1557461627"
            }
        ]
    }
}
 * 
 * */
?>