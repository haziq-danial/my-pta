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
                :items="students"
                :search="search"
                disable-initial-sort
                >
                    <template v-slot:items="props">
                        <td>{{ props.item.std_name }}</td>
                        <td class="text-xs-center">{{ props.item.std_matric }}</td>
                        <td class="text-xs-center">{{ props.item.time_used }}</td>
                        <td :class="paidStatusClass(props.item.paid_status)">{{ props.item.paid_status }}</td>
                        <td :class="overchargeClass(props.item.overcharge)">{{ props.item.overcharge }}</td>
                        <td class="text-xs-center">{{ props.item.price }}</td>
                        <td :class="finalPriceClass(props.item.price, props.item.final_price)">{{ props.item.final_price }}</td>
                        <td>
                            <v-btn color="red darken-3" dark flat small @click.stop="reviewCust(props.item.booking_id,props.item.std_matric)">Review</v-btn>
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
                                <div class="display-1">Customer Profile</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Matric No:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ student_detail.matric_no }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Name:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ student_detail.firstname }} {{ student_detail.lastname }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Phone Number:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ student_detail.phone_no }}</v-card-text>
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
                        <v-card-text>{{ student_detail.license_type }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">License Expiry:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ student_detail.license_expired }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Natonality:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ student_detail.student_country }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-layout row class="profile-height">
                    <v-flex xs2>
                        <v-card-text class="subheading font-weight-bold">Nric/ID:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ student_detail.id_no }}</v-card-text>
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
                    <v-btn color="success" :disabled="paid" @click="setPaid()" large>Paid</v-btn>
                </div>   
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import Axios from 'axios';
import { mapState } from 'vuex';
import { bus } from "../../main.js";
export default {
    name: 'RecentCustomer',
    data() {
        return {
            headers: [
                { 
                    text: 'Student Name', 
                    align: 'left',
                    sortable: false,
                    value: 'std_name'
                },
                { text: 'Matric No', align: 'center', value: 'std_matric' },
                { text: 'Time of use', align: 'center', value: 'time_used' },
                { text: 'Paid Status', align: 'center', value: 'paid_status' },
                { text: 'Overcharge', align: 'center', value: 'overcharge' },
                { text: 'Initial Price(RM)', align: 'center', value: 'price' },
                { text: 'Final Price(RM)', align: 'center', value: 'final_price' },
                { text: 'Action', align: 'center', sortable: false }
            ],
            students: [],
            filterType: [
                { text: 'Collected' },
                { text: 'Paid' }
            ],
            student_detail: {},
            booking_detail: {},
            overcharge: {},
            over_section: false,
            review: false,
            filter: '',
            search: '',
            paid: true
        }
    },
    computed: {
        ...mapState([
            'car_owner'
        ]),
        age: function() {
            let dob = this.student_detail.date_of_birth || '0000-00-00'
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
            let text = 'text-xs-center'
            let weight = 'text--darken-2'
            let overcharge = false
            if (overcharge_status === 'true') {
                overcharge = 'green--text font-weight-bold'
            } else {
                overcharge = ''
            }
            return [text, overcharge, weight]
        },
        getRecentCust: async function(owner_matric) {
            try {
                const output = await Axios.get('/api/getCustomers.php',{
                    params: {
                        owner_matric: owner_matric
                    }
                }).then((res) => {
                    if (res.data === 'not found') {
                        return res.data
                    } else {
                        // console.log(res.data);
                        let bookings = res.data || []
                        // console.log(bookings);
                        let array = []

                        bookings.forEach(element => {
                            let obj = JSON.parse(element)
                            array.push(obj)
                        })


                        // for (const booking of bookings) {
                        //     let obj = JSON.parse(booking)
                        //     array.push(obj)
                        // }
                        return array
                    }
                })
                this.students = output
                if (this.students === 'not found') {
                    this.students = []
                }
                // console.table(this.students);
            } catch (error) {
                console.log(error);
            }
        },
        reviewCust: async function(booking_id,std_matric) {
            // console.table(booking_id,std_matric);
            this.overcharge = {}
            this.review = true
            let formData = new FormData()
            formData.append('booking_id', booking_id)
            formData.append('std_matric', std_matric)
            formData.append('type', 'booking')
            this.getCustomer(booking_id,std_matric)
            try {
                const output = await Axios.post('/api/recentDetails.php', formData)
                .then((res) => {
                    this.booking_detail = res.data
                })
            } catch (error) {
                console.log(error);
            }
        },
        getCustomer: async function(booking_id,std_matric) {
            // console.table(booking_id,std_matric);
            let formData = new FormData()
            formData.append('booking_id', booking_id)
            formData.append('std_matric', std_matric)
            formData.append('type', 'student')
            try {
                const output = await Axios.post('/api/recentDetails.php', formData)
                .then((res) => {
                    this.student_detail = res.data
                })
                if (this.student_detail.paid_status === 'Yes') {
                    this.paid = true
                } else {
                    this.paid = false
                }

                if (this.student_detail.overcharge === 'true') {
                    this.over_section = true
                    this.getOvercharge(booking_id)
                } else {
                    this.over_section = false
                    this.overcharge = {}
                }
                
            } catch (error) {
                console.log(error);
            }
        },
        getOvercharge: async function(booking_id) {
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
        },
        setPaid: async function() {
            this.paid = true
            bus.$emit('update-profit', this.booking_detail.final_price, this.car_owner.matric_no)
            try {
                const output = Axios.get('/api/payment.php',{
                    params: {
                        paid_status: 'Yes',
                        booking_id: this.booking_detail.id,
                        std_matric: this.booking_detail.std_matric
                    }
                })
                this.getRecentCust(this.car_owner.matric_no)
                this.review = false
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        bus.$on('get-recent', (owner_matric) => {
            this.getRecentCust(owner_matric)
        })
        this.getRecentCust(this.car_owner.matric_no)
    },
    watch: {
        review: function(newValue) {
            if (newValue === false) {
                this.student_detail = {}
                this.booking_detail = {}
                this.overcharge = {}
            }
        }
    },

}
</script>

<style scoped>

</style>
