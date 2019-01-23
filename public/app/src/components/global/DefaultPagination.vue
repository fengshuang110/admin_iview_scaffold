<template>
  <Page
    :total="pagination.total"
    :page-size="pagination.per_page"
    :current="pagination.current_page"
    show-total
    @on-change="handleChange"
    class="default-margin-top default-margin-left"
  />
</template>
<script>
export default {
  props: {
    pagination: {
      type: Object,
      required: true
    }
  },
  methods: {
    handleChange (currentPage) {
      this.$emit('handleChange', currentPage)
    }
  }
}
</script>
