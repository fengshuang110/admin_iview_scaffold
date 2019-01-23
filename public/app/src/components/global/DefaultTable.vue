<style lang="less">
.dft-inner-table {
  border: transparent;
  table td:last-child button + button {
    margin-left: 5px;
  }
  .ivu-table:before,
  .ivu-table:after {
    background: transparent;
    width: 0;
    height: 0;
  }
  .ivu-table-small th {
    height: 36px;
  }
  .ivu-table-small td {
    height: 45px;
  }
}
</style>
<template>
  <Table
    :columns="tableCols"
    :data="tableData"
    class="dft-inner-table"
    stripe
    size="small"
    :loading="loading"
  />
</template>
<script>
export default {
  props: {
    tableCols: {
      type: Array,
      required: true
    },
    tableData: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      default: false
    }
  }
}
</script>
