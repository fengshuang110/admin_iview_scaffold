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
		
	]
		
	
];
?>