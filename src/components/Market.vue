<template>
  <div>
<H1>STORE</H1>
    <!-- Product Catalog -->
    <v-layout class="overflow-visible" style="height: calc(100vh - 56px);">
      <!-- Your product catalog content here -->
      <div v-for="(product, index) in products" :key="index">
        <v-card>
          <v-img :src="product.image" alt="product.name"></v-img>
          <v-card-title>{{ product.name }}</v-card-title>
          <v-card-subtitle>{{ product.description }}</v-card-subtitle>
          <v-card-actions>
            <v-btn @click="addToCart(product)">Add to Cart</v-btn>
            <v-btn @click="openModal(index)">View Details</v-btn>
          </v-card-actions>
        </v-card>

        <!-- Modal for each product -->
        <v-dialog v-model="product.dialog" max-width="600">
          <v-card>
            <!-- Your modal content goes here -->
            <v-card-title>{{ product.name }}</v-card-title>
            <v-card-subtitle>{{ product.description }}</v-card-subtitle>
            <v-card-text>Price: ${{ product.price.toFixed(2) }}</v-card-text>
            <v-card-actions>
              <v-btn @click="closeModal(index)">Close</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </div>
    </v-layout>

    <!-- Bottom Navigation -->
    <v-layout class="overflow-visible" style="height: 56px;">
  <v-bottom-navigation v-model="value" color="teal" grow>
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
</v-layout>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "/product1.jpg",
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "/product2.jpg",
          dialog: false,
        },
        // Add more products here
      ],
      value: 0,
    };
  },
  methods: {
    addToCart(product) {
      // Implement cart functionality here
      console.log(`Added ${product.name} to the cart.`);
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

<style scoped>
/* Additional styling for the bottom navbar */
.bottom-navbar {
  position: absolute;
  bottom: 0;
  width: 100%;
  background-color: #fff; /* Adjust the background color as needed */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
}

</style>
