<template>
    <v-flex d-flex xs12 sm12 md6>
        <v-card
        class="elevation-15 rounded-card pb-5"
        >
            <v-layout row class="ml-3">
                <v-flex xs8>
                    <v-card-title primary-title>
                        <div>
                            <div class="display-1">Car Status</div>
                        </div>
                    </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-2">
                <v-flex xs12 class="pr-4">
                    <v-img
                        :src='img.path'
                        height="225px"
                        contain
                    >
                        
                    </v-img>
                    <!-- <img :src="image"> -->
                    <!-- <img src='../../../public/static/car-img/car-headers/proton-waja.png'> -->
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3 car-status-title">
                <v-flex xs8>
                    <v-card-title primary-title>
                    <div>
                        <div class="display-1">Car Name</div>
                    </div>
                </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3">
                <v-flex xs6>
                    <v-card-text class="headline font-weight-light">{{ carDetails.car_name }}</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3 car-status-title">
                <v-flex xs8>
                    <v-card-title primary-title>
                    <div>
                        <div class="display-1">Charge Rate</div>
                    </div>
                </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3">
                <v-flex xs6>
                    <v-card-text class="headline font-weight-light">RM {{ carDetails.charge_rate }}/hr</v-card-text>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3 car-status-title">
                <v-flex xs12>
                    <v-card-title primary-title>
                    <div>
                        <div class="display-1">Current Rating</div>
                    </div>
                </v-card-title>
                </v-flex>
            </v-layout>
            <v-layout row class="ml-3">
                <v-flex xs8>
                    <div class="pl-2">
                        <v-rating 
                        color="yellow darken-3" 
                        background-color="greydarken-1"
                        readonly
                        :value='rating'
                        half-increments
                        size="25"
                        ></v-rating>
                    </div>
                </v-flex>
            </v-layout>
        </v-card>
    </v-flex>
</template>

<script>
import axios from "axios"
import { mapState } from "vuex"
export default {
    name: 'CarStatus',
    data() {
        return {
            carDetails: {},
            path: '../../../public/static/car-img/car-headers/proton-waja.png',
            img2: {
                path: require('../../../public/static/car-img/car-headers/proton-waja.png')
            },
            img: {}
        }
    },
    computed: {
        ...mapState([
            'car_owner'
        ]),
        rating() {
            return parseFloat(this.carDetails.rating, 10) || 0
        }
    },
    methods: {
        getCarDetails: async function() {
            let matricNo = this.car_owner.matric_no
            try {
                const output = await axios.get('/api/getCar.php',{
                    params: {
                        type: 'getCar',
                        matric_no: matricNo
                    }
                })
                this.carDetails = output.data
            } catch (error) {
                console.log(error);
            }
        },
        getCarHeader: async function() {
            let matricNo = this.car_owner.matric_no
            try {
                const output = await axios.get('/api/getHeader.php',{
                    params: {
                        type: 'getImg',
                        matric_no: matricNo
                    }
                }).then((res) => {
                    this.img = res.data
                })
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        setTimeout(() => {
            Promise.all([this.getCarDetails(),this.getCarHeader()])
            // this.getCarDetails()
        }, 0)
    },
}
</script>

<style scoped>
.car-status-title {
    height: 60px;
}
</style>
