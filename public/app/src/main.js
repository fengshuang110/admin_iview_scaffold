// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import store from './store'
import App from './App.js'
import router from './router'
import iView from 'iview'
import 'iview/dist/styles/iview.css'
import 'animate.css'
import '@/assets/css/default.less'
import '@/components/install'
import '@/components/element-ui'
import DefaultConfirm from '@/components/global/DefaultConfirm'
import VueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

Vue.use(VueQuillEditor)


import DefaultEditor from '@/components/global/DefaultEditor'

Vue.component('DefaultConfirm', DefaultConfirm)
Vue.component('DefaultEditor', DefaultEditor)

Vue.use(iView)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
