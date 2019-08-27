<template>
    <v-card flat>
        <v-container fluid grid-list-xs>
            <v-layout row>
                <v-flex xs12>
                    <v-card-title primary-title>
                        <div>
                            <div class="display-1">My Profile</div>
                        </div>
                    </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">Matric No:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.matric_no }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">Name:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.firstname }} {{ student.lastname }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">Phone Number:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.phone_no }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">Email:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.email }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">Age:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text> {{ age }} </v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">License Type:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.license_type }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">License Expiry:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.license_expired }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">Natonality:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.student_country }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="profile-height">
                <v-flex xs2>
                    <v-card-text class="subheading font-weight-bold">Nric/ID no:</v-card-text>
                </v-flex>
                <v-flex xs7>
                    <v-card-text>{{ student.id_no }}</v-card-text>
                </v-flex>
            </v-layout>
        </v-container>
        <div class="text-xs-center mt-3">
            <v-btn color="red darken-3" @click="next()" dark large>Edit</v-btn>
            <v-btn color="red darken-3" @click.stop="passDialog = !passDialog" dark large>Change Password</v-btn>
        </div>
        
        <v-dialog v-model="passDialog" persistent width="500">
            <v-card>
                <v-card-title class="red darken-4">
                    <div>
                        <div class="headline white--text" primary-title>Change Password</div>
                    </div>
                </v-card-title>
                <v-form v-model="valid" ref="form">
                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12>
                                    <v-text-field 
                                    v-model="currPass" 
                                    :rules="currRules" 
                                    :error="currErr" 
                                    label="Current Password" 
                                    :type="showPwd ? 'text' : 'password'"
                                    :append-icon="showPwd ? 'visibility_off' : 'visibility'"
                                    @click:append="showPwd = !showPwd"
                                    required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field 
                                    v-model="newPass" 
                                    :rules="newRules" 
                                    :error="newErr" 
                                    label="New Password" 
                                    :type="showPwd1 ? 'text' : 'password'"
                                    :append-icon="showPwd1 ? 'visibility_off' : 'visibility'"
                                    @click:append="showPwd1 = !showPwd1"
                                    required
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field 
                                    v-model="newPass2" 
                                    :rules="newRules2" 
                                    :error="newErr2" 
                                    label="Confirm Password" 
                                    :type="showPwd2 ? 'text' : 'password'"
                                    :append-icon="showPwd2 ? 'visibility_off' : 'visibility'"
                                    @click:append="showPwd2 = !showPwd2"
                                    required
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red darken-4" flat @click="passDialog = false">Close</v-btn>
                        <v-btn color="red darken-4" :disabled="!valid" flat @click="updatePassword()">Save</v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
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

    </v-card>
</template>

<script>
import { mapState } from "vuex"
import Axios from 'axios'
export default {
    name: 'StudentProfile',
    data() {
        return {
            showPwd: false,
            showPwd1: false,
            showPwd2: false,
            snackbar: false,
            success: false,
            errmsg: '',
            color: '',
            valid: false,
            passDialog: false,
            currPass: '',
            currErr: false,
            currRules: [
                a => !!a || 'Field is required',
            ],
            newPass: '',
            newRules: [
                a => !!a || 'Field is required',
            ],
            newErr: false,
            newPass2: '',
            newRules2: [
                a => !!a || 'Field is required',
            ],
            newErr2: false
        }
    },
    methods: {
        next: function() {
            this.$emit('nextTab')
        },
        updatePassword: async function() {
            let oldPwd = await this.getPassword()
            // console.log(oldPwd);
            if (this.newPass === this.newPass2) {
                if (this.currPass === oldPwd) {
                    let formData = new FormData()
                    formData.append('new_pwd', this.newPass)
                    formData.append('matric_no', this.student.matric_no)
                    formData.append('type', 'student')
                    try {
                    const output = await Axios.post('/api/updatePassword.php', formData)
                    this.success = true
                    this.passDialog = false
                    } catch (error) {
                        console.log(error);
                    }
                    // this.passDialog = false
                } else {
                    this.currErr = true
                }
                
            } else {
                this.newErr = true
                this.newErr2 = true
            }
            
        },
        getPassword: async function() {
            let formData = new FormData()
            formData.append('matric_no', this.student.matric_no)
            formData.append('type', 'student')
            try {
                const output = await Axios.post('/api/getPassword.php', formData)
                .then((res) => {
                    return res.data
                })
                return output
            } catch (error) {
                console.log(error);
            }
        }
    },
    computed: {
        ...mapState([
            'student'
        ]),
        age: function() {
            let dob = this.student.date_of_birth || '2000-09-27'
            let date = new Date()
            let year = date.getFullYear()
            let birthYear = Number(dob.match(/^(\d+)/)[1])
            // console.log(birthYear);
            // console.log(year);
            let age = year - birthYear
            return `${age} Years Old`
        }
    },
    watch: {
        passDialog: function(newValue) {
            if (newValue === false) {
                this.currPass = ''
                this.newPass = ''
                this.newPass2 = ''
                this.newErr = false
                this.newErr2 = false
                this.currErr = false
                this.showPwd = false
                this.showPwd1 = false
                this.showPwd2 = false
                this.$refs.form.resetValidation()
            }
        },
        currErr: function(newValue) {
            if (newValue === true) {
                this.snackbar = true
                this.errmsg = 'Incorrect Password'
                this.color = 'error'
            }
        },
        snackbar: function(newValue) {
            if (newValue === false) {
                this.newErr = false
                this.newErr2 = false
                this.currErr = false
                this.success = false
                this.currPass = ''
                this.newPass = ''
                this.newPass2 = ''
                this.$refs.form.resetValidation()
            }
        },
        newErr: function(newValue) {
            if (newValue === true) {
                this.snackbar = true
                this.errmsg = 'Password not match'
                this.color = 'error'
            }
        },
        success: function(newValue) {
            if (newValue === true) {
                this.snackbar = true
                this.errmsg = 'Success!!!'
                this.color = 'success'
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
