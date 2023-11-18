<template>
  <div class="container d-flex align-items-center justify-content-center h-100">
    <div class="v-container theme-container">
      <v-sheet width="300" class="mx-auto">
        <v-form @submit.prevent="login">
          <div v-if="message === 'error'" class="error-message">Invalid response</div>

          <v-text-field v-model="username" label="Username"></v-text-field>
          <v-text-field v-model="password" label="Password" type="password"></v-text-field>

          <v-btn type="submit" block class="mt-3">Login</v-btn>
          <router-link to="/Registration" class="d-block mt-2">Register</router-link>
        </v-form>
      </v-sheet>
    </div>
  </div>
</template> 

<script>
import axios from 'axios';
import router from '@/router';

export default {
  data() {
    return {
      username: '',
      password: '',
      erroeMsg: '',
    };
  },
  methods: {
    async login() {
     const d = await axios.post('/login', {
     username: this.username,
     password: this.password
     });
     if(d.data.msg ==='okay'){
      router.push('/Home')
     }
    },
  },
}
</script>

<style scoped>
.login-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
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
