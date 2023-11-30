<template>
    <managevent />
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import managevent from '../components/managevent.vue';
  
  export default defineComponent({
    name: 'Eventmanagement  ',
  
    components: {
        managevent
    },
  });
  </script>
  