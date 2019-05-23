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
		<!--新闻主体开始-->
		<section>
			<div class="container" style="background: white;border-top: 1px solid #0000CC;">
				<div class="row">
					<div class="col-md-12">
						<div class="article">																	
						</div>
						<div id="article_main">
							
						</div>

					</div>
				</div>
			</div>
		</section>
		<!--新闻主体结束-->
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
							<span><a href="">质量工程</a></span>
							<span><a href="">资源下载</a></span>
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
							<span><a href="">就业网</a></span>
							<span><a href="">招生网</a></span>
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
		var news_id = getQueryVariable('news_id');			//获取新闻id

		if(news_id){
			//请求新闻信息
			var news_url  = host+'select_news_by_id.php?id='+news_id;
			$.ajax({
				type:"get",
				url:news_url,
				async:true,
				success:function (data) {
					var result = JSON.parse(data);
					if(result['code'] == 200){
						var news_data 	= result['data'];  			//提取新闻
						var content 	= news_data['content'];			//新闻内容
						var title		= news_data['title'];			//新闻标题
						var time		= news_data['creation_time'];	//发布时间
						var count 		= news_data['count'];			//阅读量
						$(".article").append('<h2>'+title+'</h2>');
						$(".article").append('<p>发布时间:'+getMyDate(time)+'<span>浏览:'+count+'</span></p>');
						$("#article_main").append(content);					
					}else{
						$("#article_main").append('<div style="height: 300px;"><h3 style="text-align: center;">找不到该新闻</h3></div>');			
					}
				}
			});
			//增加点击数
			var add_count_url 	= host+'add_one_news_number.php';
			$.ajax({
				type:"post",
				data:{
					"id":news_id
				},
				url:add_count_url,
				async:true,
				success:function (data) {
				}
			});
//			新闻列表请求完毕
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