<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
	// 在面向对象里面一般一个方法只做一件事情
	public function _initialize() {
		// 检查登陆
		$this->checkLogin();
	}
	protected function checkLogin() {
		if(!session('?admin')){
			return $this->error('老怼，请登录~',U('Login/index'));
		}
		// if(empty($_SESSION['user_name'])){
			// return $this->error('老怼，请登录~',U('Login/index'));
		// }
	}
	
	
	public function add(){
		$this -> display();
	}
	
}