<template>
  <section class="section-wrap goods-wrap">
    <van-row
      gutter="16"
      class="goods-list"
      v-waterfall-lower="fetchNext"
      waterfall-disabled="loading"
      waterfall-offset="100"
    >
      <van-col
        span="12"
        v-for="goods in goodsList"
        :key="goods.id"
      >
        <router-link
          class="card-goods"
          :to="`/goods/${goods.uid}`"
        >
          <img class="thumbnail" :src="goods.thumbnail" />
          <div class="detail">
            <p class="description">
                {{ goods.name }}
            </p>
            <p class="info">
              <span class="act-price">
                ¥{{ goods.actprice }}
              </span>
              <span class="price price-num">
                ¥{{ goods.price }}
              </span>
            </p>
          </div>
        </router-link>
      </van-col>
    </van-row>
    <p class="no-more" v-if="listEnd">
      <em>没有更多啦</em>
    </p>
  </section>
</template>

<script>
import { Waterfall } from "vant";

export default {
  name: "goods-list",
  props: {
    startUrl: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      goodsList: [],
      nextPage: "",
      loading: false,
      listEnd: false
    };
  },
  directives: {
    WaterfallLower: Waterfall("lower")
  },
  methods: {
    updateData(response) {
      const { current_page, total, data, next_page_url } = response;
      this.pagination = {
        curPage: current_page,
        total
      };
      this.nextPage = next_page_url;
      this.goodsList = this.goodsList.concat(data);
      this.listEnd = data.length === 0;
    },
    fetchList(apiUri) {
      if (apiUri) {
        this.loading = true;
        this.$http
          .get(apiUri)
          .then(this.updateData)
          .then((this.loading = false))
          .catch(console.error);
      }
    },
    fetchNext() {
      this.fetchList(this.nextPage);
    }
  },
  created() {
    this.fetchList(this.startUrl);
  }
};
</script>