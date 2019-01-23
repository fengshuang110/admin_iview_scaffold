<style lang="less" scoped>
.card {
  background: #fff;
  border-radius: 4px;
  .header {
    height: 50px;
    line-height: 50px;
    border-bottom: 1px solid #e9ebef;
    font-size: 14px;
  }
  .content {

  }
}
</style>
<template>
  <div class="card">
    <div class="header default-padding-left">
      {{ title }}
    </div>
    <div class="content default-padding-top default-padding-bottom">
      <slot />
    </div>
  </div>
</template>
<script>
export default {
  name: 'DefaultCard',
  props: {
    title: {
      type: String,
      default: ''
    }
  }
}
</script>
