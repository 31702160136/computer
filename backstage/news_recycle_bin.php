<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>新闻管理==>回收站页面</title>
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
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="./css/xadmin.css">
		<link rel="stylesheet" href="css/paging.css">
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
	      	<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
	      	<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
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
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so">
					<div class="layui-input-inline">
						<input id="search_box" class="layui-input" placeholder="请输入要搜索的标题关键字" style="width: 500px;">
					</div>
					<button class="layui-btn" id="search_btn" lay-filter="search" lay-submit=""><i class="layui-icon">&#xe615;</i></button>
				</form>
			</div>
			<xblock>
				<button class="layui-btn layui-btn-normal" onclick="recoverAll()"><i class="layui-icon layui-icon-app" style="font-size:10px;"></i>批量恢复</button>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量移除</button>
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
						<th width="115px" style="text-align: center;">删除时间</th>
						<th width="140px" style="text-align: center;">操作</th>
					</tr>
				</thead>
				<tbody id="newsList" value="123">

				</tbody>
			</table>
			<!--分页-->
    		<div class="box" id="box"></div>

		</div>
		<script>
			init();
			function init(){
				var data={
					page:1,
					size:5
				}
				findNews(data);
			}
			function findNews(data){
				$.ajax({
					type: "get",
					url: host + "controller_b/select_recycle_bin.php",
					async: true,
					datatype: 'json',
					data:data,
					success: function(res_) {
						var res = JSON.parse(res_);
						var total_page = res.data.total_page;
						if(res.status) {
							pageIng(total_page,data);
						} else {
							alert("新闻获取失败");
						}
					},
					error: function() {
						document.write("error");
					}
				});	
			}
			function pageIng(total_page,data){
				//分页插件使用
				$('#box').paging({
					initPageNo: 1, // 初始页码
					totalPages: total_page, //总页数
					//totalCount: '当前页数合计' + len + '条数据', // 条目总数
					slideSpeed: 600, // 缓动速度。单位毫秒
					jump: true, //是否支持跳转
					callback: function(page) { // 回调函数
						data.page=page;
						query(data);
					}
				});
			}
			function query(data_){
				$.ajax({
					type: "get",
					url: host + "controller_b/select_recycle_bin.php",
					data:data_,
					async: true,
					datatype: 'json',
					success: function(data) {
						var res = JSON.parse(data);
						var total_page = res.data.total_page;
						var news = res.data.data;
						if(res.status) {
							dynamic_addition(news);
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
			 * 	搜索新闻，根据新闻的标题搜索
			 */
			layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                	layer = layui.layer;
                //监听提交
                form.on('submit(search)',function(data) {
                	var serach_box = $("#search_box").val();
					var data={
						page:1,
						size:10,
						title:serach_box
					}
					findNews(data);
					return false;
            	});
			});
			
			//-------------------------------------------------------------
			/*
			 * 	查询成功之后动态添加数据
			 */
			function dynamic_addition(category){
				var customID = 1;
				//防止每次刷新以后都添加一次
	           	$("#newsList").html(""); 
				$.each(category, function(index, item) {
					var id = item.id;
					var title = item.title;
					var content = item.content;
					var contributor = item.contributor;
					var cover = item.cover;
					//如果没有封面图片自动添加一张指定图片
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
					var list = 
						'<tr>'+
							'<td>'+
								'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
									'<i class="layui-icon">&#xe605;</i>'+
								'</div>'+
							'</td>'+
							'<td align="center">'+(customID++)+'</td>'+
							'<td><img src="http://'+cover+'" /></td>'+
							'<td><i class="layui-icon x-show"></i>'+title+'</td>'+
							'<td align="center">'+column+'</td>'+
							'<td align="center">'+contributor+'</td>'+
							'<td>'+getMyDate(creation_time)+'</td>'+
							'<td class="td-manage">'+
								'<button class="layui-btn layui-btn-normal" onclick="news_recover(this,'+id+',)"><i class="layui-icon layui-icon-edit" style="font-size:10px;"></i>恢复</button>'+
								'<button class="layui-btn layui-btn-danger" onclick="news_del(this,'+id+',)"><i class="layui-icon">&#xe640;</i>移除</button>'+
							'</td>'+
						'</tr>';
					$("#newsList").append(list);
				});
			}
			/* 单条新闻恢复：
			 * 
			 * 		news_recover（）
			 * */
			function news_recover(obj, id) {
				layer.confirm('确认要恢复此新闻吗？', function(index) {
					$.ajax({
						type:"post",
						url: host + "controller_b/recover_news.php",
						async:true,
						data:{
							"ids[]": id
						},
						success: function(data){
							var res = JSON.parse(data);
							if (res.status) {
								init();
								layer.msg('恢复新闻成功!', {icon: 1,time: 1000});
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
			/* 多条新闻恢复：
			 * 
			 * 		recoverAll（）
			 * */
			function recoverAll(argument) {
				var arrayData = tableCheck.getData();
				if (arrayData.length == 0) {
					layer.msg("请勾选要恢复的新闻", {icon: 3,time: 3000});
				}else{
					layer.confirm('确认要恢复 '+arrayData.length+' 条新闻吗？', function(index) {
						$.ajax({
							type:"post",
							url:host+"controller_b/recover_news.php",
						  	data:{
						  		"ids":arrayData
						  	},
						  	success:function(data){
						        	var res=JSON.parse(data);
						        	if (res.status) {
										init();
										layer.msg('恢复'+arrayData.length+'新闻成功!', {icon: 1,time: 1000});
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
			
			/* 单条新闻删除：
			 * 
			 * 		news_del（）
			 * */
			function news_del(obj, id) {
				layer.confirm('确认要删除此新闻吗？', function(index) {
					$.ajax({
						type:"post",
						url: host + "controller_b/delete_recycle_bins.php",
						async:true,
						data:{
							"ids[]": id
						},
						success: function(data){
							var res = JSON.parse(data);
							if (res.status) {
								init();
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
			/* 多条新闻删除：
			 * 
			 * 		delAll（）
			 * */
			function delAll(argument) {
				var arrayData = tableCheck.getData();
				if (arrayData.length == 0) {
					layer.msg("请勾选要删除的新闻", {icon: 3,time: 3000});
				}else{
					layer.confirm('确认要删除'+arrayData.length+' 条新闻吗？', function(index) {
						$.ajax({
							type:"post",
							url:host+"controller_b/delete_recycle_bins.php",
						  	data:{
						  		"ids":arrayData
						  	},
						  	success:function(data){
						        	var res=JSON.parse(data);
						        	if (res.status) {
										init();
										layer.msg('删除'+arrayData.length+'新闻成功!', {icon: 1,time: 1000});
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