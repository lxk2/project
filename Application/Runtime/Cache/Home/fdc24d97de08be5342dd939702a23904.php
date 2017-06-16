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
        	<div class="paymentrt"><span><i class="iconfont icon-gerenzhongxin"></i>个人资料/The personal data</span><p>当前位置：<a href="index.html">首页>></a><a href="member.html">会员中心</a ></p></div>
                <div class="member">
                    <img src="/Public/Home/images/touxiang.png"/>
                    <span><p>您好！Jack</p></span>
                </div>
            	<div class="paymentrt"><span><i class="iconfont icon-gerenzhongxin"></i>猜你喜欢/Guess you like</div>
                <div class="like">
                    <ul>
                        <li><a href=""><img src="/Public/Home/images/like.png"/></a><p>￥88.00</p><p><a href="">首步鞋男士休闲鞋潮流鞋</a></p></li>
                        <li><a href=""><img src="/Public/Home/images/like.png"/></a><p>￥88.00</p><p><a href="">首步鞋男士休闲鞋潮流鞋</a></p></li>
                        <li><a href=""><img src="/Public/Home/images/like.png"/></a><p>￥88.00</p><p><a href="">首步鞋男士休闲鞋潮流鞋</a></p></li>
                        <li><a href=""><img src="/Public/Home/images/like.png"/></a><p>￥88.00</p><p><a href="">首步鞋男士休闲鞋潮流鞋</a></p></li>
                        <li><a href=""><img src="/Public/Home/images/like.png"/></a><p>￥88.00</p><p><a href="">首步鞋男士休闲鞋潮流鞋</a></p></li>
                    
                    </ul>
                </div>
            <div class="paymentrt"><span><i class="iconfont icon-gerenzhongxin"></i>个人资料/The personal data</span>
            	
            </div>
            <div class="recent">
                	<img src="/Public/Home/images/like2.jpg"/>
                    <span><p>赶紧行动吧！你可以: </p></span>
                    <span><p>看看<span class="span"><a href=""> 我的收藏夹</a></span></p></span>
                    <span><p>看看<span class="span"><a href="<?php echo U('Cart/index');?>"> 我的购物车</a></span></p><span>
                </div>
        </div>
     </div>
</div>
<div class="copyright">
<p><a href="index.html">网站首页</a><span>|</span><a href="#">关于我们</a><span>|</span><a href="#">在线反馈</a><span>|</span><a href="#">人才招聘</a><span>|</span><a href="about.html">联系我们</a></p>
<p>版权所有Copyright ©首步运动鞋有限公司</p>

</div>
<script type="text/javascript" src="/Public/Home/js/banner.js"></script>
</body>
</html>