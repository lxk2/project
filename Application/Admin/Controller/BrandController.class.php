<?php
namespace Admin\Controller;
class BrandController extends BaseController {
	// 列表页
	public function index() {
		
		// dump(__SELF__);
		
		$keywords = I('keywords');
		$map = [];
		if(!empty($keywords)){
			$map['brand_name'] = ['like',"%{$keywords}%"];
		}
		
		// 总记录数
		$totalRows = M('brand')->where($map)->count();
		// 每页显示记录数
		$listRows = 2;
		// 实例化Page类
		$page = new \Think\Page($totalRows,$listRows);
		$page->rollPage = 4;
		dump($page->show());
		$this->assign('page',$page->show());
		
		// limit(1,2) 从第1条开始取2条数据
		// page(1,2) 第1页，有2条数据
		// I('p',1)方法，第一个是post或者get的数组键名，第二个值是默认值
		$res = M('brand')->field('id,brand_name')->where($map)->page(I('p',1),$listRows)->order('id asc')->select();
		$this->assign('res',$res);
		$this->display();
	}
	// 添加页
	public function add() {
		if(IS_POST){
			$validate = [
				['brand_name','require','品牌名称不能为空'],
				['brand_name','brand_name','该品牌已存在',2,'unique'],
			];
			// M()是单例模式，同一个对象
			// create() 这个方法可以自动接收post过来的数据
			// 并且自动过滤非数据表字段数据
			// 自动验证数据
			// 自动完成数据
			$res = M('brand')->validate($validate)->create();
			// dump($res);die;
			if(empty($res)){
				return $this->error(M('brand')->getError());
			}
			$id = M('brand')->add();
			if(empty($id)){
				return $this->error('添加失败~');
			}
			return $this->success('添加成功~',U('index'));
		}
		$this->display();
	}
	// 修改页
	public function edit() {
		if(IS_POST){
			$validate = [
				['brand_name','require','品牌名称不能为空'],
				['brand_name','brand_name','该品牌已存在',2,'unique'],
			];
			$_POST['id'] = I('get.id');
			$res = M('brand')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('brand')->getError());
			}
			$row = M('brand')->save();
			if(empty($row)){
				return $this->error('修改失败');
			}
			return $this->success('修改成功',U('index'));
		}
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		// find() 方法后面可以直接接主键
		$res = M('brand')->find(I('id'));
		if(empty($res)){
			return $this->error('无效参数');
		}
		$this->assign('brand',$res);
		$this->display('add');
	}
	// 删除页
	public function del() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		// 检查该品牌下的goods表是否有商品
		// $res = M('goods')->where(['goods_brand_id'=>I('get.id')])->count();
		// 还可以用getField() 方法读取字段值
		// 以下返回的是id 字段最小的一行
		$res = M('goods')->where(['goods_brand_id'=>I('get.id')])->getField('id');
		if(!empty($res)){
			return $this->error('请先删除该品牌下的商品');
		}
		$row = M('brand')->where(['id'=>I('get.id')])->delete();
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
}