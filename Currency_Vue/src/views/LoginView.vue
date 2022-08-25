<script>
import axios from "axios";
import AddAndEditCurrency from "@/components/AddAndEditCurrency.vue";
import AddAndEditPair from "@/components/AddAndEditPair.vue";
import EditCurrency from "@/components/EditCurrency.vue";
;
export default {
    data() {
        return {
            email: "",
            password:"",
        };
    },
    emits: ["connexion"],
    methods: {
        connexion(){
            this.$emit("connexion", this.email, this.password);
        }
        
    },
    created() {
    }
};
</script>
<template>
    <div>
        <p>Connexion</p>
        <form class="ui form" @submit.prevent="connexion">
            <div class="fields">
                <div class="four wide field">
                    <label>E-mail</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="email"
                        v-model="email"
                    />
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="password"
                        v-model="password"
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
