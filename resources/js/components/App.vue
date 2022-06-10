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
        <v-tabs align-with-title fixed-tab class="d-flex justify-center">
            <v-tab><router-link to="/">ホーム</router-link></v-tab>
            <v-tab><router-link to="/barMap">お店を探す</router-link></v-tab>
            <v-tab>このサイトについて</v-tab>
        </v-tabs>
    </template>

    <v-btn
        href="/login"
        color="link"
        min-height="20"
        text
        >ログイン
    </v-btn>
    </v-app-bar>

    <router-view />

    <v-footer app>
        <v-bottom-navigation
        :value="activeBtn"
        color="primary lighten-1"
        fixed
        >
        <v-btn href="/">
            <span>Home</span>
            <v-icon>mdi-home</v-icon>
        </v-btn>

        <v-btn href="/tweet/index">
            <span>Timeline</span>
            <v-icon>mdi-timeline</v-icon>
        </v-btn>
        </v-bottom-navigation>
    </v-footer>
    </v-app>
</template>

<script>

</script>
