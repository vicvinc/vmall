<template>
  <div class="page-cart">
    <van-checkbox-group
      class="card-goods"
      v-model="checkedGoods"
    >

      <div v-if="carts.length === 0" class="empty-cate">
          <div class=" empty-container">
            <i class="empty-image" />
          </div>
          <p class="p14 p-center mt10">
            购物车空空的
          </p>
          <p class="p14 p-center mt16">
            快去商城看看吧～
          </p>
          <p class="mt16 p-center">
            <router-link to="/">
              <van-button class="btn-orange" size="small">去逛逛</van-button>
            </router-link>
          </p>
      </div>

      <van-checkbox
        class="card-goods__item"
        v-for="cart in carts"
        :key="cart.uid"
        :name="cart.uid"
      >
        <van-card
            :thumb="cart.goods.thumbnail"
        >
          <p slot="title" class="p-left p12">
            {{ cart.goods.name }}
          </p>
          <p slot="desc" class="van-card__desc p-left p12">
            {{ cart.goods_num }}件
            <span class="f-right c-red">
              {{ formatPrice(cart.goods.actprice) }}¥
            </span>
          </p>
          <div slot="footer" class="p-right">
            <van-button size="mini" @click.stop="removeCart(cart.uid)">删除</van-button>
          </div>
        </van-card>
      </van-checkbox>
    </van-checkbox-group>
    <van-submit-bar
      :price="totalPrice"
      :disabled="!checkedGoods.length"
      :button-text="submitBarText"
      @submit="submitOrder"
    >
      <van-checkbox v-model="selecteAll">全选</van-checkbox>
      <span slot="tip">
        注意：不要订阅时间冲突的课程
      </span>
    </van-submit-bar>
  </div>
</template>

<script>
import { mapMutations } from "vuex";
import { mapCommodityToGoods, noop, call } from "../../utils";

export default {
  name: "cart-center",
  data() {
    return {
      carts: [],
      checkedGoods: [],
      contact: null
    };
  },
  methods: {
    ...mapMutations({
      setOrderCart: "SET_ORDER_CART",
      setAppTitle: "SET_APP_TITLE"
    }),
    removeCart(uid) {
      this.$http
        .delete(`/api/cart/delete/${uid}`)
        .then(() => {
          this.$toast("删除成功！");
          this.carts = this.carts.filter(item => item.uid !== uid);
        })
        .catch(err => {
          this.$toast("删除失败，请稍后再试！");
        });
    },
    formatPrice(price) {
      return price.toFixed(2);
    },
    fetchDefaultContact() {
      this.$http
        .get("/api/address")
        .then(data => {
          if (data.length === 0) {
            this.$toast("还没有填写联系信息，补充联系信息后再来结算吧！");
            setTimeout(() => {
              this.$router.push("/contact");
            }, 3000);
            return Promise.reject("default address is null");
          }
          return data;
        })
        .then(call("filter", x => x.defaulted))
        .then(contactInfo => {
          this.contact = contactInfo[0];
        })
        .catch(console.error);
    },
    fetchCart() {
      this.$http
        .get("/api/cart")
        .then(data => {
          this.carts = data.map(item => ({
            ...item,
            selected: true
          }));
        })
        .catch(err => {
          this.$toast("获取购物车数据失败，请稍后再试！");
        });
    },
    noop,
    submitOrder() {
      const orderCart = this.carts.filter((item, idx) => {
        return this.checkedGoods.indexOf(item.uid) > -1;
      });

      // no goods selected
      if (orderCart.length === 0) {
        this.$toast("请选择要支付的商品信息！");
        return;
      }

      this.$http
        .post("/api/order", {
          from: "cart",
          contact: this.contact,
          goods: orderCart
        })
        .then(data => {
          this.$router.push(`/order/${data}`);
        })
        .catch(console.error);
    }
  },
  computed: {
    submitBarText() {
      const count = this.checkedGoods.length;
      return "结算" + (count ? `(${count})` : "");
    },
    totalPrice() {
      const t = this.carts.reduce((total, item) => {
        total +=
          this.checkedGoods.indexOf(item.uid) !== -1
            ? item.goods.actprice * item.goods_num
            : 0;
        return total;
      }, 0);

      return t*100;
    },
    selecteAll: {
      get: function() {
        return (
          this.checkedGoods.length === this.carts.length &&
          this.checkedGoods.length > 0 &&
          this.carts.length > 0
        );
      },
      set: function(val) {
        val === false
          ? (this.checkedGoods = [])
          : (this.checkedGoods = this.carts.map(({ uid }) => uid));
      }
    }
  },
  created() {
    this.fetchCart();
    this.fetchDefaultContact();
    this.setAppTitle("购物车");
  }
};
</script>
