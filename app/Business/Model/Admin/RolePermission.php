<?php  
namespace App\Business\Model\Admin;

class RolePermission extends BaseModel{
	protected $table = 'admin_role_permission';
	protected $primaryKey = 'id';


	public function permission(){
		return $this->hasOne(Permission::get_class_name(),'id','permission_id');
	}

	public static function updateRolePermission($roleId,$permissionIds)
	{
		$result = static::where([
			'role_id'=>$roleId,
		])->delete();
		$data = [];
		foreach ($permissionIds as $key => $permissionId) {
			$data[] = [
				'role_id'=>$roleId,
				'permission_id'=>$permissionId,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
			];
		}
		if(!empty($data)){
			$model = new self();
			$model->insert($data);
			if (! $result) {
				return false;
			}
		}
		
	}
}
?>