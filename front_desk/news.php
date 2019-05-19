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
							<ul class="nav navbar-nav navbar-right" data-in = "fadeInDown" data-out = "dadeOutUp">
								<li class="active dropdown">
									<a href="index.php">
										系部首页
									</a>
								</li>
								<?php 
									include "./Util_http.php";
									include "./path.php";
									$url = $host.'select_home.php';
									$result = https_request($url);
									if($result['code'] == 200){
										$column 		= $result['data']['column']; 	 	// 栏目
										$column_news 	= $result['data']['column_news'];	// 首页栏目及相应新闻
										$slideshow      = $result['data']['slideshow'];		// 轮播图
										$cover   		= $result['data']['cover'];			// 图片新闻
										
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
		<section style="margin-top: 40px;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 sidebar col-md-offset-1 visible-md-inline visible-lg-inline clearfix">
						
						<?php
							if(is_array($_GET)&&count($_GET)>0)	//判断是否通过get传值了
						    {	
						        if(isset($_GET["id"]))			//是否存在"id"的参数
						        {
						        	
						            $column_id 		= $_GET['id']; 	//获取栏目id,获取栏目新闻
						            $news_url  		= $host.'select_news_by_column_id.php?column_id='.$column_id;
									$column_url     = $host.'select_columns.php?page=1&size=20'; 
									$news_result	= https_request($news_url);	 // 根据栏目请求新闻
									$column_result	= https_request($column_url); // 获取栏目列表
									$current_column = '';						  // 当前栏目
									foreach ($column_result['data']['data'] as $item) {
										if($item['id'] == $column_id){
											echo '<h2>'.$item['title'].'</h2><ul>';
											$current_column = $item['title'];
										}
									}
									if($news_result['code'] == 200){
										$news_list = $news_result['data']['data']; // 提取新闻列表
										foreach ($news_list as $item) {
											if($item['is_top'] == "1"){
												echo '<li><a href="Article.php?news_id="'.$item['id'].'>'.$item['title'].'</a></li>';
											}
										}		
										echo '</ul></div><div class="col-md-8 main_container"><div class="news_main">
												<p>首页 > '.$current_column.'</p><hr /><ul>';

										foreach ($news_list as $item) {
											echo '<li>
													<time><i class="glyphicon glyphicon-time"></i>'.date("Y-m-d",$item['creation_time']).'</time>
													<div><a href="Article.php?news_id='.$item['id'].'">'.$item['title'].'</a></div>
												</li>';
										}
									}
								}
							}		
						?>
							</ul>
							<div class="paging clearfix">
								<ul>
									<li>共21页</li>
									<li>当前2页</li>
									<li>上一页</li>
									<li>下一页</li>
								</ul>
							</div>
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

		<script>$(function() {

});</script>
	</body>
</html>