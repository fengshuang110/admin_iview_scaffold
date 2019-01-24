<?php 

return [
	'app_name'=>'admin',
	'menus'=>[
		[
			'name'  => '权限管理',
			'link' => '/admin/user/index',
			'permissionKey'=>'admin_permission',
			'menus' => [
				[
					'name' => '管理员管理',
					'link' => '/admin/user/index',
					'permissionKey'=>'super_admin',
				],
				[
					'name' => '角色管理',
					'link' => '/admin/role/index',
					'permissionKey'=>'admin_role',
				],
				[
					'name' => '权限管理',
					'link' => '/admin/permission/index',
					'permissionKey'=>'admin_permission',
				],
				[
					'name' => '权限菜单',
					'link' => '/admin/permission/menu',
					'permissionKey'=>'admin_permission_menu',
				],
			]
		],
		[
			'name'  => '用户管理',
			'link' => '/member/index',
			'permissionKey'=>'user_manager',
			'menus' => [
				[
					'name' => '用户列表',
					'link' => '/member/index',
					'permissionKey'=>'user_manager',
				],
			]
		],
		[
			'name'  => '文章管理',
			'link' => '/article/index',
			'permissionKey'=>'article_manager',
			'menus' => [
				[
					'name' => '文章列表',
					'link' => '/article/index',
					'permissionKey'=>'article_manager',
				],
			]
		],
		[
			'name'  => '数据分析',
			'link' => '/fenxi/index',
			'permissionKey'=>'fenxi_manager',
			'menus' => [
				[
					'name' => '数据分析',
					'link' => '/fenxi/index',
					'permissionKey'=>'fenxi_manager',
				],
			]
		],

		[
			'name'  => '客户需求',
			'link' => '/demand/index',
			'permissionKey'=>'demand_manager',
			'menus' => [
				[
					'name' => '需求列表',
					'link' => '/demand/index',
					'permissionKey'=>'demand_manager',
				],
			]
		],
		
		
		
	]
		
	
];
?>