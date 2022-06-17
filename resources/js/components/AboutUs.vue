<template>
    <v-main>
        <v-card
        outlined
        class="d-flex justify-center"
        >
            <v-tabs align-with-title class="d-flex justify-center tab">
                <v-list-item>
                    <v-tab>
                    <v-list-item-title>お問い合わせ等</v-list-item-title>
                    </v-tab>
                    <v-tab>
                        <v-list-item-title>公式Twitter</v-list-item-title>
                    </v-tab>
                    <v-tab>
                        <v-list-item-title>プライバシーポリシー</v-list-item-title>
                    </v-tab>
                </v-list-item>
            </v-tabs>
        </v-card>
    </v-main>
</template>

<script>

export default {

    name: 'AboutUs'

}
</script>

