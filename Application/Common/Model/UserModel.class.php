<?php
namespace Common\Model;
class UserModel extends \Think\Model\RelationModel {
	// 关联模型
	
	
	// 自动验证
	protected $_validate = [
		['user_name','require','账号不能为空'],
		['password','require','密码不能为空'],
		['repassword','require','确认密码不能为空'],
		['vcode','require','验证码不能为空'],
		
		['vcode','checkVcode','验证码不正确',2,'callback'],
		['password','repassword','密码不一致',1,'confirm'],
		['user_name','user_name','该用户已存在',2,'unique'],
	];
	
	// 自动完成
	protected $_auto = [
		['password','md5',3,'function'],
	];
	
	// 验证验证码方法
	protected function checkVcode($code) {
		// 实例化Verify类
		$vcode = new \Think\Verify();
		return $vcode->check($code);
	}
	
	// 登陆方法
	public function login() {
		// 手动验证
		$validate = [
			['user_name','require','账号不能为空'],
			['password','require','密码不能为空'],
		];
		// 收集数据
		$res = $this->validate($validate)->create();
		if($res === false){
			return $this->getError();
		}
		// 根据用户user_name查询数据
		$user = $this->where(['user_name' => $res['user_name']])->find();
		if(empty($user)){
			return '用户账号不存在';
		}
		// 比对密码
		if($user['password'] !== $res['password']){
			return '密码不正确';
		}
		// 保存用户登录状态
		session('user',[
			'id' => $user['id'],
			'user_name' => $user['user_name'],
		]);
		
		// 更新cart表的user_id字段
		$cart = new \Home\Controller\CartController();
		$cart->editUserId();
		unset($cart);
		
		return true;
	}
	
	// 注册方法
	public function regist() {
		// 收集数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		// 添加数据
		$id = $this->add();
		if(empty($id)){
			return '注册失败';
		}
		return true;
	}
}