<?php

namespace App\Business\Utils;

use Illuminate\Support\Facades\Log;
/**
 * 
 * 发行系统默认的签名算法
 * 
 */
class SignUtil
{
	public static function sdkSign($params, $md5_key){
		$arr = [];
		foreach ($params as $k => $v) {
			if($v == '' ) {
				continue;
			}
			if(is_array($v)){
				$arr[$k] = json_encode($v,JSON_UNESCAPED_UNICODE);
			}else if(is_string($v) || is_numeric($v)){
				$arr[$k] = str_replace(" ", "+", rtrim($v));
			}
		}
		ksort($arr);//对数组按字母排序
		//把数组的每个value用'#'拼接起来成一个字符串 $md5_key为client_secret值
		$str = '';
		foreach ($arr as $key=>$value){
			$str .= $key . '=' . $value . "#";
		}
		$str .= $md5_key;
		Log::warn($str);
		return md5($str);//md5字符串
	}
	
    
    public static function verifySign($params, $sign, $md5_key)
    {
    	return self::sdkSign($params, $md5_key) === $sign;
    }

}