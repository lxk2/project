<?php
namespace Admin\Controller;
class CategoryController extends BaseController {
	// 列表页
	public function index() {
		$map = [];
		if(IS_GET){
			$keywords = I('get.keywords');
			$map['cate_name'] = ['like',"%{$keywords}%"];
		}
		
		// 实例化\Think\Page 类
		// 总的记录数
		$totalRows = M('category')->where($map)->count();
		// 每页显示记录数
		$listRows = 10;
		$page->rollPage = 4;
		//dump($listRows);
		$page = new \Think\Page($totalRows,$listRows);
		// 传输数据
		$this->assign('page',$page->show());
		
		// 查出数据
		$res = M('category')->field('id,cate_name,parent_id')->where($map)->order('id desc')->page(I('p',1),$listRows)->select();
		// 传输数据
		$this->assign('res',$res);
		$this->display();
	}
	// 添加页
	public function add() {
		if(IS_AJAX){
			// 这种AJAX显示分类不需要用到无级分类
			$data = M('category')->where(['parent_id'=>I('get.parent_id')])->select();
			if(!empty($data)){
				// $this->assign('data',$data);
				$str = '<div class="form-group sele">
						<div class="label">
						  <label>'.I('get.str').'分类：</label>
						</div>
		<div class="field sele">
							  <select name="" onchange="choose(this)" class="input w50"><option value="">-- choose --</option>';
				foreach($data as $value){
					$str .= '<option value="'.$value['id'].'">'.$value['cate_name'].'</option>';
				}
				$str .= '</select>
							  <div class="tips"></div>
						</div></div>';
				echo $str;
			}
			die;
		}
		if(IS_POST){
			// 验证字段
			$validate = [
				['cate_name','require','分类名称不能为空'],
			];
			$res = M('category')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('category')->getError());
			}
			// 添加数据
			$id = M('category')->add();
			if(empty($id)){
				return $this->error('添加失败');
			}
			return $this->success('添加成功',U('index'));
		}
		// 显示分类
		$data = M('category')->field('id,cate_name,parent_id')->select();
		// $cate = cate_tree($data);
		
		// 传址引用实现无限级分类(效率最高)
		// 先定义两个空数组
		
		// 首先必须拿到下标为id 的這样一个数组
		// 其次，信定义的数组必须与这个下标为id 的数组 传址引用
		
		// $refer = [];
		// foreach($data as $k => $v){
			// $c[$v['id']] = $data[$k];
			// unset($data[$k]);
			// if($v['parent_id'] == 0){
				// $refer[] = & $c[$v['id']];
			// }
			// else{
				// $parent = & $c[$v['parent_id']];
				// $parent['child'][] = & $c[$v['id']];
			// }
		// }
		
		// echo '<pre>';
		// print_r($refer);
		// echo '</pre>';
		
		// 传输数据
		$this->assign('cate',$data);
		
		$this->display();
	}
	// 修改页
	public function edit() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		// 提交表单
		if(IS_POST){
			// 验证数据
			$validate = [
				['cate_name','require','分类名称不能为空'],
				['parent_id','id','此项不可选',2,'unique'],
			];
			$res = M('category')->validate($validate)->create();
			if(empty($res)){
				return $this->error(M('category')->getError());
			}
			// 更新数据
			$row = M('category')->where(['id'=>I('get.id')])->save();
			if(empty($row)){
				return $this->error('更新失败');
			}
			return $this->success('更新成功',U('index'));
		}
		// 查出当前数据
		$data = M('category')->field('id,cate_name,parent_id')->where(['id'=>I('get.id')])->find();
		$this->assign('data',$data);
		// 查出所有数据
		$data = M('category')->field('id,cate_name,parent_id')->select();
		$cate = cate_tree($data);
		$level = 0;
		foreach($cate as $k => $v){
			// 找到自己，然后把自己的$v['level']赋值给$level，此时$level 就不等于0
			if($v['id'] == $_GET['id']){
				$level = $v['level'];
				// unset($cate[$k]);
				continue;
			}
			// 当$level 被赋值的时候进来
			if($level != 0){
				// 删除比自己等级大的项
				if($v['level'] > $level){
					unset($cate[$k]);
				}
				// 删除完所有比自己大的项就退出循环
				else{
					break;
				}
			}	
		}
		
		$this->assign('cate',$cate);
		
		$this->display('add');
	}
	public function del() {
		if(empty($_GET['id'])){
			return $this->error('非法访问');
		}
		// 检查该分类下是否还有分类
		$cate = M('category')->where(['parent_id'=>I('get.id')])->find();
		if(!empty($cate)){
			return $this->error('请先删除该分类下的所有子分类');
		}
		// 检查goods 表是否有该分类的商品
		$res = M('goods')->where(['category_id'=>I('get.id')])->getField('id');
		if(!empty($res)){
			return $this->error('请先删除该分类下的商品');
		}
		// 删除分类
		$row = M('category')->where(['id'=>I('get.id')])->delete();
		if(empty($row)){
			return $this->error('删除失败');
		}
		return $this->success('删除成功',U('index'));
	}
	public function abc() {
		header('content-type:text/html;charset=utf8');
		$res = M('category')->order('parent_id desc')->select();
		// dump($res);
		// 先做一个处理，让下标等与id
		
		function abc(array $arr) {
			// foreach($arr as $k => $v) {
				// $arr[$v['id']] = $v;
				// unset($arr[$k]);
			// }
			$tmp = [];
			foreach($arr as $k => $v) {
				if($v['parent_id'] != 0) {
					foreach($arr as $key => $value) {
						if($v['parent_id'] == $value['id']) {
							$value['child'] = $v;
							$tmp[] = $value;
							break;
						}
					}
				}
			}
			return $tmp;
		}
		dump(abc($res));
	}
}