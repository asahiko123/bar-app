<template>
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
</template>

<script>
export default{
    data() {

        return{

            menus: [
                {title: 'Index', icon: 'mdi-web' ,url: '/'},
                {title: 'Home' , icon: 'mdi-home',url: '/'},
            ],  

        }
    }
}
</script>
