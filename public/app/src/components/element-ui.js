import Vue from 'vue'
import 'element-ui/lib/theme-chalk/index.css'

import {
  Button,
  Table,
  TableColumn,
  Steps,
  Step
} from 'element-ui'

/**
 * element-ui 按需要引用，作为对iview-ui的补充
 */

Vue.component(Button.name, Button)
Vue.component(Table.name, Table)
Vue.component(TableColumn.name, TableColumn)
Vue.component(Steps.name, Steps)
Vue.component(Step.name, Step)
