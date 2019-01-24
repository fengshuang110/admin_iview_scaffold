<style lang="less" scoped>
.default-layout {
  height: 100%;
  .default-content {
    display: flex;
    height: calc(100vh - 50px);
    .default-menus-box {
      display: flex;
      flex-direction: column;
      position: relative;
      /**
       * 当前游戏
       */
      .current-game {
        padding-top: 18px;
        background: #495060;
        border-bottom: 1px solid rgba(39,42,52,.5);
        .logo {
          display: block;
          width: 50px;
          height: 50px;
          border-radius: 50%;
          margin: 0 auto;
        }
        .name {
          color: rgba(255,255,255,.3);
          text-align: center;
          font-size: 14px;
          height: 48px;
          line-height: 48px;
        }
      }
      /**
       * 菜单
       */
      .default-menus {
        flex: 1;
        width: 200px !important;
        overflow: auto;
      }
    }

    .default-main {
      flex: 1;
      padding: 0 20px;
      overflow: auto;
      .default-main-header {
        display: flex;
        .search {
          width: 200px;
          position: relative;
        }
        .bread-crumb {
          padding: 15px 0;
          flex: 1;
        }
      }
      .default-container {
      }
    }
  }
}

.game-swap {
  color: #fff;
  position: absolute;
  top: 14px;
  right: 46px;
  font-size: 25px;
  cursor: pointer;
}
.change-game {
  position: absolute;
  left: 0;
  top: 117px;
  color: #fff;
  z-index: 1000;
  width: 100%;
  background: #fff;
  height: calc(100vh - 167px); // 50 导航头的高度，117 当前游戏的高度
  overflow: auto;
}
</style>
<template>
  <div class="default-layout">
    <!-- 头部 -->
    <default-header />
    <div class="default-content">
      <div class="default-menus-box">

        <div class="current-game" v-if="showCurrentGame && currentGame.name">
          <img class="logo" :src="currentGame.icon" />
          <div class="name">{{ currentGame.name }}</div>
          <span @click="handleToggleGameSwap" title="点击切换游戏">
            <Icon type="arrow-swap" class="game-swap" />
          </span>
        </div>

        <!-- <transition enter-active-class="animated fadeInUpBig" leave-active-class="animated fadeOutDownBig"> -->
          <div class="change-game" v-if="gameSwap">
            <game-swap />
          </div>
        <!-- </transition> -->

        <Menu   class="default-menus"
          theme="dark"
          ref="menuRef"
          :active-name="activeMenu"
          @on-select="handleClick">
                <Submenu :name="group.name"  v-for="(group, _gk) in groupMenus">
                    <template slot="title">
                        <Icon type="ios-paper" />
                        {{group.name}}
                    </template>
                    <MenuItem  v-for="(menu, _mk) in group.menus"  :name="menu.link">{{menu.name}}</MenuItem>
                </Submenu>
            </Menu>
      </div>

      <!-- 主内容区域 -->
      <div class="default-main">
          <!-- 导航 -->
        <div class="default-main-header">
          <Breadcrumb class="bread-crumb">
            <BreadcrumbItem
              v-for="(bread, key) in breadCrumb"
              :to="bread.link"
              :key="key"
            >
              {{ bread.name }}
            </BreadcrumbItem>
          </Breadcrumb>
          <div class="search">
          </div>
        </div>

        <!-- 主内容 -->
        <div class="default-container">
          <slot v-if="getReady" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {
  mapGetters,
  mapActions
} from 'vuex'
import DefaultHeader from './DefaultHeader'
import GameSwap from './GameSwap'
import utils from '@/utils'

export default {
  name: 'DefaultLayout',
  data () {
    return {
      activeMenu: '',
      getReady: false // 准备好渲染 default-container
    }
  },
  computed: {
    ...mapGetters([
      'groupMenus',
      'currentTab',
      'gameSwap',
      'currentGame'
    ]),
    breadCrumb () {
      if (this.groupMenus.length < 1) {
        return []
      }
      let { path } = this.$route
      return utils.breadCrumb(this.groupMenus, path)
    },
    showCurrentGame () {
      return this.currentTab === 'game'
    }
  },
  async created () {
    this.getUser()
    this.updateGroupMenus()
    this.getReady = true
  },
  watch: {
    '$route' (to, from) {
      let { path } = this.$route

      let pathSplit = path.split('/')
      this.activeMenu = `/${pathSplit[1]}/${pathSplit[2]}`

      /**
       * 如果是切换顶部的tab，则更新页面左侧菜单
       */
      let toSplit = to.path.split('/')
      let fromSplit = from.path.split('/')
      if (toSplit[1] !== fromSplit[1]) {
        this.updateGroupMenus()
      }
    }
  },
  methods: {
    ...mapActions([
      'getGroupMenus',
      'getAllGames'
    ]),
    ...mapActions('user', [
      'getUser'
    ]),
    updateGroupMenus () {
      let { path } = this.$route
      let pathSplit = path.split('/')
      let tab = pathSplit[1]
      this.getGroupMenus({ tab }).then(() => {
        this.activeMenu = `/${pathSplit[1]}/${pathSplit[2]}`
        this.$nextTick(() => {
          this.$refs.menuRef.updateActiveName()
        })
      })
    },
    handleClick (path) {
      this.$router.push({ path })
    },
    handleToggleGameSwap () {
      this.$store.commit('TOGGLE_GAME_SWAP')
    }
  },
  components: {
    DefaultHeader,
    GameSwap
  }
}
</script>
