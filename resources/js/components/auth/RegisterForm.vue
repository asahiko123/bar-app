<template>
    <v-main>
        <v-container fluid class="d-flex justify-center">
            <v-col class="d-flex flex-column col-md-5">
                <v-snackbar v-model = "snackbar" :timeout = "timeout">
                    {{ text }}
                </v-snackbar>
                
                    <v-card
                    outlined
                    class="d-flex justify-center">

                        <v-form
                        ref="form"
                        @submit.prevent
                        lazy-validation
                        class="d-flex flex-column"
                        >

                        <v-card-title
                        class="d-flex justify-center">
                        新規登録
                        </v-card-title>

                        <v-text-field
                        v-model="form.account_name"
                        name="account_name"
                        label="アカウント名"
                        required>
                
                        </v-text-field>
                        
                        <v-text-field
                        v-model="form.email"
                        name="email"
                        label="Eメール"
                        required>
                
                        </v-text-field>
                        <v-text-field
                        type="password"
                        v-model="form.password"
                        name="password"
                        placeholder="password"
                        label="パスワード"
                        required>
                        </v-text-field>

                        <v-text-field
                        type="password"
                        v-model="form.password_confirmation"
                        name="password_confirmation"
                        placeholder="password"
                        label="パスワード再入力"
                        required>
                        </v-text-field>

                        <v-select
                            :items="prefectures"
                            v-model="form.pref_code"
                            name="pref_code"
                            filled
                            label="都道府県"
                        ></v-select>

                        <v-text-field
                        v-model="form.introduce"
                        label="自己紹介"
                        >
                        </v-text-field>
                            <v-btn @click="register" color="rgb(106, 118, 171)" class="float-right">登録</v-btn>
                        </v-form>

                    </v-card>
            </v-col>
        </v-container>
    </v-main>
</template>

<script>

export default {

    name : "RegisterForm",

    data(){

        return{

            snackbar: false,
            text: null,
            timeout: 5000,
            auth: false,

            form: {

                account_name: "asdf",
                email: "evolution4532@gmail.com",
                password: "Aa@111111",
                password_confirmation: "Aa@111111",
                pref_code: "北海道",
                introduce: "aaaa"

            },

            message: null,
            errors: null,

            prefectures:[
            '北海道',
            '青森県',
            '岩手県',
            '宮城県',
            '秋田県',
            '山形県',
            '福島県',
            '茨城県',
            '栃木県',
            '群馬県',
            '埼玉県',
            '千葉県',
            '東京都',
            '神奈川県',
            '新潟県',
            '富山県',
            '石川県',
            '福井県',
            '山梨県',
            '長野県',
            '岐阜県',
           ' 静岡県',
            '愛知県',
            '三重県',
            '滋賀県',
            '京都府',
            '大阪府',
            '兵庫県',
            '奈良県',
            '和歌山県',
            '鳥取県',
            '島根県',
            '岡山県',
            '広島県',
            '山口県',
            '徳島県',
            '香川県',
            '愛媛県',
            '高知県',
            '福岡県',
            '佐賀県',
            '長崎県',
            '熊本県',
            '大分県',
            '宮崎県',
            '鹿児島県',
            '沖縄県'
        ]

        }
        
    },

    methods: {
        async register(){

            await this.$store.dispatch('auth/register',this.form)

            this.$router.push('/')

            //  await axios.post("api/register", this.form)
            //  .then(res =>{

            //     this.message = "登録が完了しました！";
            //     this.$emit('loginUser');
            //     console.log(res);

            //     this.$router.push({ name: 'home', params: { message: this.message}});

            //  })
            //  .catch(error => {

            //     this.snackbar = true;
            //     this.text = "エラーが発生しました。もう一度お試しください。";
            //     this.$router.push('/register')
            //  });
                
            
        },
        close(){
            this.message = null;
            this.errors = null;
        }
    }

}

</script>