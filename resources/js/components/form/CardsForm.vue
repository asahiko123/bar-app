
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
                        @submit.prevent = "create">


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
                                <StarRating v-model="rating.easyToDrink" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>甘さ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="rating.sweet" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>辛さ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="rating.dry" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>爽やかさ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="rating.fresh" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>フルーティーさ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="rating.fruity" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>キレのよさ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="rating.sharp" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-subheader>芳醇さ</v-subheader>
                            </v-col>
                            <v-col>
                                <StarRating v-model="rating.mellow" v-bind:star-size="30"></StarRating>
                            </v-col>
                        </v-row>

                        <v-btn type="submit" color="rgb(106, 118, 171)" class="float-right">ログイン</v-btn>

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


export default{

    name: "cardsForm",

    data() {
        return {

            dialog: false,

            rating: {
                easyToDrink: 0,
                sweet: 0,
                dry:0 ,
                fresh:0 ,
                fruity: 0,
                sharp: 0,
                mellow: 0,

            },

            form: {
                menu: null,
                price: null,
                bar: null,
                comment: null,
                easyToDrink: null,
                sweet: null,
                dry: null,
                fresh: null,
                fruity: null,
                sharp: null,
                mellow: null,
                date: null,
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

    methods: {
        displayPreviewImage(posted_image){
            console.log(posted_image)
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
        }
    },
    components: { 
        PostModal,
        SelectModal,
        StarRating,
    },
  
}
</script>