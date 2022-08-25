<script>
import axios from "axios";
import AddAndEditCurrency from "@/components/AddAndEditCurrency.vue";
import AddAndEditPair from "@/components/AddAndEditPair.vue";
import EditCurrency from "@/components/EditCurrency.vue";

//const varEnv  = procces.env.SERVER_URL;

// const instance = axios.create({
//   baseURL: "https://domaine.com/api/", //point d'entrée de l'api
//   timeout: 1000,
//   headers: {
//     "Content-type": "",
//   },
// });

//const req1 = instance.baseURL.get("search/tweets.json");
// const req4 = axios.get("https://api.twitter.com/1.1/search/tweets.json");
// const req2 = axios.get(
//   "https://streaming-graph.facebook.com/12545265/live_comments"
// );
// const req3 = axios.get(
//   "https://api.instagram.com/v1/self/media/recent?access_token=asg5gx9ho5yyg2fs"
// );
export default {
  components: {
    AddAndEditCurrency,
    AddAndEditPair,
  },
  emits: ["getCurrency", "getPairs"],
  props: {
    currency: {
      type: Array
    },
    pairs: {
      type: Array
    },  
    urlCurrency :{
      type: String
    },
    urlPairs :{
      type: String
    },
    urlConverts :{
      type: String
    },
  },
  methods: {
    createCurrency(nameCurrency) {
      console.log(nameCurrency);
      axios
        .post(this.urlCurrency, {
          name: nameCurrency,
        })
        .then(() => {
          this.$emit("getCurrency");
        })
        .catch(e => {
          alert(e);
        });
    },
    editCurrency(id, currencyNameEdit) {
      console.log(id, currencyNameEdit)
      axios
        .put(`${this.urlCurrency}/${id}`, {
          name: currencyNameEdit,
        })
        .then(() => {
          this.$emit("getCurrency");
        })
        .catch(e => {
          
          alert(e);
        });
    },
    deleteCurrency(id){
      axios
        .delete(`${this.urlCurrency}/${id}`)
        .then(() => {
          this.$emit("getCurrency");
          this.$emit("getPairs");
        })
        .catch(e => {
          console.log("error");
          alert(e);
        });

    },
    createPairs(pairCurrencyInit, pairCurrencyDest, rate) {
      console.log(pairCurrencyInit, pairCurrencyDest, rate);
      axios
        .post(this.urlPairs, {
          currency_init: pairCurrencyInit,
          currency_dest: pairCurrencyDest,
          rate: rate,
        })
        .then((result) => {
          console.log(result["data"]);
          this.createConvert(result["data"]);
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
      axios
        .post(this.urlPairs, {
          currency_init: pairCurrencyDest,
          currency_dest: pairCurrencyInit,
          rate: 1/rate,
        })
        .then((result) => {
          console.log(result["data"]);
          this.createConvert(result["data"]);
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
    },
    createConvert(pairId) {
      axios
        .post(this.urlConverts, {
          id_pair: pairId,
          count_conversion: 0,
        })
        .then(() => {
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
    },
    editPair(id, pairInitEdit, pairDestEdit, rateEdit) {
      console.log(id, pairInitEdit, pairDestEdit, rateEdit);
      axios
        .put(`${this.urlPairs}/${id}`, {
          currency_init: pairInitEdit,
          currency_dest: pairDestEdit,
          rate: rateEdit,
        })
        .then(() => {
          this.$emit("getCurrency");
          this.$emit("getPairs");
        })
        .catch((e) => {
          alert(e);
        });
    },
    deletePair(id) {
      console.log(id, `${this.urlPairs}/${id}`);
      axios
        .delete(`${this.urlPairs}/${id}`)
        .then(() => {
          this.$emit("getCurrency");
          this.$emit("getPairs");
        })
        .catch((e) => {
          console.log("error");
          alert(e);
        });
    },
  },
  created() {
  }
};
</script>
<template>
  
  <AddAndEditCurrency
        :currency="currency"
        :urlCurrency="urlCurrency"
        @createCurrency="createCurrency"
        @editCurrency="editCurrency"
        @deleteCurrency="deleteCurrency"
  />
  <AddAndEditPair
    :currency="currency"
    :pairs="pairs"
    :urlPairs="urlPairs"
    @createPairs="createPairs"
    @editPair="editPair"
    @deletePair="deletePair"
  />
</template>
