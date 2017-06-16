<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>注册</title>
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
	<form action="" method="post" id="myform">
    	 <form action="" method="post">
         <div class="name">
            
            <div class="name1">
                    
                    <input type="text" name="user_name" id="name" value="">
                    <i class="iconfont icon-wode"></i>
			</div>
			<span class="input-tip">*姓名:</span>
        </div>
        <div class="password">
            
            <div class="name1">
                    
                    <input type="password" name="password" id="password" value="">
                    <i class="iconfont icon-lock-fill"></i>
			</div>
			<span class="input-tip">*密码:</span>
        </div>
         <div class="password">
            
            <div class="name1">
                    
                    <input type="password" name="repassword" id="repassword" value="">
                    <i class="iconfont icon-lock-fill"></i>
			</div>
			<span class="input-tip">*确认密码:</span>
        </div>
        
        <div class="password">
            <a style="line-height:0;" href="javascript:;" class=""><img src="<?php echo U('User/vcode');?>" onclick="this.src=this.src+'?'" /></a>
            <div class="name1" style="width:110px;">
                    
                    <input style=" width:80px;" type="text" name="vcode" id="vcode" value="">
                    
			</div>
			<span class="input-tip">*验证码	:</span>
            
        </div>
        <div class="password">
            <p><input id="checked" type="checkbox" checked><a class="a" href="#">《Feet First用户注册协议》</a><span>我已阅读并同意</span></p>
		</div>
         <div class="password">
            <a class="zhuce" href="javascript:;" onclick="submitt()">注册</a>
		</div>
    </form>
	
	<script>
		function submitt() {
			var checked = $('#checked').prop('checked');
			if(checked == false){
				alert('你未同意注册协议');
				return false;
			}
			$('#myform').submit();
		}
	</script>
	
</div>
<div class="copyright">
<p><a href="/Public/Home/index.html">网站首页</a><span>|</span><a href="/Public/Home/#">关于我们</a><span>|</span><a href="/Public/Home/#">在线反馈</a><span>|</span><a href="/Public/Home/#">人才招聘</a><span>|</span><a href="/Public/Home/about.html">联系我们</a></p>
<p>版权所有Copyright ©首步运动鞋有限公司</p>

</div>
</body>
</html>