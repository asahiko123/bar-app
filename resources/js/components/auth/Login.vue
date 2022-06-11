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
                        class="d-flex flex-column">

                        <v-card-title
                        class="d-flex justify-center">
                        ログイン
                        </v-card-title>

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

                        </v-form>

                    </v-card>
            </v-col>
        </v-container>
    </v-main>
</template>