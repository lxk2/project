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
  模型<?php if(empty($_GET['id'])): ?>添加<?php else: ?>编辑<?php endif; ?>
  </strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('',['id'=>$_GET['id']]);?>">  
      <div class="form-group">
        <div class="label">
          <label>模型名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="type_name" value="<?php echo ((isset($res['type_name']) && ($res['type_name'] !== ""))?($res['type_name']):''); ?>" />
          <div class="tips"></div>
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