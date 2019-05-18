<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.1</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
   	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script type="text/javascript" src="./js/cookie.js"></script>
    <script src="js/host.js"></script>
    <link rel="stylesheet" href="./css/font.css">
	<link rel="stylesheet" href="./css/xadmin.css">
	
	<style type="text/css">
		.formclass{
			background-image: url(images/bj.jpg);
		}
	</style>
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">计算机工程系后台管理登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form formclass" >
            <input name="username" id="username" placeholder="用户名"  type="text" class="layui-input" >
            <hr class="hr15">
            <input name="password" id="password" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" id="btn_OK">
            <hr class="hr20" >
        </form>
    </div>

    <script>
    	$("#btn_OK").click(function(){
				var username = $("#username").val();
				var password = $("#password").val();
				if(username == "" || password == ""){
					layer.msg('账号密码不能为空',{icon: 5,time:1000});
				}else{
					$.ajax({
						type:"post",
						url: host + "controller_b/login.php",
						async:true,
						data:{
							"username": username,
							"password": password
						},
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								window.location.href = "index.php?name="+res.data.name;
							}else{
								layer.msg(res.message,{icon: 5,time:2000});
							}
				      	},
					    error : function () {
					      	document.write("error");
					    }
					});
				}
			});
    </script>
    <!-- 底部结束 -->
</body>
</html>