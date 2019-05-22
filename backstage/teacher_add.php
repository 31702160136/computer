<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>教师风采==>添加教师</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="./js/xadmin.js"></script>
		<script type="text/javascript" src="./js/cookie.js"></script>
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
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
    		textarea{
    			padding: 10px;
    			resize:none;
    		}
    	</style>
	</head>
	<body>
		<div class="x-body">
			<form class="layui-form" enctype="multipart/form-data" method="post">
				<div class="layui-form-item">
					<label for="teacherName" class="layui-form-label">姓名</label>
					<div class="layui-input-inline">
						<input type="text" id="teacherName" name="teacherName" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="teacherTitle" class="layui-form-label">职称</label>
					<div class="layui-input-inline">
						<input type="text" id="teacherTitle" name="teacherTitle" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="teacherSchool" class="layui-form-label">毕业院校</label>
					<div class="layui-input-inline">
						<input type="text" id="teacherSchool" name="teacherSchool" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="teacherContent" class="layui-form-label">简介</label>
					<div class="layui-input-inline">
						<textarea id="teacherContent" name="jianjie" rows="10" cols="70" placeholder="请输入教师经历"></textarea>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">性别</label>
					<div class="layui-input-block">
						<input type="radio" name="teacherSex" title="男" checked="checked" value="1">
						<input type="radio" name="teacherSex" title="女" value="2">
					</div>
				</div>
				
				<div id="coverPhoto" class="layui-form-item">
					<label for="teacherHead_img" class="layui-form-label">头像</label>
					<div class="layui-input-inline">
						<input type="file" name="teacherHead_img" id="teacherHead_img" />
					</div>
				</div>
				
				<div id="rotationPhoto" class="layui-form-item photo1">
					<label for="coverPhotoLabel" class="layui-form-label">照片</label>
					<div class="layui-input-inline">
						<input type="file" name="coverPhotoLabel" id="coverPhotoLabel" />
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
			/**	
			 * 	添加教师
			 */
			layui.use(['form', 'layer'],function() {
                $ = layui.jquery;
                var form = layui.form,
                	layer = layui.layer;
                //监听提交
                form.on('submit(add)',function(data) {
	                var teacherName = $("#teacherName").val();
	                var teacherTitle = $("#teacherTitle").val();
	                var teacherSchool = $("#teacherSchool").val();
	                var teacherContent = $("#teacherContent").val();
	                //获取教师性别状态选项，是否发布
					var teacherSex = $("[name='teacherSex']").filter(":checked").attr("value"); 
					//获取图片信息
	                var teacherHead_img = $("#teacherHead_img").prop('files');
	                var coverPhotoLabel = $("#coverPhotoLabel").prop('files');
					var data = new FormData();
					data.append("name",teacherName);
					data.append("title",teacherTitle);
					data.append("school",teacherSchool);
					data.append("content",teacherContent);
					data.append("sex",teacherSex);
					data.append("cover",coverPhotoLabel[0]);
					data.append("head_img",teacherHead_img[0]);
					$.ajax({
						type:"post",
						url: host + "controller_b/create_teacher.php",
						async:true,
						data: data,
						cache: false,
	                	processData: false,
	                	contentType: false,
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								layer.alert("添加教师成功", {icon: 1},function() {
									// 获得frame索引
									var index = parent.layer.getFrameIndex(window.name);
									//关闭当前frame
									parent.layer.close(index);
									// 可以对父窗口进行刷新 
									x_admin_father_reload();
								});
							}else{
								layer.msg(res.message,{icon: 2,time:2000});
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