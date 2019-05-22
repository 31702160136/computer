<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>教师风采</title>
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
	<style type="text/css">
		.floatRight{
			float: right;
		}
		.floatLeft{
			float: left;
		}
	</style>
	
	<body>
		<div class="x-nav">
			<span class="layui-breadcrumb">
				<a><cite style="color: red;">此页面为计算机工程系教师风采管理页面，管理员务必慎重操作！</cite></a>
			</span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
				<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
			</a>
		</div>
		<div class="x-body">
			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
				<button class="layui-btn" onclick="x_admin_show('添加教师','teacher_add.php',650,630)"><i class="layui-icon"></i>添加</button>
			</xblock>
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th width="20px">
							<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
						</th>
						<th width="100px" style="text-align: center;">照片</th>
						<th width="80px" style="text-align: center;">姓名</th>
						<th width="50px" style="text-align: center;">性别</th>
						<th width="120px" style="text-align: center;">职称</th>
						<th width="180px" style="text-align: center;">毕业院校</th>
						<th>简介</th>
						<th width="60px" style="text-align: center;">操作</th>
					</tr>
				</thead>
				<tbody id="teacherList">
					
					<tr>
						<td>
							<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">
								<i class="layui-icon">&#xe605;</i>
							</div>
						</td>
						<td align="center"><img src="images/no_photo.jpg" /></td>
						<td align="center">陈新彬</td>
						<td align="center">男</td>
						<td align="center">教授</td>
						<td align="center">茂名职业技术学院</td>
						<td align="center">简介。。。</td>
						<td class="td-manage">
							<button class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe640;</i>删除</button>
						</td>
					</tr>
					
					<tr>
						<td>
							<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">
								<i class="layui-icon">&#xe605;</i>
							</div>
						</td>
						<td align="center"><img src="images/no_photo.jpg" /></td>
						<td align="center">陈新彬</td>
						<td align="center">男</td>
						<td align="center">教授</td>
						<td align="center">茂名职业技术学院</td>
						<td align="center">简介。。。</td>
						<td class="td-manage">
							<button class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe640;</i>删除</button>
						</td>
					</tr>
					<tr>
						<td>
							<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">
								<i class="layui-icon">&#xe605;</i>
							</div>
						</td>
						<td align="center"><img src="images/no_photo.jpg" /></td>
						<td align="center">陈新彬</td>
						<td align="center">男</td>
						<td align="center">教授</td>
						<td align="center">茂名职业技术学院</td>
						<td align="center">简介。。。</td>
						<td class="td-manage">
							<button class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe640;</i>删除</button>
						</td>
					</tr>
					<tr>
						<td>
							<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">
								<i class="layui-icon">&#xe605;</i>
							</div>
						</td>
						<td align="center"><img src="images/no_photo.jpg" /></td>
						<td align="center">陈新彬</td>
						<td align="center">男</td>
						<td align="center">教授</td>
						<td align="center">茂名职业技术学院</td>
						<td align="center">简介。。。</td>
						<td class="td-manage">
							<button class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe640;</i>删除</button>
						</td>
					</tr>
					<tr>
						<td>
							<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">
								<i class="layui-icon">&#xe605;</i>
							</div>
						</td>
						<td align="center"><img src="images/no_photo.jpg" /></td>
						<td align="center">陈新彬</td>
						<td align="center">男</td>
						<td align="center">教授</td>
						<td align="center">茂名职业技术学院</td>
						<td align="center">简介。。。</td>
						<td class="td-manage">
							<button class="layui-btn layui-btn-danger"><i class="layui-icon">&#xe640;</i>删除</button>
						</td>
					</tr>
				</tbody>
			</table>
			<!--分页-->
    		<div class="box" id="box"></div>
		</div>
		<script>
			//定义全局变量	ajaxPage 页数
			var ajaxPage = 1;
			//一页的数量
			var ajaxSize = 5;
			//调用查询栏目刷新页面
			customPaging();
			/*
			 * 	封装自定义	customPaging 自定义页数	方法
			 * 	从	select_column();传	total_page 总页数,len 当前页数长度,ajaxPage 当前页数，
			 */
			function customPaging(total_page,ajaxPage){
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
							url: host + "controller_b/select_teacher.php",
							data: {
								page: ajaxPage,
								size: ajaxSize
							},
							async:true,
							datatype: 'json',
							success: function(data){
								var res=JSON.parse(data);
								var total_page=res.data.total_page;
								var teacher=res.data.data;
								if (res.status) {
									dynamic_addition(teacher);
								}
							},
							error : function () {
						      	document.write("error");
						    }
						});
					}
				});
			}
			select_teacher();
			/*	教师查询：
			 * 
			 * 		select_teacher()
			 * */
			function select_teacher(){
				$.ajax({
					type:"get",
					url: host + "controller_b/select_teacher.php",
					data: {
						page: ajaxPage,
						size: ajaxSize
					},
					async:true,
					datatype:'json',
					success: function(data){
						var res=JSON.parse(data);
						var total_page=res.data.total_page;
						var teacher=res.data.data;
						if (res.status) {
							dynamic_addition(teacher);
							customPaging(total_page,ajaxPage);
						}else{
							layer.msg(res.message,{icon: 2,time:2000});
						}
			      	},
				    error : function () {
				      	document.write("error");
				    }
				});
			}
			//-------------------------------------------------------------
			/*
			 * 	表格动态添加数据
			 */
			function dynamic_addition(teacher){
				//防止每次刷新以后都添加一次
		       	$("#teacherList").html(""); 
				$.each(teacher, function(index, item) {
					var id = item.id;
					var head_img = item.head_img;
					var name = item.name;
					var title = item.title;
					var sex = item.sex;
					var school = item.school;
					var content = item.content;
					var cover = item.cover;
					var list = 
						'<tr>'+
							'<td>'+
								'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
									'<i class="layui-icon">&#xe605;</i>'+
								'</div>'+
							'</td>'+
							'<td><img src="http://'+head_img+'" /></td>'+
							'<td align="center">'+name+'</td>'+
							'<td align="center">'+sex+'</td>'+
							'<td align="center">'+title+'</td>'+
							'<td align="center">'+school+'</td>'+
							'<td align="center">'+content+'</td>'+
							'<td class="td-manage">'+
								"<button class=\"layui-btn layui-btn-danger\" onclick=\"teacher_del(this,"+id+","+"'"+name+"'"+","+"'"+title+"'"+")\"><i class=\"layui-icon\">&#xe640;</i>删除</button>"+
							'</td>'+
						'</tr>';
					$("#teacherList").append(list);
				});
			}
			
			
			/* 单个教师删除：
			 * 
			 * 		member_del（）
			 * */
			function teacher_del(obj, id, name, title) {
				layer.confirm('确认要删除  '+name+'  '+title+' 吗？', function(index) {
					$.ajax({
						type:"post",
						url: host + "controller_b/delete_teacher.php",
						async:true,
						data:{
							"ids[]": id
						},
						success: function(data){
							var res = JSON.parse(data);
							if (res.status) {
								select_teacher();
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
			
			/* 多个教师删除：
			 * 
			 * 		delAll（）
			 * */
			function delAll(argument) {
				var arrayData = tableCheck.getData();
				if (arrayData.length == 0) {
					layer.msg("请勾选要删除的教师", {icon: 3,time: 3000});
				}else{
					layer.confirm('确认要删除 '+arrayData.length+' 个教师吗？', function(index) {
						$.ajax({
							type:"post",
							url:host+"controller_b/delete_teacher.php",
						  	data:{
						  		"ids":arrayData
						  	},
						  	success:function(data){
						        	var res=JSON.parse(data);
						        	if (res.status) {
										select_teacher();
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
			//渲染多选框事件
		   	rendering_checkbox();
		</script>
	</body>

</html>