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
        	<div class="paymentrt"><span><i class="iconfont icon-gerenzhongxin"></i>我的购物车/My shopping cart</span><p>当前位置：<a href="index.html">首页>></a><a href="member.html">会员中心>></a ><a href="shopping.html">我的购物车</a></p>
            </div>
            <div class="member">
                
              <form action="" method="get" class="s2"><input type="text" name="keywords" ><a  class="suosuo" href="javascript:;" onclick="submit(this)">搜索</a>
              </form>
			  <script>
				  // 提交表单
			  	function submit(obj) {
					  $(obj).parent().submit();
				  }
			  </script>
                <p class="ppp">全部商品</p>
            </div>
            <table>
            <tr>
            	<th class="th2">宝贝</th><th class="th">单价(元)</th><th class="th2">数量</th><th class="th2">金额 </th><th>操作</th>
            </tr>
            </table>
            <div class="records" id="records">
				<?php if(is_array($res)): foreach($res as $key=>$value): ?><ul>
					<?php $yuanjia = round($value['market_price'] * $value['number'],2); $xianjia = !empty($value['spec_price']) ? $value['spec_price'] : $value['shop_price']; $xianjia = $xianjia * $value['number']; ?>
                	<li class="li1"><input <?php if($value['selected'] == 1): ?>checked<?php endif; ?> class="box-items check" type="checkbox" value="<?php echo ($value['id']); ?>" onclick="selected(this)" ></li>
                    <li class="li2"><a href="<?php echo U('Goods/index',['id' => $value['id']]);?>"><img style="width:134px;height:80px;" src="<?php echo ($value['image']); ?>"/></a></li>
                    <li class="li3"><a href="<?php echo U('Goods/index',['id' => $value['id']]);?>"><p style="line-height:20px;margin-top:55px;"><?php echo ($value['goods_name']); ?></p><p style="line-height:20px;overflow:hidden;" data-goods-spec-key="<?php echo ($value['goods_spec_key']); ?>" title="100块你买不了后悔，买不了吃亏"><?php echo ($value['goods_spec_item']); ?></p></a></li>
                    <li class="li4"><p class="price" data-market-price="<?php echo ($value['market_price']); ?>"><?php if(empty($value['spec_price'])): echo ($value['shop_price']); else: echo ($value['spec_price']); endif; ?></p></li>
                    <li class="li5">
                    	<div class="much2">
                            <a href="javascript:;" class="jian" onclick="miuns(this)" >-</a>
                            <input class="tb" value="<?php echo ($value['number']); ?>">
                            <a href="javascript:void(0); " class="jia" onclick="plus(this)" >+</a>
            			</div>
                    </li>
                    <li class="li6">
                    	<div class="much3">
                            <em><?php echo ($yuanjia); ?></em>
                            <span class="xianjia"><?php echo ($xianjia); ?></span>
                            <p><a href="">厂家直销</a></p>
            			</div>
                    </li>
                    <li class="li6">
                    	<div class="much3">
                            <span><a href="">移入收藏夹</a></span>
                            <span><a href="javascript:;" onclick="del(this)">删除</a></span>
            			</div>
                    </li>
                </ul><?php endforeach; endif; ?>
                
               	<div class="balance" id="foot">
                    <div class="balancel"><label class="ckAll check"><input  class="box-all" type="checkbox" onclick="checkedAll(this)" /></label></div>
                    <div class="balance2"><p>全选</p></div>
                    <div class="balancez">
                        <a class="deleteAll" href="<?php echo U('Cart/delAll');?>">清空</a>
                        <a href="">移入收藏夹</a>
                        <a href="">分享</a>
                    </div>
                    <div class="balancer">
                    <span class="selected">已选商品<i id="selectedTotal"><?php echo ($total['total_number']); ?></i>件</span>
                    <span>合计（不含运费）:￥<i class="php"><?php echo ($total['total_price']); ?></i></span>
                    <a href="javascript:;" onclick="pay(this)">结算</a>
                    </div>
               
            	</div>   
        	</div>
     	</div>
        </div>
        </div>
		
