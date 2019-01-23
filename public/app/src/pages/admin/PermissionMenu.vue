<style lang="less">
.ivu-input-wrapper.fix-input {
  width: 200px;
}
</style>
<template>
  <default-card title="权限组管理">
    <div class="default-margin-left default-margin-bottom">
      <Button
        type="primary"
        icon="plus-round"
        @click="handleShowModal"
      >
        添加权限组
      </Button>
      <Input
        type="text"
        v-model="name"
        placeholder="名称"
        class="fix-input"
        icon="ios-search"
        @on-enter="renderPage(1)"
      />
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
        <FormItem label="权限组名称">
          <Input v-model="item.name" placeholder="权限组名称" />
        </FormItem>
         <FormItem label="唯一标识key">
          <Input v-model="item.permission_key" placeholder="唯一标识key" />
        </FormItem>
          <FormItem label="拥有权限">
         <Select v-model="item.permissionIds" multiple style="width:410px">
            <Option v-for="one in item.options" :value="one.value" :key="one.value">{{ one.label }}</Option>
         </Select>
       </FormItem>
      </Form>
    </Modal>
  </default-card>
</template>
<script>

import api from '@/apis/permission_menu';
import tableCols from '@/tables/permission_menu'
import utils from '@/utils'

export default {
  data () {
    return {
      // 表格
      name: '',
      tableData: [],
      pagination: {},
      groups:[
      {
        label:'分组1',
        value:1
      },
      {
        label:'分组2',
        value:2
      }
      ],
      // 添加
      showModal: false,
      loading: true,
      itemBackup: {}, // 重置
      rowBackup: {}, // 修改时对比
      item: {
        id: 0,
        name: '',
        permission_key:'',
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
  },
  methods: {
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
