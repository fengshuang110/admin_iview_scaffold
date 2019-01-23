<?php 
namespace App\Business\Service;

use App\Business\Model\Admin\Role;
use App\Business\Model\Admin\RolePermission;

class RoleService{
public static $instance = null;
	
	private function __construct(){
	
	}
	
	public static function getInstance(){
	
		if(self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function create($role){
		if( empty($role['name']) ){
			return false;
		}
		return Role::create($role);
	}

	public function rolePermission($roleId){
		$result = RolePermission::where(['role_id'=>$roleId])->with('permission')->get();
		$res = [];
		foreach ($result as $key => $item) {
			$res[$item['permission']['permission_menu_id']][] = $item['permission']['action_url'];
		}
		return $res;
	}

	public function hasPermission($roleId,$action){
		$result = RolePermission::where(['role_id'=>$roleId])->with('permission')->get();
		$actions=[];
		foreach ($result as $key => $item) {
			$actions[] = $item['permission']['action_url'];
		}
		return in_array($action, $actions);
	}

	public function options(){
		$result = Role::all();
		$res=[];
		foreach ($result as $key => $item) {
			$res[] = [
				'label' => $item['name'],
				'value' => $item['id'],
			];
		}
		return $res;
	}
	
	public function pages($where,$size = 10){
		$query = Role::where([])->with('rolePermissions');
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$query = $query->where($value[0],$value[1],$value[2]);
			}
		}
		$result =  $query->orderBy('id','desc')->paginate($size)->toArray();
		$permissions = PermissionService::getInstance()->getGroupPermission();
		$res = $result;
		unset($res['data']);
		foreach ($result['data'] as $item){
			$permissionIds =[];
			foreach ($item['role_permissions'] as $key => $permission) {
				$permissionIds[] = intval($permission['permission_id']);
			}
			$res['data'][] = [
				'name'=>$item['name'],
				'id'=>$item['id'],
				'status'=>$item['status'],
				'permissions'=>$permissions,
				'permissionIds'=>$permissionIds
			];
		}
		$res['permissions'] = $permissions;
		return $res;
	}

	public function lock($id,$status){
		 return Role::where(['id'=>$id])->update(['status'=>$status]);
	}

	public function update($id,$data){
		 $role = $data;
		 unset($role['permissionIds']);
		 $permissionIds = $data['permissionIds'];
		 return Role::updateRole($id,$role,$permissionIds);
	}
	
}

?>