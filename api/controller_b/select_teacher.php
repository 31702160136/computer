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
	$result = $select_service -> getTeachers($data);
	$data_teacher_all=array(
		"page"=>0,
		"size"=>0
	);
	//获取所有老师,转换总页数
	$result_teacher_all = $select_service -> getTeachers($data_teacher_all);
	if(isset($data["size"]) && $data["size"]!=0){
		$size=$data["size"];
	}else{
		$size=10;
	}
	$page=getPage($result_teacher_all, $size);
	//封装数据
	$res_data=array(
		"total_page"=>$page,
		"data"=>$result
	);
	succeedOfInfo("获取老师列表成功", $res_data);
} else {
	error("用户未登录");
}
/*
 * 查询教师信息，如果不填页数默认获取10条
 * 接口状态：完成
 * 类型：Get
 * 参数：page		//数据页数
 * 参数：size		//当前页数量
 * 返回：json
 * 返回数量：多条
{
    "status": true,
    "message": "获取老师列表成功",
    "code": 200,
    "data": {
        "total_page": 5,
        "data": [
            {
                "id": "5",
                "name": "456",				教师姓名
                "title": "45",				教师称谓
                "sex": "1",					教师性别，1男，2女
                "school": "1231",			教师毕业学校
                "content": "5646",			教师经历
                "head_img": "",				教师头像
                "cover": "",				教师封面
                "creation_time": "1558531089",
                "modify_time": "1558531089"
            }
        ]
    }
}
 *  * 
 * 
 * */
?>