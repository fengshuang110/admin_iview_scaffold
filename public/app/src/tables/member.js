/**
 * 用户管理表单
 */
export default function tableCols () {
  return [{
    title: 'user_id',
    key: 'user_id'
  }, {
    title: '用户名',
    key: 'username'
  }, {
    title: '手机',
    key: 'mobile'
  }, {
    title: '头像',
    key: 'avatar',
    width:150,
    render: (h, { row }) => {
      return h('img', {
              attrs: {
              src:  row.avatar
          },
              style:{
                width:'125px',
                height:'125px',
              } 
          });
   }
  }, {
    title: 'ip',
    key: 'login_ip'
  }, {
    title: '登陆时间',
    key: 'login_at'
  },{
    title: '注册时间',
    key: 'created_at'
  }, {
    title: '状态',
    key: 'status',
    render (h, { row }) {
      let { status } = row
      return status === 1
        ? <tag color="green">正常</tag>
        : <tag color="red">已锁定</tag>
    }
  }, {
    title: '操作',
    key: 'action',
    width: 200,
    align: 'center',
    render: (h, { row }) => {
      let button = row.status === 1
        ? <i-button onClick={() => this.handleToggle(row)} type="error">锁定</i-button>
        : <i-button onClick={() => this.handleToggle(row)} type="success">解锁</i-button>
      return (
        <div>
          { button }
        </div>
      )
    }
  }]
}
