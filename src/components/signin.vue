<template>
  <div class="login-container">
    <v-container class="theme-container">
      <v-row>
        <v-col cols="12" sm="6" md="4" lg="3">
          <v-sheet width="300" class="mx-auto">
            <v-form @submit.prevent="login">
              <div v-if="message === 'error'" class="error-message">Invalid response</div>

              <v-text-field v-model="username" label="Username"></v-text-field>
              <v-text-field v-model="password" label="Password" type="password"></v-text-field>

              <v-btn type="submit" block class="mt-3">Login</v-btn>
              <router-link to="/Registration" class="d-block mt-2">Register</router-link>
            </v-form>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
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
      message: '',
    };
  },
  methods: {
    async login() {
      try {
        const { data } = await axios.post('/login', {
          username: this.username,
          password: this.password,
        });

        if (data.msg === 'okay') {
          router.push('/Home');
        }
      } catch (error) {
        console.error('An error occurred during login:', error);
        this.message = 'error';
      }
    },
  },
};
</script>

<style scoped>
.login-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  /* background-image: url('c:\Users\Mark Jober Laudencia\Downloads\Community Cyclist Club (2).png'); */
  background-size: cover;
  background-position: center;
}

.theme-container {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.error-message {
  color: red;
  margin-bottom: 10px;
}

/* Add your existing styles here */
</style>
