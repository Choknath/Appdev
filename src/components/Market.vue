<template>
<body>
<nav> <!--navbar-->
      <div>
 
        <ul>
          <li>
            <a href="/Home">
              <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <div class="text" data-type="Community">Community</div>
            </a>
          </li>
          <li>
            <a href="/Event">
              <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
              <div class="text" data-type="Event">Event</div>
            </a>
          </li>
          <li>
            <a href="/Market">
              <div class="icon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </div>
              <div class="text" data-type="Market">Market</div>
            </a>
          </li>
          <li>
            <a href="Profile">
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <div class="text" data-type="Profile">Profile</div>
            </a>
          </li>
        </ul>
      </div>
    </nav><!--end of navbar-->
    
    
  </body>
<br>
<br>
<br>

  <div class="product-catalog">
      <div class="product" v-for="(product, index) in products" :key="index">
          <img :src="product.image" :alt="product.name" />
          <h3>{{ product.name }}</h3>
          <p>{{ product.description }}</p>
          <span class="price">{{ `$${product.price.toFixed(2)}` }}</span>
          <button @click="addToCart(product)">Add to Cart</button>
      </div>
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
              },
              {
                  name: "Product 2",
                  description: "Description of Product 2",
                  price: 19.99,
                  image: "/product2.jpg",
              },
              {
                  name: "Product 3", // Add more products here
                  description: "Description of Product 3",
                  price: 29.99,
                  image: "/product3.jpg",
              },
              {
                  name: "Product 4", // Add more products here
                  description: "Description of Product 4",
                  price: 39.99,
                  image: "/product4.jpg",
              },
              // Add as many products as you need
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
@import'../assets/asset/css/navbar.css';
@import'../assets/asset/css/market.css';
</style>
