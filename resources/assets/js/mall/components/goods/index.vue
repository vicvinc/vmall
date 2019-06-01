<template>
  <div class="page-goods">
    <van-loading v-if="loading" type="spinner" color="black" />
    <div v-else class="goods">

      <!-- thumb swipe -->
      <van-swipe class="goods-swipe" :autoplay="3000">
        <van-swipe-item>
          <img :src="goods.thumbnail" >
        </van-swipe-item>
      </van-swipe>

      <!-- goods info -->
      <van-cell-group>
        <van-cell>
          <div class="goods-title p14">{{ goods.title }}</div>
          <div class="goods-actprice p12">{{ formatPrice(goods.actprice) }}</div>
          <div class="goods-price p12">{{ formatPrice(goods.price) }}</div>
        </van-cell>
        <van-cell class="goods-express">
          <van-col span="10">已售出：{{ goods.salse }}</van-col>
          <van-col span="14">剩余：{{ goods.stock }}</van-col>
        </van-cell>
      </van-cell-group>

      <!-- store info -->
      <van-cell-group class="goods-cell-group">
        <van-cell value="进入店铺" icon="shop" isLink>
          <template slot="title">
            <span class="van-cell-text">网站介绍</span>
            <van-tag type="danger">官方</van-tag>
          </template>
        </van-cell>
        <van-cell title="线下门店" icon="location" isLink></van-cell>
      </van-cell-group>
      <!-- detail -->
      <van-cell-group class="goods-cell-group">
        <van-cell title="查看商品详情" isLink @click="popupVisible = !popupVisible"></van-cell>
      </van-cell-group>
      <!-- goods action -->
      <van-goods-action>
        <van-goods-action-mini-btn icon="chat">
          客服
        </van-goods-action-mini-btn>
          <van-goods-action-mini-btn icon="cart" :info="`${cartCount}`" to="/cart">
            购物车
          </van-goods-action-mini-btn>
        <van-goods-action-big-btn @click="addToCart">
          加入购物车
        </van-goods-action-big-btn>
        <van-goods-action-big-btn primary>
          立即购买
        </van-goods-action-big-btn>
      </van-goods-action>
      <van-popup
        v-model="popupVisible"
        position="bottom"
      >
        <van-tabs :active="0" sticky>
          <van-tab title="简介">
            <van-cell v-html="goods.brief" />
          </van-tab>
          <van-tab title="详情">
            <van-cell v-html="goods.detail" />
          </van-tab>
        </van-tabs>
      </van-popup>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapState } from "vuex";
import { mapCommodityToGoods } from "../../utils";

export default {
  data() {
    return {
      goods: null,
      sheetVisible: false,
      detailVisible: true,
      commodity_num: 1,
      loading: true,
      popupVisible: false
    };
  },
  computed: mapState({
    cartCount: state => state.cart && state.cart.length
  }),
  methods: {
    ...mapMutations({
      setCartInfo: "SET_CART_INFO",
      setAppTitle: "SET_APP_TITLE"
    }),
    formatPrice(p) {
      return `¥${p.toFixed(2)}`;
    },
    fetchGoodsDetail() {
      let itemId = this.$route.params.id;

      this.$http
        .get(`/api/goods/${itemId}`)
        .then(data => {
          this.goods = data;
          this.setAppTitle(data.title);
          this.loading = false;
        })
        .catch(err => {
          this.$toast("网络错误，请刷新再试！");
        });
    },
    fetchCartCount() {
      this.$http
        .get("/api/cart/count")
        .then(resp => resp.data)
        .then(data => {
          if (data.code === 0) {
            this.cartCount = data.cartCount;
          }
        })
        .catch(err => {
          this.$toast("获取购物车数据失败！");
        });
    },
    addToCart: function() {
      this.$http
        .post("/api/cart", {
          goods_uid: this.goods.uid,
          goods_num: this.commodity_num
        })
        .then(this.setCartInfo)
        .then(data => {
          this.$toast("商品已加入购物车中，再看看其他商品吧！");
        })
        .catch(err => {
          this.$toast("加入购物车失败，请刷新再试！");
        });
    }
  },
  created() {
    this.fetchGoodsDetail();
  }
};
</script>
