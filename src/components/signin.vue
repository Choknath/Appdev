<template>
  <div class="login-container">
    <v-container class="theme-container">
      <v-row>
        <v-col cols="12" sm="6" md="4" lg="3">
          <v-sheet>
            <!-- Your existing form content goes here -->
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
// Import statements go here

export default {
  // Component options go here
};
</script>

<style scoped>
.login-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-image: url('/path/to/your/background-image.jpg');
  background-size: cover; /* Adjust as needed */
  background-position: center; /* Adjust as needed */
}

.theme-container {
  background-color: rgba(255, 255, 255, 0.8); /* Set a background color with opacity if needed */
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Add your existing styles here */
</style>
