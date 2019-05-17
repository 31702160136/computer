/**
 * 	查询普通新闻
 *		query_generalNews()
 */
function query_generalNews(){
	$.ajax({
		type: "get",
	url: host + "controller_b/select_news.php",
	async: true,
	datatype: 'json',
	success: function(data) {
		var res = JSON.parse(data);
		var total_page = res.data.total_page;
		var category = res.data.data;
		if(res.status) {
			//防止每次刷新以后都添加一次
           	$("#newsList").html(""); 
			$.each(category, function(index, item) {
				var id = item.id;
				var title = item.title;
				var content = item.content;
				var contributor = item.contributor;
				var cover = item.cover;
				if(cover == "") {
					var cover = window.location.host + "/computer/backstage/images/no_photo.jpg";
				}
				var slideshow_cover = item.slideshow_cover; //轮播图片
				var is_hot = item.is_hot;
				var is_top = item.is_top;
				var is_status = item.is_status;
				var column = item.column;
				var column_id = item.column_id;
				var user_id = item.user_id;
				var creation_time = item.creation_time;
				var doEditItem=JSON.stringify(slideshow_cover);
				var list = 
					'<tr>'+
						'<td>'+
							'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
								'<i class="layui-icon">&#xe605;</i>'+
							'</div>'+
						'</td>'+
						'<td align="center">'+id+'</td>'+
						'<td><img src="http://'+cover+'" /></td>'+
						'<td><i class="layui-icon x-show"></i>'+title+'</td>'+
						'<td align="center">'+column+'</td>'+
						'<td align="center">'+contributor+'</td>'+
						'<td>'+getMyDate(creation_time)+'</td>'+
						'<td class="td-manage">'+
							'<button id="status'+id+'" class="td-status layui-btn layui-btn-xs layui-btn-disabled" onclick="status_edit(this,'+id+','+is_status+')">停用</button>'+
							'<button id="top'+id+'" class="layui-btn layui-btn-disabled" onclick="top_edit(this,'+id+','+is_top+')">置顶</button>'+
							'<button id="hot'+id+'" class="layui-btn layui-btn-xs  layui-btn-disabled" onclick="hot_edit(this,'+id+','+is_hot+')">热点</button>'+
						'</td>'+
						'<td class="td-manage">'+
							'<button id="slideshow'+id+'" class="layui-btn layui-btn-warm" onclick="uploadFile(this,'+id+','+doEditItem.replace(/\"/g,"'")+')"><i class="layui-icon layui-icon-set" style="font-size: 10px; "></i>设置轮播新闻</button>'+
							'<button class="layui-btn layui-btn-danger" onclick="member_del(this,'+id+',)"><i class="layui-icon">&#xe640;</i>删除</button>'+
						'</td>'+
					'</tr>';
				$("#newsList").append(list);
				if (slideshow_cover != null || slideshow_cover != "") {
					$("#slideshow"+id).removeClass('layui-btn-warm');
					$("#slideshow"+id).addClass('layui-btn-disabled').html('已设轮播新闻');
				}
				if (slideshow_cover == null || slideshow_cover == "") {
					$("#slideshow"+id).removeClass('layui-btn-disabled');
					$("#slideshow"+id).addClass('layui-btn-warm').html('设置轮播新闻');
				}
				if(is_hot==1){
					$("#hot"+id).removeClass('layui-btn-disabled');
					$("#hot"+id).addClass('layui-btn-danger');
				}
				if(is_top==1){
					$("#top"+id).removeClass('layui-btn-disabled');
					$("#top"+id).addClass('layui-btn-xs');
				}
				if(is_status==1){
					$("#status"+id).removeClass('layui-btn-disabled');
					$("#status"+id).addClass('layui-btn-normal').html('启用');
				}
			});
		} else {
			alert("新闻获取失败");
		}
	},
	error: function() {
		document.write("error");
		}
	});
}

/**
 * 	查询轮播新闻
 *		query_broadCastNews()
 */
function query_broadCastNews(){
	$.ajax({
		type: "get",
		url: host + "controller_b/select_slideshow.php",
		async: true,
		datatype: 'json',
		success: function(data) {
			var res = JSON.parse(data);
			var total_page = res.data.total_page;
			var category = res.data.data;
			if(res.status) {
				//防止每次刷新以后都添加一次
       			$("#newsList").html(""); 
				$.each(category, function(index, item) {
					var id = item.id;
					var news_id = item.news_id;
					var title = item.title;
					var slideshow_cover = item.slideshow_cover; //轮播图片
					var column = item.column;
					var contributor = item.contributor;
					var index = item.index;
					var is_status = item.is_status;
					var creation_time = item.creation_time;
					var doEditItem=JSON.stringify(slideshow_cover);
					var list = 
						'<tr>'+
							'<td>'+
								'<div id="icheckbox" class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="'+id+'">'+
									'<i class="layui-icon">&#xe605;</i>'+
								'</div>'+
							'</td>'+
							'<td align="center">'+news_id+'</td>'+
							'<td><img src="http://'+slideshow_cover+'" /></td>'+
							'<td><i class="layui-icon x-show"></i>'+title+'</td>'+
							'<td align="center">'+column+'</td>'+
							'<td>'+getMyDate(creation_time)+'</td>'+
							'<td>'+
								'<input type="text" class="layui-input x-sort" onchange="index_edit(this,'+id+')"  value='+index+'>'+
							'</td>'+
							'<td class="td-manage">'+
								'<button id="status'+id+'" class="td-status layui-btn layui-btn-xs layui-btn-disabled" onclick="status_edit(this,'+id+','+is_status+')">已停用</button>'+
							'</td>'+
							'<td class="td-manage">'+
								'<button class="layui-btn layui-btn-danger" onclick="cancel_slideshow(this,'+id+','+news_id+')"><i class="layui-icon">&#xe640;</i>删除</button>'+
							'</td>'+
						'</tr>';
						$("#newsList").append(list);
						if(is_status==1){
							$("#status"+id).removeClass('layui-btn-disabled');
							$("#status"+id).addClass('layui-btn-normal').html('已启用');
						}
				});
			} else {
				alert("新闻获取失败");
			}
		},
		error: function() {
			document.write("error");
		}
	});
}