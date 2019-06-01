<template>
    <section class="section-wrap goods-wrap">
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