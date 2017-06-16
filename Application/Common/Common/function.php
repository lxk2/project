<?php
/*
	数组的笛卡尔积
*/
/*
	递推( 迭代 )思想
*/
function get_array_group(array $arr) {
	$group = [];
	foreach($arr as $value) {
		if(empty($group)) {
			$group = $value;
		}
		else {
			$tmp = [];
			foreach($group as $val) {
				foreach($value as $v) {
					if(!is_array($val)) {
						$tmp[] = [$val,$v];
					}
					else {
						$val[] = $v;
						$tmp[] = $val;
						end($val);
						$k = key($val);
						unset($val[$k]);
					}
				}
			}
			// 遍历完成后改变前一个
			$group = $tmp;
		}
	}
	return $tmp;
}

/*
	无级分类
*/
function cate_tree(array $cateArr,$parent_id=0,$level=1) {
	// 定义一个空数组用于接收
	$data = [];
	foreach($cateArr as $k => $v){
		if($v['parent_id'] == $parent_id){
			$v['level'] = $level;
			$data[] = $v;
			unset($cateArr[$k]);
			$tmp = cate_tree($cateArr,$v['id'],$level+1);
			if(!empty($tmp)){
				$data = array_merge($data,$tmp);
			}
		}
	}
	return $data;
}

/*
	无级分类2
*/
function get_tree(array $cateArr,$parent_id=0) {
	$data = [];
	foreach($cateArr as $k => $v){
		if($v['parent_id'] == $parent_id){
			$v['child'] = get_tree($cateArr,$v['id']);
			$data[] = $v;
			unset($cateArr[$k]);
		}
	}
	return $data;
}