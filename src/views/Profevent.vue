<template>
    <Eventprof/>
    <DisEvent/>
  </template>
  
  <script>
  import { defineComponent } from 'vue';
  
  // Components
  import Eventprof from '../components/Evetnprof.vue';
  import DisEvent from '../components/DisEvent.vue';
  
  export default defineComponent({
    name: 'Profevent',
  
    components: {
      Eventprof, DisEvent,
    },
  });
  </script>

<!-- ito ay para sa mga evnt na si user lang ang nag post at yung kayang lang ang ma kukuha sa profile -->
  
