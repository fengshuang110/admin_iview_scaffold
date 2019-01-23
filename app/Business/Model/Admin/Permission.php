<?php  
namespace App\Business\Model\Admin;

class Permission extends BaseModel{
	protected $table = 'admin_permission';
	protected $primaryKey = 'id';
  	public static $statusMap = [
  		'default' => 1,
  		'disabled'=>2
  	];
	public static function create($data){
		$model = new self();
		return $model->insertGetId($data);
	}
	
	public function permissionMenu(){
		return $this->hasOne(PermissionMenu::get_class_name(),'id','permission_menu_id');
	}
}
?>