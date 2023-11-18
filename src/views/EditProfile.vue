<template>
    <EditProf/>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import EditProf from '../components/EditProf.vue';
  
  export default defineComponent({
    name: 'EditProfile',
  
    components: {
      EditProf,
    },
  });
  </script>
  