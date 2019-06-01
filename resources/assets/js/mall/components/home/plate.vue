<template>
  <section class="section-wrap plate-wrap">
      <van-row gutter="16">
        <van-col
          span="12"
          v-for="plate in plates" 
          :key="plate.id"
        >
          <router-link :to="`/block/${plate.id}`">
            <img class="plate-img" :src="plate.plate_img"/>
            <p class="plate-title">
              {{plate.plate_title}}
            </p>
          </router-link>
        </van-col>
      </van-row>
  </section>
</template>

<script>
export default {
  data() {
    return {
      plates: []
    };
  },
  created() {
    this.fetchPlates();
  },
  methods: {
    fetchPlates() {
      this.$http.get('/api/blocks')
        .then(data => (this.plates = data))
        .catch(console.error);
    }
  }
};
</script>
