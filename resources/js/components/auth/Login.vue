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
                email: '',
                password: '',
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

            const { data, status } = await axios.post("api/login", this.form);
            if(status === 200){

                this.snackbar = true;
                this.text = "ログインが完了しました";
                this.$emit('loginUser');
                console.log(res);
                this.$router.push({ name: 'home', params: { message: this.message}});
                
            }else{
                this.message = data.message;
                this.error = data.errors;
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

        close() {
            this.message = null;
            this.errors = null;
        }
        
    },

    async created(){
        const { data, status } = await axios.post("/user");

        if( status === 200){
            this.user.id = data.user.id;
            this.user.name = data.user.name;
            this.user.email = data.user.email;
            this.message = data.message;
            this.errors = null;
        }else{
            this.message = data.message;
            this.errors = data.errors;
        }
    },
}
</script>
