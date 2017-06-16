<?php
namespace Common\Model;
use \Think\Model;
class NewsModel extends Model\RelationModel {
	// 自动验证
	protected $_validate = [
		['title','require','新闻标题不能为空'],
		['category_id','require','请选择新闻分类'],
		['publicsher','require','发布人不能为空'],
		['source','require','来源不能为空'],
		['content','require','新闻详情不能为空'],
		
		// 验证标题长度
		['title','6,60','新闻标题长度为6-60',2,'length'],
		['publicsher','1,10','发布者长度为1-10',2,'length'],
		['source','1,15','来源长度为1-10',2,'length'],
	];
	// 关联模型
	protected $_link = [
		'category' => self::BELONGS_TO,
		'news_desc' => [
			'mapping_type' => self::HAS_ONE,
			'class_name' => 'NewsDesc',
			'foreign_key' => 'news_id',
			'mapping_fields' => 'content',
		],
	];
	
	public function newsAdd() {
		if(empty($_POST['image'])){
			return '请上传主图';
		}
		// 收集数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		// 组装详情
		$res['news_desc'] = ['content' => $_POST['content']];
		// 开始添加
		$id = $this->relation('news_desc')->add($res);
		if(empty($res)){
			return '添加失败';
		}
		return true;
	}
	
	public function newsCategory() {
		// 查出新闻分类
		$res = M('category')->select();
		$res = cate_tree($res);
		$tmp = [];
		$level = 0;
		foreach($res as $v){
			// 定位到自己
			if($v['cate_name'] == '新闻'){
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
		unset($res);
		return $tmp;
	}
	
	public function newsList($listRows,$map=[]) {
		// 查出数据
		$res = $this->field('news.id,news.title,category.cate_name')->join('category on news.category_id = category.id')->where($map)->order('id desc')->page(I('p',1),$listRows)->select();
		return $res;
	}
	
	public function newsDel() {
		// 开启事务
		$this->startTrans();
		// 先删除详情
		$row = M('news_desc')->where(['news_id' => I('get.id')])->delete();
		if(empty($row)){
			$this->rollback();
			return '删除失败';
		}
		// 删除新闻
		$row = $this->delete(I('get.id'));
		if(empty($row)){
			$this->rollback();
			return '删除失败';
		}
		// 提交事务
		$this->commit();
		return true;
	}
	
	public function newsFind() {
		// 查出当前新闻
		return $this->relation('news_desc')->find(I('get.id'));
	}
	
	public function newsEdit() {
		if(empty($_POST['image'])){
			return '请上传主图';
		}
		// 组装id
		$_POST['id'] = I('get.id');
		// 收集数据
		$res = $this->create();
		if($res === false){
			return $this->getError();
		}
		// 删除详情
		// $row = M('news_desc')->where(['news_id' => I('get.id')])->delete();
		// 组装详情
		// $res['news_desc'] = ['content' => $_POST['content']];
		$desc_row = M('news_desc')->where(['news_id' => I('get.id')])->save(['content' => I('post.content')]);
		// 更新新闻
		$news_row = $this->relation('news_desc')->save();
		if(empty($news_row) && empty($desc_row)){
			return '更新失败';
		}
		return true;
	}
}