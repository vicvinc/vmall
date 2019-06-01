<template>
    <van-row
      gutter="16"
      class="goods-list"
    >
      <van-col
        span="12"
        v-for="goods in goodsList"
        :key="goods.id"
      >
        <router-link
          class="card-goods"
          :to="`/goods/${goods.id}`"
        >
          <img class="thumbnail" :src="goods.thumbnail" />
          <div class="detail">
            <p class="description">
                {{ goods.name }}
            </p>
            <p class="info">
              <span class="act-price">
                <span class="icon">¥</span>
                <span>{{ goods.actprice }}</span>
              </span>
              <span class="price">
                <span class="icon">¥</span>
                <span class="price-num">{{ goods.price }}</span>
              </span>
              <span class="btn-purchase">
                购买
              </span>
            </p>
          </div>
        </router-link>
      </van-col>
    </van-row>
</template>

<script>

export default {
  name: "order-preview",
  data() {
    return {};
  },
  methods: {
    
  },
  created() {
    this.$store.commit('SET_APP_TITLE', '订单');
  }
};
</script>
