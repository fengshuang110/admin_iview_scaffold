<style lang="less">
.ivu-input-wrapper.fix-input {
  width: 200px;
}
</style>
<template>
  <default-card title="管理员管理">
    <div class="default-margin-left default-margin-bottom">
       <Form
       ref="formInline" inline
       :label-width="80"
      >
      <Button
        type="primary"
        icon="plus-round"
        @click="handleShowModal"
      >
        添加管理员
      </Button>
      <Input
        type="text"
        v-model="name"
        placeholder="用户名"
        class="fix-input"
        icon="ios-search"
        @on-enter="renderPage(1)"
      />
       <FormItem>
            <Button type="primary" @click="renderPage(1)">查询</Button>
        </FormItem>
      </Form>
    </div>
    <default-table
      :tableCols="tableCols"
      :tableData="tableData"
    />
    <default-pagination
      :pagination="pagination"
      @handleChange="renderPage"
    />

    <Modal
      v-model="showModal"
      :title="item.id > 0 ? '编辑' : '添加'"
      @on-ok="handlePostSubmit"
      :loading="loading"
    >
      <Form :model="item" :label-width="80">
        <FormItem label="用户名">
          <Input v-model="item.name" placeholder="用户名" />
        </FormItem>
        <FormItem label="邮箱">
          <Input
            v-model="item.mail"
            placeholder="邮箱"
            :readonly="item.id > 0"
          />
        </FormItem>
        <FormItem label="密码">
          <Input
            type="password"
            v-model="item.password"
            placeholder="密码"
          />
          <default-tip v-if="item.id > 0" tip="不填写，则不修改密码"/>
        </FormItem>
        <FormItem label="确认密码">
          <Input
            type="password"
            v-model="item.password_confirm"
            placeholder="确认密码"
          />
        </FormItem>
        <FormItem label="角色" >
             <Select clearable v-model="item.role_id" style="width:120px;">
           <Option v-for="one in roles" :value="one.value" :key="one.value" >{{one.label}}</Option>
        </Select>
        </FormItem>
      </Form>
    </Modal>
  </default-card>
</template>
<script>

import api from '@/apis/user';
import role from '@/apis/role';
import tableCols from '@/tables/user'
import utils from '@/utils'

import PermissionGroup from '@/components/permission_group.vue';

export default {
  data () {
    return {
      // 表格
      name: '',
      tableData: [],
      pagination: {},
      userRoles:[],
      // 添加
      showModal: false,
      loading: true,
      itemBackup: {}, // 重置
      rowBackup: {}, // 修改时对比
      item: {
        id: 0,
        name: '',
        mail: '',
        password: '',
        password_confirm: ''
      },
      roles:[],
    }
  },
   components: {
      PermissionGroup,
    },
  computed: {
    tableCols () {
      return tableCols.call(this)
    }
  },
  created () {
    this.itemBackup = this.item
    this.renderPage()
    this.roleOptions()
  },
  methods: {
    roleOptions(){
      role.options().then(res=>{
          this.roles = res
      })
    },
    /**
     * 渲染列表
     */
    async renderPage (page = 1) {
      let params = {
        name: this.name,
        page
      }
      let data = await api.pages(params)
      this.tableData = data.data
      this.pagination = data
    },
    /**
     * 禁用、启用用户状态
     */
    async handleToggle ({ id, status }) {
      status = status === 1 ? 2 : 1
      await api.toggle({ id, status })
      this.renderPage()
      this.$Message.success('操作成功')
    },
    /**
     * 弹出修改模态框
     */
    handleShowModal (row) {
      this.showModal = true
      let { id = 1 } = row
      if (id === 0) {
        this.item = this.itemBackup
        return
      }

      this.item = Object.assign({}, row)
      this.rowBackup = row
    },
    /**
     * 提交修改
     */
    async handlePostSubmit () {
      let func = 'create'
      let item = Object.assign({}, this.item)

      if (this.item.id) {
        func = 'update'
        item = this.item
      }

      if (item.password && item.password !== item.password_confirm) {
        this.$Notice.error({
          title: '错误',
          desc: '密码和确认密码不一至'
        })

        this.loading = false
        this.$nextTick(() => (this.loading = true))
        return
      }

      try {
        await api[func](item)
        this.renderPage()
        this.$Message.success('操作成功')
        this.showModal = false
      } catch (e) {}

      // 去除loading，并在下次点击时启用loading
      this.loading = false
      this.$nextTick(() => (this.loading = true))
    }
  }
}
</script>
