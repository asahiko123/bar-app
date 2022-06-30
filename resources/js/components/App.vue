<template>
    <v-app>
        <v-app-bar
            app
            absolute
            color="#6A76AB"
            dark
            shrink-on-scroll
            prominent
            fade-img-on-scroll
        >
            <template v-slot:extension>
                <v-tabs
                    align-with-title
                    fixed-tab
                    class="d-flex justify-center tab"
                >
                    <v-tab
                        ><router-link
                            :to="{ name: 'home' }"
                            class="tab-link home"
                            >ホーム</router-link
                        ></v-tab
                    >
                    <v-tab
                        ><router-link
                            :to="{ name: 'barMap' }"
                            class="tab-link map"
                            >お店を探す</router-link
                        ></v-tab
                    >
                    <v-tab
                        ><router-link
                            :to="{ name: 'aboutUs' }"
                            class="tab-link aboutUs"
                            >このサイトについて</router-link
                        ></v-tab
                    >
                </v-tabs>
            </template>

            <v-container v-if="!isLogin" class="d-flex justify-end mb-6">
                <v-btn color="link" min-height="20" text>
                    <v-row class="d-flex flex-column">
                        <v-icon>mdi-account-arrow-left</v-icon>
                        <router-link
                            :to="{ name: 'login' }"
                            class="tab-link map"
                            ><v-col class="login">ログイン</v-col></router-link
                        >
                    </v-row>
                </v-btn>
                <v-btn color="link" min-height="20" text>
                    <v-row class="d-flex flex-column">
                        <v-icon>mdi-account-arrow-left</v-icon>
                        <router-link
                            :to="{ name: 'register' }"
                            class="tab-link map"
                            ><v-col class="register"
                                >新規登録</v-col
                            ></router-link
                        >
                    </v-row>
                </v-btn>
            </v-container>

            <v-container v-else class="d-flex justify-end mb-6">
                <span>{{ username }}</span>
                <v-btn color="link" min-height="20" text @click="logout">
                    <v-row class="d-flex flex-column">
                        <v-icon>mdi-account-arrow-left</v-icon>
                        <v-col class="logout">ログアウト</v-col>
                    </v-row>
                </v-btn>
            </v-container>
        </v-app-bar>

        <router-view
            :auth="this.$route.params.auth"
            @loginUser="loginUser"
            :logout_message="logout_message"
        />

        <v-footer app v-if="isLogin">
            <v-bottom-navigation color="primary lighten-1" fixed>
                <v-btn href="/">
                    <span>ホーム</span>
                    <v-icon>mdi-home</v-icon>
                </v-btn>

                <Modal></Modal>
            </v-bottom-navigation>
        </v-footer>
    </v-app>
</template>

<script>
import Modal from "./message/Modal.vue";
import { INTERNAL_SERVER_ERROR } from "../util";

export default {
    name: "App",

    components: {
        Modal,
    },

    data() {
        return {
            error: "",
            auth: false,
            logout_message: null,
        };
    },
    methods: {
        async logout() {
            await this.$store.dispatch("auth/logout");

            this.$router.push("/login");
            // axios.post('api/logout')
            // .then((res) => {

            //     this.logoutUser();
            //     console.log('ログアウト完了');
            //     this.logout_message = "ログアウトしました。"

            // })
            // .catch((err) => {console.log(err.response)})
        },

        loginUser() {
            console.log("login");
            this.auth = true;
        },

        logoutUser() {
            console.log("logout");
            this.auth = false;
        },
    },
    computed: {
        isLogin() {
            return this.$store.getters["auth/check"];
        },
        username() {
            return this.$store.getters["auth/username"];
        },
        errorCode() {
            return this.$store.state.error.code;
        },
    },
    watch: {
        errorCode: {
            handler(val) {
                if (val === INTERNAL_SERVER_ERROR) {
                    this.$router.push("/500");
                }
            },
            immediate: true,
        },
    },
    $route() {
        this.$store.commit("error/setCode", null);
    },
};
</script>
<style>
a.tab-link.home,
a.tab-link.map,
a.tab-link.aboutUs {
    color: hsla(0, 0%, 100%, 0.6);
}
</style>
