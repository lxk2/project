<?php
namespace Common\Model;
use \Think\Model;
class GoodsModel extends Model\RelationModel {
	// 自动验证
	protected $_validate = [
		['goods_name','require','商品名称不能为空'],
		['image','require','请上传商品主图'],
		['category_id','require','请选择商品分类'],
		['goods_brand_id','require','请选择商品品牌'],
		['market_price','require','市场价不能为空'],
		['shop_price','require','网店价不能为空'],
		
		['goods_name','goods_name','该商品名称已存在',2,'unique'],
		['market_price','/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/','市场价只能是数字',2,'regex'],
		['shop_price','/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/','网店价只能是数字',2,'regex'],
		// ['market_price','number','市场价只能是数字',2],
		// ['shop_price','number','网店价只能是数字',2],
	];
	
	// 关联模型
	protected $_link = [
		// 关联分类
		'category' => [
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Category',
			// 关联要查询的字段
			'mapping_fields' => 'cate_name',
			'foreign_key' => 'category_id',
		],
		// 关联brand
		'brand' => [
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Brand',
			'foreign_key' => 'goods_brand_id',
			'mapping_fields' => 'brand_name',
		],
		// 关联goods_desc
		'goods_desc' => [
			'mapping_type' => self::HAS_ONE,
			'class_name' => 'GoodsDesc',
			'foreign_key' => 'goods_id',
		],
		// 关联goods_pic
		'goods_pic' => [
			'mapping_type' => self::HAS_MANY,
			'class_name' => 'GoodsPic',
			'foreign_key' => 'goods_id',
		],
		// 关联goods_spec
		'goods_spec' => [
			'mapping_type' => self::HAS_MANY,
			'class_name' => 'GoodsSpec',
			'foreign_key' => 'goods_id',
		],
	];
	
	public function goodsAdd() {
		// 收集数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		// 添加详情
		$res['goods_desc'] = ['content' => $_POST['content']];
		unset($_POST['content']);
		// 添加相册
		if(!empty($_POST['pic'])){
			// 最大相册图片数记数
			$c = 0;
			foreach($_POST['pic'] as $v){
				++$c;
				if($c>5){
					break;
				}
				$res['goods_pic'][] = ['pic' => $v];
			}
		}
		// 添加套餐
		if(!empty($_POST['spec'])){
			// 去除空格
			$_POST['spec'] = array_map('trim',$_POST['spec']);
			foreach($_POST['spec'] as $k => $v){
				// 先对$v强制转换
				$v = (float)$v;
				if(!empty($v)){
					$res['goods_spec'][] = ['spec_price' => $v,'spec_key' => $k];
				}
			}
		}
		// 添加数据
		$id = $this->relation(true)->add($res);
		if(empty($id)){
			return '添加失败';
		}
		return true;
	}
	
	public function goodsList($listRows,$map=[]) {
		// 分页数据
		// ralation([])
		$res = $this->field('goods.id,goods.goods_name,goods.image,category.cate_name,brand.brand_name')->join('category on goods.category_id = category.id')->order('id desc')->join('brand on goods.goods_brand_id = brand.id')->where($map)->page(I('p',1),$listRows)->select();
		return $res;
	}
	
	public function goodsDel() {
		// 开启事务
		$this->startTrans();
		$map = ['goods_id' => I('get.id')];
		// 再删除goods_desc
		$row = M('goods_desc')->where($map)->delete();
		if(empty($row)){
			$this->rollback();
			return '删除失败';
		}
		// 再删除goods_pic
		$res = M('goods_pic')->where($map)->count();
		if(!empty($res)){
			$row = M('goods_pic')->where($map)->delete();
			if(empty($row)){
				$this->rollback();
				return '删除失败';
			}
		}
		// 再删除goods_spec
		$res = M('goods_spec')->where($map)->count();
		
		if(!empty($res)){
			$row = M('goods_spec')->where($map)->delete();
			if(empty($row)){
				$this->rollback();
				return '删除失败';
			}
		}
		// 最后删除goods
		$row = $this->delete(I('get.id'));
		if(empty($row)){
			$this->rollback();
			return '删除失败';
		}
		// 提交数据
		$this->commit();
		return true;
	}
	
	public function goodsEdit() {
		// 组装id
		$_POST['id'] = I('get.id');
		// 收集数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		// 组装详情
		$res['goods_desc'] = ['content' => $_POST['content']];
		unset($_POST['content']);
		// 组装相册
		if(!empty($_POST['pic'])){
			$c = 0;
			foreach($_POST['pic'] as $v){
				++$c;
				if($c > 5){
					break;
				}
				$res['goods_pic'][] = ['pic' => $v];
			}
			unset($_POST['pic']);
		}
		// 组装套餐
		if(!empty($_POST['spec'])){
			// 先对每个值做去除空格处理
			$_POST['spec'] = array_map('trim',$_POST['spec']);
			foreach($_POST['spec'] as $k => $v){
				$v = (float)$v;
				if(!empty($v)){
					$res['goods_spec'][] = ['spec_price' => $v,'spec_key' => $k];
				}
			}
			unset($_POST['spec']);
		}
		// 开启事务
		$this->startTrans();
		$map = ['goods_id' => I('get.id')];
		// 删除详情
		$row = M('goods_desc')->where($map)->delete();
		if(empty($row)){
			$this->rollback();
			return '更新失败';
		}
		// 删除相册
		$res = M('goods_pic')->where($map)->count();
		if(!empty($res)){
			$row = M('goods_pic')->where($map)->delete();
			if(empty($row)){
				$this->rollback();
				return '更新失败';
			}
		}
		
		// 删除套餐
		$res = M('goods_spec')->where($map)->count();
		if(!empty($res)){
			$row = M('goods_spec')->where($map)->delete();
			if(empty($row)){
				$this->rollback();
				return '更新失败';
			}
		}
		
		// 开始修改
		$goods_row = $this->relation(['goods_desc','goods_spec','goods_pic'])->save();
		if(empty($goods_row)){
			$this->rollback();
			return '更新失败';
		}
		$this->commit();
		return true;
	}
	
	public function goodsFind() {
		$res = $this->relation(['goods_spec','goods_desc','goods_pic'])->find(I('get.id'));
		$spec_key = [];
		$spec_price = [];
		foreach($res['goods_spec'] as $k => $v){
			$spec_price[$v['spec_key']] = $v['spec_price'];
			// 字符串转数组
			$v['spec_key'] = explode(',',$v['spec_key']);
			
			foreach($v['spec_key'] as $value){
				$spec_key[] = $value;
			}
		}
		// 去除重复
		$spec_key = array_unique($spec_key);
		// 数组转字符串
		$spec_key = implode(',',$spec_key);
		$res['goods_spec'] = $spec_key;
		$res['spec_price'] = $spec_price;
		return $res;
	}
	
	public function goodsCate_Brand() {
		// 找出商品分类
		$cate = M('category')->select();
		$cate = cate_tree($cate);
		// 先定位到商品
		$tmp = [];
		$level = 0;
		foreach($cate as $v){
			if($v['cate_name'] == '产品'){
				$level = $v['level'];
				continue;
			}
			if($level != 0){
				if($v['level'] > $level){
					$tmp[] = $v;
				}
				else{
					break;
				}
			}
		}
		unset($cate);
		// 找出商品品牌
		$brand = M('brand')->select();
		// 返回分类与品牌信息
		return [
			'cate' => $tmp,
			'brand' => $brand,
		];
	}
	
}