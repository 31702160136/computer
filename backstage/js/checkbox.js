//渲染多选框事件
function rendering_checkbox(){
	$(document).on('click', '#icheckbox',function() {
		if($(this).hasClass('layui-form-checked')) {
			$(this).removeClass('layui-form-checked');
			if($(this).hasClass('header')) {
				$(".x-admin .layui-form-checkbox").removeClass('layui-form-checked');
			}
		} else {
			$(this).addClass('layui-form-checked');
			if($(this).hasClass('header')) {
				$(".x-admin .layui-form-checkbox").addClass('layui-form-checked');
			}
		}
	});
}