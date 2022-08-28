<script>
import axios from "axios";
import Header from "@/components/Header.vue";
export default {
  components: {
    Header,
  },
  data() {
    return {
      nameAdmin: localStorage.getItem("nameAdmin"),
    };
  },
  emits: ["getCurrency", "getPairs", "getConverts", "connexion", "logout"],
  props: {
    currency: {
      type: Array,
    },
    pairs: {
      type: Array,
    },
    converts: {
      type: Array,
    },
    urlCurrency: {
      type: String,
    },
    urlPairs: {
      type: String,
    },
    urlConverts: {
      type: String,
    },
  },
  methods: {
    logout(){
        this.$emit("logout");
    }
  },
  created() {},
};
</script>
<template>
    <Header
        @logout="logout"
    />  
    <div class="body">
      Bonjour {{nameAdmin}}
    </div>
</template>

<style scoped>
.body{
  display:flex;
  flex-direction: column;
  align-items: center;
  margin-top: 40px;
}
</style>



