<template>
    <v-container>
        <v-card class="elevation-2 pb-4" min-height="150">
            <v-tabs
            color="white"
            light
            centered
            grow
            slider-color="red"
            v-model="active"
            >
                <v-tab
                    v-for="tab in tabs"
                    :key="tab.title"
                    ripple
                >
                    {{ tab.title }}

                </v-tab>

                <v-tab-item>
                    <current-customer @nextTab="changeTab"/>
                </v-tab-item>

                <v-tab-item>
                    <recent-customer/>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </v-container>
</template>

<script>
import CurrentCustomer from "../../components/car-owner/CurrentCustomer.vue"
import RecentCustomer from "../../components/car-owner/RecentCustomer.vue"
import { bus } from '../../main.js';

export default {
    name: 'CustomerPage',
    components: {
        CurrentCustomer,
        RecentCustomer
    },
    data() {
        return {
            tabs: [
                { title:  'Current Customer' },
                { title:  'Recent Customer' }
            ],
            active: null,
            reload: 0
        }
    },
    methods: {
        changeTab: function() {
            this.active = 1
        },
        reloadComponent: function() {
            this.reload += 1
        }
    },
}
</script>

<style scoped>

</style>
