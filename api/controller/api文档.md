1.登陆接口:
	接口链接访问方法：www.xxx.com?function=login
	项目内部访问方法：
	$con=new UserController(); 
	$con->out_login();
	类型:post
	参数1：username  //账号
	参数2: password  //密码
	成功：
	{
    	"name": "小1",
    	"status": true,
    	"message": "登陆成功",
    	"code": 200
	}
	失败:
	{
    	"status": false,
    	"message": "登陆失败",
    	"code": 403
	}
2.退出登陆接口:
	接口链接访问方法：
	www.xxx.com?function=out_login
	项目内部访问方法：
	$con=new UserController();
	$con->out_login();
	类型post/get
	参数：无
	成功：
	{
    	"status": true,
    	"message": "注销成功",
    	"code": 200
	}
3.是否登陆接口
	www.xxx.com?function=is_login
	项目内部访问方法：
	$con=new UserController();
	$con->is_login();
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