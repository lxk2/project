<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	
	// 自动执行前置操作与后置操作
	public function _before_index(){
		if(session('?admin')){
			// 页面跳转
			header('location:'.U('Index/index'));
		}
	}
	
	public function index() {
		// IS_GET 判断是否是GET方式提交 
		// IS_POST 判断是否是POST方式提交 
		// IS_PUT 判断是否是PUT方式提交 
		// IS_DELETE 判断是否是DELETE方式提交 
		// IS_AJAX 判断是否是AJAX提交 
		// REQUEST_METHOD 当前提交类型 
		if(IS_POST) {
			// trace(I());
			$username = I('post.user_name');
			$password = I('post.password');
			$vcode = I('post.vcode');
			if(empty($username)) {
				return $this->error('账号都空了，怎么跟你玩？');
			}
			if(empty($password)) {
				return $this->error('哇，你填账号不填密码的？');
			}
			if(empty($vcode)) {
				return $this->error('懒得说你，回去给我填好验证码');
			}
			// 验证验证码
			$verify = new \Think\Verify;
			if(!$verify->check($vcode)) {
				return $this->error('验证码不对啊，大兄弟');
			}
			// 验证用户账号
			$res = M('admin')->where(['username'=>$username])->find();
			if(empty($res)) {
				return $this->error('你给我输一个错的账号!');
			}
			// 比对密码
			if(md5($password)!=$res['password']) {
				return $this->error('再想想你的密码!');
			}
			// 保存用户信息
			session('admin',[
				'id'=>$res['id'],
				'username'=>$username,
			]);
			// $_SESSION['user_name'] = $username;
			unset($res);
			return $this->success('成功登陆',U('Index/index'));
		}
		$this->display();	
	}	
	public function verify() {
		// $config = [
			// 'imageW' => 100,
			// 'imageH' => 25,
		// ];
		$verify = new \Think\Verify();
		$verify->imageW = 100;
		$verify->imageH = 43;
		$verify->length = 2;
		$verify->fontSize = 20;
		$verify->entry();	
	}
	public function logout() {
		session('admin',null);
		return $this->success('快回来~',U('index'));
	}
}