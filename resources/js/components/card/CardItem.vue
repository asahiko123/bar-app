<template>
    <div class="card">
        <figure class="card__wrapper">
            <img :src="item.url" :alt="`${item.user.account_name}`" width="500" height="400">
        </figure>
        <Router-Link
            class="card__overlay"
            :to ="`/cards/${item.id}`"
        >
            <div class="card__wrapper">
                <button
                    class="card__action favorite"
                >
                 <i class="icon icon-md-heart"></i>
                </button>
                <div class="card_username">
                    {{ item.user.name}}
                </div>
            </div>
        </Router-Link>
    </div>
</template>

<script>

export default{
    props:{
        item:{
            type: Object,
            required: true,
        }
    }
}
</script>