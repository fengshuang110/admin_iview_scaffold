import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/category/index', params)
  },
  create (params = {}) {
    return request('/category/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/category/update', params, {method: 'POST'})
  },

}
