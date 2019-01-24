import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/article/index', params)
  },
  create (params = {}) {
    return request('/article/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/article/update', params, {method: 'POST'})
  },
  delete (params = {}) {
    return request('/article/delete', params, {method: 'POST'})
  },
  
}
