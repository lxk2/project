<?php
namespace Admin\Controller;
class GoodsController extends BaseController {
	public function index() {
		// 搜索
		$map = [];
		if(IS_GET){
			$keywords = I('get.keywords');
			$map['goods_name'] = ['like',"%{$keywords}%"];
			$map['cate_name'] = ['like',"%{$keywords}%"];
			$map['brand_name'] = ['like',"%{$keywords}%"];
			$map['_logic'] = 'or';
		}
		// 总记录数
		$count = D('Goods')->where($map)->count();
		// 每页显示的记录数
		$listRows = 2;
		$page = new \Think\Page($count,$listRows);
		// 显示分页
		$this->assign('page',$page->show());
		$res = D('Goods')->goodsList($listRows,$map);
		$this->assign('res',$res);
		$this->display();
	}
	
	// 控制器前置操作
	public function _before_add(){
		
	}
	
	 function _after_add(){
		
	}
	
	public function add() {
		if(IS_POST){
			$res = D('Goods')->goodsAdd();
			if($res !== true){
				return $this->error($res);
			}
			return $this->success('添加成功',U('index'));
		}
		$res = D('Goods')->goodsCate_Brand();
		$this->assign('res',$res);
		$this->display();
	}
	public function edit() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		if(IS_POST){
			$res = D('Goods')->goodsEdit();
			if($res !== true){
				return $this->error($res);
			}
			return $this->success('更新成功',U('index'));
		}
		// 根据id查出当前数据
		$goods = D('Goods')->goodsFind();
		$this->assign('goods',$goods);
		// 分类、品牌信息
		$res = D('Goods')->goodsCate_Brand();
		$this->assign('res',$res);
		$this->display('add');
	}
	public function del() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		$res = D('Goods')->goodsDel();
		if($res !== true){
			return $this->error($res);
		}
		return $this->success('删除成功',U('index'));
	}
	
	public function upload($file_name = 'pic') {
		
		if(IS_POST){
			// 实例化上传类
			$upload = new \Think\Upload();
			// 上传文件大小限制
			$upload->maxSize = 3145728;
			// 上传文件类型
			$upload->exts = ['jpg','png','jpeg','gif'];
			// 设置文件上传目录
			$upload->rootPath = './Public/Uploads/';
			// 判断目录是否存在			还不够好
			if(!is_dir($upload->rootPath)){
				mkdir($upload->rootPath);
			}
		
			// 上传单个文件
			$info = $upload->uploadOne($_FILES[$file_name]);
			// 上传错误提示信息
			if(empty($info)){
				die(json_encode(['code' => 1,'msg' => $upload->getError()]));
			}
			// 组装路径
			$path = $upload->rootPath . $info['savepath'] . $info['savename'];
			die(json_encode(['code' => 0,'msg' => $path]));
		}
		
		
		$this->display();
	}

	public function spec_items() {
		if(IS_GET){
			// 对数据进行分组,处理接受到id查出对应的规格选项
			$items = M('spec_items')->order('spec_id asc')->where(['id' => ['in',I('get.id')]])->select();
			$items_id = [];
			// 定义一个空数组
			$spec_items = [];
			foreach($items as $k => $v){
				$items_id[$v['spec_id']][] = $v['id'];
				// 使这个数组下标等于规格选项id
				$spec_items[$v['id']] = & $items[$k]; 
			}
			// 取出spec_id ( key值 )
			$spec_id = array_keys($items_id);
			// 查出对应的spec_name
			$spec = M('spec')->where(['id' => ['in',$spec_id]])->select();
			
			// 查出数据排列组合的笛卡尔积
			$res = get_array_group($items_id);
			
			// 传进来的spec_price
			$spec_price = I('get.spec_price');
			// 组装表格
			$table = '<table><tr>';
			$th = '';
			foreach($spec as $v){
				$th .= '<th>'.$v['spec_name'].'</th>';
			}
			$th .= '<th>价格</th></tr>';
			$table .= $th;
			$td = '';
			$i = 0;
			foreach($res as $val){
				
				$td .= '<tr>';
				$tmp = [];
				foreach($val as $value){
					$td .= '<td>'.$spec_items[$value]['items'].'</td>';
					$tmp[] = $value;
				}
				// 数组转字符串
				$str = implode(',',$tmp);
				if(empty($_GET['price'])){
					$td .= '<td><input name="spec['.$str.']"></td>';
				}
				else{
					$td .= "<td><input name=\"spec[$str]\" value=\"{$_GET['price'][$i]}\"></td>";
				}
				$td .= '</tr>';
				++$i;
			}
			$table .= $td;
			$table .= '</table>';
			
			die($table);
		}
		// 查出所有的商品模型
		$res = D('GoodsType')->select();
		// 显示第一个
		$active = $res[0]['id'];
		$this->assign('active',$active);
		
		$tmp = [];
		foreach($res as $k => $v){
			$res[$k]['child'] = D('Spec')->relation('spec_items')->where(['type_id' => $v['id']])->select();
		}
		// 传输数据
		$this->assign('res',$res);
		$this->display();
	}

}