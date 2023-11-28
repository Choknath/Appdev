<template>
  <div>
    <!-- Profile Container -->
    <v-container class="profile-container">
      <v-row justify="center">
        <v-menu min-width="200%" rounded>
          <template v-slot:activator="{ props }">
            <v-avatar  size="150">
              <span class="text-h5">{{ user.username }}</span>
            </v-avatar>
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

          <!-- Event List -->
          <v-row>
            <v-col v-for="(event, index) in events" :key="index" cols="12" md="4">
              <v-card>
                <v-img :src="event.event_image_url || 'fallback_image_url.jpg'" alt="event.name"></v-img>
                <v-card-title>{{ event.event_name }}</v-card-title>
                <v-card-subtitle>{{ event.event_date }}</v-card-subtitle>
                <v-card-text>{{ event.event_description }}</v-card-text>
                <v-card-actions>
                  <v-btn @click="viewEventDetails(index)">View Details</v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-menu>
      </v-row>
       <v-card-actions>
      <router-link to="/ProfEvent" class="d-block mt-2">ADD EVENT</router-link>
    </v-card-actions>
      
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
      events: [],
      selectedEvent: {
        name: "",
        date: "",
        description: "",
        dialog: false,
      },
      newEvent: {
        name: "",
        date: "",
        description: "",
      },
    };
  },
  created() {
    this.getProfile();
    // Fetch events or initialize events array as needed
    // this.getEvents();
  },
  methods: {
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
