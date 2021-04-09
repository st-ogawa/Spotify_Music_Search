<template>
  <button  @click="issueForm" class="LoginButton">{{value}}</button>
</template>

<script>
export default {
  props:['value'],
  computed:{
    
  },
  methods:{
    issueForm:function(){
      this.$emit('submitData')
    },
    
  },
}
</script>

<style>
.LoginButton{
  padding: 3px 10px;
  border-radius: 11px;
  height: 2em;
  width: 24em;
  color: #fff;
  font-size: 17px;
  user-select: none;
  background:#1ED760;
  border-width: 2px;
  margin-top: 5px;

}

</style>