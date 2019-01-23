<?php 
namespace App\Business\Service;

use App\Business\Model\User;

class MemberService{
public static $instance = null;
	
	private function __construct(){
	
	}
	
	public static function getInstance(){
	
		if(self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}

	
	
	public function pages($where,$size = 10){
		$query = User::where([]);
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$query = $query->where($value[0],$value[1],$value[2]);
			}
		}
		$result =  $query->paginate($size)->toArray();
		$res = $result;
		unset($res['data']);
		foreach ($result['data'] as $item){
			$res['data'][] = [
				'username'=>$item['username'],
				'mobile'=>$item['mobile'],
				'status'=>$item['status'],
				'user_id'=>$item['user_id'],
				'avatar'=>$item['avatar'],
				'login_ip'=>$item['login_ip'],
				'login_at'=>$item['login_at'],
				'created_at'=>$item['created_at']
			];
		}
		return $result;
	}

}

?>