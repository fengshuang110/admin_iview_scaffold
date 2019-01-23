<?php 
namespace App\Business\Utils;
use Illuminate\Support\Facades\Cache;
/**
 * @author fengshuang
 * 消息发送检查类
 */
class Spam{
	private static $cache;
	public static $actions = [
		"IP"=>20,//单个IP每天最多
		"TOTAL"=>30,//单个手机每天最大
	];
	public static function getRedis(){
		if(is_null(self::$cache)){
			self::$cache = Cache::store('redis');
		}
		return self::$cache;
	}

	/**
	 *$pre 前缀 IP_ 单个IP现在  TOTAL_ 单个手机限制
	 */
	protected static function cacheBuild($pre,...$args){
		$key =  $pre;
		foreach ($args as $arg){
			if(is_string($arg) || is_numeric($arg)){
				$key .= '_'.$arg;
			}
		}
		return $key;
	}
	
	public static function getSpam($action,$mobile){
		if($action == 'IP'){
			$Ip = Tool::getClientIp();
			$key = self::cacheBuild('IP',$Ip);
		}else {
			$key = self::cacheBuild('TOTAL',$mobile);
		}
		$num =self::getRedis()->get($key);
		if(empty($num)){
			return 0;
		}
		return $num;
	}
	
	//用户注册的时候手机号短信发送次数设置
	public static function addSpam($action,$mobile){
		$redis = self::getRedis();
		if($action == 'IP'){
			$Ip = Tool::getClientIp();
			$key = self::cacheBuild('IP',$Ip);
		}else {
			$key = self::cacheBuild('TOTAL',$mobile);
		}
		$currentNum = intval($redis->get($key));
		$currentNum++;
		$expireTime = ceil( (strtotime(date('Y-m-d')." 23:59:59") - time()) / 60 );
		$redis->put($key,$currentNum,$expireTime);
	}
	
	public static function check($mobile){
		foreach (self::$actions as $action=>$count){
			$currentTime = self::getSpam($action, $mobile);
			if($currentTime > $count){
				return false;
			}
			//发送成功，当天增加一次
			self::addSpam($action, $mobile);
		}
		return true;
	}
}
?>