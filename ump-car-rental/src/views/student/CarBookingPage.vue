<template>
    <v-container>
        <v-card class="elevation-2 pb-4" min-height="150">
            <v-tabs
            color="white"
            light
            centered
            grow
            slider-color="red"
            >
                <v-tab
                v-for="tab in tabs"
                :key="tab.title"
                ripple
                >
                    {{ tab.title }}
                </v-tab>

                <v-tab-item>
                    <upcoming-booking/>
                </v-tab-item>

                <v-tab-item>
                    <v-container fluid grid-list-md>
                         <recent-booking/>
                    </v-container>
                </v-tab-item>

            </v-tabs>
        </v-card>
    </v-container>
</template>

<script>
import UpcomingBooking from "../../components/student/UpcomingBooking.vue"
import RecentBooking from "../../components/student/RecentBooking.vue"
import { mapState, mapActions } from 'vuex';
import axios from "axios"
import { bus } from "../../main.js";
export default {
    name: 'CarBookingPage',
    components: {
        UpcomingBooking,
        RecentBooking
    },
    data() {
        return {
            tabs: [
                { title: 'Upcoming Car Booking' },
                { title: 'Recent Bookings' }
            ]
        }
    },
    computed: {
        ...mapState([
            'isBooking'
        ])
    }
}
</script>

<style>

</style>
