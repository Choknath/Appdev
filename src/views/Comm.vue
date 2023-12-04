<template>
    <Coms/>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import Coms from '../components/Coms.vue';
  
  export default defineComponent({
    name: 'Comm',
  
    components: {
      Coms,
    },
  });
  </script>
  