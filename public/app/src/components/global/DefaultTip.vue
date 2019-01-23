<style lang="less">
.dft-from-tip {
  position: absolute;
  top: 100%;
  left: 0;
  line-height: 1;
  padding-top: 6px;
  color: #bbbec4;
}
</style>
<template>
  <div class="dft-from-tip">
    <span v-html="tip" />
  </div>
</template>
<script>
export default {
  props: {
    tip: {
      type: String,
      required: true
    }
  }
}
</script>
