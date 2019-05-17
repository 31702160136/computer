<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>新闻管理==>轮播新闻页面</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
		<script src="js/time_stamp_date.js"></script>
		<script src="js/select_news.js"></script>
		<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="./js/xadmin.js"></script>
		<script type="text/javascript" src="./js/cookie.js"></script>
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
		        <a href="">首页</a>
		        <a href="">演示</a>
		        <a>
		          <cite>轮播新闻</cite></a>
		      </span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
		<div class="x-body">
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so">
					<div class="layui-input-inline">
						<input id="" class="layui-input" placeholder="请输入">
					</div>
					<button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
				</form>
			</div>
			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
				<span class="x-right" style="line-height:40px">共有数据：88 条</span>
			</xblock>
			
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th width="20px">
							<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
						</th>
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
			/**
			 * 	查询轮播通新闻
			 */
			query_broadCastNews();

			
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
												//parent.location.reload();//刷新页面
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