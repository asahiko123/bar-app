<template>

<v-dialog
    transition="dialog-bottom-transition"
    max-width="600">

    <template v-slot:activator="{ on, attrs }">

    <v-btn
        v-bind="attrs"
        v-on="on">
        <span>投稿する</span>
        <v-icon>mdi-timeline</v-icon>
    </v-btn>

    </template>
    <template v-slot="dialog">
        <v-card>
            <v-toolbar>

            </v-toolbar>

            <v-text-field
            placeholder="ここに投稿"
            required
            outlined
            dense>

            </v-text-field>
            <v-btn type="submit" color="rgb(106, 118, 171)" class="float-right">投稿する</v-btn>
            <v-card-actions class="justify-end">
                <v-btn
                text
                @click="dialog.value= false">Close</v-btn>

            </v-card-actions>
        </v-card>
    </template>
</v-dialog>

    
</template>
