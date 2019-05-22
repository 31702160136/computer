<!DOCTYPE html>
<html >
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>茂名职业技术学院 - 计算机工程系</title>
		<meta name="Keywords" content="茂名职业技术学院,计算机工程系" />
		<meta name="Description" content="计算机工程系" />
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/news.css"/>
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<script src="js/path.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/time_stamp_date.js" type="text/javascript" charset="utf-8"></script>
		<!--bootstrap-->
		<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
		<script src="js/jquery.v1.9.1min.js"></script>
		<script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
		<script src="js/swiper.min.js"></script>
		
		<!--[if lt IE 9]>
		<script src="bootstrap-3.3.7-dist/js/html5shiv.min.js"></script>
		<script src="bootstrap-3.3.7-dist/js/respond.js"></script>
		<![endif]-->
	</head>
	
	<body>
		<!--头部 start-->
		<header>
			<nav id="header_bg" role="navigation">
				<div class="container">
					<div class="header_logo">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6">
									<img class="img-responsive" src="images/logoarea.png"/>
								</div>
								<div class="col-md-6 visible-md-inline visible-lg-inline">
									<div class="header_title">
										计算机工程系
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</nav>
			<nav class="navbar navbar-default header_nav">
				<div class="container">
					<div class="row">
						<div class="navbar-header col-lg-12">
							<a class="navbar-brand visible-xs-inline" href="#">
								<span>导航</span>
							</a>
							<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="#example-navbar-collapse">
							<span class="sr-only">切换导航</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse col-lg-12" id="example-navbar-collapse">
							<ul id="header_nav" class="nav navbar-nav navbar-right" data-in = "fadeInDown" data-out = "dadeOutUp">
								<li class="active dropdown">
									<a href="index.php">
										系部首页
									</a>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<!--头部 end-->
		<section style="margin-top: 40px;">
			<div class="container-fluid">
				<div class="row">
					<div id="news_left" class="col-md-2 sidebar col-md-offset-1 visible-md-inline visible-lg-inline clearfix">
						
					</div>
					<div class="col-md-8 main_container">
						<div class="news_main">
						</div>
						<div class="paging clearfix">
							<ul>
								<li id="page">共<a id="page_in">21</a>页</li>
								<li id="start">当前<a id="start_in">1</a>页</li>
								<li id="back" onclick="back()"><a href="#">上一页</a></li>
								<li id="next" onclick="next()"><a href="#">下一页</a></li>
								<li id="next">
									<select id="go">
									</select>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>		
		</section>
		
			
		<footer style="clear: left;">
			<div class="container-fluid footer">
				<div>
					<div style="float: left;width: 300px;">
						<img src="images/logoarea.png"/>
					</div>
					<div style="padding-left: 30px;padding-top:10px;float: left;line-height: 40px;">
						<span style="clear: both;">电话:0668-2920526&nbsp;&nbsp;电子邮件：mzjsj@126.com</span>
						<br />
						<span>地址：茂名师电白区沙院镇海城五路1号</span>
					</div>
				</div>
				<br style="clear: left;" />
				<hr />
				<p style="text-align: center;">
					Cpoyright 2004-2017茂名职业技术学院 / 计算机工程系 All Rights Reserved.
				</p>
			</div>

		</footer>
		<script type="text/javascript">
		var home_url = host + 'select_home.php';
		$.ajax({
			type:"get",
			url:home_url,
			async:true,
			success:function (data) {
				var result = JSON.parse(data);
				if(result['code'] == 200){
					var column 		= result['data']['column']; 	 	// 栏目
					//栏目导航渲染
					$.each(column,function (index,item) {
						var list = '<li class="active"><a href="news.php?id='+item['id']+'">'+item['title']+'</a></li>';
						$("#header_nav").append(list);
					});	
					$("#header_nav").append('<li class="active"><a href="teacher.php">教师风采</a></li>');
					$("#header_nav").append('<li class="active"><a href="http://www.mmvtc.cn">学院官网</a></li>');
				}
			}
		});	
		var column_id = getQueryVariable('id');			//获取栏目id

		if(column_id){
			//请求获得当前栏目
			var column_url     	= host+'select_columns.php'; 
			$.ajax({
				type:"get",
				url:column_url,
				async:true,
				success:function (data) {
					
					var result = JSON.parse(data);
					if(result['code'] == 200){
						var column_result = result['data']['data']; 	 	// 栏目
						//栏目导航渲染
						$.each(column_result,function (index,item) {
							if(item['id'] == column_id){
								$(".news_main").append('<p>首页 > '+item['title']+'</p><hr /><ul id="news_ul"></ul>');
								var list = '<h2>'+item['title']+'</h2><hr /><ul id="news_left_ul"></ul>';
								$("#news_left").append(list);
							}
						});	
					}
				}
			});
			queryNewsInfo(column_id,parseInt($("#start_in").prop("innerHTML")));
//			新闻列表请求完毕
		}
		//请求新闻列表
		function queryNewsInfo(column_id,page=1){
			//请求获得当前栏目新闻
			var news_url = host+'select_news_by_column_id.php';
			$.ajax({
				type:"get",
				url:news_url,
				async:true,
				data:{
					page:page,
					size:5,
					column_id:column_id
				},
				success:function (data) {
					var result = JSON.parse(data);
					if(result['code'] == 200){
						//每次请求清除新闻列表
						$("#news_left_ul").html("");
						//每次请求清除新闻列表
						$("#news_ul").html("");
						//每次请求清除下拉框列表
						$("#go").html("");
						$("#page_in").text(result.data.total_page);
						//获取当前页数
						var start_in=parseInt($("#start_in").prop("innerHTML"));
						var news_list = result['data']['data']['news']; 	 	// 提取新闻列表	
						var news_slide = result['data']['data']['hot_news']; 
						//初始化下拉框列表	
						for(var i=0;i<parseInt(result.data.total_page);i++){
							//给下拉框定位到当前页数
							if(i+1==start_in){
								$("#go").append('<option value="'+(i+1)+'" selected>'+(i+1)+'</option>');
							}else{
								$("#go").append('<option value="'+(i+1)+'">'+(i+1)+'</option>');
							}
						}
						$.each(news_slide,function (index,item) {
							var hot_list = '<li><a href="article.php?news_id="'+item['id']+'>'+item['title']+'</a></li>';
							$("#news_left_ul").append(hot_list);	
						});
						$.each(news_list,function (index,item) {
							var list = '<li><time><i class="glyphicon glyphicon-time"></i>'+getMyDate(item['creation_time'])+'</time>'+
									'<div><a href="article.php?news_id='+item['id']+'">'+item['title']+'</a></div></li>';
							$("#news_ul").append(list);
						});	
						
					}
				}
			});
		}
		//点击下一页
		function next(){
			var column_id = getQueryVariable('id');
			var page=parseInt($("#start_in").prop("innerHTML"));
			var page_tal=parseInt($("#page_in").prop("innerHTML"));
			//防止下一页超出范围
			if(page>=page_tal){
				return;
			}
			$("#start_in").text(page+1);
			if(column_id){
				queryNewsInfo(column_id,page+1);
			}
		}
		//点击上一页
		function back(){
			var column_id = getQueryVariable('id');	
			var page=parseInt($("#start_in").prop("innerHTML"));
			//防止上一页超出范围
			if(page<=1){
				return;
			}
			$("#start_in").text(page-1);
			if(column_id){
				queryNewsInfo(column_id,page-1);
			}
		}
//		监听下拉框点击事件
		window.onload = function () {
	        document.getElementById('go').addEventListener('change',function(){
	        	var column_id = getQueryVariable('id');
	        	$("#start_in").text(this.value);
	        	if(column_id){
					queryNewsInfo(column_id,this.value);
				}
	        },false);
        }
		//获取url参数	
		function getQueryVariable(variable)
		{
	       var query = window.location.search.substring(1);
	       var vars = query.split("&");
	       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
	       }
	       return(false);
		}
	</script>
	</body>
</html>