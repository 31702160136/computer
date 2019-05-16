<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>管理用户界面</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
		<script type="text/javascript" src="./js/xadmin.js"></script>
		<script type="text/javascript" src="./js/cookie.js"></script>
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="./css/xadmin.css">
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>

	<body>
		<div class="x-nav">
			<span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>管理员</cite></a>
      </span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
				<i class="layui-icon" style="line-height:30px">ဂ</i></a>
		</div>
		<div class="x-body">
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so">
					<input class="layui-input" placeholder="开始日" name="start" id="start">
					<input class="layui-input" placeholder="截止日" name="end" id="end">
					<input type="text" name="username" placeholder="请输入用户名" autocomplete="off" class="layui-input">
					<button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
				</form>
			</div>

			<blockquote class="layui-elem-quote" style="color: red;">此页面为后台管理员管理页面，请务必慎重操作！</blockquote>

			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
				<button class="layui-btn" onclick="x_admin_show('添加用户','./admin_add.php',600,500)"><i class="layui-icon"></i>添加</button>
				<span class="x-right" style="line-height:40px">共有数据：88 条</span>
			</xblock>
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th>
							<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
						</th>
						<th>ID</th>
						<th>账号</th>
						<th>姓名</th>
						<th>手机</th>
						<th>邮箱</th>
						<th>角色</th>
						<th>加入时间</th>
						<th>更新时间</th>
						<th width="60">状态</th>
						<th width="60">操作</th>
				</thead>

				<tbody id="userList">
					<!--<tr>
						<td>
							<div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
						</td>
						<td>1</td>
						<td>superadmin</td>
						<td>18925139194</td>
						<td>113664000@qq.com</td>
						<td>超级管理员</td>
						<td>2017-01-01 11:11:42</td>
						<td class="td-status"><span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
						<td class="td-manage">
							<a onclick="member_stop(this,'10001')" href="javascript:;" title="启用">
								<i class="layui-icon">&#xe601;</i>
							</a>
							<a title="编辑" onclick="x_admin_show('编辑','admin-edit.html')" href="javascript:;">
								<i class="layui-icon">&#xe642;</i>
							</a>
							<a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
								<i class="layui-icon">&#xe640;</i>
							</a>
						</td>
					</tr>-->

				</tbody>
			</table>
			<div class="page">
				<div>
					<a class="prev" href="">&lt;&lt;</a>
					<a class="num" href="">1</a>
					<span class="current">2</span>
					<a class="num" href="">3</a>
					<a class="num" href="">489</a>
					<a class="next" href="">&gt;&gt;</a>
				</div>
			</div>

		</div>
		<script>
			select_user();
			
			/* 单个管理员删除：
			 * 
			 * 		member_del（）
			 * */
			function member_del(obj, id, role) {
				if (role = "普通管理员") {
					layer.confirm('确认要删除吗？', function(index) {
						$.ajax({
							type:"post",
							url: host + "controller_b/delete_users.php",
							async:true,
							data:{
								"ids[]": id
							},
							success: function(data){
								var res = JSON.parse(data);
								if (res.status) {
									select_user();
									layer.msg('已删除!', {
										icon: 1,
										time: 1000
									});
								} else{
									layer.msg('删除失败!', {
										icon: 2,
										time: 2000
									});
								}
							},
							error:function(){
								document.write("error");
							}
						});
					});
				} else{
					layer.msg('您无法删除超级管理员!', {
						icon: 1,
						time: 1000
					});
				}
				
			}
			/* 多个管理员删除：
			 * 
			 * 		delAll（）
			 * */
			function delAll(argument) {
				var arrayData = tableCheck.getData();
				layer.confirm('确认要删除ID为 '+arrayData+' 的管理员吗？', function(index) {
					$.ajax({
						type:"post",
						url:host+"controller_b/delete_users.php",
					  	data:{
					  		"ids":arrayData
					  	},
					  	success:function(data){
					        	var res=JSON.parse(data);
					        	if (res.status) {
									select_user();
									layer.msg('已删除!', {
										icon: 1,
										time: 1000
									});
								} else{
									layer.msg('请选择要删除的管理员', {
										icon: 2,
										time: 2000
									});
								}
					    },
					    error:function(){
							document.write("error");
						}
					});
				});
			}
			
			/* 用户编辑：
		  	 * 
			 * 		开启，停用
			 * 		改变用户状态
			 * */
	      	function member_stop(obj,id,is_status){
	      		if(is_status == 0){
		      		layer.confirm('确认要启用吗？',function(index){
		                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-warm');
		                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-normal').html('已启用');
		                layer.msg('已启用!',{icon: 6,time:1000});
		                $.ajax({
							type:"post",
							url: host + "controller_b/modify_user_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	select_user();
								}else{
									alert("状态修改失败");
								}
					      	},
						    error : function () {
						      	document.write("error");
						    }
						});
		         	});
		      	}else{
		      		layer.confirm('确认要停用吗？',function(index){
		      			$(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-normal');
		                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-warm').html('已停用');
		                layer.msg('已停用!',{icon: 5,time:1000});
			             $.ajax({
							type:"post",
							url: host + "controller_b/modify_user_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	select_user();
								}else{
									alert("状态修改失败");
								}
					      	},
						    error : function () {
						      	document.write("error");
						    }
						});
			        });
		     	}
	      	}
			
			
			/*	用户查询：
			 * 
			 * 		select_user()
			 * */
			function select_user(){
				$.ajax({
					type:"get",
					url: host + "controller_b/select_users.php",
					async:true,
					datatype:'json',
					success: function(data){
						var res=JSON.parse(data);
						//获取总页数
						var total_page=res.data.total_page;
						var users = res.data.data;
						if (res.status) {
							//绑定tbody列表ID
							var userList = document.getElementById('userList');
							//获取columnList的tr属性长度
							var len = $("#userList").find("tr").length;
							//如果len长度大于0，删除所有行数
							if(len >0){
								$("#userList").find('tr').remove();
							}
							$.each(users, function(index,item) {
								var id = item.id;
								var name = item.name;
								var username = item.username;
								var password = item.password;
								var role = item.role;
								var phone = item.phone;
								var email = item.email;
								var is_status = item.is_status;
								var creation_time = item.creation_time;
								var modify_time = item.modify_time;
								if (is_status == 0) {
									$("#userList").append(
										"<tr cate-id='1' fid='0'>\
											<td><div id='icheckbox' class='layui-unselect layui-form-checkbox' lay-skin='primary' data-id="+id+"><i class='layui-icon'>&#xe605;</i></div></td>\
											<td>"+id+"</td>\
											<td>"+username+"</td>\
											<td><i class='layui-icon x-show' status='true'></i>"+name+"</td>\
											<td>"+phone+"</td>\
											<td>"+email+"</td>\
											<td>"+role+"</td>\
											<td>"+getMyDate(creation_time)+"</td>\
											<td>"+getMyDate(modify_time)+"</td>\
											<td class=\"td-status\"><span class='layui-btn layui-btn-warm' onclick=\"member_stop(this,"+id+","+is_status+")\">已停用</span></td>\
											<td class='td-manage'>\
											<button class=\"layui-btn-danger layui-btn layui-btn-xs\" onclick=\"member_del(this,"+id+","+"'"+role+"'"+")\" href=\"javascript:;\"><i class=\"layui-icon\">&#xe640;</i>删除</button>\
										</td></tr>"
									);
								} else{
									$("#userList").append(
										"<tr cate-id='1' fid='0'>\
											<td><div id='icheckbox' class='layui-unselect layui-form-checkbox' lay-skin='primary' data-id="+id+"><i class='layui-icon'>&#xe605;</i></div></td>\
											<td>"+id+"</td>\
											<td>"+username+"</td>\
											<td><i class='layui-icon x-show' status='true'></i>"+name+"</td>\
											<td>"+phone+"</td>\
											<td>"+email+"</td>\
											<td>"+role+"</td>\
											<td>"+getMyDate(creation_time)+"</td>\
											<td>"+getMyDate(modify_time)+"</td>\
											<td class=\"td-status\"><span class='layui-btn layui-btn-normal' onclick=\"member_stop(this,"+id+","+is_status+")\">已启用</span></td>\
											<td class='td-manage'>\
											<button class=\"layui-btn-danger layui-btn layui-btn-xs\" onclick=\"member_del(this,"+id+","+"'"+role+"'"+")\" href=\"javascript:;\"><i class=\"layui-icon\">&#xe640;</i>删除</button>\
										</td></tr>"
									);
								}
							});
						}else{
							alert("栏目获取失败");
						}
			      	},
				    error : function () {
				      	document.write("error");
				    }
				});
			}
			
			/*	时间戳转日期
			 * 
			 **/
			function getMyDate(str){
				//时间戳为十位数，*1000转换为13位
	            var oDate = new Date(str*1000),  
	            oYear = oDate.getFullYear(),  
	            oMonth = oDate.getMonth()+1,  
	            oDay = oDate.getDate(),  
	            oHour = oDate.getHours(),  
	            oMin = oDate.getMinutes(),  
	            oSen = oDate.getSeconds(),  
	            oTime = oYear +'-'+ getzf(oMonth) +'-'+ getzf(oDay) +' '+ getzf(oHour) +':'+ getzf(oMin) +':'+getzf(oSen);//最后拼接时间  
	            return oTime;  
	        }; 
	        //补0操作
	      	function getzf(num){  
		        if(parseInt(num) < 10){
		            num = '0'+num;  
		        }  
		    	return num;  
	     	}
			
			//渲染多选框事件
			$(document).on('click', '#icheckbox',function() {
				if($(this).hasClass('layui-form-checked')) {
					$(this).removeClass('layui-form-checked');
					if($(this).hasClass('header')) {
						$(".x-admin .layui-form-checkbox").removeClass('layui-form-checked');
					}
				} else {
					$(this).addClass('layui-form-checked');
					if($(this).hasClass('header')) {
						$(".x-admin .layui-form-checkbox").addClass('layui-form-checked');
					}
				}
			});
		</script>

	</body>

</html>