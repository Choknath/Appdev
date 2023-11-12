<template>
    <signin />
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import signin from '../components/signin.vue';
  
  export default defineComponent({
    name: 'SignPage',
  
    components: {
      signin,
    },
  });
  </script>
  