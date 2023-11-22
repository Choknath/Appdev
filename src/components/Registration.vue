<!-- <template>

  <div class="container d-flex align-items-center justify-content-center h-100">
    <div class="v-container theme-container">
    <v-sheet  width="300" class="mx-auto" >
  <v-form fast-fail @submit.prevent="register" class="text-center">
      <div v-if="message === 'error'">Invalid response</div>

      <v-text-field v-model="username" label="Username"></v-text-field>
      <v-text-field v-model="email" label="Email"></v-text-field>
      <v-text-field v-model="full_name" label="Full Name"></v-text-field>
      <v-text-field v-model="password" label="Password" type="password"></v-text-field>
      <v-text-field v-model="passwordConfirm" label="Password Confirm" type="password"></v-text-field>

      <div v-if="message === 'passwordMismatch'">Passwords do not match</div>
     

      <v-btn type="submit" block class="mt-2">Submit</v-btn>
      <router-link to="/">Login</router-link>
    </v-form>
  </v-sheet>
    </div>  
  </div>  
  </template>

  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        username: '',
        email: '',
        full_name: '',
        password: '',
        passwordConfirm: '',
      message: null,
      
      };
    },
    methods: {
  async register() {
    try {
      // Check if passwords match
      if (this.password !== this.passwordConfirm) {
        this.message = 'passwordMismatch';
        return;
      }

      // Make the API call to check if the username exists
      const usernameCheckResponse = await axios.post('/register', {
        username: this.username,
      });

      // Handle the response from the username check
      if (!usernameCheckResponse.data.available) {
        // Username is not available
        console.error('Username already exists');
        this.message = 'usernameTaken';
        return;
      }

      // Proceed with user registration
      const registrationResponse = await axios.post('register', {
        username: this.username,
        email: this.email,
        full_name: this.full_name,
        password: this.password,
      });

      // Handle the response from the backend registration
      if (registrationResponse.data.success) {
        // Registration successful
        console.log('Registration successful');
        // You can redirect or show a success message here
      } else {
        // Registration failed for some reason
        console.error('Registration failed:', registrationResponse.data.message);
        this.message = 'registrationFailed';
      }
    } catch (error) {
      // Handle other errors, such as network issues or server errors
      console.error('An error occurred during registration:', error);
      this.message = 'error';
    }
  },
},
  }
  </script> -->

<template>
  <div class="container d-flex align-items-center justify-content-center h-100">
    <div class="v-container theme-container">
      <v-sheet width="300" class="mx-auto">
        <v-form fast-fail @submit.prevent="register" class="text-center">
          <div v-if="message === 'error'">Invalid response</div>

          <v-text-field v-model="username" label="Username"></v-text-field>
          <v-text-field v-model="email" label="Email"></v-text-field>
          <v-text-field v-model="full_name" label="Full Name"></v-text-field>
          <v-text-field v-model="password" label="Password" type="password"></v-text-field>
          <v-text-field v-model="passwordConfirm" label="Password Confirm" type="password"></v-text-field>

          <div v-if="message === 'passwordMismatch'">Passwords do not match</div>

          <v-btn type="submit" block class="mt-2">Submit</v-btn>
          <router-link to="/">Login</router-link>
        </v-form>
      </v-sheet>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      username: '',
      email: '',
      full_name: '',
      password: '',
      passwordConfirm: '',
      message: null,
    };
  },
  methods: {
    async register() {
      try {
        // Check if passwords match
        if (this.password !== this.passwordConfirm) {
          this.message = 'passwordMismatch';
          return;
        }
          // Make sure the API endpoint for user registration is correct
          const registrationResponse = await axios.post('/register', {
          username: this.username,
          email: this.email,
          full_name: this.full_name,
          password: this.password,
        });
        // Make the API call to check if the username exists
        const usernameCheckResponse = await axios.post('/checkusername', {
          username: this.username,
        });

        // Handle the response from the username check
        if (!usernameCheckResponse.data.available) {
          // Username is not available
          console.error('Username already exists');
          this.message = 'usernameTaken';
          return; 
        }

        // Handle the response from the backend registration
        if (registrationResponse.data.success) {
          // Registration successful
          console.log('Registration successful');
          // You can redirect or show a success message here
        } else {
          // Registration failed for some reason
          console.error('Registration failed:', registrationResponse.data.message);
          this.message = 'registrationFailed';
        }
      } catch (error) {
        // Handle other errors, such as network issues or server errors
        console.error('An error occurred during registration:', error);
        this.message = 'error';
      }
    },
  },
};
</script>

