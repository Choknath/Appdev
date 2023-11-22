<template>
    <Profile />
    <Feed />
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import Profile from '../components/Profile.vue';
  import Feed from '../components/Feed.vue';
  
  export default defineComponent({
    name: 'ProfilePage',
  
    components: {
      Profile,  Feed
    },
  });
  </script>