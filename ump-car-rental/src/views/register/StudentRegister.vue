<template>
    <v-content>
        <p 
        id="text-register"
        class="white--text font-weight-light text-xs-center"
        >Student Register</p>
        <!-- Personal Details -->
        <v-container fluid grid-list-xl>
            <v-form v-model="valid" ref="form">
                <v-layout align-start justify-center row wrap>
                    <v-flex d-flex xs12 sm12 md5>
                        <v-card class="red darken-2 rounded-card" flat>
                            <v-layout row>
                                <v-flex xs12 sm12 md12>
                                    <v-card-title primary-title>
                                        <p class="display-1 font-weight-light text-xs-center white--text">Personal Details</p>
                                    </v-card-title>    
                                </v-flex>
                            </v-layout>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm12 md6>
                                        <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="firstname" type="text" label="First Name"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12 md6>
                                        <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="lastname" type="text" label="Last Name"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="matricno" type="text" label="Matric Card No"></v-text-field>
                                    </v-flex>
                                    <v-flex d-flex xs12 sm12 md12>
                                        <v-menu
                                            ref="menudob"
                                            v-model="menudob"
                                            :close-on-content-click="false"
                                            :nudge-right="40"
                                            :return-value.sync="dateOfBirth"
                                            dark
                                            lazy
                                            transition="scale-transition"
                                            max-width="290px"
                                            min-width="290px"
                                            >
                                                <v-text-field
                                                    dark
                                                    slot="activator"
                                                    v-model="dateOfBirth"
                                                    label="Date of Birth"
                                                    outline
                                                    prepend-icon="event"
                                                    readonly
                                                ></v-text-field>
                                                <v-date-picker v-model="dateOfBirth" light no-title scrollable>
                                                    <v-spacer></v-spacer>
                                                    <v-btn flat color="primary" @click="menudob = false">Cancel</v-btn>
                                                    <v-btn flat color="primary" @click="$refs.menudob.save(dateOfBirth)">OK</v-btn>
                                                </v-date-picker>
                                        </v-menu>                                
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="phone" label="Phone"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required', a => /.+@.+/.test(a) || 'E-mail must be valid']" v-model="email" label="Email"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="password" :type="showpwd ? 'text' : 'password'"  label="Password" :append-icon="showpwd ? 'visibility_off' : 'visibility'" @click:append="showpwd = !showpwd"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="password2" :type="showpwd2 ? 'text' : 'password'"  label="Confirm Password" :append-icon="showpwd2 ? 'visibility_off' : 'visibility'" @click:append="showpwd2 = !showpwd2"></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card>
                    </v-flex>
                    <!-- License Details -->
                    <v-flex d-flex xs12 sm12 md5>
                        <v-card class="red darken-2 rounded-card" flat>
                            <v-layout row>
                                <v-flex xs12 sm12 md12>
                                    <v-card-title primary-title>
                                        <p class="display-1 font-weight-light text-xs-center white--text">License Details</p>
                                    </v-card-title>    
                                </v-flex>
                            </v-layout>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm12 md12>
                                        <p class="title font-weight-light white--text">Driving License</p>       
                                        <v-radio-group dark v-model="licenseCountry" row>
                                            <v-radio color="white" label="Malaysia" value="Malaysia"></v-radio>
                                            <v-radio color="white" label="International" value="International"></v-radio>
                                        </v-radio-group> 
                                    </v-flex>
                                    <v-flex>
                                        <div v-if="licenseCountry === 'Malaysia'">
                                            <v-flex xs12 sm12 md12>
                                                <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="nric" type="text" label="NRIC"></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12>
                                                <v-select
                                                :items="['Probationary Driving Licence','Competent Driving License','Vocational Driving Licence']"
                                                label="License Type"
                                                v-model="licenseType"
                                                outline
                                                dark
                                                ></v-select>
                                            </v-flex>
                                            <v-flex d-flex xs12 sm12 md12>
                                                <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="licenseExpiry"
                                                dark
                                                lazy
                                                transition="scale-transition"
                                                min-width="290px"
                                                    >
                                                    <v-text-field
                                                        dark
                                                        slot="activator"
                                                        v-model="licenseExpiry"
                                                        label="License Expiry Date"
                                                        outline
                                                        prepend-icon="event"
                                                        readonly
                                                    ></v-text-field>
                                                    <v-date-picker v-model="licenseExpiry" light no-title scrollable>
                                                        <v-spacer></v-spacer>
                                                        <v-btn flat color="primary" @click="menu = false">Cancel</v-btn>
                                                        <v-btn flat color="primary" @click="$refs.menu.save(licenseExpiry)">OK</v-btn>
                                                    </v-date-picker>
                                                </v-menu>                                
                                            </v-flex>
                                        </div>
                                        <div v-if="licenseCountry === 'International'">
                                            <v-flex xs12 sm12 md12>
                                                <v-text-field outline dark height="10" :rules="[a => !!a || 'Field is required']" v-model="passport" type="text" label="Passport Number"></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12>
                                                <v-select
                                                :items="['Both Auto & Manual', 'Auto Only']"
                                                label="License Type"
                                                v-model="licenseType"
                                                outline
                                                dark
                                                ></v-select>
                                            </v-flex>
                                            <v-flex d-flex xs12 sm12 md12>
                                                <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="licenseExpiry"
                                                dark
                                                lazy
                                                transition="scale-transition"
                                                min-width="290px"
                                                    >
                                                    <v-text-field
                                                        dark
                                                        slot="activator"
                                                        v-model="licenseExpiry"
                                                        label="License Expiry Date"
                                                        outline
                                                        prepend-icon="event"
                                                        readonly
                                                    ></v-text-field>
                                                    <v-date-picker v-model="licenseExpiry" light no-title scrollable>
                                                        <v-spacer></v-spacer>
                                                        <v-btn flat color="primary" @click="menu = false">Cancel</v-btn>
                                                        <v-btn flat color="primary" @click="$refs.menu.save(licenseExpiry)">OK</v-btn>
                                                    </v-date-picker>
                                                </v-menu>                                
                                            </v-flex>
                                        </div>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card>
                    </v-flex>
                    <v-btn
                    large
                    class="mt-4"
                    style="width: 311.14px"
                    :loading="loading"
                    :disabled="!valid"
                    @click="checkForm()"
                    >Sign Up</v-btn>

                    <v-btn 
                    @click.stop="clear = !clear"
                    class="mt-4"
                    style="width: 311.14px"
                    large
                    >Clear</v-btn>
                </v-layout>
            </v-form>
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
        </v-container>
    </v-content>
