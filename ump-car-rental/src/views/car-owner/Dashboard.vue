<template>
    <v-container grid-list-xl>
        <display-profit/>
        <v-layout align-start justify-center row wrap>
            <car-status/>
            <customer-status/>
        </v-layout>
    </v-container>
</template>

<script>
import DisplayProfit from "../../components/car-owner/DisplayProfit.vue"
import CarStatus from "../../components/car-owner/CarStatus.vue"
import CustomerStatus from "../../components/car-owner/CustomerStatus.vue"
import { mapState } from 'vuex';
import { bus } from '../../main';


export default {
    name: 'Dashboard',
    components: {
        DisplayProfit,
        CarStatus,
        CustomerStatus
    },
    computed: {
        ...mapState([
            'car_owner'
        ])
    }
}
</script>

<style scoped>

</style>
