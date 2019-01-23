<style lang="less">
.ivu-input-wrapper.fix-input {
  width: 200px;
}
</style>
<template>
  <default-card title="权限管理">
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
        添加权限
      </Button>
      <Input
        type="text"
        v-model="searchField.name"
        placeholder="名称"
        class="fix-input"
        icon="ios-search"
        @on-enter="renderPage(1)"
      />
      <FormItem label="权限组">
       <Select clearable v-model="searchField.permission_menu_id" style="width:120px;">
           <Option v-for="one in permissionGroup" :value="one.value" :key="one.value" >{{one.label}}</Option>
        </Select>
      </FormItem>

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
        <FormItem label="权限名称">
          <Input v-model="item.name" placeholder="权限名称" />
        </FormItem>
         <FormItem label="路由">
          <Input v-model="item.action_url" placeholder="路由" />
        </FormItem>
         <FormItem label="权限分组">
       <Select clearable v-model="item.permission_menu_id" style="width:120px;">
           <Option v-for="one in permissionGroup" :value="one.value" :key="one.value" >{{one.label}}</Option>
        </Select>
      </FormItem>
      </Form>
    </Modal>
  </default-card>
</template>
<script>

import api from '@/apis/permission';
import tableCols from '@/tables/permission'
import utils from '@/utils'

export default {
  data () {
    return {
      // 表格
      searchField: {},
      tableData: [],
      pagination: {},
      permissionGroup:[],
      // 添加
      showModal: false,
      loading: true,
      itemBackup: {}, // 重置
      rowBackup: {}, // 修改时对比
      item: {
        id: 0,
        name: '',
        permission_menu_id:'',
        action_url:'',
      }
    }
  },
  computed: {
    tableCols () {
      return tableCols.call(this)
    }
  },
  created () {
    this.itemBackup = this.item
    this.renderPage()
    this.getPermissionGroup()
  },
  methods: {

    async getPermissionGroup(){
      this.permissionGroup = await api.group()
    },
    /**
     * 渲染列表
     */
    async renderPage (page = 1) {
      let params = Object.assign({page}, this.searchField)
      let data = await api.pages(params)
      this.tableData = data.data
      this.pagination = data
    },

    async handleDelete({ row }, opreate) {
      if (opreate !== 'confirm') {
        return
      }
      try {
        let { id } = row
        await api.delete({ id })
        this.renderPage()
        this.$Message.success('删除成功')
      } catch (e) {}
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
