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
	$result = $select_service -> getUsers($data);
	for($i=0;$i<count($result);$i++){
		if($result[$i]["role"]=="superAdmin"){
			$result[$i]["role"]="超级管理员";
		}else if($result[$i]["role"]=="admin"){
			$result[$i]["role"]="普通管理员";
		}
	}
	$data_user_all=array(
		"page"=>0,
		"size"=>0
	);
	$result_user_all = $select_service ->getUsers($data_user_all);
	if(isset($data["size"]) && $data["size"]!=0){
		$size=$data["size"];
	}else{
		$size=10;
	}
	$page=getPage($result_user_all, $size);
	$res_data=array(
		"total_page"=>$page,
		"data"=>$result
	);
	succeedOfInfo("获取用户列表成功", $res_data);
} else {
	error("用户未登录");
}
/*
 * 获取用户信息，如果不填页数默认获取10条
 * 接口状态：完成
 * 类型：Get
 * 参数：page		//数据页数
 * 参数：size		//当前页数量
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取用户列表成功",
    "code": 200,
    "data": {
        "total_page": 6,
        "data": [
            {
                "id": "4",
                "name": "小4",
                "username": "1233",
                "password": "123",
                "role": "普通管理员",
                "phone": null,
                "email": null,
                "is_status": "1",
                "creation_time": "1553779527",
                "modify_time": "1557389103"
            }
        ]
    }
}
 * 
 * */
?>