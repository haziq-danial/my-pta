<template>
    <div>
        <v-card v-if="!customer" flat>
            <v-container fluid>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1 text-xs-center">No Customer for today :(</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
        <v-card v-if="customer" flat>
            <v-container fluid grid-list-md>
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
                        <v-card-text>{{ student.matric_no }} </v-card-text>
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
                        <v-card-text class="subheading font-weight-bold">ID/Nric:</v-card-text>
                    </v-flex>
                    <v-flex xs7>
                        <v-card-text>{{ student.id_no }}</v-card-text>
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
                    <v-flex xs12 sm12 md2>
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
                                <div class="subheading">From: {{ booking.start_time }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                    <v-flex xs12 sm12 md2>
                        <v-card-title primary-title>
                            <div>
                                <div class="subheading">To: {{ booking.end_time }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <!-- Delivery Options -->
                <v-layout row class="ml-1">
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline">Delivery Options</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="ml-1">
                    <v-flex xs12>
                        <v-card-text class="subheading">{{ booking.delivery_options }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <v-layout row class="ml-1">
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline">Pricing</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="ml-1 pl-1">
                    <v-flex d-flex xs12 md4>
                        <v-card-text class="subheading">Duration: {{ booking.duration }}</v-card-text>
                    </v-flex>
                    <v-flex d-flex xs12 md4>
                        <v-card-text class="subheading">Total: RM {{ booking.price }}</v-card-text>
                    </v-flex>
                </v-layout>
                <div v-show="overcharge">
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
                            <v-card-text  class="subheading">Added : {{ duration }} hr/s</v-card-text>
                        </v-flex>
                        <v-flex d-flex xs12 md4>
                            <v-card-text  class="subheading">Added Price : RM {{ overprice }}</v-card-text>
                        </v-flex>
                        <v-flex d-flex xs12 md4>
                            <v-card-text  class="subheading">New Price : RM {{ newPrice }}</v-card-text>
                        </v-flex>
                        <v-flex d-flex xs12 md4>
                            <v-card-text  class="subheading">New End time : {{ endTime }}</v-card-text>
                        </v-flex>
                    </v-layout>
                </div>
            </v-container>
            <v-spacer></v-spacer>
            <div class="text-xs-center mt-3">
                <!-- <v-btn color="red darken-3" :dark="dark" :disabled="disable" @click.stop="overDialog = !overDialog" large>Set Overcharge</v-btn> -->
                <v-btn color="warning" v-show="overcharge" dark @click.stop="overEarly = !overEarly" large>Collected Early</v-btn>
                <v-btn color="red darken-3" dark @click.stop="overDialog = !overDialog" large>Set Overcharge</v-btn>
                <v-btn color="success" @click.stop="collected1 = !collected1" large>Collected</v-btn>
            </div>
        </v-card>

        <!-- collect car -->
        <v-dialog v-model="collected1" persistent max-width="600px">
            <v-card class="pb-2">
                <v-card-title class="headline" primary-title>
                    <span>Confirm Car Collected?</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-card-text>
                                    <span class="title">Did the customer pay?</span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 class="pl-3">
                                <v-radio-group v-model="paid" row>
                                    <v-radio color="red darken-3" label="Yes" value="Yes"></v-radio>
                                    <v-radio color="red darken-3" label="No" value="No"></v-radio>
                                </v-radio-group>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-3" dark flat @click="collected1 = false">Cancel</v-btn>
                    <v-btn color="red darken-3" dark flat @click="carCollected">Proceed</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- Car Collected -->
        <v-dialog v-model="collected2" persistent max-width="600px">
            <v-card class="pb-2">
                <v-card-title class="headline" primary-title>
                    <span>Car Collected</span>
                </v-card-title>
                <v-card-text>
                    <span class="title">You can see the customer details in "Recent Customer"</span>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-3" dark flat @click="proceed()">Okay</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- overcharge -->
        <v-dialog v-model="overDialog" persistent max-width="700px">
            <v-card class="pb-2">
                <v-card-title class="headline red darken-3" primary-title>
                    <span class="white--text">Overcharge User</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12 sm6>
                                <v-card-text>
                                    <span class="title font-weight-light">Old End Time: {{ booking.end_time }}</span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-card-text>
                                    <span class="title font-weight-light">New End Time: {{ endTime }}</span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-time-picker readonly :allowed-minutes="allowedMinutes" :max="maxhours" :min="minhours" format="24hr" v-model="start_time"></v-time-picker>
                            </v-flex>
                            <v-flex xs12 sm4>
                                <v-time-picker :readonly="overcharge" :key="reload" :allowed-minutes="allowedMinutes" format="24hr" @change="overTime(end_time)" v-model="end_time"></v-time-picker>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-card-text>
                                    <span class="title font-weight-light">Duration: {{ duration }} hr/s</span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-card-text>
                                    <span class="title font-weight-light">Price added: <span class="title">RM {{ overprice }}</span></span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-card-text>
                                    <span class="title font-weight-light">New Price: <span class="title">RM {{ newPrice }}</span></span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-btn color="red darken-3" :disabled="overcharge" :dark="!overcharge" @click="clear = !clear">Clear</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="red darken-3" dark flat :disabled="!overcharge" @click="cancelOvercharge">Cancel Overcharge</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-3" dark flat @click="overDialog = false">Close</v-btn>
                    <v-btn color="red darken-3" :disabled="overcharge" :dark="!overcharge" flat @click="saveOvercharge">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- overcharge collect early -->
        <v-dialog v-model="overEarly" persistent max-width="700px">
            <v-card class="pb-2">
                <v-card-title class="headline warning" primary-title>
                    <span class="white--text">Car collected early</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12 sm6>
                                <v-card-text>
                                    <span class="title font-weight-light">Old End Time: {{ earlyStartTime }}</span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-card-text>
                                    <span class="title font-weight-light">New End Time: {{ earlyEndTime }}</span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-time-picker readonly :allowed-minutes="allowedMinutes" format="24hr" v-model="start_early"></v-time-picker>
                            </v-flex>
                            <v-flex xs12 sm4>
                                <v-time-picker :key="reloadEarly" :max="maxhours" :min="minhours" :allowed-minutes="allowedMinutes" @change="calcCollectEarly(end_early)" format="24hr" v-model="end_early"></v-time-picker>
                            </v-flex>
                            <v-flex xs12 sm7>
                                <v-card-text>
                                    <span class="title font-weight-light">Duration reduced: {{ duration }} hr/s</span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm4>
                                <v-radio-group v-model="cycle" row>
                                    <v-radio color="red darken-3" label="Night" value="night"></v-radio>
                                    <v-radio color="red darken-3" label="Day" value="day"></v-radio>
                                </v-radio-group>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-card-text>
                                    <span class="title font-weight-light">Price deduced: <span class="title">RM {{ overprice }}</span></span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm12>
                                <v-card-text>
                                    <span class="title font-weight-light">New Price: <span class="title">RM{{ newPrice }}</span></span>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-btn color="red darken-3" dark @click="clearEarly = !clearEarly">Clear</v-btn>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-3" dark flat @click="overEarly = false">Close</v-btn>
                    <v-btn color="red darken-3" dark flat @click="carCollectEarly">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { bus } from '../../main.js';
import Axios from 'axios';
export default {
    name: 'CurrentCustomer',
    data() {
        return {
            overcharge: false,
            overDialog: false,
            overEarly: false,
            collected1: false,
            collected2: false,
            dark: false,
            disable: true,
            cycle: '',
            duration: '',
            overprice: '',
            newPrice: '',
            endTime: '',
            earlyStartTime: '',
            earlyEndTime: '',
            paid: '',
            start_time: null,
            end_time: null,
            start_early: null,
            end_early: null,
            maxhours: '',
            minhours: '',
            isCust: false,
            clear: false,
            clearEarly: false,
            reload: 0,
            reloadEarly: 0,
        }
    },
    computed: {
        ...mapGetters([
            'booking',
            'student',
            'isBooking',
            'car_owner'
        ]),
        customer() {
            this.isCust = this.isBooking
            return this.isBooking
        }
    },
    methods: {
        timeCycle: function(time_cycle) {
            let starttime = this.start_time || '00:00'
            let endtime = this.start_early || '00:00'
            // let ampmStart = starttime.match(/(AM|PM)$/)[1]
            // let ampmEnd = endtime.match(/(AM|PM)$/)[1]
            let starthours = Number(starttime.toString().match(/^(\d+)/)[1]) || 0
            let endhours = Number(endtime.toString().match(/^(\d+)/)[1]) || 0
            
            if (time_cycle === 'night') {
                this.maxhours = ''
                this.minhours = `${starthours}:00`
            }
            if (time_cycle === 'day') {
                this.maxhours = `${endhours}:00`
                this.minhours = ''
            }
            // console.log(this.maxhours);
            // console.log(this.minhours);
        },
        overchargeTime: function() {
            let starttime = this.booking.start_time || '0:00PM'
            let endtime = this.booking.end_time || '0:00PM'
            let ampmStart = starttime.match(/(AM|PM)$/)[1]
            let ampmEnd = endtime.match(/(AM|PM)$/)[1]
            let starthours = 0
            let endhours = 0

            if (ampmStart === 'AM') {
                starthours = Number(starttime.match(/^(\d+)/)[1]) || 0
            }
            if (ampmEnd === 'AM') {
                endhours = Number(starttime.match(/^(\d+)/)[1]) || 0
            }
            if (ampmStart === 'AM' && ampmEnd === 'AM') {
                starthours = Number(starttime.match(/^(\d+)/)[1]) || 0
                endhours = Number(starttime.match(/^(\d+)/)[1]) || 0
            } else {

                starthours = 12 + Number(starttime.match(/^(\d+)/)[1]) || 0
                endhours = 12 + Number(endtime.match(/^(\d+)/)[1]) || 0

            }
            
            this.maxhours = `${endhours}:00`
            this.minhours = `${starthours}:00`
            this.start_time = this.maxhours
        },
        //update overcharge
        carCollectEarly: async function() {
            let formData = new FormData()
            formData.append('booking_id', this.booking.id)
            formData.append('overcharge', this.overcharge)
            formData.append('add_price', this.overprice)
            formData.append('add_duration', this.duration)
            formData.append('new_price', this.newPrice)
            formData.append('end_time', this.endTime)
            try {
                const output = await Axios.post('/api/updateOvercharge.php',formData)
                this.overEarly = false
            } catch (error) {
                console.log(error);
            }
        },
        calcCollectEarly: function(end) {

            let add_duration = 0
            let charge_rate = parseFloat(this.booking.charge_rate)
            let oldPrice = parseFloat(this.booking.price)
            let starttime = this.booking.end_time || '0:00PM'
            let ampmStart = starttime.match(/(AM|PM)$/)[1]
            if (ampmStart === 'AM') {
                starttime = Number(starttime.match(/^(\d+)/)[1]) || 0
            } else {
                starttime = 12 + Number(starttime.match(/^(\d+)/)[1]) || 0
            }
            let endtime = Number(end.match(/^(\d+)/)[1])
            let minutes = Number(this.booking.start_time.match(/:(\d+)/)[1])
            console.log('starttime: '+starttime);
            console.log('endtime: '+endtime);

            let hrs = starttime
            let xduration = 0
            while (hrs != endtime) {
                if (hrs === 24) {
                    hrs = 0
                    if (hrs === endtime) {
                        break
                    }
                }
                //console.log(hrs);
                hrs++
                xduration++
            }
            
            let addPrice = charge_rate * xduration
            let new_price = addPrice + oldPrice
            this.newPrice = `${new_price}`
            this.overprice = `${addPrice}`
            this.duration = `${xduration}`

            let strmin = ''
            let strhrs = ''
            if (minutes === 0) {
                strmin = '00'
            } else {
                strmin = `${minutes}`
            }
            if (hrs < 10) {
                strhrs = `0${hrs}`
            } else if (hrs === 0) {
                strhrs = '00'
            } else {
                strhrs = `${hrs}`
            }
            let time = `${strhrs}:${strmin}`

            time = time.match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [this.end_time]
            
            if (time.length > 1) { // If time format correct
                time = time.slice(1)  // Remove full string match value
                time[5] = +time[0] < 12 ? 'AM' : 'PM' // Set AM/PM
                time[0] = +time[0] % 12 || 12 // Adjust hours
            }
            time = time.join('')
            this.endTime = time
                        
        },
        collectEarly: function(time1) {
            let starttime = time1 || '0:00PM'
            let ampmStart = starttime.match(/(AM|PM)$/)[1]
            let starthours = 0

            if (ampmStart === 'AM') {
                starthours = Number(starttime.match(/^(\d+)/)[1]) || 0
            } else {

                starthours = 12 + Number(starttime.match(/^(\d+)/)[1]) || 0

            }
            
            this.start_early = `${starthours}:00`
            this.earlyStartTime = this.endTime
            this.earlyEndTime = ''
        },
        allowedMinutes: v => v === 0,
        overTime: function(end_time) {
            let hour = Number(end_time.match(/^(\d+)/)[1]) || 0
            this.calcOvercharge(this.start_time,end_time)
        },
        calcOvercharge: function(start_time,end_time) {
            let add_duration = 0
            let charge_rate = parseFloat(this.booking.charge_rate)
            let oldPrice = parseFloat(this.booking.price)

            let start = Number(start_time.match(/^(\d+)/)[1])
            let end = Number(end_time.match(/^(\d+)/)[1])
            let minutes = Number(this.booking.start_time.match(/:(\d+)/)[1])
            //console.log(minutes);

            let hrs = start
            let xduration = 0
            while (hrs != end) {
                if (hrs === 24) {
                    hrs = 0
                    if (hrs === end) {
                        break
                    }
                }
                //console.log(hrs);
                hrs++
                xduration++
            }
            
            let addPrice = charge_rate * xduration
            let new_price = addPrice + oldPrice
            this.newPrice = `${new_price}`
            this.overprice = `${addPrice}`
            this.duration = `${xduration}`

            let strmin = ''
            let strhrs = ''
            if (minutes === 0) {
                strmin = '00'
            } else {
                strmin = `${minutes}`
            }
            if (hrs < 10) {
                strhrs = `0${hrs}`
            } else if (hrs === 0) {
                strhrs = '00'
            } else {
                strhrs = `${hrs}`
            }
            let time = `${strhrs}:${strmin}`

            time = time.match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [this.end_time]
            
            if (time.length > 1) { // If time format correct
                time = time.slice(1)  // Remove full string match value
                time[5] = +time[0] < 12 ? 'AM' : 'PM' // Set AM/PM
                time[0] = +time[0] % 12 || 12 // Adjust hours
            }
            time = time.join('')
            this.endTime = time
        },
        saveOvercharge: function () {
            this.overDialog = false
            this.overcharge = true
            this.overchargeDB()
        },
        overchargeDB: async function() {
            let formData = new FormData()
            formData.append('booking_id', this.booking.id)
            formData.append('overcharge', this.overcharge)
            formData.append('add_price', this.overprice)
            formData.append('add_duration', this.duration)
            formData.append('new_price', this.newPrice)
            formData.append('end_time', this.endTime)
            formData.append('type', 'add')
            try {
                const output = await Axios.post('/api/overcharge.php', formData)
            } catch (error) {
                console.log(error);
            }
            this.getOvercharge()
        },
        cancelOvercharge: async function () {
            this.overDialog = false
            this.overcharge = false
            this.end_time = null
            this.duration = ''
            this.overprice = ''
            this.newPrice = ''
            let formData = new FormData()
            formData.append('type', 'delete')
            formData.append('booking_id', this.booking.id)
            try {
                const output = await Axios.post('/api/overcharge.php', formData)
            } catch (error) {
                console.log(error);
            }
            this.reload += 1
        },
        carCollected: function () {
            this.collected1 = false
            this.collected2 = true
        },
        proceed: function () {
            this.collected2 = false
            this.completeCar()
            this.$emit('nextTab')
        },
        getMonth: function(d) {
            let month = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ]
            return month[d.getMonth()]
        },
        getDate: function(d) {
            let date = d.getDate()
            return date
        },
        getYear: function(d) {
            let year = d.getFullYear()
            return year
        },
        getBookDay: function(d) {
            let day = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'
            ]
            return day[d.getDay()]
        },
        completeCar: async function() {
            let finalPrice = ''
            if (this.overcharge) {
                finalPrice = this.newPrice
            } else {
                finalPrice = this.booking.price
            }
            if (this.paid === 'Yes') {
                bus.$emit('update-profit', finalPrice, this.car_owner.matric_no)
            }
            let d = new Date()
            let month = this.getMonth(d)
            let date = this.getDate(d)
            let year = this.getYear(d)
            let day = this.getBookDay(d)

            let formData = new FormData()
            formData.append('booking_id', this.booking.id)
            formData.append('owner_name', `${this.car_owner.firstname} ${this.car_owner.lastname}`)
            formData.append('std_name', `${this.student.firstname} ${this.student.lastname}`)
            formData.append('std_matric', this.booking.std_matric)
            formData.append('owner_matric', this.booking.owner_matric)
            formData.append('time_used', `${this.booking.start_time}-${this.booking.end_time}`)
            formData.append('book_date', `${date}-${month}-${year}`)
            formData.append('book_day', `${day}`)
            formData.append('paid_status', this.paid)
            formData.append('overcharge', this.overcharge)
            formData.append('price', this.booking.price)
            formData.append('final_price', finalPrice)
            formData.append('booking_status', 'completed')
            formData.append('car_status', 'not used')
            try {
                const output = await Axios.post('/api/tripComplete.php', formData)
                .then(() => {
                    bus.$emit('book-complete', this.booking.owner_matric)
                    bus.$emit('get-recent', this.booking.owner_matric)
                })
            } catch (error) {
                console.log(error);
            }
        },
        getOvercharge: async function() {
            let formData = new FormData()
            formData.append('type', 'get')
            formData.append('booking_id', this.booking.id)
            try {
                const output = await Axios.post('/api/overcharge.php', formData)
                .then((res) => {
                    if (res.data === 'not found') {
                        this.overcharge = false
                    } else {
                        this.overcharge = true
                        this.duration = res.data.add_duration
                        this.overprice = res.data.add_price
                        this.newPrice = res.data.new_price
                        this.endTime = res.data.end_time
                    }
                })
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        bus.$on('overcharge', () => {
            this.getOvercharge()
        })
    },
    mounted() {
        this.getOvercharge()
    },
    watch: {
        isCust: function(newValue) {
            if (newValue === true) {
                this.overchargeTime()
            }
        },
        overDialog: function(newValue) {
            if (newValue === false && this.overcharge === false) {
                this.end_time = null
                this.overprice = ''
                this.newPrice = ''
                this.duration = ''
                this.endTime = ''
                this.reload += 1
            }
            if (newValue === true) {
                this.overchargeTime()
            }
        },
        overEarly: function(newValue) {
            if (newValue === true) {
                this.collectEarly(this.endTime)
                // this.maxhours = this.endTime
            }
            if (newValue === false) {
                this.getOvercharge()
                this.reloadEarly += 1
                this.end_early = null
            }

        },
        clear: function(newValue) {
            if (newValue === true) {
                this.end_time = null
                this.overprice = ''
                this.newPrice = ''
                this.duration = ''
                this.endTime = ''
                this.clear = !this.clear
                this.reload += 1
            }
        },
        clearEarly: function(newValue) {
            if (newValue === true) {
                this.end_early = null
                this.clearEarly = !this.clearEarly
                this.reloadEarly += 1
            }
        },
        cycle: function(newValue) {
            this.timeCycle(newValue)
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
