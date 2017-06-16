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
  新闻<?php if(empty($_GET['id'])): ?>添加<?php else: ?>编辑<?php endif; ?>
  </strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo U('',['id'=>$_GET['id']]);?>">  
      <div class="form-group">
        <div class="label">
          <label>新闻标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="title" value="<?php echo ((isset($res['title']) && ($res['title'] !== ""))?($res['title']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>新闻分类：</label>
        </div>
        <div class="field">
          <select name="category_id" class="input w50" >
			<option value="">------请选择新闻分类------</option>
			<?php if(is_array($cate)): foreach($cate as $key=>$value): ?><option <?php if(($res['category_id']) == $value['id']): ?>selected<?php endif; ?> value="<?php echo ($value['id']); ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$value['level']-1); echo ($value['cate_name']); ?></option><?php endforeach; endif; ?>
		  </select>
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>新闻主图：</label>
        </div>
        <div class="field">
          <!-- Button trigger modal -->
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="news_image(a)">
				点击浏览
			</button>
			<div id="queue_a">
				<ul>
					<li class="first" style="float:left;width:100px;text-align:center;padding:10px;box-sizing:content-box;">
					<img src="<?php echo ((isset($res['image']) && ($res['image'] !== ""))?($res['image']):''); ?>" style="display:bolck;width:100px;height:100px;margin-bottom:10px;"><button type="button" onclick="del(this)">删除</button><input type="hidden" name="image" value="<?php echo ((isset($res['image']) && ($res['image'] !== ""))?($res['image']):''); ?>">
					</li>
					
				</ul>
			</div>
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>发布人：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="publicsher" value="<?php echo ((isset($res['publicsher']) && ($res['publicsher'] !== ""))?($res['publicsher']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>来源：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="source" value="<?php echo ((isset($res['source']) && ($res['source'] !== ""))?($res['source']):''); ?>" />
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>新闻详情：</label>
        </div>
        <div class="field">
          <!-- 加载编辑器的容器 -->
		<textarea id="container" name="content" type="text/plain" style="height:300px;">
			<?php echo ((isset($res['news_desc']['content']) && ($res['news_desc']['content'] !== ""))?($res['news_desc']['content']):''); ?>
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
		<?php if(empty($_GET['id'])): ?><!-- 创建时间 -->
	  <input type="hidden" name="create_time" value="<?php echo time();?>"><?php endif; ?>
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">新闻主图</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer" style="clear:both;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
	// 点击新闻主图触发事件
	function news_image(func) {
		$.ajax({
			type:'get',
			url:'<?php echo U("Goods/upload");?>',
			data:{},
			dataType:'html',
			success:function(data) {
				$('#myModal').find('.modal-body').empty();
				$('#myModal').find('.modal-body').append(data);
				// 更改save按钮中绑定的事件
				$('#myModal').find('.btn-primary').attr('onclick','save_image('+ func +')');
			},
			error:function(e) {
				alert('网络错误');
			}
		})
	}
	
	// 点解save触发事件
	function save_image(func) {
		var pic = $('#queue_list').find('li').length;
		if(pic == 0) {
			alert('请上传图片');
			return;
		}
		// 执行函数
		eval(func)();
	}
	// 保存主图函数
	function a() {
		$('#queue_a').find('.first').nextAll('li').remove();
		$('#queue_a').find('.first').empty();
		var first = $('.SWFUpload_0_0').html();
		$('#queue_a').find('.first').append(first);
		// 修改input name
		$('#queue_a').find('.first').find('input[type="hidden"]').prop('name','image');
	}
	
	// 删除按钮事件
	function del(obj) {
		$(obj).parents('li').empty();
	}
</script>

</body>
</html>