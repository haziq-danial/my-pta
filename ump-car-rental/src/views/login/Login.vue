<template>
    <div class="red darken-3 login-register">
        <v-container>
            <p 
            id="text-login" 
            class="white--text center font-weight-light text-xs-center"
            >Login</p>
            <router-view></router-view>
        </v-container>
    </div>
</template>

<script>
export default {
    name:'Login'
}
</script>

<style scoped>
#text-login {
    margin-top: 15px;
    font-size: 144px;
}
.login-register {
    padding-bottom: 5%;
}
</style>
