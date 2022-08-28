<template>
    <div class="display"> 
        <p class="logo" v-on:click.prevent="changeView('/currencies')">MoneyValue</p>
        <div class="button">
            <p v-on:click.prevent="changeView('/currencies')">Devise </p>   
            <p v-on:click.prevent="changeView('/pairs')">Paire </p>   
            <p v-on:click.prevent="logout" class="buttonLogout">Logout</p>
        </div>

    </div>
   
</template>
<script>
export default{
    emits: ["logout"],
    methods: {
        logout(){
            this.$emit("logout");
           

        },
        changeView(router){
            this.$router.push("/admin"+router);
        }
    },
}
</script>
<style scoped>

* {
    display:flex;
    justify-content: space-between;
    background-color: #B99890;
    padding: 12px 30px 12px 30px ;

  

}
.button{
    display:flex;
    justify-content: end;
    font-size: 20px;
}
.logo{
    font-size: 40px;
}
.display{
    display:flex;
}
.buttonLogout{
    color:green;
}
</style>
