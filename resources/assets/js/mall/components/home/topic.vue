<template>
  <section class="topic-wrap">
    <van-row gutter="32">
      <van-col
        span="6"
        v-for="topic in topics"
        :key="topic.uid"
      >
        <div class="topic-item" @click="gotoTopic(topic)">
          <img class="topic-icon" :src="topic.thumbnail" />
          {{topic.title}}
        </div>
      </van-col>
    </van-row>
  </section>
</template>
<script>
import { mapMutations } from 'vuex';

export default {
  data() {
    return {
      topics: []
    };
  },
  created() {
    this.fetchTopic();
  },
  methods: {
    ...mapMutations({
      setAppTitle: 'SET_APP_TITLE',
    }),
    gotoTopic({id, title}) {
      this.setAppTitle(title);
      this.$router.push(`/topic/${uid}`);
    },
    fetchTopic() {
      this.$http.get("/api/topics")
        .then(data => this.topics = data)
        .catch(console.error);
    }
  }
};
</script>
