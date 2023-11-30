<template>
    <Eventprof/>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import Eventprof from '../components/Evetnprof.vue';
  
  export default defineComponent({
    name: 'Profevent',
  
    components: {
      Eventprof,
    },
  });
  </script>
  