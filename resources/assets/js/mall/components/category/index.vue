<template>
    <div class="page-container">
        <!-- <carousel /> -->
        <goods-list :start-url="apiUrl"></goods-list>
    </div>
</template>

<script>

import EmptyData from '../goods/empty.vue';
import GoodsList from '../goods/list.vue';
import carousel from "../home/carousel.vue";

export default {
    components: {
        EmptyData,
        GoodsList,
        carousel,
    },
    data() {
        const topicID = this.$route.params.id
        return {
            apiUrl: `/api/goods`
        }
    },
    created() {
        this.$store.commit('SET_APP_TITLE', '所有课程');
    }
};
</script>
