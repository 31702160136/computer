<!DOCTYPE html>
<html class="x-admin-sm">
	<head>
		<meta charset="UTF-8">
		<title>栏目管理模块</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
		<script type="text/javascript" src="./js/xadmin.js"></script>
		<script type="text/javascript" src="./js/cookie.js"></script>
		<script src="js/host.js"></script>
		<script src="js/is_login.js"></script>
		<script src="js/time_stamp_date.js"></script>
		<script src="js/checkbox.js"></script>
		<link rel="stylesheet" href="./css/font.css">
		<link rel="stylesheet" href="./css/xadmin.css">
		<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
		<!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    	.layui-row{
    		float: left;
    		height: 30px;
    		margin-bottom: 10px;
    	}
    	.addBtn{
    		margin-bottom: 10px;
    		padding-left: 170px;
    	}
    </style>
	</head>
	
	<body>
		<div class="x-nav">
			<span class="layui-breadcrumb">
		        <a href="">首页</a>
		        <a href="">演示</a>
	       		<a><cite>栏目管理</cite></a>
      		</span>
      		<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
			<i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
		</div>
		<div class="x-body">
			<div class="layui-row">
				<form class="layui-form layui-col-md12 x-so layui-form-pane">
					<input id="columnName" class="layui-input" placeholder="栏目名">
				</form>
			</div>
			<div class="addBtn">
				<button id="addColumnBtn" name="addColumnBtn" class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon"></i>添加</button>
			</div>
			
			<!--<blockquote class="layui-elem-quote" style="color: red;">此页面为后台栏目管理页面，管理员务必慎重操作！</blockquote>-->
			<xblock>
				<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
			</xblock>
      </table>
			<table class="layui-table x-admin">
				<thead>
					<tr>
						<th width="20">
			              	<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
			            </th>
						<th width="70">ID</th>
						<th>栏目名</th>
						<th width="150">创建时间</th>
						<th width="150">更新时间</th>
						<th width="70">排序</th>
						<th width="50">状态</th>
						<th width="150">操作</th>
				</thead>
				<tbody class="x-cate" id="columnList">
				
				</tbody>
			</table>
			
			<div class="page">
		        <div>
			          <a class="prev"  onclick="jian()" style="cursor:pointer">&lt;&lt;</a>
			          <a id="page1" class="num" onclick="pageOn('page1')" style="cursor:pointer">0</a>
			          <span id="page2" class="current" onclick="pageOn('page2')" style="cursor:pointer">1</span>
			          <a id="page3" class="num" onclick="pageOn('page3')" style="cursor:pointer">2</a>
			          <a id="page4" class="num" onclick="pageOn('page4')" style="cursor:pointer">3</a>
			          <a id="sum" class="num" onclick="pageOn('sum')" style="cursor:pointer">489</a>
			          <a class="next"  onclick="jia()" style="cursor:pointer">&gt;&gt;</a>
		        </div>
		    </div>
		</div>
		<script>
			//调用查询栏目刷新页面
			select_column();
			
			/*	栏目查询：
			 * 
			 * 		select_column()
			 * */
			function select_column(){
				$.ajax({
					type:"get",
					url: host + "controller_b/select_columns.php",
					async:true,
					datatype:'json',
					data:{
						page: getQueryVariable("page"),
						size: 10
					},
					success: function(data){
						var res=JSON.parse(data);
						var total_page=res.data.total_page;
						var category=res.data.data;
						if (res.status) {
							//防止每次刷新以后都添加一次
             			    $("#columnList").html(""); 
//							var columnList = document.getElementById('columnList');
//							//获取columnList的tr属性长度
//							var len = $("#columnList").find("tr").length;
//							//如果len长度大于0，删除所有行数
//							if(len >0){
//								$("#columnList").find('tr').remove();
//							}
							$.each(category, function(index,item) {
								var id = item.id;
								var title = item.title;
								var creation_time = item.creation_time;
								var modify_time = item.modify_time;
								var index = item.index;
								var is_status = item.is_status;
								var list = 
									'<tr>'+
										'<td>'+
											'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
												'<i class="layui-icon">&#xe605;</i>'+
											'</div>'+
										'</td>'+
										'<td>'+id+'</td>'+
										'<td>'+title+'</td>'+
										'<td>'+getMyDate(creation_time)+'</td>'+
										'<td>'+getMyDate(modify_time)+'</td>'+
										'<td>'+
											'<input type="text" class="layui-input x-sort" onchange="member_sort(this,'+id+')"  value='+index+'>'+
										'</td>'+
										'<td class="td-status"><span id="status'+id+'" class="layui-btn layui-btn-warm" onclick="member_stop(this,'+id+','+is_status+')">已停用</span></td>'+
										'<td class="td-manage">'+
											"<button class=\"layui-btn layui-btn-xs\" onclick=\"member_edit(this,"+id+","+"'"+title+"'"+")\"><i class=\"layui-icon\">&#xe642;</i>编辑</button>"+
											'<button class="layui-btn-danger layui-btn layui-btn-xs" onclick="member_del(this,'+id+')"><i class="layui-icon">&#xe640;</i>删除</button>'+
										'</td>'+
									'</tr>';
								$("#columnList").append(list);
								if(is_status==1){
									$("#status"+id).removeClass('layui-btn-warm');
									$("#status"+id).addClass('layui-btn-normal').html('已启用');
								}
							});
							
							//分页
							pagefun(total_page);
						}else{
							alert("栏目获取失败");
						}
			      	},
				    error : function () {
				      	document.write("error");
				    }
				});
			}
			
			/* 	栏目创建：
			 * 		
			 * */
			$("#addColumnBtn").click(function(){
				var columnName = $("#columnName").val();
				if(columnName == ""){
					alert("请输入栏目名称");
				}else{
					$.ajax({
						type:"post",
						url: host + "controller_b/create_column.php",
						async:true,
						data:{
							"title": columnName,
						},
						success: function(data){
							var res=JSON.parse(data);
							if (res.status) {
								select_column();
								layer.msg('栏目添加成功',{icon: 1,time:2000});
							}else{
								layer.msg('栏目添加失败，名称重复',{icon: 2,time:2000});
							}
				      	},
					    error : function () {
					      	document.write("请联系维护人员");
					    }
					});
				}
			});
			
			/*	栏目编辑：
			 * 		
			 * 		修改栏目排序
			 * */
			function member_sort(obj,id){
				var indexval = $(obj).val();
				$.ajax({
					type:"post",
					url: host + "controller_b/modify_column.php",
					async:true,
					data:{
						"id": id,
						"index": indexval
					},
					success:function(data){
						var res=JSON.parse(data);
						if (res.status) {
							select_column();
							layer.msg('重新排序成功!',{icon: 1,time:1000});
						} else{
							layer.msg('重新排序失败，请联系维护人员',{icon: 2,time:2000});
						}
					},
					error: function(){
						document.write("请联系维护人员");
					}
				});
			}
			
			/*	栏目编辑：
	      	 * 
	      	 * 		修改栏目名称
	      	 **/
	      	function member_edit(obj,id,title){
			//JQ的member_edit(this,"+系部概括+")转换成js就是member_edit(this,系部概括)，
			//因为英文和中文要用引号括住，所以JQ要这样写："member_edit(this,"+"'"+title+"'"+")转换成js就是member_edit(this,"系部概括")
				layer.prompt({
					formType: 0,
					value: title,
					title: '修改栏目名称',
					//area: ['1000px', '550px'] //自定义文本域宽高
				},function(value, index, elem){
						$.ajax({
							type:"post",
							url:host + "controller_b/modify_column.php",
							async:true,
							data:{
								"id": id,
								"title": value
							},
							success: function(data){
								var res = JSON.parse(data);
								if (res.status) {
									select_column();
									layer.msg('修改栏目成功!',{icon: 1,time:1000});
								} else{
									layer.msg('修改栏目失败!',{icon: 2,time:2000});
								}
							},
							error:function(){
								document.write("error");
							}
						});
					  layer.close(index);
				});
			}
	      		
	      	/* 栏目编辑：
		  	 * 
			 * 		开启，停用
			 * 		改变栏目状态
			 * */
	      	function member_stop(obj,id,is_status){
	      		if(is_status == 0){
		      		layer.confirm('确认要启用吗？',function(index){
		                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-warm');
		                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-normal').html('已启用');
		                layer.msg('已启用!',{icon: 6,time:1000});
		                $.ajax({
							type:"post",
							url: host + "controller_b/modify_column_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	select_column();
								}else{
									alert("状态修改失败");
								}
					      	},
						    error : function () {
						      	document.write("error");
						    }
						});
		         	});
		      	}else{
		      		layer.confirm('确认要停用吗？',function(index){
		      			$(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-normal');
		                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-warm').html('已停用');
		                layer.msg('已停用!',{icon: 5,time:1000});
			             $.ajax({
							type:"post",
							url: host + "controller_b/modify_column_status.php",
							async:true,
							data:{
								"id": id
							},
							success: function(data){
								var res=JSON.parse(data);
								if (res.status) {
							      	select_column();
								}else{
									alert("状态修改失败");
								}
					      	},
						    error : function () {
						      	document.write("error");
						    }
						});
			        });
		     	}
	      	}	
	      	    	
			/* 单个栏目删除：
			 * 
			 * 		member_del（）
			 * */
			function member_del(obj, id) {
				layer.confirm('确认要删除吗？', function(index) {
					$.ajax({
						type:"post",
						url: host + "controller_b/delete_columns.php",
						async:true,
						data:{
							"ids[]": id
						},
						success: function(data){
							var res = JSON.parse(data);
							if (res.status) {
								select_column();
								layer.msg('已删除!', {
									icon: 1,
									time: 1000
								});
							} else{
								layer.msg('删除失败!', {
									icon: 2,
									time: 2000
								});
							}
						},
						error:function(){
							document.write("error");
						}
					});
					
				});
			}
			/* 多个栏目删除：
			 * 
			 * 		delAll（）
			 * */
			function delAll(argument) {
				var arrayData = tableCheck.getData();
				layer.confirm('确认要删除ID为 '+arrayData+' 的栏目吗？', function(index) {
					$.ajax({
						type:"post",
						url:host+"controller_b/delete_columns.php",
					  	data:{
					  		"ids":arrayData
					  	},
					  	success:function(data){
					        	var res=JSON.parse(data);
					        	if (res.status) {
									select_column();
									layer.msg('已删除!', {
										icon: 1,
										time: 1000
									});
								} else{
									layer.msg('请选择要删除的栏目', {
										icon: 2,
										time: 2000
									});
								}
					    },
					    error:function(){
							document.write("error");
						}
					});
				});
			}
			    	
			//渲染多选框事件
		   	rendering_checkbox();
			    	
			    	
			    	
	      	//  页数变量
		    var pageSum=0;
		    //页数加
		   	function jia(){
		   		if(parseInt($("#page2").prop("innerHTML"))<pageSum){
		   			var page=parseInt($("#page2").prop("innerHTML"))+1;
		   			window.location.href=window.location.origin+window.location.pathname+"?page="+page;
		   		}
		   	}
		   	//页数减
		   	function jian(){
		   		if(parseInt($("#page2").prop("innerHTML"))>1){
		   			var page=parseInt($("#page2").prop("innerHTML"))-1;
		   			window.location.href=window.location.origin+window.location.pathname+"?page="+page;
		   		}
		   	}
		   	//跳页
		   	function pageOn(id){
		   		var page=parseInt($("#"+id).prop("innerHTML"));
		   		window.location.href=window.location.origin+window.location.pathname+"?page="+page;
		   	}
		   	init();
			//初始化
			function init(){
				var page=getQueryVariable("page");
				//页数初始化
				if(page){
					$("#page1").text(parseInt(page)-1);
			 		$("#page2").text(parseInt(page));
			 		$("#page3").text(parseInt(page)+1);
			 		$("#page4").text(parseInt(page)+2);
				}else{
					page=1;
				}
		   	}
		   	//获取链接get参数
			function getQueryVariable(variable){
		        var query = window.location.search.substring(1);
		        var vars = query.split("&");
		        for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable){return pair[1];}
		       }
		       return(false);
			}
		   	function pagefun(pageVar){
		   		pageSum=parseInt(pageVar);
   				//页数范围控制
   				if(pageSum=>4){
   					$("#sum").text(pageSum);
   				}else if(pageSum==2){
   					$("#page1").text(parseInt(page)-1);
   					$("#page2").text(parseInt(page));
   					$("#page3").text(parseInt(page)+1);
   					$("#page4").hide();
   					$("#sum").hide();
   				}else if(pageSum==1){
   					$("#page1").text(parseInt(page)-1);
   					$("#page2").text(parseInt(page));
   					$("#page3").hide();
   					$("#page4").hide();
   					$("#sum").hide();
   				}
   				var page2=parseInt($("#page2").prop("innerHTML"));
	   			if((page2+2)===pageSum||(page2+1)===pageSum){
	   				$("#page4").hide();
	   				$("#sum").hide();
	   			}
	   			if(page2===pageSum){
	   				$("#page3").hide();
	   				$("#page4").hide();
	   				$("#sum").hide();
	   			}
	   			if(page2===1){
	   				$("#page1").hide();
	   			}
		   	}
		   	
		</script>
	</body>
</html>