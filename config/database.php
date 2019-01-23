<?php 
return [
	
	'default' => env('DB_CONNECTION', 'mysql'),//默认链接池
	
	'connections' => [
		'mysql' => [
			'driver'    => 'mysql',
			'host'      => env('DB_HOST', 'localhost'),
			'port'      => env('DB_PORT', 3306),
			'database'  => env('DB_DATABASE', 'forge'),
			'username'  => env('DB_USERNAME', 'forge'),
			'password'  => env('DB_PASSWORD', ''),
			'charset'   => env('DB_CHARSET', 'utf8mb4'),
			'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
			'prefix'    => env('DB_PREFIX', ''),
			'timezone'  => env('DB_TIMEZONE', '+00:00'),
			'strict'    => env('DB_STRICT_MODE', false),
			],
		'db2' => [
			'driver'    => 'mysql',
			'host'      => env('DB_HOST', 'localhost'),
			'port'      => env('DB_PORT', 3306),
			'database'  => env('DB_DATABASE', 'forge'),
			'username'  => env('DB_USERNAME', 'forge'),
			'password'  => env('DB_PASSWORD', ''),
			'charset'   => env('DB_CHARSET', 'utf8mb4'),
			'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
			'prefix'    => env('DB_PREFIX', ''),
			'timezone'  => env('DB_TIMEZONE', '+00:00'),
			'strict'    => env('DB_STRICT_MODE', false),
			],
		],

	'redis' => [
	
		'cluster' => env('REDIS_CLUSTER', false),
		
		'default' => [
			'host'     => env('REDIS_HOST', '127.0.0.1'),
			'port'     => env('REDIS_PORT', 6379),
			'database' => env('REDIS_DATABASE', 0),
			'password' => env('REDIS_PASSWORD', null),
		],
	
	],
]

?>