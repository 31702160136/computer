<?php
include_once "./../handler/handler.php";
include_once "./../service/select_service.php";
include_once "./../utils/session_status.php";
include_once "./../utils/tools.php";
$select_service = new SelectService();
$data=array(
	"column_id"=>@$_GET["column_id"],
	"page"=>@$_GET["page"],
	"size"=>@$_GET["size"]
);
$result = $select_service ->getNewsByColumnIdStatusTrue($data);
$data_news_all=array(
	"column_id"=>@$_GET["column_id"],
	"page"=>0,
	"size"=>0
);
$result_hot = $select_service ->getNewsStatusTrueOfHotByColumnId($data_news_all);
$result_news_all = $select_service ->getNewsByColumnIdStatusTrue($data_news_all);
if(isset($data["size"]) && $data["size"]!=0){
	$size=$data["size"];
}else{
	$size=10;
}
$page=getPage($result_news_all, $size);
$data_arr=array(
	"news"=>$result,
	"hot_news"=>$result_hot
);
//封装数据
$res_data=array(
	"total_page"=>$page,
	"data"=>$data_arr
);
succeedOfInfo("获取新闻信息成功", $res_data);
/*
 * 通过栏目id获取新闻列表信息
 * 接口状态：完成
 * 类型：Get
 * 参数：column_id		//栏目id
 * 参数：page				//页数(选填)
 * 参数：size				//每页获取的数量(选填)
 * 返回：json
 * 返回数量：多条			//默认10条
{
    "status": true,
    "message": "获取新闻信息成功",
    "code": 200,
    "data": {
        "total_page": 1,
        "data": {
            "news": [
                {
                    "id": "169",
                    "title": "软件技术专业教学团队情况",
                    "describe": "测试",
                    "content": "<p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 24px;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: center\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;line-height: 44px;font-family: 宋体;font-size: 29px\">软件技术专业教学团队情况</span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 0;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 24px;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: center\"><span style=\"box-sizing: border-box;line-height: 24px;font-family: 宋体\">&nbsp;</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">一、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">教研室主任</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">沈大旺</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">二、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">专业教师</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\"><span style=\"box-sizing: border-box;font-size: 19px\">张劲勇、陈凡健、付玉珍、张丽妹、陈永芳、梁燕、何林</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box;line-height: inherit\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">三、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">校外兼职教师</span></span><span style=\"box-sizing: border-box;line-height: inherit\"></span></span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">黄可飞、蔡荣生、黄明权、张创前、陈兆强、罗增毅、林海、肖科、吴剑锋、蒋雷、李勇、叶身旺、曹燕飞、陈黄清</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-size: 19px\">&nbsp;</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: right\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">计算机工程系</span></p><p><br/></p>",
                    "cover": "",
                    "slideshow_cover": "",
                    "type": "测试",
                    "contributor": "管理员",
                    "is_hot": "1",
                    "is_top": "0",
                    "is_status": "1",
                    "count": "0",
                    "column_id": "29",
                    "user_id": "15",
                    "creation_time": "1558499345",
                    "modify_time": "1558499345",
                    "column": "系部概况"
                }
            ],
            "hot_news": [
                {
                    "id": "169",
                    "title": "软件技术专业教学团队情况",
                    "describe": "测试",
                    "content": "<p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 24px;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: center\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;line-height: 44px;font-family: 宋体;font-size: 29px\">软件技术专业教学团队情况</span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 0;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 24px;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: center\"><span style=\"box-sizing: border-box;line-height: 24px;font-family: 宋体\">&nbsp;</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">一、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">教研室主任</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">沈大旺</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">二、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">专业教师</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\"><span style=\"box-sizing: border-box;font-size: 19px\">张劲勇、陈凡健、付玉珍、张丽妹、陈永芳、梁燕、何林</span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;line-height: inherit;color: rgb(227, 61, 102)\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box;line-height: inherit\"><span style=\"box-sizing: border-box;font-size: 19px\"><span style=\"box-sizing: border-box\">三、<span style=\"box-sizing: border-box;font-variant-numeric: normal;font-variant-east-asian: normal;font-size: 9px;line-height: normal;font-family: &#39;Times New Roman&#39;;font-stretch: normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span><span style=\"box-sizing: border-box;line-height: inherit\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">校外兼职教师</span></span><span style=\"box-sizing: border-box;line-height: inherit\"></span></span></span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">黄可飞、蔡荣生、黄明权、张创前、陈兆强、罗增毅、林海、肖科、吴剑锋、蒋雷、李勇、叶身旺、曹燕飞、陈黄清</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255)\"><span style=\"box-sizing: border-box;font-size: 19px\">&nbsp;</span></p><p style=\"box-sizing: border-box;margin-top: 0px;margin-bottom: 1.25rem;margin-left: 59px;padding: 0px;font-family: &#39;Helvetica Neue&#39;, Helvetica, Roboto, Arial, sans-serif;font-size: 1rem;line-height: 1.6;text-rendering: optimizelegibility;color: rgb(51, 51, 51);text-indent: 28px;white-space: normal;background-color: rgb(255, 255, 255);text-align: right\"><span style=\"box-sizing: border-box;font-family: 宋体;font-size: 19px\">计算机工程系</span></p><p><br/></p>",
                    "cover": "",
                    "slideshow_cover": "",
                    "type": "测试",
                    "contributor": "管理员",
                    "is_hot": "1",
                    "is_top": "0",
                    "is_status": "1",
                    "count": "0",
                    "column_id": "29",
                    "user_id": "15",
                    "creation_time": "1558499345",
                    "modify_time": "1558499345",
                    "column": "系部概况"
                }
            ]
        }
    }
}
 * 
 * */
?>