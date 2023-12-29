<!-- ShopPage.vue -->

<template>
  <Distore/>
</template>

<script>
import { defineComponent } from 'vue';

//components
import Distore from'../components/Distore.vue';

export default defineComponent({
  name: 'ShopPage',
  
  components: {
    Distore,
  },
});
</script>
