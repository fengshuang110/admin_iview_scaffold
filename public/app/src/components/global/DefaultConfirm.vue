<template>
  <Poptip
    transfer
    confirm
    :title="title"
    @on-ok="handleOperate('confirm')"
    @on-cancel="handleOperate('cancel')"
  >
    <slot><Button :type="type" >{{name}}</Button></slot>
  </Poptip>
</template>
<script>
export default {
  props: {
    name:{
      type: String,
      default: '删除'
    },
    type:{
      type: String,
      default: 'error'
    },
    row: {
      type: Object,
      required: true
    },
    query: {},
    title: {
      type: String,
      default: '确认删除吗?'
    }
  },
  methods: {
    handleOperate (operate) {
      let playload = {
        row: this.row,
        query: this.query
      }
      this.$emit('operateClick', playload, operate)
    }
  }
}
</script>
