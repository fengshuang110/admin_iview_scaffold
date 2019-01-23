import request from '@/utils/request'

export default {
  pages (params = {}) {
    return request('/withdraw/index', params)
  }

}
