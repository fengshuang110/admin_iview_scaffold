<?php 
namespace App\Business\Service;

use App\Business\Model\Admin\PermissionMenu;
use App\Business\Model\Admin\Permission;
class PermissionMenuService{
public static $instance = null;
	
	private function __construct(){
	
	}
	
	public static function getInstance(){
	
		if(self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getRoleMenu($roleId){
		$rolePermission = RoleService::getInstance()->rolePermission($roleId);
		$menu = PermissionMenu::whereIn('id',array_keys($rolePermission))->get()->toArray();
		return $menu;
	}

	public function pages($where=[],$size = 10)
	{

		$query = PermissionMenu::where([])->with('permissions');
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$query = $query->where($value[0],$value[1],$value[2]);
			}
		}
		$result =  $query->orderBy('id','desc')->paginate($size)->toArray();

		$res = [];
		foreach ($result['data'] as $key => $item) {
			$actions = [];
			$permissionIds = [];
			$options = [];
			foreach ($item['permissions'] as $key => $permission) {
				if($permission['status'] == Permission::$statusMap['default']){
					$actions[] = [
						'label'=>$permission['name'],
						'value'=>$permission['id']
					];
					$permissionIds[] = intval($permission['id']);
				}
				$options[] = [
					'label'=>$permission['name'],
					'value'=>$permission['id']
				];
				
			}
			$res[] = [
				'id' => $item['id'],
				'name' => $item['name'],
				'permission_key' => $item['permission_key'],
				'created_at' => $item['created_at'],
				'status'	=> $item['status'],
				'actions'=>$actions,
				'options'=>$options,
				'permissionIds'=>$permissionIds
			];
		}
		$result['data'] = $res;
		return $result;
	}

	public function create($input){
		if( empty($input['name']) 
		|| empty($input['permission_key'])
		 ){
			return false;
		}

		return PermissionMenu::create($input);
	}

	public function delete($id){
		return PermissionMenu::where(['id'=>$id])->delete();
	}
	

	public function update($id,$data){
		 $permissionIds = empty($data['permissionIds']) ? [] : $data['permissionIds'] ;
		 unset($data['permissionIds']);
		 Permission::where(['permission_menu_id'=>$id])->whereNotIn('id',$permissionIds)->update(['status'=>Permission::$statusMap['disabled']]);
		  Permission::where(['permission_menu_id'=>$id])->whereIn('id',$permissionIds)->update(['status'=>Permission::$statusMap['default']]);
		 return PermissionMenu::where(['id'=>$id])->update($data);
	}
	
}

?>