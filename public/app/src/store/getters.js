export default {
  tabs: state => state.tabs, // 页面顶部tab菜单
  currentTab: state => state.currentTab, // 当前菜单
  groupMenus: state => state.groupMenus, // 左侧菜单
  allGames: state => state.allGames, // 所有游戏
  gameSwap: state => state.gameSwap, // 是否显示游戏切换工具
  currentGame: state => state.currentGame, // 当前游戏
  globalConst: state => state.globalConst // 静态变量
}
