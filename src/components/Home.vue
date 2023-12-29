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

            <div class="post-header">
              <!-- Like and Comment Buttons -->
              <div class="post-actions">
                <v-btn icon @click="likePost(post.id)">
                  <v-icon>mdi-thumb-up</v-icon>
                </v-btn>
                <v-btn icon @click="toggleCommentTextarea(post.id)">
                  <v-icon>mdi-comment-outline</v-icon>
                </v-btn>
              </div>

              <!-- Comment Textarea -->
              <v-textarea v-if="post.showCommentTextarea" v-model="post.comment" label="Add a comment"></v-textarea>

              <!-- Submit Button for Comments -->
              <v-btn v-if="post.showCommentTextarea" @click="submitComment(post.id)">Submit</v-btn>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>

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
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      journey: '',
      posts: [],
      isLargeScreen: true,
    };
  },
  created() {
    this.checkScreenSize();
    window.addEventListener('resize', this.checkScreenSize);
    this.getPosts();
  },
  destroyed() {
    window.removeEventListener('resize', this.checkScreenSize);
  },
  methods: {
    checkScreenSize() {
      this.isLargeScreen = window.innerWidth >= 768;
    },
    async getPosts() {
      try {
        const response = await axios.get('/content');
        this.posts = response.data.map(post => ({
          ...post,
          showCommentTextarea: false,
          comment: '',
        }));
      } catch (error) {
        console.error('Error fetching posts:', error);
      }
    },
    redirectToPostPage() {
      this.$router.push('/CreatePost');
    },
    redirectToProfile() {
      this.$router.push('/Profile');
    },
    async likePost(postId) {
      try {
        await axios.post(`/likePost/${postId}/${userId}`);
        console.log(`Liked post with ID ${postId}`);
      } catch (error) {
        console.error('Error liking post:', error);
      }
    },
    toggleCommentTextarea(postId) {
      const postIndex = this.posts.findIndex(post => post.id === postId);
      if (postIndex !== -1) {
        this.posts[postIndex] = {
          ...this.posts[postIndex],
          showCommentTextarea: !this.posts[postIndex].showCommentTextarea,
        };
      }
    },
    async submitComment(postId) {
      const postIndex = this.posts.findIndex(post => post.id === postId);
      if (postIndex !== -1) {
        const comment = this.posts[postIndex].comment;
        try {
          await axios.post(`/submitComment/${postId}/${userId}/${comment}`);
          console.log(`Submitted comment for post with ID ${postId}: ${comment}`);
          this.posts[postIndex] = {
            ...this.posts[postIndex],
            showCommentTextarea: false,
            comment: '',
          };
        } catch (error) {
          console.error('Error submitting comment:', error);
        }
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

.post-header {
  display: flex;
  justify-content: space-between;
}
</style>
