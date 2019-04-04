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
4.注册接口
	接口：create_admin.php
	类型:post
	参数1：name  //姓名
	参数2: username  //账号
	参数3: password      //密码
	参数4: phone      //手机(选填)
	参数5: email      //邮箱(选填)
	成功：
	{
    	"status": true,
    	"message": "注册成功",
    	"code": 200
	}
4.修改密码接口
	接口：modify_password.php
	类型:post
	参数1：oldPassword  //旧密码
	参数3: password      //新密码
	成功：
	{
    	"status": true,
    	"message": "密码修改成功",
    	"code": 200
	}
5.创建栏目接口
	接口：create_column.php
	类型:post
	参数1：title  //栏目标题
	参数3: index      //栏目排序权重,默认0,范围0-9,9最高权限(选填)
	参数3: is_start      //是否启用,默认不启用(选填)
	成功：
	{
    	"status": true,
    	"message": "创建栏目成功",
    	"code": 200
	}
6.修改栏目接口
	接口：modify_column.php
	类型:post
	参数1：title  //栏目标题
	参数3: index      //栏目排序权重,范围0-9,9最高权限(选填)
	参数3: is_start      //栏目排序权重,范围0-9,9最高权限(选填)
	成功：
	{
    	"status": true,
    	"message": "修改栏目成功",
    	"code": 200
	}
7.创建新闻接口
	