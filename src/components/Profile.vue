<!-- pag mamayari din ito ni ProfilePage -->

<template>
  <div>
    <!-- Profile Container -->
    <v-container class="profile-container">
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
      </v-row>
      <v-row justify="center" class="mt-3"> <!-- Added margin-top for spacing -->
        <v-btn class="mx-2" to="/Items">Shop</v-btn>
        <v-btn class="mx-2" to="/Events">Events</v-btn>
        <v-btn outlined class="logout-btn" @click="logout">
    Logout
  </v-btn>
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
    };
  },
  created() {
    this.getProfile();
    // Fetch events or initialize events array as needed
    // this.getEvents();
    // Check the screen size on component creation
    this.checkScreenSize();
  
  // Add a listener for screen size changes
  window.addEventListener('resize', this.checkScreenSize);
  },
  destroyed() {
      // Remove the listener when the component is destroyed
      window.removeEventListener('resize', this.checkScreenSize);
    },
  methods: {
    checkScreenSize() {
        // Update isLargeScreen based on the screen width
        this.isLargeScreen = window.innerWidth >= 768; // Adjust the breakpoint as needed
      },
      async logout() {
    try {
      // Assuming you have an endpoint in your backend to handle logout
      await axios.post('/logout');
      
      // Clear the sessionStorage and navigate to the login page or home page
      sessionStorage.removeItem("verification_token");
      this.$router.push('/'); // Adjust the route as needed
    } catch (error) {
      console.error(error);
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
    editProfile() {
      this.$router.push('/edit-profile');
    },
    goToEditProfile() {
      this.$router.push('/EditProf');
    },
    navigateTo(route) {
      this.$router.push(route);
    },
    addEvent() {
      if (this.newEvent.name && this.newEvent.date && this.newEvent.description) {
        this.events.push({ ...this.newEvent });
        this.newEvent = { name: "", date: "", description: "" };
      }
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

<style scoped>
@import '../assets/asset/css/Profile.css';
/* Additional styling for the event page, if needed */
</style>
