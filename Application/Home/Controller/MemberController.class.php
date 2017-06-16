<?php
namespace Home\Controller;
class MemberController extends BaseController {
	public function index() {
		$this->display();
	}
	
	public function userInfo() {
		$this->display();
	}
	
	public function address() {
		// 查出user_addr表列表
		$user_addr = D('UserAddr')->relation(true)->where(['user_id' => session('user')['id']])->select();
		$this->assign('user_addr',$user_addr);
		
		$region = M('region')->field('region_id,parent_id,region_name')->where(['parent_id' => 1])->select();
		$this->assign('region',$region);
		$this->display();
	}
	
	public function regionSelect() {
		if(IS_AJAX){
			$region = M('region')->field('region_id,parent_id,region_name')->where(['parent_id' => I('post.region_id')])->select();
			$html = '<option class="first" value="">'.I('post.name').'</option>';
			if(!empty($region)){
				// 组转出select
				foreach($region as $v){
					$html .= '<option value="'.$v['region_id'].'">'.$v['region_name'].'</option>';
				}
			}
			echo $html;
			die();
		}
	}
	
	public function addAddress() {
		// 判断有多少个收货地址
		$count = D('UserAddr')->where(['user_id' => session('user')['id']])->count();
		if($count >= 4){
			die('最多添加四个收货地址，请先删除再来添加');
		}
		if(IS_POST){
			$res = D('UserAddr')->addAddress();
			if(!is_numeric($res)){
				die($res);
			}
			die('添加成功');
		}
	}
	
}