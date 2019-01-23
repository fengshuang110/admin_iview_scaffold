import Vue from 'vue'
import { stringify } from 'qs'
import 'whatwg-fetch'

function checkStatus (response) {
  if (response.status >= 200 && response.status < 300) {
    return response
  }
  const error = new Error(response.statusText)
  error.response = response
  throw error
}

const CODE_INVALID_LOGIN = 401

export default function request (url, params, options) {
  url = `/api${url}`
   // url = `http://localhost:9909${url}`
  const defaultOptions = {
    credentials: 'include'
  }
  const newOptions = { ...defaultOptions, ...options }

  let { method = 'GET' } = newOptions
  if (method === 'POST' || method === 'PUT') {
    newOptions.headers = {
      Accept: 'application/json',
      'Content-Type': 'application/json; charset=utf-8',
      ...newOptions.headers
    }
    newOptions.body = JSON.stringify(params)
  } else {
    url = `${url}?${stringify(params)}`
  }

  Vue.prototype.$Loading.start()

  /**
   * @see https://github.com/github/fetch
   */
  return fetch(url, newOptions)
    .then(checkStatus)
    .then(response => response.json())
    .then(json => {
      if (json.errno === 0) {
        console.log(json)
        return json.data
      }
      throw new Error(JSON.stringify(json))
    })
    .catch((error) => {
      let data = JSON.parse(error.message)
      Vue.prototype.$Notice.error({
        title: '错误',
        desc: data.errmsg
      })

      /**
       * 做一些其它判断
       * WARNING: if判断已知异常后不要return，以免promise走入then方法
       */
      if (data.errno === CODE_INVALID_LOGIN) {
            location.href = '/login'
      }

      throw new Error(error.message)
    }).finally(() => {
      Vue.prototype.$Loading.finish()
    })
}
