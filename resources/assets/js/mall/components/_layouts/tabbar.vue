<template>
    <div class="app-tab--bar">
        <van-tabbar v-model="selected" fixed>
            <van-tabbar-item icon="home" to="/">首页</van-tabbar-item>
            <van-tabbar-item icon="more-o" to="/category">全部</van-tabbar-item>
            <van-tabbar-item icon="cart" to="/cart" :info="`${cartCount}`">购物车</van-tabbar-item>
            <van-tabbar-item icon="contact" to="/profile" dot>用户中心</van-tabbar-item>
        </van-tabbar>
    </div>
</template>

<script>

import { mapState } from 'vuex';

export default {
	name: 'app-tab-bar',
	data() {
		return {
			selected: 0,
			active: true
		};
	},
	computed: mapState({
		cartCount: state => state.cart && state.cart.length,
	})
};
</script>

