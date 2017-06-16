<?php
namespace Common\Model;
class UserAddrModel extends \Think\Model\RelationModel {
	// 关联模型
	protected $_link = [
		'province' => [
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Region',
			'foreign_key' => 'province_id',
			'mapping_fields' => 'region_name',
		],
		'city' => [
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Region',
			'foreign_key' => 'city_id',
			'mapping_fields' => 'region_name',
		],
		'area' => [
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Region',
			'foreign_key' => 'area_id',
			'mapping_fields' => 'region_name',
		],
	];
	
	// 自动验证
	protected $_validate = [
		['province_id','require','请选择省份'],
		['city_id','require','请选择城市'],
		['name','require','请填写收货人'],
		['phone','require','请填写联系电话'],
		['addr','require','请填写详尽地址'],
		['phone','/^0{0,1}(13[4-9]|15[7-9]|15[0-2]|18[7-8])[0-9]{8}$/','请输入正确的手机号码',2,'regex'],
	];
	
	public function addAddress() {
		// 收集数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		$res['user_id'] = session('user')['id'];
		// 开始添加
		$id = $this->add($res);
		if(empty($id)){
			return '添加失败';
		}
		return $id;
	}
}