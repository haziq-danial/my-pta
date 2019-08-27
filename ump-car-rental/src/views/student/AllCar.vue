<template>
    <v-container grid-list-xl>
        <v-layout row wrap class="mb-5">
            <car-card v-for="(car,key) in allCar" :key="key" :car="car" />
        </v-layout>
    </v-container>
</template>

<script>
import CarCard from "../../components/student/CarCard.vue"
import axios from "axios"

export default {
    name: 'Allcar',
    components: {
        CarCard
    },
    data() {
        return {
            showCar: true,
            allCar: []
        }
    },
    methods: {
        getAllCar: async function () {
            try {
                const output = await axios.get('/api/getCar.php',{
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
    created() {
        this.getAllCar()
    }
}
</script>

<style>

</style>
