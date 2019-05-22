<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>栏目管理模块</title>
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
    <style type="text/css">
    	.layui-row{
    		float: left;
    		height: 30px;
    		margin-bottom: 10px;
    	}
    	.addBtn{
    		margin-bottom: 10px;
    		padding-left: 170px;
    	}
    </style>
	</head>
	
	<body>
		<div class="x-nav">
			<span class="layui-breadcrumb">
	       		<a><cite style="color: red;">此页面为计算机工程系后台栏目管理页面，管理员务必慎重操作！</cite></a>
      		</span>
      		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
		<div class="x-body">
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so layui-form-pane">
					<input id="columnName" class="layui-input" placeholder="栏目名">
				</form>
			</div>
			<div class="addBtn">
				<button id="addColumnBtn" name="addColumnBtn" class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon"></i>创建</button>
			</div>
			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
			</xblock>
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th width="15">
			              	<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
			            </th>
						<th style="text-align: center;" width="50">ID</th>
						<th style="text-align: center;">栏目名</th>
						<th style="text-align: center;" width="150">创建时间</th>
						<th style="text-align: center;" width="150">更新时间</th>
						<th style="text-align: center;" width="70">排序</th>
						<th style="text-align: center;" width="50">状态</th>
						<th style="text-align: center;" width="150">操作</th>
					</tr>
				</thead>
				<tbody class="x-cate" id="columnList"></tbody>
			</table>
		    <!--分页-->
    		<div class="box" id="box"></div>
		</div>
		
		<script>
			//定义全局变量	ajaxPage 页数
			var ajaxPage = 1;
			//一页的数量
			var ajaxSize = 10;
			//调用查询栏目刷新页面
			select_column();
			/*	栏目查询：
			 * 
			 * 		select_column()
			 * */
			function select_column(){
				$.ajax({
					type:"get",
					url: host + "controller_b/select_columns.php",
					data: {
						page: ajaxPage,
						size: ajaxSize
					},
					async:true,
					datatype:'json',
					success: function(data){
						var res=JSON.parse(data);
						var total_page=res.data.total_page;
						var category=res.data.data;
						if (res.status) {
							dynamic_addition(category);
							var len = category.length;
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
			 * 	从	select_column();传	total_page 总页数,len 当前页数长度,ajaxPage 当前页数，
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
							url: host + "controller_b/select_columns.php",
							data: {
								page: ajaxPage,
								size: ajaxSize
							},
							async:true,
							datatype: 'json',
							success: function(data){
								var res=JSON.parse(data);
								var total_page=res.data.total_page;
								var category=res.data.data;
								if (res.status) {
									dynamic_addition(category);
								}
							},
							error : function () {
						      	document.write("error");
						    }
						});
					}
				});
			}
			
			/*
			 * 	表格动态添加数据
			 */
			function dynamic_addition(category){
				var customID = 1;
				//防止每次刷新以后都添加一次
 			    $("#columnList").html(""); 
				$.each(category, function(index,item) {
					var id = item.id;
					var title = item.title;
					var creation_time = item.creation_time;
					var modify_time = item.modify_time;
					var index = item.index;
					var is_status = item.is_status;
					var list = 
						'<tr>'+
							'<td>'+
								'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
									'<i class="layui-icon">&#xe605;</i>'+
								'</div>'+
							'</td>'+
							'<td align="center">'+(customID++)+'</td>'+
							'<td align="center">'+title+'</td>'+
							'<td align="center">'+getMyDate(creation_time)+'</td>'+
							'<td align="center">'+getMyDate(modify_time)+'</td>'+
							'<td>'+
								'<input type="text" class="layui-input x-sort" onchange="member_sort(this,'+id+')"  value='+index+'>'+
							'</td>'+
							'<td class="td-status"><span id="status'+id+'" class="layui-btn layui-btn-warm" onclick="member_stop(this,'+id+','+is_status+')">已停用</span></td>'+
							'<td class="td-manage">'+
								"<button class=\"layui-btn layui-btn-xs\" onclick=\"member_edit(this,"+id+","+"'"+title+"'"+")\"><i class=\"layui-icon\">&#xe642;</i>编辑</button>"+
								'<button class="layui-btn-danger layui-btn layui-btn-xs" onclick="member_del(this,'+id+')"><i class="layui-icon">&#xe640;</i>删除</button>'+
							'</td>'+
						'</tr>';
					$("#columnList").append(list);
					if(is_status==1){
						$("#status"+id).removeClass('layui-btn-warm');
						$("#status"+id).addClass('layui-btn-normal').html('已启用');
					}
				});
			}
			
			/* 	栏目创建：
			 * 		
			 * */
			$("#addColumnBtn").click(function(){
				var columnName = $("#columnName").val();
				if(columnName == ""){
					layer.msg('请输入栏目名称',{icon: 3,time:2000});
				}else{
					$.ajax({
						type:"post",
						url: host + "controller_b/create_column.php",
						async:true,
						data:{
							"title": columnName,
						},
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								select_column();
								layer.msg(res.message,{icon: 1,time:2000});
							}else{
								layer.msg(res.message,{icon: 2,time:2000});
							}
				      	},
					    error : function () {
					      	document.write("请联系维护人员");
					    }
					});
				}
			});
			
			/*	栏目编辑：
			 * 		
			 * 		修改栏目排序
			 * */
			function member_sort(obj,id){
				var indexval = $(obj).val();
				$.ajax({
					type:"post",
					url: host + "controller_b/modify_column.php",
					async:true,
					data:{
						"id": id,
						"index": indexval
					},
					success:function(data){
						var res=JSON.parse(data);
						if (res.status) {
							select_column();
							layer.msg(res.message,{icon: 1,time:1000});
						} else{
							layer.msg(res.message,{icon: 2,time:2000});
						}
					},
					error: function(){
						document.write("请联系维护人员");
					}
				});
			}
			
			/*	栏目编辑：
	      	 * 
	      	 * 		修改栏目名称
	      	 **/
	      	function member_edit(obj,id,title){
			//JQ的member_edit(this,"+系部概括+")转换成js就是member_edit(this,系部概括)，
			//因为英文和中文要用引号括住，所以JQ要这样写："member_edit(this,"+"'"+title+"'"+")转换成js就是member_edit(this,"系部概括")
				layer.prompt({
					formType: 0,
					value: title,
					title: '修改栏目名称',
					//area: ['1000px', '550px'] //自定义文本域宽高
				},function(value, index, elem){
						$.ajax({
							type:"post",
							url:host + "controller_b/modify_column.php",
							async:true,
							data:{
								"id": id,
								"title": value
							},
							success: function(data){
								var res = JSON.parse(data);
								if (res.status) {
									select_column();
									layer.msg(res.message,{icon: 1,time:1000});
								} else{
									layer.msg(res.message,{icon: 2,time:2000});
								}
							},
							error:function(){
								document.write("error");
							}
						});
					  layer.close(index);
				});
			}
	      		
	      	/* 栏目编辑：
		  	 * 
			 * 		开启，停用
			 * 		改变栏目状态
			 * */
	      	function member_stop(obj,id,is_status){
	      		if(is_status == 0){
		      		layer.confirm('确认要启用吗？',function(index){
		                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-warm');
		                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-normal').html('已启用');
		                layer.msg('已启用!',{icon: 6,time:1000});
		                $.ajax({
							type:"post",
							url: host + "controller_b/modify_column_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	select_column();
								}else{
									layer.msg(res.message,{icon: 2,time:2000});
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
							url: host + "controller_b/modify_column_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	select_column();
								}else{
									layer.msg(res.message,{icon: 2,time:2000});
								}
					      	},
						    error : function () {
						      	document.write("error");
						    }
						});
			        });
		     	}
	      	}	
	      	    	
			/* 单个栏目删除：
			 * 
			 * 		member_del（）
			 * */
			function member_del(obj, id) {
				layer.confirm('确认要删除吗？', function(index) {
					$.ajax({
						type:"post",
						url: host + "controller_b/delete_columns.php",
						async:true,
						data:{
							"ids[]": id
						},
						success: function(data){
							var res = JSON.parse(data);
							if (res.status) {
								select_column();
								layer.msg(res.message, {
									icon: 1,
									time: 1000
								});
							} else{
								layer.msg(res.message, {
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
			/* 多个栏目删除：
			 * 
			 * 		delAll（）
			 * */
			function delAll(argument) {
				var arrayData = tableCheck.getData();
				if (arrayData.length == 0) {
					layer.msg("请勾选要删除的栏目", {icon: 3,time: 3000});
				}else{
					layer.confirm('确认要删除 '+arrayData.length+' 个栏目吗？', function(index) {
						$.ajax({
							type:"post",
							url:host+"controller_b/delete_columns.php",
						  	data:{
						  		"ids":arrayData
						  	},
						  	success:function(data){
						        	var res=JSON.parse(data);
						        	if (res.status) {
										select_column();
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