<?php
return [
	//'配置项'=>'配置值'
	
	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'shop', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'chencanbang2010', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PARAMS' =>  array(), // 数据库连接参数
	'DB_PREFIX' => '', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
	
	'SHOW_PAGE_TRACE' =>true, 
	
	// 模板布局配置
	'LAYOUT_ON'=>true,	// 打开模板布局
	'LAYOUT_NAME'=>'Layout/index',	// 布局文件名称
	
];