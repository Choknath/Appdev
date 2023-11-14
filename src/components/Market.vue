<template>
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
  
  <div>
    <section class="market">
      <h2>E-commerce Section</h2>
      <div class="product-catalog">
        <div class="product" v-for="(product, index) in products" :key="index">

          <img :src="product.image" :alt="product.name" />
          <h3>{{ product.name }}</h3>
          <p>{{ product.description }}</p>
          <span class="price">{{ `$${product.price.toFixed(2)}` }}</span>
          <button @click="addToCart(product)">Add to Cart</button>
      </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
 HEAD
    return {
      value: 1,
      products: [
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "/product1.jpg", // Update the image path as per your file structure
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "/product2.jpg", // Update the image path as per your file structure
        },
        // Add more products here
      ],
    };
  },
  methods: {
      addToCart(product) {
          // Implement cart functionality here
          console.log(`Added ${product.name} to the cart.`);
      },
  },
};
</script>

<style>
@import'../assets/asset/css/market.css';
</style>
