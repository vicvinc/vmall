import VueRouter from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'home',
        component: require('./components/home')
    },
    {
        path: '/category',
        name: 'category',
        component: require('./components/category')
    }, 
    {
        path: '/goods/:id',
        name: 'goods',
        component: require('./components/goods')
    },
    {
        path: '/profile',
        name: 'profile',
        component: require('./components/profile')
    }, {
        path: '/topic/:id',
        name: 'topic',
        component: require('./components/topic')
    }, {
        path: '/block/:id',
        name: 'block',
        component: require('./components/block')
    }, {
        path: '/category/:id',
        name: 'category-item',
        component: require('./components/category/items')
    }, {
        path: '/cart',
        name: 'shop-cart',
        component: require('./components/cart')
    }, {
        // order detail
        path: '/order/:id',
        name: 'goods-order',
        component: require('./components/order/detail')
    }, {
        // order update
        path: '/order/update/:id',
        name: 'order-update',
        component: require('./components/order/update')
    }, {
        path: '/orderlist',
        name: 'order-list',
        component: require('./components/order/list')
    }, {
        path: '/contact',
        name: 'contact',
        component: require('./components/contact')
    }, {
        path: '/search/:keyword',
        name: 'search-result',
        component: require('./components/search')
    },
    // {
    //     path: '/address',
    //     name: 'address',
    //     component: require('./components/Address/AddressList.vue')
    // }, {
    //     path: '/add-address',
    //     name: 'add-address',
    //     component: require('./components/Address/AddressAdd.vue')
    // }, {
    //     path: '/:hashid/edit-address',
    //     name: 'edit-address',
    //     component: require('./components/Address/AddressEdit.vue')
    // }, {
    //     path: '/:hashid/choose-address',
    //     name: 'choose-address',
    //     component: require('./components/Address/AddressChoose.vue')
    // }, {
    //     path: '/ordersettle',
    //     name: 'order-settle',
    //     component: require('./components/Order/OrderSettle.vue')
    // }, {
    //     path: '/:type/orderlist',
    //     name: 'order-list',
    //     component: require('./components/Order/OrderList.vue')
    // }, {
    //     path:
    //         '/:hashid/orderdetail',
    //     name: 'order-detail',
    //     component: require('./components/Order/OrderDetail.vue')
    // }, {
    //     path:
    //         '/:hashid/orderpay',
    //     name: 'orderpay',
    //     component: require('./components/Order/OrderPay.vue')
    // }, {
    //     path:
    //         '/suggestion',
    //     name: "suggestion",
    //     component: require('./components/Suggestion/Suggestion.vue')
    // }
]

export default new VueRouter({ 
    base: '/',
    mode: 'hash',
    linkActiveClass: 'active',
    routes
});
