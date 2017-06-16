<?php
namespace Admin\Controller;
class GoodsTypeController extends BaseController {
	public function index() {
		$map = [];
		if(IS_GET){
			$keywords = I('keywords');
			$map['type_name'] = ['like',"%{$keywords}%"];
		}
		// 总记录数
		$totalRows = D('GoodsType')->dataCount($map);
		// 每页显示的记录数
		$listRows = 2;
		// 实例化Page类
		$page = new \Think\Page($totalRows,$listRows);
		$this->assign('page',$page->show());
		$res = D('GoodsType')->goodsTypeList(I('p',1),$listRows,$map);
		$this->assign('res',$res);
		$this->display();
	}
	public function add() {
		if(IS_POST){
			$res = D('GoodsType')->goodsTypeAdd();
			if(is_string($res)){
				return $this->error($res);
			}
			return $this->success('添加成功',U('index'));
		}
		$this->display();
	}
	public function edit() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		if(IS_POST){
			// 组装id
			$_POST['id'] = I('get.id');
			$res = D('GoodsType')->goodsTypeEdit(I('get.id'));
			if($res !== true){
				return $this->error($res);
			}
			return $this->success('更新成功',U('index'));
		}
		$res = D('GoodsType')->find(I('id'));
		// 传输数据
		$this->assign('res',$res);
		$this->display('add');
	}
	public function del() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		$res = D('GoodsType')->goodsTypeDel(I('get.id'));
		if($res !== true){
			return $this->error($res);
		}
		return $this->success('删除成功',U('index'));
	}
}