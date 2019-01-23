<?php  
namespace App\Business\Model\Admin;

class PermissionMenu extends BaseModel{
	protected $table = 'admin_permission_menu';
	protected $primaryKey = 'id';

	public static function create($data){
		$model = new self();
		return $model->insertGetId($data);
	}

	public function permissions(){
		return $this->hasMany(Permission::get_class_name(),'permission_menu_id','id');
	}
	
}
?>