<template>
  <span>
    <Button
      v-if="type === 'button'"
      class="dft-copy"
      type="primary"
      :size="size"
      @click="handleCopy"
      :disabled="copied"
    >
      复制
    </Button>
    <template v-else>
      <Icon
        class="dft-copy"
        type="clipboard"
        @click="handleCopy"
        :size="size"
        v-if="!copied"
      />
      <Icon
        type="checkmark"
        :size="size"
        v-if="copied"
        color="#5cb85c"
      />
    </template>
  </span>
</template>
<script>
import ClipboardJS from 'clipboard'
export default {
  props: {
    text: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: 'button' // button or icon
    },
    size: {
      type: Number | String,
      default: 'default'
    }
  },
  data () {
    return {
      copied: false
    }
  },
  methods: {
    handleCopy () {
      let text = this.text
      let clipboard = new ClipboardJS('.dft-copy', {
        text () {
          return text
        }
      })

      // 复制成功
      clipboard.on('success', (e) => {
        e.clearSelection()
        clipboard.destroy()
        this.copied = true
        this.$Message.success('已复制到剪贴板')
        setTimeout(() => {
          this.copied = false
        }, 1200)
      })

      // 复制失败
      clipboard.on('error', (e) => {
        this.$Message.success('请手动复制')
      })
    }
  }
}
</script>
