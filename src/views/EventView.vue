<template>
    <EventProfile/>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import EventProfile from '../components/EventProfile.vue';
  
  export default defineComponent({
    name: 'EditProfile',
  
    components: {
      EventProfile,
    },
  });
  </script>
  