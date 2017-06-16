<?php
return array(
	//'配置项'=>'配置值'
	
	// 模板替换		str_replace('__PUBLIC__','/Public/Admin/',$str)
	'TMPL_PARSE_STRING'  =>array(
		 '__PUBLIC__' => '/Public/Home/', // 更改默认的/Public 替换规则
		 '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
	),
);