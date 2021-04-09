<template>
    <div class="Result">
        <ShowResrult v-for="item in DisplayItems" :key="item.id" :item="item"/>
        <paginate
            :page-count="getPageCount"
            :page-range="10"
            :margin-pages="2"
            :click-handler="clickCallback"
            :prev-text="'&laquo'"
            :next-text="'&raquo'"
            :page-link-class="'page-link'"
            :prev-class="'page-item'"
            :prev-link-class="'page-link'"
            :next-class="'page-item'"
            :next-link-class="'page-link'"
            :container-class="'pagination'"
            :page-class="'page-item'"
            :value="$store.getters.getPage"/>
    </div>
</template>

<script>
import ShowResrult from '../view/ShowResrult'

export default {
  
  components: { ShowResrult, },
    
  name:'Result',

  data:function(){
    return{
      perPage:5,
    } 
  },
  computed: {
    DisplayItems : function () {
      return this.$store.getters.getItems.slice((this.$store.getters.getPage - 1) * this.perPage, this.$store.getters.getPage * this.perPage)
      
    },
    getPageCount : function(){
      return Math.ceil(this.$store.getters.getItems.length / this.perPage)

    },
  },
  methods:{
    clickCallback:function(pageNum){
      this.$store.dispatch('getCurrentPage', pageNum);
      scroll({
        top : 570,
        behavior: "smooth"
      })
    },
  }
}
</script>

<style>

.Result{
 justify-content:center;
}
.ShowResult{
  height: 80vh;
  text-align: center;  
}
.pagination{
  display: flex;
  margin: 0;
  margin-top: 100px;
  padding-bottom: 20px;
  justify-content:center;
  list-style: none;
  background-color: #030E12;
  color: #fff;
}
.page-link{
  display: inline-block;
  width: 43px;
  height: 43px;
  line-height: 43px;
  padding: 0;
  text-align: center;
  outline: none;
  user-select: none;
  margin: 4px;
}
.active{
  border: solid 1px #1ED760;
  border-radius: 100%;
}
</style>