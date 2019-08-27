<template>
    <v-layout row class="mt-3 mb-5">
        <v-flex xs12 md12>
            <v-card
            class="elevation-15 rounded-card"
            min-height="300"
            >
                <v-layout row wrap>
                    <v-flex xs12 md8>
                        <v-card
                        max-width="calc(100% - 33px)"
                        min-height="200"
                        class="v-sheet--offset mx-auto"
                        color="#C62828"
                        flat
                        >
                            <v-card-text>
                                <div class="headline font-weight-thin white--text">Sales in this week</div>
                            </v-card-text>
                            <v-card-text>
                                <v-sheet
                                color="#D32F2F"
                                class="mx-auto"
                                >
                                <v-sparkline
                                    :labels="day"
                                    :value="value"
                                    color="white"
                                    line-width="2"
                                    padding="20"
                                    height="100"
                                    auto-draw
                                ></v-sparkline>
                                </v-sheet>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-spacer></v-spacer>
                    <v-flex xs12 md4>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">Current Profit</div>
                            </div>
                        </v-card-title>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">RM {{ profit }}</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
import Axios from 'axios';
import { bus } from '../../main';
import { mapState } from 'vuex';

export default {
    name: 'DisplayProfit',
    data() {
        return {
            day: [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'
            ],
            value: [],
            counter: 0,
            profit: ''
        }
    },
    computed: {
        ...mapState([
            'car_owner'
        ])
    },
    methods: {
        getMonth: function(d) {
            let month = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ]
            return month[d.getMonth()]
        },
        getDate: function(d) {
            let date = d.getDate()
            return date
        },
        getYear: function(d) {
            let year = d.getFullYear()
            return year
        },
        getBookDay: function(d) {
            let day = [
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday'
            ]
            return day[d.getDay()]
        },
        getDateToday: function(d) {
            //let d = new Date()
            let month = this.getMonth(d)
            let date = this.getDate(d)
            let year = this.getYear(d)
            // let day = this.getBookDay(d)
            // console.log(`${date}-${month}-${year}`);
            // console.log(d.getDay(`${date}-${month}-${year}`));
            let today = `${date}-${month}-${year}`
            return today
        },
        getYesterday: function(curr) {
            let currdate = new Date(curr)
            let yest = currdate.getDate() - 1
            currdate.setDate(yest)
            let month = this.getMonth(currdate)
            let date = this.getDate(currdate)
            let year = this.getYear(currdate)
            let newdate = `${date}-${month}-${year}`
            return newdate
        },
        getWeek: function() {
            let d = new Date()
            // let d = new Date('11-May-2019')
            let today = this.getDateToday(d)
            //let day = this.getBookDay(d)
            let dayNo = d.getDay()
            let week = []
            week[dayNo] = today
            while (dayNo > 0) {
                dayNo--
                let yest = this.getYesterday(d)
                week[dayNo] = yest
                d = new Date(yest)
            }
            // console.table(week);
            return week
        },
        getCustomers: async function(matric_no) {
            let week = this.getWeek()
            let data = []
            if (matric_no === '' || matric_no === undefined) {
                console.log('test');
            } else {
                let length = week.length
                for (let index = 0; index < length; index++) {
                    let date = week[index]
                    let result = this.getCustDb(matric_no, date)
                    .then((res) => {
                        let num = res.data
                        return num
                    })
                    let no = result.then((number) => {
                        this.value.push(number)
                        data.push(number)
                        // data[index] = number
                    })
                }
                // this.value = data
                // this.value = Array.from(number)
            }
            
        },
        getCustDb: function(matric_no, date) {
            let formData = new FormData()
            formData.append('matric_no', matric_no)
            formData.append('date', date)
            try {
                return Axios.post('/api/calcCustomers.php', formData)
            } catch (error) {
                console.log(error);
            }
        },
        getProfit: async function(matric_no) {
            let formData = new FormData()
            formData.append('matric_no', matric_no)
            try {
                const output = await Axios.post('/api/getProfit.php', formData)
                this.profit = output.data.profit
            } catch (error) {
                console.log(error);
            }
        },
        updateProfit: async function(price, matric_no) {
            let profit = parseFloat(this.profit)
            let total_price = parseFloat(price)
            let total_profit = total_price + profit
            let formData = new FormData()
            formData.append('matric_no', matric_no)
            formData.append('profit', total_profit)
            try {
                const output = await Axios.post('/api/updateProfit.php', formData)
                this.profit = output.data.profit
            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        // this.getDateToday()
        bus.$on('create-graph', (matric_no) => {
            this.getCustomers(matric_no)
            this.getProfit(matric_no)
        })
        bus.$on('update-profit', (finalPrice, matric_no) => {
            console.log(finalPrice);
            this.updateProfit(finalPrice, matric_no)
        })
        this.getCustomers(this.car_owner.matric_no)
    }
}
</script>

<style scoped>
.car-status-title {
    height: 60px;
}
.v-sheet--offset {
    top: 1px;
    position: relative;
  }
</style>
