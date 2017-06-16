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
<div class="bandbanner"><a href="productinfo.html"></a>
</div>
<div class="bandintrodoce">
	<div class="bandl">
    	<div class="bandnav">
        	<ul>
            	<p>产品中心</p>
            	<?php if(is_array($cate)): foreach($cate as $key=>$value): ?><li><a <?php if(!empty($_GET['id'])): if(($goods['category_id']) == $value['id']): ?>class="hov"<?php endif; else: if(($cid) == $value['id']): ?>class="hov"<?php endif; endif; ?> href="<?php echo U('index',['cid' => $value['id']]);?>"><?php echo ($value['cate_name']); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </div>
        <div class="bandlnum"><a href=""><img src="/Public/Home/images/band1.jpg"/></a></div>
        <div class="twodbc"><a href=""><img src="/Public/Home/images/band2.jpg"/></a>
        <p>扫一扫有惊喜</p>
        </div>
    </div>
    
    <div class="bandr">
    	<p class="bandrr"><i class="iconfont icon-liuyan"></i>品牌简介</p><span>当前位置：<a href="index.html">首页>></a><a href="product.html">产品中心>></a><a href="productinfo.html">冬季运动鞋>></a></span>
        <ul class="productinfo">
        	<div class="productinfol">
            	<a href="" ><img style="width:300px;height:300px;padding-top:10px;" src="<?php echo ($goods['image']); ?>"/></a>
            </div>
            <div class="productinfor">
            	<p><?php echo ($goods['goods_name']); ?></p>
                <div class="price">
                	<span class="dd">价格</span>
                    <div class="price2">
                    	<em>￥</em>
                        <em id="spec_price"><?php echo ($goods['shop_price']); ?></em>
                    </div>
                    <li><a href=""><p>52888</p><p>累计评价</p></a></li>
                    <span id="a">|</span>
                    <li><a href=""><p>52888</p><p>交易成功</p></a></li>
                </div>
                <div class="add">
                	<span class="add2">配送至</span>
                  	<span>广东深圳至广西南宁青秀区</span>
                    <span>
                    	<select>
                        	<option></option>
                        </select>
                    
                    </span>
                    <span>快递 免运费</span>
                    <span>
                    	<select>
                        	<option></option>
                        </select>
                    
                    </span>
            	</div>
				<style>
					.size ul li a.cur {
						background:red;
						border:1px solid red ;
					}
				</style>
				<?php if(is_array($spec_items)): foreach($spec_items as $key=>$value): ?><div class="size">
                	<span class="add2"><?php echo ($key); ?></span>
                    <ul>
						<?php if(is_array($value)): foreach($value as $key=>$v): ?><li class="" style="width:auto;"> <a  class="<?php if(empty($key)): ?>cur<?php endif; ?>" style="padding:0 5px;" href="javascript:;" data-id="<?php echo ($v['id']); ?>"><?php echo ($v['items']); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                  	
            	</div><?php endforeach; endif; ?>
                
                <div class="much">
                	<span class="much2">数量</span>
                    <a href="javascript:;" class="jian" onclick="miuns()">-</a>
                    <input value="1">
                    <a href="javascript:void(0); " class="jia" onclick="plus()">+</a>
                    <span>双(库存9998双)</span>                    
                  	
            	</div>
            </div>
        	
        </ul>
        
        <div class="onclik" style="display:inline-block;"><a href="javascript:;" onclick="buy()">点击购买</a></div>
		<div class="onclik" style="display:inline-block;margin-left:0;"><a href="javascript:;" onclick="add_cart()">加入购物车</a></div> 
        <div class="NEWS">
        	<p><span>浏览记录</span></p>
            <div class="NEWSz" style="text-align:center;">
            	<ul>
					<?php if(is_array($history)): foreach($history as $key=>$value): ?><li><a href="<?php echo U('Goods/desc',['id' => $key]);?>"><img style="width:150px;height:150px;" src="<?php echo ($value['image']); ?>"/></a></li><?php endforeach; endif; ?>
                </ul>
            </div>
        </div>
    </div>
    
</div>
<script>
	// 点击套餐触发事件
	$('.size').find('ul').find('li').find('a').click(function() {
		$(this).addClass('cur');
		$(this).parent('li').siblings().find('a').removeClass('cur');
		
		spec_price();
	})
	// 页面加载完成显示
	$(function(){
		spec_price();
	})
	function spec_price() {
		var spec_key = [];
		
		// 遍历选中的
		$('.size ul li a.cur').each(function(){
			spec_key.push($(this).attr('data-id'));
		});
		// 获取goods_id
		var goods_id = '<?php echo ($_GET['id']); ?>';
		spec_key = spec_key.join(',');
		$.ajax({
			type:'post',
			url:'<?php echo U("Goods/ajax_spec_key");?>',
			data:{
				spec_key:spec_key,
				goods_id:goods_id,
			},
			dataType:'json',
			success:function(data) {
				if(data.length > 0){
					$('#spec_price').html(data);
				}
			}
		});
	}
	
	// +
	function plus() {
		var num = $('.jia').prev().val();
		++num;
		$('.jia').prev().val(num);
	}
	
	// -
	function miuns() {
		var num = $('.jian').next().val();
		if(num<=1){
			return false;
		}
		--num;
		$('.jian').next().val(num);
	}
	
	// 添加到购物车事件
	function add_cart() {
		// 接收goods_id
		var goods_id = '<?php echo ($_GET['id']); ?>';
		// 接收number
		var number = $('.much').find('input').val();
		// 接收goods_spec_key
		var goods_spec_key = [];
		$('.size ul li a.cur').each(function(){
			goods_spec_key.push($(this).attr('data-id'));
		});
		goods_spec_key = goods_spec_key.join(',');
		$.ajax({
			type:'post',
			url:'<?php echo U("Cart/addToCart");?>',
			data:{
				goods_id:goods_id,
				number:number,
				goods_spec_key:goods_spec_key,
			},
			dataType:'text',
			success:function(data) {
				alert(data);
				$('.much').find('input').val(1);
			},
			error:function(e) {
				alert('添加到购物车失败1');
			}
		})
	}
	
	// 立即购买事件
	function buy() {
		// 接收goods_id
		var goods_id = '<?php echo ($_GET['id']); ?>';
		// 接收number
		var number = $('.much').find('input').val();
		// 接收goods_spec_key
		var goods_spec_key = [];
		$('.size ul li a.cur').each(function(){
			goods_spec_key.push($(this).attr('data-id'));
		});
		goods_spec_key = goods_spec_key.join(',');
		$.ajax({
			type:'post',
			url:'<?php echo U("Cart/addToCart");?>',
			data:{
				goods_id:goods_id,
				number:number,
				goods_spec_key:goods_spec_key,
			},
			dataType:'text',
			success:function(data) {
				if(data === '加入购物车失败'){
					return false;
				}
				// 跳转页面到购物车
				window.location.href = '<?php echo U("Cart/index");?>';
			}
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