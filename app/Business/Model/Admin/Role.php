<?php  
namespace App\Business\Model\Admin;

class Role extends BaseModel{
	protected $table = 'admin_role';
	protected $primaryKey = 'id';

	public function rolePermissions(){
		return $this->hasMany(RolePermission::get_class_name(),'role_id','id');
	}
	public static function create($user){
		$model = new self();
		return $model->insertGetId($user);
	}

	public static function updateRole($id,$role,$permissionIds)
	{
		RolePermission::updateRolePermission($id,$permissionIds);
		return static::where(['id'=>$id])->update($role);

	}


}
?>