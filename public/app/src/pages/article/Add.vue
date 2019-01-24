<template>
<DefaultEditor :content="content" @onEditorChange="onEditorChange"></DefaultEditor>
  </div>
</template>
<script>

export default {
  data () {
    return {
      content:'12121',
    }
  },
 
  created () {
  
  },
  methods: {
    onEditorChange(html){
      console.log(html)
    }
    
  }
}
</script>
