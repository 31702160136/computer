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
							<ul class="nav navbar-nav navbar-right" data-in = "fadeInDown" data-out = "dadeOutUp">
								<li class="active">
									<a href="index.php">
										系部首页
									</a>
								</li>
								<?php 
									include_once "./Util_http.php";
									include_once "./path.php";
									$url = $host.'select_home.php';
									$result = https_request($url);
									if($result['code'] == 200){
										$column 		= $result['data']['column']; 	 	// 栏目
										$column_news 	= $result['data']['column_news'];	// 首页栏目及相应新闻
										$slideshow      = $result['data']['slideshow'];		// 轮播图
										$cover   		= $result['data']['cover'];			// 图片新闻
										$bottom_news	= $result['data']['bottom_news'];   // 底部新闻
										
										foreach ($column as $item) {
											if($item['is_status'] == "1"){
												echo 	'<li class="active"><a href="news.php?id='.$item['id'].'">'.$item['title'].'</a></li>';	
											}
										}		
									}
								?>	
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<!--头部 end-->

		<!--轮播图 start-->
		<div id="owl-demo" class="owl-carousel owl-theme slideshow" style="max-width: 1400px;">
			<?php 
					//显示轮播图
					foreach ($slideshow as $item) {
						echo '<a class="item" href="Article.php?news_id='.$item["news_id"].'">
									<img src="http://'.$item['slideshow_cover'].'" alt="'.$item["title"].'" style="max-height:400px">
								</a>';
									
					
					}		
			?>
		</div>
		<!--轮播图 end-->

		<!--图片新闻 start-->
		<div style="background: rgb(243, 241, 244);">
			<div class="container pic_news mb20">
				<hr />
				<div class="row">
					<div class="col-sm-5 col-md-5 visible-lg-inline visible-md-inline  pic_news_left">
						<?php 
							// 图片新闻
							foreach ($cover as $key => $item) {
								if($key == 0){
									echo '<a href="Article.php?news_id='.$item['id'].'"><img src="http://'.$item['cover'].'" alt="" class="img-responsive"/>
										<p>'.$item['title'].'</p></a></div>
										<div id="pic_news_right" class="col-md-7 col-sm-12 pic_news_right" >';
								}
								else if($key > 3){
									break;
								}else{
									echo '<a href="Article.php?news_id='.$item['id'].'">
											<div>
												<img src="http://'.$item['cover'].'"/>
											</div>
											<div>
												<p>'.$item['title'].'</p>
												<div>
													<time>
														<i class="glyphicon glyphicon-time" style="margin-right: 2px;padding-top: 2px;"></i>'.date("Y-m-d",$item['modify_time']).'
													</time>
													<span><i class="glyphicon glyphicon-eye-open"></i>阅读('.$item['count'].')</span>
												</div>
											</div>
										</a>';
								}
							}
						?>
					</div>
				</div>
				<hr />
			</div>
		</div>
		<!--图片新闻 end-->
		<!--文字新闻 strat-->
		<section class="container" style="margin-bottom: 20px;">
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
							<ul>
								<?php 
									//首页系部新闻列表
									$xibu_list = $column_news['xibu']; 	// 获取系部新闻列表
									foreach ($xibu_list as $key => $item) {
										if($key > 4){
											break;
										}
										echo '<li><a href="Article.php?news_id='.$item['id'].'">'.$item['title'].'</a>
											<div><time><i class="glyphicon glyphicon-time"></i>'.date("Y-m-d",$item['creation_time']).'</time>
												<span><i class="glyphicon glyphicon-eye-open"></i>阅读('.$item['count'].')</span>
											</div>
											</li>';
									}
								?>
							</ul>
						</div>
						<div role="tabpanel" class="tab-pane news" id="job">
							<ul>
								<?php 
									//首页招生就业新闻列表
									$job_list = $column_news['zhaosheng']; 	// 获取招生就业新闻列表
									foreach ($job_list as $key => $item) {
										if($key > 4){
											break;
										}
										echo '<li><a href="Article.php?news_id='.$item['id'].'">'.$item['title'].'</a>
											<div><time><i class="glyphicon glyphicon-time"></i>'.date("Y-m-d",$item['creation_time']).'</time>
												<span><i class="glyphicon glyphicon-eye-open"></i>阅读('.$item['count'].')</span>
											</div>
											</li>';
									}
								?>
							</ul>
						</div>
						<div role="tabpanel" class="tab-pane news" id="skill">
							<ul>
								<?php 
									//首页技能竞赛新闻列表
									$skill_list = $column_news['jineng']; 	// 获取招生就业新闻列表
									foreach ($skill_list as $key => $item) {
										if($key > 4){
											break;
										}
										echo '<li><a href="Article.php?news_id='.$item['id'].'">'.$item['title'].'</a>
											<div><time><i class="glyphicon glyphicon-time"></i>'.date("Y-m-d",$item['creation_time']).'</time>
												<span><i class="glyphicon glyphicon-eye-open"></i>阅读('.$item['count'].')</span>
											</div>
											</li>';
									}
								?>
							</ul>
						</div>
					</div>
				</div>
				<!-- 新闻内容容器结束-->

				<!--通知公告-->
				<div class="col-md-4">
					<div class="inform_title">
						通知公告
						
						<?php 
							//首页技能竞赛新闻列表
							$inform_list = $column_news['tongzhi']; 	// 获取招生就业新闻列表
							echo '<a href="news.php?id='.$inform_list[0]['column_id'].'" class="pull-right">更多</a>
									</div>
									<ul class="inform">';
							foreach ($inform_list as $key => $item) {
								if($key > 3){
									break;
								}
								echo '<li>
										<time>
										<span class="day">'.date("d",$item['creation_time']).'</span><span class="month">'.date("Y-m",$item['modify_time']).'</span>
										</time>
										<a href="Article.php?news_id='.$item['id'].'">
											'.$item['title'].'
										</a>
									</li>';
							}
						?>
					</ul>
				</div>
			</div>
		</section>

		<!--文字新闻 end-->
		<div class="container" style="margin-bottom: 0;">
			<div class="row">
				<div class="col-md-12">
					<img src="images/fengge.jpg" style="width: 100%;"/>
				</div>
			</div>
		</div>
		<!--教学科研 start-->
		<?php 
			// 获取底部新闻列表
			$teaching_left = $bottom_news[0];
			$teaching_right= $bottom_news[1];
		?>
		<div style="background: rgb(243, 241, 244);padding-bottom: 100px;padding-top: 20px;">
			<section class="container mt20 mb20">
				<div class="row">
					<div class="teaching_title visible-md-inline visible-lg-inline">
						<h2><span><?php echo $teaching_left['column'];?></span>
							<a href="news.php?id=<?php echo $teaching_left['column_id'];?>">
								更多 >
							</a>
						</h2>
					</div>
					<div class="col-md-6" >
						<div class="thumbnail teaching">
							<?php
								echo '<a href="Article.php?news_id='.$teaching_left['column_id'].'">
								<img src="http://'.$teaching_left['cover'].'" alt="'.$teaching_left['title'].'">
								<div class="teaching_content content_left">
								<i>new</i>
								<h4>'.$teaching_left['title'].'</h4>
								<p>'.$teaching_left['describe'].'</p>
							</div></a>';	
							?>
							
						</div>
					</div>
					<div class="col-md-5 deviation">
						<div class="thumbnail teaching">
							<?php
								echo '<a href="Article.php?news_id='.$teaching_left['column_id'].'">
								<img src="http://'.$teaching_right['cover'].'" alt="'.$teaching_right['title'].'">
								<div class="teaching_content content_left">
									<i>new</i>
									<h4>'.$teaching_right['title'].'</h4>
								</div></a>';	
							?>
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
	
	//超过一定高度导航添加类名
	var nav=$("navbar"); //得到导航对象  
	var win=$(window); //得到窗口对象  
	var sc=$(document);//得到document文档对象。  
	win.scroll(function(){  
	  if(sc.scrollTop()>=100){  
	    nav.addClass("on");   
	  }else{  
	   	nav.removeClass("on");  
	  }  
	})   

	//二级导航  移动端
    $(".m_nav .ul li").click(function() {
		$(this).children("div.dropdown_menu").slideToggle('slow')
        $(this).siblings('li').children('.dropdown_menu').slideUp('slow');				
    });
});</script>
	</body>
</html>