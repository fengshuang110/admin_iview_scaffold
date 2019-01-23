<?php

namespace App\Business\Utils;

use LogicException;

class CustomValidation
{
	/**
	 * 密码规则
	 * @param  $attribute  验证属性
	 * @param  $value      值
	 * @param  $parameters 验证参数
	 * @param  $validator  
	 */
	public static function password($attribute, $value, $parameters, $validator)
	{
		if(! $value) {
			return true;
		}

		if(strlen($value) < 6 || strlen($value) > 32) {
			throw new LogicException('密码至少6位，最多32位.');
		}

		if(! preg_match('/[0-9]+/', $value)) {
			throw new LogicException('密码必须是字母与数字组合，缺少数字.');
		}

		if(! preg_match('/[a-zA-Z]+/', $value)) {
			throw new LogicException('密码必须是字母与数字组合，缺少字母.');
		}

		return true;
	}

	/**
	 * 支持的支付渠道
	 */
	public static function payType($attribute, $value, $parameters, $validator)
	{
		$value = trim(strtolower($value));

		// 是否需要传值由required规则决定
		if(! $value) {
			return true;
		}

		if (! in_array($value, ['zfb','wx'])) {
			throw new LogicException('支付方式');
		}

		return true;
	}

	/**
	 * 验证身份证号
	 * @param  $attribute  验证属性
	 * @param  $value      值
	 * @param  $parameters 验证参数
	 * @param  $validator  
	 */
	function isCreditNo($attribute,$vStr, $parameters, $validator)
	{
	    $vCity = array(
	        '11', '12', '13', '14', '15', '21', '22',
	        '23', '31', '32', '33', '34', '35', '36',
	        '37', '41', '42', '43', '44', '45', '46',
	        '50', '51', '52', '53', '54', '61', '62',
	        '63', '64', '65', '71', '81', '82', '91'
	    );
	 
	    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;
	 	//验证城市
	    // if (!in_array(substr($vStr, 0, 2), $vCity)) return false;
	 
	    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
	    $vLength = strlen($vStr);
	 
	    if ($vLength == 18) {
	        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
	    } else {
	        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
	    }
	 
	    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
	    //验证最后一位
	    // if ($vLength == 18) {
	    //     $vSum = 0;
	 
	    //     for ($i = 17; $i >= 0; $i--) {
	    //         $vSubStr = substr($vStr, 17 - $i, 1);
	    //         $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
	    //     }
	 
	    //     if ($vSum % 11 != 1) return false;
	    // }
	 
	    return true;
	}


}