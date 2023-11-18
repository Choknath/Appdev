<!-- Profile.vue -->

<template>
  <v-container fluid>
    <v-row justify="center" align="center">
      <v-avatar color="brown" size="120">
        <span class="text-h5">{{ user.initials }}</span>
      </v-avatar>
      <v-col class="profile-info">
        <h2>{{ user.fullName }}</h2>
        <p class="text-subtitle-1">{{ user.email }}</p>
        <v-divider class="my-3"></v-divider>
        <v-btn rounded variant="outlined" @click="editProfile">Edit Profile</v-btn>
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
</template>

<script>
export default {
  data: () => ({
    user: {
      initials: 'CP',
      fullName: 'Cris Paul Mavida',
      email: 'chocknath@gmail.com',
    },
  }),
  methods: {
    editProfile() {
      // Add logic to navigate to the edit profile page
      this.$router.push('/edit-profile');
    },
  },
};
</script>

<style scoped>
/* Add your scoped styles for the Profile.vue component */
.profile-info {
  text-align: center;
  margin-left: 20px;
}

.profile-info h2 {
  margin-bottom: 8px;
}

.profile-info p {
  color: #888;
  margin-bottom: 16px;
}

.profile-info v-btn {
  color: #fff;
  background-color: teal;
}
</style>
