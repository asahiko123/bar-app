<template>

    <v-dialog
        transition="dialog-bottom-transition"
        max-width="600"
        v-model="dialog">

        <template v-slot:activator="{ on, attrs }">

        <v-btn
            v-bind="attrs"
            v-on="on"
            @click="dialog = true"
            >
            <span>店名を選択する</span>
        </v-btn>

        </template>
        <template v-slot="dialog">
            <v-card>

                <!-- <v-card-actions>
                    <v-btn
                    outlined
                    rounded
                    text
                    @click="geoLocation"
                    >
                    現在地で検索
                    </v-btn>
                </v-card-actions> -->

                <v-text-field
                @change="onChange"
                v-model="address">
                </v-text-field>
                
                
                <div id="results"></div>

                <div id="map"></div>

                
                <v-card-actions class="justify-end">
                    
                    <v-btn
                    text
                    @click="closeDialog(dialog)">Close</v-btn>

                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>

    
</template>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDI3YFriHHFy59N8o-mItG7vn1LyVJT9go&libraries=places" async defer></script>

<script>
import * as VueGoogleMaps from "vue2-google-maps";

export default{

    name: "SelectModal",

    data(){
        return {
            address: "",
            lat: "",
            lng: "",
            dialog: false,
            placesList:[]
        }
    },

    mounted(){
        this.$gmapApiPromiseLazy().then(() => {
            this.geocoder = new google.maps.Geocoder()
        })
    },

    methods: {
        onChange(){
            this.placesList.splice(0)

            this.geocoder.geocode({
                'address': this.address
            },(results,status) => {
                if(status === google.maps.GeocoderStatus.OK){
                    // this.lat = results[0].geometry.location.lat()
                    // this.lng = results[0].geometry.location.lng()
                    // console.log(this.lat)
                    // console.log(this.lng)
                    this.mapSearch(results[0].geometry.location)
                }
            })
        },
        

        mapSearch(latLng){
            console.log('mapSearch')

            document.getElementById("results").innerHTML = "Now Loading..."
            let map = new google.maps.Map(document.getElementById("map"));
            console.log(map)
            let placeService = new google.maps.places.PlacesService(map)
            console.log(placeService)

            placeService.nearbySearch({
                
                location: latLng,
                radius: 500,
                type: ['bar'],
                keyword: this.address,
                language: 'ja',
            },
            this.displayBars);
        },
        displayBars(results,status,pagination){
            if(status == google.maps.places.PlacesServiceStatus.OK){
                this.placesList = this.placesList.concat(results)
                console.log(this.placesList)

                if(pagination.hasNextPage){
                    setTimeout(pagination.nextPage(),1000)
                }else{

                    let resultHTML = "<ol>"

                    for(let i = 0; i < this.placesList.length;i++){
                        let place = this.placesList[i]

                        let content = place.name

                        resultHTML += "<li>"
                        resultHTML += "<a>"
                        resultHTML += "<p>"
                        resultHTML += content
                        resultHTML += "</p>"
                        resultHTML += "</a>"
                        resultHTML += "</li>"
                    }

                    resultHTML += "</oi>"

                    document.getElementById("results").innerHTML = resultHTML
                }
            }
        },
        closeDialog(dialog){

            dialog.value = false
            

        },
    }


    // data(){

    //     return{
    //         preview: null,
    //         posted_image: null,
    //         post: null,
    //         errors: null,
    //         dialog: false,
    //         placesList:[],
    //         maplocation:{lat:0, lng:0},
    //         field: null,
    //         map:{},
    //         geocoder: {},
    //         address: ''

    //     }

    // },

    // computed:{
    //     google: VueGoogleMaps.gmapApi
    // },

    // methods: {


    //     getLocation(){
    //         console.log('処理開始')
    //         console.log(this.field)
    //         let geocoder = new google.maps.Geocoder()
    //         geocoder.geocode({
    //             address: this.field
    //         },nearBySearch)
    //     },

    //     nearBySearch(results,status){
    //         if(status == google.maps.GeocoderStatus.OK){
    //             mapSearch(results[0].geometry.location)
    //         }else{
    //             alert(this.field + "位置を取得できませんでした")
    //         }

    //     },

    //     geoLocation(){
    //         navigator.geolocation.getCurrentPosition(this.localPosition,this.getPositionError)
    //     },
    //     localPosition(position){
    //         let currentPosition = position.coords
    //         console.log(currentPosition)

    //         this.maplocation.lat = currentPosition.latitude
    //         this.maplocation.lng = currentPosition.longitude

    //     },
    //     getPositionError(error){
    //         console.warn(`ERROR(${error.code}): ${error.message}`)
    //     },

    //     mapSearch(latLng){
    //         console.log('mapSearch')

    //         document.getElementById("results").innerHTML = "Now Loading..."
    //         let map = new google.maps.Map(document.createElement("div"));
    //         let placeService = new google.maps.places.PlacesService(map)

    //         placeService.nearBySearch({
    //             location: latLng,
    //             radius: 500,
    //             type: ['bar'],
    //             keyword: this.field,
    //             language: 'ja',
    //         },this.displayBars);
    //     },

    //     displayBars(results,status,pagination){
    //         if(status === google.maps.places.placesServiceStatus.OK){
    //             this.placesList = this.placesList.concat(results)
    //             console.log(this.placesList)

    //             if(pagination.hasNextPage){
    //                 setTimeout(pagination.nextPage(),1000)
    //             }else{

    //                 let resultHTML = "<ol>"

    //                 for(let i = 0; i < this.placesList.length;i++){
    //                     let place = this.placesList[i]

    //                     let content = place.name

    //                     resultHTML += "<li>"
    //                     resultHTML += content
    //                     resultHTML += "</li>"
    //                 }

    //                 resultHTML += "</oi>"

    //                 document.getElementById("results").innerHTML = resultHTML
    //             }
    //         }
    //     },

    //     reset(){
    //         this.preview = '',
    //         this.post = null,
    //         document.querySelector('input[type="file"]').value = null
    //     },

    //     closeDialog(dialog){

    //         dialog.value = false
    //         this.reset()

    //     },


        
    // },

}
</script>
