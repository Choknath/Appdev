<template>
  <div>
    <h1 class="text-center">ITEMS</h1>

    <v-container>
      <!-- Product Catalog -->
      <v-row>
        <v-col v-for="(product, index) in products" :key="index" cols="12" md="4">
          <v-card>
            <v-img :src="product.media_url" alt="product.name"></v-img>
            <v-card-title>{{ product.product_name }}</v-card-title>
            <v-card-subtitle>{{ product.description }}</v-card-subtitle>
            <v-card-actions>
              <v-btn @click="chatToSeller(product)">Chat to Seller</v-btn>
              <v-btn @click="viewProductDetails(index)">View Details</v-btn>
            </v-card-actions>
          </v-card>

          <!-- Modal for each product -->
          <v-dialog v-model="selectedProduct.dialog" max-width="600">
            <v-card>
              <v-card-title>{{ selectedProduct.product_name }}</v-card-title>
              <v-card-subtitle>{{ selectedProduct.description }}</v-card-subtitle>
              <v-card-text>{{ selectedProduct.price }}</v-card-text>
              <v-card-actions>
                <v-btn @click="closeProductDetails">Close</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-col>
      </v-row>
    </v-container>
    
     <!-- Bottom Navigation -->
   <v-bottom-navigation v-model="value" color="teal" grow>
    <v-btn to="/Home">
      <v-icon>mdi-account-group</v-icon>
      <div class="text" v-if="isLargeScreen">Community</div>
    </v-btn>

    <v-btn to="/Market">
      <v-icon>mdi-shopping</v-icon>
      <div class="text" v-if="isLargeScreen">Market</div>
    </v-btn>

    <v-btn to="/Event">
      <v-icon>mdi-calendar</v-icon>
      <div class="text" v-if="isLargeScreen">Event</div>
    </v-btn>

    <v-btn to="/Messages">
      <v-icon>mdi-message</v-icon>
      <div class="text" v-if="isLargeScreen">Messages</div>
    </v-btn>

    <v-btn to="/Profile">
      <v-icon>mdi-account</v-icon>
      <div class="text" v-if="isLargeScreen">Profile</div>
    </v-btn>
  </v-bottom-navigation>
  </div>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      products: [],
      selectedProduct: {
        product_name: "",
        description: "",
        price: "",
        dialog: false,
      },
      value: 0,
    };
  },
  created() {
    this.getProducts();
    this.$router = useRouter();
    this.checkScreenSize();
    window.addEventListener('resize', this.checkScreenSize);
    this.getProducts();
  },
  destroyed() {
    window.removeEventListener('resize', this.checkScreenSize);
  },
  methods: {
    checkScreenSize() {
      this.isLargeScreen = window.innerWidth >= 768;
    },
    async getProducts() {
      try {
        const response = await axios.get('/Items');
        this.products = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    chatToSeller(product) {
      console.log(`Chatting to the seller of ${product.product_name}`);
      // Implement chat to seller functionality here
    },
    viewProductDetails(index) {
      this.selectedProduct = { ...this.products[index], dialog: true };
    },
    closeProductDetails() {
      this.selectedProduct.dialog = false;
    },
  },
};
</script>

<style>
@import'../assets/asset/css/product.css';
</style>
