<!-- kakambal ito ni DisEvent -->
<!-- Profevent and may ari nito -->
<template>
   
  <div>
    <!-- Profile Container -->
    <v-container class="profile-container">
      <v-skeleton-loader :elevation="24" type="card">
      <v-row justify="center">
        <v-menu min-width="200%" rounded>
          <template v-slot:activator="{ props }"> 
            <v-btn icon v-bind="props" size="120">
              <img :src="user.profile_picture_url" alt="Profile">
            </v-btn>
          </template>
            
          <v-card class="profile-card">
            <v-card-text>
              <div class="mx-auto text-center"> 
                <v-avatar color="teal" size="120">
                  <span class="text-h5">{{ user.full_name}}</span>
                </v-avatar>
                <h3 class="profile-name">{{ user.email }}</h3>
                <p class="text-subtitle-1">{{ user.bio }}</p>
                <v-divider class="my-3"></v-divider>
                <v-btn outlined class="edit-profile-btn" @click="goToEditProfile">
                  Edit Profile
                </v-btn>
              </div>
            </v-card-text>
          </v-card>
        </v-menu>

        <v-col v-for="(product, index) in products" :key="index" cols="12" md="4">
          <v-card>
            <v-img :src="product.media_url" alt="product.name"></v-img>
            <v-card-title>{{ product.product_name }}</v-card-title>
            <v-card-subtitle>{{ product.description }}</v-card-subtitle>
            <v-card-actions justify="center">
              <v-btn  @click="viewProductDetails(index)">View Details</v-btn>
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
        </v-skeleton-loader>
      <v-row justify="center" class="mt-3"> <!-- Added margin-top for spacing -->
        <v-btn class="mx-2" to="/Profile">Go Back</v-btn>
        <v-btn class="mx-2" to="/items">Items</v-btn>
        <v-btn class="mx-2" to="/Products">Sell Items</v-btn>
        <v-btn class="mx-2" to="/CreateShop">Register Shop</v-btn>
      </v-row>
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

    </v-container>
  </div>
</template>

<script>
import axios from 'axios';

export default {
data() {
  return {
    value: 0,
    user: {},
    products: [],
      selectedProduct: {
        product_name: "",
        description: "",
        price: "",
        dialog: false,
      },
  };
},
async mounted() {
    try {
        await this.diplayitem();
      } catch (error) {
        console.error('Error fetching posts:', error);
        // Handle the error, e.g., show an error message to the user
      }
  },
created() {
  this.getProfile();
  // Fetch events or initialize events array as needed
  // this.getEvents();
  this.checkScreenSize();
  this.diplayitem();

// Add a listener for screen size changes
window.addEventListener('resize', this.checkScreenSize);
},
destroyed() {
    // Remove the listener when the component is destroyed
    window.removeEventListener('resize', this.checkScreenSize);
  },
methods: {
  viewProductDetails(index) {
      this.selectedProduct = { ...this.products[index], dialog: true };
    },
    closeProductDetails() {
      this.selectedProduct.dialog = false;
    },
  checkScreenSize() {
      // Update isLargeScreen based on the screen width
      this.isLargeScreen = window.innerWidth >= 768; // Adjust the breakpoint as needed
    },

    async diplayitem() {
    try {
      const id = sessionStorage.getItem("verification_token");
      const response = await axios.get(`/ownitems/${id}`, {
        id: id
      });
      this.products = response.data;  // Update items array with the received data
      this.loading = false;
    } catch (error) {
      console.error('Error fetching events:', error);
      // Handle the error, e.g., show an error message to the user
      throw error;
    }
  }, 

  async getProfile() {
    try {
      const id = sessionStorage.getItem("verification_token")
      const response = await axios.get(`/userprofile/${id}`, {
        id: id
      });
      this.user = response.data.info;
    } catch (error) {
      console.log(error);
    }
  },
  // editProfile() {
  //   this.$router.push('/edit-profile');
  // },
  goToEditProfile() {
    this.$router.push('/EditProf');
  },

  viewEventDetails(index) {
    this.selectedEvent = { ...this.events[index], dialog: true };
  },
  closeEventDetails() {
    this.selectedEvent.dialog = false;
  },
},
};
</script>
