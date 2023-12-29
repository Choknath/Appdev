<template>
 hello 
  </template>
  
<script>
  import { defineComponent } from 'vue';
  
  // Components
  import test1 from '../components/test1component.vue';
  
  export default defineComponent({
    name: 'test1',
  
    components: {
      test1,
    },
  });
  </script>
  