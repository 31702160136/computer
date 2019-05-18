<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>新闻管理==>所有新闻页面</title>
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
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>所有新闻</cite></a>
      </span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
				<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
		<div class="x-body">
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so">
					<div class="layui-input-inline">
						<select id="columnNameList" onchange="columnCilck()" lay-filter="select" lay-submit="">
							<option selected="selected">所有新闻</option>
							<option value="1" >所有新闻2</option>
							<option value="2">所有新闻3</option>
							<option value="3">所有新闻4</option>
						</select>
					</div>
					
					<div class="floatRight">
						<div class="layui-input-inline">
						<input id="search_box" class="layui-input" placeholder="请输入要搜索的有关标题字段" style="width: 500px;">
						</div>
						<button class="layui-btn" id="search_btn" lay-filter="search" lay-submit=""><i class="layui-icon">&#xe615;</i></button>
					</div>
					
				</form>
			</div>
			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
				<button class="layui-btn" onclick="x_admin_show('添加新闻','news_add.php',1200)"><i class="layui-icon"></i>添加</button>
			</xblock>
			
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th width="20px">
							<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
						</th>
						<th width="50px" style="text-align: center;">ID</th>
						<th width="100px" style="text-align: center;">封面</th>
						<th width="" style="text-align: center;">标题</th>
						<th width="80px" style="text-align: center;">所属栏目</th>
						<th width="80px" style="text-align: center;">投稿者</th>
						<th width="115px" style="text-align: center;">发布时间</th>
						<th width="165px" style="text-align: center;">状态</th>
						<th width="190px" style="text-align: center;">操作</th>
					</tr>
				</thead>
				<tbody id="newsList" value="123">

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
			
			query_generalNews();
			
			/*
			 * 	查询成功之后动态添加数据
			 */
			function dynamic_addition(category){
				//防止每次刷新以后都添加一次
		       	$("#newsList").html(""); 
				$.each(category, function(index, item) {
					var id = item.id;
					var title = item.title;
					var content = item.content;
					var contributor = item.contributor;
					var cover = item.cover;
					if(cover == "") {
						var cover = window.location.host + "/computer/backstage/images/no_photo.jpg";
					}
					var slideshow_cover = item.slideshow_cover; //轮播图片
					var is_hot = item.is_hot;
					var is_top = item.is_top;
					var is_status = item.is_status;
					var column = item.column;
					var column_id = item.column_id;
					var user_id = item.user_id;
					var creation_time = item.creation_time;
					var doEditItem=JSON.stringify(slideshow_cover);
					var list = 
						'<tr>'+
							'<td>'+
								'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
									'<i class="layui-icon">&#xe605;</i>'+
								'</div>'+
							'</td>'+
							'<td align="center">'+id+'</td>'+
							'<td><img src="http://'+cover+'" /></td>'+
							'<td><i class="layui-icon x-show"></i>'+title+'</td>'+
							'<td align="center">'+column+'</td>'+
							'<td align="center">'+contributor+'</td>'+
							'<td>'+getMyDate(creation_time)+'</td>'+
							'<td class="td-manage">'+
								'<button id="status'+id+'" class="td-status layui-btn layui-btn-xs layui-btn-disabled" onclick="status_edit(this,'+id+','+is_status+')">停用</button>'+
								'<button id="top'+id+'" class="layui-btn layui-btn-disabled" onclick="top_edit(this,'+id+','+is_top+')">置顶</button>'+
								'<button id="hot'+id+'" class="layui-btn layui-btn-xs  layui-btn-disabled" onclick="hot_edit(this,'+id+','+is_hot+')">热点</button>'+
							'</td>'+
							'<td class="td-manage">'+
								'<button id="slideshow'+id+'" class="layui-btn layui-btn-warm" onclick="uploadFile(this,'+id+','+doEditItem.replace(/\"/g,"'")+')"><i class="layui-icon layui-icon-set" style="font-size: 10px; "></i>设置轮播新闻</button>'+
								'<button class="layui-btn layui-btn-danger" onclick="member_del(this,'+id+',)"><i class="layui-icon">&#xe640;</i>删除</button>'+
							'</td>'+
						'</tr>';
					$("#newsList").append(list);
					if (slideshow_cover != null || slideshow_cover != "") {
						$("#slideshow"+id).removeClass('layui-btn-warm');
						$("#slideshow"+id).addClass('layui-btn-disabled').html('<i class="layui-icon layui-icon-set" style="font-size: 10px; "> 已设轮播新闻');
					}
					if (slideshow_cover == null || slideshow_cover == "") {
						$("#slideshow"+id).removeClass('layui-btn-disabled');
						$("#slideshow"+id).addClass('layui-btn-warm').html('<i class="layui-icon layui-icon-set" style="font-size: 10px; "> 设置轮播新闻');
					}
					if(is_hot==1){
						$("#hot"+id).removeClass('layui-btn-disabled');
						$("#hot"+id).addClass('layui-btn-danger');
					}
					if(is_top==1){
						$("#top"+id).removeClass('layui-btn-disabled');
						$("#top"+id).addClass('layui-btn-xs');
					}
					if(is_status==1){
						$("#status"+id).removeClass('layui-btn-disabled');
						$("#status"+id).addClass('layui-btn-normal').html('启用');
					}
				});
			}
			
			/**
			 * 	查询普通新闻
			 *		query_generalNews()
			 */
			function query_generalNews(){
				$.ajax({
					type: "get",
					url: host + "controller_b/select_news.php",
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
			
			/**	
			 * 	搜索新闻，根据栏目名称搜索
			 */
			layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                	layer = layui.layer;
                
                form.on('submit(select)',function(data) {
                	//获取option选中状态的动态id
					var column_name = $("#columnNameList option:selected").attr("value");
			 		console.log(column_name);
			 		console.log(data.value);
                });
                
                
                //监听提交
                form.on('submit(search)',function(data) {
					$.ajax({
						type: "get",
						url: host + "controller_b/select_news.php?title="+column_name,
						async: true,
						datatype: 'json',
						success: function(data) {
							var res = JSON.parse(data);
							var total_page = res.data.total_page;
							var category = res.data.data;
							if(res.status) {
								layer.msg('搜索新闻成功，共有'+category.length+'条', {icon: 1,time: 3000});
								//添加数据
								dynamic_addition(category);
							} else {
								alert("新闻获取失败");
							}
						},
						error: function() {
							document.write("error");
						}
					});
					return false;
            	});
			});
			
			/**	
			 * 	搜索新闻，根据新闻的标题搜索
			 */
			layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                	layer = layui.layer;
                //监听提交
                form.on('submit(search)',function(data) {
                	var serach_box = $("#search_box").val();
					$.ajax({
						type: "get",
						url: host + "controller_b/select_news.php?title="+serach_box,
						async: true,
						datatype: 'json',
						success: function(data) {
							var res = JSON.parse(data);
							var total_page = res.data.total_page;
							var category = res.data.data;
							if(res.status) {
								layer.msg('搜索新闻成功，共有'+category.length+'条', {icon: 1,time: 3000});
								//添加数据
								dynamic_addition(category);
							} else {
								alert("新闻获取失败");
							}
						},
						error: function() {
							document.write("error");
						}
					});
					return false;
            	});
			});
			
			/*
			 * 	设置轮播新闻按钮监听
			 */
			function uploadFile(obj,id,doEditItem){
				if (doEditItem == null || doEditItem == "") {
					//弹窗html
					var strfile = 
						'<form class="layui-form" enctype="multipart/form-data" method="post">'+
							'<div style="padding: 10px 0px 0px 20px">'+
								'<input type="file" name="rotationPhotoclick" id="rotationPhotoclick" />'+
								'<div class="layui-form-item" style="text-align: right; padding: 25px 15px 0px 0px">'+
									'<button class="layui-btn addbtn" lay-filter="modify" lay-submit=""><i class="layui-icon layui-icon-upload" style="font-size:10px;"></i>确定</button>'+
								'</div>'+
							'</div>'
						'</form>';	
				    layer.open({
				          type: 1,
				          title: '添加轮播图片',
						  skin: 'layui-layer-demo', //样式类名
						  closeBtn: 2, //不显示关闭按钮
						  anim: 2,
						  shadeClose: true, //开启遮罩关闭
						  content: strfile
				    });
					layui.use(['form'], function() {
						var form = layui.form;
						var layer = layui.layer;
		                //监听提交
		                form.on('submit(modify)',function(data) {
			                //获取图片信息
			                var rotationPhotoclick = $("#rotationPhotoclick").prop('files');
			                //判断有没有选择图片
			                if (rotationPhotoclick.length == 0) {
			                	layer.msg('请添加图片',{icon: 3,time:2000});
			                }else{
			                	var data = new FormData();
								data.append("id",id);
								data.append("slideshow_cover",rotationPhotoclick[0]);
								$.ajax({
									type:"post",
									url: host + "controller_b/modify_news.php",
									async:true,
									data: data,
									cache: false,
				                	processData: false,
				                	contentType: false,
									success: function(data){
										var res=JSON.parse(data);
										if (res.status) {
											$.ajax({
												type:"post",
												url: host + "controller_b/create_slideshow.php",
												async:true,
												data:{
													news_id: id
												} ,
												success: function(data){
													var res=JSON.parse(data);
													if (res.status) {
														//关闭所有页面层
														layer.closeAll('page');
														//查询普通新闻列表
														query_generalNews();
														//parent.location.reload();//刷新页面
														layer.msg('创建轮播新闻成功',{icon: 1,time:2000});
													}else{
														layer.msg('创建失败',{icon: 2,time:2000});
													}
										      	},
											    error : function () {
											      	document.write("请联系维护人员");
											    }
											});
										}else{
											layer.msg('上传图片失败',{icon: 2,time:2000});
										}
							      	},
								    error : function () {
								      	document.write("请联系维护人员");
								    }
								});
			                }
		                   	return false;
		            	});
					});
				}
				
			}	

			/* 单条新闻删除：
			 * 
			 * 		member_del（）
			 * */
			function member_del(obj, id) {
				layer.confirm('确认要删除吗？', function(index) {
					$.ajax({
						type:"post",
						url: host + "controller_b/delete_news.php",
						async:true,
						data:{
							"ids[]": id
						},
						success: function(data){
							var res = JSON.parse(data);
							if (res.status) {
								query_generalNews();
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
			}
			
			/* 多条新闻删除：
			 * 
			 * 		delAll（）
			 * */
			function delAll(argument) {
				var arrayData = tableCheck.getData();
				layer.confirm('确认要删除ID为 '+arrayData+' 的新闻吗？', function(index) {
					$.ajax({
						type:"post",
						url:host+"controller_b/delete_news.php",
					  	data:{
					  		"ids":arrayData
					  	},
					  	success:function(data){
					        	var res=JSON.parse(data);
					        	if (res.status) {
									query_generalNews();
									layer.msg('已删除!', {
										icon: 1,
										time: 1000
									});
								} else{
									layer.msg('请选择要删除的新闻', {
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
			
			/* 新闻编辑：
		  	 * 
			 * 		是否开启
			 * 		改变新闻开停状态
			 * */
	      	function status_edit(obj,id,is_status){
	      		if(is_status == 0){
		      		layer.confirm('确认要启用此新闻吗？',function(index){
		                layer.msg('新闻已启用!',{icon: 6,time:1000});
		                $.ajax({
							type:"post",
							url: host + "controller_b/modify_news_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_generalNews();
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
		      		layer.confirm('确认要停用此新闻吗？',function(index){
		                layer.msg('新闻已停用!',{icon: 5,time:1000});
			             $.ajax({
							type:"post",
							url: host + "controller_b/modify_news_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_generalNews();
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
	      	/* 新闻编辑：
		  	 * 
			 * 		是否置顶
			 * 		改变新闻置顶状态
			 * */
	      	function top_edit(obj,id,is_top){
	      		if(is_top == 0){
		      		layer.confirm('确认要置顶此新闻吗？',function(index){
		                layer.msg('新闻已置顶!',{icon: 6,time:1000});
		                $.ajax({
							type:"post",
							url: host + "controller_b/modify_news_top.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_generalNews();
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
		      		layer.confirm('确认要对此新闻取消置顶吗？',function(index){
		                layer.msg('已取消置顶!',{icon: 5,time:1000});
			             $.ajax({
							type:"post",
							url: host + "controller_b/modify_news_top.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_generalNews();
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
	      	/* 新闻编辑：
		  	 * 
			 * 		是否设为热点
			 * 		改变新闻状态
			 * */
	      	function hot_edit(obj,id,is_hot){
	      		if(is_hot == 0){
		      		layer.confirm('确认对此新闻将设为热点新闻吗？',function(index){
		                layer.msg('已设为热点新闻!',{icon: 6,time:1000});
		                $.ajax({
							type:"post",
							url: host + "controller_b/modify_news_hot.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_generalNews();
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
		      		layer.confirm('确认取消此新闻为热点新闻？',function(index){
		                layer.msg('已取消热点新闻!',{icon: 5,time:1000});
			             $.ajax({
							type:"post",
							url: host + "controller_b/modify_news_hot.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	query_generalNews();
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