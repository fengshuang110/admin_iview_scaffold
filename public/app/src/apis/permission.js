import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/permission/index', params)
  },
  create (params = {}) {
    return request('/permission/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/permission/update', params, {method: 'POST'})
  },
  delete (params = {}) {
    return request('/permission/delete', params, {method: 'POST'})
  },
  group (params = {}) {
    return request('/permission/group', params)
  },
}
