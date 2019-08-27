<template>
    <div>
        <v-card v-if="!book" flat>
            <v-container fluid>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1 text-xs-center">No Booking for today :(</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
        <v-card v-if="book" flat>
            <v-container fluid grid-list-md>
                <v-layout row>
                    <v-flex xs6>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">{{ car_book.car_name }}</div>
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
                <!-- Car spec -->
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
                        <v-card-text class="subheading">Name: {{ car_owner.firstname }} {{ car_owner.lastname }}</v-card-text>
                        <v-card-text class="subheading">Matric No: {{ car_owner.matric_no }}</v-card-text>
                        <v-card-text class="subheading">Contact Number: {{ car_owner.phone_no }}</v-card-text>
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
                        <v-card-text class="subheading">Engine: {{ car_book.engine_litre }}</v-card-text>
                        <v-card-text class="subheading">Transmission: {{ car_book.transmission }}</v-card-text>
                        <v-card-text class="subheading">Seat: {{ car_book.car_seat }}</v-card-text>
                        <v-card-text class="subheading">Plate no: {{ car_book.plate_no }}</v-card-text>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <!-- Booking Options & Status -->
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
                        <v-card-text class="subheading">{{ booking.delivery_options }}</v-card-text>
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
                    <v-card-text class="subheading">Charge rate: RM {{ car_book.charge_rate }}/hr</v-card-text>
                    <v-card-text class="subheading">Duration: {{ booking.duration }}</v-card-text>
                    <v-card-text class="subheading">Total: RM {{ booking.price }}</v-card-text>
                </v-layout>
                <v-spacer></v-spacer>
            </v-container>
            <div class="text-xs-center mt-3">
                <v-btn color="red darken-3" dark large @click="cancel = true">Cancel Booking</v-btn>
            </div>
            <v-dialog v-model="cancel" persistent max-width="590">
                <v-card>
                    <v-card-title class="display-1">Cancel Booking?</v-card-title>
                    <v-card-text class="headline">Your order will be canceled</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red darken-3" flat @click="cancel = false">Cancel</v-btn>
                        <v-btn color="red darken-3" flat @click="cancelBooking()">Okay</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Axios from 'axios';
import { bus } from "../../main.js";
export default {
    name: 'UpcomingBooking',
    data() {
        return {
           cancel: false
        }
    },
    computed: {
        ...mapGetters([
            'booking',
            'car_book',
            'car_owner',
            'isBooking'
        ]),
        rating() {
            return parseInt(this.car_book.rating) || 0
        },
        book() {
            return this.isBooking
        }
    },
    methods: {
        cancelBooking: async function() {
            let formData = new FormData()
            formData.append('std_matric', this.booking.std_matric)
            formData.append('owner_matric', this.booking.owner_matric)
            formData.append('id', this.booking.id)
            formData.append('type', 'student')
            formData.append('car_status', 'not used')
            try {
                const output = await Axios.post('/api/cancelBooking.php', formData)
                .then(() => {
                    this.$router.push({ path: '/student/main-page/bookings'})
                    bus.$emit('car-cancel', this.booking.std_matric)
                })
            } catch (error) {
                console.log(error);
            }
        }
    },
    
}
</script>

<style scoped>

</style>
