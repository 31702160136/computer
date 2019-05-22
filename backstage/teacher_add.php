<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>新闻管理==>所有新闻页面==>添加普通新闻</title>
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
					<label for="newTitle" class="layui-form-label">姓名</label>
					<div class="layui-input-inline">
						<input type="text" id="title" name="title" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="newTitle" class="layui-form-label">职称</label>
					<div class="layui-input-inline">
						<input type="text" id="title" name="title" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="newTitle" class="layui-form-label">毕业院校</label>
					<div class="layui-input-inline">
						<input type="text" id="title" name="title" lay-verify="required" autocomplete="off" class="layui-input">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label for="newTitle" class="layui-form-label">简介</label>
					<div class="layui-input-inline">
						<textarea name="jianjie" rows="10" cols="70" placeholder="请输入教师经历"></textarea>
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label">性别</label>
					<div class="layui-input-block">
						<input type="radio" name="sex" title="男" checked="checked" value="1">
						<input type="radio" name="sex" title="女" value="0">
					</div>
				</div>
				
				<div id="coverPhoto" class="layui-form-item">
					<label for="coverPhotoLabel" class="layui-form-label">头像</label>
					<div class="layui-input-inline">
						<input type="file" name="coverPhotoclick" id="coverPhotoclick" />
					</div>
				</div>
				
				<div id="rotationPhoto" class="layui-form-item photo1">
					<label for="rotationPhotoLabel" class="layui-form-label">照片</label>
					<div class="layui-input-inline">
						<input type="file" name="rotationPhotoclick" id="rotationPhotoclick" />
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
			
		</script>
	</body>
</html>