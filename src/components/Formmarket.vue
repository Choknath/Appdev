<template>
  <div>
    <v-container>
      <!-- Form for adding a new product with image upload -->
      <v-form @submit.prevent="save">
        <!-- Product Name, Description, Price, and Category inputs -->
        <v-text-field v-model="product_name" label="Product Name"></v-text-field>
        <v-text-field v-model="product_description" label="Product Description"></v-text-field>
        <v-text-field v-model="product_price" label="Product Price"></v-text-field>
        <v-text-field v-model="product_category" label="Product Category"></v-text-field>

        <!-- Image Upload -->
        <v-row>
          <v-col>
            <v-file-input
              v-model="product_image_url"
              label="Product Image"
              accept="image/*"
              show-size
              small-chips
              chips
            ></v-file-input>
          </v-col>
          <v-col>
            <v-icon>mdi-image</v-icon>
          </v-col>
        </v-row>

        <!-- Add Product Button -->
        <v-btn type="submit" @click="redirectToProduct">Submit</v-btn>
      </v-form>
    </v-container>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      product_name: "",
      product_description: "",
      product_price: "",
      product_category: "",
      product_image_url: "",
    };
  },
  methods: {
    redirectToProduct() {
      this.$router.push('/Products');
    },
    async save() {
      const token = sessionStorage.getItem('verification_token');
      try {
        const response = await axios.post('/insertProduct', {
          verification_token: token,
          product_name: this.product_name,
          product_description: this.product_description,
          product_price: this.product_price,
          product_category: this.product_category,
          product_image_url: this.product_image_url,
        });

        console.log(response.data);  // Log the response data

        // Handle the response as needed
      } catch (error) {
        console.error('Error:', error);
        // Handle the error, log it, or show a user-friendly message
      }
    },
  },
};
</script>

<style scoped>
@import '../assets/asset/css/Profile.css';
/* Additional styling for the product page, if needed */
</style>
