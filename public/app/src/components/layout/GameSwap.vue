<style lang="less">
@height: 28px;
.search-box {
  display: flex;
  flex-direction: column;
  color: #495060;
  .search-input {
    .ivu-input {
      border: none;
      outline: none;
      box-shadow: none;
      padding-left: 32px;
      padding-right: 7px;
      box-shadow: 0 1px 4px -2px rgba(0,0,0,.2);
      font-size: 12px;
    }
    .ivu-input-icon {
      left: 0;
    }
  }
  .result {
    flex: 1;
    margin: 13px;
    .title {
      color: #999;
    }
    .games {
      .game {
        display: flex;
        padding: 10px;
        border-bottom: 1px solid #e9eaec;
        cursor: pointer;
        .logo {
          width: @height;
          height: @height;
        }
        .name {
          height: @height;
          line-height: @height;
          padding-left: 5px;
        }
      }
    }
  }
}
</style>
<template>
  <div class="search-box">
    <Input
      v-model="name"
      icon="ios-search"
      class="search-input"
      placeholder="输入游戏名称"
      @on-blur="handelToggleGameSwap"
    />
    <div class="result">
      <div class="title">游戏切换</div>
      <ul class="games">
        <li
          class="game"
          v-for="game in showGames"
          :key="game.id"
          @click="handleSwapGame(game)"
        >
          <img class="logo" :src="game.icon" />
          <div class="name">{{ game.name }}</div>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import storage, { KEY_CURRENT_GAME } from '@/utils/storage'

export default {
  data () {
    return {
      name: ''
    }
  },
  computed: {
    ...mapGetters([
      'allGames'
    ]),
    showGames () {
      if (!this.name) {
        return this.allGames
      }
      let games = []
      let all = this.allGames
      for (let i = 0; i < all.length; i++) {
        if (all[i].name.indexOf(this.name) > -1) {
          games.push(all[i])
        }
      }
      return games
    }
  },
  methods: {
    async handleSwapGame (item) {
      this.name = ''
      // 更新当前游戏
      this.$store.commit('SET_CURRENT_GAME', item)
      await storage.set(KEY_CURRENT_GAME, item)
      this.handelToggleGameSwap()

      // 切换成功后，统一跳转到游戏管理首页，以方便刷新页面
      this.$router.push({path: '/game/channel'})
      this.$Notice.success({
        title: '通知',
        desc: '游戏切换成功'
      })
    },
    /**
     * 显示隐藏 切换游戏的dom
     */
    handelToggleGameSwap () {
      this.$store.commit('TOGGLE_GAME_SWAP')
    }
  }
}
</script>
