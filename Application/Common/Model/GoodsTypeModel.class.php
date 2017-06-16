<?php
namespace Common\Model;
use Think\Model;
class GoodsTypeModel extends Model {
	// 自动验证
	protected $_validate = [
		['type_name','require','模型名称不能为空'],
		['type_name','type_name','该模型名称已存在',2,'unique'],
	];
	
	public function goodsTypeAdd() {
		// 验证数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		$id = $this->add();
		if(empty($id)){
			return '添加失败';
		}
		return (int)$id;
	}
	
	public function goodsTypeList($p,$listRows,$map=[]) {
		$res = $this->where($map)->order('id desc')->page($p,$listRows)->select();
		return $res;
	}
	public function dataCount($map=[]) {
		return $this->where($map)->count();
	}
	public function goodsTypeEdit($id) {
		// 验证数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		$row = $this->where(['id'=>$id])->save();
		if(empty($row)){
			return '更新失败';
		}
		return true;
	}
	public function goodsTypeDel($id) {
		$spec = M('spec')->where(['id'=>$id])->getField('id');
		if(!empty($spec)){
			return '请先删除该模型对应的规格';
		}
		// 进行删除
		$row = $this->delete($id);
		if(empty($row)){
			return '删除失败';
		}
		return true;
	}
}