<template>
    <div>
        <v-flex xs12>
            <v-layout align-center justify-end column>
                <v-text-field 
                label="Matric Number"
                outline
                dark
                type="text"
                v-model="username"
                height="10"
                class="textbox"
                :error="err"
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
                <v-btn to="/register/student-register"
                large
                style="width: 311.14px"
                >Sign Up as Student</v-btn>
                <v-btn to="/login/owner-login" 
                large
                flat
                dark
                style="width: 311.14px"
                >Login as Car Owner</v-btn>
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
    name: 'StudentLogin',
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
            'setStudent'
        ]),
        newStudent: function(student) {
            this.setStudent(student)
        },
        verifyLogin: async function(matric, passwrd) {
            try {
                const output = await axios.post('/api/login.php',{
                                type: 'student',
                                matric_no: matric,
                                acc_pwd: passwrd
                            })
                //console.log(output.data)
                return output.data
            } catch (error) {
                console.log(error)
            }
        },
        getStudentData: async function(matric, passwrd) {
          try {
              const output = await axios.post('/api/getStudent.php',{
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
                let student = await this.getStudentData(matric, passwrd)
                this.newStudent(student)
                setTimeout(() => {
                    this.loading = false
                    this.$router.push({ path: '/student/main-page/all-car'})
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
.textbox {
    width: 311.14px;
}
</style>
