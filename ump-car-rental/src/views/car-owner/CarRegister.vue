<template>
    <v-container>
        <v-card class="elevation-15 pb-4" min-height="150">
            <v-container fluid grid-list-md>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">Register Car</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Car Name:</v-card-text>
                    </v-flex>
                    <v-flex xs3 sm3 md4>
                        <v-text-field
                        label="name of car"
                        v-model="carName"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Plate number:</v-card-text>
                    </v-flex>
                    <v-flex xs3 sm3 md4>
                        <v-text-field
                        label="plate no of car"
                        v-model="plateNo"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <!-- <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Matric no of owner:</v-card-text>
                    </v-flex>
                    <v-flex xs3 sm3 md4>
                        <v-text-field
                        label="enter Matric No"
                        v-model="matricNo"
                        ></v-text-field>
                    </v-flex>
                </v-layout> -->
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">Car Specifications</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline">Car Images</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Image Header:</v-card-text>
                        <v-flex xs3 sm3 md4>
                            <v-btn color="red darken-3" @click="addFiles('imgHeader')" dark>Add Files</v-btn>
                        </v-flex>
                        <v-flex xs3 sm3 md2>
                            <input 
                            type="file" 
                            ref="imgHeader" 
                            accept="image/jpeg,image/png" 
                            id="imageHeader"
                            @change="handleFilesUpload('imgHeader')"
                            >
                        </v-flex>
                    </v-flex>
                    
                    <v-flex xs3 sm3 md3 d-flex v-if="headerChosen">
                        <v-img :src="headerImg" :lazy-src="headerImg" height="120" width="120"></v-img>
                        <span><v-btn color="red darken-3" dark small fab @click="removeImg('imgHeader',0)"><v-icon>close</v-icon></v-btn></span>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Car Images:(only 3 images allowed)</v-card-text>
                        <v-flex xs3 sm3 md4>
                            <v-btn color="red darken-3" @click="addFiles('carImages')" dark>Add Files</v-btn>
                        </v-flex>
                        <v-flex xs3 sm3 md2>
                            <input 
                            type="file" 
                            ref="carImages" 
                            accept="image/jpeg,image/png" 
                            id="imageHeader"
                            multiple
                            @change="handleFilesUpload('carImages')"
                            >
                        </v-flex>
                    </v-flex>
                    <v-flex v-for="(img,key) in imgUrl" :key="key" xs3 sm3 md3 d-flex>
                        <v-img :src="img" :lazy-src="img" height="120" width="120"></v-img>
                        <span><v-btn color="red darken-3" dark small fab @click="removeImg('carImages',key)"><v-icon>close</v-icon></v-btn></span>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="headline">Engine</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Litre:</v-card-text>
                    </v-flex>
                    <v-flex xs3 sm3 md4>
                        <v-text-field
                        label="enter engine litre"
                        v-model="engineLitre"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Transmission:</v-card-text>
                    </v-flex>
                    <v-flex xs3 sm3 md4>
                        <v-select
                        :items="['Automatic', 'Manual']"
                        label="Enter engine transmission"
                        v-model="transmission"></v-select>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="title font-weight-light">Car seat:</v-card-text>
                    </v-flex>
                    <v-flex xs3 sm3 md4>
                        <v-text-field
                        label="enter no of car seats"
                        v-model="carSeat"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout row>
                    <v-flex xs12>
                        <v-card-title primary-title>
                            <div>
                                <div class="display-1">Charge Rate</div>
                            </div>
                        </v-card-title>
                    </v-flex>
                </v-layout>
                <v-layout row class="ml-1 pr-2">
                    <v-flex xs3 sm3 md2>
                        <v-card-text class="headline">RM</v-card-text>
                    </v-flex>
                    <v-flex d-flex xs3 sm3 md4>
                        <v-text-field
                        label="enter price per hour"
                        v-model="chargeRate"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs3 sm3 md3>
                        <v-card-text class="headline">/hr</v-card-text>
                    </v-flex>
                </v-layout>
                <v-spacer></v-spacer>
                <div class="text-xs-center mt-2 mb-3">
                    <v-btn color="red darken-3" dark large @click="submitCar">Save</v-btn>
                </div>
            </v-container>
        </v-card>
        <v-dialog v-model="saved" persistent max-width="600px">
            <v-card class="pb-2">
                <v-card-title class="headline" primary-title>
                    <span>Car has been successfully saved</span>
                </v-card-title>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red darken-3" dark flat @click="savedCar">Proceed</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
