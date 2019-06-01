<template>
    <div class="page-category">
        <van-row gutter="16">
            <van-col span="6">
                <van-badge-group :active-key="activeKey">
                    <van-badge
                        v-for="category in categories"
                        :title="category.parent.category_name"
                        :info="`${category.children.length}`"
                        :key="category.parent.id"
                        @click="onClick"
                    />
                </van-badge-group>
            </van-col>
            <van-col span="16">
                <div v-if="subCategories.length === 0" class="empty-cate">
                    <div class=" empty-container">
                        <i class="empty-image" />
                    </div>
                    <p class="p14 p-center mt10">
                        该分类下暂详细分类
                    </p>
                </div>

                <van-row v-else gutter="8">
                    <van-col
                        v-for="subCate in subCategories"
                        :key="subCate.id"
                        span="24"
                    >
                        <router-link :to="`/category/${subCate.id}`">
                            <img class="cate-image" :src="subCate.category_img" />
                            <p class="cate-name p-center">{{subCate.category_name}}</p>
                        </router-link>
                    </van-col>
                </van-row>
            </van-col>
        </van-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            activeKey: 0,
            searchKey: "",
            categories: [],
            subCategories: [],
        };
    },
    methods: {
        onClick(key) {
            this.setActiveKey(key)
            this.showSubCate()
        },
        setActiveKey(key = 0) {
            this.activeKey = key
        },
        getActiveCate() {
            return this.categories[this.activeKey]
        },
        showSubCate() {
            let showCate = this.getActiveCate()
            if (!showCate) {
                return
            }
            this.curCategory = showCate.parent.id
            this.subCategories = showCate.children
        },
        fetchCategories() {
            this.$http
                .get('/api/categories')
                .then(data => this.categories = data)
                .then(this.showSubCate)
                .catch(err => {
                    console.log(err)
                    this.$toast({
                        message: '获取分类列表失败',
                        iconClass: 'icon icon-error'
                    })
                });
        }
    },
    created() {
        this.fetchCategories();
        this.$store.commit('SET_APP_TITLE', '全部课程');
    }
};
</script>
