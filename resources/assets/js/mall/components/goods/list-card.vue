<template>
    <section class="goods-wrap">
      <van-row
        gutter="16"
        class="goods-list"
      >
        <van-col
          span="24"
          v-for="goods in goodsList"
          :key="goods.uid"
        >
          <router-link
            class="card-goods"
            :to="`/goods/${goods.uid}`"
          >
            <van-card
              :title="goods.name"
              :desc="goods.brief"
              :thumb="goods.thumbnail"
            >
            <p slot="footer">
                <span class="sold">已售出{{goods.sales}}</span>
                <span class="icon act-price">¥{{goods.actprice}}</span>
            </p>                
            </van-card>
          </router-link>
        </van-col>
      </van-row>
    </section>
</template>

<script>
export default {
    name: 'goods-card-list',
    props: {
        goodsList: {
            type: Array,
            default: []
        }
    }
}
</script>

<style>

</style>