</template>

<script>
import axios from "axios";

export default {
    name: 'StudentRegister',
    data() {
        return {
            snackbar: false,
            color: '',
            errmsg: '',
            valid: false,
            clear: false,
            firstname: '',
            lastname: '',
            matricno: '',
            phone: '',
            email: '',
            password: '',
            password2: '',
            nric: '',
            passport: '',
            licenseCountry: '',
            licenseType: '',
            showpwd: false,
            showpwd2: false,
            licenseExpiry: new Date().toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
            dateOfBirth: new Date().toISOString().substr(0, 10),
            menudob: false,
            modaldob: false,
            menu2dob: false,
            err: false,
            loading: null
        }
    },
    methods: {
        registerData: async function(countryid) {
            try {
                const res = await axios.post('/api/register.php',{
                    type: 'student',
                    firstname: this.firstname,
                    lastname: this.lastname,
                    matricno: this.matricno,
                    phone: this.phone,
                    email: this.email,
                    acc_pwd: this.password,
                    date_of_birth: this.dateOfBirth,
                    id_no: countryid,
                    student_country: this.licenseCountry,
                    license_type: this.licenseType,
                    license_expired: this.licenseExpiry
                    
                })
                console.log(res.data.success)
                return res.data
            } catch (error) {
                console.log(error)
            }
        },
        signUp: async function () {
            this.matricno = this.matricno.toUpperCase()
            let id = ''
            if(this.licenseCountry === 'Malaysia') {
                id = this.nric
            }
            if (this.licenseCountry === 'International') {
                id = this.passport
            }
            this.loading = true
            if(this.password === this.password2 && this.password !== "" && this.password2 !== "") {

                let confirm = await this.registerData(id)
                // console.log(typeof confirm);
                if (confirm.success === true) {
                    console.log("success")
                        setTimeout(() => {
                            this.loading = false
                            this.err = false
                            this.$router.push({ path: '/login/student-login'})
                        },500)
                    } else {
                        
                        this.loading = false
                        this.err = true
                    }
            } else {
                this.loading = false
                this.err = true
            }
        },
        checkMatric: async function(){
            let formData = new FormData()
            formData.append('matric_no', this.matricno)
            formData.append('type', 'student')
            try {
                const output = await axios.post('/api/checkMatric.php', formData)
                return output.data 
            } catch (error) {
                console.log(error);
            }
        },
        checkForm: async function() {
            this.matricno = this.matricno.toUpperCase()
            let similar = await this.checkMatric()
            if (similar.verify === true) {
                this.snackbar = true
                this.errmsg = 'Matric Number Already Exists'
                this.color = 'error'
            } else {
                if (this.licenseCountry === '') {
                    this.snackbar = true
                    this.errmsg = 'Form not Complete'
                    this.color = 'error'
                } else {
                    this.signUp()
                }
            }
            
        }
    },
    watch: {
        clear: function(newValue) {
            if (newValue) {
                this.$refs.form.reset()
                this.cancel2 = !this.cancel2
            }
        },
        snackbar: function(newValue) {
            if (newValue === false) {
                this.$refs.form.resetValidation()
            }
        },
    },
}
</script>

<style>
#text-register {
    margin-top: 15px;
    font-size: 79px;
}
</style>
