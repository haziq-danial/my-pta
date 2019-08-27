<template>
    <v-card flat>
        <v-container fluid grid-list-xl>
            <v-layout align-start row wrap>
                <v-flex d-flex xs12 sm12 md6>
                    <v-card class="grey lighten-3 rounded-card" flat>
                        <v-layout row>
                            <v-flex xs12 sm12 md12>
                                <v-card-title primary-title>
                                    <p class="display-1 font-weight-light text-xs-center">Personal Details</p>
                                </v-card-title>
                            </v-flex>
                        </v-layout>
                        <v-container grid-list-md>
                            <v-form v-model="valid" ref="formpd">
                                <v-layout wrap>
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field outline height="10" :rules="[a => !!a || 'Field is required']" v-model="phone" type="text" label="Phone no"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm12 md12>
                                        <v-text-field outline height="10" :rules="[a => !!a || 'Field is required', a => /.+@.+/.test(a) || 'E-mail must be valid']" v-model="email" type="text" label="Email"></v-text-field>
                                    </v-flex>
                                    <v-flex d-flex xs12 sm12 md12>
                                        <v-menu
                                            ref="menudob"
                                            v-model="menudob"
                                            :close-on-content-click="false"
                                            :nudge-right="40"
                                            :return-value.sync="dateOfBirth"
                                            lazy
                                            transition="scale-transition"
                                            max-width="290px"
                                            min-width="290px"
                                            >
                                                <v-text-field
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
                                </v-layout>
                                <div class="text-xs-center mt-5">
                                    <v-btn color="red darken-4" dark large @click.stop="cancel = !cancel">Cancel</v-btn>
                                    <v-btn color="success" :disabled="!valid" @click="updatePersonalDetails()" large>Save</v-btn>
                                </div>
                            </v-form>
                        </v-container>
                    </v-card>
                </v-flex>
                <v-flex d-flex xs12 sm12 md6>
                    <v-card class="grey lighten-3 rounded-card" flat>
                        <v-layout row>
                            <v-flex xs12 sm12 md12>
                                <v-card-title primary-title>
                                    <p class="display-1 font-weight-light text-xs-center">License Details</p>
                                </v-card-title>    
                            </v-flex>
                        </v-layout>
                        <v-container grid-list-md>
                            <v-form v-model="valid2" ref="form">
                                <v-layout wrap>
                                    <v-flex xs12 sm12 md12>
                                        <p class="title font-weight-light">Driving License</p>       
                                        <v-radio-group :rules="[a => !!a || 'Field is required']" v-model="licenseCountry" row>
                                            <v-radio color="red darken-4" label="Malaysia" value="Malaysia"></v-radio>
                                            <v-radio color="red darken-4" label="International" value="International"></v-radio>
                                        </v-radio-group> 
                                    </v-flex>
                                    <v-flex>
                                        <div v-if="licenseCountry === 'Malaysia'">
                                            <v-flex xs12 sm12 md12>
                                                <v-text-field outline  height="10" :rules="[a => !!a || 'Field is required']" :error="err" v-model="nric" type="text" label="NRIC"></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12>
                                                <v-select
                                                :items="['Probationary Driving Licence','Competent Driving License','Vocational Driving Licence']"
                                                label="License Type"
                                                v-model="licenseType"
                                                outline
                                                ></v-select>
                                            </v-flex>
                                            <v-flex d-flex xs12 sm12 md12>
                                                <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="licenseExpiry"
                                                
                                                lazy
                                                transition="scale-transition"
                                                min-width="290px"
                                                    >
                                                    <v-text-field
                                                        slot="activator"
                                                        v-model="licenseExpiry"
                                                        label="License Expiry Date"
                                                        outline
                                                        prepend-icon="event"
                                                        :rules="[a => !!a || 'Field is required']"
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
                                                <v-text-field outline  height="10" :rules="[a => !!a || 'Field is required']" :error="err" v-model="passport" type="text" label="Passport Number"></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12>
                                                <v-select
                                                :items="['Both Auto & Manual', 'Auto Only']"
                                                label="License Type"
                                                v-model="licenseType"
                                                outline
                                                :rules="[a => !!a || 'Field is required']"
                                                ></v-select>
                                            </v-flex>
                                            <v-flex d-flex xs12 sm12 md12>
                                                <v-menu
                                                ref="menu"
                                                v-model="menu"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                :return-value.sync="licenseExpiry"
                                                
                                                lazy
                                                transition="scale-transition"
                                                min-width="290px"
                                                    >
                                                    <v-text-field
                                                        
                                                        slot="activator"
                                                        v-model="licenseExpiry"
                                                        label="License Expiry Date"
                                                        outline
                                                        prepend-icon="event"
                                                        readonly
                                                        :rules="[a => !!a || 'Field is required']"
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
                                <div class="text-xs-center mt-5">
                                    <v-btn color="red darken-4" dark large @click.stop="cancel2 = !cancel2">Cancel</v-btn>
                                    <v-btn color="success" :disabled="!valid2" @click="updateLicense()" large>Save</v-btn>
                                </div>
                            </v-form>
                        </v-container>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</template>

<script>
import { mapState } from "vuex"
import { bus } from '../../main.js'
import Axios from 'axios'
export default {
    name: 'OwnerEditProfile',
    data() {
        return {
            cancel: false,
            cancel2: false,
            valid: false,
            valid2: false,
            text: 'test',
            matricno: '',
            firstname: '',
            lastname: '',
            licenseCountry: '',
            phone: '',
            email: '',
            password: '',
            nric: '',
            licenseType: '',
            passport: '',
            showpwd: false,
            password2: '',
            showpwd2: false,
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
            dateOfBirth: new Date().toISOString().substr(0, 10),
            licenseExpiry: new Date().toISOString().substr(0, 10),
            menudob: false,
            modaldob: false,
            menu2dob: false,
            err: false
        }
    },
    methods: {
        updatePersonalDetails: async function() {
            let formData = new FormData()
            formData.append('phone_no', this.phone)
            formData.append('email', this.email)
            formData.append('date_of_birth', this.dateOfBirth)
            formData.append('matric_no', this.car_owner.matric_no)
            formData.append('edit_type', 'details')
            formData.append('type', 'owner')
            try {
                const output = await Axios.post('/api/updateProfile.php', formData)
                bus.$emit('update-profile')
            } catch (error) {
                console.log(error);
            }
        },
        updateLicense: async function() {
            let id = ''
            if(this.licenseCountry === 'Malaysia') {
                id = this.nric
            }
            if (this.licenseCountry === 'International') {
                id = this.passport
            }
            let formData = new FormData()
            formData.append('id_no', id)
            formData.append('student_country', this.licenseCountry)
            formData.append('license_type', this.licenseType)
            formData.append('matric_no', this.car_owner.matric_no)
            formData.append('license_expired', this.licenseExpiry)
            formData.append('edit_type', 'license')
            formData.append('type', 'owner')
            try {
                const output = await Axios.post('/api/updateProfile.php', formData)
                bus.$emit('update-profile')
            } catch (error) {
                
            }
        },
    },
    computed: {
        ...mapState([
            'car_owner'
        ]),
    },
    watch: {
        cancel: function(newValue) {
            if (newValue) {
                this.$refs.formpd.reset()
                this.cancel = !this.cancel
            }
        },
        cancel2: function(newValue) {
            if (newValue) {
                this.$refs.form.reset()
                this.cancel2 = !this.cancel2
            }
        }
    },
}
</script>

<style scoped>
.profile-height {
    min-height: 30px;
    max-height: 38px;
}
.edit-profile-height {
    height: 90px;
}
</style>
