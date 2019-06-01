<template>
    <div class="home-wrap">
		<carousel />
		<topic />
		<plate />
		<goods />
    </div>
</template>

<script>

import carousel from "./carousel.vue";
import topic from "./topic.vue";
import plate from "./plate.vue";
import goods from "./goods.vue";

export default {
	name: "home-container",
	components: {
		carousel,
		topic,
		plate,
		goods
	},
	created() {
		this.$store.commit('SET_APP_TITLE', '首页');
	}
};
</script>
