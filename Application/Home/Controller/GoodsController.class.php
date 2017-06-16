<?php
namespace Home\Controller;
class GoodsController extends BaseController {
	public function index() {
		// 找出商品分类
		$tmp = $this->goods_cate();
		$this->assign('cate',$tmp);
		$cid = I('get.cid',$tmp[0]['id']);
		$this->assign('cid',$cid);
		// 实例化Page类
		// 总记录数
		$count = D('Goods')->where(['category_id' => $cid])->count();
		// 每页显示的记录数
		$listRow = 2;
		$page = new \Think\Page($count,$listRow);
		$this->assign('page',$page->show());
		// 根据cid查出对应分类的商品
		$res = D('Goods')->where(['category_id' => $cid])->order('id desc')->page(I('get.p',1),$listRow)->select();
		$this->assign('res',$res);
		$this->display();
	}
	
	public function desc() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		// 根据id查询商品
		$goods = D('Goods')->field('id,goods_name,shop_price,image,category_id')
						   ->find(I('get.id'));
		$this->assign('goods',$goods);
		dump($goods);
		// 根据id找出套餐
		$spec = M('goods_spec')->field('goods_id,spec_price,spec_key')
							   ->where(['goods_id' => I('get.id')])
							   ->select();
		if(!empty($spec)){
			$spec_key = [];
			foreach($spec as $v){
				// 字符串转数组
				$v['spec_key'] = explode(',',$v['spec_key']);
				$spec_key = array_merge($spec_key,$v['spec_key']);
			}
			// 去除重复
			$spec_key = array_unique($spec_key);
			unset($spec);
			// 找出套餐选项spec_items
			$items = M('spec_items')->field('id,items,spec_id')->where(['id' => ['in',$spec_key]])->order('spec_id asc')->select();
		
			$spec_id = [];
			foreach($items as $v){
				$spec_id[$v['spec_id']][] = $v;
			}
		
			// 取出key值
			$s_id = array_keys($spec_id);
			// 根据spec_id 找出spec_name
			$spec_name = M('spec')->field('id,spec_name')->where(['id' => ['in',$s_id]])->order('id asc')->select();
			$tmp = [];
			foreach($spec_name as $v){
				$tmp[$v['spec_name']] = & $spec_id[$v['id']];
			}
			dump($tmp);
			// 传输数据
			$this->assign('spec_items',$tmp);
		}
		
		
		// 浏览记录 保存到cookie ------------------------------------------------
		// 先取出原来的历史记录
		// $history = cookie('history');
		// json_decode()转回来默认是个对象,此时要给第二个参数true
		$history = !empty($_COOKIE['history']) ? json_decode($_COOKIE['history'],true) : [];
		$this->assign('history',$history);
		
		// 填充数据
		$history[I('get.id')] = [
			'image' => $goods['image'],
		];
		
		if(count($history) > 3){
			array_shift($history);
		}
		
		// 写入到cookie
		// cookie('history',$history,5*60);
		setcookie('history',json_encode($history),time()+3600*24*7,'/');
		
		// ------------------------------------------------------------------------
		
		// 找出商品分类
		$tmp = $this->goods_cate();
		$this->assign('cate',$tmp);
		$cid = I('get.cid',$tmp[0]['id']);
		$this->assign('cid',$cid);
		// 加载视图
		$this->display();
	}
	
	protected function goods_cate() {
		// 找出商品分类
		$cate = M('category')->select();
		$cate = cate_tree($cate);
		$tmp = [];
		$level = 0;
		foreach($cate as $v){
			// 定位到商品
			if($v['cate_name'] == '产品'){
				$level = $v['level'];
				continue;
			}
			if($level != 0){
				if($v['level'] == $level+1){
					$tmp[] = $v;
				}
				if($v['level'] == $level){
					break;
				}
			}
		}
		unset($cate);
		return $tmp;
	}
	
	public function ajax_spec_key() {
		if(IS_AJAX){
			$map = [
				'spec_key' => I('spec_key'),
				'goods_id' => I('goods_id'),
			];
			die(json_encode(M('goods_spec')->where($map)->getField('spec_price')));
		}
	}
}