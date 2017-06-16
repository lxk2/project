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
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span><?php if(empty($_GET['id'])): ?>添加<?php else: ?>修改<?php endif; ?>商品</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="">  
      <div class="form-group">
        <div class="label">
          <label>商品名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo ((isset($goods['goods_name']) && ($goods['goods_name'] !== ""))?($goods['goods_name']):''); ?>" name="goods_name"/>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>商品主图：</label>
        </div>
        <div class="field">
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="pic_box(pic_a)">
				+&nbsp;&nbsp;&nbsp;上传主图
			</button>
			<div id="queue_a">
				<ul>
					<li class="first" style="float:left;width:100px;text-align:center;padding:10px;box-sizing:content-box;"></li>
					<?php if(!empty($_GET['id'])): ?><li class="" style="float:left;width:100px;text-align:center;padding:10px;box-sizing:content-box;clear:both;"><img src="<?php echo ($goods['image']); ?>" style="display:bolck;width:100px;height:100px;margin-bottom:10px;"><button type="button" onclick="del(this)">删除</button><input type="hidden" name="image" value="<?php echo ($goods['image']); ?>"></li><?php endif; ?>
				</ul>
			</div>
			<div class="tips">请上传一张(不过你可以试试多张)</div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>商品相册：</label>
        </div>
        <div class="field">
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="pic_box(pic_b)">
				+&nbsp;&nbsp;&nbsp;上传相册
			</button>
			<div id="queue_b">
				<ul>
					<li style="width:100px;text-align:center;padding:10px;box-sizing:content-box;clear:both;"></li>
					<!-- 模板语言里面不能带$符号 -->
					<?php if(!empty($_GET['id'])): if(!empty($goods['goods_pic'])): if(is_array($goods['goods_pic'])): foreach($goods['goods_pic'] as $key=>$value): ?><li class="" style="float:left;width:100px;text-align:center;padding:10px;box-sizing:content-box;"><img src="<?php echo ($value['pic']); ?>" style="display:bolck;width:100px;height:100px;margin-bottom:10px;"><button type="button" onclick="del(this)">删除</button><input type="hidden" name="pic[]" value="<?php echo ($value['pic']); ?>"></li><?php endforeach; endif; endif; endif; ?>
				</ul>
			</div>
			<div class="tips">只会保存前5张哟</div>
        </div>
      </div>

	  <div class="form-group">
        <div class="label">
          <label>规格套餐：</label>
        </div>
        <div class="field">
          <div class="btn-group" role="group" aria-label="...">
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Modal" onclick="spec_box()">
				选择套餐
			</button>
			<div id="package" style="clear:both;">
				
			</div>
			</div>
        </div>
      </div>
      
      <div class="form-group">
        <div class="label">
          <label>商品分类：</label>
        </div>
        <div class="field">
          <select name="category_id" class="input w50" >
			<option value="">------请选择商品分类------</option>
			<?php if(is_array($res['cate'])): foreach($res['cate'] as $key=>$value): ?><option <?php if(($goods['category_id']) == $value['id']): ?>selected<?php endif; ?> value="<?php echo ($value['id']); ?>"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$value['level']-2); echo ($value['cate_name']); ?></option><?php endforeach; endif; ?>
		  </select>
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>商品品牌：</label>
        </div>
        <div class="field">
          <select name="goods_brand_id" class="input w50" >
			<option value="">------请选择商品品牌------</option>
			<?php if(is_array($res['brand'])): foreach($res['brand'] as $key=>$value): ?><option <?php if(($goods['goods_brand_id']) == $value['id']): ?>selected<?php endif; ?> value="<?php echo ($value['id']); ?>"><?php echo ($value['brand_name']); ?></option><?php endforeach; endif; ?>
		  </select>
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>市场价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo ((isset($goods['market_price']) && ($goods['market_price'] !== ""))?($goods['market_price']):''); ?>" name="market_price"/>
          <div class="tips"></div>
        </div>
      </div>
	  
	  <div class="form-group">
        <div class="label">
          <label>网店价：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo ((isset($goods['shop_price']) && ($goods['shop_price'] !== ""))?($goods['shop_price']):''); ?>" name="shop_price"/>
          <div class="tips"></div>
        </div>
      </div>
      
      <div class="form-group">
        <div class="label">
          <label>商品详情：</label>
        </div>
        <div class="field">
          <!-- 加载编辑器的容器 -->
		<textarea id="container" name="content" type="text/plain" style="height:300px;">
			<?php echo ((isset($goods['goods_desc']['content']) && ($goods['goods_desc']['content'] !== ""))?($goods['goods_desc']['content']):''); ?>
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
	  
	  <!-- 创建时间 -->
	  <input type="hidden" name="create_time" value="<?php echo time();?>">
     
      
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
        <h4 class="modal-title" id="myModalLabel">图片上传</h4>
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

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">规格套餐</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer" style="clear:both;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="save_spec()">Save</button>
      </div>
    </div>
  </div>