<script>
	// 删除事件
	function del(obj) {
		var id = $(obj).parents('ul').find('.box-items').val();
		$.ajax({
			type:'get',
			url:'<?php echo U("Cart/del");?>',
			data:{
				id:id,
			},
			dataType:'json',
			success:function(data) {
				alert(data.msg);
				if(data.code == 0){
					$(obj).parents('ul').remove();
					$('#selectedTotal').html(data.total.total_number);
					$('.php').html(data.total.total_price);
				}
			}
		})
	}
	
	// checkbox 事件
	function selected(obj) {
		checkAll();
		var id = $(obj).val();
		var selected = $(obj).prop('checked');
		$.ajax({
			type:'post',
			url:'<?php echo U("Cart/selected");?>',
			data:{
				id:id,
				selected:selected,
			},
			dataType:'json',
			success:function(data) {
				// 修改统计
				$('#selectedTotal').html(data.total.total_number);
				$('.php').html(data.total.total_price);
			}
		})
	}

	// +
	function plus(obj) {
		var num = $(obj).prev().val();
		var id = $(obj).parents('ul').find('.box-items').val();
		++num;
		$(obj).prev().val(num);
		changeNum(num,id,obj);
	}
	
	// -
	function miuns(obj) {
		var num = $(obj).next().val();
		var id = $(obj).parents('ul').find('.box-items').val();
		if(num <= 1){
			return false;
		}
		--num;
		$(obj).next().val(num);
		changeNum(num,id,obj);
	}
	
	// ajax请求
	function changeNum(num,id,obj) {
		$.ajax({
			type:'post',
			url:'<?php echo U("Cart/edit");?>',
			data:{
				number:num,
				id:id,
			},
			dataType:'json',
			success:function(data){
				$('#selectedTotal').html(data.total.total_number);
				$('.php').html(data.total.total_price);
				// 更改小计
				var price = $(obj).parents('ul').find('.price').html();
				price = price * num;
				$(obj).parents('ul').find('.xianjia').html(price);

				var total_market_price = $(obj).parents('ul').find('.price').attr('data-market-price');
				total_market_price = total_market_price * num;
				// 保留两位小数
				$(obj).parents('ul').find('.much3').find('em').html(total_market_price.toFixed(2));
			}
		})
	}

	function checkedAll(obj) {
		var selected = $(obj).prop('checked');
		$.ajax({
			type:'post',
			url:'<?php echo U("Cart/selectedAll");?>',
			data:{
				selected:selected,
			},
			dataType:'json',
			success:function(data){
				// 修改统计
				$('#selectedTotal').html(data.total.total_number);
				$('.php').html(data.total.total_price);
				// 
				if(selected === true){
					$('.box-items').prop('checked','checked');
				}
				else{
					$('.box-items').prop('checked','');
				}
			}
		})

	}

	function checkAll() {
		var check_box = $('.box-items').length;
		var checked = $('.li1').find('input:checked').length;
		if(check_box == checked){
			$('.box-all').prop('checked','checked');
		}
		else{
			$('.box-all').prop('checked','');
		}
	}

	$(function(){
		checkAll();
	})

	// 结账
	function pay(obj) {
		// 先判断勾选上的商品有几件
		var checked = $('.li1').find('input:checked').length;
		if(checked == 0){
			alert('没有结账商品');
			return false;
		}
		// 再判断该用户是否有登陆
		$.ajax({
			type:'post',
			url:'<?php echo U("Cart/checkLogin");?>',
			data:{
				
			},
			dataType:'json',
			success:function(data) {
				if(data.code == 1){
					if(confirm(data.msg)){
						window.location.href = '<?php echo U("User/index",["f"=>"1"]);?>';
						return false;
					}
					else{
						return false;
					}
				}
				// 已经登陆就跳转到订单页
				window.location.href = '<?php echo U("");?>';
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