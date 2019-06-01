<template>
  <section class="carousel-wrap">
    <van-swipe :autoplay="3000">
      <van-swipe-item
        v-for="banner in banners"
        :key="banner.img_url"
      >
        <router-link
          to="/"
          class="swipe-img"
          :style="{ background: 'url(' + banner.thumbnail + ') center / cover no-repeat' }"
        >
        </router-link>
      </van-swipe-item>
    </van-swipe>
  </section>
</template>
<script>
export default {
  data() {
    return {
      banners: [],
      swipeConf: {
        speed: 300, //	duration of the animation(in millisecond)	Number		300
        auto: 300, //interval of auto-play(in millisecond)	Number		3000
        defaultIndex: 0, //	index of the initially visible slide	Number		0
        continuous: true, //	if an infinite slider without endpoints is created	Boolean		true
      }
    };
  },
  created() {
    this.fetchBanner();
  },
  methods: {
    fetchBanner() {
      this.$http
        .get('/api/banners')
        .then(data => {
          this.banners = data;
        });
    }
  }
};
</script>
