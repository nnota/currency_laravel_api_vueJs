<template>
    <div class="data">
      <div v-for="item in currency" v-bind:value="item.id">
          <p>{{ item.name }}</p>
          <button @click="editChoose(item.id)">Modifier</button>
          <button @click="deleteCurrency(item.id)">Supprimer </button>
          <div v-if="edit==true && idEdit==item.id">
            <form @submit.prevent="editCurrency">
              <label>Name de devise</label>
              <input
                  type="text"
                  name="currencyNameEdit"
                  v-model="currencyNameEdit"
              />
              <button type="submit">
                submit
            </button>
            </form>
          </div>
      </div>
      
    </div>
    <div class="my-form">
        <p> Ajouter nouveau devise</p>
        <form class="ui form" @submit.prevent="createCurrency">
        <div class="fields">
            <div class="four wide field">
                <label>Name de devise</label>
                <input
                    type="text"
                    name="currencyName"
                    placeholder="currencyName"
                    v-model="currencyName"
                />
            </div>
            <div class="two wide field">
            <button type="submit">
                submit
            </button>
            </div>
        </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "addCurrency",
  emits: ["createCurrency", "editCurrency", "deleteCurrency"],
  props: {
    currency: {
        type: Array
    },

    pairs: {
        type: Array
    },

    urlCurrency : {
        type:String
    }
  },
  data() {
    return {
      currencyName: "",
      edit : false,
      idEdit : 0,
      currencyNameEdit: "",
    };
  },
  methods: {
    createCurrency() {
      // window.console.log("customer list delete " + id);
      if(this.currencyName != ""){
        this.$emit("createCurrency", this.currencyName);
      }
      
    },
    editChoose(id){
      this.edit = !this.edit;
      this.idEdit =  id;
      this.getCurrencyById(this.idEdit);

    },
    getCurrencyById(id){
      axios.get(`${this.urlCurrency}/${id}`).then(data => {
        this.currencyNameEdit = data["data"].name;
        });
        console.log(this.currencyNameEdit);
    },
    editCurrency() {
      this.$emit("editCurrency",this.idEdit, this.currencyNameEdit);
      this.edit = false;
    },
    deleteCurrency(id){
      this.$emit("deleteCurrency",id);   
    }
  },
  created() {
  }
};
</script>



