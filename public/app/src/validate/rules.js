/**
 * 表单校验规则
 * @see document https://github.com/yiminghe/async-validator
 */

export default {
  /**
   * 登录表单
   */
  loginValid: {
    name: [{
      required: true,
      message: '请输入帐号',
      trigger: 'blur'
    }],
    password: [{
      required: true,
      message: '请输入密码',
      trigger: 'blur'
    }]
  }
}
