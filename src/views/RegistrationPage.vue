<template>
    <Registration />
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import Registration from '../components/Registration.vue';
  
  export default defineComponent({
    name: 'RegistrationPage',
  
    components: {
      Registration
    }
  });
  </script>
  