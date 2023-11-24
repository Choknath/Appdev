<template>
  <body>
    <div>
      <!-- Profile Container -->
      <v-container class="profile-container">
        <v-row justify="content-start">
          <v-menu min-width="200%" rounded>
            <template v-slot:activator="{ props }">
              <v-btn icon v-bind="props" size="120" @click="redirectToPostPage">
                <!-- <img :src="user.profile_picture_url" alt="Profile"> -->
              </v-btn>
              <v-text-field v-model="journey" label="How's your journey" @click="redirectToPostPage"></v-text-field>
              <v-avatar size="150">
                <span class="text-h5">{{ posts.username }}</span>
              </v-avatar>
            </template>
          </v-menu>
        </v-row>
      </v-container>

      <!-- News Feed -->
      <v-skeleton :loading="loading" :avatar="avatarLoading" :title="titleLoading" :lines="3">
        <div v-for="post in posts" :key="post.id" class="post">
          <!-- Post Content -->
          <div class="post-content">
            <!-- ... (unchanged) ... -->
          </div>
        </div>
      </v-skeleton>

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
    </div>
  </body>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      journey: '',
      loading: false, // Add if needed
      avatarLoading: false, // Add if needed
      titleLoading: false, // Add if needed
      value: 0, // Add if needed for v-bottom-navigation
    };
  },
  methods: {
    redirectToPostPage() {
      // Use Vue Router to navigate to postpage.vue
      this.$router.push('/postpage');
    },
    // ... (other methods)
  },
  created() {
    // Fetch posts from your CodeIgniter API
    // fetch('http://your-api-url/auth')
    //   .then((response) => response.json())
    //   .then((data) => {
    //     this.posts = data;
    //   })
    //   .catch((error) => {
    //     console.error('Error fetching posts: ', error);
    //   });
  },
};
</script>

<style scoped>
  .placeholder {
    position: absolute;
    top: 50%;
    right: 50%;
    transform: translate(50%, -50%);
    width: 20px; /* Adjust the width as needed */
    height: 20px; /* Adjust the height as needed */
    background-color: #ccc; /* Adjust the background color as needed */
    border-radius: 50%;
  }
</style>
