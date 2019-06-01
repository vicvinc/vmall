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
        const { keyword } = this.$route.params
        return {
            apiUrl: `/api/search/${keyword}`
        }
    }
};
</script>
