<?php
namespace Home\Controller;
class CartController extends BaseController {
	// 用户的标识
	protected $user_key = null;
	
	// 用户id
	protected $user_id = null;
	
	// 初始化工作
	protected function _initialize() {
		$this->user_key = cookie('user-key');
		if(empty($this->user_key)){
			$this->user_key = md5(uniqid(rand(),true));
			// 写入cookie
			// setcookie('user-key',json_encode($this->user_key),time() + 3600*24*7,'/');
			cookie('user-key',$this->user_key,3600*24*7);
		}
		/*
		if(session('?user')){
			if($this->user_key != session('?user')['id']){
				// 更新cart表
				M('cart')->where(['user_key' => $this->user_key])->save([
					'user_key' => session('user')['id'],
				]);
				$this->user_key = session('user')['id'];
			}
		}
		else{
			$this->user_key = cookie('user-key');
		}
		*/
		if(session('?user')){
			if(!isset($this->user_id)){
				$this->user_id = session('user')['id'];
			}
		}
	}

	// 搜索关键字
	protected $keywords = null;
	
	public function index() {
		// 搜索框
		if(IS_GET){
			$this->keywords = I('get.keywords');
		}

		// 购物车商品信息
		$res = $this->get_spec_items();
		$this->assign('res',$res);
		dump($res);
		// 统计信息
		$total = $this->total();
		$this->assign('total',$total);
		$this->display();
	}
	
	public function get_spec_items() {
		// 查出所有的items
		$items = M('spec_items')->select();
		$i = [];
		foreach($items as $k => $v){
			$i[$v['id']] = & $items[$k];
		}
		$res = $this->getCartInfo();
		foreach($res as $k => $v){
			if(!empty($v['goods_spec_key'])){
				$v['goods_spec_key'] = explode(',',$v['goods_spec_key']);
				foreach($v['goods_spec_key'] as $value){
					$res[$k]['goods_spec_item'][] = $i[$value]['items'];
					
				}
				$res[$k]['goods_spec_item'] = implode(',',$res[$k]['goods_spec_item']);
			}
			
			/*
			$res[$k]['goods_spec_key'] = explode(',',$v['goods_spec_key']);
			if(!empty($res[$k]['goods_spec_key'])){
				foreach($res[$k]['goods_spec_key'] as $key => $value){
					$res[$k]['goods_spec_key'][$key] = $i[$value]['items'];
				}
			}
			*/
		}
		unset($items);
		unset($i);
		return $res;
	}
	
	public function addToCart() {
		if(IS_AJAX){
			
			// 接收数据
			$goods_id = I('goods_id');
			$number = I('number');
			$goods_spec_key = !empty($_POST['goods_spec_key']) ? $_POST['goods_spec_key'] : 0;
			$usr_id = empty($this->user_id) ? 0 : $this->user_id;
			
			// 确定该商品存在
			$goods = $this->getGoodsInfo($goods_id,$goods_spec_key);
			if(empty($goods)){
				die('添加购物车失败');
			}
			
			// 判断该商品是否存在购物车中
			$map = [
				'goods_id' => $goods_id,
			];
			if(empty($this->user_id)){
				$map['user_key'] = $this->user_key;
			}
			else{
				$map['user_id'] = $this->user_id;
			}
			
			if(!empty($goods_spec_key)){
				$map['goods_spec_key'] = $goods_spec_key;
			}
			$cart_goods = M('cart')
						  ->field('id,number')
						  ->where($map)
						  ->find();
			// 为空做添加
			if(empty($cart_goods)){
				// 组装数据
				$data = [
					'user_id' => $usr_id,
					'user_key' => $this->user_key,
					'goods_id' => $goods['id'],
					'goods_spec_key' => $goods_spec_key,
					'number' => $number,
				];
				// 开始添加
				$cart_id = M('cart')->add($data);
				if(empty($cart_id)){
					die('加入购物车失败');
				}
				die('加入购物车成功');
			}
			// 否则做修改
			else{
				$data = [
					// 'id' => $cart_goods['id'],
					'number' => $number + $cart_goods['number'],
				];
				$row = M('cart')
					   ->where(['id' => $cart_goods['id']])
					   ->fetchSql(false)
					   ->save($data);
				if(empty($row)){
					die('加入购物车失败');
				}
				die('加入购物车成功');
			}
			
			
		}
	}
	
