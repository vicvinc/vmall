<template>
    <div class="page-order">
        <van-tabs
          class="order-list-nav"
          :active="active"
          @click="tabHandler"
          sticky
        >
          <van-tab title="全部订单" />
          <van-tab title="待付款" />
          <van-tab title="已付款" />
        </van-tabs>
        <van-row gutter="16" class="order-list">
            <van-col
              span="24"
              v-for="(order,index) in orders"
              :key="index"
            >
              <van-panel :status="order.pay_status">
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
                        v-for="(detail, index) in order.details"
                        :key="index"
                    >
                        <img class="thumbnail" :src="detail.goods_thumbnail" />
                        <div class="detail">
                            <p class="description">{{detail.goods_name}}</p>
                            <p class="info">
                                <span class="actprice">
                                    &yen;{{detail.goods_actprice | transformPrice}}
                                </span>
                                <span class="number">
                                    {{detail.goods_num}}件
                                </span>
                            </p>
                        </div>
                    </van-col>
                  </van-row>
                </div>
                <!-- order footer -->
                <div slot="footer" class="p-right">
                  <van-button size="mini" @click.stop="removeOrder(order.uid)">删除</van-button>
                  <van-button size="mini" type="danger">去支付</van-button>
                </div>
              </van-panel>
            </van-col>
        </van-row>
        <div id="data-scroll-loading" v-show="isLoading">
            <mt-spinner type="snake" color="#09bb07" :size="15"></mt-spinner>
        </div>
        <div id="data-scroll-end" v-show="isEnd">
            没有更多订单了:)
        </div>
    </div>
</template>

<script>
import { Navbar, TabItem, Spinner, Toast } from "mint-ui";
export default {
  data() {
    return {
      active: 0,
      orderType: 'all',
      paginate: {},
      orders: [],
      isLoading: false,
      isEnd: false
    };
  },
  components: {
    Navbar,
    TabItem,
    Spinner,
    Toast
  },
  created() {
    let orderType = this.$route.query.type || 'all';
    const typeList = 'all,unpay,payed'.split(',');
    
    this.active = typeList.indexOf(orderType);

    this.fetchOrders(orderType);
  },
  methods: {
    tabHandler(index = 0) {
      const handlerEvent = 'all,unpay,payed'.split(',');
      this.fetchOrders(handlerEvent[index]);
    },
    removeOrder(uid) {
      // delete order according to order number not is own id
      this.$http.delete(`/api/order/delete/${uid}`)
      .then(() => {
        this.$toast('删除成功！');
        this.orders = this.orders.filter(item => item.uid !== uid);
      })
      .catch(err => {
        this.$toast('网络错误，请稍后再试！');
      })
    },
    fetchOrders(type = 'all') {
      this.$router.push({
        name: 'order-list',
        query: {
          type
        }
      });
      this.fetchOrderList(type);
    },
    fetchOrderList(type) {
      this.$http.get(`/api/orderlist/${type}`)
        .then(data => {
          this.nextUrl = data.next_page_url
          return data.data
        })
        .then(data => {
          this.orders = data
        })
        .catch(err => {
          this.$toast('网络错误，请稍后再试！');
        });
    }
  }
};
</script>
