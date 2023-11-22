<template>
  <body>
 
<div>
    <!-- Profile Container -->
    <v-container class="profile-container">
      <v-row justify="content-start">
        <v-menu min-width="200%" rounded>
          <template v-slot:activator="{ props }">
            <v-btn icon v-bind="props" size="120">
              <!-- <img :src="user.profile_picture_url" alt="Profile"> -->
            </v-btn>
            <v-text-field v-model="journey" label="Hows you journey"></v-text-field>
            <v-avatar  size="150">
                <span class="text-h5">{{ posts.username }}</span>
              </v-avatar>
          </template>
        </v-menu>
     </v-row>
   </v-container>
</div>






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

    
    
  </body>
  </template>

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


<script>
export default {
  data() {
    return {
      posts: [],
    };
  },
  created() {
    // Fetch posts from your CodeIgniter API
    fetch('http://your-api-url/auth')
      .then((response) => response.json())
      .then((data) => {
        this.posts = data;
      })
      .catch((error) => {
        console.error('Error fetching posts: ', error);
      });
  },
};
</script>