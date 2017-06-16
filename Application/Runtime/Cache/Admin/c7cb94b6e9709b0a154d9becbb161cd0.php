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
<style>
	.cur {
		background:lightseagreen;
		border:1px solid lightseagreen;
	}
</style>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<?php if(is_array($res)): foreach($res as $key=>$value): ?><li role="presentation" class="<?php if($active == $value['id']){echo 'active';} ?>"><a href="#<?php echo ($value['id']); ?>" aria-controls="<?php echo ($value['id']); ?>" role="tab" data-toggle="tab"><?php echo ($value['type_name']); ?></a></li><?php endforeach; endif; ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  <?php if(is_array($res)): foreach($res as $key=>$value): ?><div role="tabpanel" class="tab-pane <?php if($active == $value['id']){echo 'active';} ?>" id="<?php echo ($value['id']); ?>">
		<dl>
			<?php if(!empty($value['child'])){ ?>
			<?php foreach($value['child'] as $v){ ?>
			<dt style="clear:both;"><?php echo ($v['spec_name']); ?></dt>
			<?php foreach($v['spec_items'] as $val){ ?>
			<dd id="<?php echo ($val['id']); ?>" style="border:1px solid;float:left;padding:0 5px;margin-right:5px;cursor:pointer;" onclick="cur(this)"><?php echo ($val['items']); ?></dd>
			<?php }}} ?>
		</dl>
	</div><?php endforeach; endif; ?>

  </div>

</div>
<script>
	function cur(obj) {
		$(obj).toggleClass('cur');
		$('.tab-pane').each(function() {
			var cur = $(this).prop('class');
			if(cur.length == 8){
				$(this).find('dl').find('dd').removeClass('cur');
			}
		})
	}
	
</script>

</body>
</html>