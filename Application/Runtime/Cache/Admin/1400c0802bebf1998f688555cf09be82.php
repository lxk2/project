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
	留言详情
  </strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('',['id'=>$_GET['id']]);?>">  
      <div class="form-group">
        <div class="label">
          <label>姓名：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="user_name" value="<?php echo ((isset($res['name']) && ($res['name'] !== ""))?($res['name']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>所在地区：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="password" value="<?php echo ((isset($res['area']) && ($res['area'] !== ""))?($res['area']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>所在公司：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="repassword" value="<?php echo ((isset($res['company']) && ($res['company'] !== ""))?($res['company']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>联系电话：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="repassword" value="<?php echo ((isset($res['tel']) && ($res['tel'] !== ""))?($res['tel']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>E-mail：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="repassword" value="<?php echo ((isset($res['email']) && ($res['email'] !== ""))?($res['email']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>内容：</label>
        </div>
        <div class="field">
          <!-- 加载编辑器的容器 -->
		<textarea id="container" name="content" type="text/plain" style="height:300px;">
			<?php echo ((isset($res['content']) && ($res['content'] !== ""))?($res['content']):''); ?>
		</textarea>
		<!-- 配置文件 -->
		<script type="text/javascript" src="/Public/Admin/UEditor/ueditor.config.js"></script>
		<!-- 编辑器源码文件 -->
		<script type="text/javascript" src="/Public/Admin/UEditor/ueditor.all.js"></script>
		<!-- 实例化编辑器 -->
		<script type="text/javascript">
        var ue = UE.getEditor('container');
		</script>
          <div class="tips"></div>
        </div>
      </div>
		
      
    </form>
  </div>
</div>

</body>
</html>