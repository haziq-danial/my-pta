<template>
    <div>
        <v-layout row>
            <v-card class="mt-3 mb-3" width="1050" flat>
                <v-flex xs12>
                    <v-layout>
                        <v-flex xs3>
                            <v-img
                                src="https://cdn.vuetifyjs.com/images/cards/foster.jpg"
                                height="140px"
                                width="180px"
                                contain
                            ></v-img>
                        </v-flex>
                        <v-flex xs4>
                            <v-card-text class="display-1">Proton Saga</v-card-text>
                            <v-card-text class="headline">1.20 pm-5.20 pm</v-card-text>
                        </v-flex>
                        <v-flex xs3>
                            <div class="pt-2">
                                <v-card-text class="title font-weight-regular text-sm-left pl-2">Rating</v-card-text>
                                <div>
                                    <v-rating 
                                    color="yellow darken-3" 
                                    background-color="greydarken-1"
                                    readonly
                                    :value='4'
                                    size="20"
                                    ></v-rating>
                                </div>
                            </div>
                        </v-flex>
                        <v-flex xs2>
                            <v-card-actions>
                                <div class="pt-4">
                                    <v-btn color="red darken-3" dark large>Review</v-btn>
                                </div>
                            </v-card-actions>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-card>
        </v-layout>
        <v-divider></v-divider>
    </div>
</template>

<script>
export default {
    name: 'RecentBookingCard'
}
</script>

<style>

</style>
