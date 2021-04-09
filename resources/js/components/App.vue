
<template>
    <div id="app">
         <router-view/>
    </div>
</template>

<script>



export default {
  name: 'App',
 
}
</script>


<style>
html{
  overflow: overlay;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
}
::-webkit-scrollbar {
  width: 14px;
  height: 10px;
}
::-webkit-scrollbar-track {
  border: 1px solid ccc;
  border-right: none; 

}
::-webkit-scrollbar-thumb {
  background:rgba(255, 255, 255, 0.405);
}
</style>