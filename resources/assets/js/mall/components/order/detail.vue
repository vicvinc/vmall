<template>
    <div class="page-order">
        <van-panel>
            <!-- order header -->
            <ul slot="header" class="order-header p12">
                <li>
                    订单编号： 
                    <span class="order-info">
                        {{ order.no }}
                    </span>
                </li>
                <li>
                    联系人：
                    <span class="order-info">
                        {{order.name}}
                    </span>
                </li>
                <li>
                    联系电话：
                    <span class="order-info">
                        {{ order.phone | transformPhone }}
                    </span>
                </li>
                <li>
                    下单时间：
                    <span class="order-info">
                        {{ order.created_at }}
                    </span>
                </li>
            </ul>
            <!-- order content -->
            <div v-if="order.details && order.details.length > 0">
                <p span="24" class="p14 pd10-15 van-hairline--bottom">
                    订单详情：
                </p>
                <van-row
                    class="order-goods goods-wrap"
                    gutter="16"
                >
                <van-col
                    span="12"
                    class="goods-list"
                    v-for="detail in order.details"
                    :key="detail.uid"
                >
                    <img class="thumbnail" :src="detail.goods_thumbnail" />
                    <div class="detail">
                        <p class="description">{{detail.goods_name}}</p>
                        <p class="info">
                            <span class="actprice">
                                {{detail.goods_actprice | transformPrice}}¥
                            </span>
                            <span class="number">
                                {{detail.goods_num}}件
                            </span>
                        </p>
                    </div>
                </van-col>
                </van-row>
            </div>
        </van-panel>
        <van-cell-group>
            <van-cell title="商品总额：">
                {{order.order_amount | transformPrice}}¥
            </van-cell>
            <van-cell title="实付金额：">
                {{order.order_amount | transformPrice}}¥
            </van-cell>
        </van-cell-group>
        <van-submit-bar
            :price="order.order_amount*100"
            button-text="支付"
            @submit="payOrder"
        />
    </div>
</template>

<script>
import { Toast } from "mint-ui";

export default {
  data() {
    return {
      order: {}
    };
  },
  created() {
    this.fetchDetails();
  },
  methods: {
    fetchDetails() {
      let orderID = this.$route.params.id;
      this.$http
        .get(`/api/order/detail/${orderID}`)
        .then(data => {
          this.order = data;
        })
        .catch(console.error);
    },
    payOrder() {
      let orderID = this.$route.params.id;
      this.$http
        .post(`/api/pay/`, { orderID })
        .then(this.wxPay)
        .catch(console.error);
    },
    wxPay(config) {
      const self = this;
      wx.chooseWXPay({
        timestamp: config["timestamp"],
        nonceStr: config["nonceStr"],
        package: config["package"],
        signType: config["signType"],
        paySign: config["paySign"], // 支付签名
        success: function(res) {
          self.$toast("支付成功！");
        },
        fail: function(res) {
          self.$toast("支付失败！");
        }
      });
    }
  }
};
</script>