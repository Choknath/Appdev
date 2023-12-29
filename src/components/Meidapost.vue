<template>
    <v-container>
      <v-form @submit.prevent="submitPost">
        <v-text-field v-model="content" label="Post Content"></v-text-field>
        
        <v-row>
            <v-col>
              <v-file-input
                v-model="event_image_url"
                label="Event Image"
                accept="image/*"
                show-size
                small-chips
                chips
              ></v-file-input>
            </v-col>
            <v-col>
              <v-icon>mdi-image</v-icon>
            </v-col>
          </v-row>
  
        <v-btn  type="submit" @click="redirectToPost" >Post</v-btn>
        <v-btn class="m-2" @click="redirecttoCancel" >GO Back</v-btn>
        
      </v-form>
    </v-container>
  </template>
  
  <script>

import axios from 'axios';

  export default {
    data() {
      return {
        content: "",
        mediaUrl: "",
      };
    },
    methods: {
        redirectToPost(){
            this.$router.push('/CreatePost')

        },
        redirecttoCancel(){
            this.$router.push('/Home')

        },
      async submitPost() {
        const a = sessionStorage.getItem('verification_token');
        try {
            const response = await axios.post('/Post', {
            verification_token: a,
            content: this.content ,
            mediaUrl: this.mediaUrl
        });

        console.log(response.data);  // Log the response data
           // Reset the text fields after successful submission
        this.content = "";
        this.mediaUrl = "";

        // Handle the response as needed
        } catch (error) {
            console.error('Error:', error);
        // Handle the error, log it, or show a user-friendly message
        }
      
      },
    },
  };
  </script>
  