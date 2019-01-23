import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/member/index', params)
  },
 
  toggle (params = {}) {
    return request('/member/toggle', params)
  },

  recharge (params = {}) {
    return request('/member/recharge', params)
  },
  
  
}
