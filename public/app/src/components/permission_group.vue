<template>
    <div>
     <CheckboxGroup  v-model="row.permissionIds">
        <div v-for="item in row.permissions" >
            <span style="margin:20px;margin-left:0px;">{{item.name}}</span>
            <Checkbox  size="large" v-for="action in item.actions" :disabled="disabled" :label="action.value">{{action.label}}</Checkbox>
        </div>
     </CheckboxGroup>
    </div>
</template>
<script>
    export default {
        props: {
            row: Object,
            disabled:Boolean
        },
        data(){
            return {
            }
        }
    };
</script>