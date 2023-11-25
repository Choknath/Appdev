<template>
    <v-card>
      <v-card-title>Insert New Product</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="insertProduct">
          <!-- Media URL -->
          <v-text-field v-model="newProduct.media_url" label="Media URL"></v-text-field>
  
          <!-- Product Name -->
          <v-text-field v-model="newProduct.product_name" label="Product Name"></v-text-field>
  
          <!-- Description -->
          <v-text-field v-model="newProduct.description" label="Description"></v-text-field>
  
          <!-- Price -->
          <v-text-field v-model="newProduct.price" label="Price"></v-text-field>
  
          <!-- Submit Button -->
          <v-btn type="submit">Submit</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
    
     <!-- Bottom Navigation -->
   <v-bottom-navigation v-model="value" color="teal" grow>
        <v-btn to="/Home">
          <v-icon>mdi-account-group</v-icon>
          <div class="text">Community</div>
        </v-btn>

        <v-btn to="/Market">
          <v-icon>mdi-shopping</v-icon>
          <div class="text">Market</div>
        </v-btn>

        <v-btn to="/Event">
          <v-icon>mdi-calendar</v-icon>
          <div class="text">Event</div>
        </v-btn>

        <v-btn to="/Profile">
          <v-icon>mdi-account</v-icon>
          <div class="text">Profile</div>
        </v-btn>
      </v-bottom-navigation>

  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        newProduct: {
          media_url: '',
          product_name: '',
          description: '',
          price: '',
        },
      };
    },
    methods: {
      async insertProduct() {
        try {
          // Perform your Axios request here to insert the product
          const response = await axios.post('/api/products', this.newProduct);
          console.log(response.data);
  
          // Optionally, you can clear the form here
          this.newProduct = {
            media_url: '',
            product_name: '',
            description: '',
            price: '',
          };
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  