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
