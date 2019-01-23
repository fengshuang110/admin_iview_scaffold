import * as types from './mutation-types'

export default {
  [types.SET_GROUP_MENUS] (state, groupMenus) {
    state.groupMenus = groupMenus
  },
  [types.SET_TABS] (state, tabs) {
    state.tabs = tabs
  },
  [types.SET_CURRENT_TAB] (state, tab) {
    state.currentTab = tab
  },
  [types.SET_ALL_GAMES] (state, games) {
    state.allGames = games
  },
  [types.TOGGLE_GAME_SWAP] (state) {
    state.gameSwap = !state.gameSwap
  },
  [types.SET_CURRENT_GAME] (state, game) {
    state.currentGame = game
  }
}