	// 统计方法
	protected function total() {
		// 查出购物车中的商品
		$res = $this->getCartInfo();
		$total_number = 0;
		$total_price = 0;
		foreach($res as $v){
			$price = !empty($v['spec_price']) ? $v['spec_price'] : $v['shop_price'];
			// 如果该商品选中
			if($v['selected'] == 1){
				$total_number += $v['number'];
				$total_price += $price * $v['number'];
			}
		}
		// 返回结果
		return [
			'total_price' => $total_price,
			'total_number' => $total_number,
		];
	}
	
	protected function getGoodsInfo($goods_id = 0,$goods_spec_key = '') {
		$map = ['g.id' => $goods_id];
		if(!empty($goods_spec_key)){
			$map['spec_key'] = $goods_spec_key;
		}
		return M('goods as g')
				 ->field('g.id,g.goods_name,g.shop_price,g.market_price,g.image,s.spec_price')
				 ->join('left join goods_spec as s on g.id = s.goods_id')
				 ->where($map)
				 ->fetchSql(false)
				 ->find();
	}
	
	// 获取购物车商品信息方法
	protected function getCartInfo() {
		$map = [
			'g.goods_name' => ['like',"%{$this->keywords}%"],
		];
		if(empty($this->user_id)){
			$map['user_key'] = $this->user_key;
		}
		else{
			$map['user_id'] = $this->user_id;
		}
		return M('cart as c')
				->field('c.id,c.goods_id,c.number,g.goods_name,g.market_price,g.shop_price,g.image,s.spec_price,c.selected,c.goods_spec_key')
				->join('left join goods as g on g.id = c.goods_id')
				->join('left join goods_spec as s on s.goods_id = c.goods_id and s.spec_key = c.goods_spec_key')
				->where($map)
				->fetchSql(false)
				->select();
	}
	
	public function del() {
		if(IS_AJAX){
			// 进行删除
			$row = M('cart')->delete(I('get.id'));
			if(empty($row)){
				die(json_encode([
					'code' => 1,
					'msg' => '删除失败',
				]));
			}
			die(json_encode([
				'code' => 0,
				'msg' => '删除成功',
				'total' => $this->total(),
			]));
		}
	}
	
	public function delAll() {
		if(empty($this->user_id)){
			$map = [
				'user_key' => $this->user_key,
			];
		}
		else{
			$map = [
				'user_id' => $this->user_id,
			];
		}
		
		$row = M('cart')->where($map)->delete();
		if(empty($row)){
			return $this->error('清空购物车失败');
		}
		return $this->success('清空购物车成功',U('index'));
	}
	
	public function edit() {
		/*
		// 组装数据
		$data = [
			'number' => I('post.number'),
		];
		*/
		$row = M('cart')->fetchSql(false)->save(I());
		if(empty($row)){
			die();
		}
		die(json_encode([
			'total' => $this->total(),
		]));
	}

	public function selected() {
		if(IS_AJAX){
			// 对selected处理
			$_POST['selected'] = I('selected') == 'true' ? 1 : 0;

			$this->edit();
		}
	}

	public function selectedAll() {
		if(IS_AJAX){
			// 对selected处理
			$_POST['selected'] = I('selected') == 'true' ? 1 : 0;
			if(empty($this->user_id)){
			$map = [
				'user_key' => $this->user_key,
				];
			}
			else{
				$map = [
					'user_id' => $this->user_id,
				];
			}
			$row = M('cart')->where($map)->fetchSql(false)->save(I());
			if(empty($row)){
				die();
			}
			die(json_encode([
				'total' => $this->total(),
			]));
		}
	}
	
	// 点击结算检查用户是否有登陆方法
	public function checkLogin() {
		// 检查session
		if( ! session('?user')){
			die(json_encode([
				'code' => 1,
				'msg' => '您还没登陆，是否现在登陆?',
			]));
		}
		die(json_encode([
			'code' => 0,
		]));
	}
	
	// 登陆后更新cart方法
	public function editUserId() {
		if(!empty($this->user_id)){
			M('cart')->where(['user_key' => $this->user_key])->save(['user_id' => $this->user_id]);
		}
	}
	
	/*
	create table cart(
		id int unsigned not null auto_increment primary key,
		user_id int unsigned not null,
		user_key char(32) not null,
		goods_id int unsigned not null,
		goods_spec_key char(50) not null,
		number int unsigned not null,
		selected tinyint unsigned not null
	);
	*/
	
}