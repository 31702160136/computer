<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
$select_service = new SelectService();
$data=array(
	"id"=>@$_GET["id"]
);
$res_data=$select_service->getTeacherById($data);
succeedOfInfo("获取教师信息成功", $res_data);
/*
 * 通过教师id获取教师信息
 * 接口状态：完成
 * 类型：Get
 * 参数：id	//新闻id
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "获取教师信息成功",
    "code": 200,
    "data": {
        "id": "4",
        "name": "456",
        "title": "45",
        "sex": "1",
        "school": "1231",
        "content": "5646",
        "head_img": "localhost:8080/computer/images/vqumclfzbhjrnegtkxiaowsydp1558531084.png",
        "cover": "",
        "creation_time": "1558531084",
        "modify_time": "1558531084"
    }
}
 *  * 
 * 
 * */
?>