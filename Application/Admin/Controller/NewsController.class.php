<?php
namespace Admin\Controller;
class NewsController extends BaseController {
	public function index() {
		$map = [];
		if(IS_GET){
			$keywords = I('get.keywords');
			$map['title'] = ['like',"%{$keywords}%"];
			$map['cate_name'] = ['like',"%{$keywords}%"];
			$map['_logic'] = 'or';
		}
		// 实例化Page类
		// 总记录数
		$count = D('News')->where($map)->count();
		// 每页显示记录数
		$listRows = 2;
		$page = new \Think\Page($count,$listRows);
		$this->assign('page',$page->show());
		$res = D('News')->newsList($listRows,$map);
		$this->assign('res',$res);
		$this->display();
	}
	public function add() {
		if(IS_POST){
			$res = D('News')->newsAdd();
			if($res !== true){
				return $this->error($res);
			}
			return $this->success('添加成功',U('index'));
		}
		// 查出新闻分类
		$res = D('News')->newsCategory();
		$this->assign('res',$res);
		unset($res);
		$this->display();
	}
	public function edit() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		if(IS_POST){
			$res = D('News')->newsEdit();
			if($res !== true){
				return $this->error($res);
			}
			return $this->success('更新成功',U('index'));
		}
		// 查出当前新闻
		$res = D('News')->newsFind();
		// 传输数据
		$this->assign('res',$res);
		unset($res);
		// 查出新闻分类
		$cate = D('News')->newsCategory();
		$this->assign('cate',$cate);
		unset($cate);
		$this->display('add');
	}
	public function del() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		// 开始删除
		$res = D('News')->newsDel();
		if($res !== true){
			return $thiss->error($res);
		}
		return $this->success('删除成功',U('index'));
	}
}