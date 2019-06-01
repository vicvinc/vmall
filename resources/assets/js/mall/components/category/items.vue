<template>
    <div class="page-container">
        <goods-list :start-url="apiUrl"></goods-list>
    </div>
</template>

<script>
import EmptyData from '../goods/empty.vue';
import GoodsList from '../goods/list.vue';
export default {
    components: {
        EmptyData,
        GoodsList
    },
    data() {
        const topicID = this.$route.params.id
        return {
            apiUrl: `/api/category/${topicID}`
        }
    }
};
</script>
