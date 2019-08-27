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
                    <student-profile @nextTab="changeTab"/>
                </v-tab-item>

                <v-tab-item>
                    <student-edit-profile/>
                </v-tab-item>

            </v-tabs>
        </v-card>
    </v-container>
</template>

<script>
import StudentProfile from "../../components/student/StudentProfile.vue"
import StudentEditProfile from "../../components/student/StudentEditProfile.vue"
export default {
    name: 'StudentPage',
    components: {
        StudentProfile,
        StudentEditProfile
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

<style>

</style>
