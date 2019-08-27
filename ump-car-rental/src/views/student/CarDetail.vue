<template>
    <v-container>
        <v-layout align-center justify-center>
            <v-card width="600" class="elevation-24 rounded-card">
                <v-layout row>
                    <v-btn fab flat light @click="goBack()">
                        <v-icon>arrow_back</v-icon>
                    </v-btn>
                    <v-card-text class="headline ml-0 pl-0 pt-3 mt-1">Back</v-card-text>
                </v-layout>
                <v-layout row>
                    <v-carousel height="300">
                        <v-carousel-item
                        v-for="(item,i) in items"
                        :key="i"
                        :src="item.src"
                        ></v-carousel-item>
                    </v-carousel>
                </v-layout>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">{{ car.car_name }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                    <v-spacer></v-spacer>
                    <v-flex xs6 class="pt-1">
                        <v-card-title>
                            <div>
                                <v-rating 
                                color="yellow darken-3" 
                                background-color="greydarken-1"
                                readonly
                                :value='rating'
                                size="30"
                                ></v-rating>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <!-- owner Details-->
                <v-divider></v-divider>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div xs6>
                                <div class="headline">Owner Details</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                 <v-layout row>
                    <v-flex xs6>
                        <v-card-text class="subheading">Name: {{ owner.firstname }} {{ owner.lastname }}</v-card-text>
                        <v-card-text class="subheading">Matric No: {{ owner.matric_no }}</v-card-text>
                        <v-card-text class="subheading">Contact Number: {{ owner.phone_no }}</v-card-text>
                    </v-flex>
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
                        <v-card-text class="subheading">Engine: {{ car.engine_litre }}L</v-card-text>
                        <v-card-text class="subheading">Transmission: {{ car.transmission }}</v-card-text>
                        <v-card-text class="subheading">Seat: {{ car.car_seat }}</v-card-text>
                        <v-card-text class="subheading">Plate no: {{ car.plate_no }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <!-- Booking Options & Status -->
                <v-layout row class="ml-1" style="height: 50px;">
                    <v-flex xs12 sm12 md12>
                        <v-card-title primary-title>
                            <div>
                                <div class="title">Choose time</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="ml-1" style="height: 70px;">
                    <v-flex xs12 sm4 md2>
                        <v-card-title primary-title>
                            <div>
                                <div class="subheading">From</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                    <v-flex xs8 sm8 md8>
                        <v-menu
                            ref="startTime"
                            v-model="menu2"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            :return-value.sync="startTime"
                            lazy
                            transition="scale-transition"
                            offset-y
                            full-width
                            max-width="290px"
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="startTime"
                                    label="Picker in menu"
                                    prepend-icon="access_time"
                                    readonly
                                    v-on="on"
                                    style="width: 190px"
                                    @click="clearTime('startTime')"
                                ></v-text-field>
                            </template>
                            <v-time-picker
                            v-if="menu2"
                            v-model="startTime"
                            full-width
                            color="red darken-4"
                            format="ampm"
                            >
                                <v-spacer></v-spacer>
                                <v-btn flat color="red darken-4" @click="menu2 = false">Cancel</v-btn>
                                <v-btn flat color="red darken-4" @click="saveTime('startTime')">OK</v-btn>
                            </v-time-picker>
                        </v-menu>
                    </v-flex>
                    <v-flex xs7 sm4 md2>
                        <v-card-title primary-title>
                            <div>
                                <div class="subheading">To</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                    <v-flex xs8 sm5 md8>
                        <v-menu
                            ref="endTime"
                            v-model="menu3"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            :return-value.sync="endTime"
                            lazy
                            transition="scale-transition"
                            offset-y
                            full-width
                            max-width="290px"
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="endTime"
                                    label="Picker in menu"
                                    prepend-icon="access_time"
                                    readonly
                                    v-on="on"
                                    style="width: 190px"
                                    @click="clearTime('endTime')"
                                ></v-text-field>
                            </template>
                            <v-time-picker
                            v-if="menu3"
                            v-model="endTime"
                            full-width
                            color="red darken-4"
                            format="ampm"
                            >
                                <v-spacer></v-spacer>
                                <v-btn flat color="red darken-4" @click="menu3 = false">Cancel</v-btn>
                                <v-btn flat color="red darken-4" @click="saveTime('endTime')">OK</v-btn>
                            </v-time-picker>
                        </v-menu>
                    </v-flex>
                    
                </v-layout>
                <v-layout row class="pb-3">
                    <v-spacer></v-spacer>
                    <v-flex>
                        <v-btn color="red darken-3" dark @click="clearTime('all')">Clear</v-btn>
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
                    <v-flex xs12 class="pl-3">
                        <v-radio-group v-model="delivery" row>
                            <v-radio color="red darken-3" label="Pick up" value="Pick up"></v-radio>
                            <v-radio color="red darken-3" label="Delivered" value="Delivered"></v-radio>
                        </v-radio-group>
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
                <v-layout row>
                    <v-card-text class="subheading">Charge rate: RM {{ car.charge_rate }}/hr</v-card-text>
                    <v-card-text class="subheading">Duration: {{ duration }}</v-card-text>
                    <v-card-text class="subheading">Total: RM{{ totalPrice }}</v-card-text>
                </v-layout>
                <v-spacer></v-spacer>
                <div class="text-xs-center mt-3 mb-4">
                    <v-btn color="red darken-3" large :disabled="error" dark @click="bookNow()">Book Now</v-btn>
                </div>
            </v-card>
            <v-dialog v-model="dialog" persistent max-width="590">
                <v-card>
                    <v-card-title class="display-1">Booking Process Completed</v-card-title>
                    <v-card-text class="headline">Your order will be displayed at "Upcoming car booking" page</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red darken-3" flat @click="dialog = false">Cancel</v-btn>
                        <v-btn color="red darken-3" flat @click="bookCar()">Okay</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="overBooking" persistent max-width="600px">
                <v-card>
                    <v-card-title class="headline">Booking Error</v-card-title>
                    <v-card-text>Time duration must not be over 20 hours</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red darken-3" flat @click="overBooking = false">Okay</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
    </v-container>
</template>

<script>
import axios from 'axios';
import { mapState } from "vuex";
import { bus } from "../../main.js";
export default {
    name: 'CarDetail',
    data() {
        return {
            car: {},
            owner: {},
            items: [],
            startTime: '',
            endTime: '',
            start24Time: '',
            end24Time: '',
            menu2: false,
            menu3: false,
            delivery: null,
            dialog: false,
            overBooking: false,
            error: false,
            totalPrice: '',
            duration: ''
        }
    },
    computed: {
        ...mapState([
            'student'
        ]),
        rating() {
            return parseInt(this.car.rating) || 0
        }
    },
    methods: {
        bookNow: function() {
            this.registerBooking()
            this.dialog = true
        },
        bookCar: function() {
            let matric_no = this.student.matric_no
            this.dialog = false
            this.$router.push({ path: '/student/main-page/bookings'})
            bus.$emit('book-car', matric_no)
            // window.location.reload()
        },
        changeTime: function(time, timeType) {
            if (timeType === 'startTime') {
                this.start24Time = time
            } else if (timeType === 'endTime') {
                this.end24Time = time
            } else {
                console.log('error');
            }
            // Check correct time format and split into components
            time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time]
            
            if (time.length > 1) { // If time format correct
                time = time.slice(1)  // Remove full string match value
                time[5] = +time[0] < 12 ? 'AM' : 'PM' // Set AM/PM
                time[0] = +time[0] % 12 || 12 // Adjust hours
            }
            return time.join('') // return adjusted time or original string
        },
        calculateDuration: function() {
            this.start24Time = this.start24Time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [this.start24Time]
            this.end24Time = this.end24Time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [this.end24Time]
            this.start24Time = this.start24Time.slice(1)
            this.end24Time = this.end24Time.slice(1)
            let startHour = parseInt(this.start24Time[0],10)
            let endHour = parseInt(this.end24Time[0],10)
            let startMinute = parseInt(this.start24Time[2],10)
            let endMinute = parseInt(this.end24Time[2],10)
            let hours = 0
            let minutes = 0

            let hrs = startHour
            let xduration = 0
            
            if (endMinute < startMinute) {
                endMinute = endMinute + 60
                endHour = endHour - 1
            }
            console.log(`endHour: ${endHour}`);

            while (hrs != endHour) {
                if (hrs === 24) {
                    hrs = 0
                    if (hrs === endHour) {
                        break
                    }
                }
                // console.log(hrs);
                hrs++
                xduration++
            }
            // hours = endHour - startHour
            minutes = endMinute - startMinute
            console.log(`${xduration} hrs and ${minutes} minutes`);
            this.duration = `${xduration} hrs and ${minutes} minutes`
            let chargeRate = parseFloat(this.car.charge_rate)
            let bookPrice = chargeRate * xduration
            this.totalPrice = bookPrice.toString()
        },
        saveTime: function(timeType) {
            if (timeType === 'startTime') {
                this.$refs.startTime.save(this.changeTime(this.startTime,'startTime'))
            } else if (timeType === 'endTime') {
                this.$refs.endTime.save( this.changeTime(this.endTime,'endTime'))
                this.calculateDuration()
            } else {
                console.log('error');
            }
        },
        clearTime: function(timeType) {
            if (timeType === 'startTime') {
                this.startTime = ''
                this.start24Time = ''
            }
            if (timeType === 'endTime') {
                this.endTime = ''
                this.end24Time = ''
            }
            if (timeType === 'all') {
                this.startTime = ''
                this.start24Time = ''
                this.endTime = ''
                this.end24Time = ''
            }
        },
        getCar: async function() {
            try {
                const output = await axios.get('/api/getCar.php',{
                    params: {
                        matric_no: this.$route.params.matric_no,
                        type: 'getCar'
                    }
                })
                this.car = output.data
            } catch (error) {
                console.log(error);
            }
        },
        getOwner: async function() {
            try {
                const output = await axios.post('/api/getOwner.php',{
                    type: 'getOwnerData',
                    matric_no: this.$route.params.matric_no,
                })
                this.owner = output.data
            } catch (error) {
                console.log(error);
            }
        },
        getImages: async function() {
            try {
                const output = await axios.get('/api/getCarImages.php',{
                    params: {
                        type: 'getImg',
                        matric_no: this.$route.params.matric_no
                    }
                }).then((res) => {

                    let images = res.data
                    let array = []

                    images.forEach(element => {
                        let obj = JSON.parse(element)
                        array.push(obj)
                    });
                    
                    return array;
                })
                this.items = output
            } catch (error) {
                console.log(error);
            }
        },
        registerBooking: async function() {
            let formData = this.appendData()
            try {
                const output = await axios.post('/api/booking.php',formData)
                this.owner = output.data
            } catch (error) {
                console.log(error);
            }
        },
        appendData: function() {
            let formData = new FormData()
            formData.append('type', 'enter_booking')
            formData.append('std_matric', this.student.matric_no)
            formData.append('owner_matric', this.owner.matric_no)
            formData.append('start_time', this.startTime)
            formData.append('end_time', this.endTime)
            formData.append('duration', this.duration)
            formData.append('delivery_options', this.delivery)
            formData.append('charge_rate', this.car.charge_rate)
            formData.append('price', this.totalPrice)
            formData.append('car_status', 'in use')
            return formData
        },
        goBack: function() {
            this.$router.go(-1)
        }
    },
    created() {
        Promise.all([this.getCar(),this.getOwner(),this.getImages()])
        window.scrollTo(0,0)
    }
}
</script>

<style>

</style>
