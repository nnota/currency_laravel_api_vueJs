<script>
import { RouterLink, RouterView } from 'vue-router';
import axios from "axios";

export default {
  data() {
    return {
      urlCurrency: "http://127.0.0.1:8000/api/currencies",
      urlConverts: "http://127.0.0.1:8000/api/converts",
      urlPairs: "http://127.0.0.1:8000/api/pairs",
      urlUsers: "http://127.0.0.1:8000/api/pairs",

      currency: [],
      pairs: [],
    };
  },
  methods: {
    // chooseModify(){
    //   this.modify = !this.modify;
    //   console.log(this.modify);
    // },
    getCurrency() {
      axios.get(this.urlCurrency).then(data => {
        this.currency = data["data"];
      });
    },
    getPairs(){
      axios.get(this.urlPairs).then(data => {
        this.pairs = data["data"];
      });

    },
    connexion(email, password){
      console.log(email, password)
       this.axios.get('http://127.0.0.1:8000/api/users', {
          email: email,
          password: password,
        })
        .then(({data}) => {
            console.log("succes")
        })
        .catch((error) => {
            console.log(error);
        });

    },
  },
  created() {
    this.getCurrency();
    this.getPairs();
  },
};
</script>

<template>
  <RouterView 
    @getCurrency="getCurrency"
    @getPairs="getPairs"
    @connexion="connexion"
    :currency="currency" 
    :pairs="pairs" 
    :urlPairs="urlPairs"
    :urlCurrency="urlCurrency"
    :urlConverts="urlConverts"
    
    />
</template>

<style scoped>

</style>
