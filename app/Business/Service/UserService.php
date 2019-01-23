<?php 
namespace App\Business\Service;

use App\Business\Model\Admin\AdminUser;

class UserService{
public static $instance = null;
	
	private function __construct(){
	
	}
	
	public static function getInstance(){
	
		if(self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}



	public function createUser($input){
		if( empty($input['name']) 
		|| empty($input['mail'])
		|| empty($input['password'])
		|| empty($input['role_id'])  ){
			return false;
		}

		return User::create($input);
	}

	
	
	public function pages($where,$size = 10){
		$query = AdminUser::where([])->with('rolePermission')->with('role');
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$query = $query->where($value[0],$value[1],$value[2]);
			}
		}
		$result =  $query->orderBy('id','desc')->paginate($size)->toArray();
		$res = $result;
		unset($res['data']);
		$permissions = PermissionService::getInstance()->getGroupPermission();
			
		foreach ($result['data'] as $item){
			$permissionIds =[];
			foreach ($item['role_permission'] as $key => $permission) {
				$permissionIds[] = intval($permission['permission_id']);
			}
			$res['data'][] = [
				'name'=>$item['name'],
				'mail'=>$item['mail'],
				'role_name'=>$item['role']['name'],
				'status'=>$item['status'],
				'id'=>$item['id'],
				'permissions'=>$permissions,
				'permissionIds'=>$permissionIds
			];
		}
		return $res;
	}

	public function updateStatus($id,$status){
		return AdminUser::where(['id'=>$id])->update(['status'=>$status]);
	}

	public function updateUser($id,$data){

		 $user = $data;
		 return AdminUser::updateUser($id,$user);
	}
	
}

?>