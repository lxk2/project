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
  规格<?php if(empty($_GET['id'])): ?>添加<?php else: ?>编辑<?php endif; ?>
  </strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('',['id'=>$_GET['id']]);?>">  
      <div class="form-group">
        <div class="label">
          <label>规格名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="spec_name" value="<?php echo ((isset($spec['spec_name']) && ($spec['spec_name'] !== ""))?($spec['spec_name']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group sele">
        <div class="label">
          <label>商品模型：</label>
        </div>
        <div class="field">
          <select name="type_id" class="input w50" >
			<option value="">--请选择商品模型--</option>
			<?php if(is_array($type)): foreach($type as $key=>$value): ?><option <?php if($spec['type_id'] == $value['id']){ echo 'selected'; } ?> value="<?php echo ($value['id']); ?>"><?php echo ($value['type_name']); ?></option><?php endforeach; endif; ?>
		  </select>
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>规格选项：</label>
        </div>
        <div class="field">
          <textarea name="items" class="input" style="width:350px;height:150px;resize:none;"><?php echo ((isset($spec['spec_items']) && ($spec['spec_items'] !== ""))?($spec['spec_items']):''); ?></textarea>
          <div class="tips">一行为一个选项</div>
        </div>
      </div>
		
      <div class="form-group">
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

</body>
</html>