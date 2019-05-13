<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.1</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
   
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/host.js" type="text/javascript" charset="utf-8"></script>
    <script src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <script type="text/javascript" src="./js/cookie.js"></script>
     <link rel="stylesheet" href="./css/font.css">
	<link rel="stylesheet" href="./css/xadmin.css">

</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">计算机工程系后台管理登录</div>
        <div id="darkbannerwrap"></div>
        
        <form class="layui-form" enctype="multipart/form-data">
            <input name="img" id="img" type="file" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" id="btn_OK">
            <hr class="hr20" >
        </form>
    </div>

    <script>
    	$("#btn_OK").click(function(){
				var img = $("#img").prop('files');//获取图片信息
				var data=new FormData();
				data.append("s",img[0]);//获取图片
				data.append("f",1);//表单数据
				$.ajax({
					type:"POST",
					url: "http://localhost:8080/computer/api/controller_b/test1.php",
					data:data,
					cache: false,//必须写
                	processData: false,//必须写
                	contentType: false,//必须写
					success: function(data){
						console.log(data);
			      	},
				    error : function () {
				      	document.write("error");
				    }
				});
			});
//      $(function  () {
//          layui.use('form', function(){
//            var form = layui.form;
//            // layer.msg('玩命卖萌中', function(){
//            //   //关闭后的操作
//            //   });
//            //监听提交
//            form.on('submit(login)', function(data){
//              // alert(888)
//              layer.msg(JSON.stringify(data.field),function(){
//                  location.href='index.html'
//              });
//              return false;
//            });
//          });
//      })

        
    </script>

    
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>