import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/permission_menu/index', params)
  },
  create (params = {}) {
    return request('/permission_menu/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/permission_menu/update', params, {method: 'POST'})
  },
  
}
