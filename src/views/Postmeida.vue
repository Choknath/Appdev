<template>
    <Meidapost />
  
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
import Meidapost from'../components/Meidapost.vue'
  
  export default defineComponent({
    name: 'ProfilePage',
  
    components: {
     Meidapost
    },
  });
  </script>