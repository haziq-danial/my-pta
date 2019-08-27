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
                    <car-owner-profile @nextTab="changeTab"/>
                </v-tab-item>
                <v-tab-item>
                    <owner-edit-profile/>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </v-container>
</template>

<script>
import CarOwnerProfile from "../../components/car-owner/CarOwnerProfile.vue"
import OwnerEditProfile from "../../components/car-owner/OwnerEditProfile.vue"
export default {
    name: 'CarOwnerPage',
    components: {
        CarOwnerProfile,
        OwnerEditProfile
    },
    data () {
      return {
            tabs: [
                { title: 'Profile' },
                { title: 'Edit Profile' }
            ],
            active: null,
      }
    },
    methods: {
        changeTab: function() {
            this.active = 1
        },
    },

}
</script>

<style scoped>

</style>
