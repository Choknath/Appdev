<template>
  <Market />
</template>

<script>
import { defineComponent } from 'vue';

// Components
import Market from '../components/Market.vue';

export default defineComponent({
  name: 'MarketPage',

  components: {
    Market,
  },
});
</script>

