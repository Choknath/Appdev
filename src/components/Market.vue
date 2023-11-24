<template>
  <div>
    <br>
    <br>
    <h1>Market place</h1>

    <v-container>
      <!-- Product Catalog -->
      <v-row>
        <v-col v-for="(product, index) in products" :key="index" cols="12" md="4">
          <v-card>
            <v-img :src="product.media_url" alt="product.name"></v-img>
            <v-card-title>{{ product.product_name }}</v-card-title>
            <v-card-subtitle>{{ product.description }}</v-card-subtitle>
            <v-card-actions>
              <v-btn @click="addToCart(product)">Add to Cart</v-btn>
              <v-btn @click="openModal(index)">View Details</v-btn>
            </v-card-actions>
          </v-card>

          <!-- Modal for each product -->
          <v-dialog v-model="product.dialog" max-width="600">
            <v-card>
              <v-card-title>{{ product.product_name }}</v-card-title>
              <v-card-subtitle>{{ product.description }}</v-card-subtitle>
              <v-card-text>Price: ${{ product.price.toFixed(2) }}</v-card-text>
              <v-card-actions>
                <v-btn @click="closeModal(index)">Close</v-btn>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      value: 0,
      product: [],
    };
  },
  created() {
    this.getprod();
  },
  methods: {
    async getprod() {
      try {
        const response = await axios.get('/market/getData'); // Use the correct API endpoint
        this.product = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    addToCart(product) {
      // Implement cart functionality here
      console.log(`Added ${product.product_name} to the cart.`);
    },
    openModal(index) {
      this.products[index].dialog = true;
    },
    closeModal(index) {
      this.products[index].dialog = false;
    },
  },
};
</script>

<style>
@import'../assets/asset/css/product.css';
</style>
