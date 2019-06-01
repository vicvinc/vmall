<template>
    <div class="app-page">
        <nav-bar/>
        <router-view/>
        <tab-bar/>
    </div>
</template>

<script>
import { mapMutations, mapState } from "vuex";
import TabBar from "./components/_layouts/tabbar";
import NavBar from "./components/_layouts/navbar";

import router from "./router";
import store from "./store";

import flexible from "./utils/flexible";

export default {
    el: "#app",
    name: "app-root",
    router,
    store,
    components: {
        "nav-bar": NavBar,
        "tab-bar": TabBar
    },
    data() {
        return {
            value: null
        };
    },
    computed: mapState({
        userInfo: state => state.user,
        cartInfo: state => state.cart
    }),
    methods: {
        ...mapMutations({
            setUserInfo: "SET_USER_INFO",
            setCartInfo: "SET_CART_INFO",
            setAppTitle: "SET_APP_TITLE"
        }),
        // fetch user info
        fetchUser() {
            let token = localStorage.getItem("token");
            if (this.userInfo && token) {
                return;
            }
            this.$http
                .get("/api/userinfo")
                .then(data => {
                    let { token, id, avatar, name, nickname } = data;
                    let user = {
                        token,
                        id,
                        avatar,
                        name,
                        nickname
                    };
                    this.setUserInfo(user);
                    localStorage.setItem("token", token);
                })
                .catch(err => {
                    this.$toast({
                        message: "获取用户信息失败，请刷新再试一试",
                        duration: 2000
                    });
                });
        },
        // fetch shop config
        fetchConfig() {
            this.$http.get("/api/config").then(data => {
                this.setAppTitle(data.config_name);
            });
        },
        // fetch cart goods
        fetchCart() {
            this.$http
                .get("api/cart")
                .then(this.setCartInfo)
                .catch(console.error);
        }
    },
    created() {
        this.fetchUser();
        this.fetchConfig();
        this.fetchCart();
    },
    mounted() {
        // init flexible layout
        flexible(window, document);
    }
};
</script>
