<?php
namespace Admin\Controller;
class SpecController extends BaseController {
	public function index() {
		$map = [];
		if(IS_GET){
			$keywords = I('get.keywords');
			$map['spec_name'] = ['like',"%{$keywords}%"];
			// 查出goods_type表 id=>type_name
			$ids = M('goods_type')->where(['type_name' => ['like',"%{$keywords}%"]])->getField('id,type_name');
			// 模糊查找出来可能有多个 是个二维数组
			$type_ids = array_keys($ids);
			// 不是join所以还是在同一张表内做模糊查询，所以要把上面查询出来的goods_type表的内容转化为spec表中的对应字段
			$map['type_id'] = ['in',$type_ids];
			// 两个模糊查找之间连接方式
			$map['_logic'] = 'or';
		}
		$res = D('Spec')->specList(2,$map);
		dump($res);
		// 实例化Page类
		$page = new \Think\Page($res['count'],$res['listRows']);
		$this->assign('page',$page->show());
		$this->assign('res',$res['res']);
		$this->display();
	}
	public function add() {
		if(IS_POST){
			$res = D('Spec')->specAdd();
			if(is_string($res)){
				return $this->error($res);
			}
			return $this->success('添加成功',U('index'));
		}
		// 找出所有商品模型
		$type = D('GoodsType')->select();
		$this->assign('type',$type);
		$this->display();
	}
	public function edit() {
		// 更新的时候把主键组装进去就不会加where条件了
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		
		if(IS_POST){
			// 组合主键id
			$_POST['id'] = I('get.id');
			$res = D('Spec')->specEdit();
			if($res !== true){
				return $this->error($res);
			}
			return $this->success('更新成功',U('index'));
		}
		
		$spec = D('Spec')->specFind();
		// 数组转字符串
		$str = '';
		foreach($spec['spec_items'] as $v){
			$str .= implode("\r\n",$v)."\r\n";
		}
		$spec['spec_items'] = $str;
		// unset($str);
		$this->assign('spec',$spec);
		// 查出所有的商品模型
		$type = D('GoodsType')->select();
		$this->assign('type',$type);
		$this->display('add');
	}
	public function del() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		$res = D('Spec')->specDel();
		if($res !== true){
			return $this->error($res);
		}
		return $this->success('删除成功',U('index'));
	}
}