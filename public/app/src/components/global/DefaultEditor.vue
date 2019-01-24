<template>
<div>
   <quill-editor ref="myTextEditor"
   	 :content="content"
   	 @change="onEditorChange($event)">
	</quill-editor>
</div>
</template>
<script>
    export default {
       	props:{
       		content:{
       			type:String
       		}
       	},
        data(){
            return {
            }
        },
        methods:{
    		onEditorChange({ editor, html, text }) {//富文本编辑器  文本改变时 设置字段值
		       	 this.$emit('onEditorChange',html)
		    }
        }
    };
</script>