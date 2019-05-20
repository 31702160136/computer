<!DOCTYPE html>
<html class="x-admin-sm">

	<head>
		<meta charset="UTF-8">
		<title>用户管理==>添加用户页面</title>
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
					<label for="name" class="layui-form-label">姓名</label>
					<div class="layui-input-inline">
						<input type="text" id="name" name="name" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>将会成为您在本系统的显示名称</div>
				</div>
				
				<div class="layui-form-item">
					<label for="username" class="layui-form-label">账号</label>
					<div class="layui-input-inline">
						<input type="text" id="username" name="username" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>将会成为您唯一的登录账号</div>
				</div>
				
				<div class="layui-form-item">
					<label for="L_pass" class="layui-form-label">密码</label>
					<div class="layui-input-inline">
						<input type="password" id="password1" name="pass" lay-verify="pass" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>5到12个字符</div>
				</div>
				<div class="layui-form-item">
					<label for="L_repass" class="layui-form-label">确认密码</label>
					<div class="layui-input-inline">
						<input type="password" id="password2" name="repass" lay-verify="repass" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span></div>
				</div>
				
				<div class="layui-form-item">
					<label for="phone" class="layui-form-label">手机</label>
					<div class="layui-input-inline">
						<input type="text" id="phone" name="phone" lay-verify="phone" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span>请输入十一位的手机号码</div>
				</div>
				
				<div class="layui-form-item">
					<label for="L_email" class="layui-form-label">邮箱</label>
					<div class="layui-input-inline">
						<input type="text" id="email" name="email" lay-verify="email" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux"><span class="x-red">*</span></div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">角色</label>
					<div class="layui-input-block">
						<input type="radio" id="superAdmin" name="role" lay-skin="primary" title="超级管理员" value="superAdmin">
						<input type="radio" id="admin" name="role" lay-skin="primary" title="普通管理员" checked="checked" value="admin">
					</div>
				</div>
				
				
				<div class="layui-form-item">
					<label for="L_repass" class="layui-form-label"></label>
					<button class="layui-btn addbtn" lay-filter="add" lay-submit="">注 册</button>
					<input  class="layui-btn layui-btn-warm addbtn" type="reset" value="重  置" />
				</div>
			</form>
		</div>
		<script>
			/**	注册管理员
			 * 
			 */
			layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;
                //自定义验证规则
                form.verify({
                    name: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){5,12}$/, '密码必须5到12位'],
                    repass: function(value) {
                        if ($('#password1').val() != $('#password2').val()) {
                            return '两次密码不一致';
                        }
                    }
           		});
                //监听提交
                form.on('submit(add)',function(data) {
                	var name = $("#name").val();
					var username = $("#username").val();
					var password1 = $("#password1").val();
					var password2 = $("#password2").val();
					var phone = $("#phone").val();
					var email = $("#email").val();
					var role = $("[name='role']").filter(":checked").attr("value"); 
					$.ajax({
						type:"post",
						url: host + "controller_b/create_admin.php",
						async:true,
						data:{
							"name": name,
							"username": username,
							"password": password1,
							"phone": phone,
							"email": email,
							"role": role
						},
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								layer.alert(res.message, {icon: 1}, 
								function() {
									// 获得frame索引
									var index = parent.layer.getFrameIndex(window.name);
									//关闭当前frame
									parent.layer.close(index);
									// 可以对父窗口进行刷新 
									x_admin_father_reload();
								});
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
		</script>
	</body>
