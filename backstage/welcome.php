<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>后台信息</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
        <link rel="stylesheet" href="./css/font.css">
        <link rel="stylesheet" href="./css/xadmin.css">
    </head>
    <body>
    	<br />
    	<fieldset class="layui-elem-field">
    		<legend>管理员信息</legend>
    		<div class="layui-field-box">
                <table class="layui-table" lay-skin="line">
                    <tbody>
                        <tr>
                            <td id="info_username">
                               	账号：admin
                            </td>
                        </tr>
                        <tr>
                            <td id="info_name">
                               	管理员：xxx
                            </td>
                        </tr>
                        <tr>
                            <td id="info_role">
                               	角色：普通管理员
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    	</fieldset>
    	<fieldset class="layui-elem-field">
            <legend>数据统计</legend>
            <div class="layui-field-box">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">
                            <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                                <div carousel-item="">
                                    <ul class="layui-row layui-col-space10 layui-this">
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>栏目数</h3>
                                                <p>
                                                    <cite id="column">66</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>文章数</h3>
                                                <p>
                                                    <cite id="news">12</cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>总访问数</h3>
                                                <p>
                                                    <cite id="visit">99</cite></p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        
        <div class="x-body">
            <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
            <div id="main" style="width: 100%;height:400px;"></div>
        </div>
        
        <fieldset class="layui-elem-field">
            <legend>系统通知</legend>
            <div class="layui-field-box">
                <table class="layui-table" lay-skin="line">
                    <tbody>
                        <tr>
                            <td >
                                <a class="x-a" style="color: red;">茂名职业技术学院 - - - - 计算机后台管理系统 1.0上线了</a>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <a class="x-a">交流qq群: （暂不提供）</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        
        <fieldset class="layui-elem-field">
		    <legend>开发团队</legend>
		    <div class="layui-field-box">
		        <table class="layui-table">
		            <tbody>
		                <tr>
		                    <th>版权所有</th>
		                    <td style="color: red;">17移动互联1班 （ 陈新彬、杨鸿燊、姚升阳 ）
		                </tr>
		                <tr>
		                    <th>开发者</th>
		                    <td style="color: red;">陈新彬、杨鸿燊、姚升阳</td></tr>
		            </tbody>
		        </table>
		    </div>
        </fieldset>
        <script src="js/host.js"></script>
   		<script type="text/javascript" src="js/jquery.min.js"></script>
        <script src="js/echarts.min.js" charset="utf-8"></script>
        <script src="js/bmap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
        // 指定图表的配置项和数据
        option = {
            backgroundColor: '#2c343c',
            title: {
                text: '访问统计',
                left: 'center',
                top: 20,
                textStyle: {
                    color: '#ccc'
                }
            },

            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },

            visualMap: {
                show: false,
                min: 80,
                max: 600,
                inRange: {
                    colorLightness: [0, 2]
                }
            },
            series : [
                {
                    name:'访问来源',
                    type:'pie',
                    radius : '55%',
                    center: ['50%', '50%'],
                    data:[].sort(function (a, b) { return a.value - b.value}),
                    roseType: 'angle',
                    label: {
                        normal: {
                            textStyle: {
                                color: 'rgba(255, 255, 255, 0.5)'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(255, 255, 255, 0.5)'
                            },
                            smooth: 0.2,
                            length: 10,
                            length2: 20
                        }
                    },
                    itemStyle: {
                        normal: {
                            color: '#c23531',
                            shadowBlur: 200,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
		init();
		function init(){
			$.ajax({
				type:"get",
				url:host+"controller_b/statistics_columns.php",
				async:true,
				success:function(res){
					var data=JSON.parse(res);
					var column_sum=0;
					var news_sum=0;
					var visit_sum=0;
					for(var i=0;i<data.data.length;i++){
						//写入访问统计数据
						var item={
							value:parseInt(data.data[i].count),
							name:data.data[i].title
						}
//						console.log(data.data[i].count);
						//写入数据统计数据
						column_sum++;
						news_sum+=parseInt(data.data[i].news_sum);
						visit_sum+=parseInt(data.data[i].count);
						option.series[0].data.push(item);
					}
					myChart.setOption(option);
					$("#column").text(column_sum);
					$("#news").text(news_sum);
					$("#visit").text(visit_sum);
				}
			});
			$.ajax({
				type:"get",
				url:host+"controller_b/select_user.php",
				async:true,
				success:function(res){
					var data=JSON.parse(res);
					$("#info_username").text("账号："+data.data.username);
					$("#info_name").text("姓名："+data.data.name);
					$("#info_role").text("角色："+data.data.role);
				}
			});
		}

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
    </body>
</html>