import axios from "axios"
import { mapState } from "vuex";

export default {
    name: 'CarRegister',
    data() {
        return {
            saved: false,
            carName: '',
            plateNo: '',
            matricNo: '',
            engineLitre: '',
            transmission: '',
            carSeat: '',
            chargeRate: '',
            headerImg: '',
            headerUpload: '',
            headerChosen: false,
            imgUrl: [],
            imgUpload: []
        }
    },
    computed: {
        ...mapState([
            'car_owner'
        ])
    },
    methods: {
        savedCar: function () {
            this.saved = false
            this.$router.push({ path: '/car-owner/main-page/dashboard'})
        },
        addFiles: function(fileType) {
            if (fileType === 'imgHeader') {
                this.$refs.imgHeader.click()
            } else if (fileType === 'carImages') {
                this.$refs.carImages.click()
            } else {
                console.log('error')
            }
         },
         handleFilesUpload: function(uploadType) {
             if (uploadType === 'imgHeader') {
                 let selectImg = this.$refs.imgHeader.files[0]
                 this.headerUpload = selectImg
                 this.headerImg = window.URL.createObjectURL(selectImg)
                 this.headerChosen = true
             } else if (uploadType === 'carImages') {
                 let selectImg = this.$refs.carImages.files
               
                for (let index = 0; index < selectImg.length; index++) {
                    this.imgUrl.push(window.URL.createObjectURL(selectImg[index]))
                    this.imgUpload.push(selectImg[index])
                }
                if (this.imgUrl.length > 3) {
                    for (let index = this.imgUrl.length; index > 3; index--) {
                        this.imgUrl.splice(0,1)
                        this.imgUpload.splice(0,1)
                    }
                }
             } else {
                 console.log('error')
             }
         },
         removeImg: function(deleteType,key) {
             if (deleteType === 'imgHeader') {
                this.headerImg = ''
                this.headerUpload = ''
                this.headerChosen = false                 
             } else if (deleteType === 'carImages') {
                 this.imgUrl.splice(key,1)
                this.imgUpload.splice(key,1)
             } else {
                 console.log('error')
             }
         },
         uploadImageHeader: async function() {
             let formData = new FormData()
             formData.append('img_header', this.headerUpload)
             formData.append('matric_no', this.car_owner.matric_no.toUpperCase())
             try {
                 axios.post('/api/uploadHeader.php', 
                 formData,
                 {
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded'
                     }
                 }).then(function() {
                     console.log('success')
                 })
             } catch (error) {
                 console.log('error');
             }
         },
         uploadCarImages: async function() {
             let formData = new FormData()
             formData.append('matric_no', this.car_owner.matric_no.toUpperCase())
             for (let index = 0; index < this.imgUpload.length; index++) {
                 formData.append('car_images['+ index +']', this.imgUpload[index])
             }
             try {
                 axios.post('/api/uploadCarImages.php',
                 formData,
                 {
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded'
                     }
                 }).then(function() {
                     console.log('success');
                 })
             } catch (error) {
                 console.log('error');
             }
         },
         registerCar: async function() {
             let formData = new FormData()
             formData.append('owner_name', `${this.car_owner.firstname} ${this.car_owner.lastname}`)
             formData.append('car_name', this.carName)
             formData.append('plate_no', this.plateNo.toUpperCase())
             formData.append('matric_no', this.car_owner.matric_no)
             formData.append('engine_litre', this.engineLitre)
             formData.append('transmission', this.transmission)
             formData.append('car_seat', this.carSeat)
             formData.append('charge_rate', this.chargeRate)
             try {
                 axios.post('/api/registerCar.php', formData)
             } catch (error) {
                 console.log(error)
             }
         },
         submitCar: async function() {
             Promise.all([this.registerCar(),this.uploadImageHeader(),this.uploadCarImages()])
             this.saved = !this.saved
            //  Promise.all([this.uploadImageHeader(),this.uploadCarImages()])
         }
    }
}
</script>

<style scoped>
input[type="file"] {
  position: absolute;
  top: -500px;
}
</style>
