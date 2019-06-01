<template>
<div class='page-profile'>
    <div v-if="!userInfo">
        加载中...
    </div>
    <div v-else>
        <van-row class='user-header'>
            <img class='user-poster' src='/images/common/uc-bg.jpg'>
            <img class='user-avatar' :src='userInfo.avatar'>
            <p class="user-name">{{userInfo.nickname}}</p>
        </van-row>
        <van-row class='user-links'>
        <van-col span='6'>
            <router-link to="/orderlist?type=unpay">
                <van-icon name='pending-payment' />
                待付款
            </router-link>
        </van-col>
        <van-col span='6'>
            <router-link to="/orderlist?type=used">
                <van-icon name='pending-orders' />
                已完成
            </router-link>
        </van-col>
        <van-col span='6'>
            <router-link to="/orderlist?type=payed">
                <van-icon name='pending-deliver' />
                待使用
            </router-link>
        </van-col>
        <van-col span='6'>
            <router-link to="/contact">
                <van-icon name='logistics' />
                联系信息
            </router-link>
        </van-col>
        </van-row>

        <van-cell-group class='user-group'>
            <van-cell icon='records' title='全部订单' is-link to="/orderlist"/>
        </van-cell-group>

        <van-cell-group>
            <van-cell icon='exchange' title='我的积分' is-link />
            <!-- <van-cell icon='gold-coin' title='我的优惠券' is-link /> -->
            <!-- <van-cell icon='gift' title='我收到的礼物' is-link /> -->
        </van-cell-group>
    </div>
</div>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "vip-profile",
  data() {
    return {
      user: ""
    };
  },
  computed: {
    ...mapState({
      userInfo: state => state.user
    })
  },
  methods: {},
  created() {
    this.$store.commit('SET_APP_TITLE', '个人中心');
  }
};
</script>
