<template>
  <div>
    <!-- Profile Container -->
    <v-container class="profile-container">
      <v-row justify="center">
        <v-menu min-width="200px" rounded>
          <template v-slot:activator="{ props }">
            <v-btn icon v-bind="props">
              <v-avatar color="teal" size="120">
                <span class="text-h5">{{ user.initials }}</span>
              </v-avatar>
            </v-btn>
          </template>
          <v-card class="profile-card">
            <v-card-text>
              <div class="mx-auto text-center">
                <v-avatar color="teal" size="120">
                  <span class="text-h5">{{ user.initials }}</span>
                </v-avatar>
                <h3 class="profile-name">{{ user.fullName }}</h3>
                <p class="text-subtitle-1">{{ user.email }}</p>
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

<script>
import axios from 'axios';

export default {
  data() {
    return {
      value: 0,
      user: {
        initials: 'MJ',
        fullName: 'MARK JOBER LAUDENCIA',
        email: 'laudenciamj3@gmail.com',
      },
      info: [],
    };
  },
  created() {
    this.getInfo();
  },
  methods: {
    editProfile() {
      // Add logic to navigate to the edit profile page
      this.$router.push('/edit-profile');
    },
    async getInfo() {
      try {
        const response = await axios.get('c:\Users\Mark Jober Laudencia\Downloads\Community Cyclist Club.png');
        this.user = response.data;
      } catch (error) {
        console.log(error);
      }
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
/* Your scoped styles for the profile page */
.profile-container {
  background-color: #f4f4f4;
  padding: 20px;
  border-bottom: 1px solid #ddd;
}

.profile-card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.profile-name {
  color: #333;
  margin-bottom: 8px;
}

.text-subtitle-1 {
  color: #888;
  margin-bottom: 16px;
}

.edit-profile-btn {
  color: teal;
}
</style>
