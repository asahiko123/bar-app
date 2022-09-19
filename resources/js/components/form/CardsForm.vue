
<template>
    <v-main>
        <v-container fluid class="d-flex justify-center">
            <v-col class="d-flex flex-column col-md-5">
                
                    <v-card
                    outlined
                    class="d-flex justify-center">

                        <v-form
                        ref="form"
                        class="d-flex flex-column"
                        @submit.prevent = "submit">


                        <v-card-title
                        class="d-flex justify-center">
                        お酒を記録する
                        </v-card-title>

                        <v-row
                        id ="output"></v-row>

                        <v-text-field
                        v-model="form.menu"
                        :rules="menuRules"
                        label="メニュー"
                        required>
                
                        </v-text-field>
                        <v-text-field
                        v-model="form.price"
                        :rules="priceRules"
                        label="価格"
                        required>
                        </v-text-field>

                        <v-card>
                            <v-card-actions>
                                {{ barName }}
                            </v-card-actions>
                        </v-card>

                        <SelectModal></SelectModal>

                        <v-text-field
                        v-model="form.comment"
                        :rules="commentRules"
                        label="コメント"
                        required>
                        </v-text-field>

                        <v-row>
                            <v-col>
                                <v-subheader>飲みやすさ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="form.rating.easyToDrink" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>甘さ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="form.rating.sweet" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>辛さ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="form.rating.dry" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>爽やかさ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="form.rating.fresh" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>フルーティーさ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="form.rating.fruity" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>キレのよさ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="form.rating.sharp" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>芳醇さ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="form.rating.mellow" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>

                        <v-btn type="submit" color="rgb(106, 118, 171)" class="float-right">投稿する</v-btn>

                        </v-form>
                        <PostModal @catchPreviewImage="displayPreviewImage"></PostModal>

                    </v-card>
            </v-col>
        </v-container>
    </v-main>
</template>
<script>
import PostModal from '../message/PostModal.vue'
import SelectModal from '../message/SelectModal.vue'
import StarRating from 'vue-star-rating'
// import { INTERNAL_SERVER_ERROR, UNPROCESSABLE_ENTITY } from '../../util'
import axios from 'axios'


export default{

    name: "cardsForm",

    data() {
        return {

            dialog: false,

            form: {
                posted_image: null,
                menu: null,
                price: null,
                bar: null,
                comment: null,

                rating: {
                    easyToDrink: 0,
                    sweet: 0,
                    dry:0 ,
                    fresh:0 ,
                    fruity: 0,
                    sharp: 0,
                    mellow: 0,
                },
            },
            menuRules: [
                val => !!val || "メニューを入力してください",
                val => (val && val.length <= 20) || "20文字以内で入力して下さい"
            ],
            priceRules: [
                val => !!val || "価格を入力してください",
                val => (val && val.length <= 5) || "5文字以内で入力してください"
            ],
            commentRules: [
                val => !!val || "コメントを入力してください",
                val => (val && val.length <= 200) || "200文字以内で入力してください"
            ]
        };
    },

    computed:{

        barName(){
            this.formBarName();
            return this.$store.state.data.barName;
        }
    },


    methods: {
        displayPreviewImage(posted_image){

            this.form.posted_image = posted_image

            const output = document.createElement('output')
            const img = document.createElement('img')
            const app = document.getElementById('output')

            const reader = new FileReader()
            reader.addEventListener("load",function(){
                img.src = reader.result
            },false)
            reader.readAsDataURL(posted_image)

            output.appendChild(img)
            img.setAttribute('width','300')
            img.setAttribute('height','200')
            app.appendChild(output)
        },

        async submit(){

            const formData = new FormData()
            formData.append('posted_image',this.form.posted_image)
            formData.append('menu',this.form.menu)
            formData.append('price',this.form.price)
            formData.append('bar',this.form.bar)
            formData.append('comment',this.form.comment)
            formData.append('easyToDrink',this.form.rating.easyToDrink)
            formData.append('sweet',this.form.rating.sweet)
            formData.append('dry',this.form.rating.dry)
            formData.append('fresh',this.form.rating.fresh)
            formData.append('sharp',this.form.rating.sharp)
            formData.append('fruity',this.form.rating.fruity)
            formData.append('mellow',this.form.rating.mellow)

            const baseUrl = process.env.MIX_URL
            await axios.get(`${baseUrl}/sanctum/csrf-cookie`);

            await axios.post('/api/cards',formData).then((res) =>{
                console.log(res.status)
                this.$router.push('/')
            }).catch((error)=>{
                console.log(error.response)
            })

            // if(response.status === INTERNAL_SERVER_ERROR){
            //     this.errors = response.data.errors
            //     return false
            // }

            // if(response.status === UNPROCESSABLE_ENTITY){
            //     console.log(response.status)
            //     return false
            // }


        },
        formBarName(){
            this.form.bar = this.$store.state.data.barName;
        }
    },
    components: { 
        PostModal,
        SelectModal,
        StarRating,
    },
  
}
</script>