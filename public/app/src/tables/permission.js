/**
 * 用户管理表单
 */
export default function tableCols () {
  return [{
    title: 'id',
    key: 'id'
  }, {
    title: '权限名称',
    key: 'name'
  },{
    title: '路由',
    key: 'action_url',
  }, {
    title: '权限分组',
    key: 'permission_menu_name',
  },{
    title: '状态',
    key: 'status',
    render (h, { row }) {
      let { status } = row
      return status === 1
        ? <tag color="green">可用</tag>
        : <tag color="red">不可用</tag>
    }
  }, {
    title: '操作',
    key: 'action',
    width: 200,
    align: 'center',
    render: (h, { row }) => {
    
      return (
        <div>
          <i-button onClick={() => this.handleShowModal(row)}>编辑</i-button>
          <default-confirm row={row} onOperateClick={(playload, operate) => this.handleDelete(playload, operate)} />
        </div>
      )
    }
  }]
}
