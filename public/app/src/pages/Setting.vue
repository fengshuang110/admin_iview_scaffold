<style lang="less">
.ivu-input-wrapper.fix-input {
  width: 200px;
}
</style>
<template>
  <default-card title="网站配置">
   

        <Form :model="item" :label-width="120">
         <FormItem label="配置1">
           <Input   v-model="item.name1" placeholder="配置1" />
        </FormItem>
         <FormItem label="配置2">
           <Input   v-model="item.name2" placeholder="配置2" />
        </FormItem>
         <FormItem label="配置3">
           <Input   v-model="item.name3" placeholder="配置3" />
        </FormItem>
         <FormItem label="配置4">
           <Input   v-model="item.name4" placeholder="配置4" />
        </FormItem>
        <FormItem label="是否关站">
           <Checkbox v-model="item.status"> </Checkbox>
        </FormItem>
        <FormItem>
            <Button type="primary" @click="saveSetting">保存</Button>
        </FormItem>
      </Form>
  </default-card>
</template>
<script>

import utils from '@/utils'

export default {
  data () {
    return {
      item: {
      },
    }
  },
  
  created () {
  },
  methods: {
   
    
   
  }
}
</script>
