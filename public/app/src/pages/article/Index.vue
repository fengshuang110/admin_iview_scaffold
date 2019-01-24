<style lang="less">
.ivu-input-wrapper.fix-input {
  width: 200px;
}
</style>
<template>
  <default-card title="文章列表">
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
        发布文章
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
  </default-card>
</template>
<script>

import api from '@/apis/articel';
import tableCols from '@/tables/articel'
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
      itemBackup: {}, // 重置
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
  }
}
</script>
