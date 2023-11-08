<template>
  <HomeEvent />
</template>

<script>
import { defineComponent } from 'vue';

// Components
import HomeEvent from '../components/HomeEvent.vue';

export default defineComponent({
  name: 'HomeView',

  components: {
    HomeEvent,
  },
});
</script>
