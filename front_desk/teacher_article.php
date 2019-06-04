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
			.sidebar .teacher_slide{
				height: 420px;
				overflow-y: scroll;
			}
			.sidebar .teacher_slide > li {
				width: 50%;
				margin: 10px auto;
				position: relative;
				box-shadow: -2px -2px #e7e7e7;
			
			}
			.sidebar .teacher_slide > li img{
				box-shadow: -2px -2px #999;
				position: relative;
				
			}
			.sidebar .teacher_slide > li div{
				height: 80px;
				width: 80px;
				margin: 5px auto;
				border-radius: 40px;
				position: relative;
				background: white;
				overflow: hidden;
			}
			.sidebar .teacher_slide > li span{
				display: inline-block;
				padding: 4px 0;
				width: 100%;
				color: white;
				background: rgb(28,38,69);
				text-align: center;
			}
			.teacher_slide::-webkit-scrollbar {/*滚动条整体样式*/
			        width: 3px;     /*高宽分别对应横竖滚动条的尺寸*/
			        height: 1px;
			    }
			.teacher_slide::-webkit-scrollbar-thumb {/*滚动条里面小方块*/
			        border-radius: 10px;
			         -webkit-box-shadow: inset 0 0 5px rgb(28,39,69);
			        background: rgb(28,39,69);
			        
			    }
			.teacher_slide::-webkit-scrollbar-track {/*滚动条里面轨道*/
					margin-top: 30px;
			        -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
			        border-radius: 10px;
			        background: #EDEDED;
			    }
			.teacher_msg{
				margin-left: 30px;
				text-align: center;
			}
			.teacher_msg img{
				max-width: 180px;
				max-height: 219px;
			}
			.teacher_exp h3{
				border-left: 4px solid rgb(28,39,69);
				padding: 10px;
				padding-left: 20px;
				background: #e7e7e7;
			}
			.teacher_exp span{
				font-size: 18px;
				margin-left: 10px;
			}
			.teacher_exp p{
				margin: 20px  15px;
				text-indent: 25px;
				font-size: 18px;
			}
		</style>
		<!--教师风采开始-->
		<div class="container-fluid" style="margin-top: 40px;">
			<div class="row">
				<div id="news_left" class="col-md-2 sidebar col-md-offset-1 visible-md-inline visible-lg-inline clearfix">
					<h3>教师团队</h3>
					<hr />
					<ul class="teacher_slide clearfix">
					</ul>
				</div>
				<div class="col-md-7 teacher_main clearfix" >
					<div>
						首页 > 教师风采 > <span id="name"></span>
						<hr />
					</div>
					<div class="img_container">
						<div class="teacher_msg clearfix">
						</div>
						<div class="teacher_exp clearfix">
							
						</div>
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
		//		教师列表渲染
		var teacher_url = host+'select_teacher.php?page=0&size=0';
		$.ajax({
			type:"get",
			url:teacher_url,
			async:true,
			success:function (data) {
				var result = JSON.parse(data);
//				渲染侧边栏数据
				if(result['code'] == 200){
					var teacher_list = result['data']['data'];
					$.each(teacher_list,function (index,item) {
						var list = '<li><a href="teacher_article.php?tid='+item['id']+'"><div><img src="'+item['cover']+'"/></div><span>'+item['name']+'</span></a></li>';
						$(".teacher_slide").append(list);
					});	
				}
			}
		});	
		var teacher_id = getQueryVariable('tid');	
		if(teacher_id){
			//请求获得教师信息
			var teacher_msg_url    	= host+'select_teacher_by_id.php?id='+teacher_id; 
			$.ajax({
				type:"get",
				url:teacher_msg_url,
				async:true,
				success:function (data) {
					var result = JSON.parse(data);
					if(result['code'] == 200){
						//提取教师信息
						var msg_result = result['data'];
						$("#name").text(msg_result["name"]);
						var img='<img src="'+msg_result['head_img']+'" alt="" style="margin: 0 auto;"/>';
						//教师信息渲染
						var list = '<div><h3>个人简介</h3><span>姓名：'+msg_result['name']+'</span>'+
								'<span>职称：'+msg_result['title']+'</span><span>毕业院校：'+msg_result['school']+'</span>'+
								'</div><h3>个人经历</h3><p>'+msg_result['content']+'</p>';
						$(".teacher_msg").append(img);
						$(".teacher_exp").append(list);
					}
				}
			});
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