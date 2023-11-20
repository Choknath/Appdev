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
      <!-- Your bottom navigation buttons here -->
      <v-btn>
  <v-icon>
    <a href="/Home">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-users" aria-hidden="true"></i>
      </div>
      <div class="text" data-type="Community" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Community
      </div>
    </a>
  </v-icon>
</v-btn>

<v-btn>
  <v-icon>
    <a href="/Event">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-calendar" aria-hidden="true"></i>
      </div>
      <div class="text" data-type="Event" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Event
      </div>
    </a>
  </v-icon>
</v-btn>

<v-btn>
  <v-icon>
    <a href="/Market">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </div>
      <div class="text" data-type="Market" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Market
      </div>
    </a>
  </v-icon>
</v-btn>
<v-btn>
  <v-icon>
    <a href="Profile">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-user"></i>
      </div>
      <div class="text" data-type="Profile" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Profile
      </div>
    </a>
  </v-icon>
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
