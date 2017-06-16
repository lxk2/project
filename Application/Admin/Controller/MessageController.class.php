<?php
namespace Admin\Controller;
class MessageController extends BaseController {
	public function index() {
		// 搜索
		$map = [];
		if(IS_GET){
			$keywords = I('get.keywords');
			$map['name'] = ['like',"%{$keywords}%"];
		}
		// 实例化Page类
		// 总记录数
		$count = D('Message')->where($map)->count();
		// 每页显示记录数
		$listRow = 2;
		$page = new \Think\Page($count,$listRow);
		$this->assign('page',$page->show());
		$res = D('Message')->messageList($listRow,$map);
		$this->assign('res',$res);
		$this->display();
	}
	public function desc() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		$res = D('Message')->find(I('get.id'));
		$this->assign('res',$res);
		$this->display();
	}
	public function del() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		// 开始删除
		$res = D('Message')->messageDel();
		if($res !== true){
			return $this->error($res);
		}
		return $this->success('删除成功',U('index'));
	}
}