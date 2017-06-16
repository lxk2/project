<?php
namespace Common\Model;
use \Think\Model;
class SpecModel extends Model\RelationModel {
	// 关联定义
	protected $_link = [
		'spec_items' => [
			'mapping_type' => self::HAS_MANY,
			// class_name 如果没有这个模型类，会自动去找名字对应的数据表
			'class_name' => 'SpecItems',
			// mapping_fields  关联要查询的字段 默认情况下，关联查询的关联数据是关联表的全部字段，如果只是需要查询个别字段，可以定义关联的mapping_fields属性。
			'mapping_fields' => 'id,items',
		],
		'goods_type' => [
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'GoodsType',
			// 关联的外键名称 外键的默认规则是当前数据对象名称_id
			// 即，此时默认外键名称为goods_type_id 
			'foreign_key' => 'type_id',
		],
	];
	// 自动验证
	protected $_validate = [
		// 需要验证的表单字段名称，这个字段不一定是数据库字段，也可以是表单的一些辅助字段，例如确认密码和验证码等等。有个别验证规则和字段无关的情况下，验证字段是可以随意设置的，例如expire有效期规则是和表单字段无关的。如果定义了字段映射的话，这里的验证字段名称应该是实际的数据表字段而不是表单字段。
		['spec_name','require','规格名称不能为空'],
		['type_id','require','商品模型不能为空'],
		['items','require','规格选项不能为空'],
		['spec_name','spec_name','规格名称已存在',2,'unique'],
	];
	
	public function specAdd() {
		// spec
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		
		// spec_items
		$items = I('post.items');
		// 字符串转数组 explode()
		$items = explode("\r\n",$items);
		// 去除空格
		$items = array_map('trim',$items);
		// 去除重复
		$items = array_unique($items);
		$tmp = [];
		foreach($items as $k => $v){
			if(empty($v)){
				continue;
			}
			$tmp[] = ['items' => $v];
		}
		// 把tmp[]组装进$res
		// 注意這里要写关联名称
		$res['spec_items'] = $tmp;
		$id = $this->relation('spec_items')->add($res);
		if(empty($id)){
			return '添加失败';
		}
		return (int)$id;
	}
	public function specList($listRows=2,$map=[]) {
		// 查出数据总量
		$count = $this->where($map)->count();
		// 查出数据
		$res = $this->relation('goods_type')->where($map)->order('id desc')->page(I('p',1),$listRows)->select();
		return [
			'count' => $count,
			'res' => $res,
			'listRows' => $listRows,
		];
	}
	public function specFind() {
		return $this->relation('spec_items')->find(I('get.id'));
	}
	public function specEdit() {
		// spec
		$res = $this->create();
		if(empty($res)){
			return $this->getError();
		}
		// spec_items
		$items = I('post.items');
		// 字符串转数组
		$items = explode("\r\n",$items);
		// 去除空格
		$items = array_map('trim',$items);
		// 去除重复
		$items = array_unique($items);
		$tmp = [];
		foreach($items as $v){
			if(empty($v)){
				continue;
			}
			$tmp[] = ['items' => $v];
		}
		// $old = M('spec_items')->field('items')->where(['spec_id' => I('get.id')])->select();
		// $del = array_diff($old,$tmp);
		// $add = array_diff($tmp,$old);
		// return $old;
		$res['spec_items'] = $tmp;
		// 先删除旧的
		$old = M('spec_items')->where(['spec_id' => I('get.id')])->delete();
		// 或者删除old 与 new的差集 ， 添加new 与 old 的差集
		// 更新的时候把主键组装进去就不会加where条件了
		$row = $this->relation('spec_items')->save($res);
		if(empty($row)&&empty($old)){
			return '更新失败';
		}
		return true;
	}
	public function specDel() {

		// 事务开启
		$this->startTrans();
		// 先删除选项表
		$row = M('spec_items')->where(['spec_id' => I('get.id')])->delete();
		if(empty($row)){
			$this->rollback();
			return '删除失败';
		}
		
		// 还要删除商品套餐
		
		// 再删除规格表
		$res = $this->delete(I('get.id'));
		if(empty($res)){
			$this->rollback;
			return '删除失败';
		}
		// 此时删除成功
		// 提交事务
		$this->commit();
		return true;
		
		/*
		有外键的时候是先删除主表再删除从表
		// 或者关联删除
		$res = $this->relation('spec_items')->delete(I('get.id'));
		if(empty($res)){
			return '删除失败';
		}
		return true;
		*/
	}
}