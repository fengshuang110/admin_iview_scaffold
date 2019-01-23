<style lang="less">
.login-page {
  background: rgb(58, 110, 165);
  height: 100%;
  & > .container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -70%);
    color: #333;
    background: #fff;
    width: 400px;
    border-radius: 4px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    padding: 30px;
    h1, h3 {
      text-align: center;
      margin: 11px 0;
    }
    h1 {
      font-size: 24px;
      text-align: center;
    }
    h3 {
      font-size: 16px;
    }
    .login-form {
      margin-top: 30px;
      button {
        margin-top: 10px;
      }
    }
  }
}
</style>
<template>
  <div class="login-page">
    <div class="container">
      <h1>admin后台脚手架</h1>
      <h3>帐号登录</h3>
      <Form
        :model="form"
        ref="formRef"
        :rules="formValid"
        class="default-form-layout login-form"
      >
        <FormItem prop="name">
          <Input
            v-model="form.name"
            placeholder="邮箱前缀"
            size="large"
            icon="ios-person-outline"
          />
        </FormItem>
        <FormItem prop="password">
          <Input
            v-model="form.password"
            placeholder="帐号密码"
            type="password"
            size="large"
            icon="ios-locked-outline"
            @on-enter="handleClick"
          />
        </FormItem>
        <FormItem>
          <Button
            type="primary"
            size="large"
            long
            :loading="loading"
            @click="handleClick"
          >
            立即登录
          </Button>
        </FormItem>
      </Form>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
import rules from '@/validate/rules'

export default {
  data () {
    return {
      form: {
        name: '',
        password: ''
      },
      formValid: rules.loginValid
    }
  },
  computed: {
    ...mapGetters('user', [
      'loading'
    ])
  },
  methods: {
    ...mapActions('user', [
      'login'
    ]),
    handleClick () {
      this.$refs.formRef.validate(valid => {
        if (!valid) {
          return
        }
        this.login(this.form).then(() => {
          this.$router.push({ path: '/' })
        })
      })
    }
  }
}
</script>
