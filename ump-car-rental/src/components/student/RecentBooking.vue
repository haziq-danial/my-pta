<template>
    <div>
        <v-container fluid grid-list-md>
            <v-card flat>
                <v-card-title>
                    <v-flex xs12 md6>
                        <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                        ></v-text-field>
                    </v-flex>
                    <v-spacer></v-spacer>
                </v-card-title>
                <v-data-table
                :headers="headers"
                :items="bookings"
                :search="search"
                disable-initial-sort
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.owner_name }}</td>
                        <td class="text-xs-center">{{ props.item.owner_matric }}</td>
                        <td class="text-xs-center">{{ props.item.time_used }}</td>
                        <td :class="paidStatusClass(props.item.paid_status)">{{ props.item.paid_status }}</td>
                        <td :class="overchargeClass(props.item.overcharge)">{{ props.item.overcharge }}</td>
                        <td class="text-xs-center">{{ props.item.price }}</td>
                        <td :class="finalPriceClass(props.item.price, props.item.final_price)">{{ props.item.final_price }}</td>
                        <td>
                            <v-btn color="red darken-3" @click.stop="getBookingDetails(props.item.owner_matric,props.item.std_matric,props.item.booking_id, props.item.overcharge)" dark flat small>Booking</v-btn>
                        </td>
                        <td>
                            <v-btn color="success" @click.stop="getCarDetails(props.item.owner_matric, props.item.rating, props.item.booking_id)" small>Car</v-btn>
                        </td>
                    </template>
                </v-data-table>
            </v-card>
        </v-container>
        <!-- review -->
        <v-dialog v-model="review" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card class="pb-3">
                <v-toolbar dark color="red darken-3">
                    <v-btn icon dark @click="review = !review">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Booking Details</v-toolbar-title>
                </v-toolbar>
                <v-spacer></v-spacer>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">Owner Profile</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Matric No:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ owner_detail.matric_no }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Name:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ owner_detail.firstname }} {{ owner_detail.lastname }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Phone Number:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ owner_detail.phone_no }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Age:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ age }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">License Type:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ owner_detail.license_type }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">License Expiry:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ owner_detail.license_expired }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Natonality:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ owner_detail.student_country }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Nric/ID:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ owner_detail.id_no }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-spacer></v-spacer>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">Car Booking Details</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="ml-1" style="height: 50px;">
                    <v-flex xs12 sm12 md12>
                        <v-card-title primary-title>
                            <div>
                                <div class="title">Time Chosen</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="ml-1" style="height: 70px;">
                    <v-flex xs12 sm12 md2>
                        <v-card-title primary-title>
                            <div>
                                <div class="subheading">From: {{ booking_detail.start_time }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                    <v-flex xs12 sm12 md2>
                        <v-card-title primary-title>
                            <div>
                                <div class="subheading">To: {{ booking_detail.end_time }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <!-- Delivery Options -->
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline">Delivery Options</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-text class="subheading">{{ booking_detail.delivery_options }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline">Pricing</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="pl-1">
                    <v-card-text class="subheading">Charge rate: RM {{ booking_detail.charge_rate }}/hr</v-card-text>
                    <v-card-text class="subheading">Duration: {{ booking_detail.duration }}</v-card-text>
                    <v-card-text class="subheading">Total: RM {{ booking_detail.price }}</v-card-text>
                </v-layout>
                <v-spacer></v-spacer>
                <div v-show="over_section">
                    <v-divider></v-divider>
                    <v-layout row class="ml-1">
                        <v-flex xs6>
                            <v-card-title primary-title>
                                <div>
                                    <div class="headline">Overcharge</div>
                                </div>
                            </v-card-title>
                        </v-flex>
                    </v-layout>
                    <v-layout row wrap class="ml-1 pl-1">
                        <v-flex d-flex xs12 md4>
                            <v-card-text  class="subheading">Added : {{ overcharge.add_duration }} hr/s</v-card-text>
                        </v-flex>
                        <v-flex d-flex xs12 md4>
                            <v-card-text  class="subheading">Added Price : RM {{ overcharge.add_price }}</v-card-text>
                        </v-flex>
                        <v-flex d-flex xs12 md4>
                            <v-card-text  class="subheading">New Price : RM {{ overcharge.new_price }}</v-card-text>
                        </v-flex>
                        <v-flex d-flex xs12 md4>
                            <v-card-text  class="subheading">New End time : {{ overcharge.end_time }}</v-card-text>
                        </v-flex>
                    </v-layout>
                </div>
                <div class="text-xs-center mt-3 pb-5">
                    <!-- <v-btn color="red darken-3" :dark="dark" :disabled="disable" @click.stop="overDialog = !overDialog" large>Set Overcharge</v-btn> -->
                    <!-- <v-btn color="success" :disabled="paid" large>Paid</v-btn> -->
                </div>   
            </v-card>
        </v-dialog>
        <v-dialog v-model="carReview" width="600">
            <v-card>
                <v-card-title primary class="display-1">Review Car</v-card-title>
                <v-layout row>
                    <v-flex>
                        <v-img
                        :src="img.path"
                        contain
                        height="200"
                        ></v-img>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-card-title primary-title>
                        <div>
                            <div class="title">{{ car_detail.car_name }}</div>
                        </div>
                    </v-card-title>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div xs6>
                                <div class="headline">Car Specifications</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-text class="subheading">Engine: {{ car_detail.engine_litre }} L</v-card-text>
                        <v-card-text class="subheading">Transmission: {{ car_detail.transmission }}</v-card-text>
                        <v-card-text class="subheading">Seat: {{ car_detail.car_seat }}</v-card-text>
                        <v-card-text class="subheading">Pate no: {{ car_detail.plate_no }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div xs6>
                                <div class="headline">Rating Given</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title>
                            <v-rating 
                            color="yellow darken-3" 
                            background-color="greydarken-1"
                            v-model="finalRating"
                            :value='rating'
                            :readonly="rating_read"
                            clearable
                            size="30"
                            ></v-rating>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row align-center justify-center>
                    <div class="text-xs-center mt-3 mb-4">
                        <v-btn color="red darken-3" :disabled="btn_disabled" :dark="btn_dark" @click="submitRating()" large>Submit</v-btn>
                    </div>
                </v-layout>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import Axios from 'axios';
import { mapState } from 'vuex';
import { bus } from '../../main.js'
export default {
    name: 'RecentBooking',
    data() {
        return {
            headers: [
                { 
                    text: 'Owner Name', 
                    align: 'left',
                    sortable: false,
                    value: 'owner_name'
                },
                { text: 'Matric No', align: 'center', value: 'owner_matric' },
                { text: 'Time of use', align: 'center', value: 'time_used' },
                { text: 'Paid Status', align: 'center', value: 'paid_status' },
                { text: 'Overcharge', align: 'center', value: 'overcharge' },
                { text: 'Initial Price(RM)', align: 'center', value: 'price' },
                { text: 'Final Price(RM)', align: 'center', value: 'final_price' },
                { text: 'Review Booking', align: 'center', sortable: false },
                { text: 'Review Car', align: 'center', sortable: false }
            ],
            img: {},
            bookings: [],
            overcharge: {},
            booking_detail: {},
            owner_detail: {},
            car_detail: {},
            review: false,
            carReview: false,
            over_section: false,
            paid: false,
            btn_disabled: false,
            btn_dark: true,
            rating_read: false,
            filter: '',
            search: '',
            rating: 0,
            finalRating: 0,
            booking_id: 0,
            ownerMatric: ''
        }
    },
    computed: {
        ...mapState([
            'student'
        ]),
        age: function() {
            let dob = this.owner_detail.date_of_birth || '0000-00-00'
            let date = new Date()
            let year = date.getFullYear()
            let birthYear = Number(dob.match(/^(\d+)/)[1])
            // console.log(birthYear);
            // console.log(year);
            let age = year - birthYear
            return `${age} Years Old`
        }
    },
    methods: {
        paidStatusClass: function(paid_status) {
            let text = 'text-xs-center font-weight-bold'
            let weight = 'text--darken-2'
            let paid = false
            if (paid_status === 'No') {
                paid = 'red--text'
            } else {
                paid = 'green--text'
            }
            return [text, paid, weight]
        },
        overchargeClass: function(overcharge_status) {
            let text = 'text-xs-center font-weight-bold'
            let weight = 'text--darken-2'
            let overcharge = false
            if (overcharge_status === 'true') {
                overcharge = 'green--text'
            } else {
                overcharge = 'grey--text'
            }
            return [text, overcharge, weight]
        },
        finalPriceClass: function(price, final_price) {
            let text = 'text-xs-center'
            let weight = 'text--darken-4'
            let priceClass = ''

            let initialPrice = parseFloat(price)
            let finalPrice = parseFloat(final_price)

            if (finalPrice !== initialPrice) {
                priceClass = 'yellow--text font-weight-bold'
            }

            return [text, priceClass, weight]
        },
        setBtnDisabled: function() {
            this.btn_disabled = true
            this.btn_dark = false
            this.rating_read = true
        },
        setBtnEnabled: function() {
            this.btn_disabled = false
            this.btn_dark = true
            this.rating_read = false
        },
        submitRating: async function() {
            let formData = new FormData()

            formData.append('std_matric', this.student.matric_no)
            formData.append('owner_matric', this.ownerMatric)
            formData.append('rating', this.finalRating)
            formData.append('booking_id', this.booking_id)

            try {
                const output = await Axios.post('/api/ratingProcess.php', formData)
                this.carReview = false
                this.getBookings(this.student.matric_no)
            } catch (error) {
                console.log(error);
            }
        },
        getRatings: async function(owner_matric, booking_id) {

            try {
                const output = await Axios.get('/api/getRating.php', {
                    params: {
                        owner_matric: owner_matric,
                        booking_id: booking_id
                    }
                }).then((res) => {
                    this.rating = parseInt(res.data.rating)
                    this.finalRating = this.rating
                })
            } catch (error) {
                console.log(error);
            }
        },
        getCarDetails: async function(owner_matric, rating, booking_id) {
            this.carReview = !this.carReview
            this.finalRating = 0
            this.booking_id = booking_id
            this.ownerMatric = owner_matric
            this.setBtnEnabled()
            if (rating !== 'not given') {
                this.setBtnDisabled()
                this.getRatings(owner_matric, booking_id)
            } 

            try {
                const output = await Axios.get('/api/getCar.php',{
                    params: {
                        matric_no: owner_matric,
                        type: 'getCar'
                    }
                })
                this.car_detail = output.data
                this.getCarHeader(owner_matric)
            } catch (error) {
                console.log(error);
            }
        },
        getCarHeader: async function(matric_no) {
            let matricNo = matric_no
            try {
                const output = await Axios.get('/api/getHeader.php',{
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
        getBookings: async function(matric_no) {
            try {
                const output = await Axios.get('/api/recentBookings.php',{
                    params: {
                        matric_no: matric_no
                    }
                }).then((res) => {
                    if (res.data === 'not found') {
                        return res.data
                    } else {
                        // console.log(res.data);
                        let booking = res.data || []
                        let array = []
                        
                        booking.forEach(element => {
                            let obj = JSON.parse(element)
                            array.push(obj)
                        })
                        
                        return array
                    }
                })
                this.bookings = output
                if (this.bookings === 'not found') {
                    this.bookings = []
                }
            } catch (error) {
                console.log(error);
            }
        },
        getBookingDetails: async function(owner_matric,std_matric,booking_id,overcharge) {
            this.review  = true
            this.overcharge = {}
            this.over_section = false

            let formData = new FormData()
            formData.append('std_matric', std_matric)
            formData.append('booking_id', booking_id)
            formData.append('type', 'booking')

            this.getOwnerDetails(owner_matric)
            if (overcharge === 'true') {
                this.getOvercharge(booking_id)
            } 

            try {
                const output = await Axios.post('/api/recentDetails.php', formData)
                .then((res) => {
                    this.booking_detail = res.data
                })
            } catch (error) {
                console.log(error);
            }
        },
        getOwnerDetails: async function(owner_matric) {
            
            let formData = new FormData()
            formData.append('owner_matric', owner_matric)
            formData.append('type', 'owner')

            try {
                const output = await Axios.post('/api/recentDetails.php', formData)
                .then((res) => {
                    this.owner_detail = res.data
                })
            } catch (error) {
                console.log(error);
            }

        },
        getOvercharge: async function(booking_id) {

            this.over_section = true
            let formData = new FormData()
            formData.append('type', 'get')
            formData.append('booking_id', booking_id)

            try {
                const output = await Axios.post('/api/overcharge.php', formData)
                .then((res) => {
                    this.overcharge = res.data
                })
            } catch (error) {
                console.log(error);
            }

        }
    },
    watch: {
        review: function(newValue) {
            if (newValue === false) {
                this.over_section = false
            }
        },
        carReview: function(newValue) {
            if (newValue === false) {
                this.car_detail = {}
                this.img = {}
            }
        }
    },
    mounted() {
        bus.$on('recent-bookings', (matric_no) => {
            this.getBookings(matric_no)
        })
        this.getBookings(this.student.matric_no)
    },
}
</script>

<style scoped>

</style>
