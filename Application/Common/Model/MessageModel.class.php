<?php
namespace Common\Model;
use \Think\Model;
class MessageModel extends Model {
	// 自动验证
	protected $_validate = [
		['name','require','姓名不能为空'],
		['tel','require','电话不能为空'],
		['email','require','邮箱不能为空'],
		['content','require','内容不能为空'],
		
		['tel','/(^(\d{3,4}-)?\d{7,8})$|(13[0-9]{9})/','请输入正确的电话号码',2,'regex'],
		['email','/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/','请输入正确的邮箱地址',2,'regex'],
		
	];
	
	public function messageAdd() {
		// 收集数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		// 添加数据
		$id = $this->add();
		if(empty($id)){
			return '添加失败';
		}
		return true;
	}
	
	public function messageList($listRow,$map=[]) {
		// 查询数据
		$res = $this->field('id,name')
					->where($map)
					->order('id desc')
					->page(I('p',1),$listRow)
					->select();
		return $res;
	}
	
	public function messageDel() {
		$row = $this->delete(I('get.id'));
		if(empty($row)){
			return '删除失败';
		}
		return true;
	}
}