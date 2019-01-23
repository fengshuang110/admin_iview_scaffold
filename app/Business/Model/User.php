<?php  
namespace App\Business\Model;

class User extends BaseModel{
	protected $table = 'user';
	protected $primaryKey = 'user_id';

	public static $statusMap = [
		'active' => 1
	];

	
}
?>