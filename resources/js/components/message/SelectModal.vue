
<template>

    <v-dialog
        transition="dialog-bottom-transition"
        max-width="600"
        v-model="dialog"
        >

        <template v-slot:activator="{ on, attrs }">

        <v-btn
            v-bind="attrs"
            v-on="on"
            @click="openDialog"
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
                    @click="closeDialog(dialog)">Close{{getDialog}}</v-btn>

                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>

    
</template>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDI3YFriHHFy59N8o-mItG7vn1LyVJT9go&libraries=places" async defer></script>


<script>
import BarList from '../list/BarList.vue'
import Vue from 'vue'
import store from "../../store";
import { mapGetters } from 'vuex';

export default{

    name: "SelectModal",

    components:{
        BarList,
    },

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

    computed: {
        getDialog(){
            return this.dialog = this.$store.getters['data/getDialog']
        }
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

            const loading = document.createElement("p");
            loading.className = 'loading';
            loading.innerHTML = "Now Loading...";

            document.getElementById("results").appendChild(loading);
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

                    /* vueコンポーネントを縦並びにして店舗をリスト化する

                       vue.extend : vueの派生クラス（サブクラス）を生成
                       instance   : 1店舗分のコンポーネントを生成  
                       instance.$mount: 既存のhtmlとvueが生成するDOMを入れ替え
                       instance.$el : vueが作用する要素(HTMLタグ)
                    
                    */

                    for(let i = 0; i < this.placesList.length;i++){
                        let place = this.placesList[i]

                        let content = place.name

                        var ComponentClass = Vue.extend(BarList);
                        var instance = new ComponentClass({
                            propsData: {
                                barName: content
                            }
                        });

                        instance.$mount();
                        let loading = document.getElementsByClassName("loading");
                        loading[0].innerHTML = "";

                        document.getElementById("results").appendChild(instance.$el);

                    }

                }
            }
        },
        closeDialog(dialog){

            dialog.value = false
        
        },
        
        openDialog(dialog){
            store.commit('data/setDialog',true);
            dialog.value = this.$store.getters.getDialog;
        }

    },

}
</script>
