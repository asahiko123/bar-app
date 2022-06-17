<template>
    <v-main>
        <v-container fluid class="d-flex justify-center">
            <v-col class="d-flex flex-column col-md-5">
                <Message :title="message" :contents="errors" @close="close"/>
                <v-btn
                color="primary"
                class="p-4 mb-4">
                    <span color="#FFFFFF">FaceBookでログイン</span>
                </v-btn>
                <v-btn
                color="info"
                class="p-4 mb-4">
                    <span color="#FFFFFF">twitterでログイン</span>
                </v-btn>
                    <v-card
                    outlined
                    class="d-flex justify-center">

                        <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                        class="d-flex flex-column"
                        @submit.prevent = "login">

                        <v-card-title
                        class="d-flex justify-center">
                        ログイン
                        </v-card-title>

                        <v-text-field
                        v-model="form.email"
                        label="Eメール"
                        required>
                
                        </v-text-field>
                        <v-text-field
                        v-model="form.password"
                        label="パスワード"
                        required>
                        </v-text-field>

                        <v-btn type="submit" color="rgb(106, 118, 171)" class="float-right">ログイン</v-btn>

                        </v-form>

                    </v-card>
            </v-col>
        </v-container>
    </v-main>
</template>
<script>
import axios from 'axios'
import Message from "@/components/Message.vue";

export default{

    components: {
        Message,
    },

    data() {
        return {
            form: {
                email: '',
                password: '',
            },

            error: '',
            auth: false,
            message: null,
            errors: null,
        }
    },

    created(){
        axios.get('/api/auth')
        .then((res) => {
            if(res.data.result){
                this.auth = true
            }
        })
        .catch((err) => {

        })
    },

    methods: {
        login(){
            this.error = ''
            axios.get('/sanctum/csrf-cookie')
            .then((res) => {
                axios.post('/api/login', this.form)
                .then((res) => {
                    if(!res.data.result){
                        this.error =res.data.message
                    }else{
                        this.auth = true
                    }
                })
            })
        },
        
    }
}
</script>
