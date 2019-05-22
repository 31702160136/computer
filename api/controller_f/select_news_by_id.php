<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
$select_service = new SelectService();
$data=array(
	"id"=>@$_GET["id"]
);
$res_data=$select_service->getNewsById($data);
succeedOfInfo("获取新闻成功", $res_data);
/*
 * 通过新闻id获取新闻信息
 * 接口状态：完成
 * 类型：Get
 * 参数：id	//新闻id
 * 返回：json
 * 返回数量：单条
{
    "status": true,
    "message": "获取新闻信息成功",
    "code": 200,
    "data": {
                "id": "49",						//新闻id
                "title": "通信技术专业教学团队情况",	//新闻标题
                "describe": "测试",				//新闻描述
 * 				//新闻内容
                "content": "<p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 24px;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: center\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;line-height: 44px;font-family: 宋体;font-size: 29px\">通信技术专业教学团队情况</span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 0;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 24px;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: center\"><span style=\"box-sizing: border-box;line-height: 24px;font-family: 宋体\">&nbsp;</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">一、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">教研室主任</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\"><span style=\"box-sizing: border-box;font-size: 19px\">周春</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">二、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"box-sizing: border-box;line-height: inherit\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">专业教师</span></span><span style=\"box-sizing: border-box;line-height: inherit\"></span></span></span></span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">周勇、谢海燕、吕晓梅、韩倩、黄焕君</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\">三<span style=\"box-sizing: border-box\"><span style=\"box-sizing: border-box;line-height: inherit\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">校外兼职教师</span></span><span style=\"box-sizing: border-box;line-height: inherit\"></span></span></span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">张创前、陈厚锋、杨驰云、杨永梅、唐炳婷、林和宗</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-size: 19px\">&nbsp;</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Times New Roman&#39;;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: right\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">计算机工程系</span></p><p><br/></p>",
                "cover": "",					//新闻封面
                "slideshow_cover": "",			//新闻轮播封面
                "type": "测试",					//新闻类型，用不上可以不管
                "contributor": "管理员",			//新闻投稿者
                "is_hot": "0",					//是否火热状态
                "is_top": "1",					//是否顶置状态
                "is_status": "1",				//是否启动状态
                "count": "0",					//新闻访问次数
                "column_id": "29",				//栏目id
                "user_id": "4",					//发布此新闻的管理员id
                "creation_time": "1558059314",
                "modify_time": "1558059314",
                "column": "系部概况"				//栏目标题
            }
}
 *  * 
 * 
 * */
?>