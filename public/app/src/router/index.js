import Vue from 'vue'
import Router from 'vue-router'

import Login from '@/pages/Login'
import page403 from '@/pages/403'

// 平台维度
import AdminIndex from '@/pages/admin/Index'
import AdminUser from '@/pages/admin/User'


Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [

    /**
     * 默认入口
     */
    {
      path: '/',
      name: 'AdminIndex',
      component: AdminIndex
    },
    /**
     * 用户管理
     */
    {
      path: '/admin/user/index',
      name: 'AdminUser',
      component: AdminUser
    },

     {
      path: '/admin/role/index',
      name: 'Role',
      component: resolve => require(['../pages/admin/Role'], resolve)
    },

    {
      path: '/admin/permission/index',
      name: 'Permission',
      component: resolve => require(['../pages/admin/Permission'], resolve)
    },


    {
      path: '/admin/permission/menu',
      name: 'PermissionMenu',
      component: resolve => require(['../pages/admin/PermissionMenu'], resolve)
    },

     {
      path: '/member/index',
      name: 'Member',
      component: resolve => require(['../pages/member/Index'], resolve)
    },
     {
      path: '/acticle/index',
      name: 'Article',
      component: resolve => require(['../pages/article/Add'], resolve)
    },
    
    /**
     * 独立页面
     */
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: { singlePage: true }
    },
    {
      path: '/403',
      name: '403',
      component: page403,
      meta: { singlePage: true }
    }
  ]
})
