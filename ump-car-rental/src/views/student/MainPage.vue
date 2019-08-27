<template>
    <v-layout class="grey lighten-5">
        <v-navigation-drawer
        v-model="drawer"
        fixed
        floating
        class="red darken-4"
        app
        dark
        >
            <v-list dense class="pt-0" three-line>
                <v-list-tile to="/student/main-page/all-car" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content class="pb-2">
                        <v-list-tile-title class="headline">All Cars</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile to="/student/main-page/bookings" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>directions_car</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title style="height: 30px" class="headline">Bookings</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile to="/student/main-page/profile" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>person</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content class="pb-2">
                        <v-list-tile-title class="headline">Profile</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile to="/student/main-page/search" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>search</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content class="pb-2">
                        <v-list-tile-title class="headline">Search</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar 
        color="grey lighten-3"
        class="elevation-0"
        fixed
        app
        >
            <v-toolbar-side-icon icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>

            <v-toolbar-title class="font-weight-light">UMP Car Rental</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-toolbar-title class="font-weight-light">SIGN OUT</v-toolbar-title>
            <v-btn icon @click="logOut">
                <v-icon>exit_to_app</v-icon>
            </v-btn>
        </v-toolbar>
        <v-content>
            <router-view></router-view>
        </v-content>
    </v-layout>
</template>

<script>
import axios from "axios"
import { mapActions, mapState } from "vuex"
import { bus } from '../../main.js'
export default {
    name: 'MainPage',
    data() {
        return {
            drawer: false,
        }
    },
    computed: {
        ...mapState([
            'isBooking'
        ])
    },
    methods: {
        ...mapActions([
            'setStudent',
            'setStudentEmpty',
            'isEmpty',
            'setBooking',
            'setBookingEmpty',
            'setCarBook',
            'setCarBookEmpty',
            'setCarOwner',
            'setCarOwnerEmpty'
        ]),
        checkStatus: async function() {
            try {
                const output = await axios.post('/api/auth.php')
                return output.data
            } catch (error) {
                console.log(errror);
            }
        },
        getStudent: async function() {
            try {
                const output = await axios.post('/api/getStudent.php',{
                    type: 'get'
                })
                return output.data
            } catch (error) {
                console.log(error);
            }
        },
        addStudent: function(student) {
            this.setStudent(student)
        },
        logOut: async function() {
            try {
                const output = await axios.get('/api/logout.php')
            } catch (error) {
                console.log(error);
            }
            this.setStudentEmpty()
            this.setBookingEmpty()
            this.setCarOwnerEmpty()
            this.setCarBookEmpty()
            this.$router.push({ path: '/login/student-login'})
        },
        getBooking: async function(matric_no) {
            let formData = new FormData()
            formData.append('type', 'get_booking_std')
            formData.append('matric_no', matric_no)
            try {
                const output = await axios.post('/api/booking.php', formData)
                .then((res) => {
                    if (res.data === 'not found') {
                        return res.data
                    } else {
                        let bookings = res.data
                        let array = []
                        bookings.forEach(element => {
                            let obj = JSON.parse(element)
                            array.push(obj)
                        });
                        return array
                    }
                })
                if (output === 'not found') {
                    this.setBookingEmpty()
                    this.setCarOwnerEmpty()
                    this.setCarBookEmpty()
                } else {
                    let bookings = output
                    let match = false

                    bookings.forEach(element => {
                        if (element.booking_status === 'ongoing') {
                            match = true
                            this.setBooking(element)
                            this.getCar(element.owner_matric)
                            this.getOwner(element.owner_matric)
                            bus.$emit('disable-booking', this.isBooking)
                        } 
                    });
                    
                    if (!match) {
                        this.setBookingEmpty()
                        this.setCarOwnerEmpty()
                        this.setCarBookEmpty()
                    } 
                    
                }
                
            } catch (error) {
                console.log(error);
            }
        },
        getCar: async function(owner_matric) {
            try {
                const output = await axios.get('/api/getCar.php',{
                    params: {
                        type: 'getCar',
                        matric_no: owner_matric
                    }
                })
                this.setCarBook(output.data)
            } catch (error) {
                console.log(error);
            }
        },
        getOwner: async function(owner_matric) {
            try {
                const output = await axios.post('/api/getOwner.php',{
                    type: 'getOwnerData',
                    matric_no: owner_matric,
                })
                this.setCarOwner(output.data)
            } catch (error) {
                console.log(error);
            }
        },
        updateStudent: async function() {
            let student = await this.getStudent()
            this.addStudent(student)
        }
    },
    async created() {
        let res = await this.checkStatus()
        if(res.status === true) {
            if (this.isEmpty(this.student)) {
                let student = await this.getStudent()
                this.addStudent(student)
                this.getBooking(student.matric_no)
                bus.$emit('recent-bookings', student.matric_no)
            }
        } else {
            this.$router.push({ path: '/login/student-login'})
        }
    },
    mounted() {
        bus.$on('book-car', (matric_no) => {
            this.getBooking(matric_no)
        })
        bus.$on('car-cancel', (matric_no) => {
            this.getBooking(matric_no)
        })
        bus.$on('update-profile', () => {
            this.updateStudent()
        })
    }
}
</script>

<style>

#main-background {
    height: 100%;
    padding-bottom: 10%
}
.rounded-card {
    border-radius: 9px;
}
</style>
