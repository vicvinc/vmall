<template>
  
</template>

<script>
export default {
  name: "order-update",
  data() {
      return {
          goods: [],
          orderInfo: null
      }
  },
  methods: {
      fetchOrderInfo(oid) {
          this.$http.get(`/api/orderdetail/${oid}`)
          .then(resp => {
              this.orderInfo = resp
          })
          .catch(console.error)
      }
  },
  mounted() {
      const oid = this.$route.params.id;
      this.fetchOrderInfo(oid);
  }
};
</script>

<style>

</style>