</div>

<?php if(!empty($_GET['id'])): ?><input id="edit" type="hidden" value="<?php echo ($goods['goods_spec']); ?>">
	<!-- <input id="spec_price" type="hidden" value="<?php echo ($goods['spec_price']); ?>"> -->
	<?php if(is_array($goods['spec_price'])): foreach($goods['spec_price'] as $key=>$value): ?><input class="spec_price" type="hidden" value="<?php echo ($value); ?>"><?php endforeach; endif; endif; ?>

<!-- 其实可以只放一个模态框 -->

<script type="text/javascript">

	// 点击浏览上传触发事件
	function pic_box(func) {
		$.ajax({
			type:'get',
			url:'<?php echo U("Goods/upload");?>',
			data:{},
			dataType:'html',
			success:function(data) {
				$('#myModal').find('.modal-body').html(data);
				// 更改Save 按钮的onclick事件
				$('#myModal').find('.btn-primary').attr('onclick','save_pic('+ func +')');
			},
			error:function(e) {
				alert('网络异常~ =.=');
			}
		})
	}
	// 点击save触发事件
	function save_pic(func) {
		var pic = $('#queue_list').find('li').length;
		if(pic == 0) {
			alert('请上传图片');
			return;
		}
		// 执行函数
		eval(func)();
		// 关闭模态框
		// $('#myModal').modal('hide');
	}
	// 返回第一张图片路径
	function pic_a() {
		$('#queue_a').find('.first').nextAll('li').remove();
		$('#queue_a').find('.first').empty();
		var first = $('.SWFUpload_0_0').html();
		$('#queue_a').find('.first').append(first);
		// 修改input name
		$('#queue_a').find('.first').find('input[type="hidden"]').prop('name','image');
	}
	// 返回相册
	function pic_b() {
		var all = $('#queue_list').html();
		// $('#queue_b').empty();
		$('#queue_b').append(all);
	}
	
	// 点击规格套餐触发事件
	function spec_box() {
		$.ajax({
			type:'post',
			url:'<?php echo U("Goods/spec_items");?>',
			data:{},
			dataType:'html',
			success:function(data) {
				$('#Modal').find('.modal-body').html(data);
			},
			error:function(e) {
				alert('网络错误~ =.=!');
			}
		})
	}
	// 点击save触发事件
	function save_spec() {
		var cur = $('dd[class="cur"]').length;
		if(cur == 0){
			alert('没选规格你点个屁save啊');
			return;
		}
		// 拿到选中的id
		var cur = [];
		$('#Modal').find('dd.cur').each(function(){
			cur.push($(this).prop('id'));
		});
		// 把数据传到Goods/spec_items处理
		$.ajax({
			data:'get',
			url:'<?php echo U("Goods/spec_items");?>',
			data:{id:cur},
			dataType:'html',
			success:function(data) {
				$('#package').empty();
				$('#package').append(data);
				// 关闭模态框
				// $('#myModal').modal('hide');
			},
			error:function(e) {
				alert('网络错误~ =.=!');
			}
		})
	}
	
	// 删除按钮事件
	function del(obj) {
		$(obj).parents('li').remove();
	}
	
</script>
<script>
			$(function(){
				var edit = $('#edit').val();
				var spec_price = [];
				$('.spec_price').each(function(){
					spec_price.push($(this).val());
				})
				

				$.ajax({
					type:'get',
					url:'<?php echo U("Goods/spec_items");?>',
					data:{
						id:edit,
						price:spec_price,
					},
					dataType:'html',
					success:function(data){

						$('#package').append(data);
					}
					
				})
			})
</script>


</body>
</html>