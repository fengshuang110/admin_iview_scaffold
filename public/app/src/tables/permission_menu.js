/**
 * 用户管理表单
 */
export default function tableCols () {
  return [{
    title: 'id',
    key: 'id',
    width:80,
  }, {
    title: '权限组菜单',
    key: 'name'
  },{
    title: '唯一标识key',
    key: 'permission_key',
    width:200,
  },{
    title: '状态',
    key: 'status',
    render (h, { row }) {
      let { status } = row
      return status === 1
        ? <tag color="green">正常</tag>
        : <tag color="red">已锁定</tag>
    }
  }, {
    title: '拥有权限',
    key: 'permission_menu_name',
   
    width:300,
    render (h, { row }) {
      
     return h('div',row.actions.map(item=>{
          return <tag color="green" >{item.label}</tag>
      })
     )
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
          <i-button onClick={() => this.handleShowModal(row)}>编辑</i-button>
        </div>
      )
    }
  }]
}
