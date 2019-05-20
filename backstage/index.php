<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>茂名职业技术学院-计算机工程系</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    
		<!--设置不缓存-->
		<!--<meta http-equiv="Expires" content="0">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-control" content="no-cache">
		<meta http-equiv="Cache" content="no-cache">-->
    <script src="js/jquery.min.js"></script>
    <script src="js/md5.min.js"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script type="text/javascript" src="./js/cookie.js"></script>
	<script src="js/host.js"></script>
	<script src="js/is_login.js"></script>
	<script src="js/tools.js"></script>
    <link rel="stylesheet" href="./css/font.css">
	<link rel="stylesheet" href="./css/xadmin.css">
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a>计算机工程系后台管理</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a id="name"></a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('修改密码','admin_chang_pwd.php',500,300)" target="_parent">修改密码</a></dd>
              <dd><a id="out_login">退出</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="/">前台首页</a></li>
        </ul>
        
    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
        	
        	<li>
                <a _href="admin_list.php">
                    <i class="iconfont">&#xe726;</i>
                    <cite>用户管理</cite>
                </a>
            </li>
        	
        	
        	<li>
                <a _href="column_list.php">
                    <i class="iconfont">&#xe723;</i>
                    <cite id="chaxunlanmu">栏目管理</cite>
                </a>
            </li>
        	
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b4;</i>
                    <cite>新闻管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="news_general_list.php">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>所有新闻</cite>
                        </a>
                    </li>
                </ul>
                <ul class="sub-menu">
                    <li>
                        <a _href="news_slideshow_list.php">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>轮播新闻</cite>
                        </a>
                    </li>
                </ul>
                <ul class="sub-menu">
                    <li>
                        <a _href="news_recycle_bin.php">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>回收站</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <!--<li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ce;</i>
                    <cite>系统统计</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="echarts1.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>拆线图</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="echarts2.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>柱状图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts3.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>地图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts4.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>饼图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts5.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>雷达图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts6.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>k线图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts7.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>热力图</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="echarts8.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>仪表图</cite>
                        </a>
                    </li>
                </ul>
            </li>-->
        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
          </ul>
          
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='./welcome.php' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
          <div id="tab_show"></div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©17移动互联1班  v1.0 All Rights Reserved</div>  
    </div>
    <!-- 底部结束 -->
    
    <script src="js/host.js"></script>
    <script>
    	
    	
		var name=decodeURI(getQueryVariable("name"));
		$("#name").text(name);
    	/**
		 * 退出登录
		 */
		$("#out_login").click(function(){
			$.ajax({
				type:"get",
				url: host + "controller_b/out_login.php",
				async:true,
				success: function(data){
					var res=JSON.parse(data);
					if(res.status){
						window.location.href="login.php";
					}
				},
			 	error : function () {
			      	document.write("error");
			    }
			});		
		});
    </script>
</body>
</html>