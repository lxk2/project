<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>首页</title>
<link rel="stylesheet" href="/Public/Home/font/iconfont.css"/>
<link rel="stylesheet" href="/Public/Home/css/public.css"/>
<link rel="stylesheet" href="/Public/Home/css/private.css"/>
</head>
<body>
<div class="header">
	<div class="top">
        <div class="logo"><img src="/Public/Home/images/logo.jpg"/></div>
        <div class="shop"><p><i class="iconfont icon-gouwuche"></i>&nbsp;<a href="shopping.html">购物车</a>
        	&nbsp;&nbsp;<i class="iconfont icon-gerenzhongxin"></i>&nbsp;<a href="login.html">个人中心</a></p>
        	<a  class="suosuo" href="#"><img src="/Public/Home/images/sousuo.jpg"></a>
             <input type="text" class="text" value="请输入要搜索的商品" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '请输入要搜索的商品';}">
    	</div>
 	</div>   
</div>


<div class="nav">
	<div class="nav1">	
        <ul >
            
            <li><a class="hover" href="index.html">首页</a></li>
            <li><a  href="band.html">品牌介绍</a></li>
            <li><a href="news.html">新闻中心</a></li>
            <li><a href="<?php echo U('goods');?>">产品中心</a></li>
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
            	<p>品牌介绍</p>
            	<li><a class="hov" href="">品牌简介</a></li>
                <li><a href="">品牌文化</a></li>
                <li><a href="">品牌价格</a></li>
                <li><a href="">品牌荣耀</a></li>
            </ul>
        </div>
        <div class="bandlnum"><a href=""><img src="/Public/Home/images/band1.jpg"/></a></div>
        <div class="twodbc"><a href=""><img src="/Public/Home/images/band2.jpg"/></a>
        <p>扫一扫有惊喜</p>
        </div>
    </div>
    
    <div class="bandr">
    	<p class="bandrr"><i class="iconfont icon-liuyan"></i>在线留言</p><span>当前位置：<a href="index.html">首页>></a><a href="about.html">联系我们>></a ><a href="">在线留言</a></span>
        <form action="<?php echo U('contact_us');?>" method="post">
        <p><span>姓&nbsp;&nbsp;名：</span><input type="text" name="name"></p>
        <p><span>所在地区：</span><input type="text" name="area"></p>
        <p><span>所在公司：</span><input type="text" name="company"></p>
        <p><span>联系电话：</span><input type="text" name="tel"></p>
        <p><span>E-&nbsp;mail：</span><input type="text" name="email"></p>
        <p class="ee"><span class="content">内&nbsp;&nbsp;容：</span><textarea style="width:318px; height:180px;" name="content"></textarea></p>
    	<p class="submit"><input type="button"  value="提交" onclick="leave_message()"> <input type="reset" /></p>
        </form>
        <style>
         .bandintrodoce .bandr form{ width:440px; overflow:hidden;  margin:80px auto 20px;}
		 .bandintrodoce .bandr form p{  width:440px; height:65px; display:inline-block; float:right;}
		  
		 .bandintrodoce .bandr form p.ee{ height:180px;}
		 .bandintrodoce .bandr form span{ width:100px; display:inline-block; height:32px; float:left; background:#fff;line-height:32px; text-align:right;  }
		 .bandintrodoce .bandr form p input{ height:32px; width:318px; line-height:32px; text-indent:1em;}
		 .bandintrodoce .bandr p span.content{ width:100px; display:inline-block;vertical-align:top; line-height:20px; height:200px; margin-bottom:20px; float:left; background:#fff;}
		 .bandintrodoce .bandr form p.submit{ width:360px;}
         .bandintrodoce .bandr p.submit input{width:100px; margin:10px auto; margin-left:50px; background:#c4c2c2; border-radius:5px 5px 5px 5px; -webkit-border-radius:5px 5px 5px 5px;  height:30px; }
        </style>
    </div>
</div>
<script>
	function leave_message() {
		var name = $('input[name="name"]').val();
		var area = $('input[name="area"]').val();
		var company = $('input[name="company"]').val();
		var tel = $('input[name="tel"]').val();
		var email = $('input[name="email"]').val();
		var content = $('textarea[name="content"]').val();
		$.ajax({
			type:'post',
			url:'<?php echo U("contact_us");?>',
			data:{
				name:name,
				area:area,
				company:company,
				tel:tel,
				email:email,
				content:content,
			},
			dataType:'html',
			success:function(data) {
				if(data != 1){
					alert(data);
				}else{
					alert('留言成功');
					// 留言成功之后清空表单
					$('input[name="name"]').val('');
					$('input[name="area"]').val('');
					$('input[name="company"]').val('');
					$('input[name="tel"]').val('');
					$('input[name="email"]').val('');
					$('textarea[name="content"]').val('');
				}
			}
		})
	}
</script>
<div class="copyright">
<p><a href="index.html">网站首页</a><span>|</span><a href="#">关于我们</a><span>|</span><a href="#">在线反馈</a><span>|</span><a href="#">人才招聘</a><span>|</span><a href="about.html">联系我们</a></p>
<p>版权所有Copyright ©首步运动鞋有限公司</p>

</div>
<script type="text/javascript"  src="/Public/Home/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/banner.js"></script>
</body>
</html>