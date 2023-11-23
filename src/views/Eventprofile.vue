<template>
    <ProfileEvent/>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import ProfileEvent from '../components/ProfEvent.vue';
  
  export default defineComponent({
    name: 'EditProfile',
  
    components: {
      ProfileEvent,
    },
  });
  </script>
  