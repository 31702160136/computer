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
5.查询用户列表接口
	接口：select_users.php
	类型:get/post
	{
    	"status": true,
    	"message": "获取用户列表成功",
    	"code": 200,
    	"data": [
        	{
        	    "id": "1",
        	    "name": "超级管理员",
        	    "username": "admin",
        	    "password": "admin",
            	"role": "superAdmin",
            	"phone": null,
            	"email": null,
            	"creation_time": "1553779168",
            	"modify_time": "1553779168"
        	}
    	]
	}
5.根据账号的方式查询用户接口
	接口：select_user_by_username.php
	类型:get
	参数：username  //账号
	{
    	"status": true,
    	"message": "获取用户列表成功",
    	"code": 200,
    	"data": [
        	{
        	    "id": "1",
        	    "name": "超级管理员",
        	    "username": "admin",
        	    "password": "admin",
            	"role": "superAdmin",
            	"phone": null,
            	"email": null,
            	"creation_time": "1553779168",
            	"modify_time": "1553779168"
        	}
    	]
	}
5.查询栏目接口
	接口：select_columns.php
	类型:get/post
	{
    	"status": true,
    	"message": "获取栏目列表成功",
    	"code": 200,
    	"data": [
        	{
            	"id": "3",
            	"title": "好栏目",
            	"index": "0",
            	"is_start": "1",
            	"creation_time": "1554366110",
            	"modify_time": "1554368747"
        	}
    	]
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
7.查询新闻接口
	接口：select_news.php
	类型:get/post
	成功：
	{
    	"status": true,
    	"message": "获取新闻列表成功",
    	"code": 200,
    	"data": [
        	{
            	"id": "11",
            	"title": "我是新闻",
            	"describe": "撒旦",
            	"content": "阿斯蒂芬发",
            	"cover": "www.yulemofang.cn/computer/images/41eb7d00561daa28f0a0b603de18975c.jpg",
            	"slideshow_cover": "/computer/images/微信截图_20180922011410.png",
            	"type": "阿斯蒂芬",
            	"contributor": "案说法",
            	"is_hot": "0",
            	"is_top": "0",
            	"is_start": "0",
            	"column_id": "3",
            	"user_id": "1",
            	"creation_time": "1554393636",
            	"modify_time": "1554393636"
        	}
    	]
	}
7.根据栏目id查询新闻接口
	接口：select_news_by_column_id.php
	类型:get
	参数：column_id  //栏目id
	成功：
	{
    	"status": true,
    	"message": "获取新闻列表成功",
    	"code": 200,
    	"data": [
        	{
            	"id": "11",
            	"title": "我是新闻",
            	"describe": "撒旦",
            	"content": "阿斯蒂芬发",
            	"cover": "www.yulemofang.cn/computer/images/41eb7d00561daa28f0a0b603de18975c.jpg",
            	"slideshow_cover": "/computer/images/微信截图_20180922011410.png",
            	"type": "阿斯蒂芬",
            	"contributor": "案说法",
            	"is_hot": "0",
            	"is_top": "0",
            	"is_start": "0",
            	"column_id": "3",
            	"user_id": "1",
            	"creation_time": "1554393636",
            	"modify_time": "1554393636"
        	}
    	]
	}