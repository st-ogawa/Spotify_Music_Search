export default{

  methods: {
      
    endpoint(){
      let endpoint = ''
      
      this.$store.getters.getToken ?
      endpoint = "/api/favorite":
      endpoint = "/api/public";
      

      return endpoint
    }
  },
}