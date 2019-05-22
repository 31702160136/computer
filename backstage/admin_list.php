<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>用户管理模块</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="./js/xadmin.js"></script>
		<script type="text/javascript" src="./js/cookie.js"></script>
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
		<script src="js/time_stamp_date.js"></script>
		<script src="js/checkbox.js"></script>
		<script src="js/paging.js"></script>
		<link rel="stylesheet" href="css/paging.css">
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
	       		<a><cite style="color: red;">此页面为计算机工程系后台用户管理页面，管理员务必慎重操作！</cite></a>
  			</span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
				<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
			</a>
		</div>
		<div class="x-body">
			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
				<button class="layui-btn" onclick="x_admin_show('注册用户','./admin_add.php',600,500)"><i class="layui-icon"></i>注册</button>
			</xblock>
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th width="18px">
							<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
						</th>
						<th style="text-align: center; width: 50px;">ID</th>
						<th style="text-align: center;">账号</th>
						<th style="text-align: center;">姓名</th>
						<th style="text-align: center;">手机</th>
						<th style="text-align: center;">邮箱</th>
						<th style="text-align: center;">角色</th>
						<th style="text-align: center;" width="165">注册时间</th>
						<th style="text-align: center;" width="60">状态</th>
						<th style="text-align: center;" width="60">操作</th>
				</thead>
				<tbody id="userList"></tbody>
			</table>
			<!--分页-->
    		<div class="box" id="box"></div>
		</div>
		<script>
			//定义全局变量	ajaxPage 页数
			var ajaxPage = 1;
			//一页的数量
			var ajaxSize = 10;
			select_user();
			
			/*	用户查询：
			 * 
			 * 		select_user()
			 * */
			function select_user(){
				$.ajax({
					type:"get",
					url: host + "controller_b/select_users.php",
					data:{
						page: ajaxPage,
						size: ajaxSize
					},
					async:true,
					datatype:'json',
					success: function(data){
						var res=JSON.parse(data);
						//获取总页数
						var total_page=res.data.total_page;
						var users = res.data.data;
						if (res.status) {
							dynamic_addition(users);
							var len = users.length;
							customPaging(total_page,len,ajaxPage);
						}else{
							layer.msg(res.message,{icon: 2,time:2000});
						}
			      	},
				    error : function () {
				      	document.write("error");
				    }
				});
			}
			
			/*
			 * 	封装自定义	customPaging 自定义页数	方法
			 * 	从	select_user();传	total_page 总页数,len 当前页数长度,ajaxPage 当前页数，
			 */
			function customPaging(total_page,len,ajaxPage){
				//分页插件使用
				$('#box').paging({
					initPageNo: 1, // 初始页码
					totalPages: total_page, //总页数
					//totalCount: '当前页数合计' + len + '条数据', // 条目总数
					slideSpeed: 600, // 缓动速度。单位毫秒
					jump: true, //是否支持跳转
					callback: function(page) { // 回调函数
						//使page当前页数等于 数据的当前页数
						ajaxPage = page;
						$.ajax({
							type:"get",
							url: host + "controller_b/select_users.php",
							data: {
								page: ajaxPage,
								size: ajaxSize
							},
							async:true,
							datatype: 'json',
							success: function(data){
								var res=JSON.parse(data);
								var total_page=res.data.total_page;
								var users=res.data.data;
								if (res.status) {
									dynamic_addition(users);
								}
							},
							error : function () {
						      	document.write("error");
						    }
						});
					}
				});
			}
			
			/* 单个管理员删除：
			 * 
			 * 		member_del（）
			 * */
			function member_del(obj, id, role) {
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
								layer.msg(res.message, {icon: 1,time: 1000});
							} else{
								layer.msg(res.message, {icon: 2,time: 2000});
							}
						},
						error:function(){
							document.write("error");
						}
					});
				});
			}
			/* 多个管理员删除：
			 * 
			 * 		delAll（）
			 * */
			function delAll(argument) {
				var arrayData = tableCheck.getData();
				if (arrayData.length == 0) {
					layer.msg("请勾选要删除的管理员", {icon: 3,time: 3000});
				}else{
					layer.confirm('确认要删除 '+arrayData.length+' 个管理员吗？', function(index) {
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
									layer.msg(res.message, {icon: 1,time: 1000});
								} else{
									layer.msg(res.message, {icon: 2,time: 2000});
								}
						    },
						    error:function(){
								document.write("error");
							}
						});
					});
				}
			}
			/* 用户编辑：
		  	 * 
			 * 		开启，停用
			 * 		改变用户状态
			 * */
	      	function status_edit(obj,id,is_status){
	      		if(is_status == 0){
		      		layer.confirm('确认要启用此用户吗？',function(index){
		                layer.msg('用户已启用!',{icon: 6,time:1000});
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
		      		layer.confirm('确认要停用此用户吗？',function(index){
		                layer.msg('用户已停用!',{icon: 5,time:1000});
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
			
			/*
			 * 	表格动态添加数据
			 */
			function dynamic_addition(users){
				var customID = 1;
				//防止每次刷新以后都添加一次
 			    $("#userList").html(""); 
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
					var list = 
						'<tr>'+
							'<td>'+
								'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
									'<i class="layui-icon">&#xe605;</i>'+
								'</div>'+
							'</td>'+
							'<td align="center">'+(customID++)+'</td>'+
							'<td align="center">'+username+'</td>'+
							'<td align="center"><i class="layui-icon x-show"></i>'+name+'</td>'+
							'<td align="center">'+phone+'</td>'+
							'<td align="center">'+email+'</td>'+
							'<td align="center">'+role+'</td>'+
							'<td align="center">'+getMyDate(creation_time)+'</td>'+
							'<td><span id="status'+id+'" class="layui-btn layui-btn-warm" onclick="status_edit(this,'+id+','+is_status+')">已停用</span></td>'+
							'<td class="td-manage">'+
								"<button class=\"layui-btn-danger layui-btn layui-btn-xs\" onclick=\"member_del(this,"+id+","+"'"+role+"'"+")\" href=\"javascript:;\"><i class=\"layui-icon\">&#xe640;</i>删除</button>"+
							'</td>'+
						'</tr>';
					$("#userList").append(list);
					if(is_status==1){
						$("#status"+id).removeClass('layui-btn-warm');
						$("#status"+id).addClass('layui-btn-normal').html('已启用');
					}
				});
 			}
			//渲染多选框事件
		   	rendering_checkbox();
		</script>
	</body>
</html>