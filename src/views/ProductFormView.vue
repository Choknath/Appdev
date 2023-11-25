<template>
  <ProdForm />
</template>

<script>
import { defineComponent } from 'vue';

// Components
import ProdForm from '../components/ProdForm.vue';

export default defineComponent({
  name: 'ProductFormView',

  components: {
    ProdForm,
  },
});
</script>

