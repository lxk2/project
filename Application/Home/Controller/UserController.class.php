<?php
namespace Home\Controller;
class UserController extends BaseController {
	
	// 登陆前置操作
	public function _before_index() {
		// 判断session中是否有数据
		if(session('?user')){
			header('location:'.U('Member/index'));
		}
	}
	
	public function index() {
		$f = I('get.f',0);
		if(IS_POST){
			$res = D('User')->login($vilation);
			if($res !== true){
				return $this->error($res);
			}
			if(empty($f)){
				$url = U('Member/index');
			}
			else{
				$url = U('Order/index');
			}
			return $this->success('登陆成功',$url);
		}
		$this->display();
	}
	
	// 注册页面
	public function regist() {
		if(IS_POST){
			$res = D('User')->regist();
			if($res !== true){
				return $this->error($res);
			}
			return $this->success('注册成功',U('index'));
		}
		$this->display();
	}
	
	// 验证码
	public function vcode() {
		// 实例化Verify类
		$vcode = new \Think\Verify();
		$vcode->imageW = 105;
		$vcode->imageH = 30;
		$vcode->length = 2;
		$vcode->fontSize = 15;
		// 输出验证码并把值保存到session中
		$vcode->entry();
	}
}