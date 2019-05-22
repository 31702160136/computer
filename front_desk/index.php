<!DOCTYPE html>
<html >
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>茂名职业技术学院 - 计算机工程系</title>
		<meta name="Keywords" content="茂名职业技术学院,计算机工程系" />
		<meta name="Description" content="计算机工程系" />
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
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
		<link rel="stylesheet" type="text/css" href="css/swiper.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/certify.css"/>
		<script src="js/swiper.min.js"></script>

		<!--jquery carousel-->
		<link rel="stylesheet" href="OwlCarousel2-2.3.4/dist/assets/owl.carousel.css">
		<link rel="stylesheet" href="OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.theme.default.min.css">
		<script src="OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>

	</head>
	<script type="text/javascript">
		var home_url = host + 'select_home.php';
		$.ajax({
			type:"get",
			url:home_url,
			async:true,
			success:function (data) {
				var result = JSON.parse(data);
				if(result['code'] == 200){
					var ul			= document.getElementById('header_nav');
					var column 		= result['data']['column']; 	 	// 栏目
					var column_news = result['data']['column_news'];	// 首页栏目及相应新闻
					var slideshow   = result['data']['slideshow'];		// 轮播图
					var cover   	= result['data']['cover'];			// 图片新闻
					var bottom_news	= result['data']['bottom_news'];   	// 底部新闻
					var xibu_list 	= column_news['xibu']; 				// 获取系部新闻列表
					var skill_list 	= column_news['jineng']; 			// 获取技能竞赛列表
					var job_list 	= column_news['zhaosheng']; 		// 获取招生就业新闻列表
					var inform_list = column_news['tongzhi']; 			// 获取通知公告新闻列表
					var teaching_left = bottom_news[0];
					var teaching_right= bottom_news[1];
			
					//轮播图渲染
					$.each(slideshow,function (index,item) {
						$("#owl"+index).html("");
						$("#owl"+index).append('<a href="article.php?news_id='+item.news_id+'"><img src="'+item.slideshow_cover+'" /></a>');
					});	
					
					//栏目导航渲染
					$.each(column,function (index,item) {
						var list = '<li class="active"><a href="news.php?id='+item['id']+'">'+item['title']+'</a></li>';
						$("#header_nav").append(list);
					
					});	
					$("#header_nav").append('<li class="active"><a href="teacher.php">教师风采</a></li>');
					$("#header_nav").append('<li class="active"><a href="www.mmvtc.cn">学院官网</a></li>');
					//图片新闻渲染
					$.each(cover,function (index,item) {
						if(index == 0){
							var list = '<a href="article.php?news_id='+item['id']+'"><img src="'+item['cover']+'" alt="" class="img-responsive"/><p>'+item['title']+'</p></a>';
							$("#pic_news_left").append(list);
						}else if(index > 3){
							return;
						}else{
							var list = '<a href="article.php?news_id='+item['id']+
							'"><div><img src="'+item['cover']+'"/></div><div><p>'+item['title']+
							'</p><div><time><i class="glyphicon glyphicon-time" style="margin-right: 2px;padding-top: 2px;">'+
							'</i>'+getMyDate(item['creation_time'])+'</time><span><i class="glyphicon glyphicon-eye-open"></i>阅读('+item['count']+')</span></div></div></a>';
							$("#pic_news_right").append(list);
						}
					});
					//系部新闻渲染
					$.each(xibu_list, function(index,item) {
						if(index < 5){
							var list = '<li><a href="article.php?news_id='+item['id']+'">'+item['title']+'</a>'+
									'<div><time><i class="glyphicon glyphicon-time"></i>'+getMyDate(item['creation_time'])+'</time>'+
									'<span><i class="glyphicon glyphicon-eye-open"></i>阅读('+item['count']+')</span>'+
									'</div></li>';
							$("#news_ul").append(list);
						}
					});
					//技能竞赛渲染
					$.each(skill_list, function(index,item) {
						if(index < 5){
							var list = '<li><a href="article.php?news_id='+item['id']+'">'+item['title']+'</a>'+
									'<div><time><i class="glyphicon glyphicon-time"></i>'+getMyDate(item['creation_time'])+'</time>'+
									'<span><i class="glyphicon glyphicon-eye-open"></i>阅读('+item['count']+')</span>'+
									'</div></li>';
							$("#skill_ul").append(list);
						}
					});
					//招生就业渲染
					$.each(job_list, function(index,item) {
						if(index < 5){
							var list = '<li><a href="article.php?news_id='+item['id']+'">'+item['title']+'</a>'+
									'<div><time><i class="glyphicon glyphicon-time"></i>'+getMyDate(item['creation_time'])+'</time>'+
									'<span><i class="glyphicon glyphicon-eye-open"></i>阅读('+item['count']+')</span>'+
									'</div></li>';
							$("#job_ul").append(list);
						}
					});
					//通知公告渲染
					var title = '<a href="news.php?id='+inform_list[0]['column_id']+'" class="pull-right">更多 ></a>';
					$(".inform_title").append(title);
					$.each(inform_list, function(index,item) {
						if(index < 4){
							var mydate = new Date(item['creation_time']*1000);
							var myday = getzf(mydate.getDate());
							var mytime = mydate.getFullYear()+"-"+getzf(mydate.getMonth()+1);
							var list = '<li><time><span class="day">'+myday+'</span><span class="month">'+mytime+'</span>'+
										'</time><a href="article.php?news_id='+item['id']+'">'+item['title']+'</a></li>';
							$("#inform_ul").append(list);
						}
					});
					//教学科研渲染
					var teaching_title = '<h2><span>'+teaching_left['column']+'</span>'+
							'<a href="news.php?id='+teaching_left['column_id']+'">更多 ></a></h2>';
					$(".teaching_title").append(teaching_title);
					var teaching_left  = '<a href="article.php?news_id='+teaching_left['id']+'">'+
								'<img src="'+teaching_left['cover']+'" alt="'+teaching_left['title']+'">'+
								'<div class="teaching_content content_left"><i>new</i><h4>'+teaching_left['title']+'</h4>'+
								'<p>'+teaching_left['describe']+'</p></div></a>';
					$("#teaching_left").append(teaching_left);
					var teaching_right  = '<a href="article.php?news_id='+teaching_right['id']+'">'+
								'<img src="'+teaching_right['cover']+'" alt="'+teaching_right['title']+'">'+
								'<div class="teaching_content content_left"><i>new</i><h4>'+teaching_right['title']+'</h4></div></a>';
					$("#teaching_right").append(teaching_right);		 	
						
				}
			}
		});
	</script>
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
							<ul class="nav navbar-nav navbar-right" data-in = "fadeInDown" data-out = "dadeOutUp" id="header_nav">
								<li class="active">
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

		<!--轮播图 start-->
		<div id="owl-demo" class="owl-carousel owl-theme slideshow" style="max-width: 1400px;">
			<div id="owl0"><a href="#"><img src="../images/1558501606.jpg"/></a></div>
			<div id="owl1"><a href="#"><img src="../images/1558501606.jpg"/></a></div>
			<div id="owl2"><a href="#"><img src="../images/1558501606.jpg"/></a></div>
			<div id="owl3"><a href="#"><img src="../images/1558501606.jpg"/></a></div>
			<div id="owl4"><a href="#"><img src="../images/1558501606.jpg"/></a></div>
		</div>
		<!--轮播图 end-->
		<!--图片新闻 start-->
		<div style="background: #e7e7e7;">
			<div class="container pic_news mb20">
				<div class="row">
					<section class="xueyuan">
						<h3>热点新闻<small>news</small></h3>
					</section>
					<div id="pic_news_left" class="col-sm-5 col-md-5 visible-lg-inline visible-md-inline  pic_news_left">
					</div>
					<div id="pic_news_right" class="col-md-7 col-sm-12 pic_news_right" >
					</div>
				</div>
			</div>
		
		<!--图片新闻 end-->
		<!--文字新闻 strat-->
		<section class="container">
			<section class="xueyuan">
				<h3>学院新闻<small>news</small></h3>
			</section>
			<div class="row">
				<!--新闻导航条-->
				<div class="col-md-7" >
					<ul class="nav nav-tabs news_title " role="tablist">
						<li role="presentation" class="active">
							<a href="#news" aria-controls="home" role="tab" data-toggle="tab">
								系部新闻
							</a>
						</li>
						<li role="presentation">
							<a href="#job" aria-controls="profile" role="tab" data-toggle="tab">
								招生就业
							</a>
						</li>
						<li role="presentation">
							<a href="#skill" aria-controls="messages" role="tab" data-toggle="tab">
								技能竞赛
							</a>
						</li>
					</ul>
					<!-- 新闻内容容器 -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active news" id="news">
							<ul id="news_ul">
							</ul>
						</div>
						<div role="tabpanel" class="tab-pane news" id="job">
							<ul id="job_ul">
							</ul>
						</div>
						<div role="tabpanel" class="tab-pane news" id="skill">
							<ul id="skill_ul">
							</ul>
						</div>
					</div>
				</div>
				<!-- 新闻内容容器结束-->
			
				<!--通知公告-->
				<div class="col-md-5">
					<div class="inform_title">
						通知公告
					</div>
					<ul id="inform_ul" class="inform clearfix">	
					</ul>
				</div>
			</div>
		</section>
		</div>
		<!--文字新闻 end-->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<img src="images/fengge.jpg" style="width: 100%;"/>
				</div>
			</div>
		</div>
		<!--教学科研 start-->
		<div style="background: #e7e7e7;padding-bottom: 100px;padding-top: 20px;">
			<section class="container mt20 mb20">
				<div class="row">
					<div class="teaching_title visible-md-inline visible-lg-inline">
					</div>
					<div class="col-md-6" >
						<div id="teaching_left" class="thumbnail teaching">
						</div>
					</div>
					<div class="col-md-5 deviation">
						<div id="teaching_right" class="thumbnail teaching" >
						</div>
					</div>
				</div>
			</section>
		</div>
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

		<script>$(function() {
	// 初始化轮播
	$(".start-slide").click(function() {
		$("#myCarousel").carousel('cycle');
	});
	// 停止轮播
	$(".pause-slide").click(function() {
		$("#myCarousel").carousel('pause');
	});
	// 循环轮播到上一个项目
	$(".prev-slide").click(function() {
		$("#myCarousel").carousel('prev');
	});
	// 循环轮播到下一个项目
	$(".next-slide").click(function() {
		$("#myCarousel").carousel('next');
	});
	// 循环轮播到某个特定的帧
	$(".slide-one").click(function() {
		$("#myCarousel").carousel(0);
	});
	$(".slide-two").click(function() {
		$("#myCarousel").carousel(1);
	});
	$(".slide-three").click(function() {
		$("#myCarousel").carousel(2);
	});

	$("#owl-demo").owlCarousel({
		items: 1,
		autoPlay: true
	});
	$('#myTabs a').click(function(e) {
		e.preventDefault()
		$(this).tab('show')
	});

});</script>
	</body>
</html>