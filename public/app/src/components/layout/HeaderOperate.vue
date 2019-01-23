<template>
  <Dropdown @on-click="handleClick">
    <a href="javascript:void(0)">
      {{ user.name }}
      <Icon type="arrow-down-b"></Icon>
    </a>
    <DropdownMenu slot="list">
      <!-- <DropdownItem name="setting">设置</DropdownItem> -->
      <DropdownItem name="logout">退出系统</DropdownItem>
    </DropdownMenu>
  </Dropdown>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'HeaderOperate',
  computed: {
    ...mapGetters('user', [
      'user'
    ])
  },
  methods: {
    ...mapActions('user', [
      'logout'
    ]),
    handleClick (name) {
      if (name === 'logout') {
        this.logout().then((data) => {
           window.location.href = data
        })
      }
    }
  }
}
</script>
