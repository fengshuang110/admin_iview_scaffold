import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/item/index', params)
  },
  itemInit (params = {}) {
    return request('/item/itemInit', params)
  },
  create (params = {}) {
    return request('/item/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/item/update', params, {method: 'POST'})
  },
  userItems(params = {}) {
    return request('/user/items', params)
  },
}
