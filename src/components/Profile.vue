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
        </v-menu>
      </v-row>
    </v-container>

    <!-- Bottom Navigation -->
    <v-bottom-navigation v-model="value" color="teal" grow>
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
      <v-btn>
        <v-icon> <!-- Add your icon here -->
        </v-icon>
      </v-btn>
    </v-bottom-navigation>
  </div>
</template>

<!-- <script>
import axios from 'axios';

export default {
  data() {
    return {
      value: 0,
      user: [],
    };
  },
  created() {
    // this.getInfo()
    this.getuser()
  },
  methods: {
    async getuser(){
      try {
        const prof = await axios.get('/userprofile')
        this.user = prof.data;
      } catch (error) {
        console.log(error)
      };
    },
    editProfile() {
      // Add logic to navigate to the edit profile page
      this.$router.push('/edit-profile');
    },
   /* async getInfo() {
      try {
        const response = await axios.get('c:\Users\Mark Jober Laudencia\Downloads\Community Cyclist Club.png');
        this.user = response.data;
      } catch (error) {
        console.log(error);
      }
    },*/
    goToEditProfile() {
      // Add navigation logic to the Edit Profile page
      this.$router.push('/EditProf');
    },
    navigateTo(route) {
      // Add navigation logic for the bottom navigation buttons
      this.$router.push(route);
    },
  },
};
</script> -->

<script>
import axios from 'axios';

export default {
  data() {
    return {
      value: 0,
      user:{},
    };
  },
  created() {
    this.getProfile();
  },  
  methods: {
    async getProfile() {
      try {
        const id= sessionStorage.getItem("verification_token")
        const response = await axios.get(`/userprofile/${id}`, {
          id:id
        }); // Use the correct API endpoint
        this.user = response.data.info; // Assuming the API returns an array with a single user object
      } catch (error) {
        console.log(error);
      }
    },
    editProfile() {
      // Add logic to navigate to the edit profile page
      this.$router.push('/edit-profile');
    },
    goToEditProfile() {
      // Add navigation logic to the Edit Profile page
      this.$router.push('/EditProf');
    },
    navigateTo(route) {
      // Add navigation logic for the bottom navigation buttons
      this.$router.push(route);
    },
  },
};
</script>


<style scoped>
@import'../assets/asset/css/Profile.css';
</style>
