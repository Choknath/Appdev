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
              <div class="d-flex justify-content-between">
                <router-link to="/Registration" class="d-block mt-2">Register</router-link>
                <router-link to="/ForgotPassword" class="d-block mt-2">Forgot Password?</router-link>
              </div>
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
      // console.log("okay na ")
      const res = await axios.post('/login', {
          username: this.username,
          password: this.password,
        });
        if (res.data.msg === 'okay') {
          sessionStorage.setItem("verification_token", res.data.token);
          router.push('/Home')
        } else {
          
        }

      
    },
    
    // async login() {
    //   try {
    //     const res = await axios.post('/login', {
    //       username: this.username,
    //       password: this.password,
    //     });

    //     if (res.data.msg === 'okay') {
    //       const token = res.data.token;
    //       const userRole = res.data.user.role; // Assuming the server sends the user role in the response

    //       sessionStorage.setItem("verification_token", token);

    //       // Redirect based on user role
    //       if (userRole === 'user') {
    //         router.push('/Home');
    //       } else if (userRole === 'admin') {
    //         router.push('/AdminPage');
    //       } else {
    //         // Handle other roles or scenarios
    //       }
    //     } else {
    //       // Handle other response scenarios if needed
    //     }
    //   } catch (error) {
    //     console.error('Login error:', error);
    //     // Handle error scenarios if needed
    //   }
    // },
      
  },
};
</script>

<style scoped>
.login-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  
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
