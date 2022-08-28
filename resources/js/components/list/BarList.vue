<template>
    <v-card>            
        <v-card-actions class="justify-start">
            
            <v-btn
            text
            @click="onSelectBar()">{{ this.barName }}</v-btn>

        </v-card-actions>
    </v-card>
</template>

<script>
// import newPost from '../../newPost';
import store from "../../store";

export default{

    name: 'BarList',

    props:{
        barName: String
    },

    methods:{

        onSelectBar(){

            // newPost.onSelectBar();
            store.commit('data/setBarName',this.barName);
            store.commit('data/setDialog',false);
        }

    }
}
</script>