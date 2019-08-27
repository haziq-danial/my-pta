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
                <v-list-tile to="/car-owner/main-page/dashboard" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>timeline</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content class="pb-2">
                        <v-list-tile-title class="headline">Dashboard</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile to="/car-owner/main-page/customer" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>face</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content class="pb-2">
                        <v-list-tile-title class="headline">Customer</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile to="/car-owner/main-page/profile" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>person</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content class="pb-2">
                        <v-list-tile-title class="headline">Profile</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile :disabled="disable" to="/car-owner/main-page/car-register" v-ripple="{ class: 'white--text' }" active-class="red darken-3 white--text">
                    <v-list-tile-action>
                        <v-icon>directions_car</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title  style="height: 30px" class="headline">Register Car</v-list-tile-title>
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
import { bus } from "../../main.js";
export default {
    name: 'MainPageOwner',
    data() {
        return {
            drawer: false,
            disable: false,
            carDetails: {}
        }
    },
    computed: {
        ...mapState([
            'car_owner'
        ])
    },
    methods: {
        ...mapActions([
            'setCarOwner',
            'setCarOwnerEmpty',
            'isEmpty',
            'setStudent',
            'setStudentEmpty',
            'isEmpty',
            'setBooking',
            'setBookingEmpty',
            'setCarBook',
            'setCarBookEmpty',
        ]),
        getCarOwner: async function() {
            try {
                const output = await axios.post('/api/getOwner.php',{
                    type: 'get'
                })
                return output.data
            } catch (error) {
                console.log(error);
            }
        },
        addCarOwner: function(carOwner) {
            this.setCarOwner(carOwner)
        },
        getBooking: async function(matric_no) {
            let formData = new FormData()
            formData.append('type', 'get_booking_owner')
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
                    this.setCarBookEmpty()
                    this.setStudentEmpty()
                } else {
                    //console.table(bookings);
                    let bookings = output
                    let match = false
                    
                    bookings.forEach(element => {
                        if (element.booking_status === 'ongoing') {
                            match = true
                            this.setBooking(element)
                            this.getStudent(element.std_matric)
                            bus.$emit('overcharge')
                        } 
                    });
                    
                    if (!match) {
                        this.setBookingEmpty()
                        this.setCarBookEmpty()
                        this.setStudentEmpty()
                    } 
                }
            } catch (error) {
                console.log(error);
            }
        },
        getStudent: async function(std_matric) {
            try {
                const output = await axios.post('/api/getStudent.php',{
                    type: 'getStudentData',
                    matric_no: std_matric,
                })
                this.setStudent(output.data)
            } catch (error) {
                console.log(error);
            }
        },
        logOut: async function() {
            try {
                const output = await axios.get('/api/logout.php')
            } catch (error) {
                console.log(error);
            }
            this.setCarOwnerEmpty()
            this.setBookingEmpty()
            this.setStudentEmpty()
            this.$router.push({ path: '/login/owner-login'})
        },
        updateOwner: async function() {
            let carOwner = await this.getCarOwner()
            this.addCarOwner(carOwner)
        },
        getCarDetails: async function(matric_no) {
            let matricNo = matric_no
            try {
                const output = await axios.get('/api/getCar.php',{
                    params: {
                        type: 'getCar',
                        matric_no: matricNo
                    }
                })
                this.carDetails = output.data
                if (this.carDetails) {
                    this.disable = true
                } else {
                    this.disable = false
                }
            } catch (error) {
                console.log(error);
            }
        },
    },
    async created() {
        if (this.isEmpty(this.car_owner)) {
            let carOwner = await this.getCarOwner()
            this.addCarOwner(carOwner)
            this.getBooking(carOwner.matric_no)
            this.getCarDetails(carOwner.matric_no)
            bus.$emit('get-recent', carOwner.matric_no)
            bus.$emit('create-graph', carOwner.matric_no)
        }
    },
    mounted() {
        bus.$on('book-complete', (matric_no) => {
            this.getBooking(matric_no)
        })
        bus.$on('update-profile', () => {
            this.updateOwner()
        })
    },

}
</script>

<style>

#main-background {
    background: #FFFFFF;
    height: 100%;
    padding-bottom: 10%
}
.rounded-card {
    border-radius: 9px;
}
</style>

