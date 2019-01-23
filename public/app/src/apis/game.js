import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/game/index', params)
  },
  create (params = {}) {
    return request('/game/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/game/update', params, {method: 'POST'})
  },

}
