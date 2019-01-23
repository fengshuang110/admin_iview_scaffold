<?php
namespace App\Business\Traits;

use LogicException;
use Illuminate\Support\Facades\Validator;

trait ValidateTrait
{
	/**
	 * 表单校验
	 * @param  array  $input 表单数据
	 * @param  array  $rules 校验规则
	 */
	public function formValidate($input, array $rules,array $message=[])
	{
		if(is_string($input)){
			$input = json_decode($input,true);
		}
		$validator = Validator::make($input, $rules,$message);
		if($validator->fails()) {
			$messages = $validator->errors();
			foreach ($messages->all() as $message) {
				throw new LogicException($message);
			}
		}
		
		/**
		 * 如果没有错误
		 * 返回表单与rules按键求交集的数据
		 */
		$data = array_intersect_key($input, $rules);
		foreach ($data as $k => $v) {
			if(is_string($v)) {
				$data[$k] = trim($v);
			}
		}
		return $data;		
	}

}