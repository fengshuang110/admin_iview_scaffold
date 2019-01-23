module.exports = {
  proxyTable: {
    '/api/**': {
      target: 'http://dev.issue.tianshenyule.com',
      changeOrigin: true
    },
    '/uploads/**': {
      target: 'http://test.cnd.issue.tianshenyule.com',
      changeOrigin: true
    }
  }
}
