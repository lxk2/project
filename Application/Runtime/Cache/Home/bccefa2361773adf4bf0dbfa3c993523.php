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
            	<li><a href="member.html">会员中心</a></li>
                <li><a class="p"  href="personal data.html">个人资料</a></li>
                <li><a href="shopping.html">我的购物车</a></li>
                <li><a href="password.html">修改密码</a></li>
                <li><a  href="Purchase.html">购买记录</a></li>
                <li><a href="make.html">确认订单</a></li>
                <li><a href="Payment failure.html">确认付款</a></li>
            </ul>
        </div>
        <div class="paymentr">
        	<div class="paymentrt"><span><i class="iconfont icon-gerenzhongxin"></i>个人资料/The personal data</span><p>当前位置：<a href="index.html">首页>></a><a href="member.html">会员中心>></a ><a href="personal data.html">个人资料</a></p></div>
            <div class="personal">
            	<div class="big"><span>当前头像：</span><p class="bug"><img src="/Public/Home/images/touxiang.png"/></p></div>
                <span>昵称：</span><p class="bug"><input type="text"></p>
                <span>真实姓名：</span><p class="bug"><input type="text"></p>
                <span>性别：</span><p class="bug2"><input type="radio" name="sex" id="men"/><label for="men">男</label><input type="radio" id="women" name="sex" checked/><label for="women">女</label></p>
                <span>生日：</span><p class="bug">
                
                <select>
        		<option>年</option>
                <option>1980</option>
                <option>1979</option>
                <option>1980</option>
                <option>1979</option>
                <option>1980</option>
                <option>1979</option>
        
        		</select>
                <select>
        		<option>月</option>
                <option>12</option>
                <option>11</option>
                <option>10</option>
                <option>9</option>
                <option>8</option>
                <option>7</option>
        
        		</select>
                <select >
        		<option >日</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option >6</option>
        
        		</select>
            </p>
            	 <span>收货地址：</span><p class="bug3"><input type="text" placeholder="广西南宁市青秀区盛天茗城110号"><a href="">添加新地址！</a></p>
                 <p class="bug"><button  value="修改">修改</button></p>
                
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