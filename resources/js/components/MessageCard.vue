<template>
    <v-container class="message" v-if="title">
        <h3 class="message__title">{{ title }}</h3>
        <div
            class="message__content"
            v-for="(content, key) in contents"
            :key="key"
        >
            <h4 v-if="key" class="message__content__title">{{ key }}</h4>
            <ul v-if="key" class="message__content__list">
                <li
                    class="message__content__items"
                    v-for="(value, index) in content"
                    :key="index"
                >
                    {{ value }}
                </li>
            </ul>
        </div>
    </v-container>
</template>

<script>
export default {
    name: "MessageCard",
    props: {
        title: {
            type: String,
            default: null,
        },
        contents: {
            type: Object,
            default: null,
        },
        timeout: {
            type: Number,
            default: 5000,
        },
    },
    data() {
        return {
            id: null,
        };
    },
    watch: {
        title: function () {
            console.log("変化したよ");
            clearTimeout(this.id);
            this.id = setTimeout(() => this.$emit("close"), this.timeout);
        },
    },
};
</script>
