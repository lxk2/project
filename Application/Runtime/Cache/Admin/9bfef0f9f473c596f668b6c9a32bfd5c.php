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
<form method="get" action="<?php echo U();?>" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></a></div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="<?php echo U('add');?>"> 添加内容</a> </li>
        
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input" style="width:250px; line-height:17px;display:inline-block" />
          <a href="javascript:void(0)" class="button border-main icon-search" onclick="csearch()" > 搜索</a></li>
      </ul>
	  
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
        <th>分类名称</th>
        <th width="310">操作</th>
      </tr>
	<?php if(is_array($res)): foreach($res as $key=>$value): ?><tr>
          <td style="text-align:left; padding-left:20px;">
           <?php echo ($value['id']); ?></td>
          <td><font color="#00CC99"><?php echo ($value['cate_name']); ?></font></td>
          <td><div class="button-group"> <a class="button border-main" href="<?php echo U('edit',['id'=>$value['id']]);?>"><span class="icon-edit"></span> 修改</a> <a class="button border-red" style="margin-left:10px;" href="javascript:void(0)" onclick="del(<?php echo ($value['id']); ?>)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr><?php endforeach; endif; ?>
      <tr>
        <td colspan="8"><div class="pagelist"><?php echo ($page); ?></div></td>
      </tr>
    </table>
  </div>
</form>
<script>
	function csearch(){
		$('form').submit();
	}
</script>
<script>
	function del(id){
		if(confirm('确定要删除吗?')){
			// 方法一：
			// url = '/Admin/Brand/del/id/'+ id +'.html';
			// 方法二：
			url = '<?php echo U('del',['id'=>'idstr']);?>'.replace('idstr',id);
			window.location.href = url;
		}
	}
</script>

</body>
</html>