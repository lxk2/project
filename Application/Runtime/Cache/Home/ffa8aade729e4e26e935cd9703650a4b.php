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
                <li><a href="Purchase.html">购买记录</a></li>
                <li><a href="<?php echo U('Order/index');?>">确认订单</a></li>
                <li><a href="Payment failure.html">确认付款</a></li>
            </ul>
        </div>
        <div class="paymentr">
        	<div class="paymentrt"><span><i class="iconfont icon-gerenzhongxin"></i>确认订单/Make sure the order</span><p>当前位置：<a href="index.html">首页>></a><a href="">会员中心>></a ><a href="">个人资料</a></p></div>
                <div class="make">
                	<div class="maket">
                    	<p>确认订单信息</p>
                        <ul>
                        	<li class="makeli">宝贝</li>
                            <li>小计(元)</li>
                            <li>数量</li>
                            <li>单位(元)</li>
                        </ul>
                        <div class="maket2">
                        	<ul>
                            	<li class="make2"><img src="/Public/Home/images/shopping.jpg"/></li>
                                <li class="make3"><p>2015年最新款首步运动鞋</p></li>
                                <li class="make4"><p>888</p></li>
                                <li class="make5">
                                	<div  class="much4">
                            			<a href="#">-</a>
                                        <input value="10">
                                        <a href="#">+</a>
                                    </div>
                                </li>
                                <li class="make6">
                                	<div class="much5">
                                        <span>7878</span>
                                        <p><select>
                                        		<option>以省1002元:厂家直销</option>
                                        	</select>
                                        </p>
                                    </div>
                                
                                </li>
                            </ul>
                       
                        </div>
                    </div>
                    <div class="makez">
                    	<p>确认收货地址</p>
                        <div class="makez2">
                        	<p class="make2p"><img src="/Public/Home/images/make.png"/><i>配送至</i><input type="radio"name="b" checked><strong class="address">广西壮族自治区南宁市青秀区民族大道泰安大厦1010室 （梁女士 收）1234567899</strong></p>
                            <p class="make3p"><a href="">修改本地址</a></p>
                        </div>
                        	<p class="make4p"><span><input type="radio" name="a"></span><span class="che">壮族自治区南宁市青秀区民族大道泰安大厦1010室 （梁女士 收）1234567899</span></p>
                            <p class="make4p"><span><input type="radio" name="a"></span><span class="che">广西壮族自治区博白市青秀区民族大道泰安大厦1010室 （梁女士 收）1234567899</span></p>
                            <p class="make4p"><span><input type="radio" name="a"></span><span class="che">广西壮族自治区南宁市青秀区民族大道泰安大厦1010室 （梁女士 收）1234567899</span></p>
                            <p class="make4p"><a href="">使用其他地址</a></p>
                            
                            <p class="make5p"><a href="">实付款：<i>￥7878</i></a></p>
                            <p class="make5p"><a href=""><strong>配送至：</strong>广西壮族自治区南宁市青秀区民族大道泰安大厦1010室</a></p>
                            <p class="make5p"><a href=""><strong>收货人：</strong>梁女士 1234567899</a></p>
                            <p class="make6p"><a href="Payment success.html">提交订单</a></p>
                            
                    
                    </div>
                
                
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