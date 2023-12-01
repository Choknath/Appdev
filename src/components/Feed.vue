<!-- pag mamaay ari ni Profile Page ito -->

<template>
    <div>
      <!-- News Feed -->
      <v-skeleton :loading="loading" :avatar="avatarLoading" :title="titleLoading" :lines="3">
        <div v-for="post in posts" :key="post.id" class="post">
          <!-- Post Content -->
          <div class="post-content">
            <div class="post-header">
              <v-avatar :src="post.profile_picture_url" size="36"></v-avatar>
              <span class="post-username">{{ post.username }}</span>
            </div>
            <div class="post-text">{{ post.content }}</div>
            
            <!-- Like and Comment Buttons -->
            <div class="post-actions">
              <v-btn icon @click="likePost(post.post_id)">
                <v-icon>mdi-thumb-up</v-icon>
              </v-btn>
              <v-btn icon @click="toggleCommentTextarea(post.post_id)">
                <v-icon>mdi-comment-outline</v-icon>
              </v-btn>
            </div>
  
            <!-- Comment Textarea -->
            <v-textarea v-if="post.showCommentTextarea" v-model="post.comment" label="Add a comment"></v-textarea>
          </div>
        </div>
      </v-skeleton>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        loading: true,
        avatarLoading: true,
        titleLoading: true,
        posts: [],
      };
    },
    async mounted() {
      try {
        await this.fetchPosts();
      } catch (error) {
        console.error('Error fetching posts:', error);
        // Handle the error, e.g., show an error message to the user
      }
    },
    methods: {
      async fetchPosts() {
        try {
          const id = sessionStorage.getItem("verification_token");
          const response = await axios.get(`post/${id}`); // Adjust the endpoint as needed
          console.log(response.data);
          this.posts = response.data.map(post => ({
            ...post,
            showCommentTextarea: false,
            comment: '',
          }));
          this.loading = false;
        } catch (error) {
          console.error('Error fetching posts:', error);
          // Handle the error, e.g., show an error message to the user
          throw error; // Rethrow the error for the calling code to handle
        }
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
  .post {
    margin-bottom: 20px;
  }
  
  .post-content {
    border: 1px solid #ccc;
    padding: 10px;
  }
  
  .post-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .post-username {
    margin-left: 10px;
    font-weight: bold;
  }
  
  .post-text {
    line-height: 1.5;
  }
  
  .post-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
  }
  </style>
  