import Vue from 'vue';

import VueRouter from 'vue-router';
import Vuex from 'vuex'
import axios from 'axios';

import Mint, { InfiniteScroll, Indicator } from 'mint-ui';
import { Waterfall, Toast } from 'vant';

import Vant from 'vant';

import App from './App.vue';

Vue.use(Mint);
Vue.use(Vant);
Vue.use(Waterfall);
Vue.use(VueRouter);
Vue.use(InfiniteScroll);

import 'mint-ui/lib/style.css';
import 'vant/lib/vant-css/index.css';

/**
 * 价格转换为0.00的浮点数
 */
Vue.filter('transformPrice', function (value) {
    if (value >= 0) {
        return parseFloat(value).toFixed(2);
    }
});

/**
 * 商品详情换行
 */
Vue.filter('rnTransform', function (value) {
    if (value) {
        return value.replace(/\r\n/g, "<br/>");
    }
});

/**
 * 数据列表无限滚动监听
 */
Vue.directive('data-scroll', function (value) {
    window.addEventListener('scroll', () => {
        let fnc = value;
        fnc();
    });
});

/**
 * 手机号隐私处理
 */
Vue.filter('transformPhone', function (value) {
    if (value) {
        let phone = value;
        let phone_head = phone.substring(0, 3);
        let phone_foot = phone.substr(7, 4);
        return phone_head + '****' + phone_foot;
    }
});

// open indicator before request is send
const requHandler = (config) => {
    Indicator.open();
    return config;
}

// close indicator and return message body
const respHandler = (resp) => {
    Indicator.close();
    const { data: { code, data, message } } = resp;

    if (code !== 0) {
        Toast(message);
        return Promise.reject(message);
    }

    return data;
}

// resp error handler
const respErrorHandler = (error) => Promise.reject(error);

axios.interceptors.request.use(requHandler);

axios.interceptors.response.use(respHandler, respErrorHandler);

Vue.prototype.$http = axios;

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

new Vue(App);
