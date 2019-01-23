<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    /**
     *
     *  大写的请注意
     *
     * 1. 本文件内容是表单校验规则语言包
     * 2. 本文件格式与默认文件稍有不同，即：默认文件的字段占位符为`:attribute`，本文件为`::attribute`
     *    原因见校验规则：App\Additions\Traits\ValidateTrait
     * 3. 修改语言包请注意通用性
     * 
     */


    'accepted'             => 'The ::attribute must be accepted.',
    'active_url'           => 'The ::attribute is not a valid URL.',
    'after'                => 'The ::attribute must be a date after :date.',
    'after_or_equal'       => 'The ::attribute must be a date after or equal to :date.',
    'alpha'                => 'The ::attribute may only contain letters.',
    'alpha_dash'           => 'The ::attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The ::attribute may only contain letters and numbers.',
    'array'                => 'The ::attribute must be an array.',
    'before'               => 'The ::attribute must be a date before :date.',
    'before_or_equal'      => 'The ::attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => '::attribute 必须大于 :min 且小于 :max.',
        'file'    => 'The ::attribute must be between :min and :max kilobytes.',
        'string'  => '::attribute 最小 :min 个字符，最多 :max 个字符.',
        'array'   => 'The ::attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The ::attribute field must be true or false.',
    'confirmed'            => 'The ::attribute confirmation does not match.',
    'date'                 => 'The ::attribute is not a valid date.',
    'date_format'          => 'The ::attribute does not match the format :format.',
    'different'            => 'The ::attribute and :other must be different.',
    'digits'               => 'The ::attribute must be :digits digits.',
    'digits_between'       => 'The ::attribute must be between :min and :max digits.',
    'dimensions'           => 'The ::attribute has invalid image dimensions.',
    'distinct'             => 'The ::attribute field has a duplicate value.',
    'email'                => '::attribute 必须为邮箱格式.',
    'exists'               => 'The selected ::attribute is invalid.',
    'file'                 => 'The ::attribute must be a file.',
    'filled'               => 'The ::attribute field is required.',
    'image'                => 'The ::attribute must be an image.',
    'in'                   => '::attribute 必须为给定的值.',
    'in_array'             => 'The ::attribute field does not exist in :other.',
    'integer'              => '::attribute 必须是一个整数.',
    'ip'                   => 'The ::attribute must be a valid IP address.',
    'json'                 => 'The ::attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => '::attribute 不能大于 :max.',
        'file'    => 'The ::attribute may not be greater than :max kilobytes.',
        'string'  => '::attribute 最多为 :max 个字符.',
        'array'   => 'The ::attribute may not have more than :max items.',
    ],
    'mimes'                => 'The ::attribute must be a file of type: :values.',
    'mimetypes'            => 'The ::attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => '::attribute 不能小于 :min.',
        'file'    => 'The ::attribute must be at least :min kilobytes.',
        'string'  => '::attribute 最小为 :min 个字符.',
        'array'   => 'The ::attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected ::attribute is invalid.',
    'numeric'              => '::attribute 必须是一个数字.',
    'present'              => 'The ::attribute field must be present.',
    'regex'                => 'The ::attribute format is invalid.',
    'required'             => '::attribute 是必填的.',
    'required_if'          => 'The ::attribute field is required when :other is :value.',
    'required_unless'      => 'The ::attribute field is required unless :other is in :values.',
    'required_with'        => 'The ::attribute field is required when :values is present.',
    'required_with_all'    => 'The ::attribute field is required when :values is present.',
    'required_without'     => 'The ::attribute field is required when :values is not present.',
    'required_without_all' => 'The ::attribute field is required when none of :values are present.',
    'same'                 => 'The ::attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The ::attribute must be :size.',
        'file'    => 'The ::attribute must be :size kilobytes.',
        'string'  => 'The ::attribute must be :size characters.',
        'array'   => 'The ::attribute must contain :size items.',
    ],
    'string'               => '::attribute 必须是字符串.',
    'timezone'             => 'The ::attribute must be a valid zone.',
    'unique'               => '::attribute 已被占用.',
    'uploaded'             => 'The ::attribute failed to upload.',
    'url'                  => '::attribute 不符合链接格式.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
