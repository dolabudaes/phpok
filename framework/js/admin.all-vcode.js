/**
 * ��֤������
 * @���� qinggan <admin@phpok.com>
 * @��Ȩ �������螿Ƽ����޹�˾
 * @��ҳ http://www.phpok.com
 * @�汾 5.x
 * @��Ȩ MIT License <https://www.phpok.com/mit.html>
 * @ʱ�� 2018��08��26��
**/
layui.use(['form','layer'], function(){
	let form = layui.form;
	let layer = layui.layer;
	form.on('checkbox', function(data){
		if(data.elem.checked){
			$(data.elem).attr("checked",true);
		}else{
			$(data.elem).removeAttr("checked");
		}
	});
});