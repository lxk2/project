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
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>
  分类<?php if(empty($_GET['id'])): ?>添加<?php else: ?>编辑<?php endif; ?>
  </strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('',['id'=>$_GET['id']]);?>">  
      <div class="form-group">
        <div class="label">
          <label>分类名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="cate_name" value="<?php echo ((isset($data['cate_name']) && ($data['cate_name'] !== ""))?($data['cate_name']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group sele">
        <div class="label">
          <label>父级分类：</label>
        </div>
        <div class="field">
          <select name="parent_id" class="input w50" <?php if(empty($_GET['id'])){ echo 'onchange="choose(this)"';}?> >
			<option value="0">顶级分类</option>
			<?php if(is_array($cate)): foreach($cate as $key=>$value): if(empty($_GET['id'])): if($value['parent_id'] == 0): ?><option  value="<?php echo ($value['id']); ?>"><?php echo ($value['cate_name']); ?></option><?php endif; ?>
			<?php else: ?>
			<option <?php if($data['id'] == $value['id']){ echo 'selected'; } ?> value="<?php echo ($value['id']); ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$value['level']-1); echo ($value['cate_name']); ?></option><?php endif; endforeach; endif; ?>
		  </select>
          <div class="tips"></div>
        </div>
      </div>
		
      <div class="form-group slec">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
	function choose(obj) {
		var option = $(obj).val();
		var str = $(obj).find('option:selected').text();
		if(option == 0 || option == ''){
			$(obj).parents('.sele').nextAll('.sele').remove();
			if(option == ''){
				$(obj).prop('name','');
			}
			return;
		}
		$.ajax({
			type:'get',
			url:'<?php echo U();?>',
			data:{
				parent_id:option,
				str:str,
			},
			dataType:'text',
			success:function(data) {
				$(obj).prop('name','parent_id');
				$(obj).parents('.sele').nextAll('.sele').remove();
				$('.slec').before(data);
			},
			error:function(error) {
				alert('网络异常~');
			}
		})
	}
</script>

</body>
</html>