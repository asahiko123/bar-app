<template>
    <v-main>
        <v-container fluid class="d-flex justify-center">
            <v-col class="d-flex flex-column col-md-5">
                
                    <v-card
                    outlined
                    class="d-flex justify-center">

                        <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                        class="d-flex flex-column">

                        <v-card-title
                        class="d-flex justify-center">
                        新規登録
                        </v-card-title>

                        <v-text-field
                        v-model="name"
                        label="アカウント名"
                        required>
                
                        </v-text-field>
                        
                        <v-text-field
                        v-model="email"
                        label="Eメール"
                        required>
                
                        </v-text-field>
                        <v-text-field
                        v-model="password"
                        label="パスワード"
                        required>
                        </v-text-field>

                        <v-select
                            :items="prefectures"
                            filled
                            label="都道府県"
                        ></v-select>

                        <v-text-field
                        v-model="introduce"
                        label="自己紹介"
                        >
                        </v-text-field>

                        </v-form>

                    </v-card>
            </v-col>
        </v-container>
    </v-main>
</template>

<script>

export default {

    data(){

        return{

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
        
    }

}

</script>