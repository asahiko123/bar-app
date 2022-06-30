<template>
    <v-main>
        <v-container fluid class="d-flex justify-center">
            <v-col class="d-flex flex-column col-md-5">
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

                        <div v-if="loginErrors" class="errors">
                            <ul v-if="loginErrors.email">
                                <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
                            </ul>
                            <ul v-if="loginErrors.password">
                                <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
                            </ul>
                        </div>

                        <v-text-field
                        v-model="form.email"
                        label="Eメール"
                        required>
                
                        </v-text-field>
                        <v-text-field
                        v-model="form.password"
                        label="パスワード"
                        type = "password"
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
import { mapState } from 'vuex'

export default{

    name: "Login",

    components: {
        Message,
    },

    data() {
        return {

            user: {
                id: null,
                name: null,
                email: null,
            },

            form: {
                email: 'evolution4532@gmail.com',
                password: 'Aa@111111',
                remember: true,
            },

            error: '',
            auth: false,
            message: null,
            errors: null,
        }
    },


    methods: {
        async login(){

            const baseUrl = process.env.MIX_URL
            await axios.get(`${baseUrl}/sanctum/csrf-cookie`);

            await this.$store.dispatch('auth/login',this.form);

            if(this.apiStatus){
                 this.$router.push('/');    
            }
            
        },

        async logout() {
            const { data, status } = await axios.post("logout");
            if(status === 200){

                this.user.id = null;
                this.user.name = null;
                this.user.email = null;
                this.message = data.message;
                this.errors = null;

            }else{
                this.message = data.message;
                this.errors = data.errors;
            }
        },

        clearError(){
            this.$store.commit('auth/setLoginErrorMessages',null)
        },

        close() {
            this.message = null;
            this.errors = null;
        }
        
    },

    computed:{

        // apiStatus() =>{
        //     return this.$store.state.auth.apiStatus
        // },
        // loginErrors(){
        //     return this.$store.state.auth.loginErrorMessages
        // }

        ...mapState({
            apiStatus: state => state.auth.apiStatus,
            loginErrors: state => state.auth.loginErrorMessages
        })

    },
    created (){
        this.clearError()
    }
}
</script>
