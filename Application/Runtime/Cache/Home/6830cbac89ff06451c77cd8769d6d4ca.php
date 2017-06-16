<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>登录</title>
<link rel="stylesheet" href="/Public/Home/font/iconfont.css"/>
<link rel="stylesheet" href="/Public/Home/css/public.css"/>
<link rel="stylesheet" href="/Public/Home/css/private.css"/>
<link rel="stylesheet" href="/Public/Home/css/back.css"/>

<script src="/Public/Home/js/jquery.js"></script>

</head>

<body>
<div class="regist">
	<div class="registlogo"><img src="/Public/Home/images/registlogo.jpg"/></div>
</div>
<div class="box">
	<div class="login">
    	<span><a href="/Public/Home/">快速登录</a></span><span><a class="h" href="/Public/Home/">账户密码登录</a></span>
    </div>
		
    	 <form action="" method="post" id="myform">
        
            
            <div class="login1">
                    <i class="iconfont icon-wode"></i>
                    <input type="text" name="user_name" id="user_name" value="" placeholder="手机号/会员号/邮箱">
                    
			</div>
            <div class="login1">
                    <i class="iconfont icon-lock-fill"></i>
                    <input type="password" name="password" id="password" value="">
                    
			</div>
         <div class="login1">
            <a class="zhuce" href="javascript:;" onclick="submitt()">登录</a>
		</div>
		
		<script>
			function submitt() {
				$('#myform').submit();
			}
		</script>
		
        <div class="login2">
    	<span><a href="/Public/Home/password.html">忘记密码</a></span><span><a class="h" href="<?php echo U('User/regist');?>">注册新账号</a></span><span><a class="h" href="/Public/Home/">意见反馈</a></span>
    </div>
    </form>
</div>
<div class="copyright">
<p><a href="/Public/Home/index.html">网站首页</a><span>|</span><a href="/Public/Home/#">关于我们</a><span>|</span><a href="/Public/Home/#">在线反馈</a><span>|</span><a href="/Public/Home/#">人才招聘</a><span>|</span><a href="/Public/Home/about.html">联系我们</a></p>
<p>版权所有Copyright ©首步运动鞋有限公司</p>

</div>
</body>
</html>