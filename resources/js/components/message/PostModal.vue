<template>

<v-dialog
    transition="dialog-bottom-transition"
    max-width="600">

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
            <v-toolbar>

            </v-toolbar>

            <v-text-field
            placeholder="ここに投稿"
            name = "post"
            required
            outlined
            dense
            v-model="post">
            </v-text-field>


            <input class="form__item" type="file" @change="onFileChange">

            <output class="form__output" v-if="preview" >
            <img :src="preview" alt="" width="400" height="400">
            </output>

            
            <v-card-actions class="justify-end">
                <v-form ref="form" @submit.prevent ="submit">
                <!-- <div class="errors" v-if="errors">
                    <ul v-if="errors.posted_image">
                    <li v-for="msg in errors.posted_image" :key="msg">{{ msg }}</li>
                    </ul>
                </div> -->
                <v-btn type="submit" color="rgb(106, 118, 171)" class="float-right">投稿する</v-btn>
                </v-form>
                <v-btn
                text
                @click="closeDialog(dialog)">Close</v-btn>

            </v-card-actions>
        </v-card>
    </template>
</v-dialog>

    
</template>

<script>

import axios from 'axios'
import { INTERNAL_SERVER_ERROR} from '../../util'


export default{

    name: "PostModal",

    data(){

        return{
            preview: null,
            posted_image: null,
            post: null,
            errors: null
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
            console.log(this.posted_image)
            

        },
        reset(){
            this.preview = '',
            this.post = null,
            document.querySelector('input[type="file"]').value = null
        },

        closeDialog(dialog){

            dialog.value = false
            this.reset()

        },
        openDialog(dialog){
            dialog.value = true
        },


        async submit(){
            const formData = new FormData();
            formData.append('posted_image',this.posted_image);
            formData.append('post',this.post);
            
            console.log(...formData.entries());
            // const baseUrl = process.env.MIX_URL
            // await axios.get(`${baseUrl}/sanctum/csrf-cookie`);
            const response = await axios.post('/api/cards',formData)
            console.log(response.status)

                if (response.status === INTERNAL_SERVER_ERROR) {
                    this.errors = response.data.errors
                    return false
                }
           
            this.reset()
            this.$router.push(`/cards/${response.data.id}`)

        }
    },

    mounted(dialog){
       this.openDialog(dialog)
    }  


    
}
</script>
