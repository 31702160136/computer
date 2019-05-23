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
		<!--头部结束-->
		<style>
			li{
				float: left;
			}
		</style>
		<!--教师风采开始-->
		<div class="container" style="margin-top: 40px;">
			<div class="row">
				<div id="news_left" class="col-md-2 sidebar col-md-offset-1 visible-md-inline visible-lg-inline clearfix">
					<ul id="news_left_ul">
						<h2>教师风采</h2>
					</ul>
				</div>
				<div class="col-md-8 teacher_main clearfix" >
					<div>
						首页 > 教师风采
						<hr />
					</div>
					<div class="clearfix ">
						<ul class="img_container">
							<li>
								<a class="img_item" href="teacher_article.php?id">
									<div class="img_top">
										<img src="images/img3.jpg"/>
									</div>
									<div class="img_text">
										<h3>周洁文</h3>
										<span>高级讲师</span>
										<span>华南理工大学</span>
									</div>
								</a>
							</li>
						</ul>
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
		<!--教师风采结束-->
		<!--底部开始-->
		<footer class="footer">
			<div class="container">
				<div class="row clearfix">
					<div class="col-md-4 col-lg-4 footer_img  visible-lg-inline">
						<img src="images/logoarea.png"/>
					</div>
					<div class="col-sm-6 col-xs-8 col-md-3 col-lg-3 footer_address" >
						<span>电话:0668-2920526 <a href="../backstage/login.php">管理登录</a></span>
						<span>电子邮件：mzjsj@126.com</span>
						<span>地址：茂名师电白区沙院镇海城五路1号</span>
					</div>
					<div class="col-sm-6 col-xs-4 col-md-2 col-lg-1 footer_link" >
						<div class="zl">
							<span><a href="http://www.mmvtc.cn/templet/zlgc/">质量工程</a></span>
							<span><a href="http://websites.mmvtc.cn:808/zsw/">资源下载</a></span>
						</div>
					</div>
					
					<div class="col-sm-5 col-xs-5 col-md-2 col-lg-1 footer_wechat" >
						<div>
							<p>招生微信号</p>
							<img src="images/wechat1.jpg" alt="招生微信号" />
						</div>
					</div>
					<div class="col-sm-5 col-xs-5 col-md-2 col-lg-1 footer_wechat">
						<div>
							<p>系部微信号</p>
							<img src="images/wechat2.jpg" alt="系部微信号" />	
						</div>
					</div>
					<div class="col-sm-2 col-xs-8 col-md-2 col-lg-1 footer_link">
						<div>
							<h4>友情链接</h4>
							<span><a href="http://www.mmvtc.cn/templet/job/">就业网</a></span>
							<span><a href="http://websites.mmvtc.cn:808/zsw/">招生网</a></span>
						</div>
					</div>
				</div>
				<hr />
				<p style="text-align: center;">
					Cpoyright 2004-2017茂名职业技术学院 / 计算机工程系 All Rights Reserved.
				</p>
			</div>
		</footer>

		<script type="text/javascript">
		var home_url = host + 'select_home.php';
		//导航条渲染
		$.ajax({
			type:"get",
			url:home_url,
			async:true,
			success:function (data) {
				var result = JSON.parse(data);
				if(result['code'] == 200){
					var column 		= result['data']['column']; 	// 栏目
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
		queryTeacher();
		function queryTeacher(page=1){
			//		教师列表渲染
			var teacher_url = host+'select_teacher.php';
			$.ajax({
				type:"get",
				url:teacher_url,
				async:true,
				data:{
					page:page,
					size:8
				},
				success:function (data) {
					var result = JSON.parse(data);
					if(result['code'] == 200){
						$(".img_container").html("");
						var teacher_list = result['data']['data'];
						//获取当前页数
						var start_in=parseInt($("#start_in").prop("innerHTML"));
						$("#go").html("");
						$("#page_in").text(result.data.total_page);
						//初始化下拉框列表	
						for(var i=0;i<parseInt(result.data.total_page);i++){
							//给下拉框定位到当前页数
							if(i+1==start_in){
								$("#go").append('<option value="'+(i+1)+'" selected>'+(i+1)+'</option>');
							}else{
								$("#go").append('<option value="'+(i+1)+'">'+(i+1)+'</option>');
							}
						}
						$.each(teacher_list,function (index,item) {
							var list = '<li><a class="img_item" href="teacher_article.php?tid='+item['id']+'"><div class="img_top">'+
										'<img src="'+item['cover']+'"/></div><div class="img_text"><h3>'+item['name']+'</h3>'+
										'<span>'+item['title']+'</span><span>'+item['school']+'</span></div></a></li>';
							$(".img_container").append(list);
						});	
					}
				}
			});	
		}
		//点击下一页
		function next(){
			var page=parseInt($("#start_in").prop("innerHTML"));
			var page_tal=parseInt($("#page_in").prop("innerHTML"));
			//防止下一页超出范围
			if(page>=page_tal){
				return;
			}
			$("#start_in").text(page+1);
			queryTeacher(page+1);
		}
		//点击上一页
		function back(){
			var page=parseInt($("#start_in").prop("innerHTML"));
			//防止上一页超出范围
			if(page<=1){
				return;
			}
			$("#start_in").text(page-1);
			queryTeacher(page-1);
		}
//		监听下拉框点击事件
		window.onload = function () {
	        document.getElementById('go').addEventListener('change',function(){
	        	$("#start_in").text(this.value);
	        	queryTeacher(this.value);
	        },false);
        }
		
		</script>
	</body>
</html>