<?php 
namespace App\Business\Utils;

class StringHelper{
	/**
	 * 随机6位验证码
	 * @param number $str
	 * @return string
	 */
	public static function  getRandomCode($length=6){
	
		$chars = "123456789abcdefghijklmnopkrstuvwxyz";
		$str = "";
		for($i = 0; $i < $length; $i++){
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $str;
	}
	
	public static function  getRandomNum($length=4){
	
		$chars = "0123456789";
		$str = "";
		for($i = 0; $i < $length; $i++){
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $str;
	}
}

?>