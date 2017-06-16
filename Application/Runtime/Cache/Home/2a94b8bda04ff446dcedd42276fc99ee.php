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
<div class="banner">
  <div class="list_div">
   <ul class="list">
      <li class="b1"></li>
      <li class="b2"></li>
      <li class="b3"></li>
      <li class="b4"></li>
    </ul>
   
  </div> 
  <div class="bannerimg">
  	<ul>
    	<li><a href="productinfo.html"><img src="/Public/Home/images/bannerp1.png"/></a>
            <a href="productinfo.html"><p>首步运动鞋2015秋季新款 </p>
            <p>耐磨时尚跑步运动鞋</p></a>
        </li>
        <li><a href="productinfo.html"><img src="/Public/Home/images/bannerp2.png"/></a>
            <a href="productinfo.html"><p>首步运动鞋2015秋季新款 </p>
            <p>耐磨时尚跑步运动鞋</p></a>
        </li>
        <li><a href="productinfo.html"><img src="/Public/Home/images/bannerp3.png"/></a>
            <a href="productinfo.html"><p>首步运动鞋2015秋季新款 </p>
            <p>耐磨时尚跑步运动鞋</p></a>
        </li>
    </ul>
  </div>
  <div class="direction">
    <a href="javascript:;" class="left"><</a>
    <a href="javascript:;" class="right">></a>
  </div>
  <div class="banner_dot">
    <ul>
      <li class="on">1</li>
      <li>2</li>
      <li>3</li>
      <li>4</li>
    </ul>
  </div>
</div>
<div class="copyright">
<p><a href="index.html">网站首页</a><span>|</span><a href="#">关于我们</a><span>|</span><a href="#">在线反馈</a><span>|</span><a href="#">人才招聘</a><span>|</span><a href="about.html">联系我们</a></p>
<p>版权所有Copyright ©首步运动鞋有限公司</p>

</div>
<script type="text/javascript" src="/Public/Home/js/banner.js"></script>
</body>
</html>