<!-- src/components/StoreForm.vue -->

<template>
    <v-form @submit.prevent="save">
      <v-text-field v-model="store_name" label="Store Name"></v-text-field>
      <v-text-field v-model="location" label="Location"></v-text-field>
      <v-btn type="submit">Create Store</v-btn>
    </v-form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        store_name: '',
        location: '',
      };
    },
    methods: {
      async save() {
        const verification_token = sessionStorage.getItem('verification_token');
        
        try {
          const response = await axios.post('/CreateStore', {
            verification_token: verification_token,
            store_name: this.store_name,
            location: this.location,
          });
  
          console.log(response.data);
          
          this.store_name = '';
          this.location = '';
  
          // Handle the response as needed
        } catch (error) {
          console.error('Error:', error);
          // Handle the error, log it, or show a user-friendly message
        }
      },
    },
  };
  </script>
  