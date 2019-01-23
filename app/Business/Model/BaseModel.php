<?php 
namespace App\Business\Model;

use Illuminate\Database\Eloquent\Model ;


class BaseModel extends Model{	
	
	protected $connection = 'mysql';
	
	protected static function cacheBuild($func,...$args){
		$key =  $func;
		foreach ($args as $arg){
			if(is_string($arg) || is_numeric($arg)){
				$key .= '_'.$arg;
			}
		}
		return $key;
	} 
	
	public static function get_class_name(){
		return  get_called_class(); 
	}
	
}


?>