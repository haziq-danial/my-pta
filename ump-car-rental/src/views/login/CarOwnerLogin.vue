<template>
    <div>
        <v-flex xs12>
            <v-layout align-center justify-end column>
                <v-text-field 
                label="Matric Number"
                outline
                dark
                height="10"
                :error="err"
                v-model="username"
                class="textbox"
                ></v-text-field>
                <v-text-field 
                label="Password"
                outline
                dark
                height="10"
                class="textbox"
                :error="err"
                :type="showPwd ? 'text' : 'password'"
                v-model="password"
                :append-icon="showPwd ? 'visibility_off' : 'visibility'"
                @click:append="showPwd = !showPwd"
                ></v-text-field>
                <v-btn
                large
                style="width: 311.14px"
                :loading="loading"
                :disabled="loading"
                @click="goToMainPage"
                >Login</v-btn>
                <v-btn to="/register/owner-register"
                large
                style="width: 311.14px"
                >Sign Up as Car Owner</v-btn>
                <v-btn to="/login/student-login" 
                large
                flat
                dark
                style="width: 311.14px"
                >Login as Student</v-btn>
            </v-layout>
        </v-flex>
        <v-snackbar 
        v-model="snackbar"
        top
        :color="color"
        >
        {{ errmsg }}
        <v-btn
        flat
        @click="snackbar = false"
        >
            Close
        </v-btn>
        </v-snackbar>
    </div>
</template>

<script>
import axios from "axios"
import { mapActions } from "vuex"


export default {
    name: 'CarOwnerLogin',
    data() {
        return {
            snackbar: false,
            color: '',
            errmsg: '',
            username: '',
            password: '',
            showPwd: false,
            err: false,
            loading: null
        }
    },
    methods: {
        ...mapActions([
            'setCarOwner'
        ]),
        newOwner: function(owner) {
            this.setCarOwner(owner)
        },
        verifyLogin: async function(matric, passwrd) {
            try {
                const output = await axios.post('/api/login.php',{
                                type: 'car_owner',
                                matric_no: matric,
                                acc_pwd: passwrd
                            })
                //console.log(output.data)
                return output.data
            } catch (error) {
                console.log(error)
            }
        },
        getOwnerData: async function(matric, passwrd) {
          try {
              const output = await axios.post('/api/getOwner.php',{
                  type: 'login',
                  matric_no: matric,
                  acc_pwd: passwrd
              })
              //console.log(output.data)
              return output.data
          } catch (error) {
              console.log(error);
          }  
        },
        goToMainPage: async function() {
            let matric = this.username.toUpperCase()
            let passwrd = this.password
            this.loading = true
            let output =  await this.verifyLogin(matric, passwrd)
            if (output.verified === true) {
                let owner = await this.getOwnerData(matric, passwrd)
                this.newOwner(owner)
                setTimeout(() => {
                    this.loading = false
                    this.$router.push({ path: '/car-owner/main-page/dashboard'})
                }, 500)
            } else {
                setTimeout(() => {
                    this.snackbar = true
                    this.errmsg = 'Wrong password or matric'
                    this.color = 'error'
                    this.err = true
                    this.loading = false  
                }, 500)
            }
        }
    }
}
</script>

<style>

</style>
