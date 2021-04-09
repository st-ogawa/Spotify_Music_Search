<template>
  <input  
    :value="value"
    @input="updateValue"
    :placeholder="placeholder"
    :id="id"
    :class="{error:errmsg}"
    class="LoginForm"
    spellcheck="false"
    @keydown.enter="keydownEvent"
  >
</template>

<script>
export default {
  props:['val','errmsg'],
  data(){
    return{
      value : '',
      placeholder : '',
      id : '',
    }
  },
  methods:{
    updateValue:function(event){
      this.$emit('input', event.target.value )
    },
    keydownEvent(){
      this.$emit('submitData')
    }
  }
}
</script>

<style>
  .LoginForm{
    padding: 4px 10px;
    border-radius: 11px;
    height: 2em;
    width: 24em;
    outline: 0;
    color: #fff;
    font-size: 17px;
    user-select: none;
    background-color:#244E75;
    border-width: 1px;
    margin:  13px;
    padding-inline-start: 40px;
    padding-inline-end: 35px;
    
  }
  .error{
    border-color: #ff0000;
    border-width: 1px;
  }
</style>