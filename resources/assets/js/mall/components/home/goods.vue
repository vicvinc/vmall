<template>
  <main>
    <card-list :goodsList="cardList" />
    <grid-list :goodsList="gridList" />
  </main>
</template>

<script>
import { Waterfall } from 'vant';
import cardList from '../goods/list-card';
import gridList from '../goods/list-col2';

export default {
  name: 'goods-list',
  data() {
    return {
      goodsList: [],
      cardList: [], // 3 goods
      gridList: [], // 2
      nextPage: '/api/goods',
      loading: false,
      listEnd: false
    };
  },
  components: {
    'card-list': cardList,
    'grid-list': gridList,
  },
  directives: {
    WaterfallLower: Waterfall('lower')
  },
  methods: {
    updateData(response) {
      const { current_page, total, data, next_page_url } = response;
      this.pagination = {
        curPage: current_page,
        total
      }
      this.nextPage = next_page_url;
      this.goodsList = this.goodsList.concat(data);
      this.cardList = this.goodsList.slice(0, 3);
      this.gridList = this.goodsList.slice(3, -1);
    },
    loadGoods() {
      let nextPageUrl = this.nextPage;
      if (nextPageUrl) {
        this.loading = true;
        this.$http.get(nextPageUrl)
          .then(this.updateData)
          .then(() => {this.loading = false;})
          .catch(console.error);
      } else {
        this.listEnd = true;
      }
    }
  },
  created() {
    this.loadGoods()
  }
};
</script>