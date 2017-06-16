<?php
namespace Home\Controller;
class IndexController extends BaseController {
    public function index() {
        $this->display();
    }
	public function contact_us() {
		if(IS_POST){
			$res = D('Message')->messageAdd();
			die($res);
		}
		$this->display();
	}
	
}