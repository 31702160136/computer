1.登陆接口:
	接口：login.php
	类型:post
	参数1：username  //账号
	参数2: password  //密码
	成功：
	{
    	"status": true,
    	"message": "登陆成功",
    	"code": 200,
    	"data":[
    		{
    			"name":"小1"
    		}
    	]
	}
	失败:
	{
    	"status": false,
    	"message": "登陆失败",
    	"code": 403
	}
2.退出登陆接口:
	接口：out_login.php
	类型post/get
	参数：无
	成功：
	{
    	"status": true,
    	"message": "注销成功",
    	"code": 200
	}
3.是否登陆接口
	接口: is_login.php
	类型post/get
	参数：无
	成功：
	{
    	"status": true,
    	"message": "用户已登录",
    	"code": 200
	}
	失败:
	{
    "status": false,
    "message": "用户未登录",
    "code": 403
	}