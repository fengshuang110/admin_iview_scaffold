<style lang="less">
@header-height: 60px;
@menus-width: 200px;

.default-header {
  height: @header-height;
  line-height: @header-height;
  background: #282c34;
  color: #fff;
  display: flex;
  .logo-container {
    width: 200px;
    display: flex;
    cursor: pointer;
    .logo {
      width: @header-height;
      height: @header-height;
      background: url('../../assets/image/logo.png') no-repeat center;
      background-size: contain;
    }
    .title {
      flex: 1;
      font-size: 16px;
    }
  }
  .header-content {
    flex: 1;
    .item {
      float: left;
      padding: 0 45px;
      font-size: 14px;
      cursor: pointer;
      &.active, &:hover {
        background: #14161a;
      }
    }
  }
  .operate-container {
    width: 200px;
    padding-right: 25px;
    & > div {
      float: right;
    }
  }
}
</style>
<template>
  <div class="default-header">
    <div class="logo-container" @click="handleClick">
      <div class="logo" />
      <div class="title">
        Admin Vue lumen 
      </div>
    </div>
    <div class="header-content">
      <div
        class="item"
        v-for="(tab, key) in tabs"
        :key="key"
        :class="{active: key === currentTab}"
        @click="handleTabClick(tab)"
      >
        {{ tab.name }}
      </div>
    </div>
    <div class="operate-container">
      <header-operate />
    </div>
  </div>
</template>

<script>
import {
  mapGetters
} from 'vuex'
import HeaderOperate from './HeaderOperate'
export default {
  name: 'DefaultHeader',
  computed: {
    ...mapGetters([
      'tabs',
      'currentTab'
    ])
  },
  methods: {
    handleClick () {
      this.$router.push({path: '/'})
    },
    handleTabClick (tab) {
      this.$router.push({path: tab.link})
    }
  },
  components: {
    HeaderOperate
  }
}
</script>
