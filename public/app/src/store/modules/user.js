import api from '@/apis/user'
import * as types from '../mutation-types'

/**
 * store状态初始化
 */
const state = {
  user: {},
  loading: false
}

/**
 *  计算属性
 */
const getters = {
  user: state => state.user,
  loading: state => state.loading
}

/**
 * 更改store中的状态
 */
const mutations = {
  [types.USER_SET_USER] (state, user) {
    state.user = user
  },
  [types.USER_LOGIN_LOADING] (state, loading) {
    state.loading = loading
  }
}

/**
 * 异步操作，提交mutation更改store中的状态
 */
const actions = {
  login ({ commit }, params) {
    commit(types.USER_LOGIN_LOADING, true)
    return api.login(params).then(data => {
      return data
    }).finally(result => {
      commit(types.USER_LOGIN_LOADING, false)
    })
  },
  logout ({ commit }, params) {
    return api.logout(params).then(data => {
      console.log(data)
      return data
    })
  },
  getUser ({ commit }) {
    return api.user().then(user => {
      return commit(types.USER_SET_USER, user)
    })
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
