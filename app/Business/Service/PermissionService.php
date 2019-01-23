<?php
namespace App\Business\Service;

use App\Business\Model\Admin\Permission;
use App\Business\Model\Admin\PermissionMenu;

class PermissionService{

	public static $instance = null;
	
	private function __construct(){
	
	}
	
	public static function getInstance(){
	
		if(self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	

	public function pages($where=[],$size = 10)
	{

		$query = Permission::where([])->with('permissionMenu');
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$query = $query->where($value[0],$value[1],$value[2]);
			}
		}
		$result =  $query->orderBy('id','desc')->paginate($size)->toArray();
		$res = [];
		foreach ($result['data'] as $key => $item) {
			$res[] = [
				'id' => $item['id'],
				'name' => $item['name'],
				'action_url' => $item['action_url'],
				'status' => $item['status'],
				'permission_menu_id' => $item['permission_menu_id'],
				'created_at' => $item['created_at'],
				'permission_menu_name' => $item['permission_menu']['name'],
			];
		}
		$result['data'] = $res;
		return $result;
	}

	public function group()
	{
		$result = PermissionMenu::where(['status'=>1])->get();
		$res = [];
		foreach ($result as $key => $item) {
			$res[] = [
				'value'=>$item['id'],
				'label'=>$item['name']
			];
		}
		
		return $res;
	}

	public function getGroupPermission(){
		 $result = Permission::with('permissionMenu')->get();
		 $res = [];
		 foreach ($result as $key => $item) {
		 	$res[$item['permission_menu_id']]['name'] = $item['permissionMenu']['name'];
		 	$res[$item['permission_menu_id']]['actions'][] = [
		 		'label'   => $item['name'],
		 		'value'   => $item['id'],
		 		'checked' => false
		 	];
		 }
		 return $res;
	}

	public function create($data)
	{
		$data['action_url'] = ltrim(rtrim($data['action_url'],'/'),'/');
		return Permission::create($data);
	}

	public function update($id,$data){
		$data['action_url'] = ltrim(rtrim($data['action_url'],'/'),'/');
		return Permission::where(['id'=>$id])->update($data);
	}

	public function delete($id){
		return Permission::where(['id'=>$id])->delete();
	}

}