<template>
    <v-flex d-flex xs12 sm12 md6>
        <v-card 
        v-if="!customer"
        class="elevation-15 rounded-card" 
        >
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
        <v-card
        class="elevation-15 rounded-card"
        v-if="customer"
        >
            <v-layout row class="ml-3">
                <v-flex xs12>
                    <v-card-title primary-title>
                        <div>
                            <div class="display-1">Current Customer</div>
                        </div>
                    </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3 car-status-title">
                <v-flex xs8>
                    <v-card-title primary-title>
                    <div>
                        <div class="display-1">Name</div>
                    </div>
                </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3">
                <v-flex xs6>
                    <v-card-text class="headline font-weight-light">{{ student.firstname }} {{ student.lastname }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3 car-status-title">
                <v-flex xs8>
                    <v-card-title primary-title>
                    <div>
                        <div class="display-1">Duration</div>
                    </div>
                </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3">
                <v-flex xs6>
                    <v-card-text class="headline font-weight-light">{{ booking.duration }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3 car-status-title">
                <v-flex xs8>
                    <v-card-title primary-title>
                    <div>
                        <div class="display-1">Price</div>
                    </div>
                </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3">
                <v-flex xs6>
                    <v-card-text class="headline font-weight-light">RM {{ booking.price }}</v-card-text>
                </v-flex>
            </v-layout>
        </v-card>
    </v-flex>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'CustomerStatus',
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
    
}
</script>

<style scoped>
.car-status-title {
    height: 60px;
}
</style>
