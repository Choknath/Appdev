<template>
   
    <Createshop/>
 
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
 
  import Createshop from '../components/Createshop.vue';
 
  export default defineComponent({
    name: 'CreateShop',
  
    components: {
     Createshop

    },
  });
  </script>


