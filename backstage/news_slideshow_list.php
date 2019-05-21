<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>新闻管理==>轮播新闻页面</title>
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
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="./css/xadmin.css">
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
		<style type="text/css">
			.floatRight {
				/*float: right;*/
				/*margin-bottom: 20px;*/
			}
			
			.Omission {
				/*width: 100%;
    		height: 100%;*/
				background-color: #0000FF;
				/*强制不换行*/
				white-space: nowrap;
				/*超出显示省略号*/
				text-overflow: ellipsis;
				overflow: hidden;
			}
			
			#prevModal {
				width: 100%;
				height: 100%;
				text-align: center;
				display: none;
			}
		</style>
	</head>

	<body>
		<div class="x-nav">
			<span class="layui-breadcrumb">
	       		<a><cite style="color: red;">此页面为计算机工程系后台新闻管理页面，管理员务必慎重操作！</cite></a>
		    </span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
		<div class="x-body">
			<xblock>
				<button class="layui-btn layui-btn-disabled"><i class="layui-icon"></i>批量删除</button>
			</xblock>
			
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th width="50px" style="text-align: center;">ID</th>
						<th width="100px" style="text-align: center;">轮播图</th>
						<th width="" style="text-align: center;">标题</th>
						<th width="80px" style="text-align: center;">所属栏目</th>
						<th width="115px" style="text-align: center;">发布时间</th>
						<th width="70px" style="text-align: center;">排序</th>
						<th width="50px" style="text-align: center;">状态</th>
						<th width="50px" style="text-align: center;">操作</th>
					</tr>
				</thead>
				<tbody id="newsList">

				</tbody>
			</table>

		</div>
		
		<script>
			/**
			 * 	查询轮播通新闻
			 */
			query_broadCastNews();
			
			
			/*
			 * 	查询成功之后动态添加数据
			 */
			function dynamic_addition(category){
				//防止每次刷新以后都添加一次
       			$("#newsList").html(""); 
				$.each(category, function(index, item) {
					var id = item.id;
					var news_id = item.news_id;
					var title = item.title;
					var slideshow_cover = item.slideshow_cover; //轮播图片
					var column = item.column;
					var contributor = item.contributor;
					var index = item.index;
					var is_status = item.is_status;
					var creation_time = item.creation_time;
					var doEditItem=JSON.stringify(slideshow_cover);
					var list = 
						'<tr>'+
							'<td align="center">'+news_id+'</td>'+
							'<td><img src="http://'+slideshow_cover+'" /></td>'+
							'<td><i class="layui-icon x-show"></i>'+title+'</td>'+
							'<td align="center">'+column+'</td>'+
							'<td>'+getMyDate(creation_time)+'</td>'+
							'<td>'+
								'<input type="text" class="layui-input x-sort" onchange="index_edit(this,'+id+')"  value='+index+'>'+
							'</td>'+
							'<td class="td-manage">'+
								'<button id="status'+id+'" class="td-status layui-btn layui-btn-xs layui-btn-disabled" onclick="status_edit(this,'+id+','+is_status+')">已停用</button>'+
							'</td>'+
							'<td class="td-manage">'+
								'<button class="layui-btn layui-btn-danger" onclick="cancel_slideshow(this,'+id+','+news_id+')"><i class="layui-icon">&#xe640;</i>删除</button>'+
							'</td>'+
						'</tr>';
						$("#newsList").append(list);
						if(is_status==1){
							$("#status"+id).removeClass('layui-btn-disabled');
							$("#status"+id).addClass('layui-btn-normal').html('已启用');
						}
				});
			}
			
			/**
			 * 	查询轮播新闻
			 *		query_broadCastNews()
			 */
			function query_broadCastNews(){
				$.ajax({
					type: "get",
					url: host + "controller_b/select_slideshow.php",
					async: true,
					datatype: 'json',
					success: function(data) {
						var res = JSON.parse(data);
						var total_page = res.data.total_page;
						var category = res.data.data;
						if(res.status) {
							dynamic_addition(category);
						} else {
							alert("新闻获取失败");
						}
					},
					error: function() {
						document.write("error");
					}
				});
			}
			
			
			/* 删除轮播新闻：
			 * 
			 * 		cancel_slideshow（）
			 * */
			function cancel_slideshow(obj, id, news_id) {
				layer.confirm('确认删除该轮播新闻吗？', function(index) {
					$.ajax({
						type:"post",
						url: host + "controller_b/delete_slideshow.php",
						async:true,
						data:{
							"ids[]": id
						},
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								/*
								 * 删除轮播图
								 */
								$.ajax({
									type:"post",
									url: host + "controller_b/delete_news_img.php",
									async:true,
									data: {
										id: news_id,
										img: "slideshow_cover"
									},
									success: function(data){
										var res=JSON.parse(data);
										if (res.status) {
												//关闭所有页面层
												layer.closeAll('page');
												query_broadCastNews();
												parent.location.reload();//刷新页面
												layer.msg('删除轮播新闻成功',{icon: 1,time:2000});
										}else{
											layer.msg('删除轮播新闻失败',{icon: 2,time:2000});
										}
							      	},
								    error : function () {
								      	document.write("请联系维护人员");
								    }
								});
									
							}else{
								layer.msg(res.message,{icon: 2,time:2000});
							}
				      	},
					    error : function () {
					      	document.write("请联系维护人员");
					    }
					});
				});
			}
			
			/*	轮播新闻编辑：
			 * 		
			 * 		修改轮播新闻的排序
			 * */
			function index_edit(obj,id){
				var indexval = $(obj).val();
				$.ajax({
					type:"post",
					url: host + "controller_b/modify_slideshow.php",
					async:true,
					data:{
						"id": id,
						"index": indexval
					},
					success:function(data){
						var res=JSON.parse(data);
						if (res.status) {
							//刷新轮播新闻列表
							query_broadCastNews();
							layer.msg('修改排序成功!',{icon: 1,time:1000});
						} else{
							layer.msg('修改排序失败，请联系维护人员',{icon: 2,time:2000});
						}
					},
					error: function(){
						document.write("请联系维护人员");
					}
				});
			}
			
			/* 轮播编辑：
		  	 * 
			 * 		是否开启
			 * 		改变轮播开停状态
			 * */
	      	function status_edit(obj,id,is_status){
	      		if(is_status == 0){
		      		layer.confirm('确认要启用此轮播新闻吗？',function(index){
		                layer.msg('轮播新闻已启用!',{icon: 6,time:1000});
		                $.ajax({
							type:"post",
							url: host + "controller_b/modify_slideshow_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_broadCastNews();
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
		      		layer.confirm('确认要停用此轮播新闻吗？',function(index){
		                layer.msg('轮播新闻已停用!',{icon: 5,time:1000});
			             $.ajax({
							type:"post",
							url: host + "controller_b/modify_slideshow_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_broadCastNews();
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
		</script>
	</body>

</html>