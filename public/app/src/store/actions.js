import api from '@/apis/user'
import * as types from './mutation-types'

export default {
  getGroupMenus ({ commit }, params) {
    return api.groupMenus(params).then(data => {
      commit(types.SET_GROUP_MENUS, data.menus)
      commit(types.SET_TABS, data.tabs)
    })
  }
}
