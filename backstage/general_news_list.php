<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>欢迎页面-X-admin2.1</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
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
          <cite>导航元素</cite></a>
      </span>
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
				<i class="layui-icon" style="line-height:30px">ဂ</i></a>
		</div>
		<div class="x-body">
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so">
					<div class="layui-input-inline">
						<select name="contrller" lay-filter="choiceNews">
							<option id="generalNews" value="generalNews" selected="selected">普通新闻</option>
							<!--<option id="tabloid" value="tabloid">图片新闻</option>-->
							<option id="broadCastNews" value="broadCastNews">轮播新闻</option>
						</select>
					</div>
					<button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
				</form>
			</div>

			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
				<button class="layui-btn" onclick="x_admin_show('添加新闻','./news_add.php',1200)"><i class="layui-icon"></i>添加</button>
				<span class="x-right" style="line-height:40px">共有数据：88 条</span>
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
						<th width="80px" style="text-align: center;">发布人</th>
						<th width="115px" style="text-align: center;">发布时间</th>
						<th width="165px" style="text-align: center;">状态</th>
						<th width="215px" style="text-align: center;">操作</th>
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
			query_generalNews();
			
			layui.use(['form','laydate'], function() {
				var laydate = layui.laydate;
				var form = layui.form;
				//执行一个laydate实例
				laydate.render({
					elem: '#start' //指定元素
				});
				form.on('select(choiceNews)', function(data1){
				    var choiceNews = data1.value;
				    switch (choiceNews){
				    	case "generalNews":
				    		query_generalNews();
				    		break;
				    	case "tabloid":
				    		query_tabloid();
				    		break;
			    		case "broadCastNews":
			    			query_broadCastNews();
			    			break;
				    	default:
				    		break;
				    }
				});
			});
			
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
							clear_tr();
							$.each(category, function(index, item) {
								var id = item.id;
								var title = item.title;
								var content = item.content;
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
								var list = 
									'<tr>'+
										'<td>'+
											'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
												'<i class="layui-icon">&#xe605;</i>'+
											'</div>'+
										'</td>'+
										'<td>'+id+'</td>'+
										'<td><img src="http://'+cover+'" /></td>'+
										'<td><i class="layui-icon x-show"></i>'+title+'</td>'+
										'<td>'+column+'</td>'+
										'<td>'+user_id+'</td>'+
										'<td>'+getMyDate(creation_time)+'</td>'+
										'<td class="td-manage">'+
											'<button id="hot'+id+'" class="layui-btn layui-btn-xs  layui-btn-disabled" title="热点">热点</button>'+
											'<button id="top'+id+'" class="layui-btn layui-btn-disabled" title="置顶">置顶</button>'+
											'<button id="status'+id+'" class="layui-btn layui-btn-xs layui-btn-disabled" title="开启/停用" onclick="status_edit(this,'+id+','+is_status+')">停用</button>'+
										'</td>'+
										'<td class="td-manage">'+
											'<button class="layui-btn layui-btn-normal"><i class="iconfont">&#xe6ac; </i>查看</button>'+
											'<button class="layui-btn layui-btn-xs"><i class="layui-icon">&#xe642;</i>编辑</button>'+
											'<button class="layui-btn layui-btn-danger" onclick="member_del(this,'+id+')"><i class="layui-icon">&#xe640;</i>删除</button>'+
										'</td>'+
									'</tr>';
								if (slideshow_cover == "") {
									$("#newsList").append(list);
								}
								if(is_hot==1){
									$("#hot"+id).removeClass('layui-btn-disabled');
									$("#hot"+id).addClass('layui-btn-danger');
								}
								if(is_top==1){
									$("#top"+id).removeClass('layui-btn-disabled');
									$("#top"+id).addClass('layui-btn-normal');
								}
								if(is_status==1){
									$("#status"+id).removeClass('layui-btn-disabled');
									$("#status"+id).addClass('layui-btn-warm').html('启用');
								}
							});
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
			 * 	查询轮播新闻
			 *		query_broadCastNews()
			 */
			function query_broadCastNews(){
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
							clear_tr();
							$.each(category, function(index, item) {
								var id = item.id;
								var title = item.title;
								var cover = item.cover;
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
										'<td>'+id+'</td>'+
										'<td><img src="http://'+slideshow_cover+'" /></td>'+
										'<td><i class="layui-icon x-show"></i>'+title+'</td>'+
										'<td>'+column+'</td>'+
										'<td>'+user_id+'</td>'+
										'<td>'+getMyDate(creation_time)+'</td>'+
										'<td class="td-manage">'+
											'<button id="hot'+id+'" class="layui-btn layui-btn-xs  layui-btn-disabled" title="热点">热点</button>'+
											'<button id="top'+id+'" class="layui-btn layui-btn-disabled" title="置顶">置顶</button>'+
											'<button id="status'+id+'" class="layui-btn layui-btn-xs layui-btn-disabled" title="开启/停用" onclick="status_edit(this,'+id+','+is_status+')">停用</button>'+
										'</td>'+
										'<td class="td-manage">'+
											'<button class="layui-btn layui-btn-normal"><i class="iconfont">&#xe6ac; </i>查看</button>'+
											'<button class="layui-btn layui-btn-xs"><i class="layui-icon">&#xe642;</i>编辑</button>'+
											'<button class="layui-btn layui-btn-danger" onclick="member_del(this,'+id+')"><i class="layui-icon">&#xe640;</i>删除</button>'+
										'</td>'+
									'</tr>';
								if (slideshow_cover != "") {
									$("#newsList").append(list);
									if(is_hot==1){
										$("#hot"+id).removeClass('layui-btn-disabled');
										$("#hot"+id).addClass('layui-btn-danger');
									}
									if(is_top==1){
										$("#top"+id).removeClass('layui-btn-disabled');
										$("#top"+id).addClass('layui-btn-normal');
									}
									if(is_status==1){
										$("#status"+id).removeClass('layui-btn-disabled');
										$("#status"+id).addClass('layui-btn-warm');
									}
								}
								
							});
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
			 * 	每次刷新删除原数据
			 * 		clear_tr()
			 */
			function clear_tr(){
				//绑定tbody列表ID
				var newsList = document.getElementById('newsList');
				//获取columnList的tr属性长度
				var len = $("#newsList").find("tr").length;
				//如果len长度大于0，删除所有行数
				if(len > 0) {
					$("#newsList").find('tr').remove();
				}
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
		</script>
		<script>
			var _hmt = _hmt || [];
			(function() {
				var hm = document.createElement("script");
				hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
				var s = document.getElementsByTagName("script")[0];
				s.parentNode.insertBefore(hm, s);
			})();
		</script>
	</body>

</html>