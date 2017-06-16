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
				<?php if(is_array($cate)): foreach($cate as $key=>$value): ?><li><a <?php if(($cid) == $value['id']): ?>class="hov"<?php endif; ?> href="<?php echo U('index',['cid' => $value['id']]);?>"><?php echo ($value['cate_name']); ?></a></li><?php endforeach; endif; ?>
            </ul>
        </div>
        <div class="bandlnum"><a href=""><img src="/Public/Home/images/band1.jpg"/></a></div>
        <div class="twodbc"><a href=""><img src="/Public/Home/images/band2.jpg"/></a>
        <p>扫一扫有惊喜</p>
        </div>
    </div>
    
    <div class="bandr">
    	<p class="bandrr"><i class="iconfont icon-liuyan"></i>品牌简介</p><span>当前位置：<a href="index.html">首页>></a><a href="product.html">产品中心>></a><a href="productinfo.html">冬至运动鞋>></a></span>
        <ul>
			<?php if(is_array($res)): foreach($res as $key=>$value): ?><li><a href="<?php echo U('desc',['id' => $value['id']]);?>"><img style="width:165px;height:152px;" src="<?php echo ($value['image']); ?>"/></a>
            <div class="producttitle">
            	<p><a href="<?php echo U('desc',['id' => $value['id']]);?>"><?php echo mb_substr($value['goods_name'],0,25,'utf-8');?></a></p>
                <p class="p">￥<?php echo ($value['shop_price']); ?></p> <span style="margin-left:28px;"><a href="shopping.html"><i class="iconfont icon-gouwuche"></i>加入购物车</a></span>
            </div>
			</li><?php endforeach; endif; ?>
        </ul>
		
		
    </div>
	<style>
		.pagelist {padding:10px 0; text-align:center;}
		.pagelist span,.pagelist a{ border-radius:3px; border:1px solid #dfdfdf;display:inline-block; padding:5px 12px;}
		.pagelist a{ margin:0 3px;}
		.pagelist span.current{ background:#09F; color:#FFF; border-color:#09F; margin:0 2px;}
		.pagelist a:hover{background:#09F; color:#FFF; border-color:#09F; }
		.pagelist label{ padding-left:15px; color:#999;}
		.pagelist label b{color:red; font-weight:normal; margin:0 3px;}
	</style>
	<div class="pagelist">
		<?php echo ($page); ?>
	</div>


  
</div>

<div class="copyright">
<p><a href="index.html">网站首页</a><span>|</span><a href="#">关于我们</a><span>|</span><a href="#">在线反馈</a><span>|</span><a href="#">人才招聘</a><span>|</span><a href="about.html">联系我们</a></p>
<p>版权所有Copyright ©首步运动鞋有限公司</p>

</div>
<script type="text/javascript" src="/Public/Home/js/banner.js"></script>
</body>
</html>