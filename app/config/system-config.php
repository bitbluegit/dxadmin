<?php

return [
	'app' => [
		'base_dir'		=> '/dxadmin/',
		'timezone'		=> 'Asia/Kolkata',
		'session_name'	=> 'dxadmin'
	],
	'mysql' => [
		'host' 			=> 'localhost',
		'user' 			=> 'admin',
		'name' 			=> 'mu',
		'pswd' 			=> '12345',
		'persist'		=> true
	],
	'env' => [
		'dev_mode'		=> 1,
		'http_port'		=> $_SERVER['SERVER_PORT']
	]
];