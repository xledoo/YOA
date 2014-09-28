<?php
return array(
	//全局
	'LAYOUT_ON'				=>	true,
	'TMPL_CACHE_ON'			=>	false, //关闭模版缓存
	'GLOBAL_AUTH_KEY'		=>	'xR89daRF0fQW3rSv',
	'TMPL_TEMPLATE_SUFFIX'  => 	'.htm',     // 默认模板文件后缀
	'URL_MODEL'             =>	0,

	//数据库
	'DB_TYPE'   			=> 'mysql', // 数据库类型
	'DB_HOST'   			=> 'localhost', // 服务器地址
	'DB_NAME'   			=> 'yoa', // 数据库名
	'DB_USER'   			=> 'root', // 用户名
	'DB_PWD'    			=> '9527', // 密码
	'DB_PORT'   			=> 3306, // 端口
	'DB_PREFIX' 			=> 'pre_', // 数据库表前缀
	'COOKIE_PRE'			=> 'sE8t_',

	//短信接口
	'SMS_USERNAME'			=>	'xledoo',
	'SMS_PASSWORD'			=>	'zmin821001',
	'SMS_CHARSET'			=>	'utf8',
	'SMS_INTERFACE'			=>	'http://api.chanyoo.cn/{charset}/interface/send_sms.aspx?username={username}&password={password}&receiver={mobile}&content={message}',

	//邮箱发送
	'MAIL_ADDRESS'=>'pengpu1987@126.com', // 邮箱地址
	'MAIL_SMTP'=>'smtp.126.com', // 邮箱SMTP服务器
	'MAIL_LOGINNAME'=>'pengpu1987', // 邮箱登录帐号
	'MAIL_PASSWORD'=>'pp135642', // 邮箱密码
	'MAIL_CHARSET'=>'UTF-8',//编码
	'MAIL_AUTH'=>true,//邮箱认证
	'MAIL_HTML'=>true,//true HTML格式 false TXT格式
);