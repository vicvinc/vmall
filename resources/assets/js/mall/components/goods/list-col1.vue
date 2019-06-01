<template>
    <section class="section-wrap goods-wrap">
      <van-row
        gutter="16"
        class="goods-list"
      >
        <van-col
          span="24"
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
                  <span class="icon">¥</span>
                  <span>{{ goods.actprice }}</span>
                </span>
                <span class="price">
                  <span class="icon">¥</span>
                  <span class="price-num">{{ goods.price }}</span>
                </span>
              </p>
            </div>
          </router-link>
        </van-col>
      </van-row>
    </section>
</template>

<script>

export default {
    name: 'goods-list',
    props: {
        goodsList: {
            type: Array,
            default: [],
        }
    }
};
</script>