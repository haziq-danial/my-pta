<template>
    <v-flex xs12 md6>
        <v-hover>
            <v-card 
            :ripple="{ class: 'red--text' }" 
            slot-scope="{ hover }" 
            min-height="370px" 
            max-height="570px" 
            color="white" 
            :class="`elevation-${hover ? 16 : 8} rounded-card mt-3`">
                <v-layout class="pl-3">
                    <v-flex xs5 class="pl-3">
                        <v-img
                            :src="img.path"
                            aspect-ratio="1"
                            contain
                        ></v-img>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">{{ car.car_name }}</div>
                                <v-layout align-start justify-start row wrap class="mt-2 ml-0">
                                    <img src="../../assets/car-icons/gearshift.svg">
                                    <div class="ml-2">{{ transmission }}</div>
                                   
                                    <img src="../../assets/car-icons/seat-car.svg">
                                    <div class="ml-2">{{ car.car_seat }}</div>
                                </v-layout>
                                <div>Owner: {{ car.owner_name }}</div>
                                <div class="mt-3">
                                    <v-rating 
                                    color="yellow darken-3" 
                                    background-color="greydarken-1"
                                    readonly
                                    :value='rating'
                                    half-increments
                                    size="30"
                                    ></v-rating>
                                </div>
                            </div>
                        </v-card-title>
                        <!-- <v-card-title>
                            <div>
                                <div class="ml-2">{{ car.owner_name }}</div>
                            </div>
                        </v-card-title> -->
                        <!-- <v-card-text>
                            <div>
                                <v-rating 
                                color="yellow darken-3" 
                                background-color="greydarken-1"
                                readonly
                                :value='rating'
                                half-increments
                                size="30"
                                ></v-rating>
                            </div>
                        </v-card-text> -->
                    </v-flex>
                </v-layout>
                
                <v-card-actions xs3 class="pb-4">
                    <v-card-text class="display-2 pl-4">RM {{ car.charge_rate }}/hour</v-card-text>
                    <v-spacer></v-spacer>
                    <v-btn 
                    v-if="car.car_status === 'not used'"
                    @click="carDetails" 
                    class="mr-4 title red darken-3 font-weight-regular font-italic" 
                    :ripple="false"
                    :disabled="disable"
                    :dark="!disable" 
                    large 
                    :flat="!disable"
                    >SELECT CAR</v-btn>

                    <v-btn 
                    v-if="car.car_status === 'in use'"
                    @click="booked = !booked" 
                    class="mr-4 title warning font-weight-regular font-italic"
                    :ripple="false"
                    :disabled="disable"
                    large 
                    :flat="!disable"
                    >CAR IN USE</v-btn>
                </v-card-actions>
            </v-card>
        </v-hover>
        <v-dialog v-model="booked" width="600">
            <v-card>
                <v-card-title class="red darken-4">
                    <div>
                        <div class="headline white--text" primary-title>Booking Details</div>
                    </div>
                </v-card-title>
                <!-- Booking Options & Status -->
                <v-layout row class="ml-1" style="height: 50px;">
                    <v-flex xs12 sm12 md12>
                        <v-card-title primary-title>
                            <div>
                                <div class="title">Time booking</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="ml-1" style="height: 70px;">
                    <v-flex xs12 sm12 md6>
                        <v-card-title primary-title>
                            <div>
                                <div class="subheading">From: {{ booking.start_time }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                    <v-flex xs12 sm12 md6>
                        <v-card-title primary-title>
                            <div>
                                <div class="subheading">To: {{ booking.end_time }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
            </v-card>
        </v-dialog>
    </v-flex>
</template>

<script>
import axios from "axios"
import { mapState } from 'vuex';
import { bus } from '../../main.js'
export default {
    name: 'CarCard',
    props: {
        car: Object
    },
    data() {
        return {
            img: {},
            booked: false,
            disable: false,
            isbooked: false,
            booking: {}
        }
    },
    computed: {
        ...mapState([
            'isBooking'
        ]),
        transmission() {
            let geartype = ''
            switch (this.car.transmission) {
                case 'Automatic':
                    geartype = 'AT'
                    break;
                case 'Manual':
                    geartype = 'MT'
                    break;
            }
            return geartype

        },
        rating() {
            return parseFloat(this.car.rating) || 0
        },
        
    },
    methods: {
        carDetails: function() {
            this.$router.push({ path: `/student/main-page/car-details/${this.car.matric_no}`})
        },
        carIsBooked: function(bookStatus) {
            this.isbooked = bookStatus
        },
        getCarHeader: async function() {
            let matricNo = this.car.matric_no
            try {
                const output = await axios.get('/api/getHeader.php',{
                    params: {
                        type: 'getImg',
                        matric_no: matricNo
                    }
                }).then((res) => {
                    this.img = res.data
                })
            } catch (error) {
                console.log(error);
            }
        },
        getBooking: async function() {
            let formData = new FormData()
            formData.append('type', 'get_booking_owner')
            formData.append('matric_no', this.car.matric_no)
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
                    console.log('empty');
                } else {
                    //console.table(bookings);
                    let bookings = output
                    let match = false
                    
                    bookings.forEach(element => {
                        if (element.booking_status === 'ongoing') {
                            match = true
                            this.booking = element
                        } 
                    });
                     
                }
            } catch (error) {
                console.log(error);
            }
        },
    },
    watch: {
        isbooked: function(newValue) {
            if (newValue === true) {
                this.disable = true
            }
        },
        booked: function(newValue) {
            if (newValue === true) {
                this.getBooking()
            }
            if (newValue === false) {
                this.booking = {}
            }
        }
    },
    mounted() {
        bus.$on('disable-booking', (bookStatus) => {
            this.carIsBooked(bookStatus)
        })
        this.carIsBooked(this.isBooking)
        this.getCarHeader()
    },
}
</script>

<style>

</style>
