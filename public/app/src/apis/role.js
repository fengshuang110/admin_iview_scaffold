import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/role/index', params)
  },
  create (params = {}) {
    return request('/role/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/role/update', params, {method: 'POST'})
  },

  toggle (params = {}) {
    return request('/role/toggle', params)
  },
  options(params = {}) {
    return request('/role/options', params)
  },
}
