<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>首页</title>
<link rel="stylesheet" href="/Public/Home/font/iconfont.css"/>
<link rel="stylesheet" href="/Public/Home/css/public.css"/>
<link rel="stylesheet" href="/Public/Home/css/private.css"/>
<script src="/Public/Home/js/jquery.js"></script>

<script src="/Public/Home/js/production.js"></script>

<link rel="stylesheet" href="/Public/Home/css/back.css"/>

</head>
<body>
<div class="header">
	<div class="top">
        <div class="logo"><img src="/Public/Home/images/logo.jpg"/></div>
        <div class="shop"><p><i class="iconfont icon-gouwuche"></i>&nbsp;<a href="<?php echo U('Cart/index');?>">购物车</a>
        	&nbsp;&nbsp;<i class="iconfont icon-gerenzhongxin"></i>&nbsp;<a href="<?php echo U('User/index');?>">个人中心</a></p>
        	<a  class="suosuo" href="#"><img src="/Public/Home/images/sousuo.jpg"></a>
             <input type="text" class="text" value="请输入要搜索的商品" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '请输入要搜索的商品';}">
    	</div>
 	</div>   
</div>


<div class="nav">
	<div class="nav1">	
        <ul >
            
            <li><a class="hover" href="<?php echo U('Index/index');?>">首页</a></li>
            <li><a  href="band.html">品牌介绍</a></li>
            <li><a href="news.html">新闻中心</a></li>
            <li><a href="<?php echo U('Goods/index');?>">产品中心</a></li>
            <li><a href="<?php echo U('contact_us');?>">联系我们</a></li>
        </ul>
	</div>
   
</div>
<div class="Payment">
	<form action="<?php echo U('Member/addAddress');?>" method="post">
	<div class="Paymentbig">
    	<div class="paymentl">
        <span>会员中心</span>
        	<ul>
            	<li><a href="<?php echo U('Member/index');?>">会员中心</a></li>
                <li><a href="<?php echo U('Member/userInfo');?>">个人资料</a></li>
                <li><a class="p" href="<?php echo U('Cart/index');?>">我的购物车</a></li>
                <li><a href="password.html">修改密码</a></li>
                <li><a href="<?php echo U('Member/address');?>">收货地址</a></li>
                <li><a href="Purchase.html">购买记录</a></li>
                <li><a href="<?php echo U('Order/index');?>">确认订单</a></li>
                <li><a href="Payment failure.html">确认付款</a></li>
            </ul>
        </div>
        <div class="paymentr">
		
			
		
		
        	<div class="paymentrt"><span><i class="iconfont icon-iconfontcolor65"></i>Address</span><p>当前位置：<a href="index.html">首页>></a><a href="member.html">会员中心>></a ><a href="password.html">收货地址</a></p></div>
			<style>
				table tr td a.a1 {
					display: inline-block;
					width: 75px;
					height: 30px;
					background: #f63;
					border-radius: 10px;
					-webkit-border-radius: 10px;
					border: 0px;
					outline: none;
					text-align: center;
					color: #fff;
					line-height: 30px;
				}   
				
			</style>
			<table style="margin-top:10px;">
				<?php if(is_array($user_addr)): foreach($user_addr as $key=>$value): ?><tr style="overflow:hidden;width:auto;height:auto;float:none;text-align:center;line-height:60px;">
					<td>
						<?php echo ($value['province']['region_name']); echo ($value['city']['region_name']); echo ($value['area']['region_name']); echo ($value['addr']); ?> （<?php echo ($value['name']); ?> 收）<?php echo ($value['phone']); ?>
					</td>
					<td><a data-id="<?php echo ($value['id']); ?>" class="a1" href="javascript:;" >删除</a></td>
				</tr><?php endforeach; endif; ?>
				
			</table>
			
            <div class="password">
			<div id="region">
				<div class="abc">
					<span><i>*</i>省份：</span><p>
					<select name="province_id" onchange="region(this)">
						<option class="first" value="">请选择省份</option>
						<?php if(is_array($region)): foreach($region as $key=>$value): ?><option value="<?php echo ($value['region_id']); ?>"><?php echo ($value['region_name']); ?></option><?php endforeach; endif; ?>
					</select>
					</p>
				</div>
				<div class="abc">
					<span><i>*</i>城市：</span><p>
					<select name="city_id" onchange="region(this)">
						<option class="first" value="">请选择城市</option>
					</select>
					</p>
				</div>
				<div class="abc">
					<span><i>*</i>地区：</span><p>
					<select name="area_id" onchange="region(this)">
						<option class="first" value="">请选择地区</option>
					</select>
					</p>
				</div>
			</div>
            <span><i>*</i>收货人：</span><p><input type="text" name="name"></p>
            <span><i>*</i>联系电话：</span><p><input type="text" name="phone"></p>
            <span><i>*</i>详尽地址：</span><p><textarea type="text" name="addr" style="height:70px;width:350px;resize:none;"></textarea></p>
            
            <a class="a1" href="javascript:;" onclick="submitt()" >提交</a>
            </div>
        	
        </div>
     </div>
	 </form>
</div>
<script>
	function region(obj) {
		var region_id = $(obj).val();
		var name = $(obj).parents('.abc').next().find('select').find('.first').html();
		if(region_id == 0){
			if(name == '请选择城市'){
				$(obj).parents('.abc').next().next().find('select').html('<option class="first" value="">请选择地区</option>');
			}
			$(obj).parents('.abc').next().find('select').html('<option class="first" value="">'+name+'</option>');
			return false;
		}
		$.ajax({
			type:'post',
			url:'<?php echo U("Member/regionSelect");?>',
			data:{
				region_id:region_id,
				name:name,
			},
			dataType:'html',
			success:function(data) {
				if(data == 1){
					return false;
				}
				$(obj).parents('.abc').next().find('select').html(data);
				$(obj).parents('.abc').next().next().find('select').html('<option class="first" value="">请选择地区</option>');
			}
		})
	}
	
	function submitt() {
		var province_id = $('select[name="province_id"]').val();
		var city_id = $('select[name="city_id"]').val();
		var area_id = $('select[name="area_id"]').val();
		var name = $('input[name="name"]').val();
		var phone = $('input[name="phone"]').val();
		var addr = $('textarea[name="addr"]').val();
		$.ajax({
			type:'post',
			url:'<?php echo U("Member/addAddress");?>',
			data:{
				province_id:province_id,
				city_id:city_id,
				area_id:area_id,
				name:name,
				phone:phone,
				addr:addr,
			},
			dataType:'text',
			success:function(data) {
				alert(data);
				if(data == '添加成功'){
					
				}
			},
		})
	}
	
</script>
<div class="copyright">
<p><a href="index.html">网站首页</a><span>|</span><a href="#">关于我们</a><span>|</span><a href="#">在线反馈</a><span>|</span><a href="#">人才招聘</a><span>|</span><a href="about.html">联系我们</a></p>
<p>版权所有Copyright ©首步运动鞋有限公司</p>

</div>
<script type="text/javascript" src="/Public/Home/js/banner.js"></script>
</body>
</html>