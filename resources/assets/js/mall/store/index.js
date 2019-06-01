import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const SET_USER_INFO = 'SET_USER_INFO'
const GET_USER_INFO = 'GET_USER_INFO'
const SET_CART_INFO = 'SET_CART_INFO'
const SET_APP_TITLE = 'SET_APP_TITLE'

const store = {
    state: {
        user: null,
        cart: [],
        orderCart: [], // cart for order
        title: '', // global title
    },
    mutations: {
        [SET_USER_INFO](state, payload) {
            state.user = payload
        },
        [SET_CART_INFO](state, payload) {
            state.cart = payload
        },
        [SET_APP_TITLE](state, payload) {
            state.title = payload
        }
    }
}

export default new Vuex.Store(store)
