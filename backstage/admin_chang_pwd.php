<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>修改管理员密码</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="./js/xadmin.js"></script>
		<script type="text/javascript" src="./js/cookie.js"></script>
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="./css/xadmin.css">
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    	<style type="text/css">
    		.addbtn{
    			width: 70px;
    			margin-right: 35px;
    		}
    	</style>
	</head>
	<body>
		<div class="x-body">
			<form class="layui-form">
				
				<div class="layui-form-item">
					<label for="oldPassword" class="layui-form-label">原密码</label>
					<div class="layui-input-inline">
						<input type="password" id="oldPassword" name="oldPassword" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>请输入您的原密码</div>
				</div>
				
				<div class="layui-form-item">
					<label for="L_pass" class="layui-form-label">新密码</label>
					<div class="layui-input-inline">
						<input type="password" id="password1" name="pass" lay-verify="pass" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>密码为5到12个字符</div>
				</div>
				<div class="layui-form-item">
					<label for="L_repass" class="layui-form-label">确认密码</label>
					<div class="layui-input-inline">
						<input type="password" id="password2" name="repass" lay-verify="repass" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>请确定您的新密码</div>
				</div>
				
				<div class="layui-form-item">
					<label for="L_repass" class="layui-form-label"></label>
					<button class="layui-btn addbtn" lay-filter="changePwd" lay-submit="">确定</button>
					<input  class="layui-btn layui-btn-warm addbtn" type="reset" value="重  置" />
				</div>
			</form>
		</div>
		<script>
			/**	修改密码
			 * 
			 */
			layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                //自定义验证规则
                form.verify({
                    pass: [/(.+){5,12}$/, '密码必须5到12位'],
                    repass: function(value) {
                        if ($('#password1').val() != $('#password2').val()) {
                            return '新密码不一致';
                        }
                    }
           		});
                //监听提交
                form.on('submit(changePwd)',function(data) {
					var oldPassword = $("#oldPassword").val();
					var password2 = $("#password2").val();
					$.ajax({
						type:"post",
						url: host + "controller_b/modify_password.php",
						async:true,
						data:{
							"oldPassword": oldPassword,
							"password": password2
						},
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								alert(res.message);
								//关闭当前frame
								x_admin_close();
								//退出登录
								out_login();
								// 对父窗口进行刷新 
								x_admin_father_reload();
							}else{
								layer.msg(res.message,{icon: 2,time:2000});
							}
				      	},
					    error : function () {
					      	document.write("请联系维护人员");
					    }
					});
                   	return false;
                });

            });
			/**
			 * 	退出登录
			 */
			function out_login(){
				$.ajax({
					type:"get",
					url: host + "controller_b/out_login.php",
					async:true,
					success: function(data){
						var res=JSON.parse(data);
						if(res.status){
							window.location.href="login.php";
						}
					},
				 	error : function () {
				      	document.write("error");
				    }
				});		
			}
		</script>
	</body>
</html>