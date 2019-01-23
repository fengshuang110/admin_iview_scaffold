import PermissionGroup from '@/components/permission_group.vue';

export default function tableCols () {
  return [
  {
      type: 'expand',
      width: 50,
      render: (h, params) => {
          return h(PermissionGroup, {
              props: {
                  row: params.row,
                  disabled:true
              }
          })
      }
  },{
    title: 'id',
    key: 'id'
  }, {
    title: '用户名',
    key: 'name'
  }, {
    title: '邮箱',
    key: 'mail'
  }, {
    title: '角色',
    key: 'role_name'
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
          <i-button onClick={() => this.handleShowModal(row)}>编辑</i-button>
        </div>
      )
    }
  }]
}
