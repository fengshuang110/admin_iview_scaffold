<style lang="less">
.ivu-input-wrapper.fix-input {
  width: 200px;
}
</style>
<template>
  <default-card title="用户管理">
    <div class="default-margin-left default-margin-bottom">
      <Input
        type="text"
        v-model="name"
        placeholder="用户名"
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
  </default-card>
</template>
<script>

import api from '@/apis/member';
import tableCols from '@/tables/member'

export default {
  data () {
    return {
      // 表格
      name: '',
      tableData: [],
      pagination: {},
      // 添加
      showModal: false,
      loading: true,
    }
  },
  computed: {
    tableCols () {
      return tableCols.call(this)
    }
  },
  created () {
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
    async handleToggle ({ user_id, status }) {
        return
    },
    
  }
}
</script>
