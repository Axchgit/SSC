<?php
return array(
	//数据库配置
	'db' => array(
		//读者需要根据自身环境修改此处配置
		'user' => 'root',
		'pass' => '',
		'dbname' => 'ssc',
	),
	//整体项目
	'app' => array(
		'default_platform' => 'home',//默认平台
	),
	//前台配置
	'home' => array(
		'default_controller' => 'platform',//默认控制器
		'default_action' => 'login',//默认方法
		'pagesize' => 3,//每页评论数
	),
	//后台配置
	'admin' => array(
		'default_controller' => 'StudentInfo',//默认控制器
		'default_action' => 'admin_home',//默认方法 //登录成功后默认页面
		'pagesize' => 5,//每页评论数
	)
);
