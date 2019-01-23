<style lang="less">
.ivu-input-wrapper.fix-input {
  width: 200px;
}
</style>
<template>
  <default-card title="角色管理">
    <div class="default-margin-left default-margin-bottom">
      <Button
        type="primary"
        icon="plus-round"
        @click="handleShowModal"
      >
        添加角色
      </Button>
      <Input
        type="text"
        v-model="name"
        placeholder="角色名"
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
        <FormItem label="角色名">
          <Input v-model="item.name" placeholder="用户名" />
        </FormItem>
         <FormItem label="权限" v-if="item.id">
            <PermissionGroup :row="item" v-model="item.permissionIds" />
        </FormItem>
      </Form>
    </Modal>
  </default-card>
</template>
<script>

import api from '@/apis/role';
import tableCols from '@/tables/role'
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
      }
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
