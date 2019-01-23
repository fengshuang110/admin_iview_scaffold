import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/user/index', params)
  },
  roles (params = {}) {
    return request('/user/roles', params)
  },
  create (params = {}) {
    return request('/user/create', params, {method: 'POST'})
  },
  update (params = {}) {
    return request('/user/update', params, {method: 'POST'})
  },
  toggle (params = {}) {
    return request('/user/toggle', params)
  },
  user (params = {}) {
    return request('/auth/get_user', params)
  },
  login (params = {}) {
    return request('/auth/login', params, {method: 'POST'})
  },
  logout (params = {}) {
    return request('/auth/logout', params)
  },
  groupMenus (params = {}) {
    return request('/auth/group_menus', params)
  },
}
