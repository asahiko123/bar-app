<template>

<v-dialog
    transition="dialog-bottom-transition"
    max-width="600"
    v-model="dialog">

    <template v-slot="dialog">
        <v-card>

            <input type="file" @change="onFileChange">

            <output v-if="preview">
            <img :src="preview" alt="" width="400" height="400">
            </output>

            
            <v-card-actions class="justify-end">
            
                <!-- <div class="errors" v-if="errors">
                    <ul v-if="errors.posted_image">
                    <li v-for="msg in errors.posted_image" :key="msg">{{ msg }}</li>
                    </ul>
                </div> -->
                <v-btn @click="proceedPost(dialog)">決定</v-btn>
                
                <v-btn
                text
                @click="cancelPost(dialog)">
                Close
                </v-btn>

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
            errors: null,
            dialog: false,
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
            document.querySelector('input[type="file"]').value = null
            
        },

        cancelPost(dialog){

            dialog.value = false
            this.reset()
            this.$router.push('/')

        },

        proceedPost(dialog){

            if(this.preview){

                dialog.value = false
                this.sendPreviewImage()
                this.reset()


            }

            return false
            
        },

        sendPreviewImage(){
            this.$emit('catchPreviewImage',this.posted_image)
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
    mounted(){

        this.dialog = true
    }

}
</script>
