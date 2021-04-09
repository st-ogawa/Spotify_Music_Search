<template>
   <input  :val="val" @input="$emit('input', $event.target.value )" class="searchForm search-form" >
</template>

<script>
export default {
   props:['val']
}
</script>

<style>
.search-form{
  box-sizing: border-box;
  position: relative;
  border: 1px solid #fff;
  padding: 3px 10px;
  border-radius: 20px;
  height: 2em;
  width: 31em;
  outline: 0;
  color: #fff;
  font-size: 17px;
  background-color: rgba(2, 8, 9, 0.707);
  font-family: 'FontAwesome 5 Free';
  user-select: none;
}
input::placeholder{
  color:#fff;
  text-align: center;
}



</style>