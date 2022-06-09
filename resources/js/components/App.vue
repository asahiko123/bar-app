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

    <v-navigation-drawer app dark>

        <v-list-item>
        <v-list-item-title>
            Application
        </v-list-item-title>
        <v-btn->
            <v-icon>mdi-chevron-left</v-icon>
        </v-btn->
        </v-list-item>
        <v-list nav>
        <v-list-item v-for="menu in menus" :key="menu.title" :to="menu.url">
            <v-list-item-icon>
            <v-icon>@{{ menu.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
            <v-list-item-title>@{{ menu.title }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        </v-list>
    </v-navigation-drawer>

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