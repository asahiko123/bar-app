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
    scroll-target="#scrolling-techniques-3"
    >


    <template v-slot:extension>
        <v-tabs align-with-title fixed-tab class="d-flex justify-center tab">
            <v-tab><router-link to="/" class="tab-link home">ホーム</router-link></v-tab>
            <v-tab><router-link to="/barMap" class="tab-link map">お店を探す</router-link></v-tab>
            <v-tab><router-link to="/aboutUs" class="tab-link aboutUs">このサイトについて</router-link></v-tab>
        </v-tabs>
    </template>

    <v-container v-if="!auth">
    <v-btn
        href="/login"
        color="link"
        min-height="20"
        text
        >
        <v-row class="d-flex flex-column">
            <v-icon>mdi-account-arrow-left</v-icon>
            <v-col class="login">ログイン</v-col>
        </v-row>
    </v-btn>
    <v-btn
        href="/register"
        color="link"
        min-height="20"
        text
        >
        <v-row class="d-flex flex-column">
            <v-icon>mdi-account-arrow-left</v-icon>
            <v-col class="register">新規登録</v-col>
        </v-row>
    </v-btn>
    </v-container>
    
    <v-container v-else>
        <v-btn
            color="link"
            min-height="20"
            text
            @click="logout"
            >
            <v-row class="d-flex flex-column">
                <v-icon>mdi-account-arrow-left</v-icon>
                <v-col class="logout">ログアウト</v-col>
            </v-row>
        </v-btn>
    </v-container>
    </v-app-bar>

    <router-view />

    <v-footer app>
        <v-bottom-navigation
        :value="activeBtn"
        color="primary lighten-1"
        fixed
        >
        <v-btn href="/">
            <span>ホーム</span>
            <v-icon>mdi-home</v-icon>
        </v-btn>

        <v-btn href="/tweet/index">
            <span>投稿する</span>
            <v-icon>mdi-timeline</v-icon>
        </v-btn>
        </v-bottom-navigation>
    </v-footer>
    </v-app>
</template>

<script>

export default {
     methods: {
        logout() {
            axios.post('api/logout')
            .then((res) => {
                this.auth = false
                this.error = res.data.message
            })
            .catch((err) => {console.log(err.response)})
        }
    }
}

</script>
<style>

a.tab-link.home, a.tab-link.map, a.tab-link.aboutUs {

    color: hsla(0,0%,100%,.6);


}
</style>


