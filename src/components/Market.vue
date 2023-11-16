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
              <v-card-title>{{ product.name }}</v-card-title>
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
      products: [
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 1",
          description: "Description of Product 1",
          price: 10.99,
          image: "product1.jpg", // Update with correct image paths
          dialog: false,
        },
        {
          name: "Product 2",
          description: "Description of Product 2",
          price: 19.99,
          image: "product2.jpg", // Update with correct image paths
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

<style>
/* Additional styling for the page */
.title {
  text-align: center;
  font-size: 2em;
  color: #333;
  margin-bottom: 20px;
}

/* Styling for the product catalog */
.product-catalog {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around; /* Center-align items */
  background: #f5f5f5; /* Light background color */
  padding: 20px; /* Padding for better spacing */
}

/* Styling for individual product cards */
.product {
  margin: 15px;
  padding: 15px;
  border: 2px solid #ddd;
  width: 220px;
  text-align: center;
  background-color: #fff;
  transition: transform 0.3s ease-in-out;
}

.product:hover {
  transform: scale(1.05);
}

.product img {
  max-width: 100%;
  height: auto;
  border: 1px solid #ddd;
}

.product h3 {
  font-size: 1.3rem;
  margin: 12px 0;
  color: #3366cc;
}

.product p {
  font-size: 1rem;
  margin: 8px 0;
}

.product .add-to-cart-btn,
.product .view-details-btn {
  background-color: #ff6600;
  color: #fff;
  border: none;
  padding: 8px 12px;
  cursor: pointer;
}

.product .add-to-cart-btn:hover,
.product .view-details-btn:hover {
  background-color: #e65100;
}

/* Additional styling for the bottom navbar */
.bottom-navbar {
  position: fixed;
  bottom: 0;
  width: 100%;
  background-color: #333;
  color: #fff;
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
}

.nav-btn {
  text-decoration: none;
  color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.nav-btn .text {
  font-size: 12px;
  margin-top: 2px;
}

.nav-btn:hover {
  text-decoration: underline;
}
</style>
