<template>

<v-dialog
    transition="dialog-bottom-transition"
    max-width="600">

    <template v-slot:activator="{ on, attrs }">

    <v-btn
        v-bind="attrs"
        v-on="on">
        <span>投稿する</span>
        <v-icon>mdi-timeline</v-icon>
    </v-btn>

    </template>
    <template v-slot="dialog">
        <v-card>
            <v-toolbar>

            </v-toolbar>

            <v-text-field
            placeholder="ここに投稿"
            name = "post"
            required
            outlined
            dense>
            </v-text-field>

            <!-- <v-file-input
                label="画像を選択する"
                outlined
                dense
                name = "posted_image"
                @change = "onFileChange"
            ></v-file-input> -->

            <input class="form__item" type="file" @change="onFileChange">

            <output class="form__output" v-if="preview" >
            <img :src="preview" alt="" width="400" height="400">
            </output>

            
            <v-card-actions class="justify-end">
                <v-form ref="form" @submit.prevent ="submit">
                    <v-btn type="submit" color="rgb(106, 118, 171)" class="float-right">投稿する</v-btn>
                </v-form>
                <v-btn
                text
                @click="dialog.value= false">Close</v-btn>

            </v-card-actions>
        </v-card>
    </template>
</v-dialog>

    
</template>

<script>

import axios from 'axios';

export default{


    name: "PostModal",

    data(){

        return{
            preview: null,
            posted_image: null,
            post: null
        }

    },

    methods: {
        onFileChange(event){
            console.log(event);
            //何も選択されない場合
            if(event.target.files.length === 0){
                this.reset()
                return false
            }
            //入力ファイルが画像ではない場合
            if(! event.target.files[0].type.match('image.*')){
                this.reset()
                return false
            }
            
            const reader = new FileReader()
            console.log(reader)

            //PREVIEWの値がtrueになるので、画像がoutputタグで表示される
            reader.onload = e =>{
                
                 this.preview = e.target.result
            }

            reader.readAsDataURL(event.target.files[0])

            this.posted_image = event.target.files[0]

        },
        reset(){
            this.preview = '',
            this.posted_image = null,
            this.$el.querySelector('input[type="file"]').value = null
        },
        async submit(){
            const formData = new FormData();
            formData.append('posted_image',this.posted_image)
            
            // console.log(...formData.entries());
            const response = await axios.post('/api/cards',formData)

            this.reset()
            this.$router.push(`/cards/${response.data.id}`)

        }
    }
}
</script>
