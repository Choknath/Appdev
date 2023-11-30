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
        <v-skeleton-loader :elevation="24" type="card">
    <!-- Event Page -->
    <v-container>
      <!-- Event List -->
      
      <v-row>
        <v-col v-for="(event, index) in events" :key="index" cols="12" md="4">
          <v-card>
            <v-img :src="event.image" alt="event.name"></v-img>
            <v-card-title>{{ event.event_name }}</v-card-title>
         
            <v-card-actions>
              <v-btn @click="viewEventDetails(index)">View Details</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>

      <!-- Modal for each event -->
      <v-dialog v-model="selectedEvent.dialog" max-width="600">
        <v-card class="mx-auto">
          <v-card-title>{{ selectedEvent.event_name }}</v-card-title>
          <v-card-text>{{ selectedEvent.event_description }}</v-card-text>
          <v-card-text>{{ selectedEvent.event_location }}</v-card-text>
          <v-card-subtitle>{{ selectedEvent.event_date }}</v-card-subtitle>
          <v-card-actions>
            <v-btn @click="closeEventDetails">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    
    </v-container>
  </v-skeleton-loader>
        
     
  
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
      this.getEvent();
      // Fetch events or initialize events array as needed
      // this.getEvents();
    },
    methods: {
     
      async getEvent() {
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
      
    },
  };
  </script>
  
  <style scoped>
  @import '../assets/asset/css/Profile.css';
  /* Additional styling for the event page, if needed */
  </style>
  