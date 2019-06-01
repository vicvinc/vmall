<template>
<div class="app-nav--bar">
    <van-nav-bar
        v-if="!isSearch"
        :title="title"
        @click-left="onClickLeft"
        @click-right="onClickRight"
        left-arrow
        fixed
    >
        <van-icon name="search" slot="right" />
    </van-nav-bar>
    <form
        v-if="isSearch"
        action="/"
        class="van-nav-bar van-nav-bar--fixed"
    >
        <van-search
            v-model="keyword"
            placeholder="请输入商品名称"
            show-action
            @search="onSearch"
            @cancel="onCancel"
            fixed
        />
    </form>
</div>
</template>

<script>
import { mapMutations, mapState } from "vuex";
export default {
  name: "nav-bar",
  data() {
    return {
      isSearch: false,
      keyword: '',
    };
  },
  computed: mapState({
    title: state => state.title
  }),
  methods: {
    onClickLeft() {
      this.$router.go(-1);
    },
    onClickRight() {
        this.isSearch = true;
    },
    onSearch() {
        this.$router.push(`/search/${this.keyword}`);

        // this.$http.get(`/api/search/${this.keyword}`)
        //     .then(data => {
        //         console.log(result)
        //     })
        //     .catch(console.error)
    },
    onCancel() {
        this.isSearch = false;
    }
  }
};
</script>
