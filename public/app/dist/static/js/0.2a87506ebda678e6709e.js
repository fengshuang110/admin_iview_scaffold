webpackJsonp([0],{"/Lpi":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a("aA9S"),r=a.n(n),i=a("lC5x"),o=a.n(i),s=a("J0Oq"),l=a.n(s),c=a("CMPQ"),u=a("V2/P");a("0xDb");var d={data:function(){return{name:"",tableData:[],pagination:{},userRoles:[],showModal:!1,loading:!0,itemBackup:{},rowBackup:{},item:{id:0,name:""}}},components:{PermissionGroup:u.a},computed:{tableCols:function(){return function(){var e=this;return[{type:"expand",width:50,render:function(e,t){return e(u.a,{props:{row:t.row,disabled:!0}})}},{title:"id",key:"id"},{title:"角色名称",key:"name"},{title:"状态",key:"status",render:function(e,t){return 1===t.row.status?e("tag",{attrs:{color:"green"}},["正常"]):e("tag",{attrs:{color:"red"}},["已锁定"])}},{title:"操作",key:"action",width:200,align:"center",render:function(t,a){var n=a.row;return t("div",[1===n.status?t("i-button",{on:{click:function(){return e.handleToggle(n)}},attrs:{type:"error"}},["锁定"]):t("i-button",{on:{click:function(){return e.handleToggle(n)}},attrs:{type:"success"}},["解锁"]),t("i-button",{on:{click:function(){return e.handleShowModal(n)}}},["编辑"])])}}]}.call(this)}},created:function(){this.itemBackup=this.item,this.renderPage()},methods:{renderPage:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;return l()(o.a.mark(function a(){var n,r;return o.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return n={name:e.name,page:t},a.next=3,c.a.pages(n);case 3:r=a.sent,e.tableData=r.data,e.pagination=r;case 6:case"end":return a.stop()}},a,e)}))()},handleToggle:function(e){var t=this,a=e.id,n=e.status;return l()(o.a.mark(function e(){return o.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return n=1===n?2:1,e.next=3,c.a.toggle({id:a,status:n});case 3:t.renderPage(),t.$Message.success("操作成功");case 5:case"end":return e.stop()}},e,t)}))()},handleShowModal:function(e){this.showModal=!0;var t=e.id;0!==(void 0===t?1:t)?(this.item=r()({},e),this.rowBackup=e):this.item=this.itemBackup},handlePostSubmit:function(){var e=this;return l()(o.a.mark(function t(){var a,n;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return a="create",n=r()({},e.item),e.item.id&&(a="update",n=e.item),t.prev=3,t.next=6,c.a[a](n);case 6:e.renderPage(),e.$Message.success("操作成功"),e.showModal=!1,t.next=13;break;case 11:t.prev=11,t.t0=t.catch(3);case 13:e.loading=!1,e.$nextTick(function(){return e.loading=!0});case 15:case"end":return t.stop()}},t,e,[[3,11]])}))()}}},m={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("default-card",{attrs:{title:"角色管理"}},[a("div",{staticClass:"default-margin-left default-margin-bottom"},[a("Button",{attrs:{type:"primary",icon:"plus-round"},on:{click:e.handleShowModal}},[e._v("\n      添加角色\n    ")]),e._v(" "),a("Input",{staticClass:"fix-input",attrs:{type:"text",placeholder:"角色名",icon:"ios-search"},on:{"on-enter":function(t){e.renderPage(1)}},model:{value:e.name,callback:function(t){e.name=t},expression:"name"}})],1),e._v(" "),a("default-table",{attrs:{tableCols:e.tableCols,tableData:e.tableData}}),e._v(" "),a("default-pagination",{attrs:{pagination:e.pagination},on:{handleChange:e.renderPage}}),e._v(" "),a("Modal",{attrs:{title:e.item.id>0?"编辑":"添加",loading:e.loading},on:{"on-ok":e.handlePostSubmit},model:{value:e.showModal,callback:function(t){e.showModal=t},expression:"showModal"}},[a("Form",{attrs:{model:e.item,"label-width":80}},[a("FormItem",{attrs:{label:"角色名"}},[a("Input",{attrs:{placeholder:"用户名"},model:{value:e.item.name,callback:function(t){e.$set(e.item,"name",t)},expression:"item.name"}})],1),e._v(" "),e.item.id?a("FormItem",{attrs:{label:"权限"}},[a("PermissionGroup",{attrs:{row:e.item},model:{value:e.item.permissionIds,callback:function(t){e.$set(e.item,"permissionIds",t)},expression:"item.permissionIds"}})],1):e._e()],1)],1)],1)},staticRenderFns:[]};var p=a("C7Lr")(d,m,!1,function(e){a("9yWj")},null,null);t.default=p.exports},"9yWj":function(e,t){}});