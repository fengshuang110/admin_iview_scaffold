<?php  
namespace App\Business\Model\Admin;

class AdminUser extends BaseModel{
	protected $table = 'admin_user';
	protected $primaryKey = 'id';

	public static $statusMap = [
		'active' => 1
	];

	public static function create($user){
		$model = new self();
		return $model->insertGetId($user);
	}

	public function role(){
		return $this->hasOne(Role::get_class_name(),'id','role_id');
	}

	public function rolePermission(){
		return $this->hasMany(RolePermission::get_class_name(),'role_id','role_id');
	}
	
	public static function getUserById($userId){
		return static::where(['id'=>$userId])->first();
	}

	public static function getUserByName($username){
		return static::where(['name'=>$username])->first();
	}


	public static function updateUser($id,$user)
	{
		return static::where(['id'=>$id])->update($user);
	}
	
	
}
?>