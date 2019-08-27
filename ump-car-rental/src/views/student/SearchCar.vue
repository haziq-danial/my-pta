<template>
    <v-container grid-list-xl>
        <v-layout row>
            <v-flex xs12>
                <h1 class="text-md-center display-4">Search</h1>
            </v-flex>
        </v-layout>
        <v-layout row align-center column>
            <v-flex xs12>
                <v-text-field 
                outline
                light 
                height="10" 
                v-model="queryCar" 
                type="text" 
                class="textbox-search" 
                label="Search Car" 
                append-icon="search"
                clearable
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-spacer></v-spacer>
        <v-layout row wrap>
            <v-flex xs3>
                <v-select
                :items="filterType"
                v-model="filter"
                label="Sort By"
                ></v-select>
            </v-flex>
            <v-flex xs6 v-show="filterRating()">
                <v-radio-group v-model="sortFilter" row>
                    <v-radio color="red darken-3" label="Highest to lowest" value="high"></v-radio>
                    <v-radio color="red darken-3" label="Lowest To highest" value="low"></v-radio>
                </v-radio-group>
            </v-flex>
            <v-flex xs6 v-show="filterAvailable()">
                <v-radio-group v-model="available" row>
                    <v-radio color="red darken-3" label="Available" value="not used"></v-radio>
                    <v-radio color="red darken-3" label="Not Available" value="in use"></v-radio>
                </v-radio-group>
            </v-flex>
            <v-flex xs3 v-show="filter && !filterRating() && !filterAvailable()">
                <v-text-field 
                light 
                height="33" 
                v-model="query" 
                type="text" 
                label="Search Query" 
                append-icon="search"
                clearable
                ></v-text-field>
            </v-flex>
        </v-layout>
        <v-layout row wrap class="pb-5">
            <CarCard v-for="(car,key) in searchCar" :key="key" v-show="filterCar(car, searchCar)" :car="car" />
        </v-layout>
    </v-container>
</template>

<script>
import CarCard from "../../components/student/CarCard.vue";
import Axios from 'axios';

export default {
    name: 'SearchCar',
    components: {
        CarCard
    },
    data() {
        return {
            queryCar: '',
            query: '',
            filter: '',
            available: '',
            sortFilter: '',
            filterType: [
                { text: 'Disable Filter', value: '' },
                { text: 'Ratings', value: 'rating' },
                { text: 'Price', value: 'charge_rate' },
                { text: 'Availability', value: 'car_status' },
                { text: 'Owner name', value: 'owner_name' }
            ],
            allCar: [],
            prev: 0,
            prevNum: 0
        }
    },
    methods: {
        filterCar: function(car, carArray) {
            let visible = true
            if (this.filter) {

                if(this.filter === 'rating' || this.filter === 'charge_rate') {
                    visible = true
                } else if(this.filter === 'car_status') {
                    
                    let filter = car[this.filter]

                    visible = filter.includes(this.available)

                } else if(this.filter === 'owner_name') {

                    let query = String(this.query)
                    let filter = car[this.filter]

                    visible = filter.includes(query)

                } else {
                    visible = false
                }
            }
            return visible
        },
        filterAvailable: function() {
            return (this.filter === 'car_status')
        },
        filterRating: function() {
            return (this.filter === 'rating' || this.filter === 'charge_rate')
        },
        getAllCar: async function () {
            try {
                const output = await Axios.get('/api/getCar.php',{
                    params: {
                        type: 'allCar'
                    }
                }).then(function(res) {
                    
                    let cars = res.data
                    let array = []

                    cars.forEach(element => {
                        let obj = JSON.parse(element)
                        array.push(obj)
                    });
                    
                    return array;
                })
                this.allCar = output
            } catch (error) {
                console.log(error);
            }
        }
    },
    computed: {
        searchCar: function() {
            return this.allCar.filter((allCar) => {
                return allCar.car_name.match(this.queryCar)
            })
        },
    },
    watch: {
        query: function(newValue) {
            if (newValue === null) {
                this.query = ''
            }
        },
        queryCar: function(newValue) {
            if (newValue === null) {
                this.queryCar = ''
            }
        },
        sortFilter: function(newValue) {

            if (this.filter === 'rating') {
                if (newValue === 'high') {
                this.allCar.sort(function(b,a) {
                    // console.log(b.rating,a.rating);
                    let bValue = Number(b.rating)
                    let aValue = Number(a.rating)
                    let total = aValue - bValue
                    return total
                })
                //return this.allCar
                }
                if (newValue === 'low') {
                    this.allCar.sort(function(b,a) {
                        // console.log(b.rating,a.rating);
                        let bValue = Number(b.rating)
                        let aValue = Number(a.rating)
                        let total = bValue - aValue
                        return total
                    })
                }
            }

            if (this.filter === 'charge_rate') {

                if (newValue === 'high') {
                this.allCar.sort(function(b,a) {
                    // console.log(b.rating,a.rating);
                    let bValue = Number(b.charge_rate)
                    let aValue = Number(a.charge_rate)
                    let total = aValue - bValue
                    return total
                })
                //return this.allCar
                }
                if (newValue === 'low') {
                    this.allCar.sort(function(b,a) {
                        // console.log(b.rating,a.rating);
                        let bValue = Number(b.charge_rate)
                        let aValue = Number(a.charge_rate)
                        let total = bValue - aValue
                        return total
                    })
                }
            }
        },
        filter: function(newValue) {
            if (newValue === '') {
                this.sortFilter = ''
                this.available = ''
                this.getAllCar()
            }
        }
    },
    created() {
        this.getAllCar()
    },
}
</script>

<style>
.textbox-search {
    width: 500px;
}
</style>
