<?php
namespace Admin\Controller;
class AdminController extends BaseController {
	// 列表页
	public function index() {
		
		dump(session('admin'));
		
		// 搜索框
		$map = [];
		if(!empty($_GET['keywords'])){
			$keywords = I('keywords');
			$map['user_name'] = ['like',"%{$keywords}%"];
		}
		
		// 总的记录数
		$totalRows = M('admin')->where($map)->count();
		// 每页显示记录数
		$listRows = 2;
		// 实例化一个分页类
		$page = new \Think\Page($totalRows,$listRows);
		// 传输数据  $page->show() 如果总记录数少于等于每页记录数不会显示出来
		$this->assign('page',$page->show());
		
		// 查出数据
		$admin = M('admin')->field('id,user_name,password')->where($map)->order('id desc')->page(I('p',1),$listRows)->select();
		// 传输数据
		$this->assign('admin',$admin);
		$this->display();
	}
	// 添加页
	public function add() {
		if(IS_POST){
			// 验证字段
			// 最后验证用户是否存在
			$validate = [
				['user_name','require','用户名不能为空'],
				['password','require','密码不能为空'],
				['repassword','require','确认密码不能为空'],
				['password','repassword','确认密码错误',2,'confirm'],
				['user_name','user_name','该用户已存在',2,'unique'],
			];
			$res = M('admin')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('admin')->getError());
			}
			// 加密密码
			$res['password'] = md5(I('password'));
			// 添加数据
			$id = M('admin')->add($res);
			if(empty($id)){
				return $this->error('添加失败');
			}
			return $this->success('添加成功',U('index'));
		}
		$this->display();
	}
	// 修改页
	public function edit() {
		$this->display('add');
	}
	public function del() {
		
	}
}