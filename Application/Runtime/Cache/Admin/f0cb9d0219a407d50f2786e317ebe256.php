<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
<link rel="stylesheet" href="/Public/Admin/css/admin.css">
<script src="/Public/Admin/js/jquery.js"></script>
<script src="/Public/Admin/js/pintuer.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">
<script src="/Public/Admin/js/bootstrap.min.js"></script>
</head>
<body> 
<script src="/Public/Admin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/uploadify/uploadify.css">

<div class="alert alert-info" role="alert">请上传4M以下大小的图片</div>
<div class="field">
	<input id="file_upload" name="file_upload" type="file" multiple="true">
	<div id="queue_list">
		<ul>
						
		</ul>
	</div>
</div>

<script>

	$(function() {
		$('#file_upload').uploadify({
			'swf'      : '/Public/Admin/uploadify/uploadify.swf',
			'uploader' : '<?php echo U("Goods/upload");?>',
			'buttonText' : '+  点击浏览',
			'height' : 42,
			'width' : 125,
			'fileObjName' : 'pic',
			// file 是一个对象，多张图片的时候file.id是一个连续的
			'onUploadSuccess' : function(file, data, response) {
			
				// 低版本的jq无法解析json对象
				var data = eval("(" + data + ")");
				console.log(data);
				if(data.code == 0){
					var html = '<li class="'+ file.id +'" style="float:left;width:100px;text-align:center;padding:10px;box-sizing:content-box;"><img src="/' + data.msg + '" style="display:bolck;width:100px;height:100px;margin-bottom:10px;"><button type="button" onclick="del(this)">删除</button><input type="hidden" name="pic[]" value="/'+ data.msg +'"></li>';
					$('#queue_list ul').append(html);
					
				}
			}
			
		});
	});
	
	
	
	/*
	function main(obj) {
		$('input[type="hidden"]').prop('name','pic');
		$(obj).nextAll('input[type="hidden"]').prop('name','image');
		$(obj).parents('#queue_list').find('li').css({border:'none'});
		$(obj).parents('li').css({border:'1px solid red'});
		$(obj).parents('#queue_list').find('li').find('button[onclick="main(this)"]').css({visibility:'visible'});
		$(obj).css({visibility:'hidden'});
	}
	*/
	

</script>

</body>
</html>