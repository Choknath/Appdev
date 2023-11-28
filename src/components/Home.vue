<template>
  <v-container class="main-container">
    <!-- User Profile Container -->
    <v-container class="profile-container">
      <v-row justify="content-start">
        <v-menu min-width="200%" rounded>
          <template v-slot:activator="{ props }">
            <v-btn icon v-bind="props" size="120" @click="redirectToProfile">
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

    <!-- List of Posts -->
    <v-container class="posts-container">
      <v-row>
        <v-col v-for="post in posts" :key="post.id" cols="12">
          <v-card>
            <!-- <v-img :src="post.profile_picture_url" :alt="post.event.name"></v-img> -->
            <v-card-title>{{ post.username }}</v-card-title>
            <v-card-title>{{ post.event_name }}</v-card-title>
            <v-card-title>{{ post.title }}</v-card-title>
            <v-card-text>{{ post.content }}</v-card-text>
            <v-card-text>{{ post.created_at }}</v-card-text>
            <div class="post-actions">
              <v-btn icon @click="likePost(post.post_id)">
                <v-icon>mdi-thumb-up</v-icon>
              </v-btn>
              <v-btn icon @click="toggleCommentTextarea(post.post_id)">
                <v-icon>mdi-comment-outline</v-icon>
              </v-btn>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
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
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      journey: '',
      posts: [],
    };
  },
  created(){
    this.getposts();
  },
  methods: {
    async getposts(){
      try {
        const response = await axios.get('/content');
        this.posts = response.data
        console.log(response.data);
          this.posts = response.data.map(post => ({
            ...post,
            showCommentTextarea: false,
            comment: '',
          }));
        
      } catch (error) {
        console.error('Error fetching events:', error);
      }

    },
    redirectToPostPage() {
      this.$router.push('/CreatePost');
    },
    redirectToProfile(){
      this.$router.push('/Profile');
    },
    likePost(postId) {
        // Handle liking the post, e.g., make an API call to update the like count
        console.log(`Liked post with ID ${postId}`);
      },
      toggleCommentTextarea(postId) {
        const postIndex = this.posts.findIndex(post => post.post_id === postId);
        if (postIndex !== -1) {
          this.posts[postIndex] = {
            ...this.posts[postIndex],
            showCommentTextarea: !this.posts[postIndex].showCommentTextarea,
          };
        }
      },
  },
};
</script>

<style scoped>
.main-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.profile-container {
  width: 100%;
  padding: 16px;
}

.posts-container {
  width: 100%;
  padding: 16px;
}
</style>
