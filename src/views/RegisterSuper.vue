<template>
    <Adminregistration />
 
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import Adminregistration from '../components/Adminregistration.vue';
 
  
  export default defineComponent({
    name: 'ReisterSuper',
  
    components: {
      Adminregistration,
    },
  });
  </script>