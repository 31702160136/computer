<!DOCTYPE html>
<html class="x-admin-sm">

	<head>
		<meta charset="UTF-8">
		<title>添加普通新闻</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/host.js"></script>
		<!--<script src="js/is_login.js"></script>-->
		<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="./js/xadmin.js"></script>
		<script type="text/javascript" src="./js/cookie.js"></script>
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="./css/xadmin.css">
		<script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
	    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"></script>
	    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
	    
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    	<style type="text/css">
    		.addbtn{
    			width: 70px;
    			margin-right: 35px;
    		}
    		/*设置下拉菜单为最顶层*/
    		.columnNameList{
    			position: absolute;
				z-index: 999;
    		}
    	</style>
	</head>

	<body>
		<div class="x-body">
			<form class="layui-form" enctype="multipart/form-data" method="post">
				<div class="layui-form-item">
					<label for="newTitle" class="layui-form-label">新闻标题</label>
					<div class="layui-input-inline">
						<input type="text" id="title" name="title" lay-verify="required" autocomplete="off" class="layui-input" style="width: 700px;">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="newContent" class="layui-form-label">新闻内容</label>
					<div class="layui-input-inline">
						<!-- 加载编辑器的容器 -->	
						<script id="container" type="text/plain" style="width: 900px;height: 500px;"></script>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="newColumn" class="layui-form-label">所属栏目</label>
					<div class="layui-input-inline columnNameList">
						<select id="columnNameList">
							<option id="columnChoice" selected="selected">请选择</option>
						</select>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="contributor" class="layui-form-label">投稿者</label>
					<div class="layui-input-inline">
						<input type="text" id="contributor" name="contributor" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div id="coverPhoto" class="layui-form-item">
					<label for="coverPhotoLabel" class="layui-form-label">封面图片</label>
					<div class="layui-input-inline">
						<input type="file" name="coverPhotoclick" id="coverPhotoclick" />
					</div>
				</div>
				
				<!--<div id="rotationPhoto" class="layui-form-item">
					<label for="rotationPhotoLabel" class="layui-form-label">轮播图片</label>
					<div class="layui-input-inline">
						<input type="file" name="rotationPhotoclick" id="rotationPhotoclick" />
					</div>
				</div>-->
				
				<div class="layui-form-item">
					<label class="layui-form-label">是否发布</label>
					<div class="layui-input-block">
						<input type="radio" name="release" title="是" value="1">
						<input type="radio" name="release" title="否" checked="checked" value="0">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="btn" class="layui-form-label"></label>
					<button class="layui-btn addbtn" lay-filter="add" lay-submit="">添  加</button>
					<input  class="layui-btn layui-btn-warm addbtn" type="reset" value="重  置" />
				</div>
			</form>
		</div>
		<script>
			//实例化编辑器			
			var ue = UE.getEditor('container');
			
			column();
			
			/*
			 * 	获取栏目信息
			 */
			function column(){
				$.ajax({
					type:"get",
					url: host + "controller_b/select_columns.php",
					async:true,
					datatype:'json',
					success: function(data){
						var res=JSON.parse(data);
						var total_page=res.data.total_page;
						var category=res.data.data;
						if (res.status) {
							//绑定tbody列表ID
							var columnList = document.getElementById('columnList');
							//获取columnList的tr属性长度
							var len = $("#columnList").find("tr").length;
							//如果len长度大于0，删除所有行数
							if(len >0){
								$("#columnList").find('tr').remove();
							}
							$.each(category, function(index,item) {
								var id = item.id;
								var title = item.title;
								var list = 
									'<option value="'+title+'" id="'+id+'">'+title+'</option>';
								$("#columnNameList").append(list);
							});
						}else{
							alert("栏目获取失败");
						}
			      	},
				    error : function () {
				      	document.write("error");
				    }
				});
			}
			
			
			/**	
			 * 	添加新闻
			 */
			layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                	layer = layui.layer;
                //自定义验证规则
                form.verify({
                    name: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){5,12}$/, '密码必须5到12位'],
                    repass: function(value) {
                        if ($('#password1').val() != $('#password2').val()) {
                            return '两次密码不一致';
                        }
                    }
           		});
           		
                //监听提交
                form.on('submit(add)',function(data) {
                	//获取编辑器内容
	                var newsContent = ue.getContent();
	                var title = $("#title").val();
	                var contributor = $("#contributor").val();
	                //获取图片信息
	                var coverPhotoclick = $("#coverPhotoclick").prop('files');
//	                var rotationPhotoclick = $("#rotationPhotoclick").prop('files');
	                //获取status状态选项，是否发布
					var release = $("[name='release']").filter(":checked").attr("value"); 
	                //获取option选中状态的动态添加id
					var column_id = $("#columnNameList option:selected").attr("id");
					if (column_id == "columnChoice") {
						layer.msg('请选择此新闻所属栏目',{icon: 3,time:2000});
					}					
					var data = new FormData();
					data.append("title",title);
					data.append("describe","测试");
					data.append("content",newsContent);
					data.append("cover",coverPhotoclick[0]);
//					data.append("slideshow_cover",rotationPhotoclick[0]);
					data.append("type","测试");
					data.append("contributor",contributor);
					data.append("is_status",release);
					data.append("column_id",column_id);
					$.ajax({
						type:"post",
						url: host + "controller_b/create_news.php",
						async:true,
						data: data,
						cache: false,
	                	processData: false,
	                	contentType: false,
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								layer.alert("添加新闻成功", {
									icon: 1
								}, 
								function() {
									// 获得frame索引
									var index = parent.layer.getFrameIndex(window.name);
									//关闭当前frame
									parent.layer.close(index);
									// 可以对父窗口进行刷新 
									x_admin_father_reload();
								});
							}else{
								layer.msg('添加失败',{icon: 2,time:2000});
							}
				      	},
					    error : function () {
					      	document.write("请联系维护人员");
					    }
					});
                   	return false;
            });
		}); 
		</script>
	</body>
</html>